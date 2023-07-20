<div class="dropdown">
    <button class="btn btn-default btn-flat btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <i class="fa fa-gear"></i>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
    <?php if(PRIVILEGES_ON) {?>
            <?php $privilege = $this->config->item('privilege'); ?>
            <?php if($privilege[2]) { ?>
				<li><a href="javascript:void(0)" class="btn_dtl" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang_text('label_detail'); ?>"><i class="fa fa-file"></i><?php echo lang_text('label_detail'); ?></a></li>
				<li><a href="javascript:void(0)" class="btn_dtl" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang_text('label_detail'); ?>"><i class="fa fa-check"></i><?php echo lang_text('label_approve'); ?></a></li>
				<li><a href="javascript:void(0)" class="btn_dtl" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang_text('label_detail'); ?>"><i class="fa fa-times"></i><?php echo lang_text('label_cancel'); ?></a></li>
            <?php } ?>
            <?php if($privilege[3]) { ?>
            <?php } ?>
        <?php } else { ?>
			<li><a href="javascript:void(0)" class="btn_dtl" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang_text('label_detail'); ?>"><i class="fa fa-file"></i><?php echo lang_text('label_detail'); ?></a></li>
			<li><a href="javascript:void(0)" class="btn_approve" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang_text('label_detail'); ?>"><i class="fa fa-check"></i><?php echo lang_text('label_approve'); ?></a></li>
			<li><a href="javascript:void(0)" class="btn_cancel" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang_text('label_detail'); ?>"><i class="fa fa-times"></i><?php echo lang_text('label_cancel'); ?></a></li>
        <?php } ?>
    </ul>
</div>
