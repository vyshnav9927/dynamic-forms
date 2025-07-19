@extends('layouts.main')

@section('body')
    <h1 class="mt-3">{{ $form->form_name }}</h1>
    @auth
        <a class="d-flex justify-content-end mb-3" href="{{ route('admin.form.index') }}">View Form list</a>
    @endauth
    @guest
        <a class="d-flex justify-content-end mb-3" href="{{ route('home') }}">Home</a>
    @endguest

    <form action="{{ route('formdata.store', ['form' => $form->id]) }}" method="POST">
        @csrf
        @foreach ($form->formFields as $field)
            <div class="mb-3">
                <label class="form-label">{{ $field->field_label }}</label>
                @if ($field->field_type != 'select')
                    <input type="{{ $field->field_type }}" class="form-control"
                        name="{{ strtolower(str_replace(' ', '_', $field->field_label)) }}">
                @else
                    <select class="form-select" name="{{ strtolower(str_replace(' ', '_', $field->field_label)) }}">
                        <option selected>Select Options</option>
                        @foreach (unserialize($field->field_options) as $option)
                            <option value="{{ strtolower($option) }}">{{ $option }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
