
<?php $this->load->view($template['partial_banner']); ?>
<?php $this->load->view($template['partial_filter']); ?>
<main>
        <!-- About US Start -->
        <div class="about-area">
            <div class="container">
                   <div class="row">
                        <div class="col-lg-8">
                            <!-- Trending Tittle -->
                            <div class="about-right mb-90">
                                <div class="about-img">
                                    <img class="w-100" src="<?php echo base_url().$news->file_path.$news->file_name_original ?>" alt="">
                                </div>
                                <div class="section-tittle mb-30 pt-30">
                                    <h3><?php echo $news->data_name ?></h3>
									<span><?php echo $news->updated_at ?></span>
                                </div>
								<div class="row">
									<div class="col-1" style="display: inline-block; padding:10px">
										<?=share_button('twitter',    array('url'=>base_url().'news/'.$news->data_slug, 'text'=>$news->data_name, 'via'=>'indoconnex'))?>
									</div>
									<div class="col" style=" display: inline-block; padding:5px; padding-left:40px;">
										<?=share_button('facebook',    array('url'=>base_url().'news/'.$news->data_slug, 'text'=>$news->data_name, 'via'=>'indoconnex'))?>
									</div>
								</div>
                                <div class="about-prea">
                                    <p class="about-pera1 mb-25"><?php echo $news->data_description ?></p>
                                </div>
								
                            </div>
                          </div>
                        <div class="col-lg-3">
                            <!-- New Poster -->
                            <div class="news-poster d-none d-lg-block card-body bg-white">
							<div class="overflow-y righty d-none d-xl-block">
								<br>
								<span class="text-prussianblue fw-bold fs-14 pb-4">Promotion</span>
								<?php if(!empty($promotions)){
									foreach($promotions as $value){ ?>
								<div class="mb-2 mt-2">
									<a href="<?php echo $value->data_link ?>" title="" target="_blank">
										<figure class="rounded ratio ratio-16x9 w-100" data-aspect-ratio="16:9">
										<?php
											$url = base_url() . 'public/themes/user/images/placehold/business-16x9.png';
												if(!empty($value->file_name_original)) {
												$url = base_url() . $value->file_path . $value->file_name_original;
												}
										?>
											<img src="<?php echo $url ?>" alt="<?php echo slug(words($value->data_name, 5)) ?>" class="" style="object-fit: cover;">
										</figure>
									</a>
								</div>
								<div class="mb-2">
									<span class="mb-2"><a href="<?php $value->data_link ?>" target="_blank" title="" class="text-black fw-semi fs-12"><?php echo $value->data_name ?></a></span>
									<div class="hstack">
										<span class="text-muted fs-10 fw-semi">view more</span>
										<span class="ms-auto"><a href="<?php echo $value->data_link ?>" class="text-danger text-decoration-underline fs-10 fw-semi"><?php echo $value->data_link_name ?></a></span>
									</div>
								</div>
							<?php }} ?>
							</div>
                            </div>
                        </div>
                   </div>
            </div>
        </div>
        <!-- About US End -->
    </main>
