<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormData;
use Illuminate\Http\Request;

class FormDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Form $form)
    {
        return view('forms.admin.formData.index', ['form' => $form]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Form $form)
    {
        $formValues = $request->except('_token');
        $form->formData()->create(['formdata' => json_encode($formValues)]);
        if (isset(auth()->user()->id))
            return redirect()->route('admin.formdata.index', ['form' => $form])->with('success','Form Submitted Successfully!');
        else
            return redirect()->route('form.show', ['form' => $form])->with('success','Form Submitted Successfully!');
    }
}
