<header class="main-header">
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <?php
                    $user_login_id   = func_decrypt($_SESSION[SESSION_LOGAPPS]['app_id']);
                    $user_login_name = func_decrypt($_SESSION[SESSION_LOGAPPS]['app_user_name']);
                    ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <div class="cust"><?php echo $user_login_name; ?> <span class="caret"></span></div>
                    </a>
                    <ul class="dropdown-menu custom-navbar" role="menu">
                        <li><a href="<?php echo base_url('mod_operators'); ?>"><i class="fa fa-users"></i> List Operator</a></li>
                        <li><a href="<?php echo base_url("mod_operators/edit/{$user_login_id}"); ?>"><i class="fa fa-user-circle-o"></i> Profil Anda</a></li>
                        <li><a href="<?php echo base_url('mod_logout'); ?>"><i class="fa fa-power-off"></i> Sign Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
