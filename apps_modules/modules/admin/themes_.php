<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $template_title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <!--    <meta name="author" content="--><?php //echo $meta_author; ?><!--"/>-->
    <!--    <meta name="description" content="--><?php //echo $meta_description; ?><!--"/>-->
    <!--    <meta name="keywords" content="--><?php //echo $meta_keywords; ?><!--"/>-->

    <?php $this->load->view($template['partials_meta_css']); ?>
    <link rel="stylesheet" href="<?php echo theme_admin_locations(); ?>custom/css/custom.css?ver=<?php echo date('YmdHis'); ?>">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .main-sidebar {
            padding-top: 0;
        }
    </style>
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"/>
</head>
<body class="hold-transition skin-red sidebar-mini sidebar-collapse">
<div class="wrapper">
    <?php $this->load->view($template['partials_header']); ?>
    <?php $this->load->view($template['partials_sidebar']); ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1 class="text-bold"><?php echo $template_title_module; ?></h1>
            <?php if (!empty($template_breadcrumb)) { ?>
                <ol class="breadcrumb">
                    <?php foreach ($template_breadcrumb as $index => $row) { ?>
                        <?php if ($row['link'] == '') { ?>
                            <li class="<?php echo (!empty($row['active'])) ? 'active' : ''; ?>"><?php echo $row['title']; ?></li>
                        <?php } else { ?>
                            <li class="<?php echo (!empty($row['active'])) ? 'active' : ''; ?>"><a href="<?php echo $row['link']; ?>"><?php echo $row['title']; ?></a></li>
                        <?php } ?>
                    <?php } ?>
                </ol>
            <?php } ?>
        </section>
        <section class="content container-fluid">
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

            <?php $this->load->view($template['page_content']); ?>
        </section>
    </div>
    <?php $this->load->view($template['partials_footer']); ?>
</div>
<?php $this->load->view($template['partials_footer_script']); ?>
<?php echo (!empty($FILE_JS)) ? $FILE_JS : ''; ?>
<?php if (!empty($template['partials_footer_script_page'])) { ?>
<!--    --><?php //$this->load->view($template['partials_footer_script_page']); ?>
    <script type="text/javascript" src="<?php echo "{$template['partials_global']}{$template['partials_view']}{$template['partials_footer_script_page']}"; ?>.js"></script>
<?php } ?>
</body>
</html>
