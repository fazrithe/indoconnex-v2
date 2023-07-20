<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo 'Indoconnex - ' . $users->name_first . ' ' . $users->name_middle . ' ' . $users->name_last; ?></title>

    <meta name="description" content=""/>
    <meta name="author" content="IndoConnex"/>

    <!-- Open Graph data -->
    <meta property="og:title" content=""/>
    <meta property="og:url" content="<?php echo current_url() ?>"/>
    <meta property="og:type" content=""/>
    <meta property="og:description" content="1200 pixels x 627 pixels | Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam">
    <meta property="og:image" content="./themes/default/images/global/meta-images.jpg"/>

    <!-- Twitter Card -->
    <meta property="twitter:card" content=""/>
    <meta property="twitter:title" content=""/>
    <meta property="twitter:description" content=""/>
    <meta property="twitter:url" content="<?php echo current_url() ?>"/>
    <meta property="twitter:image" content=""/>

    <!-- Bar Color : Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#000000">
    <!-- Bar Color : iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000000">
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
   <div class="bg-login d-flex">
        <div class="col-xs-12 col-sm-8 col-md-4 mx-auto my-5">
            <?php if ($this->session->flashdata('error') != '') { ?>
                <div class="alert alert-danger ">
                    <span>
                        <?php echo $this->session->flashdata('error'); ?>
                    </span>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('success') != '') { ?>
                <div class="alert alert-success text-center">
                    <span>
                        <?php echo $this->session->flashdata('success'); ?>
                    </span>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <div class="card mb-3 card-login rounded-3">
                <div class="card-header bg-primary text-white p-4 fw-bold">Reset Password</div>
                <div class="card-body text-black fs-12 p-4">
                    <form action="<?php echo site_url('user/security/confirm');?>" method="post" role="form" enctype="multipart/form-data">
                            <div class="card-body">
                                <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                                <input type="hidden" name="user_id" value="<?php echo $users->id ?>" />
                                <input type="hidden" name="code" value="<?php echo $code ?>" />
                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="new_pass" id="new_pass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="******" required autofocus>
                                </div>
                                <div id="message">
                                        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                        <p id="number" class="invalid">A <b>number</b></p>
                                        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                    </div>
                                <div class="mb-3">
                                    <label class="form-label">Re-type Password</label>
                                    <input type="password" name="confirm_pass" id="confirm_pass" class="form-control" placeholder="******" required>
                                </div>
                                <div class="mb-3">
                                    <div class="g-recaptcha d-flex justify-content-center" data-sitekey="6LcDKpIcAAAAAC6nvq1LH7f8y6z1b2vz0qGRoDPp"></div>
                                </div>
                                <div class="mb-3 d-grid">
                                <input type="submit" class="btn btn-danger" value="Save Changes" id="btn" onclick="password('<?php echo $users->id ?>')">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view($template['action_ajax_profile']); ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <?php echo (!empty($FILE_JS)) ? $FILE_JS : ''; ?>
    <?php if (!empty($template['partials_footer_script_page'])) { ?>
    <?php $this->load->view($template['partials_footer_script_page']); ?>
    <?php } ?>
    <?php $this->load->view($template['partials_footer_script']); ?>
</body>
</html>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    var myInput = document.getElementById("new_pass");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");

    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
    }

    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if(myInput.value.match(lowerCaseLetters)) {
        letter.classList.remove("invalid");
        letter.classList.add("valid");
    } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if(myInput.value.match(upperCaseLetters)) {
        capital.classList.remove("invalid");
        capital.classList.add("valid");
    } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if(myInput.value.match(numbers)) {
        number.classList.remove("invalid");
        number.classList.add("valid");
    } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
    }

    // Validate length
    if(myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }
    }
</script>
