
<!-- BODY -->
<div class="container mb-4">
    <div class="p-4 bg-white">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('user/profile/photo/'.$this->session->userdata('user_id')) ?>">Photo</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile Photo</li>
            </ol>
        </nav>

        <div class="row row-cols-2 row-cols-lg-4 g-4">
            <?php
            foreach($albums_photo as $valphoto):
            $album_id = $valphoto->users_albums_id;
            ?>
            <div class="col">
                <div class="ratio ratio-1x1">
                    <a class="stretched-link" type="button" data-bs-toggle="modal" data-src="<?php echo base_url()?><?php echo $valphoto->file_path ?><?php echo $valphoto->file_name_original ?>" data-caption=""
                    data-bs-target="#photodetailModal<?php echo $valphoto->id ?>">
                        <img src="<?php echo base_url()?><?php echo $valphoto->file_path ?><?php echo $valphoto->file_name_original ?>" class="photo-album-thumb" alt="...">
                    </a>
                </div>
            </div>
            <?php
            endforeach;
            ?>
            <div class="col">
                <div class="ratio ratio-1x1 img-thumbnail bg-light" data-bs-toggle="modal" data-target="#photoAlbums<?php echo $album_id ?>" role="button">
                    <span class="material-icons md-48 d-flex justify-content-center align-items-center"
                        style="color: #aeaeae;">add</span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view($template['partials_modal_comment_post']); ?>