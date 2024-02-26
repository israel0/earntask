<div class="user-data row">
    <div class="col-sm-6 col-lg-3">
        <div class="user-box <?php echo $status == null ? "bg_active" : "" ?>">
            <div class="inner">
                <h3><?php
                    echo App\Models\User::getTotalUsers()
                    ?> </h3>
                <p>All Users<?php  // strtoupper($plan->name) '' 
                            ?></p>
            </div>
            <a class="small-box-footer" href="<?php echo url("admin/users") ?>">
                More Info
            </a>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="user-box <?php echo $status == "pending" ? "bg_active" : "" ?>">
            <div class="inner">
                <h3><?php echo App\Models\User::countPendingUsers() ?></h3>
                <p>Pending Users</p>
            </div>
            <a class="small-box-footer" href="<?php echo url("admin/users/pending") ?>">
                More Info
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="user-box <?php echo $status == "active" ? "bg_active" : "" ?>">
            <div class="inner">
                <h3><?php echo App\Models\User::countActiveUsers() ?></h3>
                <p>Active Users</p>
            </div>
            <a class="small-box-footer" href="<?php echo url("admin/users/active") ?>">
                More Info
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="user-box <?php echo $status == "suspended" ? "bg_active" : "" ?>">
            <div class="inner">
                <h3><?php echo App\Models\User::countSuspendedUsers() ?></h3>
                <p>Suspended User</p>
            </div>
            <a class="small-box-footer" href="<?php echo url("admin/users/suspended") ?>">
                More Info
            </a>
        </div>
    </div>
</div>