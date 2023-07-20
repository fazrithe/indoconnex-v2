<script>
function selectUserTender(id){
	url = '<?php echo site_url();?>';
	if(id==1){
		window.location = url+"tender/list";
	}else{
		window.location = url+"tender/list_filter/"+ id;
	}
}

function selectUserTendermanage(id){
	url = '<?php echo site_url();?>';
	if(id==1){
		window.location = url+"tender/manage";
	}else{
		window.location = url+"tender/manage_filter/"+ id;
	}
}

$('#tender-detail').on('show.bs.modal', function (sender) {
	$tenderid = $(sender.relatedTarget).data('bs-tenderid');
	if($tenderid) {
		$.ajax({
			type  : 'GET',
			url   : '<?php echo site_url('tender/show');?>/'+$tenderid,
		}).done( function ( response ) {
			$response = JSON.parse(response);
			$('#tender-detail-img').attr('src', ''+$response.image);
			$('#tender-detail-name').text($response.name);
			$('#tender-detail-cat').text($response.category.data_name);
			$('#tender-detail-desc').text($response.description);
			$('#tender-detail-seller-name').text($response.seller_name);
			$('#tender-detail-seller-image').attr('src', ''+$response.seller_image);
			
		}).fail( function (params) {
			console.log('fail');
		}).always( function (params) {
		});
	}
});

</script>
