<?php $this->load->view($template['partial_banner']); ?>
<?php $this->load->view($template['partial_filter']); ?>
<!-- SECTION - BUSINESS -->
<?php foreach($widget as $value){ ?>
<div class="container">
	<h2 class="mt-4 title-dark"><?php echo $value->data_name ?></h2>
	  <!-- BUSINESS - 1 -->
	  
	  <div class="row mt-1">
	  <?php foreach($widget_page as $value_page){ 
		  		if($value_page->parent == $value->id){
		?>
		<div class="col-4 col-xs-4 col-md-2">
		<a href="<?php 
		if(!empty($value_page->data_link) and !empty($value_page->data_link_name)){
			echo base_url().$value_page->data_link.'/'.preg_replace('/[^a-zA-Z0-9-&]/', '-',$value_page->data_link_name);
		}else{
			echo base_url('#');
		} ?>">
			<div class="card border-0 h-100">
				<img src="<?php echo base_url() . $value_page->file_path . $value_page->file_name_original ?>" class="card-img-top" alt="Shoppping Center">
				<div class="card-body">
					<h6 class="card-title"><?php echo $value_page->data_name ?></h6>
				</div>
			</div>
			
		</a>
		</div>
		<?php } } ?>
	</div>
</div>
<?php } ?>
<?php $this->load->view($template['partial_how_works']); ?>
<?php $this->load->view($template['partial_partners']); ?>
<?php $this->load->view($template['partial_ajax_public']);
