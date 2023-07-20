 <!-- Modal -->
 <div class="modal fade" id="albums_job" tabindex="-1" aria-labelledby="albumslabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="photoProfileLabel">Create Album Photo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

            </button>
        </div>
        <div class="modal-body">
            <form id="form-action" class="form-horizontal" method="post" action="<?php echo current_url(); ?>" role="form" enctype="multipart/form-data">
                <?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
                <input type="hidden" id="id" name="id" value="<?php echo $business->id; ?>"/>
                <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                <input type="hidden" name="form" value="album_business"/>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="visually-hidden" for="inputFile">File Upload</label>
                    <input class="form-control" type="file" name="__album_files[]" onclick="statusAlbums()" accept="image/x-png,image/gif,image/jpeg" class="form-control" id="inputFile" required>
                    <input type="hidden" name="status_form_albums_job" id="status_form_albums_job">
                </div>

        </div>
        <div class="modal-footer border-top">
            <input type="submit" class="btn btn-danger" value="Save">
        </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal -->
<?php
foreach($albums as $valalbums){
    $albums_id       = $valalbums->id;
    $albums_name     = $valalbums->data_name;
?>
<div class="modal fade" id="photoAlbums<?php echo $albums_id ?>" tabindex="-1" aria-labelledby="albumslabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="photoProfileLabel">Create Photo <?php echo $albums_name ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form-action" class="form-horizontal" method="post" action="<?php echo current_url(); ?>" role="form" enctype="multipart/form-data">
                <?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
                <input type="hidden" id="id" name="id" value="<?php echo $business->id ?>"/>
                <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                <input type="hidden" name="form" value="photo_album_business"/>
                <input type="hidden" name="album" value="<?php echo $albums_id ?>"/>
                <div class="mb-3">
                    <label class="visually-hidden" for="inputFile">File Upload</label>
                    <input type="file" name="__photo_album_files[]" multiple class="form-control">

                </div>
                <div class="mb-3">
                    <label class="form-label" for="input">Caption</label>
                    <textarea class="form-control" name="caption"></textarea>
                </div>
        </div>
        <div class="modal-footer border-top">
            <input type="submit" class="btn btn-danger" value="Save">
        </div>
        </form>
        </div>
    </div>
</div>
<?php } ?>
<script>
    function statusAlbums(){
	document.getElementById("status_form_albums").value = 1;
}
</script>
