@extends("layouts.user_overview")

@section("user_content")
<div class="user-content">
<div class="container">
<div class="user-data row">
<div class="login-container">
<div class="login-form-div">


<nav>
<ul class="nav nav-tabs">
<li><a  href="{{ route("user_settings") }}">Personal Information</a></li>
<li class="active"><a  href="{{ route("user_change_password")}}">Change Password</a></li>
<li><a  href="{{ route("user_change_pin")}}">Transaction Pin</a></li>
</ul>
</nav>

<div class="tab-content">


<div id="#" class="tab-pane fade in active">
<div class="user-main-container col-ms-12">
<div class="list-group">
<div class="list-group-item active">
    <h4 style="text-transform: uppercase" class="list-group-item-heading">
       Change Password
    </h4>
</div>
<div class="list-group-item">
    <form action="{{ route('password_update_account' )}}" method="post">
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
            <div class="col-sm-6">
                <label for="password" class="control-label">Password</label>
                <div class="input-group">
                    <span class="input-group-btn"><a type="button"
                                                    class="btn btn-primary">
                        <span class="fa fa-lock"></span>
                    </a></span>
                    <input name="password"
                            type="password" id="password"
                            class="form-control" placeholder="">
                    <span class="form-control-feedback glyphicon"
                            aria-hidden="true"></span>
                </div>

                <label for="password" class="control-label">Password</label>
                <div class="input-group">
                    <span class="input-group-btn"><a type="button"
                                                    class="btn btn-primary">
                        <span class="fa fa-lock"></span>
                    </a></span>
                    <input name="confirm_password"
                            type="password" id="confirm_password"
                            class="form-control" placeholder="">
                    <span class="form-control-feedback glyphicon"
                            aria-hidden="true"></span>
                </div>

            </div>


        </div>
            <br>
        <div class="row">
            <div class="col-sm-3">
                <div style="margin-bottom: 0" class="form-group">
                    <div class="flex">
                        <input type="submit" value="CHANGE PASSWORD" class="btn btn-primary btn-block">
                    </div>
                    <div class="clearfix"></div>
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
</div>
</div>
</div>
</div>
</div>
</div>
@include('js.index')
@stop
