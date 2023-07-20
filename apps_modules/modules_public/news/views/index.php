<?php $this->load->view($template['partial_banner']); ?>
<?php $this->load->view($template['partial_filter']); ?>
<!-- SECTION - BUSINESS -->
<div class="container">
    <div class="row mt-1">
                <!-- SECTION - Covid-19 Articles -->
     <div class="container">
        <div class="d-flex align-items-center mb-4">
            <div><h2 class="mt-4 title-dark">News & Events</h2>
            </div>
            <div class="ms-auto">
                <div class="dropdown">
                    <a href="<?php echo site_url('public/discover/news')?>" class="text-danger" style="color:#EE0202;">View all</a>
								</div>
            </div>
        </div>
      <!-- BUSINESS - 1 -->
          <div class="row mt-1">
			<?php foreach($news as $value){ ?>
			<div class="col-6 col-xs-6 col-md-3">
              <div class="card border-0">
								<a href="<?php echo base_url()."news/$value->data_slug"; ?>">
                <img src="<?php echo base_url() . $value->file_path . $value->file_name_original ?>" class="card-img-top" alt="<?php echo $value->data_name ?>">
								</a> 
								<div class="card-body border-0">
                  <h6 class="card-title"><a classs="link-primary" href="<?php echo base_url()."news/$value->data_slug"; ?>"><?php echo $value->data_name ?></a></h6>
                  <?php if (!empty($value->data_categories)) { ?>
                    <?php foreach(json_decode($value->data_categories) as $category) { ?>
                      <span class="badge rounded-pill bg-light text-dark mx-1"><?= get_news_category_by_id($category); ?></span>
                    <?php } ?>
                  <?php } else { ?>
                    <span class="badge rounded-pill bg-light text-dark mx-1">Uncategorized</span>
                  <?php } ?>
                  <span class="fs-10 text-start text-muted d-flex">Post by: <?php echo $value->fullname ?></span>
                  <span class="fs-10 text-start text-muted d-flex"><?php echo carbon_human($value->updated_at) ?></span>
                </div>
              </div>
			</div>
			<?php } ?>
         </div>
      </div>
    </div>
</div>

<?php $this->load->view($template['partial_how_works']); ?>
<?php $this->load->view($template['partial_partners']); ?>
<?php $this->load->view($template['partial_ajax_public']); ?>
