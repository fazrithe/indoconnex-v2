<!-- navbar -->
<?php $this->load->view($template['partials_navbar_business']); ?>

<!-- BODY -->
<div class="container mb-4">
    <div class="p-4 msn-widget rounded-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Photo</li>
            </ol>
        </nav>

        <div class="row row-cols-2 row-cols-lg-4 g-4">

            <?php foreach($albums as $valalbums): ?>
            <!-- Album 1 -->
            <div class="col">
                <div class="card h-100">
                    <div class="bg-light d-flex h-100 flex-wrap" data-album="<?php echo $valalbums->id ?>">
                        <?php
                        $albums = [[]];
                        foreach($albums_photo as $valphoto):
                        if($valalbums->id == $valphoto->pbd_business_categories_id && (
                            empty($albums[$valalbums->id]) || $albums[$valalbums->id] < 4
                        )):
                            if(empty($albums[$valalbums->id])) {
                                $albums[$valalbums->id] = 1;
                            } else {
                                $albums[$valalbums->id] +=1;
                            }
                        ?>
                        <div class="d-flex w-50 p-2 order-<?php echo $albums[$valalbums->id]?> flex-grow-0 flex-shrink-0 align-items-start justify-content-start rounded-3">
                            <a class="d-flex placeholder-glow ratio ratio-1x1" href="<?php echo base_url()?><?php echo 'business/profile/photo_album/'.$valphoto->pbd_business_categories_id ?>">
                                <img data-src="<?php echo base_url()?><?php echo $valphoto->file_path ?><?php echo $valphoto->file_name_original ?>" class="placeholder card-img-top photo-albums" alt="profile-picture-album">
                            </a>
                        </div>
                        <?php
                        endif;
                        endforeach;
                        if(!empty($albums[$valalbums->id])):
                        ?>
                        <?php if(!empty($checkusers_profile) && $valalbums->data_name != 'Profile Photo' && $valalbums->data_name != 'Cover Photo'){ ?>
                        <div class="album d-flex w-50 p-2 d-none order-4" data-album-count="<?php echo $albums[$valalbums->id]?>" data-bs-toggle="modal" data-bs-target="#photoAlbums<?php echo $valalbums->id ?>" role="button">
                            <div class="ratio ratio-1x1 bg-light rounded-3">
                                <span class="material-icons md-48 d-flex justify-content-center align-items-center text-muted">add</span>
                            </div>
                        </div>
                        <?php } ?>
                        <?php endif ?>
                        <?php if(empty($albums[$valalbums->id])):
                        ?>
                        <div class="col">
                            <div class="card" data-album-count="<?php echo $valalbums->id?>" data-bs-toggle="modal" data-bs-target="#photoAlbums<?php echo $valalbums->id ?>" role="button">
                                <div class="ratio ratio-1x1 bg-light">
                                    <span class="material-icons md-48 d-flex justify-content-center align-items-center text-muted">add</span>
                                </div>
                            </div>
                        </div>
                        <?php endif ?>
                    </div>
                    <div class="card card-footer bg-transparent px-3 py-2 users-album">
                        <p class="card-title mb-2"><b><?php echo $valalbums->data_name?></b></p>
                        <!-- <p class="card-text">Lorem ipsum, dolor sit amet.</p> -->
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if(!empty($checkusers_profile)){ ?>
            <!-- Album template -->
            <div class="col">
                <div class="card h-100 w-100" data-bs-target="#albums_business" data-bs-toggle="modal" role="button">
                    <div class="ratio ratio-1x1 bg-light">
                        <span class="material-icons md-48 d-flex justify-content-center align-items-center text-muted">add</span>
                    </div>
                    <div class="card-footer bg-transparent">
                        <p class="card-title"><b>Create Album</b></p>
                        <!-- <p class="card-text">Lorem ipsum, dolor sit amet.</p> -->
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php $this->load->view($template['partials_modal_album_photo_business']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>
