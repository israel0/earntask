<?php if ($usercount == 0) : ?>
    <p>No User found under this search query</p>
<?php else : ?>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Username</th>
                <th>Full Name</th>                
                <th>Phone No.</th>
                <th>Referer</th>
                <th>Upline</th>
                <th>plan</th>
                <th>Stage</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $key => $user) : ?>
                <tr>
                    <td><?php echo  $key + 1 //echo $key + 1 
                        ?>.</td>
                    <td><a href='<?php echo url("admin/view_user/$user->userName") ?>'><?php echo $user->userName; ?></a></td>
                    <td><?php echo $user->firstName . " " . $user->lastName; ?></td>
                    <td><?php echo $user->phoneNumber ?></td>
                    <td><a href='<?php echo url("admin/view_user/$user->upline") ?>'><?php echo $user->upline ?></a></td>
                    <td><a href='<?php echo url("admin/view_user/$user->referralName") ?>'><?php echo $user->referralName ?></a></td>
                    <td><?php
                        $plan = App\Models\plan::getplan($user->plan);
                        echo $plan->name;
                        ?></td>
                    <td><?php echo App\Models\Stage::getStage($user->stage)->rank; ?></td>
                    <td><?php if ($user->status == App\Models\User::$USER_PENDING) {
                            echo '<p class="label label-warning">Pending</p>';
                        } else if ($user->status == App\Models\User::$USER_ACTIVATED) {
                            echo '<p class="label label-success">Activated</p>';
                        } else if ($user->status == App\Models\User::$USER_SUSPENDED) {
                            echo '<p class="label label-danger">Suspended</p>';
                        } ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center">
        <?php echo $users->links('vendor.pagination.bootstrap-4'); ?>
    </div>
<?php endif; ?>