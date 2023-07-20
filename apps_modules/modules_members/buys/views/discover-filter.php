<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_buys']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>" />

<!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0">
        <div class="pt-4 mr-0 bg-indoconnex">

            <span class="d-flex fw-bold mb-3">Discover Buy & Sells</span>
            <div class="d-flex bg-white mb-3">
                <form action="<?php echo base_url('buysells/discover/filter') ?>" class="row p-2 w-100" method="get" role="form">
                    <div class="d-flex justify-content-evenly">
                        <div class="input-group input-group-sm border-0 d-flex align-items-center py-1 mx-auto">
                            <span class="input-group-text bg-white border-0" id="basic-addon1">
                                <span class="material-icons text-danger">search</span>
                            </span>
                            <input type="text" class="form-control border border-2 rounded-0" placeholder="Search" aria-label="" aria-describedby="basic-addon1" id="" name="product-name">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <span class="d-none d-md-block text-white px-3">Search</span>
                                <span class="material-icons text-white d-block d-md-none">search</span>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex">
					<div class="col-md-4">
                            <select name="product-location" id="" class="form-select form-select-sm border-0 fw-semi fs-12">
                            <option value="">Country</option>
                                <?php foreach($countries as $value){
									if($country_name == $value->name){
										echo "<option value='".$value->id."' selected>".$value->name."</option>";
									}else{
										echo "<option value='".$value->id."'>".$value->name."</option>";
									}
                                } ?>
                            </select>
                        </div>
						<select name="product-type" id="product-type-buy" class="form-select border-0 fw-semi fs-12 product-type-buy">
                            <option value="0">Type</option>
							<?php foreach($item_categories as $value){ 
								$selected = '';
								if($data_filter['type'] == $value->data_name) {
									$selected = 'selected';
								};
							echo "<option value='$value->data_name' $selected>$value->data_name</option>";
							}
							?>
                        </select>
                        <select name="product-category" id="product-category-display" class="form-select border-0 fw-semi fs-12 subcategory">
						<option value="0">Category</option>
							<?php
                                    foreach($categories as $value){
                                        $selected = '';
										if($data_filter['category'] == $value->id) {
											$selected = 'selected';
										};
                                        echo "<option value='$value->id' $selected >$value->data_name</option>";
                                    }
                            ?>
                        </select>
                        <select name="product-status" id="" class="form-select border-0 fw-semi fs-12">
                            <option value="">Status</option>
							<?php foreach($data_status as $value){     
									$selected = '';
										if($data_filter['status'] == $value) {
											$selected = 'selected';
										};
                                        echo "<option value='$value' $selected >$value</option>";
                                    }
                            ?>
                        </select>
                    </div>
					<div class="d-flex">
							<div class="mb-3" id="subChildCategory-display" style="display: none;">
								<select class="form-select border-0 fw-semi fs-12 subChildCategory" name="product-sub-category">
									<option>Sub Category</option>
									<?php
                                    foreach($sub_categories as $value){
                                        $selected = '';
										if($data_filter['sub_category'] == $value->id) {
											$selected = 'selected';
										};

                                        echo "<option value='$value->id' $selected >$value->data_name</option>";
                                    }
                                    ?>
								</select>
							</div>
							<div class="mb-3" id="categoryPart">
                                <select class="form-select border-0 fw-semi fs-12 partCategory" name="part-category">
								<?php
                                    foreach($part_categories as $value){
                                        $selected = '';
										if($data_filter['sub_category'] == $value->id) {
											$selected = 'selected';
										};

                                        echo "<option value='$value->id' $selected >$value->data_name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
						</div>
                </form>
            </div>

            <div class="bg-white container d-flex">
                <div class="col-12">
                    <div class="justify-content-evenly m-3 d-flex align-text-center">
                        <span class="me-auto text-prussianblue fw-bold">Search Result</span>
                        <span class="ms-auto text-muted">Found <?php echo $total_rows ?> matches</span>
                    </div>

                    <div class="row row-cols-3 mb-3">
                        <?php foreach ($products as $value) { ?>
                            <div class="col-12 col-xs-6 col-md-4 p-2">
                                <div class="card h-100">
                                    <div class="placeholder-glow discover-img position-relative">
                                        <a href="#product-detail" data-bs-toggle="modal" role="button" data-bs-productid="<?php echo $value['id'] ?>">
                                            <img class="card-img-top placeholder h-100" data-src="<?php echo base_url() . $value['file_path'] . $value['file_name_original'] ?>" data-imgtype="shopping_bag" id="product-image-<?php echo $value['id'] ?>" alt="<?php echo slug($value['data_name']) ?>">
                                        </a>
                                        <?php if (!empty($value['data_label'])) { ?>
                                            <div class="position-fixed top-0 left-0 mt-2 ms-2">
                                                <div class="badge rounded-pill bg-danger text-white fw-bold fs-12 m-1"><?php echo $value['data_label'] ?></div>
                                            </div>
                                        <?php } ?>
                                        <!-- <label class="fs-11 text-white bg-danger p-1 position-absolute end-0 top-50 translate-middle-y me-8" data-bs-toggle="button" style="font-size: 10px;"><small>New Product</small></label> -->
                                        <button type="button" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite($value['id'], 'pbd_items'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="market" data-content-id="<?php echo $value['id'] ?>" autocomplete="off"></button>
                                    </div>
                                    <div class="card-body p-2">
                                        <a href="#product-detail" data-bs-toggle="modal" role="button" data-bs-productid="<?php echo $value['id'] ?>">
                                        <div id="product-category-<?php echo $value['id'] ?>" class="text-muted fs-14">
                                                <?php
                                                if (!empty($value['data_categories'])) {
                                                    $categories = json_decode($value['data_categories']);
                                                    foreach ($categories as $categories_val) {
                                                        foreach ($item_categories as $category_val) {
                                                            if ($categories_val == $category_val->id) {
                                                                echo $category_val->data_name;
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                        </div>
                                        <a href="#product-detail" data-bs-toggle="modal" class="text-black" role="button" data-bs-productid="<?php echo $value['id'] ?>">
                                            <div id="product-name-<?php echo $value['id'] ?>" class="fs-16 fw-semi mb-2">
                                                <span><?php echo $value['data_name'] ?></span>
                                                <?php if ($value['item_status']) { ?>
                                                    <br />
                                                    <div class="d-flex flex-row flex-wrap">
                                                        <span class="text-muted bg-light" style="padding: .35em .65em;border-radius: 50rem !important;font-size: .75em;"><?php echo $value['item_status']; ?></span>
                                                <?php } ?>
                                                    <span class="text-muted" style="padding: .35em .65em;border-radius: 50rem !important;font-size: .75em;"><?php echo get_buy_and_sells_category($value['data_categories']); ?></span>
                                                </div>
                                            </div>
                                        
                                            <div class="d-none" id="product-desc-<?php echo $value['id'] ?>">
                                                <?php echo !empty($value['data_description']) ? $value['data_description'] : 'No Description' ?>
                                            </div>
                                            <div class="fs-14 mb-2"><?php echo !empty(character_limiter($value['data_description'], 20)) ? character_limiter($value['data_description'], 20) : 'No Description' ?></div>
                                            <div id="product-price-<?php echo $value['id'] ?>" class="text-end text-prussianblue fw-semi fs-16" data-currency="<?php echo $value['price_currency'] ?>">
                                                <?php
                                                    switch ((int)$value['price_type']) {
                                                        case 1:
                                                            echo 'Free / Giveaway';
                                                            break;

                                                        case 2:
                                                            echo $value['price_currency'] . ' ' . number_format((float) $value['price_low'], 2, ".", ",");
                                                            break;

                                                        case 3:
                                                            echo 'Starting at ' . $value['price_currency'] . ' ' . number_format((float) $value['price_low'], 2, ".", ",");
                                                            break;

                                                        case 4:
                                                            echo 'Ask for Price';
                                                            break;

                                                        case 5:
                                                            echo 'Variable Pricing';
                                                            break;
                                                        default:
                                                            break;
                                                    }
                                                ?>
                                            </div>
                                        </a>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- <div id="listdatabusiness"></div> -->
                    </div>
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['partials_modal_market_detail']); ?>
<?php $this->load->view($template['action_ajax_market']); ?>
<?php $this->load->view($template['action_ajax_favourite']); ?>
<script type="text/javascript">
	$(document).ready(function(){
		var name = document.getElementById('product-type-buy').value;
		var subCategory = document.getElementById('subChildCategory-display'); 
		var category_display = document.getElementById('product-category-display').value;
			if (name == "Item" && category_display != 0) {
				subCategory.style.display = "block";
			} else {
				subCategory.style.display = "none";
			}
		$('.product-type-buy').change(function(){
            var name = $(this).val();
			var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
        	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
            
            if(name == 0){
                html = '';
                html = '<option value="0">Category</option>';
                $('.subcategory').html(html);
            }else{
            $.ajax({
                url : "<?php echo site_url('buysells/get_category');?>",
                method : "POST",
                data : {name: name, [csrfName]: csrfHash},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
					html = '<option value="0">Category</option>';
                        for(i=0; i<data.length; i++){
                            html += '<option value="'+data[i].id+'">'+data[i].data_name+'</option>';
                        }
                    $('.subcategory').html(html);
                }
            });
            }
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
						if (count < 1) {
						subCategory.style.display = "none";
					} else {
						subCategory.style.display = "block";
					}
                    var html = '';
                    var i;
					html = '<option value="">Sub Category</option>';
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
					html = '<option value="">Accessories & Part</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+data[i].id+'">'+data[i].data_name+'</option>';
                    }
                    $('.partCategory').html(html);
                }
            });
        });
	});
</script>
