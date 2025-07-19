@extends('layouts.main')
@section('title', 'Form List')

@section('body')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mt-3">Form List</h1>

        <a href="{{ route('admin.logout') }}"
            class="fs-5 text-decoration-none border p-2 rounded-2 bg-primary text-light">Logout</a>
    </div>
    <h5>Hello {{ $user->name }}!</h5>
    <a class="d-flex justify-content-end mb-3" href="{{ route('admin.form.create') }}">+ Create New Form</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Form Name</th>
                <th scope="col">Actions</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($forms as $form)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $form->form_name }}</td>
                    <td class="d-flex flex-column">
                        <ul>
                            <li><a href="{{ route('admin.form.show', ['form' => $form->id]) }}">View Form</a></li>
                            <li><a href="{{ route('admin.formdata.index', ['form' => $form->id]) }}">View Form Data</a></li>
                            <li><a href="{{ route('admin.form.edit', ['form' => $form->id]) }}">Edit</a></li>
                            <li><a href="{{ route('admin.form.delete', ['form' => $form->id]) }}">Delete</a></li>
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($forms->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-inbox text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3 text-muted">No forms found</h4>
            <p class="text-muted">You haven't created any forms yet.</p>
        </div>
    @endempty
@endsection
