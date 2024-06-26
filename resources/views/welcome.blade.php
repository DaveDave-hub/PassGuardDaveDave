<!-- resources/views/welcome.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Passguard') }}</div>

                    <div class="card-body text-center">
                        <h1>Welcome to Passguard</h1>
                        @guest
                            <p class="mb-4">Please log in or register to continue.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary mx-2">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-secondary mx-2">Register</a>
                        @else
                            <p class="mb-4">You are logged in!</p>
                            <a href="{{ route('vault.index') }}" class="btn btn-primary mx-2">Go to Vault</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
