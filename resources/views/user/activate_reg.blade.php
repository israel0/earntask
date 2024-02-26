@extends("layouts.auth_overview")

@section("auth_content")
<div class="login-content content background">
    <div class="clearfix"></div>
    <div class="container main-container">
        <div class="col-md-offset-2 col-md-8">
            <div class="login-container">
                <div class="login-heading">
                    <div class="main-login-heading">
                        <h2 class=" main-heading">Activate Your Account</h2>
                    </div>
                    <div class="clearfix"></div>
                    <p>Simply enter your enter activation code below.</p>
                    <p>Don't have an activation code? Click <a href="#" data-toggle="modal" data-target="#activationInfo">here</a></p>
                </div>

                <div class="register-form-div">
                    <form method="post" action="{{url('user/activate_reg')}}" class="login-form" id="register-form" role="form">
                        @csrf
                        @if(session('error'))
                        <div style="margin-bottom: 1rem;" class="label label-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="activationField" class="control-label">Activation Code</label>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                                <span class="fa fa-lock"></span>
                                            </a></span>
                                        <input name="activationCode" type="text" id="activationCodeField" class="form-control" placeholder="" value="{{old('activationCode')}}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="help-block with-errors">
                                        @error('activationCode')
                                        <div style="margin-top: .5rem; font-size: 10px" class="label label-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-bottom: 0" class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <input type="hidden" id="ajaxSubmit" name="ajaxSubmit" value="0">
                                <input type="submit" value="ACTIVATE YOUR ACCOUNT" class="btn btn-primary">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include("subviews.activation_info")
</div>
@stop