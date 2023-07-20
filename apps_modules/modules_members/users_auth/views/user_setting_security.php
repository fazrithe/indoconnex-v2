<?php $this->load->view($template['partials_sidebar_setting']); ?>
        <!-- Page Content  -->
<div class="row">
    <div class="col-7 mx-auto px-0 mt-4">
    <?php if(!empty($users->password)){ ?>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <div class="card mb-3 text-primary" >
                    <div class="card-body">
                        <h5 class="card-title">Security</h5>
                        <h7 class="card-subtitle mb-2 text-muted">Where you’re logged in</h7>
                        <hr>
                        <form action="<?php echo current_url(); ?>" method="post">
                        <?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
                        <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

                        <?php foreach($user_session as $value){
                            echo "
                            <input type='hidden' name='ip_address' value=' <?php echo $value->ip_address ?>'>
                            <div class='row mb-3 justify-content-center'>
                                <div class='col-1'>";
                                ?>
                                    <img src="<?php echo theme_user_locations(); ?>images/icons/laptop.png">
                                <?php echo "
                                </div>
                                <div class='col-10'>
                                    <div class='row'>
                                        <div class='col-8'>
                                        <span>$value->browser_name. $value->ip_address</span>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-8'>
                                        <span class='text-muted'><small>$value->devices_name . ".devices_status($value->status)."</small></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ";
                        } ?>
                        <div class="mb-3 d-grid">
                        <input type="submit" class="btn btn-danger" value="Log Out of All Session">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                 <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success" role="alert">
                    <p class="text-primary"><?php echo $this->session->flashdata('success'); ?></p>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-success" role="alert">
                <p class="text-danger"><?php echo $this->session->flashdata('error'); ?></p>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                <div id="pass_success"></div>
                <div id="pass_error"></div>
                <div class="card mb-3 text-primary" >
                <form action="<?php echo site_url('user/security/update');?>" method="post" role="form" enctype="multipart/form-data">
                    <div class="card-body">
                        <h5 class="card-title">Login</h5>
                        <h7 class="card-subtitle mb-2 text-muted">Change Password</h7>
                        <hr>
                        <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                        <input type="hidden" name="user_id" value="<?php echo $users->id ?>" />
                        <?php if(!empty($users->password)){ ?>
                        <div class="mb-3">
                            <label class="form-label">Old Password</label>
                            <input type="password" name="old_pass" id="old_pass" class="form-control" placeholder="******" autofocus>
                        </div>
                        <?php } ?>
                        <?php if(empty($users->password)){ ?>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" id="username" onKeyPress="return angkadanhuruf(event,'abcdefghijklmnopqrstuwvxyz0123456789',this)" class="form-control input-text" placeholder="username" required autofocus>
                        </div>
                        <?php } ?>
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
                            <input type="password" name="confirm_pass" id="confirm_pass" class="form-control" placeholder="******" required autofocus>
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
<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>

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
