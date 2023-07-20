<?php $this->load->view($template['partial_banner']); ?>
<?php $this->load->view($template['partial_filter']); ?>

<!-- Gallery Pages -->
<div class="container mb-3">
	<?php if(!empty($info)){
			foreach($info as $value){
	?>
    <h4 class="fw-light mt-4 mb-4 judul-section"><?php echo $value->data_name ?></h4>
	<p><?php echo $value->data_description ?></p>
    <?php }} ?>
</div>

<?php $this->load->view($template['partial_about_join']); ?>
