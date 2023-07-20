<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <div class="box box-solid">
            <div id="form-title-box" class="box-header <?php echo ($template_title_module_action == 'add') ? 'bg-blue' : 'bg-orange' ?> with-border">
                <h3 id="form-title" class="box-title form-title">
                    <span id="form-title-icon"><i class="<?php echo ($template_title_module_action == 'add') ? 'fa fa-plus-circle' : 'fa fa-edit' ?>"></i></span>
                    <span id="form-title-action"><?php echo ucwords($template_title_module_action); ?></span> <?php echo $template_title_module; ?>
                </h3>
            </div>
            <form id="form-action" method="post" action="<?php echo current_url(); ?>" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
				<?php
				$input_label       = 'id';
				$input_placeholder = $input_label;
				$input_id          = 'id';
				$input_name        = $input_id;
				$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
				?>
                <input type="hidden" id="id" name="id" value="<?php echo $input_value; ?>"/>
                <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                <div class="box-body">

					<?php if (!empty($output_result_dropdown)) { ?>
						<?php foreach ($output_result_dropdown as $index_dropdown => $row_dropdown) { ?>
                            <div class="form-group">
								<?php
								$input_label       = $row_dropdown['label'];
								$input_placeholder = $input_label;
								$input_id          = $row_dropdown['name'];
								$input_name        = $input_id;
								$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
								?>
                                <label><?php echo $input_label; ?></label>
                                <select id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control select2" placeholder="<?php echo $input_placeholder; ?>" data-validation="required">
                                    <option value=""><?php echo lang_text('option_choose') ?></option>
									<?php if (!empty($row_dropdown['dataset'])) { ?>
										<?php foreach ($row_dropdown['dataset'] as $index => $row) { ?>
                                            <option value="<?php echo $row['option_value']; ?>"<?php echo ($input_value == $row['option_value']) ? ' selected' : ''; ?>><?php echo $row['option_name']; ?></option>
										<?php } ?>
									<?php } ?>
                                </select>
                            </div>
						<?php } ?>
					<?php } ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
								<?php
								$input_label       = 'Username';
								$input_placeholder = $input_label;
								$input_id          = 'username';
								$input_name        = $input_id;
								$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
								?>
                                <label for="<?php echo $input_id; ?>"><?php echo $input_label; ?></label>
                                <input type="text" name="<?php echo $input_name; ?>" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
								<?php
								$input_label       = 'Email';
								$input_placeholder = $input_label;
								$input_id          = 'email';
								$input_name        = $input_id;
								$input_value       = (!empty($output_result[$input_name])) ? ($output_result[$input_name]) : '';
								?>
                                <label for="<?php echo $input_id; ?>"><?php echo $input_label; ?></label>
                                <input type="text" name="<?php echo $input_name; ?>" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
						<?php
						$input_label       = 'Password';
						$input_placeholder = $input_label;
						$input_id          = 'password_create';
						$input_name        = $input_id;
						$input_value       = '';
						?>
                        <label for="<?php echo $input_id; ?>"><?php echo $input_label; ?></label>
                        <input type="password" name="<?php echo $input_name; ?>" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                    </div>


                    <div class="form-group">
						<?php
						$input_label       = 'Confirm Password';
						$input_placeholder = $input_label;
						$input_id          = 'password_confirm';
						$input_name        = $input_id;
						$input_value       = '';
						?>
                        <label for="<?php echo $input_id; ?>"><?php echo $input_label; ?></label>
                        <input type="password" name="<?php echo $input_name; ?>" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
								<?php
								$input_label       = 'Full Name';
								$input_placeholder = $input_label;
								$input_id          = 'name_full';
								$input_name        = $input_id;
								$input_value       = (!empty($output_result[$input_name])) ? ($output_result[$input_name]) : '';
								?>
                                <label for="<?php echo $input_id; ?>"><?php echo $input_label; ?></label>
                                <input type="text" name="<?php echo $input_name; ?>" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
								<?php
								$input_label       = 'Nick Name';
								$input_placeholder = $input_label;
								$input_id          = 'name_nick';
								$input_name        = $input_id;
								$input_value       = (!empty($output_result[$input_name])) ? ($output_result[$input_name]) : '';
								?>
                                <label for="<?php echo $input_id; ?>"><?php echo $input_label; ?></label>
                                <input type="text" name="<?php echo $input_name; ?>" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                            </div>

                        </div>

                    </div>


                    <div class="form-group">
						<?php
						$input_label       = 'Mobile Phone';
						$input_placeholder = $input_label;
						$input_id          = 'phone';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? ($output_result[$input_name]) : '';
						?>
                        <label for="<?php echo $input_id; ?>"><?php echo $input_label; ?></label>
                        <input type="text" name="<?php echo $input_name; ?>" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                    </div>

                    <div class="form-group">
						<?php
						$input_label       = 'Status';
						$input_placeholder = $input_label;
						$input_id          = 'status';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						$input_value_set   = array(
							array('id' => 0, 'text' => 'Not Active'),
							array('id' => 1, 'text' => 'Active'),
						)
						?>
                        <label for="<?php echo $input_id; ?>"><?php echo $input_label; ?></label>
                        <select id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control select2">
							<?php if (!empty($input_value_set)) { ?>
								<?php foreach ($input_value_set as $index_set => $row_set) { ?>
                                    <option value="<?php echo $row_set['id']; ?>"<?php echo ($input_value == $row_set['id']) ? ' selected' : ''; ?>><?php echo $row_set['text']; ?></option>
								<?php } ?>
							<?php } ?>
                        </select>
                    </div>
                    <div class="form-group hidden">
						<?php
						$input_label       = 'Access Level';
						$input_placeholder = $input_label;
						$input_id          = 'users_access';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? json_decode(($output_result[$input_name])) : '';

						$this->db->select('id as id, data_name as text');
						$input_value_set = $this->db->get_where('users_acl')->result_array();
						?>
                        <label for="<?php echo $input_id; ?>"><?php echo $input_label; ?></label>
                        <div class="">
							<?php if (!empty($input_value_set)) { ?>
								<?php foreach ($input_value_set as $index_set => $row_set) { ?>
									<?php
									$parameter_checked = '';
									if (!empty($input_value)) {
										if (in_array($row_set['id'], $input_value)) {
											$parameter_checked = 'checked="checked"';
										}
									}
									?>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="<?php echo $input_name; ?>[]" value="<?php echo $row_set['id']; ?>" <?php echo $parameter_checked; ?>><?php echo $row_set['text']; ?></label>
                                    </div>
								<?php } ?>
							<?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
								<?php
								$input_label       = 'Featured Image';
								$input_placeholder = $input_label;
								$input_id          = 'files';
								$input_name        = $input_id;
								$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
								?>
                                <label for="<?php echo $input_id; ?>" class="col-sm-12 control-label text-left"><?php echo $input_label; ?></label>

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
                                            <div class="fileinput                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php echo $file_mode; ?>"
                                                 data-provides="fileinput" style="width: 100%;">
                                                <div class="fileinput-new thumbnail ratio ratio1-1">
                                                    <img src="<?php echo $url_img_notfound; ?>" alt="" class="img-responsive"/>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail ratio ratio1-1">
                                                    <img src="<?php echo $url_img; ?>" alt="" class="img-responsive"/>
                                                </div>
                                                <div id="fileinput-column">
                                                        <span class="btn btn-flat btn-xs btn-primary btn-file">
                                                            <span class="fileinput-new"><i class="fa fa-search"></i> Select Picture</span>
                                                            <span class="fileinput-exists"><i class="fa fa-edit"></i> Change</span>
                                                            <input type="file" name="__files[]" accept="image/x-png,image/gif,image/jpeg"/>
                                                        </span>
													<?php if ($file_mode == 'fileinput-new') { ?>
                                                        <a href="#" class="btn btn-flat btn-xs btn-danger fileinput-exists" data-dismiss="fileinput">
                                                            <i class="fa fa-times"></i> Remove
                                                        </a>
													<?php } else { ?>
                                                        <button type="button" class="btn btn-flat btn-xs btn-danger btn_dlp" data-id="<?php echo $file_id; ?>" data-type="__files">
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
                        <div class="col-sm-6">
                            <div class="form-group">
								<?php
								$input_label       = 'Cover Image';
								$input_placeholder = $input_label;
								$input_id          = 'cover';
								$input_name        = $input_id;
								$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
								?>
                                <label for="<?php echo $input_id; ?>" class="col-sm-12 control-label text-left"><?php echo $input_label; ?></label>

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
                                            <div class="fileinput                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php echo $file_mode; ?>"
                                                 data-provides="fileinput" style="width: 100%;">
                                                <div class="fileinput-new thumbnail ratio ratio1-1">
                                                    <img src="<?php echo $url_img_notfound; ?>" alt="" class="img-responsive"/>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail ratio ratio1-1">
                                                    <img src="<?php echo $url_img; ?>" alt="" class="img-responsive"/>
                                                </div>
                                                <div id="fileinput-column">
                                                        <span class="btn btn-flat btn-xs btn-primary btn-file">
                                                            <span class="fileinput-new"><i class="fa fa-search"></i> Select Picture</span>
                                                            <span class="fileinput-exists"><i class="fa fa-edit"></i> Change</span>
                                                            <input type="file" name="__files_cover[]" accept="image/x-png,image/gif,image/jpeg"/>
                                                        </span>
													<?php if ($file_mode == 'fileinput-new') { ?>
                                                        <a href="#" class="btn btn-flat btn-xs btn-danger fileinput-exists" data-dismiss="fileinput">
                                                            <i class="fa fa-times"></i> Remove
                                                        </a>
													<?php } else { ?>
                                                        <button type="button" class="btn btn-flat btn-xs btn-danger btn_dlp" data-id="<?php echo $file_id; ?>" data-type="__files_cover">
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
                <div class="box-footer bg-gray">
                    <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                    <button type="button" onclick="window.history.back()" class="btn btn-flat btn-default">Cancel</button>
                </div>
            </form>
        </div>

    </div>
</div>