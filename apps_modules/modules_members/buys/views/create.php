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
                <span class="d-flex fw-bold mb-3">Create Buy & Sells<?php echo validation_errors(); ?></span>
                <form action="<?php echo base_url('buys/store') ?>" class="row mx-0 px-0 needs-validation" method="post" role="form" enctype="multipart/form-data" novalidate>
                    <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                    <input type="hidden" id="select_user_id" name="select_user_id">
                    <input type="hidden" id="select_business_id" name="select_business_id">
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
                                    <select name="product-type" id="product-type-buy" class="form-select form-select-sm product-type-buy" required>
										<option value="">--Select Type--</option>
										<option value="item">Item</option>
                                        <option value="vehicles">Vehicle</option>
										<option value="property">Property</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" name="product-category" for="product-category" required>Category</label>
                                    <select class="w-100 form-select form-select-sm subcategory" name="product-category[]" required>
                                    <option value="">--Select Category--</option>
                                    </select>
                                </div>
								<div class="mb-3" id="subChildCategory-display" style="display: none;">
                                    <label class="form-label" name="product-category" for="product-category" required>Sub Category</label>
                                    <select class="w-100 form-select form-select-sm subChildCategory" name="product-sub-category[]">
                                    <option>--Select Sub Category--</option>
                                    </select>
                                </div>
								<div class="mb-3" id="categoryPart" style="display: none;">
                                    <label class="form-label" name="product-category" for="product-category">Accessories & Part</label>
                                    <select class="w-100 form-select form-select-sm partCategory" name="part-category[]">
                                    <option>--Select Accesories & Part--</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" name="product-name" for="product-name">Product Name</label>
                                    <input type="text" name="product-name" id="product-name" class="form-control form-control-sm" required>
                                </div>
								<div class="mb-3">
                                    <label class="form-label" for="product-type">Condition</label>
                                    <select name="product-condition" id="" class="form-select form-select-sm" required>
										<option value="">--Select Condition--</option>
										<option value="New">New</option>
                                        <option value="Second">Second</option>
                                    </select>
                                </div>
								<div class="mb-3">
                                    <label class="form-label" for="product-type">Status</label>
                                    <select name="product-status" id="product-status" class="form-select form-select-sm" required>
										<option value="">--Select Status--</option>
										<option value="For Rent">For Rent</option>
                                        <option value="For Sale">For Sale</option>
										<option value="For Hire">For Hire</option>
                                    </select>
                                </div>
								<div id="vehicle" class="hstack gap-2 d-none">
									<div class="mb-3">
										<label class="form-label" for="">Years</label>
										<input type="text" name="vehicle-years" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
									<div class="mb-3 col-3">
										<label class="form-label" for="">Brand</label>
										<select name="vehicle-brand" cols="10" rows="5" maxlength="350" class="form-select form-select-sm">
											<option>--Select Brand--</option>
											<?php foreach($brands as $value):
											echo '<option value="'.$value->data_name.'">'.$value->data_name.'</option>';
											endforeach ?>
										</select>
									</div>
									<div class="mb-3">
										<label class="form-label" for="">Model</label>
										<input type="text" name="vehicle-model" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
								</div>
								<div id="property" class="hstack gap-2 d-none">
									<div class="mb-3">
										<label class="form-label" for="">Bathroom Total</label>
										<input type="text" name="property-bathroom" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
									<div class="mb-3">
										<label class="form-label" for="">Bedroom Total</label>
										<input type="text" name="property-bedroom" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
									<div class="mb-3">
										<label class="form-label" for="">Size in(m2)</label>
										<input type="text" name="property-size" cols="10" rows="5" maxlength="350" class="form-control form-control-sm">
									</div>
								</div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Description</label>
                                    <textarea name="product-description" id="" cols="10" rows="5" maxlength="350" class="form-control form-control-sm" required></textarea>
                                </div>
								
                                <div class="mb-3" id="form-sku">
                                    <label class="form-label" for="">SKU (Optional)</label>
                                    <input type="text" name="sku" id="" class="form-control form-control-sm">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Main Photo</label>
                                    <input type="file" class="form-control form-control-sm" name="__logo_files[]" accept="image/*" required>
                                </div>
								<div class="mb-3">
                                    <label class="form-label" for="">Gallery Photo</label>
                                    <div class="dropzone">
										<div class="dz-message">
											<h6> Click or Drop Image</h6>
										</div>
									</div>
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
                                    <label class="form-label" for="selCountry">Country</label>
                                    <select class="form-select form-select-sm business-country required" required name="product-country" id="selCountry">
                                        <option value="">Select Country</option>
                                    </select>
									<input type="hidden" id="selCountry-id" class="selCountry-id" value="">
									<div id="countryNull" class="text-danger" style="display: none;">Country not null</div>
                                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"><br>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="selState">State / Region</label>
                                    <select class="form-select form-select-sm" name="product-state" id="selState" disabled>
                                        <option value="">Select State</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="selCity">City / Regency</label>
                                    <select class="form-select form-select-sm" name="product-city" id="selCity" disabled>
                                        <option value="">Select City</option>
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
                                    <select class="form-select form-select-sm selected" name="product-type-price" id="price-select" required>
                                        <option value="">Please Select</option>
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
                                    <?php foreach($labeles as $value){
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
            </div>
        </div>
    </div>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>
<?php $this->load->view($template['action_ajax_market']); ?>
<script type="text/javascript">
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
		$('.product-type-buy').change(function(){
            var name = $(this).val();
			console.log(name);
			var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
        	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
            $.ajax({
                url : "<?php echo site_url('buysells/get_category');?>",
                method : "POST",
                data : {name: name, [csrfName]: csrfHash},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
					html = '<option value="">--Select Category--</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+data[i].id+'">'+data[i].data_name+'</option>';
                    }
                    $('.subcategory').html(html);
                    var vehicle = document.getElementById('vehicle-get');
					var property = document.getElementById('property-get');
			
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
					var partCategory = document.getElementById('categoryPart'); 
						if (count < 1) {
						subCategory.style.display = "none";
						partCategory.style.display = "none";
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
		success: function(){
			console.log("Deleted");
		},
		error: function(){
			console.log("Error");

		}
	});
});
</script>
