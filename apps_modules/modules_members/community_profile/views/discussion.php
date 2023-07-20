
<?php $this->load->view($template['partials_navbar_community']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
<input type="hidden" id="community_id" value="<?php echo $community->id ?>">
<input type="hidden" id="community_name" value="<?php echo $community->data_name ?>">
<!-- BODY -->

<?php if(empty($community->status_privacy) || !empty($checkusers_profile)) { ?>
<div class="container mb-4">
    <div class="row">

        <?php $this->load->view($template['sidebar_community_profile']); ?>

        <!-- SECTION -->
        <div class="col-auto col-md-9 ">
            <?php if(!empty($is_community_member || !empty($checkusers_profile))){ ?>
            <!-- POST -->
            <div class="mb-4 p-4 rounded-3 msn-widget">
                <div class="d-flex align-items-center">
                    <div class="me-4">
                    <?php if(empty($community->file_name_original)){
                    ?>
                        <img src="<?php echo base_url()?>public/themes/user/images/placehold/community-1x1.png" class="rounded-circle feed-user-img" alt="">
                        <?php }else{ ?>
                        <img src="<?php echo base_url().$community->file_path . $community->file_name_original?>" class="rounded-circle feed-user-img" alt="">
                    <?php } ?>
                    </div>
                    <div class="flex-grow-1 me-4">
                        <input class="form-control" type="text" placeholder="Create post"
                            aria-label="Create post" onclick="textPost()" data-name_form="profile">
                    </div>
                    <div class="me-4">
                        <button class="btn d-flex align-items-center justify-content-center" onclick="photoPost()">
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
                    <div>
                    <button class="btn d-flex align-items-center justify-content-center" data-bs-toggle="modal"
                        data-bs-target="#jobPost" id="mediapostButton">
                        <img src="<?php echo theme_user_locations(); ?>images/icons/lookingfor.svg" width="24">
                        <small class="d-none d-lg-block ms-2 text-nowrap">Look for</small>
                    </button>
                    </div>
                </div>
            </div>
            <?php }

            if ($posts):
            foreach($posts as $value):
                $description  = $value->data_description;
                $post_id = $value->id;
                if($value->pcs_communities_id == $community->id){
            ?>
            <!-- USER POST -->
            <div class="mb-4 rounded-3 msn-widget" id="<?php echo $post_id; ?>">
                <div class="d-flex align-items-center p-md-4 p-2">
                    <div>
                    <?php if(empty($value->file_name_original_users)){
                    ?>
                        <img src="<?php echo base_url()?>public/themes/user/images/placehold/community-1x1.png" class="rounded-circle feed-user-img" alt="">
                        <?php }else{ ?>
                        <img src="<?php echo base_url().$value->file_path_users . $value->file_name_original_users?>" class="rounded-circle feed-user-img" alt="">
                    <?php } ?>
                    </div>
                    <div class="ms-3 d-flex flex-column">
                    <?php echo name_post_users($value->users_id); ?>
                        <abbr title="<?php echo carbon_long($value->created_at)?>" class="text-decoration-none"><span class="text-muted"><?php echo carbon_human($value->created_at);?></span></abbr>
                    </div>
                    <div class="ms-auto">
                        <?php
                         $edit = "textPostEdit('". $description . "','" . $post_id . "')";
                         if($value->file_video_path || $value->file_video_url){
                            $edit = "videoPostEdit('". $post_id . "')";
                        }else if($value->file_image_path || $value->file_image_url ){
                            $edit = "photoPostEdit('". $post_id . "')";
                        }
                         ?>
                        <div class="dropdown">
                            <a type="button" id="dropdownMenuButton1" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span class="text-muted material-icons">more_horiz</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="" onclick="<?php echo $edit ?>" href="#">Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#del_post_text<?php echo $post_id ?>" href="#">Delete</a>
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
                    </div>
                </div>
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
                    <p class="px-4 pt-3 text-pre-wrap text-break"><?php echo $description; ?></p>
                </div>
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

<?php $this->load->view($template['partials_modal_post_community']); ?>
<?php $this->load->view($template['partials_modal_share']); ?>
<?php $this->load->view($template['action_ajax_community']); ?>

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
