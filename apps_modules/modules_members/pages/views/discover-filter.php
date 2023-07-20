<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_pages']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0">
        <div class="pt-4 mr-0 bg-indoconnex" >

            <span class="d-flex fw-bold mb-3">Discover Business Pages</span>
            <div class="d-flex bg-white mb-3">
                <form action="<?php echo base_url('business/discover/filter') ?>" class="row p-2 w-100" method="get" role="form">
                    <div class="d-flex justify-content-evenly">
                        <div class="input-group input-group-sm border-0 d-flex align-items-center py-1 mx-auto">
                            <span class="input-group-text bg-white border-0" id="basic-addon1">
                                <span class="material-icons text-danger">search</span>
                            </span>
                            <input type="text" class="form-control border-bottom-0 border border-2 rounded-0" placeholder="Search" aria-label="" aria-describedby="basic-addon1" id="" name="business-name" value="<?php echo $data_filter['name']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <span class="d-none d-md-block text-white px-3">Search</span>
                                <span class="material-icons text-white d-block d-md-none">search</span>
                            </button>
                        </div>
                    </div>
                    <div class="row">
						 <div class="col-md-4">
                            <select name="business-location" id="business-location" class="form-select border-0 fw-semi fs-12">
                            <option value="">Country</option>
                                <?php foreach($countries as $value){
                                        if($data_filter['location'] == $value->id){
                                            echo "<option value='".$value->id."' selected>".$value->name."</option>";
                                        }else{
                                            echo "<option value='".$value->id."'>".$value->name."</option>";
                                        }
                                } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="business-type" id="business-type" class="form-select border-0 fw-semi fs-12">
                                <option value="">Business Type</option>
                                <?php foreach($types as $value){
                                    if($data_filter['type'] == $value->id){
                                        echo "<option value='".$value->id."' selected>".$value->data_name."</option>";
                                    }else{
                                        echo "<option value='".$value->id."'>".$value->data_name."</option>";
                                    }
                                } ?>
                            </select>
                        </div>

                        <!-- <div class="dropdown dropdown-monik fw-semi fs-12">
                            <button class="btn dropdown-toggle btn-sm" type="button" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Category</button>

                            <ul class="dropdown-menu multi-column col3" aria-labelledby="dropdownMenuLink">
                                <div class="row">
                                    <div class="col-sm-4 g-2">
                                        <ul class="list-unstyled ms-2">
                                            <li><a href="#" class="text-black font-size-sm">Businesses Advertising/Marketing</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Agriculture</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Arts & Entertainment</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" class="text-black font-size-sm">Beauty, Cosmetic & Personal Care</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" class="text-black font-size-sm">Education</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Finance</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Food & Drink</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Hotel & B&B</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Legal</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Local Service</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Medical & Health</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Non-governmental Organisation</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Non-profit Organisation</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Property</a></li>

                                        </ul>
                                    </div>
                                    <div class="col-sm-4 g-2">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-black font-size-sm">Public & Government Service</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Science, Technology & Engineering</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Shopping & Retail</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Sport & Recreation</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Vehicle, Aircraft & Boat</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Community Organisation</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Media Art</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Books & Magazines</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Concert Tour</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Media Restoration Service</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Show</a></li>
                                            <li><a href="#" class="text-black font-size-sm">TV & Film</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Video</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-4 g-2">
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="text-black font-size-sm">Action</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Another action</a></li>
                                            <li><a href="#" class="text-black font-size-sm">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" class="text-black font-size-sm">Separated link</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" class="text-black font-size-sm">One more separated link</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </ul>
                        </div> -->

                        <div class="col-md-4">
                            <select name="business-categories" id="business-categories" class="form-select border-0 fw-semi fs-12 business-categories">
                                <option value="">Business Category</option>
                                <?php foreach($categories as $value){
                                    if($data_filter['category'] == $value->id){
                                        echo "<option value='".$value->id."' selected>".$value->data_name."</option>";
                                    }else{
                                        echo "<option value='".$value->id."'>".$value->data_name."</option>";
                                    }
                                } ?>
                            </select>
                        </div>
						<div class="col-md-4" style="display: block;" id="sub-business-categories-display">
                            <select name="sub-business-categories" id="sub-business-categories" class="form-select border-0 fw-semi fs-12 sub-business-categories">
                                <option value="">Sub Business Category</option>	
								<?php foreach($categories as $value){
                                    if($data_filter['sub_category'] == $value->id){
                                        echo "<option value='".$value->id."' selected>".$value->data_name."</option>";
                                    }else{
                                        echo "<option value='".$value->id."'>".$value->data_name."</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

			<div class="bg-white container d-flex">
                <div class="col-12">
                    <div class="justify-content-evenly m-3 d-flex align-text-center">
                        <span class="me-auto text-prussianblue fw-bold">Search Result</span>
                        <span class="ms-auto text-muted"><?php if($total_rows != 0){ echo 1;}else{echo 0;} ?> of <?php echo $total_rows ?> matches</span>
                    </div>

                    <?php if (!empty($business)) { ?>
                    <div id="" class="row row-cols-3 mb-3">
                        <?php foreach($business as $value){ ?>
                        <div class="col-12 col-xs-6 col-md-4" >
                            <div class="card border-1 h-100">
                                <div class="placeholder-glow discover-img position-relative">
                                	<?php
										$url = base_url() . 'public/themes/user/images/placehold/business-16x9.png';
										if(!empty($value['file_name_original'])) {
											$url = base_url() . $value['file_path'] . $value['file_name_original'];
										}
									?>
									<img class="card-img-top placeholder h-100" data-src="<?php echo $url ?>" id="product-feed" alt="<?php strtolower(str_replace($value['data_name'], '-', ' ')) ?>" data-imgtype="business">
                                    <button type="button" aria-pressed="true" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite($value['id'],'pbd_business'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="business" data-content-id="<?php echo $value['id'] ?>" autocomplete="off"></button>
                                </div>
                                <div class="card-body">
									<h5 class="card-title fw-bold"><a class="link-primary" href="<?php echo site_url('public/business/about/'.urlencode($value['data_username'])) ?>"><?php echo $value['data_name'] ?>
									<?php echo status_verification($value['id']); ?>
									</a></h5>
									<h6 class="card-subtitle mb-2 text-muted">
										<!-- <small class="text-muted">@<?php echo $value['data_username'] ?></small> -->
									</h6>
                                    <div class="justify-content-start d-flex flex-wrap gap-2">
                                        <?php
										$category = json_decode($value['data_categories']);
										if (!empty($category)) {
											$c = 0;
                                            foreach ($category as $valuecategory) {
                                                $this->db->select('*');
                                                $this->db->where('id',$valuecategory);
                                                $query = $this->db->get('pbd_business_categories')->row();
												$c++;
												if($c == 3){
													break;
												}
                                        ?>
										<span class="badge bg-light text-black mt-2 rounded-3 fw-normal"><?php echo !empty($query->data_name) ? substr($query->data_name, 0, 30) : '' ?></span>
                                        <?php }
										} else { ?>
										<span class="badge bg-light text-black mt-2 rounded-3 fw-normal">Uncategorized</span>
										<?php } ?>
                                    </div>
                                    <div class="d-flex justify-content-center  my-2 text-black">
                                        <div class="d-flex mt-2 mx-2 align-items-center bordered">
                                            <span class="material-icons md-16 me-2 text-black">business</span>
                                            <?php
                                              if(!empty($value['data_types'])){
                                            $types = json_decode($value['data_types']);
											$c = 0;
                                            foreach($types as $valuetype){
                                                $this->db->select('*');
                                                $this->db->where('id',$valuetype);
                                                $query = $this->db->get('pbd_business_types')->row();
												$c++;
												if($c == 2){
													break;
												}
                                        ?>
                                            <small><?php if(!empty($query->data_name)){echo $query->data_name;} ?></small>
                                        <?php }} ?>
                                        </div>
                                        <div  class="vr mt-2"></div>
                                        <div class="d-flex mx-2 mt-2 align-items-center">
                                            <span class="material-icons md-16 me-2 text-black">location_on </span>
                                            <?php
                                              if(!empty($value['data_locations'])){
                                            $types = json_decode($value['data_locations']);
                                            foreach($types as $valuelocation){
                                        ?>
                                            <small><?php echo $valuelocation->country_name ?></small>
                                        <?php }} ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
					<?php echo $pagination ?>
                    <?php } else { ?>
                        <div class="d-flex align-items-center">
                            <img class="p-4 w-100" src="<?php echo base_url()?>public/themes/user/images/empty/not-found.png" alt="search-not-found">
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>

    </div>
</div>


<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_business']); ?>
<?php $this->load->view($template['action_ajax_favourite']); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.business-categories').change(function(){
            var id = $(this).val();
			var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
        	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
            $.ajax({
                url : "<?php echo site_url('business/get_category');?>",
                method : "POST",
                data : {id: id, [csrfName]: csrfHash},
                async : false,
                dataType : 'json',
                success: function(response){
                    var data = response.category;
					console.log(data);
					var count = response.category_count;
					var subCategory = document.getElementById('sub-business-categories-display'); 
					if (count < 1) {
						subCategory.style.display = "none";
					} else {
						subCategory.style.display = "block";
					}
                    var html = '';
                    var i;
					html = '<option value="">--Select Category--</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+data[i].id+'">'+data[i].data_name+'</option>';
                    }
                    $('.sub-business-categories').html(html);
                }
            });
        });
	});
</script>
