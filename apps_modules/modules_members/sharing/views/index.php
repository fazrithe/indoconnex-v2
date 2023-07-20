<?php foreach($posts as $value):
    $description  = $value->data_description;
    $post_id = $value->id;
?>
<div class="mb-4 rounded-3 msn-widget" id="<?php echo $post_id; ?>">
    <div class="d-flex align-items-center p-md-4 p-2">
        <?php foreach($users_all as $users_val){
            if($users_val->id == $value->users_id )
        { ?>
        <div>
            <?php if(empty($users_val->file_name_original)): ?>
            <img src="<?php echo base_url()?>public/themes/user/images/placehold/user-1x1.png" class="rounded-circle feed-user-img" alt="">
            <?php else: ?>
            <img src="<?php echo base_url().$users_val->file_path . $users_val->file_name_original ?>" class="rounded-circle feed-user-img" alt="">
            <?php endif ?>
        </div>
        <div class="ms-3 d-flex flex-column">
            <a href="<?php echo site_url('post/'.$users_val->username) ?>"><span class="text-prussianblue fw-bold"><?php echo $users_val->name_first ?> <?php echo $users_val->name_middle ?> <?php echo $users_val->name_last ?></span></a>
            <abbr title="<?php echo carbon_long($value->created_at)?>" class="text-decoration-none"><span class="text-muted"><?php echo carbon_human($value->created_at);?></span></abbr>
        </div>
        <?php }} ?>
    </div>
    <div class="placeholder-glow thepost">
        <?php if($value->file_image_path or $value->file_image_url): ?>
            <img data-src="<?php echo base_url() . $value->file_image_path .'/'. $value->file_image_name_original?>" class="mb-4 mx-auto d-block w-100 placeholder fit-cover" alt="" >
            <img data-src="<?php echo $value->file_image_url; ?>" class="mb-4 mx-auto d-block w-100 placeholder fit-contain" alt="" data-imgtype="photo" >
			<?php elseif(!empty($value->file_video_path) || !empty($value->file_video_url)): ?>
            <?php if($value->file_video_url){ ?>
                <video id="vid-<?php echo $value->id ?>" playsinline="playsinline" loop="loop"  controls="controls" class="w-100 video-js vjs-default-skin vjs-16-9"  data-setup='{
                    "techOrder": ["youtube", "html5"],
                    "sources": [{
                        "type": "video/youtube",
                        "src": "<?php echo $value->file_video_url ?>"
                    }]
                }'>
                </video>
            <?php }else{ ?>
                <video playsinline="playsinline" loop="loop"  controls="controls" class="w-100 placeholder">
                    <source data-src="<?php echo base_url() . $value->file_video_path .'/'. $value->file_video_name?>" type="video/mp4">
                </video>
            <?php } ?>
        <?php endif;?>
        <p class="px-4 pt-3 text-pre-wrap text-break"><?php echo $description; ?></p>
    </div>
</div>
<?php endforeach; ?>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
