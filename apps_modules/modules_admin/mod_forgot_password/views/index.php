<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $apps_title_module; ?> | INDOCONNEX</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link type="text/css" rel="stylesheet" href="<?php echo theme_admin_locations(); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link type="text/css" rel="stylesheet" href="<?php echo theme_admin_locations(); ?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link type="text/css" rel="stylesheet" href="<?php echo theme_admin_locations(); ?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link type="text/css" rel="stylesheet" href="<?php echo theme_admin_locations(); ?>dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo base_url('mod_login'); ?>"><b><?php echo $apps_title_module; ?></b></a>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">

        <?php if ($this->session->flashdata('output_error') != '') { ?>
            <div class="callout callout-danger">
                <h4><?php echo ($this->session->flashdata('output_error_title') != '') ? $this->session->flashdata('output_error_title') : 'Error'; ?></h4>
                <p><?php echo $this->session->flashdata('output_error'); ?></p>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('output_success') != '') { ?>
            <div class="callout callout-success">
                <h4><?php echo ($this->session->flashdata('output_success_title') != '') ? $this->session->flashdata('output_success_title') : 'Error'; ?></h4>
                <p><?php echo $this->session->flashdata('output_success'); ?></p>
            </div>
        <?php } ?>

        <form action="<?php echo current_url(); ?>" method="post">
            <?php echo form_hidden(generate_csrf_nonce('mod_forgot_password')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <div class="form-group has-feedback">
                <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>

            <br/>
            <a href="<?php echo base_url('mod_login'); ?>"">Back to login</a>

        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="<?php echo theme_admin_locations(); ?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo theme_admin_locations(); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
