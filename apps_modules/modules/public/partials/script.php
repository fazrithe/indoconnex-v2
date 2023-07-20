

<!-- begin jquery extra -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- end jquery extra -->

<!-- START ADD ON / PLUGINS JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="<?php echo theme_user_locations(); ?>plugins/select2/dist/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="<?php echo theme_user_locations(); ?>plugins/equalize-height/src/jquery.equal-heights.js"></script>

<script src="<?php echo theme_user_locations(); ?>plugins/FitText/src/jquery.fittext.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.1/dist/sweetalert2.all.min.js"></script>

<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js" integrity="sha512-o0rWIsZigOfRAgBxl4puyd0t6YKzeAw9em/29Ag7lhCQfaaua/mDwnpE2PVzwqJ08N7/wqrgdjc2E0mwdSY2Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/3.0.0-beta.6/aos.js"></script>

<!-- begin plugin upload files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<!-- end plugin upload files -->

<!-- begin plugin Leaflet Js -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<!-- end plugin Leaflet Js -->

<!-- begin plugin copy text -->
<script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
<!-- end plugin copy text -->

<!-- begin plugin sly -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sly/1.6.1/sly.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<!-- end plugin sly -->

<!-- begin plugin chartjs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
<!-- end plugin chartjs -->

<!-- begin plugin counter -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.counterup@2.1.0/jquery.counterup.min.js"></script>
<!-- end plugin counter -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

<!-- Flag -->
<!-- <script src="//unpkg.com/bootstrap-select-country@4.0.0/dist/js/bootstrap-select-country.min.js"></script> -->
<script src="<?php echo theme_user_locations(); ?>js/countrySelect.js"></script>
<script>
    $("#country_selector, #countrySelector").countrySelect({
		preferredCountries: ['au', 'id', 'us']
	});

    $("#country_selector, #countrySelector").prop('readonly', 'readonly')
    var targetWidth = $(".country-select").width();
    $('.country-select .selected-flag').css("width", targetWidth);
    $('div.arrow').toggleClass('d-none');
</script>
<!-- END ADD ON / PLUGINS JS -->

<!-- begin basic js in local -->
<script src="<?php echo theme_user_locations(); ?>js/main.js"></script>
<script src="<?php echo theme_user_locations(); ?>js/main-form-validation.js"></script>
<script src="<?php echo theme_user_locations(); ?>js/main-chart.js"></script>
<script src="<?php echo theme_user_locations(); ?>js/main.min.js"></script>
<!-- end basic js in local -->

<!-- slick slide -->
<script src="<?php echo theme_user_locations(); ?>js/carousel.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
$(document).ready(function(){
	var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
	$("#selCountry").select2({
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

	$("#selState").select2();
	$("#selCity").select2();
	$('#selCountry').on('select2:select', function (){
		country_id = $("#selCountry").val();
		$("#selState").prop('disabled', false);

		$("#selState").select2({
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

});
</script>
<script>
	$(document).ready(function(){
	var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
	$("#selCountry_public").select2({
		ajax: {
			url: '<?php echo site_url('home/country');?>',
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

	$("#selState_public").select2();
	$("#selCity_public").select2();
	$('#selCountry_public').on('select2:select', function (){
		country_id = $("#selCountry_public").val();
		$("#selState_public").prop('disabled', false);

		$("#selState_public").select2({
			ajax: {
				url: '<?php echo site_url('home/state/');?>' + country_id,
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

	$('#selState_public').on('select2:select', function (){
		state_id = $("#selState_public").val();
		$("#selCity_public").prop('disabled', false);
		$("#selCity_public").select2({
			ajax: {
				url: '<?php echo site_url('home/city/');?>' + state_id,
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

	
});


	$.ajax({
		url: "https://geolocation-db.com/jsonp",
		jsonpCallback: "callback",
		dataType: "jsonp",
		success: function( location ) {
			weather(location.city);
			document.getElementById('city-name').innerHTML = location.city;
			document.getElementById('country-name').innerHTML = location.country_name;
		}
	});		
function weather(city){
const api_url = 
		"https://api.weatherapi.com/v1/current.json?key=7433957386ca40f887395321213012&q="+city+"&aqi=no";
        // "https://api.openweathermap.org/data/2.5/weather?q="+city+"&appid=c5e475d96e3198fb65ae19a77252259f";
        
        fetch(api_url)
        .then((resp) => resp.json())
        .then(function(data) {
        document.getElementById('clouds').innerHTML= (Math.round(data.current.temp_c * 100) / 100).toLocaleString();
		$('#clouds-img').attr('src', ''+data.current.condition.icon);
        })
        .catch(function(error) {
        console.log(error);
        });
}


</script>
<script>
    $(document).ready(function(){
      $(".wrapperanimate").delay(1000).fadeOut();
    })
</script>
