@extends('layout.app')
@section('title', 'Login')

@section('content')
<div class="container py-5" style="min-height: 100vh">
    <div class="w-50 m-auto">
        <h1 class="text-center mt-5">Turis Tahanan</h1>
        <form action="{{url('/login')}}" method="POST" class="mt-5 bg-white p-5 border w-75 m-auto rounded shadow-sm">
            @csrf
            <div class="mb-3">
                <label for="username" class="label-form mb-2">Username</label>
                <input type="text" name="username" id="username" class="form-control border border-black"/>
            </div>
            @error('username')
                <p class="text-danger p-0">{{ $message }}</p>
            @enderror
            <div class="mb-3">
                <label for="password" class="label-form mb-2">Password</label>
                <input type="password" name="password" id="password" class="form-control border border-black"/>
            </div>
            @error('password')
                <p class="text-danger mb-3 p-0">{{ $message }}</p>
            @enderror
            <button class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
@endsection