@extends('layouts.app')
@push('styles')
<style> 
    .progress { 
        height: 4px; 
    } 
      
    .progress-bar { 
        background-color: green; 
    } 
</style> 
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-strength" class="col-md-4 col-form-label text-md-end">{{ __('Password strength') }}</label>
                            <div class="col-md-6 progress" id="password-strength"> 
                                <div class="progress-bar" 
                                     role="progressbar" 
                                     aria-valuenow="0"
                                     aria-valuemin="0" 
                                     aria-valuemax="100"
                                     style="width:0%"> 
                                </div> 
                            </div> 
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
@push('scripts')
<script> 
    var percentage = 0; 

    function check(n, m) { 
        if (n < 6) { 
            percentage = 0; 
            $(".progress-bar").css("background", "#dd4b39"); 
        } else if (n < 8) { 
            percentage = 20; 
            $(".progress-bar").css("background", "#9c27b0"); 
        } else if (n < 10) { 
            percentage = 40; 
            $(".progress-bar").css("background", "#ff9800"); 
        } else { 
            percentage = 60; 
            $(".progress-bar").css("background", "#4caf50"); 
        } 

        // and update percentage variable as needed. 
        
        //Lowercase Words only 
        if ((m.match(/[a-z]/) != null))  
        { 
            percentage += 10; 
        } 
        
        //Uppercase Words only 
        if ((m.match(/[A-Z]/) != null))  
        { 
            percentage += 10; 
        } 
        
        //Digits only 
        if ((m.match(/0|1|2|3|4|5|6|7|8|9/) != null))  
        { 
            percentage += 10; 
        } 
        
        //Special characters 
        if ((m.match(/\W/) != null) && (m.match(/\D/) != null)) 
        { 
            percentage += 10; 
        } 

        // Update the width of the progress bar 
        $(".progress-bar").css("width", percentage + "%"); 
    } 

    // Update progress bar as per the input 
    $(document).ready(function() { 
        // Whenever the key is pressed, apply condition checks.  
        $("#password").keyup(function() { 
            var m = $(this).val(); 
            var n = m.length; 

            // Function for checking 
            check(n, m); 
        }); 
    }); 
</script> 
@endpush