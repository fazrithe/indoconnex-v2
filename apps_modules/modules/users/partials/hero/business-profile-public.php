<!-- HEADER -->
<div class="container mb-4 msn-widget">
    <div class="px-4 rounded-3 bg-white">
        <div class="position-relative hero-profile">
			<?php
			$cover =  base_url() . 'public/themes/user/images/placehold/business-21x9.png';
			if(!empty($business->cover_file_name_original)){
				$cover = base_url().$business->cover_file_path . $business->cover_file_name_original;
			}
			?>
            <img src="<?php echo $cover ?>"
                class="w-100 mx-auto d-block img-fluid rounded-3 mb-4 border border-5 border-white cover-profile"
                alt="">
            <?php if(!empty($checkusers_profile)){
            ?>
            <?php } ?>
            <button type="button"
                class="btn btn-light d-md-none position-absolute bottom-0 end-0 border border-5 border-white m-4 badge rounded-circle p-2"
                data-bs-toggle="modal" data-bs-target="#editcoverphotoModal">
                <span class="material-icons md-24 align-middle">photo_camera</span>
            </button>

        </div>

        <div class="row">
            <div class="col-md-2 mb-4 d-flex justify-content-center">
                <div class="position-relative hero-details">
                	<?php
						$profile = base_url().'public/themes/user/images/placehold/business-1x1.png';
						if (!empty($business->file_name_original)) {
							$profile = base_url().$business->file_path . $business->file_name_original;
						}
					?>
					<img src="<?php echo $profile?>" class="rounded display-profile" alt="">
                </div>
            </div>
            <div class="col-md-7 mb-4">
                <h5 class="d-none d-md-flex justify-content-start"><b><?php echo $business->data_name ?></b></h5>
                <!-- <p class="d-none d-md-flex justify-content-start">@<?php echo $business->data_username ?></p> -->

                <h5 class="d-md-none d-flex justify-content-center"><b><?php echo $business->data_name ?></b></h5>
                <!-- <p class="d-md-none d-flex justify-content-center">@<?php echo $business->data_username ?></p> -->

                <div class="d-flex flex-wrap align-items-center text-muted">
                    <?php
                    if(!empty($business->data_categories)){
                        $category = json_decode($business->data_categories);
						$c = 0;
                        foreach($category as $valuecategory){
                            $this->db->select('*');
                            $this->db->where('id', $valuecategory);
                            $query = $this->db->get('pbd_business_categories')->row();
							$c++;
							if($c == 3){
								break;
							}
						   
                    ?>
                    <div class="badge rounded-pill bg-light text-black fw-normal m-1"><?php if(!empty($query->data_name)){echo $query->data_name;} ?></div>
                    <?php }} ?>
                </div>
				<?php if(!empty($this->session->userdata('is_login') == FALSE)){  ?>
				<div class="col mb-2">
					<a href="<?php echo site_url('user/login') ?>" class="badge text-black fw-normal m-1" role="button"><i class="fa fa-edit" style="font-size:11px"></i> Suggest Edit</a>
				</div>
				<?php }else{ ?>
				<div class="col">
					<a href="<?php echo site_url('business/manage/suggest/') ?><?php echo $business->id ?>" class="badge text-black fw-normal m-1" role="button"><i class="fa fa-edit" style="font-size:11px"></i> Suggest Edit</a>
				</div>
			<?php } ?>
            </div>
		</div>
	<?php 
	 if(!empty($this->session->userdata('is_login') == FALSE)){ 
	?>
    <div class="row mb-4 ">
        <div>
            <ul class="nav nav-fill px-4" id="navbar-user-profile" role="tablist">
                <li class="nav-item">
                    <a class="nav-link <?php if($this->uri->segment(3)=="post"){echo "active";}?>"
                    href="<?php echo site_url('user/login') ?>">Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($this->uri->segment(3)=="service"){echo "active";}?>"
                    href="<?php echo site_url('user/login') ?>">Products & Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($this->uri->segment(3)=="about"){echo "active";}?>"
                    href="<?php echo site_url('public/business/about/'.urlencode($this->session->userdata('business_username'))) ?>">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($this->uri->segment(3)=="connection"){echo "active";}?>"
                    href="<?php echo site_url('user/login') ?>">Connections</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($this->uri->segment(3)=="photo" or $this->uri->segment(3)=="album"){echo "active";}?>"
                    href="<?php echo site_url('user/login') ?>">Photo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($this->uri->segment(3)=="job"){echo "active";}?>"
                    href="<?php echo site_url('user/login') ?>">Job Offering</a>
                </li>
        </div>
    </div>
	<?php }else{ ?>
		<div class="row mb-4 ">
        <div>
            <ul class="nav nav-fill px-4" id="navbar-user-profile" role="tablist">
                <li class="nav-item">
                    <a class="nav-link <?php if($this->uri->segment(3)=="post"){echo "active";}?>"
                    href="<?php echo site_url('public/business/post/'.$this->session->userdata('business_username')) ?>">Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($this->uri->segment(3)=="service"){echo "active";}?>"
                    href="<?php echo site_url('public/business/service/'.$this->session->userdata('business_username')) ?>">Products & Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($this->uri->segment(3)=="about"){echo "active";}?>"
                    href="<?php echo site_url('public/business/about/'.$this->session->userdata('business_username')) ?>">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($this->uri->segment(3)=="connection"){echo "active";}?>"
                    href="<?php echo site_url('public/business/connection/'.$this->session->userdata('business_username')) ?>">Connections</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($this->uri->segment(3)=="photo" or $this->uri->segment(3)=="album"){echo "active";}?>"
                    href="<?php echo site_url('public/business/photo/'.$this->session->userdata('business_username')) ?>">Photo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($this->uri->segment(3)=="job"){echo "active";}?>"
                    href="<?php echo site_url('public/business/job/'.$this->session->userdata('business_username')) ?>">Job Offering</a>
                </li>
        </div>
    </div>
	<?php } ?>
</div>
</div>
</div>
<script>
var $profilePreview;
var $coverPreview;
$('body').on('shown.bs.modal', '.modal', function() {
	if(!$profilePreview){
		$profilePreview = $('.profile-preview').croppie({
			enableExif: true,
			enforceBoundary:false,
			viewport: {
				width: 110,
				height: 110
			},
			boundary: {
				width: 200,
				height: 200
			}
		});

		$profilePreview.croppie('bind', {
			url: "<?php echo $profile ?>"
		}).then(function() {
			console.log('done update');
		});
	}
	if(!$coverPreview){
		$coverPreview = $('.cover-preview').croppie({
			enableExif: true,
			enforceBoundary:false,
			viewport: {
				width: 1070,
				height: 230
			},
			boundary: {
				width: 1100,
				height: 300
			}
		});

		$coverPreview.croppie('bind', {
			url: "<?php echo $cover ?>"
		}).then(function() {
			console.log('done update');
		});
	}
});

function processCover(input) {
    if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			var imgData = e.target.result;
			var imgName = input.files[0].name;
			input.setAttribute("data-title", imgName);

			$('.cover-preview').addClass('ready');
			$coverPreview.croppie('bind', {
				url: e.target.result
			}).then(function() {

			});
		};
		reader.readAsDataURL(input.files[0]);
    }
}

function readUrl(input) {
    if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			var imgData = e.target.result;
			var imgName = input.files[0].name;
			input.setAttribute("data-title", imgName);

			$('.profile-preview').addClass('ready');
			$profilePreview.croppie('bind', {
				url: e.target.result
			}).then(function() {

			});
		};
		reader.readAsDataURL(input.files[0]);
    }
}
</script>
