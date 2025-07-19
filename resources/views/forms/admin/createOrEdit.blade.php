@extends('layouts.main')

@section('body')
    <div class="w-50 m-auto mt-5">
        <h1 class="mb-5">
            @if (isset($form))
                Edit Form
            @else
                Create New Form
            @endif
        </h1>
        <a class="d-flex justify-content-end mb-3 " href="{{ route('admin.form.index') }}">View Form list</a>
        <form id="create_new_form" method="POST" action="{{ route('admin.form.store') }}">
            @csrf
            <div class="mb-3">
                <label for="form_name" class="form-label fs-4">Form Name</label>
                @isset($form)
                    <input type="hidden" name="form_id" value="{{ $form->id }}">
                @endisset
                <input type="text" class="form-control" name="form_name"
                    value="@isset($form){{ $form->form_name }}@endisset">
            </div>

            <div id="form_field_items">
                <label for="form_name" class="form-label fs-4">Form Fields</label>

                @isset($form)
                    @php $lastFormFieldIndex=0; @endphp
                    @foreach ($form->formFields()->get() as $field)
                        <div class="mb-3 bg-secondary bg-gradient p-3 rounded-4 position-relative" style="--bs-bg-opacity: .1;">
                            <input type="hidden" name="fields[{{ $loop->index }}][id]" value="{{ $field->id }}">
                            <div class="mb-2 row g-3 align-items-center" class="form_field_items">
                                <a href="{{ route('admin.formfields.delete', ['formField' => $field->id]) }}"
                                    class="d-flex justify-content-end position-absolute p-2" style="width:95%;">Delete</a>
                                <div class="col-auto">
                                    <label class="col-form-label">Field Name</label>
                                </div>
                                <div class="col-auto">
                                    <input type="text" class="form-control field_name"
                                        name="fields[{{ $loop->index }}][field_label]" value="{{ $field->field_label }}">
                                </div>
                            </div>
                            <div class="mb-2 row g-3 align-items-center" class="form_field_items">
                                <div class="col-auto">
                                    <label class="col-form-label">Field Type</label>
                                </div>
                                <div class="col-auto">
                                    <select class="form-select field_type" name="fields[{{ $loop->index }}][field_type]">
                                        <option>Select Field</option>
                                        <option value="text" @selected($field->field_type == 'text')>Text</option>
                                        <option value="number" @selected($field->field_type == 'number')>Number</option>
                                        <option value="select" @selected($field->field_type == 'select')>Select</option>
                                    </select>
                                </div>
                            </div>

                            <div
                                class="mb-2 row g-3 align-items-center form_field_options @empty($field->field_options) d-none @endempty">
                                <div class="col-auto">
                                    <label class="col-form-label">Field Options</label>
                                </div>
                                <div class="col-auto">
                                    <input type="text" class="form-control options"
                                        name="fields[{{ $loop->index }}][field_options]"
                                        value="@isset($field->field_options){{ implode(',', unserialize($field->field_options)) }} @endisset">
                                </div>
                            </div>

                        </div>
                        @php $lastFormFieldIndex=$loop->index; @endphp
                    @endforeach
                @endisset
            </div>

            <button type="button" class="btn btn-primary" id="addNewFields">+ Add New
                Fields</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('footer')
    <script>
        function fieldTypeChangeListener() {

            let fieldSelects = $('.field_type');
            fieldSelects.each(function() {
                let fieldOption = $(this).parent().parent().siblings('.form_field_options');
                $(this).on("change", function(e) {
                    if (e.target.value == 'select') {
                        fieldOption.removeClass("d-none");
                        fieldOption.find('input').prop('disabled', false)
                    } else {
                        fieldOption.addClass("d-none");
                        fieldOption.find('input').prop('disabled', true)
                    }

                })
            })
        }

        let newFieldButton = $('#addNewFields');
        let createForm = $('#create_new_form');
        let fieldCount = {{ isset($lastFormFieldIndex) ? $lastFormFieldIndex + 1 : 0 }};
        fieldTypeChangeListener();
        newFieldButton.on('click', function(e) {
            let fieldForm = `
                  <div class="mb-3 bg-secondary bg-gradient p-3 rounded-4" style="--bs-bg-opacity: .1;">
                    <div class="mb-2 row g-3 align-items-center" class="form_field_items">
                        <div class="col-auto">
                            <label class="col-form-label">Field Name</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control field_name" name="fields[${fieldCount}][field_label]">
                        </div>
                    </div>
                    <div class="mb-2 row g-3 align-items-center">
                        <div class="col-auto">
                            <label class="col-form-label">Field Type</label>
                        </div>
                        <div class="col-auto">
                            <select class="form-select field_type" name="fields[${fieldCount}][field_type]">
                                <option selected>Select Field</option>
                                <option value="text">Text</option>
                                <option value="number">Number</option>
                                <option value="select">Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 row g-3 align-items-center form_field_options d-none">
                        <div class="col-auto">
                            <label class="col-form-label">Field Options</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control options" name="fields[${fieldCount}][field_options]" disabled>
                        </div>
                         <div id="optionHelp" class="form-text col-auto">Values must be seperated by commas.<br> <b>Example: Option1, Option2, etc</b></div>
                        
                    </div>
                </div>
            `;

            fieldCount++;

            $('#form_field_items').append(fieldForm);
            fieldTypeChangeListener();
        })
    </script>
@endsection
