<div class="row">
    <div class="col-md-12">

        <div class="box box-solid">
            <div id="form-title-box"
                 class="box-header                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php echo ($template_title_module_action == 'add') ? 'bg-blue' : 'bg-orange' ?> with-border">
                <h3 id="form-title" class="box-title form-title">
                    <span id="form-title-icon"><i class="fa fa-file"></i></span>
                    <span id="form-title-action"><?php echo ucwords($template_title_module_action); ?></span> <?php echo $template_title_module; ?>
                </h3>
            </div>
            <form class="form-horizontal">
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
                            <span><?php echo $input_value; ?></span>
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
                            <span><?php echo $input_value; ?></span>
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
                            <p><?php echo $input_value; ?></p>
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
                            <span><?php echo $input_value; ?></span>
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
                            <span><?php echo $input_value ? 'Active' : 'Not Active'; ?></span>
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
                <a href="<?php echo base_url("mod_pub_pages/edit/{$this->uri->segment(3)}") ?>" class="btn btn-flat btn-warning"><i class="fa fa-pencil"></i> Edit</a>
					<button type="button" onclick="window.history.back()" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> Back</button>
                </div>
            </form>
        </div>

    </div>
</div>