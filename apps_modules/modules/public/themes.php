<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title><?php //echo meta_public_name($meta_position); ?></title> -->
    <?php if (config('title')) { ?>
    <title><?php echo APP_NAME . ' - ' . config('title') ?></title>
    <?php } else { ?>
    <title><?php echo APP_NAME ?></title>
    <?php } ?>

    <meta name="description" content="<?php echo meta_public_description($meta_position,$meta_type); ?>"/>
    <meta name="keywords" content="<?php echo meta_public_keyword($meta_position); ?>">
    <meta name="author" content="IndoConnex"/>
	<!-- Control the behavior of search engine crawling and indexing -->
	<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
	<!-- <meta name="robots" content="noindex,nofollow"> -->
	<!-- All Search Engines -->
	<meta name="googlebot" content="index, follow"><!-- Google Specific -->

	<!-- Tells Google not to show the sitelinks search box -->
	<meta name="google" content="nositelinkssearchbox">

	<!-- Tells Google not to provide a translation for this document -->
	<meta name="google" content="notranslate">
    <meta itemprop="name" content="<?php echo meta_public_title($meta_position,$meta_type); ?>">
    <meta itemprop="description" content="<?php echo meta_public_description($meta_position,$meta_type); ?>">
    <meta itemprop="image" content="<?php echo meta_public_image($meta_position,$meta_type); ?>">
	<!-- Open Graph data -->
    <meta property="og:title" content="<?php echo meta_public_title($meta_position,$meta_type); ?>"/>
    <meta property="og:url" content=""/>
    <meta property="og:type" content=""/>
    <meta property="og:description" content="<?php echo meta_public_description($meta_position,$meta_type); ?>"/>
    <meta property="og:image" content="<?php echo meta_public_image($meta_position,$meta_type); ?>">
    
    <!-- Twitter Card -->
    <meta property="twitter:card" content=""/>
    <meta property="twitter:title" content="<?php echo meta_public_title($meta_position,$meta_type); ?>"/>
    <meta property="twitter:description" content="<?php echo meta_public_description($meta_position,$meta_type); ?>"/>
    <meta property="twitter:url" content=""/>
    <meta property="twitter:image" content="<?php echo meta_public_image($meta_position,$meta_type); ?>"/>

    <!-- Bar Color : Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#000000">
    <!-- Bar Color : iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000000">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<!-- ****** begin favicons ****** -->
	<link rel="apple-touch-icon" sizes="192x192" href="<?php echo theme_user_locations(); ?>images/favicons/apple-icon.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo theme_user_locations(); ?>images/favicons/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="96x96"  href="<?php echo theme_user_locations(); ?>images/favicons/android-icon-96x96.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo theme_user_locations(); ?>images/favicons/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo theme_user_locations(); ?>images/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo theme_user_locations(); ?>images/favicons/favicon-96x96.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo theme_user_locations(); ?>images/favicons/ms-icon-310x310.png">
	<meta name="theme-color" content="#ffffff">
	<!-- ****** end favicons ****** -->

	<?php $this->load->view($template['partials_meta_css']); ?>
</head>
<body id="app">
<p id="demo"></p>
    <?php $this->load->view($template['partials_header']);?>
    <?php $this->load->view($template['page_content']); ?>
	<div class="wrapperanimate">
        <!-- <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="shadow"></div>
        <div class="shadow"></div>
        <div class="shadow"></div>
        <span>Indoconnex</span> -->
		<div id="icon-container"></div>
    </div>
	<?php $this->load->view($template['partials_footer']); ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <?php $this->load->view($template['partials_footer_script']); ?>
    <?php echo (!empty($FILE_JS)) ? $FILE_JS : ''; ?>
    <?php if (!empty($template['partials_footer_script_page'])) { ?>
    <?php $this->load->view($template['partials_footer_script_page']); ?>
    <?php } ?>
    
    <script async src="//static.getclicky.com/101348150.js"></script>
    <noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/101348150ns.gif" /></p></noscript>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
	<script>
		var animation = bodymovin.loadAnimation({
		container: document.getElementById('icon-container'), // required
		path: '<?php echo theme_user_locations(); ?>diagram.json', // required
		renderer: 'svg', // required
		loop: true, // optional
		autoplay: true, // optional
		name: "Animation", // optional
	});
	</script>
</body>
</html>
