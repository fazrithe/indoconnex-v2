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
            <!-- /.box-header -->
            <div class="box-body">
<!--                <div id="data-show-table"></div>-->
                <div id="result"></div>
                <table id="data_tables" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                    <tr class="bg-gray">
                        <th class="text-uppercase" width="1%">
                            <input name="select_all" value="1" type="checkbox">
                        </th>
                        <th width="1%">No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date Active</th>
                        <th width="1%">Status</th>
                        <th width="1%">#</th>
                    </tr>
                    </thead>
                </table>


            </div>
        </div>

    </div>
</div>