<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header bg-black with-border">
                <h3 class="box-title"><i class="fa fa-table"></i> <?php echo ucfirst($output_result['username']); ?> Privilege <?php echo lang_text('label_table') ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form id="form-tbl" method="post" action="<?php echo current_url(); ?>">
                    <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                    <input type="hidden" name="operator_id" value="<?php echo $output_result['id']; ?>"/>
                    <table class="table table-bordered table-striped" style="width:100%">
                        <thead>
                        <tr class="bg-gray">
                            <th width="1%" class="text-center">#</th>
                            <th>Menu</th>
                            <th>Icon</th>
                            <th>Link</th>
                            <th class="text-uppercase text-center" width="1%">
                                List
                            </th>
                            <th class="text-uppercase text-center" width="1%">
                                Add
                            </th>
                            <th class="text-uppercase text-center" width="1%">
                                Edit
                            </th>
                            <th class="text-uppercase text-center" width="1%">
                                Delete
                            </th>
                            <th width="1%">
                                <input name="select_all" value="1" type="checkbox">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
						<?php $no = 1; ?>
						<?php foreach ($menu_list as $menu) { ?>
                            <input type="hidden" name="menu_id[<?php echo $menu['id']; ?>]" value="<?php echo $menu['id']; ?>"/>
                            <tr>
                                <td><?php echo $no++ ?>.</td>
                                <td><?php echo $menu['menu_name'] ?></td>
                                <td><?php echo $menu['menu_icon'] ?></td>
                                <td><?php echo $menu['menu_link'] ?></td>
								<?php if (!$menu['has_child']) { ?>
                                    </td>
                                    <td class="text-uppercase text-center">
                                        <input name="list[<?php echo $menu['id']; ?>]" id="list-<?php echo $menu['id']; ?>" value="1" type="checkbox" <?php if ($menu['list'] == '1') { ?>checked=""<?php } ?> >
                                    </td>
                                    <td class="text-uppercase text-center">
                                        <input name="add[<?php echo $menu['id']; ?>]" id="add-<?php echo $menu['id']; ?>" value="1" type="checkbox" <?php if ($menu['add'] == '1') { ?>checked=""<?php } ?> >
                                    </td>
                                    <td class="text-uppercase text-center">
                                        <input name="edit[<?php echo $menu['id']; ?>]" id="edit-<?php echo $menu['id']; ?>" value="1" type="checkbox" <?php if ($menu['edit'] == '1') { ?>checked=""<?php } ?> >
                                    </td>
                                    <td class="text-uppercase text-center">
                                        <input name="delete[<?php echo $menu['id']; ?>]" id="delete-<?php echo $menu['id']; ?>" value="1" type="checkbox" <?php if ($menu['delete'] == '1') { ?>checked=""<?php } ?> >
                                    </td>
                                    <td class="text-uppercase text-center">
                                        <input name="select_all_list" class="select_all_list" data-id="<?php echo $menu['id']; ?>" value="1" type="checkbox" <?php if ($menu['list'] == '1' && $menu['add'] == '1' && $menu['edit'] == '1' && $menu['delete'] == '1') { ?>checked=""<?php } ?> >
                                    </td>
								<?php } else { ?>
                                    <td colspan="5">
                                        <input type="hidden" name="list[<?php echo $menu['id']; ?>]" value="1"/>
                                        <input type="hidden" name="add[<?php echo $menu['id']; ?>]" value="0"/>
                                        <input type="hidden" name="edit[<?php echo $menu['id']; ?>]" value="0"/>
                                        <input type="hidden" name="delete[<?php echo $menu['id']; ?>]" value="0"/>
                                    </td>
								<?php } ?>
                            </tr>
						<?php } ?>
                        </tbody>
                    </table>

                    <div class="box-footer bg-gray">
                        <button type="submit" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Submit</button>
                        <button type="button" class="btn btn-flat btn-sm btn-default" onclick="return window.history.back();">
                            <i class="fa fa-close"></i> Cancel
                        </button>
                    </div>
                </form>


            </div>
        </div>

    </div>
</div>