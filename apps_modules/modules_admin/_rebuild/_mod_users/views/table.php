<table id="dTabtable" class="table table-bordered table-hover">
    <thead>
    <tr class="bg-gray">
        <th width="1%">No</th>
        <th>Username</th>
        <th>Email</th>
        <th>Full Name</th>
        <th>Phone</th>
        <th width="5%">Level</th>
        <th width="1%">Status</th>
        <th width="1%">#</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($output_result)) { ?>
        <?php foreach ($output_result as $index => $row) { ?>
            <?php
            $output_column_1 = $index + 1;
            $output_column_2 = $row['id'];
            $output_column_3 = $row['username'];
            $output_column_4 = (!empty($row['email'])) ? func_decrypt($row['email']) : '';
            $output_column_5 = (!empty($row['name_full'])) ? func_decrypt($row['name_full']) : '';
            $output_column_6 = (!empty($row['phone'])) ? func_decrypt($row['phone']) : '';
            $output_column_7 = (!empty($row['users_access'])) ? func_decrypt($row['users_access']) : '';
            $output_column_8 = $row['status'];

            if (!empty($output_column_7)) {
                $this->db->where_in('id', json_decode($output_column_7));
                $get_acl = $this->db->get('users_acl')->result_array();
                if (!empty($get_acl)) {
                    $dum_acl = '';
                    foreach ($get_acl as $index_acl => $row_acl) {
                        $dum_acl .= '<label class="label label-primary">' . $row_acl['data_name'] . '</label>';
                        if(count($get_acl) != ($index_acl+1)) {
                            $dum_acl .= '<br/>';
                        }
                    }

                    if(!empty($dum_acl)) {
                        $output_column_7 = $dum_acl;
                    }
                }
            }
            ?>
            <tr>
                <td><?php echo $output_column_1; ?></td>
                <td><?php echo $output_column_3; ?></td>
                <td><?php echo $output_column_4; ?></td>
                <td><?php echo $output_column_5; ?></td>
                <td><?php echo $output_column_6; ?></td>
                <td><?php echo $output_column_7; ?></td>
                <td class="text-center">
                    <?php if ($output_column_8 == 0) { ?>
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
                    <div class="dropdown">
                        <button class="btn btn-default btn-flat btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-gear"></i>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="javascript:void(0)" data-id="<?php echo $output_column_2; ?>" class="btn_edt"><i class="fa fa-pencil"></i> <?php echo lang_text('label_edit'); ?></a></li>
                            <li><a href="javascript:void(0)" data-id="<?php echo $output_column_2; ?>" class="btn_dlt"><i class="fa fa-trash"></i> <?php echo lang_text('label_delete'); ?></a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>