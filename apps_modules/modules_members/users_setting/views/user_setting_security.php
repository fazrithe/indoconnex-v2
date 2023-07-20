<?php $this->load->view($template['partials_sidebar_setting']); ?>
        <!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0 mt-4">
        <div class="row d-flex">
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
					<div class="card-header bg-transparent border-0 pt-3 d-flex">
						<div class="flex-shrink-0 d-flex">
							<img src="<?php echo base_url()?>public/themes/user/images/icons/setting-login.svg" class="img-circle" alt="">
						</div>
						<div class="flex-grow-1 ms-2 d-flex flex-column">
							<span class="text-prussianblue fw-bold fs-16">Login</span>
							<span class="fs-12">Verification and Change Password.</span>
						</div>
					</div>
                    <form action="<?php echo current_url(); ?>" method="post" role="form" enctype="multipart/form-data">
                        <div class="card-body fs-12 text-black">
                            <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                            <input type="hidden" name="user_id" value="<?php echo $users->id ?>" />
                            <div class="mb-3">
                                <label class='form-label'>Old Password</label>
                                <input type="password" name="old_pass" id="old_pass" class="form-control form-control-sm" placeholder="******" >
                            </div>
                            <div class="mb-3">
                                <label class='form-label'>New Password</label>
                                <input type="password" name="new_pass" id="new_pass_1" class="form-control form-control-sm" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="******" required >
                            </div>
                            <div id="message">
                                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                <p id="number" class="invalid">A <b>number</b></p>
                                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Re-type Password</label>
                                <input type="password" name="confirm_pass" id="confirm_pass" class="form-control form-control-sm" placeholder="******" required >
                            </div>
                            <div class="mb-3 d-grid">
                            <input type="submit" class="btn btn-danger" value="Save Changes" id="btn" onclick="password('<?php echo $users->id ?>')">
                            </div>
                        </div>
                    </form>
                </div>
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
                    <form action="<?php echo base_url('setting/question') ?>" method="post" role="form" enctype="multipart/form-data">
                        <div class="card-body fs-12 text-black">
                            <h5 class="card-title">Security Question</h5>
                            <hr>
                            <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                            <input type="hidden" name="user_id" value="<?php echo $users->id ?>" />
                            <div class="mb-3">
                                <label class='form-label'>Security Question</label>
                                <input type="text" name="sec_quest" id="sec_quest" class="form-control form-control-sm" value="<?php if(!empty($question)){echo $question;} ?>" placeholder="My bestfriend name in the elementary school">
                            </div>
                            <div class="mb-3">
                                <label class='form-label'>Security Answer</label>
                                <input type="password" name="sec_answ" id="sec_answ" class="form-control form-control-sm" value=<?php if(!empty($answare)){echo $answare;} ?>" placeholder="John Smith" required>
                            </div>
                            <div class="mb-3 d-grid">
                            <input type="submit" class="btn btn-danger" value="Save Changes" id="btn">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-3 text-primary" >
					<div class="card-header bg-transparent border-0 pt-3 d-flex">
						<div class="flex-shrink-0 d-flex">
							<img src="<?php echo base_url()?>public/themes/user/images/icons/setting-security.svg" class="img-circle" alt="">
						</div>
						<div class="flex-grow-1 ms-2 d-flex flex-column">
							<span class="text-prussianblue fw-bold fs-16">Security</span>
							<span class="fs-12">Where you're logged in.</span>
						</div>
					</div>
                    <div class="card-body fs-12 text-black">
                        <form action="<?php echo base_url('setting/log/'.$users->id) ?>" method="post">
                            <?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
                            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                            <input type="hidden" name="id" value="<?php echo $users->id ?>">
                            <?php foreach($user_session as $value){?>
                                <input type='hidden' name='ip_address' value='<?php echo $value->ip_address ?>'>
                                <div class='d-flex align-items-center mb-3'>
                                    <div class='flex-shrink-0'>
                                        <img src="<?php echo theme_user_locations(); ?>images/icons/laptop.png">
                                    </div>
                                    <div class='flex-grow-1 ms-3 flex-column'>
                                        <span class="d-flex"><?php echo $value->browser_name. " " .$value->ip_address ?></span>
                                        <span class='text-muted d-flex'><small><?php echo $value->devices_name ?>, <span class="text-danger"><?php echo devices_status($value->status) ?></span></small></span>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="mb-3 d-grid">
                                <input type="submit" class="btn btn-danger" value="Log Out of All Session">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex">
        </div>
    </div>
</div>
<?php $this->load->view($template['partials_sidebar_ads']); ?>

<script>
    var myInput = document.getElementById("new_pass_1");
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
