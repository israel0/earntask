@extends("layouts.admin_overview")


@section("user_content")
<div class="user-content">
    <div class="container">

        <nav>
            <ul class="nav nav-tabs">

                <li class="active"><a href="{{ url("admin/activation_codes") }}">General List</a></li>
                <li><a href="{{ route("generate_code") }}">Generate Codes</a></li>
                <li><a href="{{ route("send_code")}}">Send Codes</a></li>
            </ul>
        </nav>

        <br>


        <div class="user-data row">
            <div class="col-sm-6 col-lg-3">
                <div class="user-box <?php echo $type == null ? "bg_active" : "" ?>">
                    <div class="inner">
                        <h3><?php
                            echo App\Models\ActivationCode::getTotalActivationCodes()
                            ?> </h3>
                        <p>All Activation Codes</p>
                    </div>
                    <a class="small-box-footer" href="<?php echo url("admin/activation_codes") ?>">
                        More Info
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="user-box <?php echo $type == "new" ? "bg_active" : "" ?>">
                    <div class="inner">
                        <h3><?php
                            echo App\Models\ActivationCode::getTotalActivationCodes(App\Models\ActivationCode::$ACTIVATION_GENERATED)
                            ?> </h3>
                        <p>New Activation Code</p>
                    </div>
                    <a class="small-box-footer" href="<?php echo url("admin/activation_codes/new") ?>">
                        More Info
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="user-box <?php echo $type == "purchased" ? "bg_active" : "" ?>">
                    <div class="inner">
                        <h3><?php
                            echo App\Models\ActivationCode::getTotalActivationCodes(App\Models\ActivationCode::$ACTIVATION_PURCHASED)
                            ?> </h3>
                        <p>Purchased Activation Code </p>
                    </div>
                    <a class="small-box-footer" href="<?php echo url("admin/activation_codes/purchased") ?>">
                        More Info
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="user-box <?php echo $type == "used" ? "bg_active" : "" ?>">
                    <div class="inner">
                        <h3><?php
                            echo App\Models\ActivationCode::getTotalActivationCodes(App\Models\ActivationCode::$ACTIVATION_USED)
                            ?> </h3>
                        <p>Used Activation Code</p>
                    </div>
                    <a class="small-box-footer" href="<?php echo url("admin/activation_codes/used") ?>">
                        More Info
                    </a>
                </div>
            </div>
        </div>

        <div class="user-data row">
            <div class="user-main-container col-sm-12">
                <div class="list-group">
                    <div class="list-group-item active">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 style="text-transform: uppercase" class="list-group-item-heading">
                                    {{$tableTitle}} (<?php echo $activationCodeCount;  ?>)
                                </h4>
                            </div>
                            <div class="col-md-4">
                                <form method="get" action="" class="" role="form">
                                    <input type="text" name="search" class="form-control" id="table-search" placeholder="Search {{$tableTitle}}" value="<?php echo (isset($search)) ? "$search" : "" ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="list-heading list-group-item">
                        <?php if ($activationCodeCount == 0) : ?>
                            <p>No Activation Codes under this search query</p>
                        <?php else : ?>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Activation Codes</th>
                                        <th>plans</th>
                                        <th>Purchased User</th>
                                        <th>Activated User</th>
                                        <th>Date Generated</th>
                                        <th>Date Purchased</th>
                                        <th>Date Used</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($activationCodes as $key => $activationCode) : ?>
                                        <tr>
                                            <td> <?php echo $key + 1; ?></td>
                                            <td><?php echo $activationCode->activationCode ?></td>
                                            <td><?php
                                                $plan = App\Models\plan::getplan($activationCode->plan);
                                                echo $plan->name;
                                                ?></td>
                                            <td><?php echo $activationCode->purchasedUser ?> </td>
                                            <td><?php echo $activationCode->activatedUser ?></td>
                                            <td><?php echo $activationCode->created_at ? date("F d, Y", strtotime($activationCode->created_at)) : "" ?></td>
                                            <td><?php echo $activationCode->datePurchased !== null ? date("F d, Y", strtotime($activationCode->datePurchased)) : "" ?></td>
                                            <td><?php echo $activationCode->dateUsed !== null ? date("F d, Y", strtotime($activationCode->dateUsed)) : "" ?> </td>
                                            <td><?php

                                                if ($activationCode->status == App\Models\ActivationCode::$ACTIVATION_GENERATED) {
                                                    echo  '<p class="label label-warning">Pending</p>';
                                                } elseif ($activationCode->status == App\Models\ActivationCode::$ACTIVATION_PURCHASED) {
                                                    echo '<p class="label label-info">Purchased</p>';
                                                } else {
                                                    echo '<p class="label label-success">Used</p>';
                                                }  ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                    <div class="text-center">
                        <?php echo $activationCodes->links('vendor.pagination.bootstrap-4'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop