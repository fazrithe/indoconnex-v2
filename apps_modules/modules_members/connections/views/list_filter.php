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
                    <?php foreach($business_list as $value){
						  $selected = '';
						?>
						<?php if ($filter_id == $value->id) $selected = 'selected'; ?>
                        <option value="<?php echo $value->id ?>"
                            data-id="<?php echo $value->id ?>"
                            data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business')?>" class="" <?php echo $selected?> data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo $value->data_name ?>">
                                <?php echo $value->data_name ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <span class="d-flex fw-bold mb-3">My Connection</span>
            <div class="bg-white container d-flex m-3">
                <div class="col-12">
                    <div class="justify-content-evenly m-3 d-flex align-text-center">
                        <span class="me-auto text-prussianblue fw-bold">Followers</span>
                    </div>
					<div class="p-4 bg-white">
						<div class="row mb-4 align-items-center row-cols-2">
							<?php foreach($followers as $value){
							?>
							<div class="col">
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
									<?php echo icon_default($value->file_path,$value->file_name_original ) ?>
									</div>
									<div class="flex-grow-1 ms-3 flex-column d-flex">
										<a href="<?php echo url_users($value->data_username) ?>">
										<span><?php echo $value->data_name ?></span></a>

										<span class="text-muted"><?php echo $value->data_username ?></span>
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
</div>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_connection']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>