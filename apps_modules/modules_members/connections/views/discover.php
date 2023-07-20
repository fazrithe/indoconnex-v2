<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_connection']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>" />

<!-- Page Content  -->
<div class="container-fluid">
	<div class="row">
		<div class="col-11 col-md-7 mx-auto px-0">
			<div class="pt-4 mr-0 bg-indoconnex">

				<span class="d-flex fw-bold mb-3">Discover Connection</span>
				<!-- <div class="d-flex bg-white mb-3">
					<form action="<?php echo base_url('connections/discover/filter') ?>" class="row p-2 w-100" method="post" role="form">
						<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>" />
						<div class="d-flex justify-content-evenly">
							<div class="input-group input-group-sm border-0 d-flex align-items-center py-1 mx-auto">
								<span class="input-group-text bg-white border-0" id="basic-addon1">
									<span class="material-icons text-danger">search</span>
								</span>
								<input type="text" class="form-control border border-2 rounded-0" placeholder="Search" aria-label="" aria-describedby="basic-addon1" id="" name="name">
								<button type="submit" class="btn btn-danger btn-sm">
									<span class="d-none d-md-block text-white px-3">Search</span>
									<span class="material-icons text-white d-block d-md-none">search</span>
								</button>
							</div>
						</div>
					</form>
				</div> -->

				<div class="bg-white container-fluid d-flex mb-3">
					<div class="col-12">
						<div class="justify-content-evenly m-3 d-flex align-text-center">
							<span class="me-auto text-prussianblue fw-bold">Discover People</span>
						</div>
						<div class="p-4 bg-white">
							<div class="row mb-2 row-cols-1 row-cols-md-2 align-items-center">
								<?php foreach ($connections as $value) {
									if ($value->id != $users->id) {
								?>
										<div class="col">
											<div class="d-flex align-items-center">
												<div class="flex-shrink-0">
													<div class="d-flex justify-content-center h-100">
														<div class="image_outer_container">
															<div class="green_icon" style="<?php echo user_online($value->id) ?>"></div>
																<div class="image_inner_container">
																	<img src='<?php echo placeholder($value->file_path, $value->file_name_original) ?>' class='rounded-circle border feed-user-img' alt='img'>
																</div>
															</div>
														</div>
													<div class='status-circle'></div>
												</div>
												<div class="flex-grow-1 ms-3 flex-column d-flex">
													<a href="<?php echo url_users($value->username) ?>">
														<span class="text-black fs-14"><?php 
															$fullName = strlen($value->fullname) <= 0 ? $value->fullname : $value->name_full;
															echo str_limit($fullName, 18) 
														?></span></a>
													<span class="text-muted fs-14">People</span>
												</div>

												<div class="flex-shrink-0 ps-auto text-right mx-2 align-items-center">
													<button id="btnConnect_<?php echo $value->id ?>" class="btn btn-sm btn-monik <?php if (in_array($value->id, $followings)) echo 'active' ?>" data-bs-toggle="button" aria-pressed="<?php echo in_array($value->id, $followings) ?>" onclick="follow('<?php echo $value->id ?>')"><?php echo (in_array($value->id, $followings)) ? 'Unfollow' : 'Follow' ?></button>

													<button type="button" class="btn btn-favourite connect fs-18 text-danger bg-light rounded-circle p-1 ms-2 <?php echo active_favourite($value->id, 'users'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="users" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
												</div>
											</div>
										</div>
								<?php }
								} ?>
							</div>

							<div class="card-footer text-center bg-white">
								<a href="<?php echo site_url('connections/discover/people'); ?>" class="btn btn-sm btn-danger mt-4">View All</a>
							</div>
						</div>
					</div>
				</div>
				<div class="bg-white container-fluid d-flex mb-3">
					<div class="col-12">
						<div class="justify-content-evenly m-3 d-flex align-text-center">
							<span class="me-auto text-prussianblue fw-bold">Discover Pages</span>
						</div>
						<div class="p-4 bg-white">
							<div class="row mb-2 row-cols-1 row-cols-md-2 align-items-center">
								<?php foreach ($connections2 as $value) { ?>
									<div class="col">
										<div class="d-flex align-items-center">
											<div class="flex-shrink-0">
												<img src="<?php echo placeholder($value->file_path, $value->file_name_original) ?>" class='rounded-circle border-0 connection-img' alt='img'>
											</div>
											<div class="flex-grow-1 ms-3 flex-column d-flex">
												<a href="<?php echo url_business($value->data_username) ?>">
													<span class="text-black fs-14"><?php echo str_limit($value->data_name, 18) ?></span></a>

												<span class="text-muted fs-14">Pages</span>
											</div>

											<div class="flex-shrink-0 ps-auto text-right mx-2 align-items-center">
												<button id="btnConnect_<?php echo $value->id ?>" class="btn btn-sm btn-monik <?php if (in_array($value->id, $followings)) echo 'active' ?>" data-bs-toggle="button" aria-pressed="<?php echo in_array($value->id, $followings) ?>" onclick="follow('<?php echo $value->id ?>')"><?php echo (in_array($value->id, $followings)) ? 'Unfollow' : 'Follow' ?></button>
												<button type="button" class="btn btn-favourite connect fs-18 text-danger bg-light rounded-circle p-1 ms-2 <?php echo active_favourite($value->id, 'pbd_business'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="business" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>

							<div class="card-footer text-center bg-white">
								<a href="<?php echo site_url('connections/discover/pages'); ?>" class="btn btn-sm btn-danger mt-4">View All</a>
							</div>
						</div>
					</div>
				</div>
				<div class="bg-white container-fluid d-flex mb-3">
					<div class="col-12">
						<div class="justify-content-evenly m-3 d-flex align-text-center">
							<span class="me-auto text-prussianblue fw-bold">Suggestion by Workplace</span>
						</div>
						<div class="p-4 bg-white">
							<div class="row mb-2 row-cols-1 row-cols-md-2 align-items-center">
								<?php
								if (!empty($suggestions_by_workplace)) {
									foreach ($suggestions_by_workplace as $value) {
										if ($value['id'] != $users->id && !empty($value['username'])) {
								?>
											<div class="col">
												<div class="d-flex align-items-center">
													<div class="flex-shrink-0">
														<img src="<?php echo placeholder($value['file_path'], $value['file_name_original']) ?>" class='rounded-circle border-0 connection-img' alt='img'>
													</div>
													<div class="flex-grow-1 ms-3 flex-column d-flex">
														<a href="<?php echo url_users($value['username']) ?>">
															<span class="text-black fs-14"><?php echo str_limit(trim($value['name_first'] . ' ' . $value['name_middle'] . ' ' . $value['name_last']), 18) ?></span></a>
														<span class="text-muted fs-14">People</span>
													</div>

													<div class="d-flex flex-shrink-0 ps-auto text-right mx-2 align-items-center flex-row">
														<button id="btnConnect_<?php echo $value['id'] ?>" class="btn btn-sm btn-monik <?php if (in_array($value['id'], $followings)) echo 'active' ?>" data-bs-toggle="button" aria-pressed="<?php echo in_array($value['id'], $followings) ?>" onclick="follow('<?php echo $value['id'] ?>')">
															<?php echo (in_array($value['id'], $followings)) ? 'Unfollow' : 'Follow' ?>
														</button>
														<button type="button" class="btn btn-favourite connect fs-18 text-danger bg-light rounded-circle p-1 ms-2 <?php echo active_favourite($value['id'], 'users'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="users" data-content-id="<?php echo $value['id'] ?>" autocomplete="off"></button>
													</div>
												</div>
											</div>
								<?php 	}
									}
								} ?>
							</div>
						</div>
					</div>
				</div>
				<div class="bg-white container-fluid d-flex mb-3">
					<div class="col-12">
						<div class="justify-content-evenly m-3 d-flex align-text-center">
							<span class="me-auto text-prussianblue fw-bold">Suggestion by Education</span>
						</div>
						<div class="p-4 bg-white">
							<div class="row mb-2 row-cols-1 row-cols-md-2 align-items-center">
								<?php
								if (!empty($suggestions_by_education)) {
									foreach ($suggestions_by_education as $value) {
										if ($value['id'] != $users->id && !empty($value['username'])) {
								?>
											<div class="col">
												<div class="d-flex align-items-center">
													<div class="flex-shrink-0">
														<img src="<?php echo placeholder($value['file_path'], $value['file_name_original']) ?>" class='rounded-circle border-0 connection-img' alt='img'>
													</div>
													<div class="flex-grow-1 ms-3 flex-column d-flex">
														<a href="<?php echo url_users($value['username']) ?>">
															<span class="text-black fs-14"><?php echo str_limit(trim($value['name_first'] . ' ' . $value['name_middle'] . ' ' . $value['name_last']), 18) ?></span></a>

														<span class="text-muted fs-14">People</span>
													</div>

													<div class="d-flex flex-shrink-0 ps-auto text-right mx-2 align-items-center flex-row">
														<button id="btnConnect_<?php echo $value['id'] ?>" class="btn btn-sm btn-monik <?php if (in_array($value['id'], $followings)) echo 'active' ?>" data-bs-toggle="button" aria-pressed="<?php echo in_array($value['id'], $followings) ?>" onclick="follow('<?php echo $value['id'] ?>')">
															<?php echo (in_array($value['id'], $followings)) ? 'Unfollow' : 'Follow' ?>
														</button>
														<button type="button" class="btn btn-favourite connect fs-18 text-danger bg-light rounded-circle p-1 ms-2 <?php echo active_favourite($value['id'], 'users'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="users" data-content-id="<?php echo $value['id'] ?>" autocomplete="off"></button>
													</div>
												</div>
											</div>
								<?php 	}
									}
								} ?>
							</div>
						</div>
					</div>
				</div>
				<div class="bg-white container-fluid d-flex mb-3">
					<div class="col-12">
						<div class="justify-content-evenly m-3 d-flex align-text-center">
							<span class="me-auto text-prussianblue fw-bold">Suggestion by Community</span>
						</div>
						<div class="p-4 bg-white">
							<div class="row mb-2 row-cols-1 row-cols-md-2 align-items-center">
								<?php
								if (!empty($suggestions_by_community)) {
									foreach ($suggestions_by_community as $value) {
										if ($value['id'] != $users->id && !empty($value['username'])) {
								?>
											<div class="col">
												<div class="d-flex align-items-center">
													<div class="flex-shrink-0">
														<img src="<?php echo placeholder($value['file_path'], $value['file_name_original']) ?>" class='rounded-circle border-0 connection-img' alt='img'>
													</div>
													<div class="flex-grow-1 ms-3 flex-column d-flex">
														<a href="<?php echo url_users($value['username']) ?>">
															<span class="text-black fs-14"><?php echo str_limit(trim($value['name_first'] . ' ' . $value['name_middle'] . ' ' . $value['name_last']), 18) ?></span></a>
														<span class="text-muted fs-14">People</span>
													</div>

													<div class="d-flex flex-shrink-0 ps-auto text-right mx-2 align-items-center flex-row">
														<button id="btnConnect_<?php echo $value['id'] ?>" class="btn btn-sm btn-monik <?php if (in_array($value['id'], $followings)) echo 'active' ?>" data-bs-toggle="button" aria-pressed="<?php echo in_array($value['id'], $followings) ?>" onclick="follow('<?php echo $value['id'] ?>')">
															<?php echo (in_array($value['id'], $followings)) ? 'Unfollow' : 'Follow' ?>
														</button>
														<button type="button" class="btn btn-favourite connect fs-18 text-danger bg-light rounded-circle p-1 ms-2 <?php echo active_favourite($value['id'], 'users'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="users" data-content-id="<?php echo $value['id'] ?>" autocomplete="off"></button>
													</div>
												</div>
											</div>
								<?php 	}
									}
								} ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_connection']); ?>
<?php $this->load->view($template['action_ajax_favourite']); ?>
