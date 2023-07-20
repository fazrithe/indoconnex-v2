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


                    <div class="form-group">
						<?php
						$input_label       = 'Ordering/Position';
						$input_placeholder = $input_label;
						$input_id          = 'data_position';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : $data_default_ordering;
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="<?php echo $input_name; ?>" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                        </div>
                    </div>

                    <div class="form-group hidden">
						<?php
						$input_label       = 'Parent';
						$input_placeholder = $input_label;
						$input_id          = 'parent';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <select id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control select2"></select>
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
						$input_label       = 'Sub Name';
						$input_placeholder = $input_label;
						$input_id          = 'data_name_sub';
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
                            <textarea id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control summernote" placeholder="<?php echo $input_placeholder; ?>" autocomplete="off"><?php echo $input_value; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
		                <?php
		                $input_label       = 'Data Align';
		                $input_placeholder = $input_label;
		                $input_id          = 'data_align';
		                $input_name        = $input_id;
		                $input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
		                $input_value_set   = [
			                ['id' => 'center', 'text' => 'CENTER'],
			                ['id' => 'left', 'text' => 'LEFT'],
			                ['id' => 'right', 'text' => 'RIGHT'],
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