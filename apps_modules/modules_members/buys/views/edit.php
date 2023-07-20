<?php $this->load->view($template['partials_sidebar_buys']); ?>
<!-- Page Content  -->
<main>
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0">
            <div class="pt-4 mr-0 bg-indoconnex" >
                <div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
                    <select name="businessSelector" onchange="selectUser(this.value)"  class=" border-0 bg-white p-2 js-businessSelector">
						<option value="1" data-image="<?php echo placeholder($users->file_path, $users->file_name_original) ?>"><?php echo $users->name_first ?> <?php echo $users->name_last ?></option>
						<?php foreach($business_list as $value){ ?>
                        <option value="<?php echo $value->id ?>" data-id="<?php echo $value->id ?>" data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business')?>" class=""><?php echo $value->data_name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <span class="d-flex fw-bold mb-3">Edit Buy & Sells<?php echo validation_errors(); ?></span>
                <form action="<?php echo base_url('buys/update') ?>" class="row mx-0 px-0" method="post" role="form" enctype="multipart/form-data">
                    <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                    <input type="hidden" id="select_user_id" name="select_user_id">
                    <input type="hidden" id="select_business_id" name="select_business_id">
					<input type="hidden" name="user_id" value="<?php echo $users->id ?>">
                    <input type="hidden" name="product-id" value="<?php echo $items->pbd_items_id ?>">
                    <div class="col-12 col-md-6 mb-3 ">
                        <div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-transparent border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/shopping-sale.svg" class="img-circle" alt="">
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
                                    <select name="product-type" id="product-type-buy" class="form-select form-select-sm">
										<?php
										$result = json_decode($items->data_types);
										foreach($types as $key => $value){
											$selected = '';
											if($key == $items->data_type_sub) {
												$selected = 'selected';
											};

											echo "<option value='$key' $selected>$value</option>";
										}
										?>
                                    </select>
                                </div>
								<div class="mb-3">
                                    <label class="form-label" name="product-category" for="product-category" required>Category</label>
                                    <select class="w-100 form-select form-select-sm subcategory" name="product-category[]">
                                    <?php
                                    $result = json_decode($items->data_categories);
                                    foreach($categories as $value){
                                        $selected = '';
                                        if(in_array($value->id, $result)) {
                                            $selected = 'selected';
                                        };

                                        echo "<option value='$value->id' $selected >$value->data_name</option>";
                                    }
                                    ?>
                                    </select>
                                </div>
								<div class="mb-3" id="subChildCategory-display" style="display: none;">
                                    <label class="form-label" name="product-category" for="product-category" required>Sub Category</label>
                                    <select class="w-100 form-select form-select-sm subChildCategory" name="product-sub-category[]">
                                    <?php
                                    $result = json_decode($items->data_sub_categories);
                                    foreach($sub_categories as $value){
                                        $selected = '';
                                        if(in_array($value->id, $result)) {
                                            $selected = 'selected';
                                        };

                                        echo "<option value='$value->id' $selected >$value->data_name</option>";
                                    }
                                    ?>
                                    </select>
                                </div>
								<div class="mb-3" id="categoryPart">
                                    <label class="form-label" name="product-category" for="product-category">Accessories & Part</label>
                                    <select class="w-100 form-select form-select-sm partCategory" name="part-category[]">
                                    <?php
                                    $result = json_decode($items->data_part_categories);
                                    foreach($part_categories as $value){
                                        $selected = '';
                                        if(in_array($value->id, $result)) {
                                            $selected = 'selected';
                                        };

                                        echo "<option value='$value->id' $selected >$value->data_name</option>";
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" name="product-name" for="product-name">Product Name</label>
                                    <input type="text" name="product-name" id="product-name" class="form-control form-control-sm" value="<?php echo $items->data_name ?>" required>
                                </div>
								<div class="mb-3">
                                    <label class="form-label" for="product-condition">Condition</label>
                                    <select name="product-condition" id="product-condition" class="form-select form-select-sm">
									<?php
										foreach($conditions as $value){
											$selected = '';
											if($value == $items->data_condition) {
												$selected = 'selected';
											};

											echo "<option value='$value' $selected>$value</option>";
										}
										?>
                                    </select>
                                </div>
								<div class="mb-3">
                                    <label class="form-label" for="product-type">Status <?php echo $items->data_status ?></label>
                                    <select name="product-status" id="product-status" class="form-select form-select-sm">
									<?php
										foreach($status as $value){
											$selected = '';
											if($value == $items->data_status) {
												$selected = 'selected';
											};

											echo "<option value='$value' $selected>$value</option>";
										}
										?>
                                    </select>
                                </div>
								<?php if($sells->data_type_sub == 'vehicle'){ ?>
								<div id="vehicle-get" class="hstack gap-2">
									<div class="mb-3">
										<label class="form-label" for="">Yearsss</label>
										<input type="text" name="vehicle-years" value="<?php echo $sells->data_detail_year ?>" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
									<div class="mb-3">
										<label class="form-label" for="">Brand</label>
										<input type="text" name="vehicle-brand" value="<?php echo $sells->data_detail_brand ?>" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
									<div class="mb-3">
										<label class="form-label" for="">Model</label>
										<input type="text" name="vehicle-model" value="<?php echo $sells->data_detail_model ?>" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
								</div>
								<?php } ?>
								<?php if($sells->data_type_sub == 'property'){ ?>
								<div id="property-get" class="hstack gap-2">
									<div class="mb-3">
										<label class="form-label" for="">Bathroom Total</label>
										<input type="text" name="property-bathroom" value="<?php echo $sells->data_detail_bathroom ?>" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
									<div class="mb-3">
										<label class="form-label" for="">Bedroom Total</label>
										<input type="text" name="property-bedroom" value="<?php echo $sells->data_detail_bedroom ?>" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
									<div class="mb-3">
										<label class="form-label" for="">Size in(m2)</label>
										<input type="text" name="property-size" value="<?php echo $sells->data_detail_size ?>" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
								</div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Description</label>
                                    <textarea name="product-description" id="" cols="10" rows="5" maxlength="350" class="form-control form-control-sm"><?php echo $items->data_description ?></textarea>
                                </div>
								<?php } ?>
								<div id="vehicle" class="hstack gap-2 d-none">
									<div class="mb-3">
										<label class="form-label" for="">Years</label>
										<input type="text" name="vehicle-years" value="<?php echo $sells->data_detail_year ?>" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
									<div class="mb-3">
										<label class="form-label" for="">Brand</label>
										<input type="text" name="vehicle-brand" value="<?php echo $sells->data_detail_brand ?>" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
									<div class="mb-3">
										<label class="form-label" for="">Model</label>
										<input type="text" name="vehicle-model" value="<?php echo $sells->data_detail_model ?>" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
								</div>
								<div id="property" class="hstack gap-2 d-none">
									<div class="mb-3">
										<label class="form-label" for="">Bathroom Total</label>
										<input type="text" name="property-bathroom" value="<?php echo $sells->data_detail_bathroom ?>" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
									<div class="mb-3">
										<label class="form-label" for="">Bedroom Total</label>
										<input type="text" name="property-bedroom" value="<?php echo $sells->data_detail_bedroom ?>" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
									<div class="mb-3">
										<label class="form-label" for="">Size in(m2)</label>
										<input type="text" name="property-size" value="<?php echo $sells->data_detail_size ?>" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
								</div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Description</label>
                                    <textarea name="product-description" id="" cols="10" rows="5" maxlength="350" class="form-control form-control-sm" required><?php echo $items->data_description ?></textarea>
                                </div>
                                <div class="mb-3" id="form-sku">
                                    <label class="form-label" for="">SKU (Optional)</label>
                                    <input type="text" name="sku" id="" value="<?php echo $items->data_sku ?>" class="form-control form-control-sm">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Main Photo</label>
                                    <input type="file" class="form-control form-control-sm" name="__logo_files[]" accept="image/*" onchange="loadFile(event)"> 
                                </div>
                                <div class="mb-3">
                                    <div id="previewText" class="d-none">Preview Image:</div>
                                    <img id="output" class="img-fluid"/>
                                </div>
                                <div class="mb-3">
                                    <div>Current Image:</div>
                                    <img class="img-fluid" src="<?php echo placeholder($items->file_path, $items->file_name_original); ?>"/>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
					<div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-header bg-transparent border-0 pt-3 d-flex">
                                <div class="flex-shrink-0 d-flex">
                                    <img src="<?php echo base_url()?>public/themes/user/images/icons/business-location.svg" class="img-circle" alt="">
                                </div>
                                <div class="flex-grow-1 ms-2 d-flex flex-column">
                                    <span class="text-prussianblue fw-bold fs-16">Location</span>
                                    <span class="fs-12 text-black">Your buy & sells location.</span>
                                </div>
                            </div>
                            <div class="card-body fs-12 text-black">
							<div class="mb-3">
							<div class="mb-3">
                                    <label class="form-label" for="selCountry">Country</label>
                                    <select class="form-select form-select-sm business-country" name="product-country" id="selCountry" required>
                                        <option value="<?php echo $country->id ?>"><?php echo $country->name ?></option>
                                    </select>
									<input type="hidden" id="selCountry-id" class="selCountry-id" value="">
									<div id="countryNull" class="text-danger" style="display: none;">Country not null</div>
                                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"><br>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="selState">State / Region</label>
                                    <select class="form-select form-select-sm" name="product-state" id="selState" required>
                                    <option value="<?php echo $state->id ?>"><?php echo $state->name ?></option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="selCity">City / Regency</label>
                                    <select class="form-select form-select-sm" name="product-city" id="selCity" required>
                                    <option value="<?php echo $city->id ?>"><?php echo $city->name ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
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
									<?php
										foreach($price_type as $key => $value){
											$selected = '';
											if($key == $items->price_type) {
												$selected = 'selected';
											}; ?>
											<option value='<?php echo $key ?>' <?php echo $selected ?>><?php echo $value ?></option>
											<?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3 d-none" id="pricing">
                                    <label class="form-label" for="product-currency">Currency</label>
                                    <select class="form-select form-select-sm mb-3" onchange="init_mask_money(this.value)" name="product-currency" id="product-currency">
									<?php
										foreach($currency as $key => $value){
											$selected = '';
											if($key == $items->price_currency) {
												$selected = 'selected';
											}; ?>
											<option value='<?php echo $value ?>' <?php echo $selected ?>><?php echo $value ?></option>
											<?php } ?>
                                    </select>
                                    <label class="form-label" for="">Price</label>
                                    <div class="hstack gap-2 d-none" id="price-num">
                                        <input type="text" name="price_copy" id="price-num-price" value="<?php echo $items->price_high ?>"  class="form-control form-control-sm" onkeyup="inputprice()" data-formated="" data-number="">
                                        <input type="text" name="price" id="price-num-price_copy" value="<?php echo $items->price_high ?>" class="form-control form-control-sm" data-formated="" data-number="">
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
                                    <?php foreach($labeles as $value){
                                            $selected = '';
                                            if ($items->data_label == $value->id) {
                                                $selected = 'selected';
                                            };
                                            echo "<option value='$value->id' $selected>$value->data_name</option>";
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
                                    <input type="email" class="form-control form-control-sm" name="product-email" value="<?php echo $items->data_email ?>" required>

                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Phone</label>
                                    <input type="nunber" class="form-control form-control-sm" name="product-phone" value="<?php echo $items->data_phone ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid ">
                            <button type="submit" class="btn btn-sm btn-danger">Update Listing</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>
<?php $this->load->view($template['action_ajax_market']); ?>
<script type="text/javascript">
const loadFile = function(event) {
    $('#previewText').removeClass('d-none');
    const output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src)
    }
};

(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')
  
  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
		
		var sel_country = $('#selCountry-id').val();
		console.log(sel_country);
		
		var null_country = document.getElementById('countryNull');
		if(sel_country == ''){
			null_country.style.display = "block";
		}else{
			null_country.style.display = "none";
		}
        form.classList.add('was-validated')
      }, false)
    })
})()
	$(document).ready(function(){
		var name = document.getElementById('product-type-buy').value;
		var subCategory = document.getElementById('subChildCategory-display'); 
			if (name == "item") {
				subCategory.style.display = "block";
			} else {
				subCategory.style.display = "none";
			}
		$('#product-type-buy').change(function(){
            var name = $(this).val();
			var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
        	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
            $.ajax({
                url : "<?php echo site_url('buysells/get_category');?>",
                method : "POST",
                data : {name: name, [csrfName]: csrfHash},
                async : false,
                dataType : 'json',
                success: function(data){
					console.log(data);
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+data[i].id+'">'+data[i].data_name+'</option>';
                    }
                    $('.subcategory').html(html);
					var vehicle = document.getElementById('vehicle-get');
					var property = document.getElementById('property-get');
					var subCategory = document.getElementById('subChildCategory-display'); 
					if (name == "item") {
						subCategory.style.display = "block";
					} else {
						subCategory.style.display = "none";
					}
					switch (name) {
					case 'vehicle':
						$('#vehicle').removeClass('d-none');
						$('#property').addClass('d-none');
						property.style.display = "none";
						break;
					case 'property':
						$('#vehicle').addClass('d-none');
						$('#property').removeClass('d-none');
						vehicle.style.display = "none";
						break;
					default:
						$('#vehicle').addClass('d-none');
						$('#property').addClass('d-none');
						vehicle.style.display = "none";
						vehicle.style.display = "none";
						break;
					}
                }
            });
        });
		var sub_child_category = $('.subChildCategory').val();
		var subCategory = document.getElementById('subChildCategory-display'); 
			if(sub_child_category == null){
					subCategory.style.display = "none";
				} else {
					subCategory.style.display = "block";
					
			}
		$('.subcategory').change(function(){
            var  id = $(this).val();
			var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
        	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
            $.ajax({
                url : "<?php echo site_url('buysells/get_sub_category');?>",
                method : "POST",
                data : {id: id, [csrfName]: csrfHash},
                async : false,
                dataType : 'json',
                success: function(response){
					var data = response.category;
					var count = response.category_count;
					var subCategory = document.getElementById('subChildCategory-display'); 
						if (count < 1) {
						subCategory.style.display = "none";
					} else {
						subCategory.style.display = "block";
					}
                    var html = '';
                    var i;
					html = '<option value="">--Select Sub Category--</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+data[i].id+'">'+data[i].data_name+'</option>';
                    }
                    $('.subChildCategory').html(html);
                }
            });
        });

		var part_category = $('.partCategory').val();
		var partCategory = document.getElementById('categoryPart'); 
			if(part_category == null){
					partCategory.style.display = "none";
				} else {
					partCategory.style.display = "block";
					
			}
		$('.subChildCategory').change(function(){
            var  id = $(this).val();
			console.log(id)
			var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
        	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
            $.ajax({
                url : "<?php echo site_url('buysells/get_sub_category');?>",
                method : "POST",
                data : {id: id, [csrfName]: csrfHash},
                async : false,
                dataType : 'json',
                success: function(response){
					var data = response.category;
					var count = response.category_count;
					var partCategory = document.getElementById('categoryPart'); 
					if (count < 1) {
						partCategory.style.display = "none";
					} else {
						partCategory.style.display = "block";
					}
                    var html = '';
                    var i;
					html = '<option value="">--Select Accessories & Part--</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+data[i].id+'">'+data[i].data_name+'</option>';
                    }
                    $('.partCategory').html(html);
                }
            });
        });
    });
</script>
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
