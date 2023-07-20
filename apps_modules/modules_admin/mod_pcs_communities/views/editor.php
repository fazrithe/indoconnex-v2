<div class="row">
    <div class="col-sm-8 col-sm-offset-2">

        <div class="box box-solid">
            <div id="form-title-box"
                 class="box-header                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php echo ($template_title_module_action == 'add') ? 'bg-blue' : 'bg-orange' ?> with-border">
                <h3 id="form-title" class="box-title form-title">
                    <span id="form-title-icon"><i class="<?php echo ($template_title_module_action == 'add') ? 'fa fa-plus-circle' : 'fa fa-edit' ?>"></i></span>
                    <span id="form-title-action"><?php echo ucwords($template_title_module_action); ?></span> <?php echo $template_title_module; ?>
                </h3>
            </div>
            <form id="form-action" class="form-horizontal" method="post" action="<?php echo current_url(); ?>" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
                <input type="hidden" id="id" name="id" value="<?php echo (!empty($output_result['id'])) ? $output_result['id'] : ''; ?>"/>
                <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                <div class="box-body">


                    <!--                    <div class="form-group">
                        <?php
					//                            $input_label       = 'Ordering/Position';
					//                            $input_placeholder = $input_label;
					//                            $input_id          = 'data_position';
					//                            $input_name        = $input_id;
					//                            $input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : $data_default_ordering;
					?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="<?php echo $input_name; ?>" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>" />
                        </div>
                    </div>-->

                    <div class="form-group">
						<?php
						$input_label       = 'Users';
						$input_placeholder = $input_label;
						$input_id          = 'users_id';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <select id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control select2" data-validation="required"></select>
                        </div>
                    </div>

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
                            <select id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>[]" multiple="multiple" class="form-control select2"></select>
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
                            <input type="text" name="<?php echo $input_name; ?>" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
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
                            <textarea id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control" placeholder="<?php echo $input_placeholder; ?>" autocomplete="off"><?php echo $input_value; ?></textarea>
                        </div>
                    </div>

                    <div id="div-contact-info">

                        <div class="form-group">
							<?php
							$input_label       = 'E-mail';
							$input_placeholder = $input_label;
							$input_id_label    = 'data_community_contact_email';
							$input_id          = 'data_community_contact';
							$input_id_index    = 'email';
							$input_name        = "{$input_id}[{$input_id_index}][]";
							$input_name_value  = 'data_contact_info';
							$input_value       = (!empty($output_result[$input_name_value])) ? $output_result[$input_name_value] : '';
							if (!empty($input_value)) {
								$input_value = (array) json_decode($input_value);
								$input_value = (!empty($input_value[$input_id_index])) ? (array) $input_value[$input_id_index] : array();
							}
							?>
                            <label for="<?php echo $input_id_label; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                            <div class="col-sm-9">
								<?php for ($i = 0; $i < 3; $i++) { ?>
									<?php $input_value_array_value = (!empty($input_value[$i])) ? $input_value[$i] : ''; ?>
                                    <div class="mb-3">
                                        <input type="text" name="<?php echo $input_name; ?>" class="form-control" value="<?php echo $input_value_array_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                                    </div>
								<?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
							<?php
							$input_label       = 'Phone Number';
							$input_placeholder = $input_label;
							$input_id_label    = 'data_community_contact_phone';
							$input_id          = 'data_community_contact';
							$input_id_index    = 'phone';
							$input_name        = "{$input_id}[{$input_id_index}][]";
							$input_name_value  = 'data_contact_info';
							$input_value       = (!empty($output_result[$input_name_value])) ? $output_result[$input_name_value] : '';
							if (!empty($input_value)) {
								$input_value = (array) json_decode($input_value);
								$input_value = (!empty($input_value[$input_id_index])) ? (array) $input_value[$input_id_index] : array();
							}
							?>
                            <label for="<?php echo $input_id_label; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                            <div class="col-sm-9">
								<?php for ($i = 0; $i < 3; $i++) { ?>
									<?php $input_value_array_value = (!empty($input_value[$i])) ? $input_value[$i] : ''; ?>
                                    <div class="mb-3">
                                        <input type="text" name="<?php echo $input_name; ?>" class="form-control" value="<?php echo $input_value_array_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                                    </div>
								<?php } ?>
                            </div>
                        </div>

                    </div>

                    <div id="div-contact-social">
						<?php $data_set_social_link = array('facebook', 'linkedin', 'instagram'); ?>
						<?php foreach ($data_set_social_link as $index => $row) { ?>

                            <div class="form-group">
								<?php
								$input_label       = 'Social - ' . ucfirst($row);
								$input_placeholder = $input_label;
								$input_id_label    = "data_social_links_{$row}";
								$input_id          = 'data_social_links';
								$input_name        = "{$input_id}[{$row}]";
								$input_name_value  = $input_id;
								$input_value       = (!empty($output_result[$input_name_value])) ? $output_result[$input_name_value] : '';
								if (!empty($input_value)) {
									$input_value = (array) json_decode($input_value);
									$input_value = (!empty($input_value[0])) ? (array) $input_value[0] : array();
									$input_value = (!empty($input_value[$row])) ? $input_value[$row] : '';
								}
								?>
                                <label for="<?php echo $input_id_label; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                                <div class="col-sm-9">
                                    <input type="text" name="<?php echo $input_name; ?>" class="form-control" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                                </div>
                            </div>

						<?php } ?>

                    </div>

                    <div id="div-contact-website">

                        <div class="form-group">
							<?php
							$input_label       = 'Website';
							$input_placeholder = $input_label;
							$input_id_label    = "data_social_links";
							?>
                            <label for="<?php echo $input_id_label; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                            <div class="col-sm-9">
								<?php for ($i = 0; $i < 3; $i++) { ?>
									<?php
									$input_label       = 'Website';
									$input_placeholder = $input_label;
									$input_id_label    = "data_social_links_{$i}";
									$input_id          = 'data_contact_website';
									$input_name        = "{$input_id}[{$i}][website]";
									$input_name_value  = $input_id;
									$input_value       = (!empty($output_result[$input_name_value])) ? $output_result[$input_name_value] : '';
									if (!empty($input_value)) {
										$input_value = (array) json_decode($input_value);
										$input_value = (!empty(($input_value[$i]))) ? (array) ($input_value[$i]) : array();
										$input_value = (!empty($input_value['website'])) ? $input_value['website'] : '';
									}
									?>
                                    <div class="mb-3">
                                        <input type="text" name="<?php echo $input_name; ?>" class="form-control" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
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
                            <input type="text" name="<?php echo $input_name; ?>" class="form-control datetimepicker" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" placeholder="<?php echo $input_placeholder; ?>"/>
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
						]
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <select id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control select2">
								<?php echo select_dropdown_generate_option($input_value_set, $input_value, $input_label, $input_name); ?>
                            </select>
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
                                <div class="col-sm-4">
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
                                                <div class="fileinput                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php echo $file_mode; ?>"
                                                     data-provides="fileinput" style="width: 100%;">
                                                    <div class="fileinput-new thumbnail ratio ratio1-1">
                                                        <img src="<?php echo $url_img_notfound; ?>" alt="" class="img-responsive"/>
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail ratio ratio1-1">
                                                        <img src="<?php echo $url_img; ?>" alt="" class="img-responsive"/>
                                                    </div>
                                                    <div id="fileinput-column">
                                                        <span class="btn btn-flat btn-sm btn-primary btn-file">
                                                            <span class="fileinput-new"><i class="fa fa-search"></i> Select Picture</span>
                                                            <span class="fileinput-exists"><i class="fa fa-edit"></i> Change</span>
                                                            <input type="file" name="__files[]" accept="image/x-png,image/gif,image/jpeg"/>
                                                        </span>
														<?php if ($file_mode == 'fileinput-new') { ?>
                                                            <a href="#" class="btn btn-flat btn-sm btn-danger fileinput-exists" data-dismiss="fileinput">
                                                                <i class="fa fa-times"></i> Remove
                                                            </a>
														<?php } else { ?>
                                                            <button type="button" class="btn btn-flat btn-sm btn-danger btn_dlp" data-id="<?php echo $file_id; ?>">
                                                                <i class="fa fa-times"></i> Remove
                                                            </button>
														<?php } ?>
                                                    </div>
                                                </div>
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
                    <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                    <button type="button" onclick="window.history.back()" class="btn btn-flat btn-default">Cancel</button>
                </div>
            </form>
        </div>

    </div>
</div>