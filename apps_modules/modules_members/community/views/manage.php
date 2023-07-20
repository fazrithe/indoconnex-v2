<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_community']); ?>

<!-- Page Content  -->
<main>
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0">
            <div class="pt-4 mr-0 bg-indoconnex" >
                <span class="d-flex fw-bold mb-3">Manage Community</span>
                <div class="row row-cols-2 g-3">
                    <?php foreach($communities as $value){ ?>
                    <div class="col-6">
                        <div class="d-flex bg-white flex-column p-3 w-100">
                            <div class="flex-row d-flex mb-3">
                                <div class="flex-shrink-0 placeholder-glow">
                                    <img src="<?php echo placeholder($value->file_path, $value->file_name_original, 'community', '4x3')?>" alt="" srcset="" class="rounded-3 fit-contain thumb4x3">
                                </div>
                                <div class="flex-grow-1 ms-3 fs-12 flex-column d-flex">
                                    <div class="d-flex flex-row">
                                        <div class="d-flex flex-column">
                                            <span class="fw-semi text-prussianblue fs-12"><?php echo $value->data_name ?></span>
                                            <span class="text-muted fs-12 align-items-center d-flex"><span class="text-muted fs-12 material-icons me-2">lock</span><?php echo empty($value->status_privacy) ?'Public' : 'Private' ?></span>
                                            <div class="justify-content-start d-flex flex-wrap gap-2">
                                                <span class="badge bg-light text-black mt-2 rounded-pill fw-normal fs-12">
                                                <?php
                                                    foreach($com_categories as $category_val){
                                                        if($value->data_categories == $category_val->id ){
                                                            echo $category_val->data_name;
                                                        }
                                                    }
                                                ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center ms-auto">
                                    <div class="badge rounded-pill bg-danger p-1 d-flex">
                                        <button class="btn btn-sm d-flex align-items-center px-1 py-0" role="button" data-bs-toggle="modal" data-bs-target="#modal_edit_community<?php echo $value->id ?>" data-itemid="<?php echo $value->id ?>">
                                            <span class="material-icons text-white md-16">edit</span>
                                        </button>
                                        <div class="vr opacity-100"></div>
                                        <button class="btn btn-sm d-flex align-items-center px-1 py-0" role="button" id="deleteCommunity" onclick="deletecommunity('<?php echo $value->id ?>')" data-itemid="<?php echo $value->id ?>">
                                            <span class="material-icons text-white md-16">delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <span class="text-break me-auto fs-12 text-black">
                                <?php echo !empty($value->data_description) ? character_limiter($value->data_description, 20) : 'No Description' ?>
                            </span>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php foreach($communities as $value){ ?>
    <div class="modal fade" id="modal_edit_community<?php echo $value->id;?>" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Edit community</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url('community/update') ?>" class="row mx-0 px-0" method="post" role="form" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                        <div class="mb-3">
                            <label class="form-label" name="com-name">Community Name</label>
                            <input type="hidden" name="com-id" class="form-control" value="<?php echo $value->id ?>">
                            <input type="text" name="com-name" class="form-control" required value="<?php echo $value->data_name ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" name="com-category">Category</label>
                            <select class="form-select w-100 community-category" name="com-category">
                            <?php
                                $cat = json_decode($value->data_categories);
                                foreach($com_categories as $category) {
                                    $selected = '';
                                    if(!empty($cat) && $cat[0] == $category->id) {
                                        $selected = 'selected';
                                    }
                                    echo "<option value='$category->id' ".$selected.">$category->data_name</option>";
                                }
                            ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" name="com-privacy">Privacy</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="com-privacy" type="checkbox" role="switch" id="flexSwitchCheckDefault" <?php
                                if(!empty($value->status_privacy)) {echo 'checked';}?>>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Make Private</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="">Description</label>
                            <textarea name="com-description" id="" cols="10" rows="5" maxlength="350" class="form-control"><?php echo $value->data_description ?></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-danger" value="Submit">
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletecommunityModal" tabindex="-1" aria-labelledby=""
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url('community/delete') ?>" method="post" role="form" enctype="multipart/form-data">
                <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Are you sure to delete community?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <input type="hidden" name="community-id" value="" id="community-id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-danger" value="Yes">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_community']); ?>