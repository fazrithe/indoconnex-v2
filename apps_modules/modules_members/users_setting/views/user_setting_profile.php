<?php $this->load->view($template['partials_sidebar_setting']); ?>
        <!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0 mt-4">
        <div class="row">
            <div class="col-6">
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
                    <div class="card border-0 mb-3 text-prussianblue" >
                        <div class="card-header bg-transparent border-0 pt-3 d-flex">
                            <div class="flex-shrink-0 d-flex">
                                <img src="<?php echo base_url()?>public/themes/user/images/icons/setting-profile.svg" class="img-circle" alt="">
                            </div>
                            <div class="flex-grow-1 ms-2 d-flex flex-column">
                                <span class="text-prussianblue fw-bold fs-16">Edit Profile</span>
                                <span class="fs-12">Info you share to your profile.</span>
                            </div>
                        </div>
                        <div class="card-body fs-12 text-black">
                            <form action="<?php echo current_url(); ?>" method="post" role="form" enctype="multipart/form-data">
                            <?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
                            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
                            <div class="mb-3">
                                <label class='form-label' for="name_full">First Name</label>
                                <input type="text" name="name_first" id="inputName" class="form-control form-control-sm" value="<?php echo $users->name_first ?>" placeholder="First Name" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class='form-label' for="inputEmail">Middle Name</label>
                                <input type="text" name="name_middle" id="" class="form-control form-control-sm" value="<?php echo $users->name_middle ?>" placeholder="Middle Name">
                            </div>
                            <div class="mb-3">
                                <label class='form-label' for="inputEmail">Last Name</label>
                                <input type="text" name="name_last" id="" class="form-control form-control-sm" value="<?php echo $users->name_last ?>" placeholder="Last Name">
                            </div>
                            <div class="mb-3">
                                <label class='form-label' for="inputEmail">About</label>
                                <textarea class="form-control form-control-sm" name="about" rows="3"><?php echo $users->data_status ?></textarea>
                            </div>
                            <div class="mb-3 d-grid">
                                <button type="submit" class="btn btn-outline-monik btn-sm">Save Changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="card border-0 mb-3 text-prussianblue" >
                        <div class="card-header bg-transparent border-0 pt-3 d-flex">
                            <div class="flex-shrink-0 d-flex">
                                <img src="<?php echo base_url()?>public/themes/user/images/icons/setting-hobby.svg" class="img-circle" alt="">
                            </div>
                            <div class="flex-grow-1 ms-2 d-flex flex-column">
                                <span class="text-prussianblue fw-bold fs-16">Hobby and Skill</span>
                                <span class="fs-12">Share your hobby and skill.</span>
                            </div>
                        </div>

                        <div class="card-body fs-12 text-black">
                            <div class="row mb-3">
                                <div class="col-8">
                                    <span>Hobby</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="mb-4 justify-content-start d-inline-flex">
                                    <?php
                                        foreach($list_hobby as $value){
                                            echo "<span class='rounded-pill bg-light text-black p-2 m-1 hobby-pill'> "
                                            .$value['name'].
                                            "<a href='".base_url('user/profile/delete_hobby/'.$users->id.'/'.$value['hobby_id'].'/setting')."' class='text-black close ms-2'>&times;</a></span>";
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="mb-3 d-grid">
                                <button type="button" class="btn btn-outline-monik btn-sm" data-bs-toggle="modal" data-bs-target="#modalHobby">Add Hobby</button>
                            </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <span>Skills</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-4 justify-content-start d-inline-flex">
                                    <?php
                                        foreach($list_skill as $value){
                                            echo "<div class='rounded-pill bg-light text-black p-2 m-1 hobby-pill'>"
                                            .$value['name'].
                                            "<a href='".base_url('user/profile/delete_skill/'.$users->id.'/'.$value['skill_id'].'/setting')."' class='text-black close ms-2'>&times;</a></div>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 d-grid">
                            <button type="button" class="btn btn-outline-monik btn-sm" value="" data-bs-toggle="modal" data-bs-target="#modalSkill">Add Skill</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card border-0 mb-3 text-prussianblue" >
                    <div class="card-header bg-transparent border-0 pt-3 d-flex">
                        <div class="flex-shrink-0 d-flex">
                            <img src="<?php echo base_url()?>public/themes/user/images/icons/setting-experience.svg" class="img-circle" alt="">
                        </div>
                        <div class="flex-grow-1 ms-2 d-flex flex-column">
                            <span class="text-prussianblue fw-bold fs-16">Experience</span>
                            <span class="fs-12">Share your experience.</span>
                        </div>
                    </div>
                    <div class="card-body fs-12 text-black">
                        <p class="fw-bold">Work Experience</p>
                        <?php
                        foreach($works as $value){
                        ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                            <?php echo icon_default($value['file_path'],$value['file_name_original'] ) ?>
                            </div>
                            <div class="flex-grow-1 ms-3 flex-column">
                                <h6 class="fw-semi">
                                    <?php echo $value['specialization'] ?>
                                </h6>
                                <div>
                                    <span><?php echo $value['company'] ?></span>
                                </div>
                                <div>
                                    <span class="text-muted"><?php echo $value['date_start'] ?> - <?php echo $value['date_end'] ?></span>
                                </div>
                            </div>
                            <div class="flex-shrink-0 ps-auto text-right">
                                <div class="badge rounded-pill bg-danger p-1 d-flex">
                                    <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_edit_experience<?php echo $value['id'] ?>">
                                        <span class="material-icons text-white md-16">edit</span>
                                    </a>
                                    <div class="vr opacity-100"></div>
                                    <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_delete_experience<?php echo $value['id'] ?>">
                                        <span class="material-icons text-white md-16">delete</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <?php } ?>
                        <div class="mb-3 d-grid">
                        <input type="submit" class="btn btn-outline-monik btn-sm" value="Add work experience" data-bs-toggle="modal" data-bs-target="#modalExperience">
                        </div>
                        </form>
                    </div>
                    <div class="card-body fs-12 text-black">
                        <p>Education</p>
                        <?php
                        foreach($educations as $value){
                        ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                            <?php echo icon_default($value['file_path'],$value['file_name_original'] ) ?>
                            </div>
                            <div class="flex-grow-1 ms-3 flex-column">
                                <h6 class="fw-semi"><?php echo $value['campus'] ?></h6>
                                <span><span><?php echo $value['mayor'] ?></span></span>
                                <div><span class="text-muted"><?php echo $value['date_start'] ?> - <?php echo $value['date_end'] ?></span></div>
                            </div>
                            <div class="flex-shrink-0 ps-auto text-right">
                                <div class="badge rounded-pill bg-danger p-1 d-flex">
                                    <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_edit_education<?php echo $value['id'] ?>">
                                        <span class="material-icons text-white md-16">edit</span>
                                    </a>
                                    <div class="vr opacity-100"></div>
                                    <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_delete_education<?php echo $value['id'] ?>">
                                        <span class="material-icons text-white md-16">delete</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <?php } ?>
                        <div class="mb-3 d-grid">
                            <input type="submit" class="btn btn-outline-monik btn-sm" value="Add Education" data-bs-toggle="modal" data-bs-target="#modalEducation">
                        </div>
                        </form>
                    </div>
                    <div class="card-body fs-12 text-black">
                        <p>License</p>
                        <?php
                        foreach($licenses as $value){
                        ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                            <?php echo icon_default($value['file_path'],$value['file_name_original'] ) ?>
                            </div>
                            <div class="flex-grow-1 ms-3 flex-column">
                                <h6 class="fw-semi"><?php echo $value['study'] ?></h6>
                                <span><span><?php echo $value['school'] ?></span></span>
                                <div><span class="text-muted"><?php echo $value['date_start'] ?> - <?php echo $value['date_end'] ?></span></div>
                            </div>
                            <div class="flex-shrink-0 ps-auto text-right">
                                <div class="badge rounded-pill bg-danger p-1 d-flex">
                                    <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_edit_license<?php echo $value['id'] ?>">
                                        <span class="material-icons text-white md-16">edit</span>
                                    </a>
                                    <div class="vr opacity-100"></div>
                                    <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_delete_license<?php echo $value['id'] ?>">
                                        <span class="material-icons text-white md-16">delete</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <?php } ?>
                        <div class="mb-3 d-grid">
                        <input type="submit" class="btn btn-outline-monik btn-sm" value="Add license" data-bs-toggle="modal" data-bs-target="#modalLicense">
                        </div>
                        </form>
                    </div>
                    <div class="card-body fs-12 text-black">
                        <p>Private Course</p>
                        <?php
                        foreach($courses as $value){
                        ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                            <?php echo icon_default($value['file_path'],$value['file_name_original'] ) ?>
                            </div>
                            <div class="flex-grow-1 ms-3 flex-column">
                                <h6 class="fw-semi"><?php echo $value['study'] ?></h6>
                                <span><span><?php echo $value['school'] ?></span></span>
                                <div><span class="text-muted"><?php echo $value['date_start'] ?> - <?php echo $value['date_end'] ?></span></div>
                            </div>
                            <div class="flex-shrink-0 ps-auto text-right">
                                <div class="badge rounded-pill bg-danger p-1 d-flex">
                                    <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_edit_course<?php echo $value['id'] ?>">
                                        <span class="material-icons text-white md-16">edit</span>
                                    </a>
                                    <div class="vr opacity-100"></div>
                                    <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_delete_course<?php echo $value['id'] ?>">
                                        <span class="material-icons text-white md-16">delete</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <?php } ?>
                            <div class="mb-3 d-grid">
                                <input type="submit" class="btn btn-outline-monik btn-sm" value="Add private course" data-bs-toggle="modal" data-bs-target="#modalCourse">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['partials_modal_user']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>
