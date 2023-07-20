<div class="row">
	<div class="col-sm-12">
		<style>
			.select2-container--default .select2-selection--multiple .select2-selection__choice{
				background-color: #3c8dbc!important;
				border-color: #367fa9!important;
			}
			p {
				margin: 0;
			}
		</style>

		<div class="box box-solid">
			<div id="form-title-box" class="box-header  <?php echo ($template_title_module_action == 'add') ? 'bg-blue' : 'bg-info' ?> with-border">
				<h3 id="form-title" class="box-title form-title">
					<span id="form-title-icon"><i class="<?php echo ($template_title_module_action == 'add') ? 'fa fa-plus-circle' : 'fa fa-building-o' ?>"></i></span>
					<span id="form-title-action"><?php echo ucwords($template_title_module_action); ?></span> <?php echo $template_title_module; ?>
				</h3>
			</div>
			<form id="form-action" class="form-horizontal" method="post" action="<?php echo current_url(); ?>" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
				<input type="hidden" id="id" name="id" value=""/>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<div class="box-body">

					<div class="form-group">
						<?php
						$input_label       = 'Categories';
						$input_placeholder = $input_label;
						$input_id          = 'data_categories';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p id="<?php echo $input_id; ?>"></p>
<!--							<select id="--><?php //echo $input_id; ?><!--" name="--><?php //echo $input_name; ?><!--[]" multiple="multiple" class="form-control select2"></select>-->
						</div>
					</div>

					<div class="form-group">
						<?php
						$input_label       = 'Business Types';
						$input_placeholder = $input_label;
						$input_id          = 'data_types';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p id="<?php echo $input_id; ?>"></p>
						</div>
					</div>

					<div class="form-group">
						<?php
						$input_label       = 'Name';
						$input_placeholder = $input_label;
						$input_id          = 'data_name';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo ($input_value == '') ? '-' : $input_value; ?></p>
						</div>
					</div>
					<div class="form-group">
						<?php
						$input_label       = 'Username';
						$input_placeholder = $input_label;
						$input_id          = 'data_username';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo ($input_value == '') ? '-' : $input_value; ?></p>
						</div>
					</div>

					<div class="form-group">
						<?php
						$input_label       = 'Description';
						$input_placeholder = $input_label;
						$input_id          = 'data_description';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo ($input_value == '') ? '-' : $input_value; ?></p>
						</div>
					</div>

					<div class="form-group">
						<?php
						$input_label       = 'Facilities';
						$input_placeholder = $input_label;
						$input_id          = 'data_facilities';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p id="<?php echo $input_id; ?>"></p>
						</div>
					</div>

					<div class="form-group">
						<?php
						$input_label       = 'Registry Number';
						$input_placeholder = $input_label;
						$input_id          = 'bd_regnumber';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo ($input_value == '') ? '-' : $input_value; ?></p>
						</div>
					</div>
					<div class="form-group">
						<?php
						$input_label       = 'Email';
						$input_placeholder = $input_label;
						$input_id          = 'bd_email';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo ($input_value == '') ? '-' : $input_value; ?></p>
						</div>
					</div>
					<div class="form-group">
						<?php
						$input_label       = 'Phone';
						$input_placeholder = $input_label;
						$input_id          = 'bd_phone';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo ($input_value == '') ? '-' : $input_value; ?></p>
						</div>
					</div>


					<div class="form-group">
						<?php
						$input_label       = 'Country';
						$input_placeholder = $input_label;
						$input_id          = 'country_id';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p id="<?php echo $input_id; ?>"></p>
						</div>
					</div>

					<div class="form-group">
						<?php
						$input_label       = 'State';
						$input_placeholder = $input_label;
						$input_id          = 'state_id';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p id="<?php echo $input_id; ?>"></p>
						</div>
					</div>

					<div class="form-group">
						<?php
						$input_label       = 'City';
						$input_placeholder = $input_label;
						$input_id          = 'city_id';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p id="<?php echo $input_id; ?>"></p>
						</div>
					</div>

					<div class="form-group">
						<?php
						$input_label       = 'Address';
						$input_placeholder = $input_label;
						$input_id          = 'bd_address';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo ($input_value == '') ? '-' : $input_value; ?></p>
						</div>
					</div>
					<div class="form-group">
						<?php
						$input_label       = 'Google Maps Link';
						$input_placeholder = $input_label;
						$input_id          = 'bd_maps';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo ($input_value == '') ? '-' : $input_value; ?></p>
						</div>
					</div>

					<div class="form-group">
						<?php
						$input_label       = 'Postal Code';
						$input_placeholder = $input_label;
						$input_id          = 'bd_address_zipcode';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo ($input_value == '') ? '-' : $input_value; ?></p>
						</div>
					</div>

					<div class="form-group">
						<?php
						$input_label       = 'Hours Open';
						$input_placeholder = $input_label;
						$input_id          = 'bd_hours_open';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo ($input_value == '') ? '-' : $input_value; ?></p>
						</div>
					</div>
					<div class="form-group">
						<?php
						$input_label       = 'Working Hours';
						$input_placeholder = $input_label;
						$input_id          = 'bd_hours_work';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<?php
						$input_label       = 'Working Hours';
						$input_placeholder = $input_label;
						$input_name_column = 'bd_hours_work';
						$input_name        = "{$input_name_column}";
						$input_set_time    = array(
								'00:00',
								'01:00',
								'01:30',
								'02:00',
								'02:30',
								'03:00',
								'03:30',
								'04:30',
								'05:00',
								'05:30',
								'06:00',
								'06:30',
								'07:00',
								'07:30',
								'08:00',
								'08:30',
								'09:00',
								'09:30',
								'10:00',
								'10:30',
								'11:00',
								'11:30',
								'12:00',
								'12:30',
								'13:00',
								'13:30',
								'14:00',
								'14:30',
								'15:00',
								'15:30',
								'16:00',
								'16:30',
								'17:00',
								'17:30',
								'18:00',
								'18:30',
								'19:00',
								'19:30',
								'20:00',
								'20:30',
								'21:00',
								'21:30',
								'22:00',
								'22:30',
								'23:00',
								'23:30',
						);
						$input_value       = '';
						$input_value_1     = '';
						$input_value_2     = '';
						$input_value_3     = '';
						if (!empty($output_result)) {
							if (!empty($output_result[$input_name_column])) {

								$input_name_column_set_1 = "status";
								$input_name_column_set_2 = "start";
								$input_name_column_set_3 = "end";
								$input_value_decode1     = (array)json_decode($output_result[$input_name_column]);
								/*
								$input_value_1 = (!empty($input_value_decode[$input_name_column]->$input_name_column_set_1)) ? $input_value_decode[$input_name_column]->$input_name_column_set_1 : '';
								$input_value_2 = (!empty($input_value_decode[$input_name_column]->$input_name_column_set_2)) ? $input_value_decode[$input_name_column]->$input_name_column_set_2 : '';
								$input_value_3 = (!empty($input_value_decode[$input_name_column]->$input_name_column_set_3)) ? $input_value_decode[$input_name_column]->$input_name_column_set_3 : '';
								*/
							}
						}
						if (!empty($input_value_decode1)) {
							foreach ($input_value_decode1 as $key => $val) {
								$input_value_en = json_encode($val);
							}

							$input_value_decode = (array)json_decode($input_value_en);
						}
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">

							<div class="content-hour">

								<?php for ($i = 1; $i <= 7; $i++) { ?>
									<?php
									$input_name_date_day                      = format_date_day($i);
									$input_name_column_1                      = "{$input_name_column}[{$input_name_date_day}][status]";
									$input_name_column_2                      = "{$input_name_column}[{$input_name_date_day}][start]";
									$input_name_column_3                      = "{$input_name_column}[{$input_name_date_day}][end]";
									$input_value_decode[$input_name_date_day] = (!empty($input_value_decode[$input_name_date_day])) ? (array)$input_value_decode[$input_name_date_day] : array();
									$input_value_1                            = (!empty($input_value_decode[$input_name_date_day])) ? 'open' : 'close';
									$input_value_2                            = (!empty($input_value_decode[$input_name_date_day]['start'])) ? $input_value_decode[$input_name_date_day]['start'] : '';
									$input_value_3                            = (!empty($input_value_decode[$input_name_date_day]['end'])) ? $input_value_decode[$input_name_date_day]['end'] : '';
									?>
									<div class="">
										<div class="row">
											<div class="col-md-4">
												<div class="row">
													<div class="col-md-4">
														<p style="margin-top: 5px;"><?php echo $input_name_date_day; ?></p>
													</div>
													<div class="col-md-8">
														<select disabled="disabled" name="<?php echo $input_name_column_1; ?>" class="form-control">
															<option value="close"<?php echo (!empty($output_result)) ? (($input_value_1 == 'close') ? ' selected' : '') : ''; ?>>Close</option>
															<option value="open"<?php echo (!empty($output_result)) ? (($input_value_1 == 'open') ? ' selected' : '') : ''; ?>>Open</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<select disabled="disabled" name="<?php echo $input_name_column_2; ?>" class="form-control select2">
													<option value="">--Choose--</option>
													<option value="all"<?php echo ((!empty($input_value_2)) && ($input_value_2 == 'all')) ? ' selected' : ''; ?>>24 Hours</option>
													<?php foreach ($input_set_time as $index => $row) { ?>
														<option value="<?php echo $row; ?>"<?php echo (!empty($output_result)) ? (($input_value_2 == $row) ? ' selected' : '') : ''; ?>><?php echo $row; ?></option>
													<?php } ?>
												</select>
											</div>
											<div class="col-md-4">
												<select disabled="disabled" name="<?php echo $input_name_column_3; ?>" class="form-control select2">
													<option value="">--Choose--</option>
													<option value="all"<?php echo ((!empty($input_value_3)) && ($input_value_3 == 'all')) ? ' selected' : ''; ?>>24 Hours</option>
													<?php foreach ($input_set_time as $index => $row) { ?>
														<option value="<?php echo $row; ?>"<?php echo (!empty($output_result)) ? (($input_value_3 == $row) ? ' selected' : '') : ''; ?>><?php echo $row; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>


					<!--<div class="form-group">-->
					<!----><?php
					//	$input_label       = 'Hours Work';
					//	$input_placeholder = $input_label;
					//	$input_id          = 'bd_hours_work';
					//	$input_name        = $input_id;
					//	$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
					//	?>
					<!--  <label for="--><?php //echo $input_id; ?><!--" class="col-sm-3 control-label text-left">--><?php //echo $input_label; ?><!--</label>-->
					<!--  <div class="col-sm-9">-->
					<!--  <input type="text" name="--><?php //echo $input_name; ?><!--" class="form-control" id="--><?php //echo $input_id; ?><!--" value="--><?php //echo $input_value; ?><!--" autocomplete="off" placeholder="--><?php //echo $input_placeholder; ?><!--"/>-->
					<!--  </div>-->
					<!--  </div>-->

					<div class="form-group">
						<?php
						$input_label       = 'Payment Method';
						$input_placeholder = $input_label;
						$input_id          = 'bd_paymentmethod';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo ($input_value == '') ? '-' : $input_value; ?></p>
						</div>
					</div>


					<div class="form-group">
						<?php
						$input_label       = 'Number of Team';
						$input_placeholder = $input_label;
						$input_id          = 'bd_team_number';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';

						$input_value_set = [
								['id' => '', 'text' => 'Not set'],
								['id' => 0, 'text' => 'Self-Employeed'],
								['id' => 1, 'text' => '1-10 Employees'],
								['id' => 2, 'text' => '11-50 Employees'],
								['id' => 3, 'text' => '51-200 Employees'],
								['id' => 4, 'text' => '201-500 Employees'],
								['id' => 5, 'text' => '501-1000 Employees'],
								['id' => 6, 'text' => '1001-5000 Employees'],
								['id' => 7, 'text' => '5001-10000 Employees'],
								['id' => 8, 'text' => '10001+ Employees'],
						];
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo select_data_element_show($input_value_set, $output_result, $input_label, $input_name); ?></p>
						</div>
					</div>

					<div class="form-group">
						<?php
						$input_label       = 'Annual Sales';
						$input_placeholder = $input_label;
						$input_id          = 'bd_annual_sales';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo ($input_value == '') ? '-' : $input_value; ?></p>
						</div>
					</div>
					<div class="form-group">
						<?php
						$input_label       = 'Established Year';
						$input_placeholder = $input_label;
						$input_id          = 'bd_established_year';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo ($input_value == '') ? '-' : $input_value; ?></p>
						</div>
					</div>
					<div class="form-group">
						<?php
						$input_label       = 'Established Date';
						$input_placeholder = $input_label;
						$input_id          = 'bd_established_date';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo ($input_value == '') ? '-' : $input_value; ?></p>
						</div>
					</div>
					<div class="form-group">
						<?php
						$input_label       = 'Main Markets';
						$input_placeholder = $input_label;
						$input_id          = 'bd_main_markets';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo ($input_value == '') ? '-' : $input_value; ?></p>
						</div>
					</div>


					<div id="div-contact-info">

						<div class="form-group">
							<?php
							$input_label       = 'E-mail';
							$input_placeholder = $input_label;
							$input_id_label    = 'data_business_contact_email';
							$input_id          = 'data_business_contact';
							$input_id_index    = 'email';
							$input_name        = "{$input_id}[{$input_id_index}][]";
							$input_name_value  = 'data_contact_info';
							$input_value       = (!empty($output_result[$input_name_value])) ? $output_result[$input_name_value] : '';
							if (!empty($input_value)) {
								$input_value = (array)json_decode($input_value);
								$input_value = (!empty($input_value[$input_id_index])) ? (array)$input_value[$input_id_index] : array();
							}
							?>
							<label for="<?php echo $input_id_label; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
							<div class="col-sm-9">
								<?php for ($i = 0; $i < 3; $i++) { ?>
									<?php $input_value_array_value = (!empty($input_value[$i])) ? $input_value[$i] : ''; ?>
									<div class="mb-3">
										<p><?php echo ($input_value_array_value == '') ? '-' : $input_value_array_value; ?></p>
									</div>
								<?php } ?>
							</div>
						</div>

						<div class="form-group">
							<?php
							$input_label       = 'Phone Number';
							$input_placeholder = $input_label;
							$input_id_label    = 'data_business_contact_phone';
							$input_id          = 'data_business_contact';
							$input_id_index    = 'phone';
							$input_name        = "{$input_id}[{$input_id_index}][]";
							$input_name_value  = 'data_contact_info';
							$input_value       = (!empty($output_result[$input_name_value])) ? $output_result[$input_name_value] : '';
							if (!empty($input_value)) {
								$input_value = (array)json_decode($input_value);
								$input_value = (!empty($input_value[$input_id_index])) ? (array)$input_value[$input_id_index] : array();
							}
							?>
							<label for="<?php echo $input_id_label; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
							<div class="col-sm-9">
								<?php for ($i = 0; $i < 3; $i++) { ?>
									<?php $input_value_array_value = (!empty($input_value[$i])) ? $input_value[$i] : ''; ?>
									<div class="mb-3">
										<p><?php echo ($input_value_array_value == '') ? '-' : $input_value_array_value; ?></p>
									</div>
								<?php } ?>
							</div>
						</div>

					</div>

					<div class="form-group">
						<?php
						$input_label       = 'Date Active';
						$input_placeholder = $input_label;
						$input_id          = 'published';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo ($input_value == '') ? '-' : $input_value; ?></p>
						</div>
					</div>
					<div class="form-group">
						<?php
						$input_label       = 'Status';
						$input_placeholder = $input_label;
						$input_id          = 'status';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						$input_value_set   = [
								['id' => 0, 'text' => 'Not Active'],
								['id' => 1, 'text' => 'Active'],
						];
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<p><?php echo select_data_element_show($input_value_set, $output_result, $input_label, $input_name); ?></p>
						</div>
					</div>
					<div class="form-group">
						<?php
						$input_label       = 'Featured Image';
						$input_placeholder = $input_label;
						$input_id          = 'files';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<div class="row">
								<div class="col-sm-8">
									<div class="image-set">
										<?php $image_set = 1; ?>

										<?php for ($i = 1; $i <= $image_set; $i++) { ?>

											<?php
											$url_img_notfound = DEFAULT_IMAGE_NOT_FOUND;
											$url_img          = DEFAULT_IMAGE_NOT_FOUND;
											$file_mode        = 'fileinput-new';
											$file_id          = '';

											if (!empty($output_result)) {
												$url_img = ($output_result['file_path'] . $output_result['file_name_original']);
												if (!file_exists($url_img)) {
													$file_mode = 'fileinput-new';
													$url_img   = DEFAULT_IMAGE_NOT_FOUND;
												} else {
													$file_mode = 'fileinput-exists';
													$url_img   = base_url($url_img);
												}
												$file_id = $output_result['id'];
											}
											?>

											<?php echo ($i % 12 == 1) ? '<div class="row">' : ''; ?>

											<div class="col-sm-12">
												<img src="<?php echo $url_img; ?>" style="max-width: 200px"/>
											</div>

											<?php echo ($i % 12 == 0) ? '</div>' : ''; ?>

										<?php } ?>

										<?php echo ($image_set % 12 != 0) ? '</div>' : ''; ?>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<?php
						$input_label       = 'Cover Image';
						$input_placeholder = $input_label;
						$input_id          = 'cover';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
						<label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
						<div class="col-sm-9">
							<div class="row">
								<div class="col-sm-12">
									<div class="image-set">
										<?php $image_set = 1; ?>

										<?php for ($i = 1; $i <= $image_set; $i++) { ?>

											<?php
											$url_img_notfound = DEFAULT_IMAGE_NOT_FOUND;
											$url_img          = DEFAULT_IMAGE_NOT_FOUND;
											$file_mode        = 'fileinput-new';
											$file_id          = '';

											if (!empty($output_result)) {
												$url_img = ($output_result['cover_file_path'] . $output_result['cover_file_name_original']);
												if (!file_exists($url_img)) {
													$file_mode = 'fileinput-new';
													$url_img   = DEFAULT_IMAGE_NOT_FOUND;
												} else {
													$file_mode = 'fileinput-exists';
													$url_img   = base_url($url_img);
												}
												$file_id = $output_result['id'];
											}
											?>


											<?php echo ($i % 12 == 1) ? '<div class="row">' : ''; ?>

											<div class="col-sm-12">
												<img src="<?php echo $url_img; ?>" style="max-width: 200px"/>
											</div>

											<?php echo ($i % 12 == 0) ? '</div>' : ''; ?>

										<?php } ?>

										<?php echo ($image_set % 12 != 0) ? '</div>' : ''; ?>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="box-footer bg-gray">
					<a href="<?php echo base_url("mod_pbd_business/edit/{$this->uri->segment(3)}") ?>" class="btn btn-flat btn-warning"><i class="fa fa-pencil"></i> Edit</a>
					<button type="button" onclick="window.history.back()" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> Back</button>
				</div>
			</form>
		</div>

	</div>
</div>

