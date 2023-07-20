<!-- navbar -->
<?php $this->load->view($template['partials_navbar_user']); ?>

<?php if(empty($users_profile->status_privacy) || !empty($checkusers_profile)) { ?>
<!-- BODY -->
<div class="container mb-4">
    <div class="row">
        <!-- ASIDE -->
        <?php $this->load->view($template['sidebar_user_about']); ?>

        <!-- SECTION -->
        <div class="col-auto col-md-9">
            <!-- WORK EXPERIENCE -->
            <div class="p-4 rounded-3 msn-widget mb-4">
                <div class="d-flex align-items-start">
                    <h5 class="mb-4 text-prussianblue">Work Experience</h5>
                    <div class="ms-auto">
                        <?php if(!empty($checkusers_profile)){ ?>
                        <div class="dropdown">
                            <a type="button" id="dropdownMenuButton1" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span class="text-muted material-icons">more_horiz</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="#" role="button" aria-expanded="false" aria-controls="workExperience" data-bs-toggle="modal" data-bs-target="#modalExperienceabout">Add</a>
                                </li>
                            </ul>
                        </div>
                        <?php } ?>

                        <!-- Modal Delete Post Text -->
                        <div class="modal fade" id="posttextdeleteModal" tabindex="-1"
                            aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="">Are you sure to delete this
                                            post?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-muted"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    if(!empty($works)):
                    foreach($works as $value):
                ?>
                <div class="mb-4 d-flex">
                    <div>
                        <?php echo icon_default($value['file_path'],$value['file_name_original'] ) ?>
                    </div>
                    <div class="ms-4">
                        <b class="text-black"><?php echo $value['specialization'] ?></b><br>
                        <small class="text-black"><?php echo $value['company'] ?></small><br>
                        <small class="text-muted"><?php echo $value['date_start'] ?> - <?php echo ($value['status'] && empty($value['date_end'])) ? 'Present' : $value['date_end'] ?></small>
                        <span class="material-icons mx-2 align-middle text-muted md-2">circle</span>
                        <small class="text-muted"><?php echo $value['rangedate'] ?></small>
                    </div>
                    <?php if(!empty($checkusers_profile)){ ?>
                    <div class="d-flex align-items-center ms-auto">
                        <div class="badge rounded-pill bg-danger p-1 d-flex">
                            <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_edit_experience_about<?php echo $value['id'] ?>">
                                <span class="material-icons text-white md-16">edit</span>
                            </a>
                            <div class="vr opacity-100"></div>
                            <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_delete_experience_about<?php echo $value['id'] ?>">
                                <span class="material-icons text-white md-16">delete</span>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php
                    endforeach;
                else:?>
                <div class="mb-4 d-flex">
                    <img src="<?php echo base_url() . 'public/themes/user/images/empty/work.png'?>" alt="" srcset="" class="w-100">
                </div>

                <?php endif; ?>

            </div>
            <!-- Education -->
            <div class="p-4 rounded-3 msn-widget mb-4">
                <div class="d-flex align-items-start">
                    <h5 class="mb-4 text-prussianblue">Education</h5>
                    <div class="ms-auto">
                        <?php if(!empty($checkusers_profile)){ ?>
                        <div class="dropdown">
                            <a type="button" id="dropdownMenuButton2" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span class="text-muted material-icons">more_horiz</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                <li>
                                    <a class="dropdown-item" href="#workEducationabout" role="button" aria-expanded="false" aria-controls="education" data-bs-toggle="modal" data-bs-target="#modalEducationabout">Add</a>
                                </li>
                            </ul>
                        </div>
                        <?php } ?>
                        <!-- Modal Delete Post Text -->
                        <div class="modal fade" id="posttextdeleteModal" tabindex="-1"
                            aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="">Are you sure to delete this
                                            post?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-muted"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if (!empty($educations)) :
                    foreach($educations as $value):
                ?>
                <div class="mb-4 d-flex align-items-center">
                    <div>
                        <?php echo icon_default($value['file_path'],$value['file_name_original'] ) ?>
                    </div>
                    <div class="ms-4">
                        <b class="text-black"><?php echo $value['mayor'] ?></b><br>
                        <small class="text-black"><?php echo $value['campus'] ?></small><br>
                        <small class="text-muted"><?php echo $value['date_start'] ?> - <?php echo empty($value['date_end']) ? 'Present' : $value['date_end'] ?></small>
                        <span class="material-icons mx-2 align-middle text-muted md-2">circle</span>
                        <small class="text-muted"><?php echo $value['rangedate'] ?></small>
                    </div>
                    <?php if(!empty($checkusers_profile)){ ?>
                    <div class="d-flex align-items-end ms-auto">
                        <div class="badge rounded-pill bg-danger p-1 d-flex">
                            <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_edit_education_about<?php echo $value['id'] ?>">
                                <span class="material-icons text-white md-16">edit</span>
                            </a>
                            <div class="vr opacity-100"></div>
                            <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_delete_education_about<?php echo $value['id'] ?>">
                                <span class="material-icons text-white md-16">delete</span>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php
                    endforeach;
                else:?>
                <div class="mb-4 d-flex">
                    <img src="<?php echo base_url() . 'public/themes/user/images/empty/education.png'?>" alt="" srcset="" class="w-100">
                </div>

                <?php endif; ?>

            </div>
            <!-- LICENSE -->
            <div class="p-4 rounded-3 msn-widget mb-4">
                <div class="d-flex align-items-start">
                    <h5 class="mb-4 text-prussianblue">Licence</h5>
                    <div class="ms-auto">
                        <?php if(!empty($checkusers_profile)){ ?>
                        <div class="dropdown">
                            <a type="button" id="dropdownMenuButton1" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span class="text-muted material-icons">more_horiz</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="#worklicenseabout" role="button" aria-expanded="false" aria-controls="education" data-bs-toggle="modal" data-bs-target="#modalLicenseabout">Add</a>
                                </li>
                            </ul>
                        </div>
                        <?php } ?>
                        <!-- Modal Delete Post Text -->
                        <div class="modal fade" id="posttextdeleteModal" tabindex="-1"
                            aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="">Are you sure to delete this
                                            post?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-muted"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    if(!empty($licenses)):
                    foreach($licenses as $value):
                ?>
                <div class="mb-4 d-flex align-items-center">
                    <div>
                    <?php echo icon_default($value['file_path'],$value['file_name_original'] ) ?>
                    </div>
                    <div class="ms-4">
                        <b class="text-black"><?php echo $value['study'] ?></b><br>
                        <small class="text-black"><?php echo $value['school'] ?></small><br>
                        <small class="text-muted"><?php echo $value['date_start'] ?> - <?php echo empty($value['date_end']) ? 'Present' : $value['date_end'] ?></small>
                        <span class="material-icons mx-2 align-middle text-muted md-2">circle</span>
                        <small class="text-muted"><?php echo $value['rangedate'] ?></small>
                    </div>
                    <?php if(!empty($checkusers_profile)){ ?>
                    <div class="d-flex align-items-end ms-auto">
                        <div class="badge rounded-pill bg-danger p-1 d-flex">
                            <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_edit_license_about<?php echo $value['id'] ?>">
                                <span class="material-icons text-white md-16">edit</span>
                            </a>
                            <div class="vr opacity-100"></div>
                            <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_delete_license_about<?php echo $value['id'] ?>">
                                <span class="material-icons text-white md-16">delete</span>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php
                    endforeach;
                    else:?>
                    <div class="mb-4 d-flex">
                        <img src="<?php echo base_url() . 'public/themes/user/images/empty/license.png'?>" alt="" srcset="" class="w-100">
                    </div>
                    <?php endif; ?>
            </div>
            <!-- COURSE -->
            <div class="p-4 rounded-3 msn-widget mb-4">
                <div class="d-flex align-items-start">
                    <h5 class="mb-4 text-prussianblue">Private Course</h5>
                    <div class="ms-auto">
                        <?php if(!empty($checkusers_profile)){ ?>
                        <div class="dropdown">
                            <a type="button" id="dropdownMenuButton1" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span class="text-muted material-icons">more_horiz</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="#modalCourseabout" role="button" aria-expanded="false" aria-controls="education" data-bs-toggle="modal" data-bs-target="#modalCourseabout">Add</a>
                                </li>
                            </ul>
                        </div>
                        <?php } ?>
                        <!-- Modal Delete Post Text -->
                        <div class="modal fade" id="posttextdeleteModal" tabindex="-1"
                            aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="">Are you sure to delete this
                                            post?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-muted"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if (!empty($courses)) :
                    foreach($courses as $value):
                ?>
                <div class="mb-4 d-flex align-items-center">
                    <div>
                        <?php echo icon_default($value['file_path'],$value['file_name_original'] ) ?>
                    </div>
                    <div class="ms-4">
                        <b class="text-black"><?php echo $value['study'] ?></b><br>
                        <small class="text-black"><?php echo $value['school'] ?></small><br>
                        <small class="text-muted"><?php echo $value['date_start'] ?> - <?php echo empty($value['date_end']) ? 'Present' : $value['date_end'] ?></small>
                        <span class="material-icons mx-2 align-middle text-muted md-2">circle</span>
                        <small class="text-muted"><?php echo $value['rangedate'] ?></small>
                    </div>
                    <?php if(!empty($checkusers_profile)){ ?>
                    <div class="d-flex align-items-end ms-auto">
                        <div class="badge rounded-pill bg-danger p-1 d-flex">
                            <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_edit_course_about<?php echo $value['id'] ?>">
                                <span class="material-icons text-white md-16">edit</span>
                            </a>
                            <div class="vr opacity-100"></div>
                            <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_delete_course_about<?php echo $value['id'] ?>">
                                <span class="material-icons text-white md-16">delete</span>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php
                    endforeach;
                else:?>
                <div class="mb-4 d-flex">
                    <img src="<?php echo base_url() . 'public/themes/user/images/empty/course.png'?>" alt="" srcset="" class="w-100">
                </div>

                <?php endif; ?>

            </div>
            <!-- VOLUNTEER -->
            <div class="p-4 rounded-3 msn-widget mb-4">
                <div class="d-flex align-items-start">
                    <h5 class="mb-4 text-prussianblue">Volunteer Experience</h5>
                    <div class="ms-auto">
                        <?php if(!empty($checkusers_profile)){ ?>
                        <div class="dropdown">
                            <a type="button" id="dropdownMenuButton1" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span class="text-muted material-icons">more_horiz</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="#workVolunterabout" role="button" aria-expanded="false" aria-controls="volunter" data-bs-toggle="modal" data-bs-target="#modalVolunterabout">Add</a>
                                </li>
                            </ul>
                        </div>
                        <?php } ?>
                        <!-- Modal Delete Post Text -->
                        <div class="modal fade" id="posttextdeleteModal" tabindex="-1"
                            aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="">Are you sure to delete this
                                            post?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-muted"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if (!empty($volunteers)) :
                    foreach($volunteers as $value):
                ?>
                <div class="mb-4 d-flex align-items-center">
                    <div class="ms-4">
                        <b class="text-black"><?php echo $value['volunteer_name'] ?></b><br>
                        <small class="text-muted"><?php echo $value['date_start'] ?> - <?php echo empty($value['date_end']) ? 'Present' : $value['date_end'] ?></small>
                        <span class="material-icons mx-2 align-middle text-muted md-2">circle</span>
                        <small class="text-muted"><?php echo $value['rangedate'] ?></small>
                    </div>
                    <?php if(!empty($checkusers_profile)){ ?>
                    <div class="d-flex align-items-end ms-auto">
                        <div class="badge rounded-pill bg-danger p-1 d-flex">
                            <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_edit_volunteer_about<?php echo $value['id'] ?>">
                                <span class="material-icons text-white md-16">edit</span>
                            </a>
                            <div class="vr opacity-100"></div>
                            <a class="btn btn-sm d-flex align-items-center px-1 py-0" href="#" role="button" data-bs-toggle="modal" data-bs-target="#modal_delete_volunteer_about<?php echo $value['id'] ?>">
                                <span class="material-icons text-white md-16">delete</span>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php
                    endforeach;
                else:?>
                <div class="mb-4 d-flex">
                    <img src="<?php echo base_url() . 'public/themes/user/images/empty/volunteer.png'?>" alt="" srcset="" class="w-100">
                </div>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($template['partials_modal_user']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>

<?php } else { ?>
    <div class="container mb-4">
        <div class="row">
            <div class="col mx-auto">
                <div class="mb-4 rounded-3 msn-widget">
                    <div class="text-center p-md-4 p-2">
                        This account is Private
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
