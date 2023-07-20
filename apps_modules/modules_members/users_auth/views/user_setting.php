<?php $this->load->view($template['partials_sidebar_setting']); ?>
<!-- Page Content  -->
<div id="content">
    <div class="row">
        <div class="col-sm pt-4 bg-indoconnex">
            <div class="row d-flex align-text-center">
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('success'); ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('error'); ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-6">
                    <div class="card mb-3 text-primary" >
                        <div class="card-header fw-bold">Account</div>
                            <div class="card-body">
                            <form action="<?php echo current_url(); ?>" method="post">
                            <?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
                            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
                            <div class="mb-3">
                                <label class="form-label" for="inputEmail">Display Name</label>
                                <input type="text" name="name_full" id="inputName" class="form-control" value="<?php echo $users->name_full ?>" placeholder="Display Name" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="inputEmail">Usernam</label>
                                <input type="text" name="username" id="inputUsername"  class="form-control" value="<?php echo $users->username ?>" placeholder="@username" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="inputEmail">Email</label>
                                <input type="email" name="email" id="inputEmail" class="form-control" value="<?php echo $users->email ?>" placeholder="Email address" required autofocus>
                            </div>
                            <div class="mb-3">
                            <input type="submit" class="btn btn-danger" value="Save Changes">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-6">
                    <div class="card mb-3 text-primary" >
                        <div class="card-header fw-bold">Contact Info</div>
                            <div class="card-body text-black">
                            <form action="<?php echo current_url(); ?>" method="post">
                            <?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
                            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
                                <button class="btn btn-sm btn-outline-secondary float-right" id="btn-reset-form"><span class="material-icons">delete</span> Remove</button>
                                <br>
                                <?php
                                    if($users->data_contact_info == null){
                                        echo "
                                        <div class='mb-3'>
                                            <label class='form-label' for='inputEmail'>Email</label>
                                            <input type='email' name='email[]' value='' id='inputEmail' class='form-control' placeholder='Email address' required autofocus>
                                        </div>
                                        <div class='mb-3'>
                                            <label class='form-label' for='inputEmail'>Phone Number</label>
                                            <input type='number' name='phone[]' value='' id='inputPhoneNumber' class='form-control' placeholder='+62 801xxxx' required autofocus>
                                        </div>";
                                    }else{

                                    if(!empty($users->data_contact_info)){
                                    $result = json_decode($users->data_contact_info);
                                    foreach($result as $value){

                                        echo "
                                        <div class='mb-3'>
                                            <label class='form-label' for='inputEmail'>Email</label>
                                            <input type='email' name='email[]' value='$value->email_contact' id='inputEmail' class='form-control' placeholder='Email address' required autofocus>
                                        </div>
                                        <div class='mb-3'>
                                            <label class='form-label' for='inputEmail'>Phone Number</label>
                                            <input type='number' name='phone[]' value='$value->phone_contact' id='inputPhoneNumber' class='form-control' placeholder='+62 801xxxx' required autofocus>
                                        </div>";
                                        }
                                    }
                                    }
                                ?>
                                <div id="insert-form"></div>
                                <div class="mb-3">
                                <span id="writeroot"></span>
                                <a href="#" class="btn btn-outline-secondary" id="btn-tambah-form" onclick="btnAdd()">Tambah Data Form</a>
                                </div>
                                <div class="mb-3">
                                <input type="submit" class="btn btn-danger" value="Save Changes">
                                </div>
                                </form>
                                <input type="hidden" id="jumlah-form" value="1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view($template['partials_sidebar_ads']); ?>
    </div>
</div>
<script>
  function btnAdd() {
      var jumlah = parseInt($("#jumlah-form").val());
      var nextform = jumlah + 1;

      $("#insert-form").append(
        "<button class='btn btn-sm btn-outline-secondary float-right' onclick='this.parentNode.parentNode.removeChild(this.parentNode);'><i class='fa fa-trash'></i> Remove</button>"+
        "<br>"+
        "<div class='mb-3'>"+
        "<label class='form-label' for='inputEmail'>Email</label>"+
        "<input type='email' name='email[]' id='inputEmail' class='form-control' placeholder='Email address' required autofocus>"+
        "</div>"+
        "<div class='mb-3'>"+
        "<label class='form-label' for='inputEmail'>Phone Number</label>"+
        "<input type='text' name='phone[]' id='inputPhoneNumber' class='form-control' placeholder='+62 801xxxx' required>"+
        "</div>");

      $("#jumlah-form").val(nextform);

    $("#btn-reset-form").click(function(){
      $("#insert-form").html("");
      $("#jumlah-form").val("1");
    });
  }
  </script>
