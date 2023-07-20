<style type="text/css">
.dropzone {
	margin-top: 10px;
	border: 2px dashed #0087F7;
}

</style>

<?php $this->load->view($template['partials_sidebar_market']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<main>
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0">
            <div class="pt-4 mr-0 bg-indoconnex" >
                <div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
                    <select name="businessSelector" onchange="selectUser(this.value)"  class=" border-0 bg-white p-2 js-businessSelector">
                        <?php foreach($business_list as $value){ ?>
                        <option value="<?php echo $value->id ?>" data-id="<?php echo $value->id ?>" data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business')?>" class=""><?php echo $value->data_name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <span class="d-flex fw-bold mb-3">Create Product/Service <?php echo validation_errors(); ?></span>
                <?php  if($business_count > 0){ ?>
                <form action="<?php echo base_url('market/store') ?>" class="row mx-0 px-0" method="post" role="form" enctype="multipart/form-data">
                    <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                    <input type="hidden" id="select_user_id" name="select_user_id">
                    <input type="hidden" id="select_business_id" name="select_business_id" value="<?php echo $business->id ?>">
                    <div class="col-12 col-md-6 mb-3 ">
                        <div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-transparent border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/product-profile.svg" class="img-circle" alt="">
                                </div>
                                <div class="flex-grow-1 ms-2 d-flex flex-column">
                                    <span class="text-prussianblue fw-bold fs-16">Profile</span>
                                    <span class="fs-12 text-black">Your product/service profile.</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">
                                <div class="mb-3">
                                    <label class="form-label" for="product-type">Type</label>
                                    <input type="hidden" name="user_id" value=" <?php echo $users->id ?>">
                                    <!-- <select name="product-type" id="product-type" class="form-select form-select-sm"> -->
                                    <select name="product-type" class="form-select form-select-sm">
                                        <option value="product">Product</option>
                                        <option value="service">Service</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" name="product-category" for="product-category">Category</label>
                                    <select class="w-100 form-select form-select-sm" name="product-category[]">
                                    <?php
                                    foreach($categories as $value){
                                        echo "<option value='$value->id'>$value->data_name</option>";
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" name="product-name" for="product-name">Product Name</label>
                                    <input type="text" name="product-name" id="product-name" class="form-control form-control-sm" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Description</label>
                                    <textarea name="product-description" id="" cols="10" rows="5" maxlength="350" class="form-control form-control-sm"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Main Photo</label>
                                    <input type="file" class="form-control form-control-sm" name="__logo_files[]" accept="image/*">
                                </div>
								<div class="mb-3">
                                    <label class="form-label" for="">Gallery Photo</label>
                                    <div class="dropzone">
										<div class="dz-message">
											<h6> Click or Drop Image</h6>
										</div>
									</div>
                                </div>
                                <div class="mb-3" id="form-sku">
                                    <label class="form-label" for="">SKU (Optional)</label>
                                    <input type="text" name="sku" id="" class="form-control form-control-sm">
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" name="publish" id="publish" >
                                        <label class="form-check-label" for="publish">
                                            Publish in Buy & Sell
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-transparent border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/product-price.svg" class="img-circle" alt="">
                                </div>
                                <div class="flex-grow-1 ms-2 d-flex flex-column">
                                    <span class="text-prussianblue fw-bold fs-16">Price and Label</span>
                                    <span class="fs-12 text-black">Your product/service price and label.</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">
                                <div class="mb-3">
                                    <label class="form-label" for="product-type-price">Price Type <a href="#" target="_blank" class="btn btn-sm p-0" data-bs-toggle="tooltip" data-bs-placement="right" title="click to learn more"><span class="text-muted material-icons-outlined fs-12">info</span></a></label>
                                    <select class="form-select form-select-sm" name="product-type-price" id="price-select">
                                        <option value="0">Please Select</option>
                                        <option value="1">Free / Giveaway</option>
                                        <option value="2">Fixed Price</option>
                                        <option value="3">Starting at</option>
                                        <option value="4">Ask for Price</option>
                                        <option value="5">Variable Price</option>
                                    </select>
                                </div>
                                <div class="mb-3 d-none" id="pricing">
                                    <label class="form-label" for="product-currency">Currency</label>
                                    <select class="form-select form-select-sm mb-3" onchange="init_mask_money(this.value)" name="product-currency" id="product-currency">
                                        <option value="">--Select Currency--</option>
                                        <option value="USD">USD</option>
                                        <option value="IDR">IDR</option>
                                        <option value="AUD">AUD</option>
                                    </select>
                                    <label class="form-label" for="">Price</label>
                                    <div class="hstack gap-2 d-none" id="price-num">
                                        <input type="text" name="price_copy" id="price-num-price" class="form-control form-control-sm" onkeyup="inputprice()" data-formated="" data-number="">
                                        <input type="hidden" name="price" id="price-num-price_copy" class="form-control form-control-sm" data-formated="" data-number="">
                                    </div>
                                    <div class="vstack gap-2 d-none" id="price-table">
                                        <div class="hstack gap-2">
                                            <input class="form-control form-control-sm" type="text" name="product-count-variant[]" id="" placeholder="1 - 50">
                                            <input class="form-control form-control-sm" type="text" name="product-price-variant[]" id="" placeholder="1000">
                                        </div>
                                        <div class="hstack gap-2">
                                            <input class="form-control form-control-sm" type="text" name="product-count-variant[]" id="" placeholder="51 - 200">
                                            <input class="form-control form-control-sm" type="text" name="product-price-variant[]" id="" placeholder="950">
                                        </div>
                                        <div class="hstack gap-2">
                                            <input class="form-control form-control-sm" type="text" name="product-count-variant[]" id="" placeholder="200 +">
                                            <input class="form-control form-control-sm" type="text" name="product-price-variant[]" id="" placeholder="925">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3" id="form-lbl">
                                    <label class="form-label" name="" for="">Label</label>
                                    <!-- <select class="w-100 form-select form-select-sm js-labels" name="product-label"> -->
                                    <select class="w-100 form-select form-select-sm" name="product-label">
                                    <?php foreach($labels as $value){
                                            echo "<option value='$value->id'>$value->data_name</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
						<div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-white border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/jobs-contact.svg" class="img-circle" alt="">
                                </div>
                                <div class="flex-grow-1 ms-2 d-flex flex-column">
                                    <span class="text-prussianblue fw-bold fs-16">Contact Info</span>
                                    <span class="fs-12 text-black">You product/service posting contact information</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">
                                <div class="mb-3">
                                    <label class="form-label" for="">Email</label>
                                    <input type="email" class="form-control form-control-sm" name="product-email" required>

                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Phone</label>
                                    <input type="nunber" class="form-control form-control-sm" name="product-phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid ">
                            <button type="submit" class="btn btn-sm btn-danger">Add New Product</button>
                        </div>
                    </div>
                </form>
                <?php }else{ ?>
                    <div class="card-body bg-white border-0">
                            <div class="d-flex align-items-center flex-column">
                                <div class="mb-3">
                                    <img src="<?php echo site_url('public/themes/user/images/products/default.png') ?>" alt="no-product-service">
                                </div>
                                <div class="mb-3">
                                    <span class="text-muted fw-semi fs-18">You must have a business page first before creating products and services!</span>
                                </div>
                                <div class="mb-3">
                                    <a href="<?php echo site_url('business/create') ?>" class="btn btn-danger fw-bold fs-14">Create Business Page</a>
                                </div>
                            </div>
                        </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>
<!-- Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gallery Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  <form action="/image-upload/post" enctype="multipart/form-data" class="dropzone" id="image-upload" method="POST">
				<div>
					<h3></h3>
				</div>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
 <script type="text/javascript">
	var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
	var number = Math.random();
	Dropzone.autoDiscover = false;
	var foto_upload= new Dropzone(".dropzone",{
		url: "<?php echo site_url('market/upload/gallery') ?>",
		maxFilesize: 10,
		method:"post",
		acceptedFiles:"image/*",
		paramName:"userfile",
		dictInvalidFileType:"File not found",
		addRemoveLinks:true,
	});
		foto_upload.on("sending",function(a,b,c){
			secret_id=Math.random();
			c.append("token_photo",number);
			c.append("secret_id",secret_id);
		});
	
	foto_upload.on("removedfile",function(a){
	var token=secret_id;
	$.ajax({
		type:"post",
		data:{token:token, [csrfName]: csrfHash},
		url:"<?php echo site_url('market/upload/gallery/delete') ?>",
		cache:false,
		dataType: 'json',
		success: function(){
			console.log("Deleted");
		},
		error: function(){
			console.log("Error");

		}
	});
});
</script>
<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_market']); ?>
