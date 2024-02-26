@extends("layouts.admin_overview")
@section("user_content")
<div class="user-content">
    <div class="container">
    <div class="user-data row">
        <div class="login-container">
            <div class="login-form-div">

                  <nav>
                    <ul class="nav nav-tabs">
                        <li ><a href="{{ url("admin/activation_codes") }}">General List</a></li>
                        <li class="active"><a href="{{ route("generate_code") }}">Generate Codes</a></li>
                        <li ><a  href="{{ route("send_code")}}">Send Codes</a></li>
                    </ul>
                  </nav>

                    <form action="{{  route("generate-activation-code") }}" method="post">
                        @csrf
                            <div class="user-main-container col-ms-12">
                                <div class="list-group">

                                   <br>
                                    @if($errors->any())
                                    <div style="margin-bottom: 1rem;" class="label label-danger">
                                    <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                    </div>
                                    @endif

                                    <div class="list-group-item">
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
                                                    <label for="reviewField" class="control-label">No. Of Activation Codes</label>
                                                </div>
                                                <div class="col-sm-6">
                                      <div class="input-group">
                                        <span class="input-group-btn"><a type="button"
                                                                        class="btn btn-primary">
                                            <span class="glyphicon glyphicon-cash"></span>
                                        </a></span>
                                        <input name="size" type="digit" id="size"
                                               class="form-control" placeholder="0"
                                               value="{{old('size')}}">
                                        <span class="form-control-feedback glyphicon"
                                              aria-hidden="true"></span>
                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                </div>
                                            </div>
<br>
                                <div class="row">
                                <div class="col-sm-2">
                                    <label for="reviewField" class="control-label">Select plan</label>
                                </div>
                                <div class="col-sm-6">




                                    <label for="genderField" class="control-label">Choose plan </label>
                                    <select value="{{old('plan')}}" name="plan" class="form-control"
                                            data-style="btn btn-primary" title="Withdraw From" id="withdrawTo">
                                        @foreach($plans as $plan)
                                          <option {{old("plan") == $plan->id ? 'selected' : ''}} value="{{ $plan->id }}"> {{ $plan->name }}{{ "(NGN ".$plan->registrationFee.")"}}  </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">

                                </div>
                                <div class="clearfix"></div>
                                </form>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-sm-2">

                                    </div>
                                    <div class="col-sm-3">
                                        <div style="margin-bottom: 0" class="form-group">
                                        <div class="flex">
                                                <input type="submit" value="GENERATE ACTIVATION CODE" class="btn btn-primary btn-block">
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
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

<!-- <script>
    CKEDITOR.replace('editor');
</script> -->

<!-- @include('js.index') -->
@stop


