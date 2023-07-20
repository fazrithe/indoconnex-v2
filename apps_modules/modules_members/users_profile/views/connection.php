<!-- navbar -->
<?php $this->load->view($template['partials_navbar_user']); ?>

<?php if(empty($users_profile->status_privacy) || !empty($checkusers_profile)) { ?>
<div class="container mb-4">
    <div class="p-4 bg-white">
        <div class="card-body">
			<?php if (empty($connections) && empty($follower)) : ?>
            <div class="row mt-4 mb-4 align-items-center">
                <div class="d-flex flex-column align-items-center">
                    <img class="mx-auto mb-3 w-100" src="<?php echo base_url() ?>public/themes/user/images/empty/connection.png" alt="no-connection">

                    <?php if(!empty($checkusers_profile)) { ?>
                    <span class="text-mutex fw-semi fs-18 mb-3">You do not have any Connection yet</span>
                    <div class="d-md-flex justify-content-md-center d-grid gap-2 d-md-block col-12">
                        <a href="<?php echo site_url('connections/discover/') ?>" class="btn btn-danger mb-3 fw-bold px-4">Find New Connection</a>
                        <a href="<?php echo site_url('connections/invite/') ?>" class="btn btn-danger mb-3 fw-bold px-4">Invite Friends</a>
                    </div>
                    <?php } else { ?>
                        <span class="text-mutex fw-semi fs-18 mb-3"><?php echo $users_profile->name_first ?> do not have any Connection yet</span>
                    <?php } ?>
				</div>
            </div>
			<?php else: ?>
            <span class="text-lg-left mt-4 mb-4 text-prussianblue fw-bold fs-16 d-flex">Following</span>
            <span class="text-lg-left mt-4 mb-4 fw-semi fs-16 d-flex"><?php echo $count_connection ?> Users</span>
                <div class="row">
                <?php foreach ($connections as $value) { ?>
					<div class="col-sm-3 d-flex align-items-center">
						<div class="flex-shrink-0">
                            <a href="<?php echo site_url('post/'.$value->username) ?>">
                                <?php echo icon_default($value->file_path,$value->file_name_original ) ?>
                            </a>
						</div>
						<div class="col-sm-3 flex-grow-1 ms-2 flex-column d-flex">
                            <a href="<?php echo site_url('post/'.$value->username) ?>"><span><?php echo trim($value->name_first . ' ' . $value->name_middle . ' ' . $value->name_last ) ?></span></a>
						</div>
                	</div>
                <?php } ?>
                </div>

                <span class="text-lg-left mt-4 mb-4 text-prussianblue fw-bold fs-16 d-flex">Followers</span>
                <span class="text-lg-left mt-4 mb-4 fw-semi fs-16 d-flex"><?php echo $count_followers ?> Users</span>
                <div class="row">
                <?php foreach ($followers as $value) { ?>
                    <div class="col-sm-3 d-flex align-items-center">
						<div class="flex-shrink-0">
                            <a href="<?php echo site_url('post/'.$value->username) ?>">
                                <?php echo icon_default($value->file_path,$value->file_name_original ) ?>
                            </a>
                        </div>
						<div class="col-sm-3 flex-grow-1 ms-2 flex-column d-flex">
                            <a href="<?php echo site_url('post/'.$value->username) ?>"><span><?php echo trim($value->name_first . ' ' . $value->name_middle . ' ' . $value->name_last ) ?></span></a>
                            <span class="text-muted">
                            <?php echo current_work_followers($value->id); ?>
                            </span>
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
