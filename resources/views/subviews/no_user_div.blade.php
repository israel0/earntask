<?php
if (!isset($activeMenu)) {
    $activeMenu = INF;
}
?>
<div class="navbar-menu collapse navbar-collapse" id="navbar-collapse">
    <div class="navbar-right navbar-btn">
        <a href="<?php echo url("auth/register") ?>" class="btn btn-primary btn-lg">CREATE NEW ACCOUNT</a>
    </div>
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
        <li class="<?php echo ($activeMenu == 5) ? 'active' : ''; ?>"><a href="<?php echo url("auth/login"); ?>">MEMBER LOGIN</a></li>
    </ul>
    <div class="clearfix"></div>
</div>