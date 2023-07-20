<script>
$(document).ready(function(){
	var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
	$("#selCountry").select2({
		theme: "bootstrap5",
		ajax: {
			url: '<?php echo site_url('api/country');?>',
			type: "post",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					searchTerm: params.term, // search term
					[csrfName]: csrfHash
				};
			},
			processResults: function (response) {
				$(".txt_csrfname").val(response.token);
				return {
					results: response.response
				};
			},
			cache: true
		}
	});

	$('#selCountry').on('select2:select', function (){
		country_id = $("#selCountry").val();
		$("#selState").prop('disabled', false);

		$("#selState").select2({
			theme: "bootstrap5",
			ajax: {
				url: '<?php echo site_url('api/state/');?>' + country_id,
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term,
						[csrfName]: csrfHash
					};
				},
				processResults: function(response) {
					$(".txt_csrfname").val(response.token);
					return {
						results: response.response
					};
				},
				cache: true
			}
		});
	});

	$('#selState').on('select2:select', function (){
		state_id = $("#selState").val();
		$("#selCity").prop('disabled', false);
		$("#selCity").select2({
			theme: "bootstrap5",
			ajax: {
				url: '<?php echo site_url('api/city/');?>' + state_id,
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term,
						[csrfName]: csrfHash
					};
				},
				processResults: function(response) {
					$(".txt_csrfname").val(response.token);
					return {
						results: response.response
					};
				},
				cache: true
			}
		});
	});

	$('.js-businessSelector').select2({
		templateResult: businessFormat,
		templateSelection: businessFormat,
		dropdownAutoWidth: true,
		width: '100%',
		theme: "business",
		placeholder: 'Search'
	});

	function businessFormat(option){
		if (!option.id) {
			return option.text;
		}
		var optimage = $(option.element).data('image');
		if(!optimage){
			return option.text;
		} else {
			var $option = $(
				'<span><img src="' + optimage + '" width="23px" class="me-auto img-circle" /> ' + option.text + '</span>'
			);
		return $option;
		}
	}
	var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
	var country  = $("#selCountry_edit").val();
	$("#selCountry_edit").select2({
	ajax: {
		url: '<?php echo site_url('api/country');?>',
		type: "post",
		dataType: 'json',
		delay: 250,
		data: function (params) {
			return {
			searchTerm: params.term, // search term
			[csrfName]: csrfHash
			};
		},
		processResults: function (response) {
			$(".txt_csrfname").val(response.token);
			$("#selCountry").val(response.response);
			if(response.country_id){
				selCountry(response.country_id);
			}else{
				selCountry(country);
			}

			return {
			results: response.response
			};
		},
		cache: true
	}
	});

	$('#job-type').select2({
		placeholder: 'Select Job Type',
        allowClear: true
	});

	$('#job-category').select2({
		placeholder: 'Job Category',
        allowClear: true
	});

	$('#job-location').select2({
		placeholder: 'Country',
        allowClear: true
	
	});
	$('#job-location').select2({
		placeholder: 'Country',
        allowClear: true
	});

});

function deletejob($id){
		$('#job-id').val($id);
		$('#deletejobModal').modal('show');
	}

function selectUserjobs(id){
    user_id = $("#id").val();
    if(id == 1){
	    document.getElementById('select_user_id').value = user_id;
        document.getElementById('select_business_id_jobs').value = '';
    }else{
        document.getElementById('select_business_id_jobs').value = id;
        document.getElementById('select_user_id').value = '';
    }
}


function selectFilterjobs(id){
	url = '<?php echo site_url();?>';
	if(id==1){
		window.location = url+"jobs/list";
	}else{
		window.location = url+"jobs/list_filter/"+ id;
	}
}

function selectFilterjobs_applicant(id){
	url = '<?php echo site_url();?>';
	if(id==1){
		window.location = url+"jobs/applicant";
	}else{
		window.location = url+"jobs/applicant_filter/"+ id;
	}
}
</script>
