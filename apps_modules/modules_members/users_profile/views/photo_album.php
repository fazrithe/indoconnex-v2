<?php $this->load->view($template['partials_navbar_user']); ?>
<!-- BODY -->


<?php if(empty($users_profile->status_privacy) || !empty($checkusers_profile)) { ?>
<div class="container mb-4">
    <div class="p-4 bg-white">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('photo/'.$users_profile->username) ?>">Photo</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php if(empty($photo_albums->data_name)) echo "Untitled Album"; else echo $photo_albums->data_name ?></li>
            </ol>
        </nav>

        <div class="row row-cols-2 row-cols-lg-4 g-4">
            <?php
            foreach($albums_photo as $valphoto):
            $album_id = $valphoto->users_albums_id;
            ?>
                <div class="col">
                    <div class="ratio ratio-1x1">
                        <a type="button" data-bs-toggle="modal" data-src="<?php echo base_url()?><?php echo $valphoto->file_path ?><?php echo $valphoto->file_name_original ?>" data-caption=""
                        data-bs-target="#photodetailModal<?php echo $valphoto->id ?>">
                            <img src="<?php echo base_url()?><?php echo $valphoto->file_path ?><?php echo $valphoto->file_name_original ?>" class="photo-album-thumb" alt="...">
                        </a>
                    </div>
                </div>
            <?php
            endforeach;
            ?>
            <?php if(!empty($checkusers_profile)){ ?>
            <div class="col">
                <div class="ratio ratio-1x1 img-thumbnail bg-light" data-album-count="<?php echo $album_id?>" data-bs-toggle="modal" data-bs-target="#photoAlbums<?php echo $album_id ?>" role="button">
                    <span class="material-icons md-48 d-flex justify-content-center align-items-center"
                        style="color: #aeaeae;">add</span>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php $this->load->view($template['partials_modal_comment_post']); ?>
<?php $this->load->view($template['partials_modal_album_photo']); ?>
<?php $this->load->view($template['partials_modal_post']); ?>
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
