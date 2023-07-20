<!-- Modal Edit Product/Service -->
<?php foreach($tender_list as $value){ ?>
	<form action="<?php echo base_url('tender/update') ?>" class="row mx-0 px-0" method="post" role="form" enctype="multipart/form-data">
    			<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
		
	<div class="modal fade" id="modal_edit_tender<?php echo $value->id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-l modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Edit Tender</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<div class="bg-transparent border-0 pt-3 d-flex mb-3">
                    	<div class="flex-shrink-0 d-flex">
                            <img src="<?php echo base_url()?>public/themes/user/images/icons/profile-tender.svg" class="img-circle" alt="">
                        </div>
                        <div class="flex-grow-1 ms-2 d-flex flex-column">
                            <span class="text-prussianblue fw-bold fs-16">Profile</span>
                            <span class="fs-12 text-black">Your tender profile.</span>
                        </div>
                	</div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Tender
                            Name</label>
                        <input type="text" name="tender-name" class="form-control form-control-sm" id="formGroupExampleInput"
                            placeholder="Input tender name" value="<?php echo $value->data_name ?>">
                        <input type="hidden" name="tender-id" value="<?php echo $value->id ?>">
                    </div>
					<div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Types</label>
                        <select class="w-100 form-select" name="tender-type">
                                <?php foreach($tender_types as $value_type){
									if($value_type->id == $value->data_types){
                                        	echo "<option value='$value_type->id' selected>$value_type->data_name</option>";
                                    	}else{
											echo "<option value='$value_type->id'>$value_type->data_name</option>";
										}
									}
                                ?>
                        </select>
                    </div>
					<div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Category</label>
                        <select class="w-100 form-select" name="tender-category">
                                <?php foreach($tender_categories as $value_cat){
									if($value_cat->id == $value->data_categories){
                                        	echo "<option value='$value_cat->id' selected>$value_cat->data_name</option>";
                                    	}else{
											echo "<option value='$value_cat->id'>$value_cat->data_name</option>";
										}
									}
                                ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea name="tender-description" class="form-control"
                            placeholder="Input description" rows="3"><?php echo $value->data_description ?></textarea>
                    </div>
					<div class="mb-3">
                        <label class="form-label" for="">Open Until</label>
                        	<input type="date" class="form-control form-control-sm" name="tender-open" value="<?php
							 $s = strtotime($value->date_open);
							 echo date('Y-m-d', $s) ?>">
                        </div>
                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">Image</label>
                        <input name="__logo_files[]" class="form-control form-control-sm" id="formFileMultiple" type="file"
                            placeholder="Input product image" multiple accept="image/x-png,image/gif,image/jpeg" >
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Submit">
            </div>	
        </div>
    </div>
</div>
<?php } ?>
</form>

<?php foreach($tender_list as $value){ ?>
    <form action="<?php echo base_url('tender/delete') ?>" method="post" role="form" enctype="multipart/form-data">
    <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
    <div class="modal fade" id="modal_delete_tender<?php echo $value->id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">    
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Are you sure to delete this tender?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <input type="hidden" name="tender-id" value="<?php echo $value->id ?>" id="tender-id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-danger" value="Yes">
                    </div>
                </div>
            </div>
	</div>
    </form>
<?php } ?>
