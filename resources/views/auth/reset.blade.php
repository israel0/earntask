@extends("layouts.auth_overview")

@section("auth_content")
<div class="login-content content background">
    <div class="main-container container">
        <div class="col-sm-offset-3 col-sm-6">
            <div class="login-container">
                <div class="login-form-div">
                    <div class="login-heading">
                        <div class="main-login-heading">
                            <h2 class="main-heading">Reset Your Password</h2>
                        </div>
                        <div class="clearfix"></div>
                        
                    </div>

                    <form class="login-form" action="{{ route('password.update', ['token' => $token]) }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label>Email</label>
                            <input required type="text" name="email" id="usernameField" class="form-control" value="{{ $email ?? old('email')}}">
                            @error('email')
                            <div style="margin-top: .5rem; font-size: 10px" class="label label-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        @if(session('error'))
                        <div style="margin-bottom: 1rem;" class="label label-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        <div class="form-group">
                            <label>Password</label>
                            <input required type="password" name="password" id="passwordField" class="form-control">
                            @error('password')
                            <div style="margin-top: .5rem; font-size: 10px" class="label label-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input required type="text" name="password_confirmation" id="passwordConfirmation" class="form-control">
                            @error('password_confirmation')
                            <div style="margin-top: .5rem; font-size: 10px" class="label label-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div style="margin-bottom: 0" class="form-group">
                            <div class="flex">
                                <input type="submit" value="RESET PASSWORD" class="btn btn-primary">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                    <br>
                   
                        <div style="margin-top: 0.5em;">
                            <p>Login to Your Account? <a href="<?php echo url("auth/login"); ?>">Login</a></p>
                        </div>
                    
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
@stop
