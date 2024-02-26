<?php

use App\Models\Message;
use App\Models\Notification;

if (!isset($adminMenu)) $adminMenu = 1;
$user = auth()->user();
?>
<div class="sidebar">
    <div class="main-title">
        <a class="visible-xs" style="position: absolute;left: 10px; top: 15px; color: #fff" href="#"><span id="close-menu" class="fa fa-times fa-2x"></span></a>
        <img class="top-logo" src="<?php echo url("images/logo_vertical.jpg") ?>">
    </div>
    <ul class="nav nav-pills nav-stacked">
        <li class="<?php echo ($adminMenu == 1) ? "active" : ""; ?>"><a href="<?php echo url("admin"); ?>"><span class="fa fa-dashboard"></span> Users</a></li>
        <li class="<?php echo ($adminMenu == 2) ? "active" : ""; ?>"><a href="<?php echo route('admin_stages', ['plan' => 1, 'stage_id' => 0]) ?>"><span class="fa fa-users"></span> plans & Stages</a></li>
        <li class="<?php echo ($adminMenu == 3) ? "active" : ""; ?>"><a href="<?php echo route("admin_activation_codes"); ?>"><span class="fa fa-lock"></span> Activation Codes</a></li>
        <li class="<?php echo ($adminMenu == 4) ? "active" : ""; ?>"><a href="<?php echo url("admin/withdrawals"); ?>"><span class="fa fa-money"></span> Withdrawals</a></li>
        <li class="<?php echo ($adminMenu == 5) ? "active" : ""; ?>"><a href="<?php echo url("admin/broadcast"); ?>"><span class="fa fa-bell"></span> Send Broadcast</a></li>
        <li><a href="<?php echo url("auth/logout"); ?>"><span class="fa fa-power-off"></span> Logout</a></li>
    </ul>
    <div class="admin-menu"><a class="btn btn-dark btn-block" href="<?php echo url("user"); ?>"><span class="fa fa-users"></span> Back to User Dashboard</a></div>
</div>