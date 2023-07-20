<table id="dTabtable" class="table table-bordered table-hover">
    <thead>
    <tr class="bg-gray">
        <th width="1%">No</th>
        <th>Name</th>
        <th>Description</th>
        <th>Date Active</th>
        <th width="1%">Status</th>
        <th width="10%">Disable Delete</th>
        <th width="1%">#</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($output_result)) { ?>
        <?php foreach ($output_result as $index => $row) { ?>
            <?php
            $output_column_1 = $index + 1;
            $output_column_2 = $row['id'];
            $output_column_3 = $row['data_name'];
            $output_column_4 = $row['data_description'];
            $output_column_5 = format_date(date('Y-m-d', strtotime($row['published']))) . ' ' . date('H:i', strtotime($row['published']));
            $output_column_6 = $row['status'];
            $output_column_7 = $row['status_disable'];
            ?>
            <tr>
                <td><?php echo $output_column_1; ?></td>
                <td><?php echo $output_column_3; ?></td>
                <td><?php echo $output_column_4; ?></td>
                <td><?php echo $output_column_5; ?></td>
                <td class="text-center">
                    <?php if ($output_column_6 == 0) { ?>
                        <a href="javascript:void(0)" class="btn_sts" data-id="<?php echo $output_column_2; ?>" data-status="1">
                            <label class="label label-danger">Not Active</label>
                        </a>
                    <?php } else { ?>
                        <a href="javascript:void(0)" class="btn_sts" data-id="<?php echo $output_column_2; ?>" data-status="0">
                            <label class="label label-success">Active</label>
                        </a>
                    <?php } ?>
                </td>
                <td class="text-center">
                    <?php if ($output_column_7 == 0) { ?>
                        <a href="javascript:void(0)" class="btn_std" data-id="<?php echo $output_column_2; ?>" data-status="1">
                            <label class="label label-danger">Can't Deleted</label>
                        </a>
                    <?php } else { ?>
                        <a href="javascript:void(0)" class="btn_std" data-id="<?php echo $output_column_2; ?>" data-status="0">
                            <label class="label label-success">Can be Deleted</label>
                        </a>
                    <?php } ?>
                </td>
                <td class="text-center">
                    <div class="dropdown">
                        <button class="btn btn-default btn-flat btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-gear"></i>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="javascript:void(0)" data-id="<?php echo $output_column_2; ?>" class="btn_edt"><i class="fa fa-pencil"></i> <?php echo lang_text('label_edit'); ?></a></li>
                            <?php if ($output_column_7 == 1) { ?>
                                <li><a href="javascript:void(0)" data-id="<?php echo $output_column_2; ?>" class="btn_dlt"><i class="fa fa-trash"></i> <?php echo lang_text('label_delete'); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>