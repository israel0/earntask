@extends("layouts.auth_overview")

@section("auth_content")
<div class="reg-content content background">
    <div class="clearfix"></div>
    <div class="container main-container">
        <div class="col-md-offset-2 col-md-8">
            <div class="login-container">
                <div class="login-heading">
                    <div class="main-login-heading">
                        <h2 class=" main-heading">Create Your Account</h2>
                    </div>
                    <div class="clearfix"></div>
                    <p>Simply fill the form below to create your account.</p>
                </div>
                <div class="register-form-div">
                    <form class="login-form" id="register-form" action="{{url('auth/register')}}" method="post">
                        @csrf
                        @if(session('error'))
                        <div style="margin-bottom: 1rem;" class="label label-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        @if(session('success'))
                        <div style="margin-bottom: 1rem;" class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                      
                        <div class="form-group has-feedback">
                            <div class="row">
                                <div class="referral-label col-sm-3">
                                    <label for="referralNameField" class="control-label">referral Name</label>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                                <span class="fa fa-users"></span>
                                            </a></span>

                                        @if(request()->has('ref'))
                                        <input name="referralName" type="text" id="referralNameField" class="form-control" placeholder="" value="{{ request()->input('ref')}}" readonly>
                                        @else
                                        <input name="referralName" type="text" id="referralNameField" class="form-control" placeholder="" value="{{old('referralName')}}">
                                        @endif


                                        <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                                <span class="referral-feedback glyphicon glyphicon-remove"></span>
                                            </a></span>
                                    </div>
                                    <p style="font-size: 12px;">You must have a referral before you can register</p>
                                </div>
                                <div class="col-sm-3">
                                    <div class="help-block with-errors">
                                        @if(isset($firstreferralName) && $firstreferralName !== null)
                                        <p style='color: #31b0d5'>$firstreferralName $lastreferralName</p>
                                        @endif
                                        @error('referralName')
                                        <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="register-heading">
                            Personal Details
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-3">
                                <label for="firstNameField" class="control-label">First Name</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-user"></span>
                                        </a></span>
                                    <input name="firstName" type="text" id="firstNameField" class="form-control" placeholder="" value="{{old('firstName')}}">
                                    <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                @error('firstName')
                                <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-3">
                                <label for="lastNameField" class="control-label">Last Name</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-user"></span>
                                        </a></span>
                                    <input name="lastName" type="text" id="lastNameField" class="form-control" placeholder="" value="{{old('lastName')}}">
                                    <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="help-block with-errors">
                                    @error('lastName')
                                    <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-3">
                                <label for="phoneNumberField" class="control-label">Phone Number</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="hidden" id="phoneCodeField" name="phoneCode" value="+234">
                                    <span class="input-group-btn"><a id="phoneCode" class="btn btn-primary">
                                            +234
                                        </a></span>
                                    <input value="{{old('phoneNumber')}}" name="phoneNumber" type="number" id="phoneNumberField" class="form-control" placeholder="">
                                    <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="help-block with-errors">
                                    @error('phoneNumber')
                                    <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-3">
                                <label for="emailField" class="control-label">Email Address</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-envelope"></span>
                                        </a></span>
                                    <input name="email" type="text" id="emailField" class="form-control" placeholder="" value="{{old('email')}}">
                                    <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="help-block with-errors">
                                    @error('email')
                                    <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="register-heading">
                            Account Details
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-3">
                                <label for="userNameField" class="control-label">Username</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-user"></span>
                                        </a></span>
                                    <input name="userName" type="text" id="userNameField" class="form-control" placeholder="" value="{{old('userName')}}">
                                    <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="help-block with-errors">
                                    @error('userName')
                                    <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-3">
                                <label for="passwordField" class="control-label">Password</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-lock"></span>
                                        </a></span>
                                    <input name="password" type="password" id="passwordField" class="form-control" placeholder="" value="">
                                    <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="help-block with-errors">
                                    @error('password')
                                    <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-3">
                                <label for="confirmPasswordField" class="control-label">Confirm Password</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-lock"></span>
                                        </a></span>
                                    <input name="confirmPassword" type="password" id="confirmPasswordField" class="form-control" placeholder="" value="">
                                    <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="help-block with-errors">
                                    @error('confirmPassword')
                                    <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- <div class="form-group has-feedback">
                            <div class="col-sm-3">
                                <label for="transactionPasswordField" class="control-label">Transaction Pin (4 digits)</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-lock"></span>
                                        </a></span>
                                    <input name="transactionPassword" type="password" id="transactionPasswordField" class="form-control" placeholder="" value="">
                                    <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="help-block with-errors">
                                    @error('transactionPassword')
                                    <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div> -->
                        <!-- <div class="form-group has-feedback">
                            <div class="col-sm-3">
                                <label for="confirmTransactionPasswordField" class="control-label">Confirm Transaction Pin</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-lock"></span>
                                        </a></span>
                                    <input name="confirmTransactionPassword" type="password" id="confirmTransactionPasswordField" class="form-control" placeholder="" value="">
                                    <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="help-block with-errors">
                                    @error('confirmTransactionPassword')
                                    <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div> -->
                        <div style="margin-bottom: 5px;" class="form-group">
                            <div class="col-sm-offset-3">
                                <div class="checkbox">
                                    <label style="text-align: left; text-transform: none;">
                                        <input style="height: auto;" name="terms" id="termCheck" type="checkbox">I have accepted Paulano Graceland's <a href="/terms">Terms and Conditions</a>
                                    </label>
                                </div>
                                <div class="help-block with-errors">
                                    @error('terms')
                                    <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div style="margin-bottom: 0" class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <input type="hidden" id="ajaxSubmit" name="ajaxSubmit" value="0">
                                <input type="submit" value="SUBMIT" class="btn btn-primary">
                                <input type="reset" value="RESET" class="btn btn-primary">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="<?php echo url("js/main-validator.js") ?>"></script>
<script>
    var validatereferralUrl = "<?php echo url("auth/validate_referral") ?>";
    var csrf_token = "{{csrf_token()}}"
</script>
<script src="<?php echo url("js/register-validate.js") ?>"></script>
<script>
    $("#countryField").on("change", function(e) {
        var option = $(this).find(':selected').attr("data-code");
        $("#phoneCode").html(option);
        $("#phoneCodeField").val(option);
    });

    function changePhoneCode() {

    }
</script>
@stop
