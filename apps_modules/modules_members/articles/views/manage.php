<style>
@media (max-width: 768px) {
    #listDesktop {
		display: none;
    }
	
	#listMobile {
		display: block;
    }
}

@media (min-width: 1024px) {
    #listDesktop {
		display: block;
    }
	
	#listMobile {
		display: none;
    }
}

</style>
<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_article']); ?>

<!-- Page Content  -->
<main class="py-4">
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0 mt-4">
            <div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
                <select name="businessSelector" onchange="selectUserArticle(this.value)"  class=" border-0 bg-white p-2 js-businessSelector">
                    <option value="1" data-image="<?php echo placeholder($users->file_path, $users->file_name_original) ?>"><?php echo $users->name_first ?> <?php echo $users->name_last ?></option>
					<?php foreach($business_list as $value) {
                            $selected = '';
                            if ($filter_id == $value->id) $selected = 'selected'; ?>
                            <option value="<?php echo $value->id ?>"
                                data-id="<?php echo $value->id ?>"
                                data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business')?>" class="" <?php echo $selected?> data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo $value->data_name ?>">
                                    <?php echo $value->data_name ?>
                            </option>
                        <?php } ?>
                </select>
            </div>
			<span class="d-flex fw-bold mb-3">Manage Article</span>
				<?php if(!empty($post_articles)) : ?>

				<!-- Desktop -->
				<div id="listDesktop">
				<?php foreach($post_articles as $value):?>
					<div class="article-post d-flex bg-white align-items-center mb-3">
						<div class="flex-shrink-0 placeholder-glow">
							<img data-src="<?php echo placeholder($value->file_path, $value->file_name_original, 'article', '4x3') ?>" class="article-list m-3 rounded-3 border placeholder" alt="<?php echo slug($value->data_name) ?>">
						</div>
						<div class="flex-grow-1 ms-3 flex-column article-desc">
							<a class="" href="<?php echo site_url('articles/detail/'.$value->id) ?>"><h6 class="fw-bold text-prussianblue align-items-center d-flex"><?php echo $value->data_name ?></h6></a>
                            <abbr title="<?php echo carbon_long($value->published)?>" class="text-decoration-none ms-auto"><span class="text-muted"><?php echo carbon_human($value->published);?></span></abbr>
						</div>
                        <div class="d-flex align-items-center ms-auto me-3">
                            <div class="badge rounded-pill bg-danger p-1 d-flex">
                                <a class="btn btn-sm d-flex align-items-center px-1 py-0" role="button" href="<?php echo site_url('articles/edit/'.$users->id.'/'.$value->id)?>">
                                    <span class="material-icons text-white md-16">edit</span>
                                </a>
                                <div class="vr opacity-100"></div>
                                <a class="btn btn-sm d-flex align-items-center px-1 py-0" role="button" data-bs-toggle="modal" href="#del_article<?php echo $value->id ?>">
                                    <span class="material-icons text-white md-16">delete</span>
                                </a>
                            </div>
                        </div>
					</div>
				<?php endforeach; ?>
				</div>

				<!-- Mobile -->
				<div id="listMobile">
				<?php foreach($post_articles as $value):?>
					<div class="article-post d-flex bg-white align-items-center mb-3">
						<div class="flex-shrink-0 placeholder-glow">
							<img data-src="<?php echo placeholder($value->file_path, $value->file_name_original, 'article', '4x3') ?>" class="article-list m-3 rounded-3 border placeholder" alt="<?php echo slug($value->data_name) ?>">
						</div>
						<div class="flex-grow-1 ms-3 flex-column article-desc">
							<a class="" href="<?php echo site_url('articles/detail/'.$value->id) ?>"><h6 class="fw-bold text-prussianblue align-items-center d-flex"><?php echo $value->data_name ?></h6></a>
                            <abbr title="<?php echo carbon_long($value->published)?>" class="text-decoration-none ms-auto"><span class="text-muted"><?php echo carbon_human($value->published);?></span></abbr>
						
                        <div class="d-flex align-items-center ms-auto me-3">
                            <div class="badge rounded-pill bg-danger p-1 d-flex">
                                <a class="btn btn-sm d-flex align-items-center px-1 py-0" role="button" href="<?php echo site_url('articles/edit/'.$users->id.'/'.$value->id)?>">
                                    <span class="material-icons text-white md-16">edit</span>
                                </a>
                                <div class="vr opacity-100"></div>
                                <a class="btn btn-sm d-flex align-items-center px-1 py-0" role="button" data-bs-toggle="modal" href="#del_article<?php echo $value->id ?>">
                                    <span class="material-icons text-white md-16">delete</span>
                                </a>
                            </div>
                        </div>
						</div>
					</div>
				<?php endforeach; ?>
				</div>

				<div id="show"></div>
				<div class="text-center">
					<?php echo $this->pagination->create_links(); ?>
				</div>
				<?php else: ?>
					<div class="card-body bg-white border-0">
						<div class="d-flex align-items-center flex-column">
							<div class="mb-3">
								<img src="<?php echo site_url('public/themes/user/images/articles/default.png') ?>" alt="no-article">
							</div>
							<div class="mb-3">
								<span class="text-muted ">You do not have any article</span>
							</div>
							<div class="mb-3">
								<a href="<?php echo site_url('articles/create') ?>" class="btn btn-danger">Create Article</a>
							</div>
						</div>
					</div>
				<?php endif;?>
        </div>
    </div>
</main>


<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['partials_modal_article']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>
