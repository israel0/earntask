@extends("layouts.user_overview")

@section("user_content")
<br>
<div class="user-content">
    <div class="row">
        <div class="container">
            <div class="col-ms-12">
                <div class="login-container">
                    <div class="login-form-div">
                        <div class="list-group">

                            <div class="list-group-item active">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 style="text-transform: uppercase" class="list-group-item-heading">
                                            ACTIVATION CODES (<?php echo $activationCodecount;  ?>)
                                        </h4>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="table-search" placeholder="Search...">
                                    </div>
                                </div>
                            </div>


                            <div class="list-heading list-group-item">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Activation Codes</th>
                                            <th>plans</th>
                                            <th>Purchased User</th>
                                            <th>Activated User</th>
                                            <th>Date Purchased</th>
                                            <th>Date Used</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <?php if ($activationCodecount == 0) : ?>
                                        <tbody>
                                        </tbody>
                                    <?php else : ?>
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
                                                    <td><?php echo date("F d, Y", strtotime($activationCode->datePurchased)) ?></td>
                                                    <td><?php echo date("F d, Y", strtotime($activationCode->dateUsed)) ?> </td>
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
                                    <?php endif; ?>

                                </table>
                            </div>

                            <div class="text-center">
                                <?php echo $activationCodes->links('vendor.pagination.bootstrap-4'); ?>
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