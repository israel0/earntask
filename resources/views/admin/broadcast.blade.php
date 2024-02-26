@extends("layouts.admin_overview")
@section("user_content")
<div class="user-content">
    <div class="container">
        <div class="user-data row">
            <div class="login-container">
                <div class="login-form-div">
                    <div class="user-main-container col-ms-12">
                        <div class="list-group">

                            <div class="list-group-item">
                                <form action="{{ route("update-boardcast") }}" method="post" class="login-form spec" style="padding-top: 1em" role="form">
                                    @csrf
                                    @if(session('error'))
                                    <div style="margin-bottom: 1rem;" class="label label-danger">
                                        {{ session('error') }}
                                    </div>
                                    @endif
                                    @if(session('success'))
                                    <div style="margin-bottom: 1rem;" class="label label-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label for="reviewField" class="control-label">Title</label>
                                        </div>
                                        <div class="col-sm-6">

                                            <div class="input-group">
                                                <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                                        <span class="glyphicon glyphicon-dollar"></span>
                                                    </a></span>
                                                <input name="title" type="text" id="title" class="form-control" placeholder="" value="ANNOUCEMENT">
                                                <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <input name="display_status" value="1" type="checkbox" class="btn btn-primary">
                                            <label for="display_status" class="control-label">Show Message</label>
                                            <div>
                                                @error('display_status')
                                                <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <br>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label for="reviewField" class="control-label">Enter Message</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <div style="width: 100%" class="input-group">
                                                <textarea name="content" id="reviewField" class="form-control" rows="4"></textarea>
                                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div style="margin-bottom: 0" class="form-group">
                                                <div class="flex">
                                                    <input type="submit" value="SEND BROADCAST" class="btn btn-primary btn-block">
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            @error('content')
                                            <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="clearfix"></div>
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

<script>
    CKEDITOR.replace('editor');
</script>

@include('js.index')
@stop