<div class="box box-solid">
    <div id="form-title-box" class="box-header <?php echo ($template_title_module_action == 'add') ? 'bg-blue' : 'bg-orange' ?> with-border">
        <h3 id="form-title" class="box-title form-title">
            <span id="form-title-icon"><i class="<?php echo ($template_title_module_action == 'add') ? 'fa fa-plus-circle' : 'fa fa-edit' ?>"></i></span>
            <span id="form-title-action"><?php echo ucwords($template_title_module_action); ?></span> <?php echo $template_title_module; ?>
        </h3>
    </div>
    <form id="form-action" method="post" action="<?php echo current_url(); ?>" role="form">
        <?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
        <input type="hidden" id="id" name="id" value=""/>
        <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
        <div class="box-body">
            <div class="form-group">
                <?php
                $input_label       = 'Name';
                $input_placeholder = $input_label;
                $input_id          = 'data_name';
                $input_name        = $input_id;
                $input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
                ?>
                <label for="<?php echo $input_id; ?>"><?php echo $input_label; ?></label>
                <input type="text" name="<?php echo $input_name; ?>" class="form-control" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" autocomplete="off" placeholder="<?php echo $input_placeholder; ?>"/>
            </div>
            <div class="form-group">
                <?php
                $input_label       = 'Description';
                $input_placeholder = $input_label;
                $input_id          = 'data_description';
                $input_name        = $input_id;
                $input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
                ?>
                <label for="<?php echo $input_id; ?>"><?php echo $input_label; ?></label>
                <textarea id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control" placeholder="<?php echo $input_placeholder; ?>" autocomplete="off"><?php echo $input_value; ?></textarea>
            </div>
            <div class="form-group">
                <?php
                $input_label       = 'Date Active';
                $input_placeholder = $input_label;
                $input_id          = 'published';
                $input_name        = $input_id;
                $input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
                ?>
                <label for="<?php echo $input_id; ?>"><?php echo $input_label; ?></label>
                <input type="text" name="<?php echo $input_name; ?>" class="form-control datetimepicker" id="<?php echo $input_id; ?>" value="<?php echo $input_value; ?>" placeholder="<?php echo $input_placeholder; ?>"/>
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
        </div>
        <div class="box-footer bg-gray">
            <button type="submit" class="btn btn-flat btn-primary">Submit</button>
            <button type="button" onclick="window.history.back()" class="btn btn-flat btn-default">Cancel</button>
        </div>
    </form>
</div>
