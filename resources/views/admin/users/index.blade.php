@extends("layouts.admin_overview")


@section("user_content")
<div class="user-content">
    <div class="container">
        @include("subviews.show_users_count")
        <div class="user-data row">
            <div class="user-main-container col-sm-12">
                <div class="list-group">
                    <div class="list-group-item active">
                        <h4 style="text-transform: uppercase; display: inline-block" class="list-group-item-heading">
                            {{$title}}( <?php echo $usercount; ?>)
                        </h4>
                        <div style="width: 300px;" class="pull-right">
                            <form method="get" action="" class="" role="form">
                                <div class="input-group">
                                    <input name="username" type="text" class="form-control" placeholder="Search {{$title}}" value="<?php echo (isset($username)) ? "$username" : "" ?>">
                                    <span class="input-group-btn"><button type="submit" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button></span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="list-heading list-group-item <?php ($usercount == 0) ? 'hidden' : ''; ?>">
                        @include("subviews.show-users")
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop