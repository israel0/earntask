@extends("layouts.user_overview")

@section("user_content")
<div class="user-content">
<div class="container">
<div class="user-data row">
<div class="login-container">
<div class="login-form-div">


<nav>
<ul class="nav nav-tabs">
<li class="active"><a  href="{{ route("user_settings") }}">Personal Information</a></li>
<li><a  href="{{ route("user_change_password")}}">Change Password</a></li>
<li><a  href="{{ route("user_change_pin")}}">Transaction Pin</a></li>
</ul>
</nav>

<div class="tab-content">


<div id="home" class="tab-pane fade in active">
<div class="user-main-container col-ms-12">
<div class="list-group">

<div class="list-group-item active">
    <h4 style="text-transform: uppercase" class="list-group-item-heading">
                    PERSONAL INFORMATION
    </h4>
</div>

<div class="list-group-item">

<form action="{{ route('update_account')}}" method="post">
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
<div class="row">
    <div class="form-group has-feedback">
        <div class="col-sm-4">
            <label for="firstNameField" class="control-label">First Name</label>
            <div class="input-group">
                <span class="input-group-btn"><a type="button" class="btn btn-primary">
                        <span class="glyphicon glyphicon-user"></span>
                    </a></span>
                <input name="firstName" type="text" id="firstNameField" class="form-control" placeholder="" value="{{ $user->firstName }}">
                <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
            </div>
        </div>


        <div class="col-sm-4">
            <label for="lastNameField" class="control-label">Last Name</label>
            <div class="input-group">
                <span class="input-group-btn"><a type="button" class="btn btn-primary">
                        <span class="glyphicon glyphicon-user"></span>
                    </a></span>
                <input name="lastName" type="text" id="lastNameField" class="form-control" placeholder="" value="{{ $user->lastName }}">
                <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
            </div>

        </div>

        <div class="col-sm-4">

            <label for="lastNameField" class="control-label">MiddleName</label>
            <div class="input-group">
                <span class="input-group-btn"><a type="button" class="btn btn-primary">
                        <span class="glyphicon glyphicon-user"></span>
                    </a></span>
                <input name="middleName" type="text" id="lastNameField" class="form-control" placeholder="" value="{{ $user->middleName }}">
                <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
            </div>

        </div>
</div>
</div>

<div class="row">
<div class="form-group has-feedback">
    <div class="col-sm-4">
        <label for="firstNameField" class="control-label">Phone Number</label>
        <div class="input-group">
            <input type="hidden" id="phoneCodeField" name="phoneCode" value="+234">
            <span class="input-group-btn"><a id="phoneCode" class="btn btn-primary">
                    +234
                </a></span>
            <input value="{{ $user->phoneNumber }}" name="phoneNumber" type="number" id="phoneNumberField" class="form-control" placeholder="">
            <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
        </div>
    </div>


    <div class="col-sm-4">
        <label for="lastNameField" class="control-label">Email Address</label>
        <div class="input-group">
            <span class="input-group-btn"><a type="button" class="btn btn-primary">
                    <span class="glyphicon glyphicon-envelope"></span>
                </a></span>
            <input name="email" type="text" id="emailField" class="form-control" placeholder="" value="{{ $user->email }}">
            <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
        </div>
    </div>

    <div class="col-sm-4">
        <label for="lastNameField" class="control-label">Date of Birth</label>

        <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
            <input name="dob" type="text" id="dobField" placeholder="dd/mm/yy" class="form-control" value="{{ $user->dateOfBirth }}">
            <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
        </div>
    </div>
</div>
</div>

<div class="row">
    <div class="form-group has-feedback">
        <div class="col-sm-4">
            <label for="firstNameField" class="control-label">Gender</label>

                <select value="{{old('gender')}}" name="gender" class="form-control" data-style="btn btn-primary" title="Select Gender" id="genderField">
                    <option {{old("gender") === "Male" ? 'selected' : ''}}>Male</option>
                    <option {{old("gender") === "Female" ? 'selected' : ''}}>Female</option>
                </select>

        </div>


        <div class="col-sm-4">
            <label for="lastNameField" class="control-label">Address</label>
            <div class="input-group">
                <span class="input-group-btn"><a type="button" class="btn btn-primary">
                        <span class="glyphicon glyphicon-map-marker"></span>
                    </a></span>
                <input name="address" type="text" id="addressField" class="form-control" placeholder="" value="{{ $user->address}}">
                <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
            </div>
        </div>

        <div class="col-sm-4">
            <label for="lastNameField" class="control-label">State</label>
            <div class="input-group">
                <span class="input-group-btn"><a type="button" class="btn btn-primary">
                        <span class="glyphicon glyphicon-map-marker"></span>
                    </a></span>
                <input name="state" type="text" id="stateField" class="form-control" placeholder="" value="{{ $user->state }}">
                <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
            </div>
        </div>
</div>
</div>
</div>
<br>
<div class="list-group">
    <div class="list-group-item active">
        <h4 style="text-transform: uppercase" class="list-group-item-heading">
                    ACCOUNT INFORMATION
        </h4>
    </div>
    <div class="list-group-item">


    <div class="row">
        <div class="form-group has-feedback">

            <div class="col-sm-2">
                <label for="firstNameField" class="control-label">Username</label>
                <div class="input-group">
                    <p> <span class="badge bg-primary"></span>{{ $user->userName }} </span></p>
                </div>

            </div>

            <div class="col-sm-5">
                <label for="firstNameField" class="control-label">Password</label>
            <div class="input-group">
                <span class="input-group-btn"><a type="button" class="btn btn-primary">
                        <span class="glyphicon glyphicon-lock"></span>
                    </a></span>
                <input type="text" id="stateField" class="form-control" placeholder="" value="xxxx" readonly>
                <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
            </div>
            </div>

            <div class="col-sm-5">
                <label for="lastNameField" class="control-label">Transaction Pin</label>
                <div class="input-group">
                    <span class="input-group-btn"><a type="button" class="btn btn-primary">
                            <span class="glyphicon glyphicon-lock"></span>
                        </a></span>
                    <input type="text" id="stateField" class="form-control" placeholder="" value="xxxx" readonly>
                    <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
                </div>
            </div>

    </div>
</div>
</div>

    <div class="list-group-item active">
        <h4 style="text-transform: uppercase" class="list-group-item-heading">
                    BANK INFORMATION
        </h4>
    </div>
    <div class="list-group-item">

<div class="row">
    <div class="form-group has-feedback">
        <div class="col-sm-4">
            <label for="firstNameField" class="control-label">Bank Name</label>
            <div class="input-group">
                <span class="input-group-btn"><a type="button" class="btn btn-primary">
                        <span class="fa fa-bank"></span>
                    </a></span>
                <input value="{{ $user->bankName}}" name="bankName" type="text" id="bankNameField" class="form-control" placeholder="">
                <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
            </div>
        </div>


        <div class="col-sm-4">
            <label for="lastNameField" class="control-label">Account Name</label>
            <div class="input-group">
                <span class="input-group-btn"><a type="button" class="btn btn-primary">
                        <span class="fa fa-bank"></span>
                    </a></span>
                <input value="{{ $user->bankAccountName }}" name="bankAccountName" type="text" id="bankAccountNameField" class="form-control" placeholder="">
                <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
            </div>

        </div>

        <div class="col-sm-4">
            <label for="lastNameField" class="control-label">Account Number</label>
            <div class="input-group">
                <span class="input-group-btn"><a type="button" class="btn btn-primary">
                        <span class="fa fa-bank"></span>
                    </a></span>
                <input value="{{ $user->bankAccountNumber}}" name="bankAccountNumber" type="text" id="bankAccountNumberField" class="form-control" placeholder="">
                <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
            </div>
        </div>

</div>
</div>
<br>
<div class="row">
<div class="col-sm-4">
    <div style="margin-bottom: 0" class="form-group">
        <div class="flex">
            <input type="submit" value="SAVE" class="btn btn-primary btn-block">
            {{-- <input type="submit" value="RESET" class="btn btn-primary"> --}}
                </div>
        <div class="clearfix"></div>
    </div>
</div>
</div>

</div>
</div>
</form>
</div>
</div>
</div>


</div>
</div>
</div>
</div>
@include('js.index')
@stop
