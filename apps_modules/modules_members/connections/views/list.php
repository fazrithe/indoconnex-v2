<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_connection']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0">
        <div class="pt-4 mr-0 bg-indoconnex" >
			<div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
                <select name="businessSelector" onchange="selectUserconnection(this.value)"  class=" js-businessSelector border-0 bg-white p-2">
                    <option value="1" data-image="<?php echo placeholder($users->file_path, $users->file_name_original) ?>"><?php echo $users->name_first ?> <?php echo $users->name_last ?></option>
                    <?php foreach($business_list as $value){ ?>
                    <option value="<?php echo $value->id ?>" data-id="<?php echo $value->id ?>" data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business') ?>" class=""><?php echo $value->data_name ?></option>
                    <?php } ?>
                </select>
            </div>
            <span class="d-flex fw-bold mb-3">My Connection</span>
            <div class="card mb-3 border-0">
                <div class="card-header border-0 bg-white p-3">
					<span class="me-auto text-prussianblue fw-bold">Following</span>
				</div>
				<div class="card-body">
					<div class="row mb-4 align-items-center row-cols-1 row-cols-md-2">
						<?php foreach($following as $value){
						?>
						<div class="col">
							<div class="d-flex align-items-center">
								<div class="flex-shrink-0">
									<div class="d-flex justify-content-center h-100">
										<div class="image_outer_container">
											<div class="green_icon" style="<?php echo user_online($value->id) ?>"></div>
												<div class="image_inner_container">
													<?php echo icon_default($value->file_path,$value->file_name_original ) ?>
												</div>
											</div>
										</div>
									<div class='status-circle'></div>
								</div>
								<div class="flex-grow-1 ms-3 flex-column d-flex">
									<a href="<?php echo url_users($value->username) ?>">
									<span class="text-black fs-14"><?php echo trim($value->name_first .' '. $value->name_middle .' '. $value->name_last) ?></span></a>

									<span class="text-muted fs-14">People</span>
								</div>

								<div class="flex-shrink-0 ps-auto text-right mx-2 align-items-center">
									<button id="btnConnect_<?php echo $value->id ?>" class="btn btn-sm btn-monik <?php if(in_array($value->id, $friends)) echo 'active' ?>" data-bs-toggle="button" aria-pressed="<?php echo in_array($value->id, $friends)?>" onclick="follow('<?php echo $value->id ?>')"><?php echo (in_array($value->id, $friends)) ? 'Unfollow' : 'Follow' ?></button>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="row mb-2 row-cols-1 row-cols-md-2 align-items-center">
						<?php foreach($following_business as $value) {
						?>
						<div class="col">
							<div class="d-flex align-items-center">
								<div class="flex-shrink-0">
								<?php echo icon_default($value->file_path,$value->file_name_original ) ?>
								</div>
								<div class="flex-grow-1 ms-3 flex-column d-flex">
									<a href="<?php echo site_url('business/post/'.urlencode($value->data_username)) ?>">
									<span class="text-black fs-14"><?php echo $value->data_name ?></span></a>

									<span class="text-muted fs-14">Pages</span>
								</div>

								<div class="flex-shrink-0 ps-auto text-right mx-2 align-items-center">
									<button id="btnConnect_<?php echo $value->id ?>" class="btn btn-sm btn-monik <?php if(in_array($value->id, $friends)) echo 'active' ?>" data-bs-toggle="button" aria-pressed="<?php echo in_array($value->id, $friends)?>" onclick="follow('<?php echo $value->id ?>')"><?php echo (in_array($value->id, $friends)) ? 'Unfollow' : 'Follow' ?></button>
								</div>
							</div>
						</div>
					<?php } ?>
					</div>
				</div>
			</div>
            <div class="card mb-3 border-0">
                <div class="card-header border-0 bg-white p-3">
					<span class="me-auto text-prussianblue fw-bold">Followers</span>
				</div>
				<div class="card-body">
					<div class="row mb-4 align-items-center row-cols-1 row-cols-md-2">
						<?php foreach($followers as $value){
						?>
						<div class="col">
							<div class="d-flex align-items-center">
								<div class="flex-shrink-0">
									<div class="d-flex justify-content-center h-100">
										<div class="image_outer_container">
											<div class="green_icon" style="<?php echo user_online($value->id) ?>"></div>
												<div class="image_inner_container">
													<?php echo icon_default($value->file_path,$value->file_name_original ) ?>
												</div>
											</div>
										</div>
									<div class='status-circle'></div>
								</div>
								<div class="flex-grow-1 ms-3 flex-column d-flex">
									<a href="<?php echo url_users($value->username) ?>">
									<span class="text-black fs-14"><?php echo trim($value->name_first .' '. $value->name_middle .' '. $value->name_last) ?></span></a>

									<span class="text-muted fs-14">People</span>
								</div>

								<div class="flex-shrink-0 ps-auto text-right mx-2 align-items-center">
									<button id="btnConnect_<?php echo $value->id ?>" class="btn btn-sm btn-monik <?php if(in_array($value->id, $friends)) echo 'active' ?>" data-bs-toggle="button" aria-pressed="<?php echo in_array($value->id, $friends)?>" onclick="follow('<?php echo $value->id ?>')"><?php echo (in_array($value->id, $friends)) ? 'Unfollow' : 'Follow' ?></button>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="card-footer text-center">
						<?php echo $this->pagination->create_links(); ?>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_connection']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>
