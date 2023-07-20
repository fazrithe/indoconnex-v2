<div id="posts-infinite">
			<?php foreach($posts as $value):
				$post_type = $value->post_type; 
				$description  = $value->data_description;
				// $post_id = $value->id;
				$post_id = !empty($value->relate_id) ? $value->relate_id . $value->users_id : $value->id;
			?>
			<!-- USER POST -->
			<div class="mb-4 rounded-3 msn-widget" id="<?php echo $post_id; ?>">
				<div class="d-flex align-items-center p-md-4 p-2">
					<?php foreach($users_all as $users_val){
						if($users_val->id == $value->users_id ) {
						?>
					<div>
					<?php
					if($value->pbd_business_id == 'undefined' or $value->pbd_business_id == NULL)
					{
					?>
					<div class="d-flex justify-content-center h-100">
						<div class="image_outer_container">
							<div class="green_icon" style="<?php echo user_online($value->users_id) ?>"></div>
								<div class="image_inner_container">
									<?php echo img_post_users($value->users_id); ?>
								</div>
							</div>
						</div>
					<div class='status-circle'></div>
					<?php
					} else {
						echo img_post_business($value->pbd_business_id);
					}
					?>

					</div>
					<div class="ms-3 d-flex flex-column">
						<?php
						if($value->pbd_business_id == 'undefined' or $value->pbd_business_id == NULL)
						{
							if ($post_type === 'articles') {
								echo '<div class="d-flex justify-content-start">
									<span>'. name_post_users($value->users_id) .'</span>
									<span class="ms-1">added new article</span>
								</div>';
							} else if ($post_type === 'users_updated_photo_profile') {
								echo '<div class="d-flex justify-content-start">
									<span>'. name_post_users($value->users_id) .'</span>
									<span class="ms-1">updated the profile picture</span>
								</div>';
							} else if ($post_type === 'job') {
								echo '<span>'. name_post_users($value->users_id) .'</span>
									  <span class="ms-1">Need '. get_job_name_by_id($value->id) .'</span>';
							} else if ($value->status_buy_sells == '1') {
								echo '<span>'. name_post_users($value->users_id) .'</span>
										<span class="ms-1">Publish a listing at Buy & Sells</span>';
							} else if ($post_type === 'tender') {
								echo '
									<span>'. name_post_users($value->users_id) .'</span>
									<span>Publish a project at Tender</span>';
							} else if($post_type === 'posts' && empty($value->relate_id)) {
								echo '<div class="d-flex justify-content-start">
									<span>'. name_post_users($value->users_id) .'</span>
								</div>';
							} else if($post_type === 'posts_lookfor' && empty($value->relate_id)) {
								echo '<div class="d-flex justify-content-start">
									<span>'. name_post_users($value->users_id) .'</span>
								</div>';
							} else if ($post_type === 'posts' && ! empty($value->relate_id) && empty($value->post_liked)) {
								echo '<div class="d-flex justify-content-start">
									<span>'. name_post_users($value->users_id) .'</span>
									<span class="ms-1">commented a post of '. ' ' . name_post_users($value->owner_post_id) .'</span>
								</div>';
							} else if (! empty($value->relate_id) && $value->post_liked == true) {
								echo '<div class="d-flex justify-content-start">
									<span>'. name_post_users($value->users_id) .'</span>
									<span class="ms-1">liking a post of '. ' ' . name_post_users($value->owner_post_id) .'</span>
								</div>';
							}
						} else {
							if ($post_type === 'articles') {
								echo '<div class="d-flex justify-content-start">
									<span>'. name_post_business($value->pbd_business_id) .'</span>
									<span class="ms-1">added new article</span>
								</div>';
							} else if ($post_type === 'users_updated_photo_profile') {
								echo '<div class="d-flex justify-content-start">
									<span>'. name_post_business($value->pbd_business_id) .'</span>
									<span class="ms-1">updated the profile picture</span>
								</div>';
							} else if ($post_type === 'job') {
								echo '<span>'. name_post_business($value->pbd_business_id) .'</span>
									  <span class="ms-1">Need '. get_job_name_by_id($value->id) .'</span>';
							} else if ($value->status_buy_sells == '1') {
								echo '<span>'. name_post_users($value->users_id) .'</span>
										<span class="ms-1">Publish a listing at Buy & Sells</span>';
							} else if ($post_type === 'tender') {
								echo '
									<span>'. name_post_business($value->pbd_business_id) .'</span>
									<span>Publish a project at Tender</span>';
							} else if ($post_type === 'posts' && empty($value->relate_id)) {
								echo '<div class="d-flex flex-row justify-content-start">
									<span>'. name_post_business($value->pbd_business_id) .'</span>
								</div>';
							} else if ($post_type === 'posts_look_for' && empty($value->relate_id) && empty($value->post_liked)) {
								echo '<div class="d-flex flex-row justify-content-start">
									<span>'. name_post_business($value->pbd_business_id) .'</span>
								</div>';
							} else if ($post_type === 'posts' && ! empty($value->relate_id) && empty($value->post_liked)) {
								echo '<div class="d-flex justify-content-start">
									<span>'. name_post_business($value->pbd_business_id) .'</span>
									<span class="ms-1">commented a post of '. ' ' . name_post_users($value->owner_post_id) .'</span>
								</div>';
							} else if (! empty($value->relate_id) && $value->post_liked == true) {
								echo '<div class="d-flex justify-content-start">
									<span>'. name_post_business($value->pbd_business_id) .'</span>
									<span class="ms-1">liking a post of '. ' ' . name_post_users($value->owner_post_id) .'</span>
								</div>';
							}
						}
						?>
						<abbr title="<?php echo carbon_long($value->created_at)?>" class="text-decoration-none fs-14"><span class="text-muted"><?php echo carbon_human($value->created_at);?></span></abbr>
					</div>
						<?php }
					} ?>
					<div class="ms-auto">
						<?php
						$editTarget = "#textPostEdit";
						$editType = 'text';
						if($value->file_video_name || $value->file_video_url) {
							$editTarget = "#videoPostEdit";
							$editType = 'video';
						}else if($value->file_image_path || $value->file_image_url) {
							$editTarget = "#photoPostEdit";
							$editType = 'photo';
						}
						?>
					<?php if($users->id == $value->users_id && empty($value->relate_id)) { ?>
						<div class="dropdown">
							<a type="button" id="dropdownMenuButton1" role="button" data-bs-toggle="dropdown"
								aria-expanded="false">
								<span class="text-muted material-icons">more_horiz</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
								<li>
									<?php if(!empty($value->data_name) && $post_type === 'articles'){ ?>
										<a class="dropdown-item fs-14" href="<?php echo base_url('/articles/edit/').$value->users_id.'/'.$value->id ?>">Edit</a>
									<?php }elseif(!empty($value->data_name) && $post_type === 'job'){ ?>
										<a class="dropdown-item fs-14" href="<?php echo base_url('/jobs/edit/').$value->id ?>">Edit</a>
									<?php }elseif(!empty($value->data_name) && $post_type === 'tender'){ ?>
										<a class="dropdown-item fs-14" href="<?php echo base_url('/tender/edit/').$value->id ?>">Edit</a>
									<?php }elseif(!empty($value->data_name) && $value->status_buy_sells == '1'){ ?>
										<a class="dropdown-item fs-14" href="<?php echo base_url('/buysells/manage/').$value->id ?>">Edit</a>
									<?php }elseif(empty($value->data_name) && $post_type === 'posts' && empty($value->relate_id)){ ?>
										<a class="dropdown-item fs-14" data-bs-toggle="modal" data-bs-target="<?php echo $editTarget?>" data-from="dashboard" data-post-type="<?php echo $editType?>" data-post-id="<?php echo $post_id?>">Edit</a>
									<?php }elseif(empty($value->data_name) && $post_type === 'posts_lookfor'){ ?>
										<a class="dropdown-item fs-14" data-bs-toggle="modal" data-bs-target="<?php echo $editTarget?>" data-from="dashboard" data-post-type="<?php echo $editType?>" data-post-id="<?php echo $post_id?>">Edit</a>
									<?php } ?>
								</li>
								<li>
									<?php if(!empty($value->data_name) && $post_type === 'articles'){ ?>
										<a class="dropdown-item fs-14" role="button" data-bs-toggle="modal" href="#del_article<?php echo $value->id ?>">Delete</a>
									<?php }elseif(!empty($value->data_name) && $post_type === 'job'){ ?>
										<a class="dropdown-item fs-14" role="button" data-bs-toggle="modal" href="#del_job<?php echo $value->id ?>">Delete</a>
									<?php }elseif(!empty($value->data_name) && $post_type === 'tender'){ ?>
										<a class="dropdown-item fs-14" role="button" data-bs-toggle="modal" href="#del_tender<?php echo $value->id ?>">Delete</a>
									<?php }elseif(!empty($value->data_name) && $value->status_buy_sells == '1'){ ?>
										<a class="dropdown-item fs-14" role="button" data-bs-toggle="modal" href="#del_buysells<?php echo $value->id ?>">Delete</a>
									<?php }elseif(empty($value->data_name) && $post_type === 'posts' && empty($value->relate_id)){ ?>
										<a class="dropdown-item fs-14" data-bs-toggle="modal"
										data-bs-target="#del_post_text_dashboard<?php echo $post_id ?>" href="#">Delete</a>
									<?php }elseif(empty($value->data_name) && $post_type === 'posts_lookfor'){ ?>
										<a class="dropdown-item fs-14" data-bs-toggle="modal"
										data-bs-target="#del_post_lookfor_text_dashboard<?php echo $post_id ?>" href="#">Delete</a>
									<?php }elseif(empty($value->data_name) && $post_type === 'users_updated_photo_profile'){ ?>
										<a class="dropdown-item fs-14" data-bs-toggle="modal"
										data-bs-target="#del_post_updated_photo_profile<?php echo $value->id ?>" href="#">Delete</a>
									<?php } ?>
								</li>
							</ul>
						</div>
					<?php } ?>
					</div>
				</div>
				<?php if(empty($value->data_name) && $post_type === 'posts' && empty($value->relate_id)) :?>
				<div class="placeholder-glow thepost" data-id="<?php echo $value->id ?>">
					<?php if($value->file_image_path || $value->file_image_url) : ?>
						<?php if($value->file_image_url) {?>
						<img data-src="<?php echo $value->file_image_url; ?>" class="mb-4 mx-auto d-block w-100 placeholder fit-contain" alt="" data-imgtype="photo" >
						<?php }else{ ?>
						<img data-src="<?php echo base_url() . $value->file_image_path .'/'. $value->file_image_name_original?>" class="mb-4 mx-auto d-block w-100 placeholder fit-contain" alt="" >
						<?php } ?>
					<?php elseif($value->file_video_name || $value->file_video_url) : ?>
						<?php if($value->file_video_url) { ?>
						<video id="vid-<?php echo $value->id ?>" playsinline="playsinline" loop="loop"  controls="controls" class="video-js vjs-default-skin vjs-16-9"  data-setup='{
							"techOrder": ["youtube", "html5"],
							"sources": [{
								"type": "video/youtube",
								"src": "<?php echo $value->file_video_url ?>"
							}],
							"youtube": {
								"modestbranding": 1,
								"origin": "<?php echo base_url() ?>",
								"color": "white"
							}
						}'>
						</video>
						<?php }else{ ?>
						<video playsinline="playsinline" loop="loop"  controls="controls" class="w-100 placeholder">
							<source data-src="<?php echo base_url() . $value->file_video_path .'/'. $value->file_video_name?>" type="video/mp4">
						</video>
						<?php } ?>
					<?php endif;?>
					<div class="px-4 pt-3 text-pre-wrap text-break js-postlink"><?php echo $description; ?></div>
				</div>
				<?php elseif(empty($value->data_name) && $post_type === 'posts' && ! empty($value->relate_id)) :?>
				<div class="d-flex align-items-center p-md-4 p-2">
				<div class="d-flex justify-content-center h-100">
												<div class="image_outer_container">
													<div class="green_icon" style="<?php echo user_online($value->owner_post_id) ?>"></div>
														<div class="image_inner_container">
															<span><?php echo img_post_users($value->owner_post_id); ?></span>
														</div>
													</div>
												</div>
												<div class='status-circle'></div>
					<span class="ms-1"><?php echo name_post_users($value->owner_post_id) ?></span>
				</div>
				<div class="placeholder-glow thepost" data-id="<?php echo $value->relate_id ?>">
					<?php if($value->file_image_path || $value->file_image_url) : ?>
						<?php if($value->file_image_url) {?>
						<img data-src="<?php echo $value->file_image_url; ?>" class="mb-4 mx-auto d-block w-100 placeholder fit-contain" alt="" data-imgtype="photo" >
						<?php }else{ ?>
						<img data-src="<?php echo base_url() . $value->file_image_path .'/'. $value->file_image_name_original?>" class="mb-4 mx-auto d-block w-100 placeholder fit-contain" alt="" >
						<?php } ?>
					<?php elseif($value->file_video_name || $value->file_video_url) : ?>
						<?php if($value->file_video_url) { ?>
						<video id="vid-<?php echo $value->id ?>" playsinline="playsinline" loop="loop"  controls="controls" class="video-js vjs-default-skin vjs-16-9"  data-setup='{
							"techOrder": ["youtube", "html5"],
							"sources": [{
								"type": "video/youtube",
								"src": "<?php echo $value->file_video_url ?>"
							}],
							"youtube": {
								"modestbranding": 1,
								"origin": "<?php echo base_url() ?>",
								"color": "white"
							}
						}'>
						</video>
						<?php }else{ ?>
						<video playsinline="playsinline" loop="loop"  controls="controls" class="w-100 placeholder">
							<source data-src="<?php echo base_url() . $value->file_video_path .'/'. $value->file_video_name?>" type="video/mp4">
						</video>
						<?php } ?>
					<?php endif;?>
					<div class="px-4 pt-3 text-pre-wrap text-break js-postlink"><?php echo $description; ?></div>
				</div>
				<?php elseif(empty($value->data_name) && $post_type === 'posts_lookfor') :?>
					<div class="placeholder-glow thepost" data-id="<?php echo $value->id ?>">
						<div class="px-4 pt-3 text-pre-wrap text-break js-postlink"><?php echo $description; ?></div>
					</div>
				<?php elseif(empty($value->data_name) && $post_type === 'users_updated_photo_profile') :?>
					<div class="placeholder-glow thepost" data-id="<?php echo $value->id ?>">
						<img data-src="<?php echo base_url() . $value->file_image_path .'/'. $value->file_image_name_original?>" class="mb-4 mx-auto d-block placeholder fit-contain" alt="User Photo Profile" width="150" height="150">
					</div>
				<?php elseif (!empty($value->data_name) && $value->status_buy_sells === "1") :?>
					<div class="row g-0 bg-light position-relative article-post m-4 px-2">
						<div class="col-md-12 p-4 ps-md-0">
							<h5 class="mt-0 fw-semi text-prussianblue align-items-center d-flex fs-18">
								<?php 
									if ($value->price_type == '1') {
										echo "Free (For Donation, Unused Products)";
									} else if ($value->price_type == '2') {
										echo "Fixed Price $value->price_currency $value->price_low";
									} else if ($value->price_type == '3') {
										echo "Starting at $value->price_currency $value->price_low";
									} else if ($value->price_type == '4') {
										echo "Ask for Price (Via Whatsapp/Email)";
									} else if ($value->price_type == '5') {
										echo "Variable Price";
									}
								?>
								(<?= $value->data_name ?>)
							</h5>
							<span class="text-black fs-14"><?= get_buy_sells_category($value->file_video_name) ?>,</span>
							<span class="text-black fs-14"><?= get_buy_sells_status($value->id) ?></span>
						</div>
						<div class="col-md-12 mx-auto mb-md-0 p-md-4 placeholder-glow">
							<img data-src="<?php echo placeholder($value->file_image_path, 	$value->file_image_name_original, 'tender', '4x3') ?>" class="rounded-3 border placeholder w-100" alt="<?php echo slug($value->data_name) ?>" data-imgtype="article">
						</div>
						<div class="col-md-12 p-4 ps-md-0">
							<?php
								$buy_sells_desc = $value->data_description;
								// if (strlen($buy_sells_desc) <= 200) {
								// 	$buy_sells_desc = $value->data_description;
								// } else {
								// 	$buy_sells_desc = substr($value->data_description , 0, 200) . '...';
								// }
							?>
							<p class="text-black text-break text-pre-line fs-14"><?= $buy_sells_desc; ?></p>
						</div>
					</div>
				<?php elseif (!empty($value->data_name) && $post_type === 'job') :?>
					<div class="row g-0 bg-light position-relative article-post m-4 px-2">
						<div class="col-md-12 p-4 ps-md-0">
							<h5 class="mt-0 fw-semi text-prussianblue align-items-center d-flex fs-18"><?= $value->data_name; ?></h5>
							<span class="text-black fs-14"><?= get_job_type_by_id($value->data_types) ?>,</span>
							<span class="text-black fs-14"><?= json_decode($value->data_location)[0]->country_name ?>,</span>
							<span class="text-black fs-14"><?= json_decode($value->data_location)[0]->city_name ?></span>
						</div>
						<div class="col-md-12 mx-auto mb-md-0 p-md-4 placeholder-glow">
							<img data-src="<?php echo placeholder($value->file_image_path, 	$value->file_image_name_original, 'tender', '4x3') ?>" class="rounded-3 border placeholder w-100" alt="<?php echo slug($value->data_name) ?>" data-imgtype="article">
						</div>
						<div class="col-md-12 p-4 ps-md-0">
							<?php
								$job_desc = $value->data_description;
								if (strlen($job_desc) <= 200) {
									$job_desc = $value->data_description;
								} else {
									$job_desc = substr($value->data_description , 0, 200) . '...';
								}
							?>
							<p class="text-black text-break text-pre-line fs-14"><?= $job_desc; ?></p>
							<a class="m-0 p-0 btn btn-link" href="<?= base_url() . 'jobs/detail/' . $value->id; ?>" target="_blank">Read more</a>
						</div>
					</div>
				<?php elseif (!empty($value->data_name) && $post_type === 'articles') :?>
					<div class="row g-0 bg-light position-relative article-post m-4">
						<div class="col-md-6 mb-md-0 p-md-4 placeholder-glow">
							<img data-src="<?php echo placeholder($value->file_image_path, 	$value->file_image_name_original, 'article', '4x3') ?>" class="rounded-3 border placeholder w-100" alt="<?php echo slug($value->data_name) ?>" data-imgtype="article">
						</div>
						<div class="col-md-6 p-4 ps-md-0">
							<h5 class="mt-0 fw-semi text-prussianblue align-items-center d-flex fs-18"><?php echo $value->data_name ?></h5>
							<span class="text-muted fs-14 mb-4"><?php echo !empty(category_article($value->id)) ? category_article($value->id) : "No Categories" ?></span>
							<span class="text-black text-break text-pre-line lh-1 fs-14 text-truncate text-decoration-none article-desc"><?php echo words($value->data_description, 50); ?></span>
							<a href="<?php echo site_url('articles/detail/'.$value->id) ?>" class="stretched-link"></a>
						</div>
					</div>
				<?php elseif (!empty($value->data_name) && $post_type === 'tender') :?>
					<div class="row g-0 bg-light position-relative article-post m-4 px-2">
						<div class="col-md-12 p-4 ps-md-0">
							<h5 class="mt-0 fw-semi text-prussianblue align-items-center d-flex fs-18"><?php echo $value->data_name ?></h5>
							<span class="text-black fs-14"><?= get_tender_type_name_by_id($value->data_types) . ','; ?></span>
							<span class="text-black fs-14"><?= get_tender_category_name_by_id($value->file_video_name) . ',' ?></span>
							<span class="text-black fs-14"><?= date('d F Y', strtotime($value->date_open)); ?></span>
						</div>
						<div class="col-md-12 mx-auto mb-md-0 p-md-4 placeholder-glow">
							<img data-src="<?php echo placeholder($value->file_image_path, 	$value->file_image_name_original, 'tender', '4x3') ?>" class="rounded-3 border placeholder w-100" alt="<?php echo slug($value->data_name) ?>" data-imgtype="article">
						</div>
						<div class="col-md-12 p-4 ps-md-0">
							<p class="text-black text-break text-pre-line lh-1 fs-14 text-truncate text-decoration-none article-desc"><?= $value->data_description; ?></p>
						</div>
					</div>
				<?php endif;?>
				<div class="d-flex align-items-center mb-3 flex-column flex-md-row">
					<div class="ms-md-3 me-md-auto">
						<div class="d-flex justify-content-start my-2 text-prussianblue">
							<div class="d-flex mx-2 align-items-center">
								<span class="material-icons-outlined md-16 me-2">thumb_up</span>
								<?php
									$post_like_id = !(empty($value->relate_id)) ? $value->relate_id : $value->id;
									$this->db->select('*');
									if (!empty($value->relate_id)) {
										$this->db->where('relate_id', $value->relate_id);
									} else {
										$this->db->where('relate_id', $value->id);
									}
									$query = $this->db->get('pfe_media_likes');
									$liked = FALSE;
								foreach ($query->result() as $row)
									{
									if($row->users_id === $this->session->userdata('user_id')) {
										$liked = TRUE;
									}
								}
									$num = count($query->result());
									echo "<small> <span id='like_".$post_like_id."'>".$num."</span> Like</small>";
								?>
							</div>
							<div class="d-flex mx-2 align-items-center">
								<span class="material-icons-outlined md-16 me-2">message</span>
								<?php
									$post_comment_id = !(empty($value->relate_id)) ? $value->relate_id : $value->id;
									$this->db->select('*');
									if (!empty($value->relate_id)) {
										$this->db->where('relate_id', $value->relate_id);
									} else {
										$this->db->where('relate_id', $value->id);
									}
									$query = $this->db->get('pfe_media_comments');
									$coms = $query->num_rows();
									echo "<small><span id='like_".$post_comment_id."'>".$coms."</span> Comments</small>";
								?>
							</div>
							<div class="d-flex mx-2 align-items-center">
								<span class="material-icons-outlined md-16 me-2">share</span>
								<small>Shares</small>
							</div>
						</div>
					</div>
					<div class="ms-md-3 me-md-auto">
					<?php //if (empty($value->relate_id)) { ?>
						<div class="d-flex my-2">
							<div class="d-flex me-2 ms-1">
								<button type="button" onclick="like('<?php echo $post_like_id;?>',this)" class="btn btn-outline-monik flex-fill fs-14 <?php if($liked) { echo 'active'; } ?>" data-bs-toggle="button" autocomplete="off" aria-pressed="<?php if($liked) { echo 'true';
								} else { echo 'false';} ?>" id="btnLike_<?php echo $post_like_id;?>">
									<span class="material-icons-outlined md-16 me-2 align-middle">thumb_up</span>
									Like
								</button>
							</div>
							<div class="d-flex me-2">
								<?php if (empty($value->relate_id)) { ?>
								<button type="button" onclick="comment('<?php echo $value->id;?>',this)" class="btn btn-outline-monik fs-14">
									<span class="material-icons-outlined md-16 me-2 align-middle">message</span>
									Comment
								</button>
								<?php } else if (!empty($value->relate_id)) { ?>
									<button type="button" onclick="comment2('<?php echo $value->relate_id;?>','<?php echo $value->users_id?>',this)" class="btn btn-outline-monik fs-14">
									<span class="material-icons-outlined md-16 me-2 align-middle">message</span>
									Comment
								</button>
								<?php } ?>
							</div>
							<?php if (empty($value->data_name && $post_type === 'posts')) { ?>
								<div class="d-flex me-2">
									<button type="button" class="btn btn-outline-monik" data-bs-toggle="modal" href="#modal_share" data-post-id="<?php echo $value->id ?>">
										<span class="material-icons-outlined md-16 me-2 align-middle">share</span>
										Share
									</button>
								</div>
							<?php } elseif (empty($value->data_name && $post_type === 'posts_lookfor')) { ?>
								<div class="d-flex me-2">
									<button type="button" class="btn btn-outline-monik" data-bs-toggle="modal" href="#modal_share" data-post-id="<?php echo $value->id ?>">
										<span class="material-icons-outlined md-16 me-2 align-middle">share</span>
										Share
									</button>
								</div>
							<?php } elseif (!empty($value->data_name && $post_type === 'articles')) { ?>
								<div class="d-flex me-2">
									<button type="button" class="btn btn-outline-monik" data-bs-toggle="modal" href="#modal_share" data-post-id="<?php echo $value->id ?>">
										<span class="material-icons-outlined md-16 me-2 align-middle">share</span>
										Share
									</button>
								</div>
							<?php } elseif (!empty($value->data_name && $post_type === 'tender')) { ?>
								<div class="d-flex me-2">
									<button type="button" class="btn btn-outline-monik" data-bs-toggle="modal" href="#modal_share" data-post-id="<?php echo $value->id ?>">
										<span class="material-icons-outlined md-16 me-2 align-middle">share</span>
										Share
									</button>
								</div>
							<?php } ?>
						</div>
						<?php //} ?>
					</div>
				</div>
				<?php //if (empty($relate_id)) { ?>
				<?php 
				$postID = empty($value->relate_id) ? $value->id : $value->relate_id;
				?>
				<?php echo "<div class='comments w-100 px-4 d-none js-comment-field-show' data-postId='".$postID."' id='show_comment_".$post_id."'></div>"; ?>
				<div class='comments w-100 px-4 mb-3 py-3' id="<?php "new_comment" ?>">
					<div id="<?php echo 'comment_field_'.$post_id ?>" data-postId="<?php echo $postID?>" class="js-comment-field d-none status-foot row align-items-center">
						<div class="col-md-1 col-sm-2 user-comments">
							<?php if(empty($users->file_name_original)) { ?>
							<img src="<?php echo base_url()?>public/themes/user/images/placehold/user-1x1.png" class="rounded-circle feed-user-img" alt="">
							<?php }else{ ?>
							<img src="<?php echo base_url().$users->file_path . $users->file_name_original?>" class="rounded-circle feed-user-img" alt="">
							<?php } ?>
						</div>
						<div class="col align-items-center pl-sm-0">
							<?php if (empty($value->relate_id)) { ?>
								<?php echo "<input type='text' name='comment' id='comment_".$postID."' class='comment form-control emoji-comment' placeholder='Write a comment...'>"; ?>
							<?php } else if (!empty($value->relate_id)) { ?>
								<?php echo "<input type='text' name='comment' id='comment_relate_".$postID."' class='comment form-control emoji-comment' placeholder='Write a comment...'>"; ?>
							<?php } ?>
						</div>
						<div class="col-2 d-grid">
						<button class="js-publisher btn btn-sm btn-danger mx-auto">
							<span id="" class="js-publisher-stats">Post</span>
							<span id="js-spinner-pub" class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
							<span id="js-spinner-load" class="d-none">Loading...</span>
						</button>
						</div>
					</div>
				</div>
			</div>
			<?php //} ?>
			<?php endforeach; ?>

			</div>
