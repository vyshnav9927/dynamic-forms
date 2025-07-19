@extends('layouts.main')
@section('body-class', 'vh-100 d-flex justify-content-center align-items-center flex-column')
@section('body')
<a href="{{route('home')}}" class="m-5 fs-5">Home</a>
    <div class="w-50 border p-5">
        <h1 align="center">Login</h1>
        <form method="POST" action="{{ route('login.validate') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
