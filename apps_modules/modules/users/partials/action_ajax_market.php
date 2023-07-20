<script>
$('#price-select').on('change', function () {
	switch (this.value) {
	case '0':
	case 0:
	case '1':
	case 1:
	case '4':
	case 4:
		$('#pricing').addClass('d-none');
		$('#price-num').addClass('d-none');
		$('#price-table').addClass('d-none');
		break;
	case '2':
	case 2:
	case '3':
	case 3:
		$('#pricing').removeClass('d-none');
		$('#price-num').removeClass('d-none');
		$('#price-table').addClass('d-none');
		break;
	case '5':
	case 5:
		$('#pricing').removeClass('d-none');
		$('#price-num').addClass('d-none');
		$('#price-table').removeClass('d-none');
		break;
	default:
		break;
	}
});

$('#price-num-price').on('blur', function () {
	// $number = $(this).val();
	// console.log($number);
	// $cur = $('#product-currency').val();
	// // lang code + country code
	// $(this).val(new Intl.NumberFormat('id-ID', {
	// 	// style: 'currency',
	// 	// currency: $cur
	// }).format($number));
});

$('#product-type').on('change', function (params) {
	$productType = this.value;
	if($productType == 'product') {
		$('#form-sku').removeClass('d-none');
		$('#form-lbl').removeClass('d-none');
	} else if ($productType == 'service') {
		$('#form-sku').addClass('d-none');
		$('#form-lbl').addClass('d-none');
	}
});

function formatNumber($number, $curr = 'USD') {
	return new Intl.NumberFormat(window.navigator.language, {
		style: 'currency',
		currency: $curr
	}).format($number);
}

$( ".toPrice" ).each(function( index ) {
	$type = $(this).data('type');
	if(parseInt($type) == 2){
		$price = $(this).data('low');
		$currency =$(this).data('currency');
		$(this).text(formatNumber($price, $currency));
	}
});

$('#product-detail').on('show.bs.modal', function (sender) {
	$productid = $(sender.relatedTarget).data('bs-productid');
	if($productid) {
		$.ajax({
			type  : 'GET',
			url   : '<?php echo site_url('market/show');?>/'+$productid,
		}).done( function ( response ) {
			$response = JSON.parse(response);
			// console.log($response);
			// console.log($response.email);
			$('#product-detail-img').attr('src', ''+$response.image);
			$('#product-detail-name').text($response.name);
			if (! $response.status) {
				$('#product-detail-status').css('display', 'none');
			} else {
				$('#product-detail-status').text($response.status + ' ');
			}
			$('#product-detail-cat').text($response.category.data_name);
			$('#product-detail-desc').text($response.description);
			$('#product-detail-email').text($response.email);
			$('#product-detail-phone').text($response.phone);

			//set default
			$('#product-detail-seller').text('-');
			$('#product-detail-seller').attr('href', '#');
			$('#btn-send-message-to-seller').attr('onclick', '');
			if($response.seller) {
				if (`${$response.seller.id}` == "<?php echo (string) $_SESSION['user_id']; ?>" || !`${$response.seller.id}`) {
					$('#btn-send-message-to-seller').css({'display':'none'});
				} else {
					$('#btn-send-message-to-seller').css({'display':'block'});
					$('#btn-send-message-to-seller').attr('onclick', `user_chat('${$response.seller.id}')`);
				}
				$('#product-detail-seller-img').parent('a').prop('href', "<?php echo base_url('business/post/') ?>"+$response.seller.data_username);
				$('#product-detail-seller').text($response.seller.name);
				$('#product-detail-seller').attr('href', "<?php echo base_url('business/post/') ?>"+$response.seller.data_username);
				$('#product-detail-seller-img').attr('src', $response.compimg);
			
			}
			$('#product-detail-location').text('-, -');
			if($response.location) {
				$loc = JSON.parse($response.location);
				$('#product-detail-location').text($loc[0].city_name+', '+$loc[0].country_name);
			}

			if($response.price.type) {
				if($response.price.type == 1) {
					$('#product-detail-price').text("");
					$('#product-detail-price').text('Free / Giveaway');
					$('#product-detail-table').addClass('d-none');
					$('#product-detail-price').removeClass('d-none');
				} else if($response.price.type == 2) {
					$('#product-detail-price').text("");
					$('#product-detail-price').data('currency', $response.price.currency);
					$('#product-detail-price').data('low', $response.price.low);
					$('#product-detail-price').text(formatNumber($response.price.low, $response.price.currency));
					$('#product-detail-table').addClass('d-none');
					$('#product-detail-price').removeClass('d-none');
				} else if($response.price.type == 3) {
					$('#product-detail-price').text("");
					$('#product-detail-price').data('currency', $response.price.currency);
					$('#product-detail-price').data('low', $response.price.low);
					$('#product-detail-price').data('high', $response.price.high);
					$('#product-detail-price').text('Starting at ' + formatNumber($response.price.low, $response.price.currency));
					$('#product-detail-table').addClass('d-none');
					$('#product-detail-price').removeClass('d-none');
				} else if($response.price.type == 4) {
					$('#product-detail-price').text("");
					$('#product-detail-price').text("Ask Price (Via Whatsapp/Email)");
					$('#product-detail-table').addClass('d-none');
					$('#product-detail-price').removeClass('d-none');
				} else if($response.price.type == 5) {
					$('#product-detail-price').addClass('d-none');
					$('#product-detail-table').removeClass('d-none');
					$.each($response.price.table, function (key, val) {
						$row = '<tr scope="row"><td>' + val.qty + '</td><td>' + val.price + '</td></tr>';
						$('#product-detail-table table tbody').append($row);
					})
				}
			}

		}).fail( function (params) {
			console.log('fail');
		}).always( function (params) {
		});
	}
});

$('#editProduct').click(function (sender) {
	$productId = $(this).data('itemid');

	// $('#editproductserviceModal').modal('show');
});

function deleteproduct($id){
	$('#items-id').val($id);
	$('#deleteproductserviceModal').modal('show');
}

function deleteproductbuy($id){
	$('#items-buy-id').val($id);
	$('#deleteproductbuyModal').modal('show');
}

function selectUserMarket(id){
	url = '<?php echo site_url();?>';
	if(id==1){
		window.location = url+"market/list";
	}else{
		window.location = url+"market/list_filter/"+ id;
	}
}

function selectUserBuy(id){
	url = '<?php echo site_url();?>';
	if(id==1){
		window.location = url+"buysells/list";
	}else{
		window.location = url+"buysells/list_filter/"+ id;
	}
}

function selectUserMarketmanage(id){
	url = '<?php echo site_url();?>';
	if(id==1){
		window.location = url+"market/manage";
	}else{
		window.location = url+"market/manage_filter/"+ id;
	}
}

$(document).ready(function(){
	var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
	var csrfHash = $(".txt_csrfname").val(); // CSRF hash

	$('.js-businessSelector').select2({
		templateResult: businessFormat,
		templateSelection: businessFormat,
		dropdownAutoWidth: true,
		width: '100%',
		theme: "business",
		placeholder: 'Search'
	});

    $('.js-labels').select2({
		theme: "bootstrap5",
        placeholder: '-Select Label-',
        ajax: {
            // url: '<?php echo base_url();?>user/setting/search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
		tags: true
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

	$('#product-type').select2({
		placeholder: 'Product Type',
        allowClear: true
	});

	$('#product-price').select2({
		placeholder: 'Product Price',
        allowClear: true
	});

	$('#product-currency').select2({
		placeholder: 'Currency',
        allowClear: true

	});
	$('#product-label').select2({
		placeholder: 'Label',
        allowClear: true
	});

	$('#product-location').select2({
		placeholder: 'Location',
        allowClear: true
	});

	$('#product-category').select2({
		placeholder: 'Product Category',
        allowClear: true
	});
});

function selectUser(id){
    user_id = $("#id").val();
    if(id == 1){
	    document.getElementById('select_user_id').value = user_id;
        document.getElementById('select_business_id').value = '';
    }else{
        document.getElementById('select_business_id').value = id;
        document.getElementById('select_user_id').value = '';
    }
}
</script>
