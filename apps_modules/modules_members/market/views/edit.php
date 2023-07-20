<style type="text/css">
.dropzone {
	margin-top: 10px;
	border: 2px dashed #0087F7;
}

</style>

<?php $this->load->view($template['partials_sidebar_market']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-11 col-md-7 mx-auto px-0">
                <div class="pt-4 mr-0 bg-indoconnex">
                    <div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
                        <select name="businessSelector" onchange="selectUser(this.value)" class=" border-0 bg-white p-2 js-businessSelector">
                            <?php foreach ($business_list as $value) { ?>
                                <option value="<?php echo $value->id ?>" data-id="<?php echo $value->id ?>" data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business') ?>" class=""><?php echo $value->data_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <span class="d-flex fw-bold mb-3">Edit Product/Service <?php echo validation_errors(); ?></span>
                    <?php if ($business_count > 0) { ?>
                        <form action="<?php echo base_url() . 'market/update'; ?>" class="row mx-0 px-0" method="post" role="form" enctype="multipart/form-data">
                            <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>" />
                            <input type="hidden" name="product-id" value="<?= $item->id; ?>">
                            <input type="hidden" id="select_user_id" name="select_user_id">
                            <input type="hidden" id="select_business_id" name="select_business_id" value="<?php echo $business->id ?>">
                            <div class="col-12 col-md-6 mb-3 ">
                                <div class="card border-0 mb-3 text-prussianblue">
                                    <div class="card-header bg-transparent border-0 pt-3 d-flex">
                                        <div class="flex-shrink-0 d-flex">
                                            <img src="<?php echo base_url() ?>public/themes/user/images/icons/product-profile.svg" class="img-circle" alt="">
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
                                                <option value="product" <?= $item->data_type == 'product' ? 'selected' : null; ?>>Product</option>
                                                <option value="service" <?= $item->data_type == 'service' ? 'selected' : null; ?>>Service</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" name="product-category" for="product-category">Category</label>
                                            <select class="w-100 form-select form-select-sm" name="product-category[]">
                                                <?php
                                                foreach ($categories as $value) {
                                                    $selected = '';
                                                    if (json_decode($item->data_categories, true)[0] == $value->id) {
                                                        $selected = 'selected';
                                                    }
                                                    echo "<option value='$value->id' $selected>$value->data_name</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" name="product-name" for="product-name">Product Name</label>
                                            <input type="text" name="product-name" value="<?= $item->data_name; ?>" id="product-name" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="">Description</label>
                                            <textarea name="product-description" cols="10" rows="5" maxlength="350" class="form-control form-control-sm"><?= $item->data_description; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="">Main Photo</label>
                                            <input type="file" class="form-control form-control-sm" name="__logo_files[]" accept="image/*" onchange="loadFile(event)" />
                                        </div>
                                        <div class="mb-3">
                                            <div id="previewText" class="d-none">Preview Image:</div>
                                            <img id="output" class="img-fluid" />
                                        </div>
                                        <div class="mb-3">
                                            <div>Current Image:</div>
                                            <img class="img-fluid" src="<?php echo placeholder($item->file_path, $item->file_name_original); ?>" />
                                        </div>
										<div class="mb-3">
											<label class="form-label" for="">Gallery Photo</label>
											<div class="dropzone">
												<div class="dz-message">
													<h6> Click or Drop Image</h6>
												</div>
											</div>
										</div>
										<div class="mb-3">
											<?php foreach($gallery as $value){ ?>
											<div class="row">
												<div class="col-4"><img class="img-fluid" width="100px" src="<?php echo base_url()."public/uploads/products/gallery/".$value->name; ?>">
												</div>
												<div class="col-4"><div id="removeFileEdit" style="cursor: pointer;" onclick="removeFile(<?php echo $value->secret_id ?>)">Remove File</div>
												</div>
											</div>
											<?php } ?>
										</div>	
                                        <div class="mb-3" id="form-sku">
                                            <label class="form-label" for="">SKU (Optional)</label>
                                            <input type="text" name="sku" value="<?= $item->data_sku; ?>" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" name="publish" id="publish">
                                                <label class="form-check-label" for="publish">
                                                    Publish in Buy & Sell
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div class="card border-0 mb-3 text-prussianblue">
                                    <div class="card-header bg-transparent border-0 pt-3 d-flex">
                                        <div class="flex-shrink-0 d-flex">
                                            <img src="<?php echo base_url() ?>public/themes/user/images/icons/product-price.svg" class="img-circle" alt="">
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
                                                <!-- <option value="0">Please Select</option>
                                        <option value="1">Free / Giveaway</option>
                                        <option value="2">Fixed Price</option>
                                        <option value="3">Starting at</option>
                                        <option value="4">Ask for Price</option>
                                        <option value="5">Variable Price</option> -->
                                                <?php
                                                foreach ($price_type as $key => $value) {
                                                    $selected = '';
                                                    if ($key == $item->price_type) {
                                                        $selected = 'selected';
                                                    }; ?>
                                                    <option value='<?php echo $key ?>' <?php echo $selected ?>><?php echo $value ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3 d-none" id="pricing">
                                            <label class="form-label" for="product-currency">Currency</label>
                                            <select class="form-select form-select-sm mb-3" onchange="init_mask_money(this.value)" name="product-currency" id="product-currency">
                                                    <option value="">Choose Currency</option>
                                                <?php
                                                foreach ($currency as $key => $value) {
                                                    $selected = '';
                                                    if ($key == $item->price_currency) {
                                                        $selected = 'selected';
                                                    }; ?>
                                                    <option value='<?php echo $value ?>' <?php echo $selected ?>><?php echo $value ?></option>
                                                <?php } ?>
                                            </select>
                                            <label class="form-label" for="">Price</label>
                                            <div class="hstack gap-2 d-none" id="price-num">
                                                <?php if (!$item->price_high && !$item->price_low) { ?>
                                                <input type="text" name="price_copy" id="price-num-price" class="form-control form-control-sm" onkeyup="inputprice()" data-formated="" data-number="" autocomplete="off">
                                                <input type="hidden" name="price" id="price-num-price_copy" class="form-control form-control-sm" data-formated="" data-number="">
                                                <?php } ?>
                                                <?php if ($item->price_high) { ?>
                                                <input type="text" name="price_copy" value="<?php echo $item->price_high ?>" id="price-num-price" class="form-control form-control-sm" onkeyup="inputprice()" data-formated="" data-number="" autocomplete="off">
                                                <input type="hidden" name="price" value="<?php echo $item->price_high ?>" id="price-num-price_copy" class="form-control form-control-sm" data-formated="" data-number="">
                                                <?php } ?>
                                                <?php if ($item->price_low) { ?>
                                                <input type="text" name="price_copy" value="<?php echo $item->price_low ?>" id="price-num-price" class="form-control form-control-sm" onkeyup="inputprice()" data-formated="" data-number="" autocomplete="off">
                                                <input type="hidden" name="price" value="<?php echo $item->price_low ?>" id="price-num-price_copy" class="form-control form-control-sm" data-formated="" data-number="">
                                                <?php } ?>
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
                                                <?php foreach ($labels as $value) {
                                                    $selected = '';
                                                    if ($item->data_label == $value->id) {
                                                        $selected = 'selected';
                                                    }
                                                    echo "<option value='$value->id' $selected>$value->data_name</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card border-0 mb-3 text-prussianblue">
                                    <div class="card-header bg-white border-0 pt-3 d-flex">
                                        <div class="flex-shrink-0 d-flex">
                                            <img src="<?php echo base_url() ?>public/themes/user/images/icons/jobs-contact.svg" class="img-circle" alt="">
                                        </div>
                                        <div class="flex-grow-1 ms-2 d-flex flex-column">
                                            <span class="text-prussianblue fw-bold fs-16">Contact Info</span>
                                            <span class="fs-12 text-black">You product/service posting contact information</span>
                                        </div>
                                    </div>
                                    <div class="card-body fs-12 text-black">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Email</label>
                                            <input type="email" class="form-control form-control-sm" name="product-email" value="<?= $item->data_email ?>" required>

                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="">Phone</label>
                                            <input type="nunber" class="form-control form-control-sm" name="product-phone" value="<?= $item->data_phone ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid ">
                                    <button type="submit" class="btn btn-sm btn-danger">Update Product</button>
                                </div>
                            </div>
                        </form>
                    <?php } else { ?>
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
    </div>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_market']); ?>
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
			}).done(
				function (response) {
					console.log(response);
				}
			);
	});

	function removeFile(token){
		var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
		var csrfHash = $(".txt_csrfname").val(); // CSRF hash
		$.ajax({
			type:"post",
			data:{token:token, [csrfName]: csrfHash},
			url:"<?php echo site_url('market/upload/gallery/delete') ?>",
			cache:false,
			dataType: 'json',
			}).done(
				function (response) {
					console.log(response);
				}
			);
	}
</script>

<script>
    const loadFile = function(event) {
        $('#previewText').removeClass('d-none');
        const output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };

    $(function() {
        $("select#price-select option:selected").change(mountPriceType());
        // $("#product-currency").change(mountProductCurrency());
    });

    function mountProductCurrency()
    {
        // init_mask_money($('#product-currency').val());
        
    }

    function mountPriceType() {
        switch ($("#price-select").val()) {
            case '0':
            case 0:
            case '1':
            case 1:
            case '4':
            case 4:
                $('#pricing').addClass('d-none');
                $('#price-num').addClass('d-none');
                $('#price-table').addClass('d-none');
                break;
            case '2':
            case 2:
            case '3':
            case 3:
                $('#pricing').removeClass('d-none');
                $('#price-num').removeClass('d-none');
                $('#price-table').addClass('d-none');
                break;
            case '5':
            case 5:
                $('#pricing').removeClass('d-none');
                $('#price-num').addClass('d-none');
                $('#price-table').removeClass('d-none');
                break;
            default:
                break;
        }
    }
</script>
