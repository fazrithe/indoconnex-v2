
               <!-- HEADER -->
<div class="bg-image d-flex hero-guest mt-1" id="banner-public">
    <div class="col-md-12">
      <div class="p-5 text-white" style="    background-image:
      linear-gradient(to bottom, rgba(0, 0, 0, 0.52), rgba(49, 49, 49, 0.73)),
      url('<?php echo site_url('public/themes/public/images/covid-19-banner.jpg') ?>');
     -webkit-background-size: cover;
      -moz-background-size: cover;
      background-size: cover;
      -o-background-size: cover;">
      <div class="p-4">
        <span class="align-middle" style="text-align: center;">
          <h2>Covid-19 Cases</h2>
        </span>
      </div>
      </div>
    </div>
</div>

   <!-- BODY -->


    <!-- SECTION - Discover Massage Business  Page -->
      <div class="container">
        <div class="d-flex align-items-center mb-4">
            <div><h2 class="mt-4 title-dark">Covid-19 Cases</h2>
            </div>
            <div class="ms-auto">
                <div class="dropdown">
								<?php  if(!empty($this->session->userdata('is_login') == FALSE)){ ?>
                    <a href="<?php echo site_url('public/covid/world') ?>" style="color:#EE0202 ;">View all</a>
                <?php }else{ ?>
									<a href="<?php echo site_url('covid/world') ?>" style="color:#EE0202 ;">View all</a>
								<?php } ?>
								</div>
            </div>
        </div>

      <!-- Covid Data - Indonesia -->
        <div class="row mt-4">
            <div class="col-6" id="indonesiaCovidData">
                <div id="covid-box" class=" p-4 rounded-3 bg-white">
                    <div class="d-flex align-items-center mb-4">
                        <div>
                            <img src="<?php echo site_url('public/themes/public/images/indonesiaflag.png') ?>" class="rounded" style="object-fit: cover;" alt="user-profile-picture" width="40" height="40">
                        </div>
                        <div class="ms-4">
                            <b style="color: #00355E;">Indonesia</b><img src="<?php echo site_url('public/themes/public/images/verified.png') ?>"><br>
                            <small style="color: #6c6c6c;"><p class="mb-4">Last Update: <?php $tgl1 = date("M d, Y ");
$tgl2 = date('M d, Y', strtotime('-1 days', strtotime($tgl1))); 
echo $tgl2;  ?></p></small><br>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
										<div class="covidDescriptions "> 
                            <p>Total Cases.</p>
                            <h3><?php echo number_format($datacovid_cases_indo); ?></h3>
                        </div>
                        <div class="covidDescriptions mx-4"> 
                            <p>Total Deaths</p>
                            <h3><?php echo number_format($datacovid_death_indo); ?></h3>

                        </div>
                        <div class="covidDescriptions mx-4"> 
                            <p>Total Recovered</p>
                            <h3><?php echo number_format($datacovid_recovered_indo); ?></h3>

                        </div>
                    </div>  
                </div>

            </div>
            <div class="col-6" id="AustraliaCovidData">
                <div id="covid-box" class=" p-4 rounded-3 bg-white">
                    <div class="d-flex align-items-center mb-4">
                        <div>
                            <img src="<?php echo site_url('public/themes/public/images/australiacovid-data.png') ?>" class="rounded" style="object-fit: cover;" alt="user-profile-picture" width="40" height="40">
                        </div>
                        <div class="ms-4">
                            <b style="color: #00355E;">Australia</b><img src="<?php echo site_url('public/themes/public/images/verified.png') ?>"><br>
                            <small style="color: #6c6c6c;"><p class="mb-4">Last Update: <?php $tgl1 = date("M d, Y ");
$tgl2 = date('M d, Y', strtotime('-1 days', strtotime($tgl1))); 
echo $tgl2;  ?></p></small><br>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
										<div class="covidDescriptions "> 
                            <p>Total Cases.</p>
                            <h3><?php echo number_format($datacovid_cases_usa); ?></h3>
                        </div>
                        <div class="covidDescriptions mx-4"> 
                            <p>Total Deaths</p>
                            <h3><?php echo number_format($datacovid_death_usa); ?></h3>

                        </div>
                        <div class="covidDescriptions mx-4"> 
                            <p>Total Recovered</p>
                            <h3><?php echo number_format($datacovid_recovered_usa); ?></h3>

                        </div>
                    </div>  
                </div>

            </div>

            <div class="col-6" id="WorldCovidData">
                <div id="covid-box" class=" p-4 rounded-3 bg-white">
                    <div class="d-flex align-items-center mb-4">
                        <div>
                            <img src="<?php echo site_url('public/themes/public/images/covid-19-article_.png') ?>" class="rounded" style="object-fit: cover;" alt="user-profile-picture" width="40" height="40">
                        </div>
                        <div class="ms-4">
                            <b style="color: #00355E;">World</b><img src="<?php echo site_url('public/themes/public/images/verified.png') ?>"><br>
                            <small style="color: #6c6c6c;"><p class="mb-4">Last Update: <?php $tgl1 = date("M d, Y ");
$tgl2 = date('M d, Y', strtotime('-1 days', strtotime($tgl1))); 
echo $tgl2;  ?></p></small><br>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="covidDescriptions "> 
                            <p>Total Cases.</p>
                            <h3><div id="confirm-covid"></div></h3>
                        </div>
                        <div class="covidDescriptions mx-4"> 
                            <p>Total Deaths</p>
                            <h3><div id="death-covid"></div></h3>

                        </div>
                        <div class="covidDescriptions mx-4"> 
                            <p>Total Recovered</p>
                            <h3><div id="recover-covid"></div></h3>

                        </div>
                    </div>  
                </div>

            </div>
            <div class="col-md-6">
                <div class="p-5 text-white bg-dark rounded-3" style="background-image:
                linear-gradient(to bottom, rgba(0, 0, 0, 0.52), rgba(49, 49, 49, 0.73)),
                url('<?php echo site_url('public/themes/public/images/bg-covid19.png') ?>');
               -webkit-background-size: cover;
                -moz-background-size: cover;
                background-size: cover;
                -o-background-size: cover;">
                <div class="mx-auto">
                  <span class="align-middle">
                    <h2 style="text-align: center;">See more about Covid-19 information</h2>
                  </span>
                </div>
                </div>
              </div>

        </div> 

      </div>
 <?php $this->load->view($template['partial_how_works']); ?>
<?php $this->load->view($template['partial_partners']); ?>
<?php $this->load->view($template['partial_ajax_public']); ?>

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
