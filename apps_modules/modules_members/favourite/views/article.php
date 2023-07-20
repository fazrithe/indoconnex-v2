<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_favourite']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<div class="row">
    <div class="col-11 col-md-7 mx-auto px-0">
        <div class="pt-4 mr-0 bg-indoconnex" >
        <div class="mb-4 p-4 rounded-3 msn-widget" >
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <img src="<?php echo site_url('public/themes/user/images/icons/article.svg') ?>" class="img-circle" alt="article-icon">
                    </div>
                    <div class="flex-grow-1 ms-3 flex-column d-flex">
                        <a href="<?php echo site_url('articles/discover') ?>" class="text-prussianblue fw-bold ">Article</a>
                    </div>
                </div>
                <div class="border-0">
                    <div class="row row-cols-md-4" id="artic-rand">
                        <?php foreach ($article as $value){ ?>
                        <div class="col">
                            <div class="card h-100">
                                <div class="placeholder-glow business-card position-relative">
                                    <img src="<?php echo placeholder($value->file_path, $value->file_name_original, 'article', '16x9') ?>" alt="<?php echo slug(words($value->data_name, 5)) ?>" class="card-img-top fit-cover">
                                    <button type="button" class="btn btn-favourite fs-18 text-danger bg-light rounded-circle p-2 position-absolute end-0 top-100 translate-middle-y me-3 <?php echo active_favourite($value->id,'pfe_articles'); ?>" data-bs-toggle="button" aria-pressed="false" data-content-type="articles" data-content-id="<?php echo $value->id ?>" autocomplete="off"></button>
                                </div>
                                <div class="card-body flex-column d-flex placeholder-glow px-3">
                                    <span class="d-flex align-items-center fs-16 fw-bold" id="prod-rand1-name">
                                        <a class="text-black fw-semi fs-16 text-break" href="<?php echo site_url('articles/detail/'.$value->id)?>"><?php echo str_limit($value->data_name, 90) ?></a>
                                    </span>
                                </div>
                                <div class="card-footer bg-transparent align-items-end d-flex border-0">
                                    <abbr title="<?php echo carbon_long($value->published)?>" class="text-decoration-none ms-auto fs-14"><span class="text-muted"><?php echo carbon_human($value->published);?></span></abbr>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_favourite']); ?>