
<?php $this->load->view($template['partials_navbar_user']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
<input type="hidden" id="username" value="<?php echo $users_profile->username ?>">
<!-- BODY -->
<?php if(empty($users_profile->status_privacy) || !empty($checkusers_profile)) { ?>
<div class="container mb-4">
    <div class="row">
        <!-- ASIDE -->
        <?php $this->load->view($template['sidebar_user_profile']); ?>

        <!-- SECTION -->
        <div class="col-auto col-md-9">
            <!-- POST -->
            <?php if(!empty($checkusers_profile)){
                $this->load->view($template['partial_user_post']);
            }
            if ($posts):
            foreach($posts as $value):
                $description  = $value->data_description;
                $post_id = $value->id;
                if($value->users_id == $users_profile->id && ($value->pbd_business_id == 'undefined' || $value->pbd_business_id == null)){
            ?>
            <!-- USER POST -->
            <div class="mb-4 rounded-3 msn-widget" id="<?php echo $post_id; ?>">
                <div class="d-flex align-items-center p-md-4 p-2">
                    <div>
                        <?php if(empty($users_profile->file_name_original)): ?>
                        <img src="<?php echo base_url()?>public/themes/user/images/placehold/user-1x1.png" class="rounded-circle feed-user-img" alt="">
                        <?php else: ?>
                        <img src="<?php echo base_url().$users_profile->file_path . $users_profile->file_name_original?>" class="rounded-circle feed-user-img" alt="">
                        <?php endif ?>
                    </div>
                    <div class="ms-3 d-flex flex-column">
                    <?php echo name_post_users($value->users_id); ?>
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
					<?php if($users->id == $value->users_id) { ?>
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
										<a class="dropdown-item fs-14" data-bs-toggle="modal" data-bs-target="<?php echo $editTarget?>" data-from="" data-post-type="<?php echo $editType?>" data-post-id="<?php echo $post_id?>">Edit</a>
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
                        <video id="vid-<?php echo $value->id ?>" playsinline="playsinline" loop="loop"  controls="controls" class="w-100 video-js vjs-default-skin vjs-16-9"  data-setup='{
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
                <?php echo "<div class='comments d-none js-comment-field-show w-100 px-4 pb-2' data-postId='".$value->id."' id='show_comment_".$value->id."'>"; ?>
                </div>
                <div class='comments w-100 px-4 mb-3 pb-2' id="<?php "new_comment" ?>">
                    <div id="<?php echo 'comment_field_'.$value->id ?>" data-postId="<?php echo $value->id?>"  class="js-comment-field d-none status-foot d-flex flex-row align-items-center ">
                        <div class="col-md-1 col-sm-2 user-comments">
                            <?php if(empty($users->file_name_original)){
                            ?>
                            <img src="<?php echo base_url()?>public/themes/user/images/placehold/user-1x1.png" class="rounded-circle feed-user-img" alt="" >
                            <?php }else{ ?>
                            <img src="<?php echo base_url().$users->file_path . $users->file_name_original?>" class="rounded-circle feed-user-img" alt="" >
                            <?php } ?>
                        </div>
                        <div class="col align-items-center pl-sm-0">
                        <input type="hidden" name="post_id" id="post_id" value="<?php echo $value->id ?>">
                            <?php echo "<input type='text' name='comment' id='comment_".$value->id."' class='comment form-control emoji-comment' placeholder='Write a comment...'>"; ?>
                        </div>
                        <div class="col-2 d-grid">
                        <button class="js-publisher btn btn-sm btn-danger mx-auto">
                            <span id="publisher" class="">Post</span>
                            <span id="spinner-pub" class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span id="spinner-load" class="d-none">Loading...</span>
                        </button>
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
<?php $this->load->view($template['partials_modal_user']); ?>
<?php $this->load->view($template['partials_modal_post']); ?>
<?php $this->load->view($template['partials_modal_share']); ?>
<?php $this->load->view($template['partials_modal_article']); ?>
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
<script>
	$(function () {
		$('.emoji-comment').emoji({
			button:'&#x1F642;',
			place:'after',
			listCSS: {
                position:'absolute',
                border:'none',
                display:'none', 
                width: '300px',
                height: '150px',
                overflowY: 'scroll'
			},
			rowSize: 10,
			emojis: ['&#x1F642;','&#x1F641;','&#x1f600;','&#x1f601;','&#x1f602;','&#x1f603;','&#x1f604;','&#x1f605;','&#x1f606;','&#x1f607;','&#x1f608;','&#x1f609;','&#x1f60a;','&#x1f60b;','&#x1f60c;','&#x1f60d;','&#x1f60e;','&#x1f60f;','&#x1f610;','&#x1f611;','&#x1f612;','&#x1f613;','&#x1f614;','&#x1f615;','&#x1f616;','&#x1f617;','&#x1f618;','&#x1f619;','&#x1f61a;','&#x1f61b;','&#x1f61c;','&#x1f61d;','&#x1f61e;','&#x1f61f;','&#x1f620;','&#x1f621;','&#x1f622;','&#x1f623;','&#x1f624;','&#x1f625;','&#x1f626;','&#x1f627;','&#x1f628;','&#x1f629;','&#x1f62a;','&#x1f62b;','&#x1f62c;','&#x1f62d;','&#x1f62e;','&#x1f62f;','&#x1f630;','&#x1f631;','&#x1f632;','&#x1f633;','&#x1f634;','&#x1f635;','&#x1f636;','&#x1f637;','&#x1f638;','&#x1f639;','&#x1f63a;','&#x1f63b;','&#x1f63c;','&#x1f63d;','&#x1f63e;','&#x1f63f;','&#x1f640;','&#x1f643;','&#x1f4a9;','&#x1f644;','&#x2620;','&#x1F44C;','&#x1F44D;','&#x1F44E;','&#x1F648;','&#x1F649;','&#x1F64A;']
		});
	})
</script>
