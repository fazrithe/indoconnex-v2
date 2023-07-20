<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?php if(!empty($meta_position)){echo meta_login_name($meta_position);} ?></title>

	<meta name="description" content="<?php if(!empty($meta_position)){echo meta_login_description($meta_position);} ?>"/>
	<meta name="keywords" content="<?php if(!empty($meta_position)){echo meta_login_keyword($meta_position);} ?>">
	<meta name="author" content="IndoConnex"/>
	<!-- Control the behavior of search engine crawling and indexing -->
	<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
	<meta name="googlebot" content="index,follow"><!-- Google Specific -->

	<!-- Tells Google not to show the sitelinks search box -->
	<meta name="google" content="nositelinkssearchbox">

	<!-- Tells Google not to provide a translation for this document -->
	<meta name="google" content="notranslate">
	<meta itemprop="name" content="<?php if(!empty($meta_position)){echo meta_login_name($meta_position);} ?>">
	<meta itemprop="description" content="<?php if(!empty($meta_position)){echo meta_login_description($meta_position);} ?>">
	<meta itemprop="image" content="<?php if(!empty($meta_position)){echo meta_login_image($meta_position);} ?>">
	<!-- Open Graph data -->
	<meta property="og:title" content="<?php if(!empty($meta_position)){echo meta_login_name($meta_position);} ?>"/>
	<meta property="og:url" content=""/>
	<meta property="og:type" content=""/>
	<meta property="og:description" content="<?php if(!empty($meta_position)){echo meta_login_description($meta_position);} ?>"/>
	<meta property="og:image" content="<?php if(!empty($meta_position)){echo meta_login_image($meta_position);} ?>">

	<!-- Twitter Card -->
	<meta property="twitter:card" content=""/>
	<meta property="twitter:title" content="<?php if(!empty($meta_position)){echo meta_login_name($meta_position);} ?>"/>
	<meta property="twitter:description" content="<?php if(!empty($meta_position)){echo meta_login_description($meta_position);} ?>"/>
	<meta property="twitter:url" content=""/>
	<meta property="twitter:image" content="<?php if(!empty($meta_position)){echo meta_login_image($meta_position);} ?>"/>

    <!-- Bar Color : Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#000000">
    <!-- Bar Color : iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000000">
