
<?php $this->load->view($template['partials_navbar_business_public']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
<input type="hidden" id="business_id" value="<?php echo $business->id ?>">
<input type="hidden" id="business_username" value="<?php echo $business->data_username ?>">
<!-- BODY -->
<div class="container mb-4">
    <div class="row">

        <?php $this->load->view($template['sidebar_business_profile'], $business); ?>

        <!-- SECTION -->
        <div class="col-auto col-md-9 ">
            <?php if(!empty($checkusers_profile)){ ?>
            <!-- POST -->
            <div class="mb-4 p-4 rounded-3 msn-widget">
                <div class="d-flex align-items-center">
                    <div class="me-4">
                    <?php if(empty($business->file_name_original)){
                    ?>
                        <img src="<?php echo base_url()?>public/themes/user/images/placehold/business-1x1.png" class="rounded-circle feed-user-img" alt="">
                        <?php }else{ ?>
                        <img src="<?php echo base_url().$business->file_path . $business->file_name_original?>" class="rounded-circle feed-user-img" alt="">
                    <?php } ?>
                    </div>
                    <div class="flex-grow-1 me-4">
                        <input class="form-control" type="text" placeholder="Create post"
                            aria-label="Create post" onclick="textPost('business')" data-name_form="profile">
                    </div>
                    <div class="me-4">
                        <button class="btn d-flex align-items-center justify-content-center" onclick="photoPost('business')">
                            <img src="<?php echo theme_user_locations(); ?>images/icons/photo.svg" class="status-icon">
                            <small class="d-none d-lg-block ms-2">Photo</small>
                        </button>
                    </div>
                    <div class="me-4">
                        <button class="btn d-flex align-items-center justify-content-center" onclick="videoPost('business')">
                            <img src="<?php echo theme_user_locations(); ?>images/icons/video.svg" class="status-icon">
                            <small class="d-none d-lg-block ms-2">Video</small>
                        </button>
                    </div>
                    <div class="me-4">
                        <a href="<?php echo site_url('articles/create/'.$this->session->userdata('user_id')) ?>" role="button" class="btn d-flex align-items-center justify-content-center" id="mediapostButton">
                            <img src="<?php echo theme_user_locations(); ?>images/icons/article.svg" width="24">
                            <small class="d-none d-lg-block ms-2">Article</small>
                        </a>
                    </div>
                    <div>
                        <button class="btn d-flex align-items-center justify-content-center" data-bs-toggle="modal"
                            data-bs-target="#jobPost" id="mediapostButton">
                            <img src="<?php echo theme_user_locations(); ?>images/icons/lookingfor.svg" width="24">
                            <small class="d-none d-lg-block ms-2">Look for</small>
                        </button>
                    </div>
                </div>
            </div>
            <?php }
            if ($posts):
            foreach($posts as $value):
                $description  = $value->data_description;
                $post_id = $value->id;
                if($value->pbd_business_id == $business->id){
            ?>
            <!-- USER POST -->
            <div class="mb-4 rounded-3 msn-widget" id="<?php echo $post_id; ?>">
                <div class="d-flex align-items-center p-md-4 p-2">
                    <div>
                    <?php if(empty($business->file_name_original)){
                    ?>
                        <img src="<?php echo base_url()?>public/themes/user/images/placehold/business-1x1.png" class="rounded-circle feed-user-img" alt="">
                        <?php }else{ ?>
                        <img src="<?php echo base_url().$business->file_path . $business->file_name_original?>" class="rounded-circle feed-user-img" alt="">
                    <?php } ?>
                    </div>
                    <div class="ms-3 d-flex flex-column">
                        <a href="<?php echo site_url('post/'.$business->data_name) ?>"><span class="text-prussianblue fw-bold"><?php echo $business->data_name ?></span></a>
                        <abbr title="<?php echo carbon_long($value->created_at)?>" class="text-decoration-none"><span class="text-muted"><?php echo carbon_human($value->created_at);?></span></abbr>
                    </div>
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
					<?php if($value->users_id) { ?>
						<div class="dropdown">
							<a type="button" id="dropdownMenuButton1" role="button" data-bs-toggle="dropdown"
								aria-expanded="false">
								<span class="text-muted material-icons">more_horiz</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
								<li>
									<?php if(!empty( $value->data_name)){ ?>
										<a class="dropdown-item fs-14" href="<?php echo base_url('/articles/edit/').$value->users_id.'/'.$value->id ?>">Edit</a>
									<?php }else{ ?>
										<a class="dropdown-item fs-14" data-bs-toggle="modal" data-bs-target="<?php echo $editTarget?>" data-from="business" data-post-type="<?php echo $editType?>" data-post-id="<?php echo $post_id?>">Edit</a>
									<?php } ?>
								</li>
								<li>
									<?php if(!empty( $value->data_name)){ ?>
										<a class="dropdown-item fs-14" role="button" data-bs-toggle="modal" href="#del_article<?php echo $value->id ?>">Delete</a>
									<?php }else{ ?>
										<a class="dropdown-item fs-14" data-bs-toggle="modal"
										data-bs-target="#del_post_text_dashboard<?php echo $post_id ?>" href="#">Delete</a>
									<?php } ?>
								</li>
							</ul>
						</div>
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
                        <?php } ?>
                    </div>
                </div>
                <?php if(empty($value->data_name)) :?>
                <div class="placeholder-glow thepost">
                    <?php if($value->file_image_path || $value->file_image_url): ?>
                        <?php if($value->file_image_url){?>
                        <img data-src="<?php echo $value->file_image_url; ?>" class="mb-4 mx-auto d-block w-100 placeholder fit-contain" alt="" >
                        <?php }else{ ?>
                        <img data-src="<?php echo base_url() . $value->file_image_path .'/'. $value->file_image_name_original?>" class="mb-4 mx-auto d-block w-100 placeholder fit-contain" alt="" >
                        <?php } ?>
                    <?php elseif($value->file_video_path || $value->file_video_url): ?>
                        <?php if($value->file_video_url){ ?>
                        <video id="vid-<?php echo $value->id ?>" playsinline="playsinline" loop="loop"  controls="controls" class="w-100 video-js vjs-default-skin vjs-16-9 "  data-setup='{
                            "techOrder": ["youtube", "html5"],
                            "sources": [{
                                "type": "video/youtube",
                                "src": "<?php echo $value->file_video_url ?>"
                            }]
                        }'>
                        </video>
                        <?php }else{ ?>
                        <video playsinline="playsinline" loop="loop"  controls="controls" class="w-100 placeholder">
                            <source data-src="<?php echo base_url() . $value->file_video_path .'/'. $value->file_video_name?>" type="video/mp4">
                        </video>
                        <?php } ?>
                    <?php endif;?>
                    <p class="px-4 pt-3 text-pre-wrap text-break js-postlink"><?php echo $description; ?></p>
                </div>
                <?php elseif (!empty($value->data_name)) :?>
                    <div class="article-post d-flex bg-light align-items-center m-2 position-relative">
                    <div class="flex-shrink-0 placeholder-glow">
                    <img data-src="<?php echo placeholder($value->file_image_path, $value->file_image_name_original, 'article', '4x3') ?>" class="article-list m-3 rounded-3 border placeholder" alt="<?php echo slug($value->data_name) ?>" data-imgtype="article">
                    </div>
                    <div class="flex-grow-1 vstack m-3 article-desc" data-id="<?php echo $value->id ?>">
                        <a class="stretched-link" href="<?php echo site_url('articles/detail/'.$value->id) ?>"><h6 class="fw-semi text-prussianblue align-items-center d-flex fs-18"><?php echo $value->data_name ?></h6></a>
                        <span class="text-muted fs-14 mb-4"><?php echo !empty(category_article($value->id)) ? category_article($value->id) : "No Categories" ?></span>
                        <span class="text-black text-break text-pre-line lh-1 fs-14 text-truncate text-decoration-none article-desc"><?php echo words($value->data_description, 50); ?></span>
                    </div>
                </div>
                <?php endif;?>
                <div class="d-flex align-items-center mb-3 flex-column flex-md-row">
                    <div class="ms-md-3 me-md-auto">
                        <div class="d-flex justify-content-center my-2 text-prussianblue">
                            <div class="d-flex mx-2 align-items-center">
                                <span class="material-icons-outlined md-16 me-2">thumb_up</span>
                                <?php
                                    $this->db->select('*');
                                    $this->db->where('relate_id',$value->id);
                                    $query = $this->db->get('pfe_media_likes');
                                    $liked = false;
                                    foreach ($query->result() as $row)
                                    {
                                        if($row->users_id === $this->session->userdata('user_id')){
                                            $liked = true;
                                        }
                                    }
                                    $num = count($query->result());
                                    echo "<small> <span id='like_".$value->id."'>".$num."</span> Like</small>";

                                ?>
                            </div>
                            <div class="d-flex mx-2 align-items-center">
                                <span class="material-icons-outlined md-16 me-2">message</span>
                                <?php
                                    $this->db->select('*');
                                    $this->db->where('relate_id',$value->id);
                                    $query = $this->db->get('pfe_media_comments');
                                    $coms = $query->num_rows();
                                    echo "<small><span id='like_".$value->id."'>".$coms."</span> Comments</small>";
                                ?>
                            </div>
                            <div class="d-flex mx-2 align-items-center">
                                <span class="material-icons-outlined md-16 me-2">share</span>
                                <small>0 Shares</small>
                            </div>
                        </div>
                    </div>
                    <div class="me-md-3 ms-md-auto">
                        <div class="d-flex my-2">
                            <div class="d-flex mx-2">
                                <button type="button" onclick="like('<?php echo $value->id;?>',this)" class="btn btn-outline-monik flex-fill <?php if($liked) echo 'active' ?>" autocomplete="off" data-bs-toggle="button" aria-pressed="<?php if($liked) echo 'true'; else echo 'false'; ?>" id="btnLike_<?php echo $value->id;?>">
                                    <span class="material-icons-outlined md-16 me-2 align-middle">thumb_up</span>
                                    Like
                                </button>
                            </div>
                            <div class="d-flex mx-2">
                                <button type="button" onclick="comment('<?php echo $value->id;?>',this)" class="btn btn-outline-monik">
                                    <span class="material-icons-outlined md-16 me-2 align-middle">message</span>
                                    Comment
                                </button>
                            </div>
                            <div class="d-flex mx-2">
                                <button type="button" class="btn btn-outline-monik" data-bs-toggle="modal" href="#modal_share" data-post-id="<?php echo $value->id ?>">
                                    <span class="material-icons-outlined md-16 me-2 align-middle">share</span>
                                    Share
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo "<div class='comments w-100 px-4 pb-2' id='show_comment_".$value->id."'>"; ?>
                </div>
                <div class='comments w-100 px-4 mb-3 pb-2' id="<?php "new_comment" ?>">
                    <div id="<?php echo 'comment_field_'.$value->id ?>" data-postId="<?php echo $value->id?>"  class="js-comment-field d-none status-foot d-flex flex-row align-items-center ">
                        <div class="col-md-1 col-sm-2 user-comments">
                            <?php if(empty($users->file_name_original)){
                            ?>
                            <img src="<?php echo base_url()?>public/themes/user/images/placehold/user-1x1.png" class="rounded-circle feed-user-img" alt="">
                            <?php }else{ ?>
                            <img src="<?php echo base_url().$users->file_path . $users->file_name_original?>" class="rounded-circle feed-user-img" alt="">
                            <?php } ?>
                        </div>
                        <div class="col align-items-center pl-sm-0">
                        <input type="hidden" name="post_id" id="post_id" value="<?php echo $value->id ?>">
                            <?php echo "<input type='text' name='comment' id='comment_".$value->id."' class='comment form-control' placeholder='Write a comment...'>"; ?>
                        </div>
                        <div class="col-2 d-grid">
                        <button class="js-publisher btn btn-sm btn-danger mx-auto">
                            <span id="publisher" class="">Post</span>
                            <span id="spinner-pub" class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span id="spinner-load" class="d-none">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php } endforeach;
            else:
            ?>

            <div class="mb-4 rounded-3 msn-widget">
                <div class="d-flex align-items-center">
                    <img class="p-4 w-100" src="<?php echo base_url()?>public/themes/user/images/empty/post.png" alt="post-something">
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>
<?php $this->load->view($template['partials_modal_share']); ?>
