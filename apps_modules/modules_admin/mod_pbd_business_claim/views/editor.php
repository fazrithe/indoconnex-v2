<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
		<style>
			.select2-container--default .select2-selection--multiple .select2-selection__choice{
				background-color: #3c8dbc!important;
				border-color: #367fa9!important;
			}
		</style>

        <div class="box box-solid">
            <div id="form-title-box"
                 class="box-header                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php echo ($template_title_module_action == 'add') ? 'bg-blue' : 'bg-orange' ?> with-border">
                <h3 id="form-title" class="box-title form-title">
                    <span id="form-title-icon"><i class="<?php echo ($template_title_module_action == 'add') ? 'fa fa-plus-circle' : 'fa fa-edit' ?>"></i></span>
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
						$input_label       = 'Name Business';
						$input_placeholder = $input_label;
						$input_id          = 'data_name';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="<?php echo $input_name; ?>" disabled class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
						<?php
						$input_label       = 'Username Business';
						$input_placeholder = $input_label;
						$input_id          = 'data_username';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="<?php echo $input_name; ?>" disabled onkeypress="return hanyaAngka(event)" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                        </div>
                    </div>

					<div class="form-group">
						<?php
						$input_label       = 'User Claim';
						$input_placeholder = $input_label;
						$input_id          = 'username';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result_user[$input_name])) ? $output_result_user[$input_name] : '';
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="<?php echo $input_name; ?>" disabled onkeypress="return hanyaAngka(event)" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                        </div>
                    </div>

					<div class="form-group">
						<?php
						$input_label       = 'File';
						$input_placeholder = $input_label;
						$input_id          = 'file_name';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result_claim[$input_name])) ? $output_result_claim[$input_name] : '';
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
							<a href="<?php echo site_url('mod_pbd_business_claim/pdf/').$output_result_claim['business_id'] ?>" target="_blank" class="btn btn-primary" title="">View</a> <?php echo $output_result_claim['file_name'] ?>
						</div>
                    </div>

					<div class="form-group">
						<?php
						$input_label       = 'Relationship';
						$input_placeholder = $input_label;
						$input_id          = 'relationship';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result_claim[$input_name])) ? $output_result_claim[$input_name] : '';
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="<?php echo $input_name; ?>" disabled onkeypress="return hanyaAngka(event)" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
						<?php
						$input_label       = 'Note';
						$input_placeholder = $input_label;
						$input_id          = 'note';
						$input_name        = $input_id;
						$input_value       = (!empty($output_result_claim[$input_name])) ? $output_result_claim[$input_name] : '';
						?>
                        <label for="<?php echo $input_id; ?>" class="col-sm-3 control-label text-left"><?php echo $input_label; ?></label>
                        <div class="col-sm-9">
                            <textarea id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control summernote" placeholder="<?php echo $input_placeholder; ?>" autocomplete="off">Thank you <?php echo $output_result_user["username"] ?> for contacting us, We have received your documents and your validation process has been successful. now you can manage your business at IndoConnex independently in <b><span class="text-primary">"My Business Page </span> > Manage my Business"</b></textarea>
                        </div>
                    </div>
					<input type="hidden" name="status" value="2">
                </div>
                <div class="box-footer bg-gray">
					<?php if($template_title_module_action == 'approve'){ ?>
                    	<button type="submit" class="btn btn-flat btn-primary">Approve</button>
					<?php }else{ ?>
						<button type="submit" class="btn btn-flat btn-danger">Cancel</button>
					<?php } ?>
                    <button type="button" onclick="window.history.back()" class="btn btn-flat btn-default">Back</button>
                </div>
            </form>
        </div>

    </div>
</div>

