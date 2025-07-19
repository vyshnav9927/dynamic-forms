@extends('layouts.main')
@section('title', 'Form Data')

@section('body')
    <h1 class="mt-3">Form Data</h1>
    <a class="d-flex justify-content-end" href="{{ route('admin.form.index') }}">View Form list</a>
    <a class="d-flex justify-content-end" href="{{ route('admin.form.show', ['form' => $form->id]) }}">View Form</a>

    <table class="table">
        @php
            $formFields = $form->formFields()->get();
        @endphp
        <thead>
            <tr>
                <th scope="col">S.No</th>
                @foreach ($formFields as $field)
                    <th scope="col">{{ $field->field_label }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($form->formData()->get() as $formData)
                @php
                    $formData = json_decode($formData->formdata, true);
                @endphp
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    @foreach ($formFields as $field)
                        @php
                            $formDataKey = str_replace(' ', '_', strtolower($field->field_label));
                        @endphp
                        <td>{{ isset($formData[$formDataKey]) ? $formData[$formDataKey] : 'Not Available' }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($form->formData->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-inbox text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3 text-muted">No form data found</h4>
        </div>
    @endempty
@endsection
