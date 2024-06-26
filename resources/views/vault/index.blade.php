@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Vault') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Search Form -->
                        <form method="GET" action="{{ route('vault.search') }}">
                            <div class="form-group row">
                                <label for="query" class="col-md-4 col-form-label text-md-right">{{ __('Search') }}</label>
                                <div class="col-md-6">
                                    <input id="query" type="text" class="form-control" name="query" value="{{ request('query') }}" autocomplete="query" autofocus>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
                                </div>
                            </div>
                        </form>

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
