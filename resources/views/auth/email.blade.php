@extends('layouts.auth_overview')

@section('auth_content')

<div class="login-content content background">
    <div class="main-container container">
        <div class="col-sm-offset-3 col-sm-6">
            <div class="login-container">
                <div class="login-form-div">
                    <div class="login-heading">
                        <div class="main-login-heading">
                            <h2 class="main-heading">{{ __('Reset Password') }}</h2>
                        </div>

                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <div class="clearfix"></div>
                        
                    </div>

                    <form class="login-form" action="{{ route('password.email') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label>Email</label>
                            <input required type="text" name="email" id="emailField" class="form-control" value="{{ $email ?? old('email')}}">
                            @error('email')
                            <div style="margin-top: .5rem; font-size: 10px" class="label label-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        @if(session('error'))
                        <div style="margin-bottom: 1rem;" class="label label-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        <div style="margin-bottom: 0" class="form-group">
                            <div class="flex">
                                <input type="submit" value="{{ __('Send Password Reset Link') }}" class="btn btn-primary">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                    <div style="margin-top: 0.5em;">

                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

@endsection
