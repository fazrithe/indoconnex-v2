<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_tender']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0">
        <div class="pt-4 mr-0 bg-indoconnex" >

            <span class="d-flex fw-bold mb-3">Discover Tender</span>
            <div class="d-flex bg-white mb-3">
                <form action="<?php echo base_url('tender/discover/search') ?>" class="row p-2 w-100" method="get" role="form">
				<div class="d-flex justify-content-evenly">
                        <div class="input-group input-group-sm border-0 d-flex align-items-center py-1 mx-auto">
                            <span class="input-group-text bg-white border-0" id="basic-addon1">
                                <span class="material-icons text-danger">search</span>
                            </span>
                            <input type="text" class="form-control border border-2 rounded-0" placeholder="Search" aria-label="" aria-describedby="basic-addon1" id="" value="<?php echo $tender_name ?>" name="tender-name">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <span class="d-none d-md-block text-white px-3">Search</span>
                                <span class="material-icons text-white d-block d-md-none">search</span>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex">
                        <select name="tender-type" id="" class="form-select border-0 fw-semi fs-12">
                            <option value="">Product Type</option>
                            <?php foreach($tender_types as $value){ 
									if($tender_type == $value->id){
							?>
							  		<option value="<?php echo $value->id ?>" selected><?php echo $value->data_name ?></option>
								<?php }else{ ?>	
									<option value="<?php echo $value->id ?>"><?php echo $value->data_name ?></option>
                            <?php }} ?>
                        </select>

                        <select name="tender-category" id="" class="form-select border-0 fw-semi fs-12">
                            <option value="">Tender Category</option>
                            <?php foreach($tender_categories as $value){ 
									if($tender_category == $value->id){
							?>
								<option value="<?php echo $value->id ?>" selected><?php echo $value->data_name ?></option>
                                <?php }else{ ?>
								<option value="<?php echo $value->id ?>"><?php echo $value->data_name ?></option>
                            <?php }} ?>
                        </select>

                        <select name="tender-location" id="" class="form-select border-0 fw-semi fs-12">
                        <option value="">Country</option>
                            <?php foreach($countries as $value){
                                echo "<option value='".$value->id."'>".$value->name."</option>";
                            } ?>
                        </select>

                    </div>
                </form>
            </div>

            <div class="bg-white container d-flex">
                <div class="col-12">
                    <div class="justify-content-evenly m-3 d-flex align-text-center">
                        <span class="me-auto text-prussianblue fw-bold">Search Result</span>
                        <span class="ms-auto text-muted">Found <?php echo $total_rows ?> matches</span>
                    </div>

                    <?php if (!empty($tender)) { ?>
                    <div id="" class="row row-cols-3 mb-3">
                        <?php foreach($tender as $value){?>
                        <div class="col-12 col-xs-6 col-md-4 p-2">
                            <div class="card border-1 h-100">
                                <div class="placeholder-glow discover-img position-relative">
                                    <img class="card-img-top placeholder h-100" data-src="<?php echo base_url() . $value['file_path'] . $value['file_name_original'] ?>" data-imgtype="shopping_bag" id="product-image-<?php echo $value['id'] ?>" alt="<?php echo slug($value['data_name']) ?>">
                                    <?php if (!empty($value['data_label'])) { ?>
                                    <div class="position-fixed top-0 left-0 mt-2 ms-2">
                                        <div class="badge rounded-pill bg-danger text-white fw-bold fs-12 m-1"><?php echo $data['data_label'] ?></div>
                                    </div>
                                    <?php } ?>
                                    <button type="button" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite($value['id'],'pbd_items'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="market" data-content-id="<?php echo $value['id'] ?>" autocomplete="off"></button>
                                </div>
                                <div class="card-body p-2">
									<div id="product-category-<?php echo $value['id'] ?>" class="text-muted fs-14">
                                    <?php
										if(!empty($value['data_categories'])){
											foreach($tender_categories as $category_val){
													if($value['data_categories'] == $category_val->id ){
														echo $category_val->data_name;
													}
												}
										}
										?>
									</div>
									<div id="tender-name-<?php echo $value['id'] ?>" class="fs-16 fw-semi mb-2">
                                    <a href="#product-detail" data-bs-toggle="modal" class="text-black" role="button" data-bs-productid="<?php echo $value['id'] ?>">
										<?php echo $value['data_name'] ?>
                                    </a>
									</div>
                                    <div class="d-none" id="tender-desc-<?php echo $value['id'] ?>">
                                        <?php echo !empty($value['data_description']) ? $value['data_description'] : 'No Description' ?>
                                    </div>
									<div class="fs-14 mb-2"><?php echo !empty(character_limiter($value['data_description'], 20)) ? character_limiter($value['data_description'], 20) : 'No Description' ?></div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <?php echo $this->pagination->create_links(); ?>
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
<?php $this->load->view($template['partials_modal_market_detail']); ?>
<?php $this->load->view($template['action_ajax_market']); ?>
<?php $this->load->view($template['action_ajax_favourite']); ?>
