@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Vault') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Search Form -->
                        <form method="GET" action="{{ route('vault.search') }}" class="mb-4">
                            <div class="form-group row">
                                <label for="query" class="col-md-3 col-form-label text-md-right">{{ __('Search') }}</label>
                                <div class="col-md-7">
                                    <input id="query" type="text" class="form-control" name="query" value="{{ request('query') }}" autocomplete="query" autofocus>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
                                </div>
                            </div>
                        </form>

                        <hr>

                        <!-- Add Password Form -->
                        <h5>{{ __('Add New Password') }}</h5>
                        <form method="POST" action="{{ route('vault.store') }}" class="mb-4">
                            @csrf
                            <div class="form-group row">
                                <label for="platform" class="col-md-3 col-form-label text-md-right">{{ __('Platform') }}</label>
                                <div class="col-md-7">
                                    <input id="platform" type="text" class="form-control @error('platform') is-invalid @enderror" name="platform" value="{{ old('platform') }}" required>
                                    @error('platform')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email_username" class="col-md-3 col-form-label text-md-right">{{ __('Email/Username') }}</label>
                                <div class="col-md-7">
                                    <input id="email_username" type="text" class="form-control @error('email_username') is-invalid @enderror" name="email_username" value="{{ old('email_username') }}" required>
                                    @error('email_username')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-7">
                                    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-9 offset-md-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <hr>

                        <!-- Passwords Table -->
                        <h5>{{ __('Stored Passwords') }}</h5>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Platform</th>
                                <th>Email/Username</th>
                                <th>Password</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($passwords as $password)
                                <tr>
                                    <td>{{ $password->platform }}</td>
                                    <td>{{ $password->email_username }}</td>
                                    <td>{{ $password->password }}</td>
                                    <td>
                                        <a href="{{ route('vault.edit', $password->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('vault.destroy', $password->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center">
                            {{ $passwords->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
