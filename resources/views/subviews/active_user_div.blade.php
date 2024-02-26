<?php
if (!isset($activeMenu)) {
    $activeMenu = INF;
}
$username = null;
if (auth()->user()) {
    $username = auth()->user()->userName;
}
?>
<div class="navbar-menu collapse navbar-collapse" id="navbar-collapse">
    <ul class="nav navbar-nav navbar-right">
        <li class="<?php echo ($activeMenu == 1) ? 'active' : ''; ?>"><a href="<?php echo url("") ?>">HOME</a></li>
        <li class="<?php echo ($activeMenu == 2) ? 'active' : ''; ?> dropdown">
            <a href="<?php echo url("about_us") ?>" class="dropdown-toggle hidden-xs">
                ABOUT US <span class="fa fa-caret-down"></span>
            </a>
            <a href="<?php echo url("about_us") ?>" class="dropdown-toggle visible-xs" data-toggle="dropdown">
                ABOUT US <span class="fa fa-caret-down"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo url("about") ?>">About us</a></li>
                <li class="divider"></li>                
                <li><a href="<?php echo url("help") ?>">Contact Us</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo url("") ?>">Terms and Conditions</a></li>
            </ul>
        </li>
        <li class="<?php echo ($activeMenu == 3) ? 'active' : ''; ?>"><a href="<?php echo url("plan") ?>">COMPENSATION plan</a></li>
        <li class=""><a href="<?php echo url("invest") ?>">INVEST</a></li>        
        <li class="dropdown">
            <a class="dropdown-toggle hidden-xs" href="<?php echo url("user"); ?>">
                <span class="fa fa-user"></span> Welcome, <?php echo strtoupper($username) ?> <b class="caret"></b>
            </a>
            <a class="dropdown-toggle visible-xs" href="<?php echo url("user"); ?>" data-toggle="dropdown">
                <span class="fa fa-user"></span> Welcome, <?php echo strtoupper($username) ?> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo url("user"); ?>">Dashboard</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo url("user/settings"); ?>">Account Settings</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo url("auth/logout"); ?>">Logout</a></li>
            </ul>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>