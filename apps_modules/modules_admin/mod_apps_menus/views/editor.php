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
						$input_label       = 'Ordering/Position';
						$input_placeholder = $input_label;
						$input_id          = 'menu_ordering';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : $data_default_ordering;
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="<?php echo $input_name; ?>" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
						<?php
						$input_label       = 'Level';
						$input_placeholder = $input_label;
						$input_id          = 'menu_level';
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
						$input_label       = 'Menu';
						$input_placeholder = $input_label;
						$input_id          = 'menu_name';
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
						$input_label       = 'Icons';
						$input_placeholder = $input_label;
						$input_id          = 'menu_icon';
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
						$input_label       = 'Link';
						$input_placeholder = $input_label;
						$input_id          = 'menu_link';
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
						$input_label       = 'Status';
						$input_placeholder = $input_label;
						$input_id          = 'status';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						$input_value_set   = [
							['id' => 1, 'text' => 'Active'],
							['id' => 0, 'text' => 'Not Active'],
						]
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <select id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control select2">
								<?php echo select_dropdown_generate_option($input_value_set, $input_value, $input_label, $input_name, true); ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
						<?php
						$input_label       = 'Display';
						$input_placeholder = $input_label;
						$input_id          = 'menu_display';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						$input_value_set   = [
							['id' => 1, 'text' => 'Show'],
							['id' => 0, 'text' => 'Hidden'],
						]
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <select id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control select2">
								<?php echo select_dropdown_generate_option($input_value_set, $input_value, $input_label, $input_nam, true); ?>
                            </select>
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