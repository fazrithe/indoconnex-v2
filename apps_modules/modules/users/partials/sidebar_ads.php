
<aside id="sidebar" class="righty d-none d-xl-block position-xl-fixed top-0">
    <div class="sidebar-header">
        <img src="<?php echo theme_user_locations(); ?>images/logo/logo.png" alt="" />
    </div>

    <div class="overflow-y">
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
</aside>

