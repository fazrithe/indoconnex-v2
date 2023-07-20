<!-- navbar -->
<?php $this->load->view($template['partials_navbar_business']); ?>

<div class="container mb-4">
    <div class="p-4 bg-white rounded-3">
        <div class="card-body">
			<?php if (empty($followers)) : ?>
            <div class="row mt-4 mb-4 align-items-center">
                <div class="d-flex flex-column align-items-center">
                    <img class="mx-auto mb-3 w-100" src="<?php echo site_url('public/themes/user/images/empty/connection.png') ?>" alt="no-connection">

                    <?php if(!empty($checkusers_profile)) { ?>
                    <span class="text-mutex fw-semi fs-18 mb-3">You do not have any Connections yet</span>
                    <div class="flex-row">
                        <a href="<?php echo site_url('connections/discover/') ?>" class="btn btn-danger mb-3 fw-bold px-4">Find New Connection</a>
                        <a href="<?php echo site_url('connections/invite/') ?>" class="btn btn-danger mb-3 fw-bold px-4">Invite Friends</a>
                    </div>
                    <?php } else { ?>
                        <span class="text-mutex fw-semi fs-18 mb-3"><?php echo $business->data_name ?> does not have any Connections yet</span>
                    <?php } ?>
                </div>
            </div>
			<?php else: ?>
                <span class="text-lg-left mt-4 mb-4 text-prussianblue fw-bold fs-16 d-flex">Followers</span>
                <span class="text-lg-left mt-4 mb-4 fw-semi fs-16 d-flex"><?php echo $count_followers ?> Users</span>
                <div class="row mt-4 mb-4 align-items-center row-cols-1 row-cols-3">
                <?php foreach ($followers as $value) { ?>
                    <div class="col">
                        <div class="hstack">
                            <a href="<?php echo site_url('post/'.$value->username) ?>">
                                <?php echo icon_default($value->file_path,$value->file_name_original ) ?>
                            </a>
                            <div class="ms-3 vstack">
                                <a href="<?php echo site_url('post/'.$value->username) ?>"><span><?php echo trim($value->name_first . ' ' . $value->name_middle . ' ' . $value->name_last ) ?></span></a>
                                <span class="text-muted">
                                <?php echo current_work_followers($value->id); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
			<?php endif ?>
        </div>
    </div>
</div>