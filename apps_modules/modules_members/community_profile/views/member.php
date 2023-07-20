<!-- navbar -->
<?php $this->load->view($template['partials_navbar_community']); ?>

<?php if(empty($community->status_privacy) || !empty($checkusers_profile)) { ?>
<div class="container mb-4">
    <div class="p-4 bg-white rounded-3">
        <div class="card-body">
			<?php if (empty($members)) : ?>
            <div class="row mt-4 mb-4 align-items-center">
                <div class="d-flex flex-column align-items-center">
                    <img class="mx-auto mb-3 w-100" src="<?php echo site_url('public/themes/user/images/empty/connection.png') ?>" alt="no-connection">

                    <?php if(!empty($checkusers_profile)) { ?>
                    <span class="text-mutex fw-semi fs-18 mb-3">You do not have any Connections yet</span>
                    <?php } else { ?>
                        <span class="text-mutex fw-semi fs-18 mb-3"><?php echo $users->name_first ?> does not have any Connections yet</span>
                    <?php } ?>
                </div>
            </div>
			<?php else: ?>
                <span class="text-lg-left mt-4 mb-4 text-prussianblue fw-bold fs-16 d-flex">Members</span>
                <span class="text-lg-left mt-4 mb-4 fw-semi fs-16 d-flex"> Users</span>
                <div class="row mt-4 mb-4 align-items-center row-cols-3">
                <?php foreach ($members as $value) { ?>
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <a href="<?php echo site_url('post/'.$value->username) ?>">
                                    <?php echo icon_default($value->file_path,$value->file_name_original ) ?>
                                </a>
                            </div>
                            <div class="col-8 ms-2 d-flex flex-column">
                                <a href="<?php echo site_url('post/'.$value->username) ?>"><span><?php echo trim($value->name_first . ' ' . $value->name_middle . ' ' . $value->name_last ) ?></span></a>
                                <span class="text-muted"><?php echo current_work_followers($value->id); ?></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
			<?php endif ?>
        </div>
    </div>
</div>
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
