<!-- Filter pages -->
<div class="container-fluid bg-white py-2 h-100">
	<div class="container py-4">
		<form class="" method="GET" action="<?php echo site_url('/query') ?>">
			<div class="d-none d-md-flex justify-content-md-evenly align-items-md-center">
				<div class="col-2">
					<input type="search" name="query" class="form-control form-control-sm" placeholder="<?php echo $search_place ?>" onkeyup="" value="<?php echo !empty($query) ? $query : '' ?>">
				</div>
				<!-- <div class="col-2">
					<select class="form-select" name="categories">
						<option>Business</option>
						<?php foreach($business_categories as $value){
							echo "<option value=".$value->id.">$value->data_name</option>";
						} ?>
					</select>
				</div> -->
				<div class="col-3">
					<select class="form-select form-select-sm" name="business-country" id="selCountry_public" >
						<option value="">Select Country</option>
					</select>
					<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				</div>
				<div class="col-3">
					<select class="form-select form-select-sm" name="business-state" id="selState_public" disabled>
						<option value="">Select State</option>
					</select>
				</div>
				<div class="col-2">
					<select class="form-select form-select-sm" name="business-city" id="selCity_public" disabled>
						<option value="">Select City</option>
					</select>
				</div>
				<div class="col-1">
					<button type="submit" class="btn btn-danger d-flex align-items-center mx-auto">
						<span class="material-icons">search</span>
					</button>
				</div>
			</div>

			<div class="input-group d-inline-flex d-md-none align-items-xs-center">
				<input class="form-control py-2 rounded-pill-left me-1 pe-5 w-80" type="search" placeholder="search" name="qm" >
				<button class="btn btn-danger rounded-pill-right border-0 ms-n5 d-flex align-items-center" type="submit">
				<span class="material-icons">search</span>
				</button>
			</div>
		</form>

	</div>
</div>
