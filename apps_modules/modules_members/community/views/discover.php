<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_community']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0">
        <div class="pt-4 mr-0 bg-indoconnex" >

            <span class="d-flex fw-bold mb-3">Discover Community</span>
            <div class="d-flex bg-white mb-3">
                <form action="<?php echo base_url('community/discover') ?>" class="row p-2 w-100" method="post" role="form">
                <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                <div class="d-flex justify-content-evenly">
                        <div class="input-group input-group-sm border-0 d-flex align-items-center py-1 mx-auto">
                            <span class="input-group-text bg-white border-0" id="basic-addon1">
                                <span class="material-icons text-danger">search</span>
                            </span>
                            <input type="text" class="form-control border-end-2 border-start-0 border-top-0 border-bottom-0 border border-2 rounded-0" placeholder="Search" aria-label="" aria-describedby="basic-addon1" id="" name="community-name" value="<?php echo $data_filter['name'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <span class="d-none d-md-block text-white px-3">Search</span>
                                <span class="material-icons text-white d-block d-md-none">search</span>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex">
                        <select name="community-category" id="" class="form-select border-0 fw-semi fs-12">
                            <option value="">Category</option>
                            <?php foreach($categories as $value){
                                 if($data_filter['category'] == $value->id){
                                    echo "<option value='".$value->id."' selected>".$value->data_name."</option>";
                                 }else{
                                    echo "<option value='".$value->id."'>".$value->data_name."</option>";
                                 }
                           		 } ?>
                        </select>
                        <select name="community-privacy" id="" class="form-select border-0 fw-semi fs-12">
							<option value="">Privacy</option>
							<?php 
							$type = ['Public'=>0,'Service'=>1];
							foreach ($type as $key => $value){
							if($data_filter['privacy'] == $value){
								  echo "<option value='".$value."' selected>".$key."</option>";
								}else{
									echo "<option value='".$value."'>".$key."</option>";
								}
							}
									?>
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

                    <div id="" class="row row-cols-3 mb-3">
                        <?php foreach($communities as $value){?>
                        <div class="col-12 col-xs-6 col-md-4 p-2">
                            <a href="<?php echo base_url('community/post/') ?><?php echo $value->id ?>">
                            <div class="card border-1 h-100 handcur" data-bs-toggle='modal' href='#community-detail' data-bs-productid="<?php echo $value->id ?>">
                                <div class="placeholder-glow discover-img position-relative">
                                    <img class="card-img-top placeholder h-100" data-src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" data-imgtype="group" id="community-image-<?php echo $value->id ?>" alt="<?php echo slug($value->data_name) ?>">
                                    <button type="button" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite($value->id,'pcs_communities'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="communities" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
                                </div>
                                <div class="card-body p-2">
									<div id="community-category-<?php echo $value->id ?>" class="text-muted fs-14">
                                    <?php
                                      foreach($categories as $categories_val){
                                            if($categories_val->id == $value->data_categories){
                                                echo $categories_val->data_name;
                                            }
                                        }
                                    ?>
									</div>
									<div id="community-name-<?php echo $value->id ?>" class="fs-16 fw-semi mb-2">
										<?php echo $value->data_name ?>
									</div>
                                    <div class="d-none" id="community-desc-<?php echo $value->id ?>">
                                        <?php echo !empty($value->data_description) ? $value->data_description : 'No Description' ?>
                                    </div>
                                    <span class="fs-14 text-muted text-wrap align-items-center d-flex">
                                        <span class="material-icons fs-14 me-1">people</span>
                                        <abbr class="abbrevNum2Str me-1" title="<?php echo total_followers($value->id);?>" ><?php echo total_followers($value->id);?></abbr> Followers
                                    </span>
                                </div>
                            </div>
                            </a>
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
<?php $this->load->view($template['action_ajax_community']); ?>
<?php $this->load->view($template['action_ajax_favourite']); ?>
