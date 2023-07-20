<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_covid_public']); ?>

<!-- Page Content  -->
<div class="row">
		<div class="col-11 col-md-7 mx-auto px-0">
				<div class="pt-4 mr-0 bg-indoconnex" >
						<div class="d-flex align-items-center mb-4">
								<div>
										<h4 class="mt-4 title-dark">World</h4>
										<p class="mb-4">Last Update: <?php $tgl1 = date("M d, Y ");
$tgl2 = date('M d, Y', strtotime('-1 days', strtotime($tgl1))); 
echo $tgl2;  ?></p>
								</div>
						</div>
						<div class="row mt-1">
					<div class="col-6 col-xs-4 col-md-4">
						<div class="card border-light mb-3">
							<div class="card-header"><h5>Coronavirus Cases</h5></div>
							<div class="card-body text-dark bg-transparent">
								<p class="card-text p-4 link-info fw-bold bg-light fs-24 text-right" id="confirm-covid"></p>
							</div>
						</div>
					</div>
					<div class="col-6 col-xs-4 col-md-4">
						<div class="card border-light mb-3">
							<div class="card-header"><h4>Deaths</h4></div>
							<div class="card-body text-dark bg-transparent">
								<p class="card-text p-4 link-danger fw-bold bg-light fs-24 text-right" id="death-covid" ></p>
							</div>
						</div>
					</div>
					<div class="col-6 col-xs-4 col-md-4">
						<div class="card border-light mb-3">
							<div class="card-header"><h4>Recovered</h4></div>
							<div class="card-body text-dark bg-transparent">
								<p class="card-text p-4 link-success fw-bold bg-light fs-24 text-right" id="recover-covid"></p>
							</div>
						</div>
					</div>
				<!-- Corona Virus Charts-->
				<div class="col-12 col-xs-12 col-md-12">
					<div>
						<div class="card-header p-4 bg-light"><h4 style="color: #0dbaff;">Total Cases</h4></div>
						<canvas class="p-4 bg-white" id="myChart-cases-covid" width="1600" height="900"></canvas>
					</div>
					</div>
					<div>
						<div class="card-header p-4 bg-light"><h4 style="color: #bd1313;">Total Death</h4></div>
						<canvas class="p-4 bg-white" id="myChart-death-covid" width="1600" height="900"></canvas>
					</div>
					</div>
					<div>
						<div class="card-header p-4 bg-light"><h4 style="color: #129c1d;">Total Recovered</h4></div>
						<canvas class="p-4 bg-white" id="myChart-recovered-covid" width="1600" height="900"></canvas>
					</div>
				</div>
			</div>

				</div>
		</div>
</div>
<div class="modal fade" id="modal_country_covid" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
							<h5 class="modal-title" id="Lable">Select Country</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
							<form action="<?php echo base_url('public/covid/country') ?>" method="post" role="form" enctype="multipart/form-data">
								<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
								<div class="form-group">
									<select class="form-select form-select-sm" name="country">
												<option value="">Select Country</option>
												<?php foreach($country as $val){
													echo '<option value="'.$val->name.'">'.$val->name.'</option>';
												}
												?>
									</select>
								</div>
								<div class="modal-footer border-top">
										<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
										<button class="btn btn-danger">Send</button>
								</div>
							</form>
					</div>
				</div>
		</div>
</div>
<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_covid']); ?>
<script src="<?php echo theme_user_locations(); ?>js/chart/Chart.min.js"></script>
