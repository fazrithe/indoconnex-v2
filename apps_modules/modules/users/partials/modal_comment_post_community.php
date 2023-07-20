<?php
    foreach($albums_photo as $valphoto){
?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
<!-- Modal -->
<div class="modal fade" id="photodetailModal<?php echo $valphoto->id ?>" tabindex="-1" aria-labelledby="photodetailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-body card">
                <div class="row modal-album h-100">
                    <div class="col-md-8 bg-gray rounded-3 d-flex flex-column imagi">
                        <div class="row">
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="row justify-content-center align-items-center d-flex h-100">
                            <img src="<?php echo base_url()?><?php echo $valphoto->file_path ?><?php echo $valphoto->file_name_original ?>" class="img-fluid fit-contain mh-100 mw-100" alt="" style="padding-bottom:5%">
                        </div>
                    </div>
                    <div class="col-lg-4 px-2 py-2 overflow-y-scroll overflow-x-hidden mh-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center p-0 mb-3">
                                <?php
                                    foreach($data_users as $valuser){
                                    if($valuser->id == $valphoto->users_id){
                                ?>
                                    <div>
                                    <?php if(empty($users->file_name_original)){
                                ?>
                                    <img src="<?php echo base_url()?>public/themes/user/images/placehold/community-1x1.png" class="rounded-circle feed-user-img" alt="">
                                    <?php }else{ ?>
                                    <img src="<?php echo base_url().$users->file_path . $users->file_name_original?>" class="rounded-circle feed-user-img" alt="">
                                    <?php } ?>
                                </div>
                                <div class="ms-3 d-flex flex-column">
                                    <a href="<?php echo site_url('post/'.$valuser->username) ?>"><span class="text-prussianblue fw-bold"><?php echo $valuser->name_first ?> <?php echo $valuser->name_middle ?> <?php echo $valuser->name_last ?></span></a>
                                    <abbr title="<?php echo carbon_long($valphoto->created_at)?>" class="text-decoration-none"><span class="text-muted"><?php echo carbon_human($valphoto->created_at);?></span></abbr>
                                </div>
                                <?php }} ?>
                                <div class="ms-auto">
                                    <?php if(!empty($checkusers_profile)) { ?>
                                    <div class="dropdown">
                                        <a type="button" id="dropdownMenuButton1" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="text-muted material-icons">more_horiz</span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a class="dropdown-item" data-bs-toggle="modal" href="#photoeditModal" data-photo-id="<?php echo $valphoto->id; ?>">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#photo<?php echo $valphoto->id ?>" data-photo-id="">Delete</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <?php } ?>
                                </div>
                            </div>
                            <div>
                                <span id="caption-<?php echo $valphoto->id?>" class="text-pre-wrap text-break"><?php echo $valphoto->file_caption; ?></span>
                            </div>
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="d-flex justify-content-center my-2 text-prussianblue">
                                        <div class="d-flex mx-2 align-items-center">
                                            <span class="material-icons fs-14 me-2 align-middle">thumb_up</span>
                                            <?php
                                                $this->db->select('*');
                                                $this->db->where('relate_id',$valphoto->id);
                                                $query = $this->db->get('pfe_media_likes');
                                                $liked = false;
                                                foreach ($query->result() as $row)
                                                {
                                                    if($row->users_id === $this->session->userdata('user_id')){
                                                        $liked = true;
                                                    }
                                                }
                                                $num = count($query->result());
                                                echo "<small> <span id='like_".$valphoto->id."'>".$num."</span> Like</small>";
                                            ?>
                                        </div>
                                        <div class="d-flex mx-2 align-items-center">
                                            <span class="material-icons fs-14 me-2 align-middle">comment</span>
                                            <?php
                                                $this->db->select('*');
                                                $this->db->where('relate_id',$valphoto->id);
                                                $query = $this->db->get('pfe_media_comments');
                                                $coms = $query->num_rows();
                                                echo "<small><span id='like_".$valphoto->id."'>".$coms."</span> Comments</small>";
                                            ?>
                                        </div>
                                        <div class="d-flex mx-2 align-items-center">
                                            <span class="material-icons-outlined fs-14 me-2 align-middle">share</span>
                                            <small>0 Shares</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-2">
                                <div class="col">
                                    <div class="d-flex justify-content-center my-2">
                                        <div class="d-flex mx-2">
                                            <button type="button" onclick="like('<?php echo $valphoto->id;?>',this)" class="btn btn-outline-monik flex-fill <?php if($liked) echo 'active' ?>" data-bs-toggle="button" aria-pressed="<?php echo $liked ?>" id="btnLike_<?php echo $valphoto->id;?>">
                                                <span class="material-icons md-20 me-2 align-middle">thumb_up</span>
                                                Like
                                            </button>
                                        </div>
                                        <div class="d-flex mx-2">
                                            <button type="button" onclick="comment('<?php echo $valphoto->id;?>',this)" class="btn btn-outline-monik">
                                                <span class="material-icons md-20 me-2 align-middle">comment</span>
                                                Comment
                                            </button>
                                        </div>
                                        <div class="d-flex mx-2">
                                            <button type="button" class="btn btn-outline-monik" data-bs-toggle="modal" href="#modal_share" data-post-id="<?php echo $valphoto->id ?>">
                                                <span class="material-icons md-20 me-2 align-middle">share</span>
                                                Share
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo "<div class='comments w-100' id='show_comment_".$valphoto->id."'>"; ?>
                            </div>
                            <div class='comments w-100' id="<?php "new_comment" ?>">
                                <div id="<?php echo 'comment_field_'.$valphoto->id ?>" class="d-none status-foot row align-items-center">
                                    <div class="col-md-2 col-sm-4 user-comments">
                                        <?php if(empty($users->file_name_original)){
                                        ?>
                                        <img src="<?php echo base_url()?>public/themes/user/images/placehold/user-1x1.png" class="rounded-circle feed-user-img" alt="">
                                        <?php }else{ ?>
                                        <img src="<?php echo base_url().$users->file_path . $users->file_name_original?>" class="rounded-circle feed-user-img" alt="">
                                        <?php } ?>
                                    </div>
                                    <div class="col align-items-center pl-sm-0 ">
                                    <input type="hidden" name="post_id" id="post_id" value="<?php echo $valphoto->id ?>">
                                        <?php echo "<input type='text' name='comment' id='comment_".$valphoto->id."' class='w-100 comment form-control input-sm' placeholder='Write a comment...'>"; ?>
                                    </div>
                                    <div class="col-2 d-grid">
                                    <button class="btn btn-sm btn-danger mx-auto" onclick="postCommentAdd('<?php echo $valphoto->id ?>', this)">
                                        <span id="publisher" class="">Post</span>
                                        <span id="spinner-pub" class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        <span id="spinner-load" class="d-none">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<div class="modal fade" id="photoeditModal" tabindex="-1"
    aria-labelledby="photoeditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Edit Photo Caption</h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="" method="post">
            <div class="modal-body">
                <input type="text" name="edit-id" id="edit-id">
                <input type="text" name="edit-business-id" id="edit-business-id">
                <input type="text" name="edit-user-id" id="edit-user-id">
                <input type="text" name="edit-album-id" id="edit-album-id">
                <textarea class="form-control" name="edit-caption" id="edit-caption" cols="10" rows="5"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-muted"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view($template['action_ajax_album']); ?>
