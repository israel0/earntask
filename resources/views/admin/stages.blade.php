@extends("layouts.admin_overview")

@section("user_content")
<div class="user-content">
    <div class="container">
        <div class="stage-plans">
            <h5>Select a plan:</h5>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <?php echo $plan->name ?> plan <span class="fa fa-caret-down"></span>
                </button>
                <ul class="dropdown-menu">
                    <?php foreach ($plans as $pk) { ?>
                        <li><a href="<?php echo url("admin/stages/$pk->id/$stage_id") ?>"><?php echo $pk->name ?></a></li>
                        <div class="divider"></div>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="user-data row">
            <?php foreach ($stages as $stage) { ?>
                <div class="col-sm-6 col-lg-3">
                    <div class="user-box <?php echo $stage->stage_id == $stage_id ? "bg_active" : "" ?>">
                        <div class="inner">
                            <h3><?php
                                echo  App\Models\User::getTotalUserinStageandplan($plan->id, $stage->id); // $usercount;
                                ?></h3>
                            <p><?php echo $stage->rank ?> USERS</p>
                        </div>
                        <a class="small-box-footer" href="<?php echo url("admin/stages/$plan->id/$stage->stage_id") ?>">
                            View Users
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="user-data row">
            <div class="user-main-container col-sm-12">
                <div class="list-group">
                    <div class="list-group-item active">
                        <h4 style="text-transform: uppercase; display: inline-block" class="list-group-item-heading">
                            {{$userTitle}}( <?php echo $usercount; ?>)
                        </h4>
                        <div style="width: 300px;" class="pull-right">
                            <form method="get" action="" class="" role="form">
                                <div class="input-group">
                                    <input name="username" type="text" class="form-control" placeholder="Search {{$userTitle}}" value="<?php echo (isset($username)) ? "$username" : "" ?>">
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