<div class="row">
    <div class="col-md-12">
        <div id="btn_widget" class="mb-3 text-right">
        <?php if(PRIVILEGES_ON) {?>
                <?php $privilege = $this->config->item('privilege'); ?>
                <?php if($privilege[1]) { ?>
                <?php } ?>
                <?php if($privilege[2]) { ?>
                    <a href="#" class="btn btn-md btn-flat bg-red btn_cbx" data-status="0">
                        <i class="fa fa-circle"></i> <span class="hidden-sm hidden-xs">Set Not Active</span>
                    </a>
                    <a href="#" class="btn btn-md btn-flat bg-green btn_cbx" data-status="2">
                        <i class="fa fa-check"></i> <span class="hidden-sm hidden-xs">Set Active</span>
                    </a>
                <?php } ?>
                <?php if($privilege[3]) { ?>
                <?php } ?>
            <?php } else { ?>
                <a href="#" class="btn btn-md btn-flat bg-red btn_cbx" data-status="0">
                    <i class="fa fa-circle"></i> <span class="hidden-sm hidden-xs">Set Not Active</span>
                </a>
                <a href="#" class="btn btn-md btn-flat bg-green btn_cbx" data-status="2">
                    <i class="fa fa-check"></i> <span class="hidden-sm hidden-xs">Set Active</span>
                </a>
            <?php } ?>
            <a href="#" class="btn btn-md btn-flat bg-gray btn_rld">
                <i class="fa fa-refresh"></i> <span class="hidden-sm hidden-xs">Refresh</span>
            </a>
        </div>
        <div class="box box-solid">
            <div class="box-header bg-black with-border">
                <h3 class="box-title">
                    <i class="fa fa-table"></i>
                    <?php echo $template_title_module; ?><?php echo ' '; ?><?php echo lang_text('label_table') ?>
                </h3>
            </div>
            <!-- /.box-header -->
            <div id="filter-table" class="mt-3">

                <div class="form-group">
                    <label>Show Entries</label>
                    <select id="filter_length" name="filter_length" class="form-control select2">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="form-group">
                <?php
                    $input_label       = 'Search by Categories';
                    $input_placeholder = $input_label;
                    $input_id          = 'filter_categories';
                    $input_name        = $input_id;
                    $input_value       = (!empty($output_result[$input_name])) ? $output_result[$input_name] : '';
                ?>
                    <label><?php echo $input_label; ?></label>
                    <select id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>" class="form-control select2"></select>
                </div>
                <div class="form-group">
                    <label>Search Keywords</label>
                    <input type="text" class="form-control" id="filter_search" name="filter_search" value="" placeholder="Search Keywords" />
                </div>

            </div>

            <div class="box-body">
                <form id="form-tbl" onsubmit="return false;" method="post">
                    <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>" />
                    <table id="data_tables" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr class="bg-gray">
                                <th width="1%">
                                    <input name="select_all" value="1" type="checkbox">
                                </th>
                                <th width="1%">ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th width="10%">Created</th>
                                <th width="10%">Updated</th>
								<th width="1%">Page</th>
                                <th width="1%">Status</th>
                                <th width="1%" class="text-center">#</th>
                            </tr>
                        </thead>
                    </table>
                </form>


            </div>
        </div>

    </div>
</div>
