@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('vault.update', $password->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="platform" class="col-md-4 col-form-label text-md-right">{{ __('Platform') }}</label>

                                <div class="col-md-6">
                                    <input id="platform" type="text" class="form-control @error('platform') is-invalid @enderror" name="platform" value="{{ old('platform', $password->platform) }}" required autocomplete="platform" autofocus>

                                    @error('platform')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email_username" class="col-md-4 col-form-label text-md-right">{{ __('Email/Username') }}</label>

                                <div class="col-md-6">
                                    <input id="email_username" type="text" class="form-control @error('email_username') is-invalid @enderror" name="email_username" value="{{ old('email_username', $password->email_username) }}" required autocomplete="email_username">

                                    @error('email_username')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', $password->password) }}" required autocomplete="password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
