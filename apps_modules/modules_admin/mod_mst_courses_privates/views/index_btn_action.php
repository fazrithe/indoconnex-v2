<div class="dropdown">
    <button class="btn btn-default btn-flat btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <i class="fa fa-gear"></i>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        <?php if(PRIVILEGES_ON) {?>
            <?php $privilege = $this->config->item('privilege'); ?>
            <?php if($privilege[2]) { ?>
                <li><a href="javascript:void(0)" class="btn_edt" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang_text('label_edit'); ?>"><i class="fa fa-pencil"></i><?php echo lang_text('label_edit'); ?></a></li>
            <?php } ?>
            <?php if($privilege[3]) { ?>
                <li><a href="javascript:void(0)" class="btn_dlt" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang_text('label_delete'); ?>"><i class="fa fa-trash"></i><?php echo lang_text('label_delete'); ?></a></li>
            <?php } ?>
        <?php } else { ?>
            <li><a href="javascript:void(0)" class="btn_edt" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang_text('label_edit'); ?>"><i class="fa fa-pencil"></i><?php echo lang_text('label_edit'); ?></a></li>
            <li><a href="javascript:void(0)" class="btn_dlt" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang_text('label_delete'); ?>"><i class="fa fa-trash"></i><?php echo lang_text('label_delete'); ?></a></li>
        <?php } ?>
    </ul>
</div>