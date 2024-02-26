<?php

use App\Models\Message;
use App\Models\Notification;

$user = auth()->user();
$username = $user->userName;
$notification_count = Notification::where("userName", $user->userName)->where("status", 0)->get()->count();
$message_count = Message::where("receiver", $user->userName)->where("status", 0)->get()->count();
?>
<div class="header">
    <div id="main-navbar" class="navbar navbar-default">
        <div class="">
            <div class="navbar-header">
                <div class="title navbar-brand">
                    <p>MY BACKOFFICE</p>
                    <a href="<?php echo url("") ?>"><?php echo $title ?></a>
                </div>
                <input type="checkbox" id="navbar-toggle-cbox">
                <label id="menu-toggle" for="navbar-toggle-cbox" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </label>
            </div>
            <div id="navbar-collapse" class="navbar-menu collapse navbar-collapse hidden-xs">
                <ul class="nav navbar-nav navbar-right hidden-xs">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="<?php echo url("user"); ?>">
                            <span class="fa fa-user"></span> Welcome, <?php echo strtoupper($username) ?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo url("user/settings"); ?>">Account Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo url("user/settings/change_password"); ?>">Change Password</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo url("user/settings/change_picture"); ?>">Change Profile Picture</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo url("user/notifications"); ?>"><span class="fa fa-bell"></span> <sup class="notification badge <?php echo ($notification_count == 0) ? "hidden" : "" ?>"><?php echo $notification_count ?></sup></a></li>
                    <li><a href="<?php echo url("help"); ?>"><span class="fa fa-envelope"></span> <sup class="notification badge <?php echo ($message_count == 0) ? "hidden" : "" ?>"><?php echo $message_count ?></sup></a></li>
                    <li class="hidden-sm"><a href="<?php echo url("auth/register"); ?>">New Registration</a></li>
                    <li class="hidden-sm"><a href="<?php echo url("auth/logout"); ?>">Sign Out</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right visible-xs">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="<?php echo url("user"); ?>" data-toggle="dropdown">
                            <span class="fa fa-user"></span>Welcome, <?php echo strtoupper($username) ?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo url("user/settings"); ?>">Account Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo url("user/settings/change_picture"); ?>">Change Profile Picture</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo url("auth/logout"); ?>">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>