@extends('layouts.main')

@section('body')
    <div class="d-flex align-items-center justify-content-between">
        <h1 align="center" class="m-3">Forms</h1>
        <a href="{{ route('login') }}" class="fs-5 text-decoration-none border p-2 rounded-2 bg-primary text-light">Login</a>
    </div>
    <ul class="list-group">
        @foreach ($forms as $form)
            <li class="list-group-item d-flex justify-content-center"><a
                    href="{{ route('form.show', ['form' => $form->id]) }}">{{ $form->form_name }}</a></li>
        @endforeach
    </ul>
    @if ($forms->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-inbox text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3 text-muted">No forms found</h4>
            <p class="text-muted">You haven't created any forms yet.</p>
            <a href="{{ route('admin.form.create') }}" class="btn btn-primary">Create Your First Form</a>
        </div>
    @endempty
@endsection
