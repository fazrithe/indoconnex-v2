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

    var totalcases = <?php echo $totalcountry_cases ?>;
    var totaldeath = <?php echo $totalcountry_death ?>;
    var totalrecovered = <?php echo $totalcountry_recovered ?>;
    if(totalcases === 0 || totaldeath === 0){
        const api_url = 
        "https://api.covid19api.com/summary";
        
        fetch(api_url)
        .then((resp) => resp.json())
        .then(function(data) {
        document.getElementById('confirm-covid').innerHTML= (Math.round(data.Global.TotalConfirmed * 100) / 100).toLocaleString();
        document.getElementById('death-covid').innerHTML= (Math.round(data.Global.TotalDeaths * 100) / 100).toLocaleString();
        document.getElementById('recover-covid').innerHTML= (Math.round(data.Global.TotalRecovered * 100) / 100).toLocaleString();
        })
        .catch(function(error) {
        console.log(error);
        });
    }{
        document.getElementById('confirm-covid').innerHTML= (Math.round(totalcases * 100) / 100).toLocaleString();
        document.getElementById('death-covid').innerHTML= (Math.round(totaldeath * 100) / 100).toLocaleString();
        document.getElementById('recover-covid').innerHTML= (Math.round(totalrecovered * 100) / 100).toLocaleString();
    }
    var date = <?php echo json_encode($label_cases); ?>;
    var textName = "Total Coronavirus Cases";
    var africa = <?php echo json_encode($datacovid_cases); ?>;
        var ctx = document.getElementById("myChart-cases-covid");
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: date,
        datasets: [
          { 
            data: africa,
            label: "<?php if(!empty($country_name)){echo $country_name.' New Cases';}else{ echo "World New Cases";} ?>",
            borderColor: "#3e95cd",
            fill: false
          },
        ]
      }
    });

    var date = <?php echo json_encode($label_cases); ?>;
    var textName = "Total Coronavirus Death";
    var africa = <?php echo json_encode($datacovid_death); ?>;
        var ctx = document.getElementById("myChart-death-covid");
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: date,
        datasets: [
          { 
            data: africa,
            label: "<?php if(!empty($country_name)){echo $country_name.' New Death';}else{ echo "World New Death";} ?>",
            borderColor: "#c45850",
            fill: false
          },
        ]
      }
    });

    var date = <?php echo json_encode($label_cases); ?>;
    var textName = "Total Coronavirus Recovered";
    var africa = <?php echo json_encode($datacovid_recovered); ?>;
        var ctx = document.getElementById("myChart-recovered-covid");
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: date,
        datasets: [
          { 
            data: africa,
            label: "<?php if(!empty($country_name)){echo $country_name.' New Recovered';}else{ echo "World New Recovered";} ?>",
            borderColor: "#129c1d",
            fill: false
          },
        ]
      }
    });
});

</script>