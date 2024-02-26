@extends("layouts.auth_overview")

@section("auth_content")
<div class="login-content content background">
    <div class="main-container container">
        <div class="col-sm-offset-3 col-sm-6">
            <div class="login-container">
                <div class="login-form-div">
                    <div class="login-heading">
                        <div class="main-login-heading">
                            <h2 class="main-heading">Welcome Back</h2>
                        </div>
                        <div class="clearfix"></div>
                        <p>Sign in to your account below</p>
                    </div>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form class="login-form" action="{{url('auth/login')}}" method="post">
                        @csrf
                        @if(session('error'))
                        <div style="margin-bottom: 1rem;" class="label label-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="form-group">
                            <label>Username</label>
                            <input required type="text" name="userName" id="usernameField" class="form-control" value="{{old('userName')}}">
                            @error('userName')
                            <div style="margin-top: .5rem; font-size: 10px" class="label label-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input required type="password" name="password" id="passwordField" class="form-control">
                            @error('password')
                            <div style="margin-top: .5rem; font-size: 10px" class="label label-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div style="margin-bottom: 0" class="form-group">
                            <div class="flex">
                                <input type="submit" value="LOG IN" class="btn btn-primary">
                                <a class="pull-right" href="<?php echo route("forgot.password") ?>">Forgot Password</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                    <div style="margin-top: 0.5em;">
                        <p>Don't have an account? <a href="<?php echo url("auth/register"); ?>">Register</a></p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
@stop
