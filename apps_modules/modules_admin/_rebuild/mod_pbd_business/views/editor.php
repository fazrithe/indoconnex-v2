<form id="form-action" class="form-horizontal" method="post" action="<?php echo current_url(); ?>" role="form" enctype="multipart/form-data">
	<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
    <input type="hidden" id="id" name="id" value=""/>
    <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

    <div class="row">
        <div class="col-sm-10 col-md-offset-1">

            <div class="box box-solid">
                <div id="form-title-box" class="box-header <?php echo ($template_title_module_action == 'add') ? 'bg-blue' : 'bg-orange' ?> with-border">
                    <h3 id="form-title" class="box-title form-title">
                        <span id="form-title-icon"><i class="<?php echo ($template_title_module_action == 'add') ? 'fa fa-plus-circle' : 'fa fa-edit' ?>"></i></span>
                        <span id="form-title-action"><?php echo ucwords($template_title_module_action); ?></span> <?php echo $template_title_module; ?>
                    </h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
						<?php
						$input_label       = 'Business Name';
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
						$input_label       = 'Business Username';
						$input_placeholder = $input_label;
						$input_id          = 'data_username';
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
						$input_label       = 'Business Type';
						$input_placeholder = $input_label;
						$input_id          = 'status';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						$input_value_set   = array(
							array('id' => 0, 'text' => 'SME'),
							array('id' => 1, 'text' => 'SME 2'),
						)
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <select id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control select2">
								<?php if (!empty($input_value_set)) { ?>
									<?php foreach ($input_value_set as $index_set => $row_set) { ?>
                                        <option value="<?php echo $row_set['id']; ?>"<?php echo ($input_value == $row_set['id']) ? ' selected' : ''; ?>><?php echo $row_set['text']; ?></option>
									<?php } ?>
								<?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
						<?php
						$input_label       = 'Business Categories';
						$input_placeholder = $input_label;
						$input_id          = 'status';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						$input_value_set   = array(
							array('id' => 0, 'text' => 'SME'),
							array('id' => 1, 'text' => 'SME 2'),
						)
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <select id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control select2">
								<?php if (!empty($input_value_set)) { ?>
									<?php foreach ($input_value_set as $index_set => $row_set) { ?>
                                        <option value="<?php echo $row_set['id']; ?>"<?php echo ($input_value == $row_set['id']) ? ' selected' : ''; ?>><?php echo $row_set['text']; ?></option>
									<?php } ?>
								<?php } ?>
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
						$input_value_set   = array(
							array('id' => 0, 'text' => 'Not Active'),
							array('id' => 1, 'text' => 'Active'),
						)
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <select id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control select2">
								<?php if (!empty($input_value_set)) { ?>
									<?php foreach ($input_value_set as $index_set => $row_set) { ?>
                                        <option value="<?php echo $row_set['id']; ?>"<?php echo ($input_value == $row_set['id']) ? ' selected' : ''; ?>><?php echo $row_set['text']; ?></option>
									<?php } ?>
								<?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
						<?php
						$input_label       = 'Disable Delete';
						$input_placeholder = $input_label;
						$input_id          = 'status_disable';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						$input_value_set   = array(
							array('id' => 1, 'text' => 'Can be Deleted'),
							array('id' => 0, 'text' => 'Can\'t Delete'),
						);
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <select id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control select2">
								<?php if (!empty($input_value_set)) { ?>
									<?php foreach ($input_value_set as $index_set => $row_set) { ?>
                                        <option value="<?php echo $row_set['id']; ?>"<?php echo ($input_value == $row_set['id']) ? ' selected' : ''; ?>><?php echo $row_set['text']; ?></option>
									<?php } ?>
								<?php } ?>
                            </select>
                        </div>
                    </div>


                    <div class="">

                        <div class="form-group">
			                <?php
			                $input_label       = 'Address';
			                $input_placeholder = $input_label;
			                $input_id          = 'data_address';
			                $input_name        = $input_id;
			                $input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
			                ?>
                            <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                            <div class="col-sm-9">
                                <textarea id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control" placeholder="<?php echo $input_placeholder; ?>" autocomplete="off"><?php echo $input_value; ?></textarea>
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
                                <input type="text" name="<?php echo $input_name; ?>" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
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
                                <input type="text" name="<?php echo $input_name; ?>" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
			                <?php
			                $input_label       = 'Opening Hour';
			                $input_placeholder = $input_label;
			                $input_id          = 'data_opening_hours';
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
			                $input_label       = 'Working Hour';
			                $input_placeholder = $input_label;
			                $input_id          = 'data_opening_hours';
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
			                $input_label       = 'Facility';
			                $input_placeholder = $input_label;
			                $input_id          = 'data_facility';
			                $input_name        = $input_id;
			                $input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
			                ?>
                            <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                            <div class="col-sm-9">
                                <textarea id="<?php echo $input_id; ?>" rows="1" name="<?php echo $input_name; ?>" class="form-control" placeholder="<?php echo $input_placeholder; ?>" autocomplete="off"><?php echo $input_value; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
			                <?php
			                $input_label       = 'Add Team/Staff';
			                $input_placeholder = $input_label;
			                $input_id          = 'data_opening_hours';
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
			                $input_label       = 'No. Team/Staff';
			                $input_placeholder = $input_label;
			                $input_id          = 'data_opening_hours';
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
			                $input_label       = 'Payment Method';
			                $input_placeholder = $input_label;
			                $input_id          = 'data_payment_method';
			                $input_name        = $input_id;
			                $input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
			                $input_value_set   = array(
				                array('id' => 1, 'text' => 'Manual'),
				                array('id' => 0, 'text' => 'Paypal'),
			                );
			                ?>
                            <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                            <div class="col-sm-9">
                                <select id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control select2">
					                <?php if (!empty($input_value_set)) { ?>
						                <?php foreach ($input_value_set as $index_set => $row_set) { ?>
                                            <option value="<?php echo $row_set['id']; ?>"<?php echo ($input_value == $row_set['id']) ? ' selected' : ''; ?>><?php echo $row_set['text']; ?></option>
						                <?php } ?>
					                <?php } ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
			                <?php
			                $input_label       = 'Website Link';
			                $input_placeholder = $input_label;
			                $input_id          = 'data_opening_hours';
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
			                $input_label       = 'Linkedin Link';
			                $input_placeholder = $input_label;
			                $input_id          = 'data_opening_hours';
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
			                $input_label       = 'Facebook Link';
			                $input_placeholder = $input_label;
			                $input_id          = 'data_opening_hours';
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
			                $input_label       = 'Instagram Link';
			                $input_placeholder = $input_label;
			                $input_id          = 'data_opening_hours';
			                $input_name        = $input_id;
			                $input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
			                ?>
                            <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                            <div class="col-sm-9">
                                <input type="text" name="<?php echo $input_name; ?>" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
		                <?php
		                $input_label       = 'Profile Picture';
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
							                $url_img_notfound = 'http://via.placeholder.com/600x600?text=Image+Not+Found';
							                $url_img          = 'http://via.placeholder.com/600x600?text=Image+Not+Found';
							                $file_mode        = 'fileinput-new';
							                $file_id          = '';
							                if (!empty($output_result)) {
								                $url_img = ($output_result['file_path'] . $output_result['file_name_original']);
								                if (!file_exists($url_img)) {
									                $file_mode = 'fileinput-new';
									                $url_img   = 'http://via.placeholder.com/600x600?text=Image+Not+Found';
								                } else {
									                $file_mode = 'fileinput-exists';
									                $url_img   = base_url($url_img);
								                }
								                $file_id = $output_result['id'];
							                }
							                ?>
							                <?php echo ($i % 12 == 1) ? '<div class="row">' : ''; ?>

                                            <div class="col-sm-12">
                                                <div class="fileinput <?php echo $file_mode; ?>" data-provides="fileinput" style="width: 100%;">
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
                    <div class="form-group">
		                <?php
		                $input_label       = 'Cover Photo';
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
							                $url_img_notfound = 'http://via.placeholder.com/600x600?text=Image+Not+Found';
							                $url_img          = 'http://via.placeholder.com/600x600?text=Image+Not+Found';
							                $file_mode        = 'fileinput-new';
							                $file_id          = '';
							                if (!empty($output_result)) {
								                $url_img = ($output_result['file_path'] . $output_result['file_name_original']);
								                if (!file_exists($url_img)) {
									                $file_mode = 'fileinput-new';
									                $url_img   = 'http://via.placeholder.com/600x600?text=Image+Not+Found';
								                } else {
									                $file_mode = 'fileinput-exists';
									                $url_img   = base_url($url_img);
								                }
								                $file_id = $output_result['id'];
							                }
							                ?>
							                <?php echo ($i % 12 == 1) ? '<div class="row">' : ''; ?>

                                            <div class="col-sm-12">
                                                <div class="fileinput <?php echo $file_mode; ?>" data-provides="fileinput" style="width: 100%;">
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
            </div>

        </div>


    </div>
</form>