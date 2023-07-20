<div class="row">
    <div class="col-md-12">
        <div id="btn_widget" class="mb-3 text-right">
            <a href="#" class="btn btn-md btn-flat btn-primary btn_add">
                <i class="fa fa-plus"></i> <span class="hidden-sm hidden-xs">Add</span>
            </a>
            <a href="#" class="btn btn-md btn-flat btn-success btn_rld">
                <i class="fa fa-refresh"></i> <span class="hidden-sm hidden-xs">Refresh</span>
            </a>
        </div>
        <div class="box box-solid">
            <div class="box-header bg-black with-border">
                <h3 class="box-title"><i class="fa fa-table"></i> <?php echo $template_title_module; ?> <?php echo lang_text('label_table') ?></h3>
            </div>


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
                    <label>Search Keywords</label>
                    <input type="text" class="form-control" id="filter_search" name="filter_search" value="" placeholder="Search Keywords"/>
                </div>

            </div>

            <div class="box-body">
                <form id="form-tbl" onsubmit="return false;" method="post">
                    <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                    <table id="data_tables" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                        <tr class="bg-gray">
                            <th width="1%">
                                <input name="select_all" value="1" type="checkbox">
                            </th>
                            <th width="1%">ID</th>
                            <th>Business Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Reg.Number</th>
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