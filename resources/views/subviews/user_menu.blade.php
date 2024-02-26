<?php

use App\Models\Message;
use App\Models\Notification;

if (!isset($activeMenu)) $activeMenu = 1;
$user = auth()->user();
$notification_count = Notification::where("userName", $user->userName)->where("status", 0)->get()->count();
$message_count = Message::where("receiver", $user->userName)->where("status", 0)->get()->count();
?>
<div class="sidebar">
    <div class="main-title">
        <a class="visible-xs" style="position: absolute;left: 10px; top: 15px; color: #fff" href="#"><span id="close-menu" class="fa fa-times fa-2x"></span></a>
        <img class="top-logo" src="<?php echo url("images/logo_vertical.jpg") ?>">
    </div>
    <ul class="nav nav-pills nav-stacked">
        <li class="<?php echo ($activeMenu == 1) ? "active" : ""; ?>"><a href="<?php echo url("user/dashboard"); ?>"><span class="fa fa-dashboard"></span> Dashboard</a></li>
        <li class="<?php echo ($activeMenu == 2) ? "active" : ""; ?>"><a href="<?php echo url("user/settings/"); ?>"><span class="fa fa-user"></span> My Account</a></li>
        <li class="<?php echo ($activeMenu == 3) ? "active" : ""; ?>"><a href="<?php echo url("user/genealogy"); ?>"><span class="fa fa-bank"></span> Genealogy Tree</a></li>
        <li class="<?php echo ($activeMenu == 4) ? "active" : ""; ?>"><a href="<?php echo url("user/referrals"); ?>"><span class="fa fa-users"></span> My Referrals</a></li>
        <li class="<?php echo ($activeMenu == 5) ? "active" : ""; ?>"><a href="<?php echo url("user/downlines"); ?>"><span class="fa fa-users"></span> My Downlines</a></li>
        <li class="<?php echo ($activeMenu == 6) ? "active" : ""; ?>"><a href="<?php echo url("user/activation_codes"); ?>"><span class="fa fa-lock"></span> Activation Codes</a></li>
        <li class="<?php echo ($activeMenu == 7) ? "active" : ""; ?>"><a href="<?php echo url("user/transactions"); ?>"><span class="fa fa-history"></span> My Transactions</a></li>
        <li class="<?php echo ($activeMenu == 8) ? "active" : ""; ?>"><a href="<?php echo url("user/withdraw"); ?>"><span class="fa fa-money"></span> Withdraw</a></li>
        <li class="<?php echo ($activeMenu == 9) ? "active" : ""; ?>"><a href="<?php echo url("user/notifications"); ?>"><span class="fa fa-bell"></span><span style="font-size: 1em; background-color: #f00" class="badge pull-right <?php echo ($notification_count == 0) ? "hidden" : "" ?>"><?php echo $notification_count ?></span> Notifications</a></li>
        <li class="<?php echo ($activeMenu == 10) ? "active" : ""; ?>"><a href="<?php echo url("help"); ?>"><span class="fa fa-envelope"></span><span style="font-size: 1em; background-color: #f00" class="badge pull-right <?php echo ($message_count == 0) ? "hidden" : "" ?>"><?php echo $message_count ?></span> Contact Support</a></li>
        <li><a href="<?php echo url("auth/logout"); ?>"><span class="fa fa-power-off"></span> Logout</a></li>
    </ul>
    @if($user->is_admin)
    <div class="admin-menu"><a class="btn btn-dark btn-block" href="<?php echo url("admin"); ?>"><span class="fa fa-users"></span> Go to Admin Dashboard</a></div>
    @endif
</div>