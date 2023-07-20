
<!-- navbar -->
<?php $this->load->view($template['partials_navbar_community']); ?>

<!-- BODY -->
<?php if(empty($community->status_privacy) || !empty($checkusers_profile)) { ?>
<div class="container mb-4">
    <!-- SECTION -->
    <div class="col-lg-12 msn-widget p-4 rounded-3">
        <div class="d-flex align-items-start">
            <h5 class="mb-4 text-prussianblue fw-bold">General Information</h5>
            <div class="ms-auto">
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
        <div class="row mb-3">
            <p><?php echo $community->data_description ?></p>
        </div>
        <div class="row d-flex row-cols-1 row-cols-md-3 mb-3">
            <div class="d-flex text-gray align-items-start">
                <div class="flex-shrink-0 d-flex mt-1">
                    <span class="material-icons md-18">key</span>
                </div>
                <div class="d-flex flex-grow-1 ms-1 flex-row flex-md-column">
                    <span class="fw-bold">Privacy</span>
                    <span class="text-black ms-2 ms-md-0">
                        <?php if($community->status_privacy==0){
                            echo "Public";
                        }else{
                            echo "Private";
                        }
                        ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
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
