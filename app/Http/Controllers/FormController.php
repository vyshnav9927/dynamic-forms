<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormFields;
use Illuminate\Http\Request;
use App\Jobs\SendFormNotification;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset(auth()->user()->id))
            return view('forms.admin.index', ['forms' => auth()->user()->forms()->get(), 'user' => auth()->user()]);
        else
            return view('forms.index', ['forms' => Form::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forms.admin.createOrEdit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currentUser = auth()->user();
        $form_id = $request?->form_id ?: 0;
        $form = $currentUser->forms()->updateOrCreate(
            ['id' => $form_id],
            ['form_name' => $request->form_name],
        );
        $formFields = array_map(function ($field) {

            if (!isset($field['id']))
                $field['id'] = 0;

            if (isset($field['field_options'])) {
                $optionsArray = explode(",", $field['field_options']);
                $field['field_options'] = serialize($optionsArray);
            } else
                $field['field_options'] = null;

            return $field;
        }, $request->fields);

        $form->formFields()->upsert($formFields, ['id']);
        
        //It means form is newly created
        if ($form_id == 0)
            SendFormNotification::dispatch($form);

        return redirect()->route('admin.form.show', ['form' => $form->id])->with('success', $form_id ? 'Form Updated Successfully!' : 'Form Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        return view('forms.show', ['form' => $form]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        return view('forms.admin.createOrEdit', ['form' => $form]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('admin.form.index');
    }

    public function formFieldsDestory(FormFields $formField)
    {
        $formId = $formField->form->id;
        $formField->delete();
        return redirect()->route('admin.form.edit', ['form' => $formId]);
    }
}
