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
                                        MY DOWNLINES (<?php echo $downlinecount;  ?>)
                                    </h4>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="table-search" placeholder="Search...">
                                </div>
                            </div></div>


                        <div class="list-heading list-group-item">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Username</th>
                                        <th>Phone No.</th>
                                        <th>Date Joined</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <?php if( $downlinecount == 0 ) : ?>
                                    <tbody>
                                    </tbody>
                                        <?php else : ?>
                                        <tbody>
                                                    <?php foreach($downlines as $key => $downline) : ?>
                                                        <tr>
                                                            <td> <?php echo $key + 1; ?> </td>
                                                            <td><?php echo $downline->userName ?></td>
                                                            <td><?php echo $downline->phoneNumber  ?></td>
                                                            <td><?php echo date("F d, Y", strtotime($downline->userEntranceDate)) ?></td>
                                                            <td><?php echo ($downline->status == App\Models\User::$USER_PENDING) ? '<p class="label label-warning">Pending</p>' : '<p class="label label-success">Activated</p>'?> </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                            </table>
                        </div>


                        <div class="text-center">
                            <?php echo $downlines->links('vendor.pagination.bootstrap-4'); ?>
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
