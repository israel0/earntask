@extends("layouts.user_overview")

@section("user_content")
<div class="user-content">
<div class="container">
<div class="user-data row">
<div class="login-container">
<div class="login-form-div">


<div class="user-main-container col-ms-12">
<div class="list-group">

<div class="list-group-item active">
    <h4 style="text-transform: uppercase" class="list-group-item-heading">
       PROFILE PICTURE
    </h4>
</div>

<div class="list-group-item">

<form action="{{ route('update_picture')}}" method="post" enctype="multipart/form-data">
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
            <img width="200" style="border-radius: 1px" src="{{  ($user->photoUrl != null) ? asset('storage/' . $user->photoUrl) : asset("images/user0.png")}}" alt="">
        </div>

        <div class="col-sm-8">

            <label for="lastNameField" class="control-label">Change Profile Picture</label>
            <div class="input-group">
                <span class="input-group-btn"><a type="button" class="btn btn-primary">
                        <span class="glyphicon glyphicon-photo"></span>
                    </a></span>
                <input name="photoUrl" type="file"  class="form-control">
                <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
            </div>

            <br><br>
        </div>
        <div class="col-sm-4">
            <div style="margin-bottom: 0" class="form-group">
                <div class="flex">
                    <input type="submit" value="UPDATE PICTURE" class="btn btn-primary btn-block">
                        </div>
                <div class="clearfix"></div>
            </div>
        </div>
</div>
</div>

</div>
<br>

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
@include('js.index')
@stop
