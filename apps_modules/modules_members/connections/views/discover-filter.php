<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_connection']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0">
        <div class="pt-4 mr-0 bg-indoconnex" >

            <span class="d-flex fw-bold mb-3">Discover Connection</span>
            <div class="d-flex bg-white mb-3">
                <form action="<?php echo base_url('connections/discover/filter') ?>" class="row p-2 w-100" method="post" role="form">
					<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
					<div class="d-flex justify-content-evenly">
                        <div class="input-group input-group-sm border-0 d-flex align-items-center py-1 mx-auto">
                            <span class="input-group-text bg-white border-0" id="basic-addon1">
                                <span class="material-icons text-danger">search</span>
                            </span>
                            <input type="text" class="form-control border border-2 rounded-0" placeholder="Search" aria-label="" aria-describedby="basic-addon1" id="" name="name" value="<?php echo $data_filter['name'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <span class="d-none d-md-block text-white px-3">Search</span>
                                <span class="material-icons text-white d-block d-md-none">search</span>
                            </button>
                        </div>
                    </div>
                    <!-- <div class="d-flex">
                        <select name="business-type" id="" class="form-select border-0 fw-semi fs-12">
                            <option value="0">User</option>
                            <option value="1">Business Page</option>
                        </select>
                    </div> -->
                </form>
            </div>

            <div class="bg-white container d-flex mb-3">
				<div class="col-12">
					<div class="justify-content-evenly m-3 d-flex align-text-center">
						<span class="me-auto text-prussianblue fw-bold">Search Result for Discover People</span>
						<span class="ms-auto text-muted">Found <?php echo $total_rows ?> matches</span>
					</div>
					<div class="p-4 bg-white">
						<?php if (!empty($connections)) { ?>
						<div class="row mb-2 row-cols-2 align-items-center">
							<?php foreach($connections as $value) {
								if($value->id != $users->id){
							?>
							<div class="col">
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
									<?php echo icon_default($value->file_path,$value->file_name_original ) ?>
									</div>
									<div class="flex-grow-1 ms-3 flex-column d-flex">
										<a href="<?php echo url_users($value->username) ?>">
										<span><?php 
											$fullName = strlen($value->fullname) <= 0 ? $value->fullname : $value->name_full;
											echo str_limit($fullName, 18) 
										?>
										</span></a>

										<span class="text-muted">People</span>
									</div>

									<div class="flex-shrink-0 ps-auto text-right mx-2 align-items-center">
										<button id="btnConnect_<?php echo $value->id ?>" class="btn btn-sm btn-monik <?php if(in_array($value->id, $friends)) echo 'active' ?>" data-bs-toggle="button" aria-pressed="<?php echo in_array($value->id, $friends)?>" onclick="follow('<?php echo $value->id ?>')"><?php echo (in_array($value->id, $friends)) ? 'Unfollow' : 'Follow' ?></button>
										<button type="button" class="btn btn-favourite connect fs-18 text-danger bg-light rounded-circle p-1 ms-2" data-bs-toggle="button" aria-pressed="false" data-content-type="connect" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
									</div>
								</div>
							</div>
							<?php }}?>
						</div>

						<div class="card-footer text-center">
							<?php echo $pagination; ?>
						</div>
						<?php } else { ?>
							<div class="d-flex align-items-center">
								<img class="p-4 w-100" src="<?php echo base_url()?>public/themes/user/images/empty/not-found.png" alt="search-not-found">
							</div>
						<?php } ?>

					</div>
				</div>
			</div>

			<div class="bg-white container d-flex mb-3">
				<div class="col-12">
					<div class="justify-content-evenly m-3 d-flex align-text-center">
						<span class="me-auto text-prussianblue fw-bold">Search Result for Discover Pages</span>
						<span class="ms-auto text-muted">Found <?php echo $total_rows ?> matches</span>
					</div>
					<div class="p-4 bg-white">
						<?php if (!empty($connections2)) { ?>
						<div class="row mb-2 row-cols-2 align-items-center">
							<?php foreach($connections2 as $value) {
							?>
							<div class="col">
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img src="<?php echo placeholder($value->file_path,$value->file_name_original) ?>" class='rounded-circle border-0 connection-img' alt='img'>
									</div>
									<div class="flex-grow-1 ms-3 flex-column d-flex">
										<a href="<?php echo url_business($value->data_username) ?>">
										<span><?php echo str_limit($value->data_name, 15); ?></span></a>

										<span class="text-muted">Pages</span>
									</div>

									<div class="flex-shrink-0 ps-auto text-right mx-2 align-items-center">
										<button id="btnConnect_<?php echo $value->id ?>" class="btn btn-sm btn-monik <?php if(in_array($value->id, $friends)) echo 'active' ?>" data-bs-toggle="button" aria-pressed="<?php echo in_array($value->id, $friends)?>" onclick="follow('<?php echo $value->id ?>')"><?php echo (in_array($value->id, $friends)) ? 'Unfollow' : 'Follow' ?></button>
										<button type="button" class="btn btn-favourite connect fs-18 text-danger bg-light rounded-circle p-1 ms-2" data-bs-toggle="button" aria-pressed="false" data-content-type="connect" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
									</div>
								</div>
							</div>
							<?php }?>
						</div>

						<div class="card-footer text-center">
							<?php echo $pagination2; ?>
						</div>
						<?php } else { ?>
							<div class="d-flex align-items-center">
								<img class="p-4 w-100" src="<?php echo base_url()?>public/themes/user/images/empty/not-found.png" alt="search-not-found">
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_connection']); ?>
