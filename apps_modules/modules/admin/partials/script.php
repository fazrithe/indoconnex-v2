<script type="text/javascript" src="<?php echo theme_admin_locations(); ?>bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo theme_admin_locations(); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo theme_admin_locations(); ?>dist/js/adminlte.min.js"></script>
<script type="text/javascript" src="<?php echo theme_admin_locations(); ?>custom/js/moment.min.js"></script>
<!-- Extra Resources For Website -->
<script type="text/javascript" src="<?php echo theme_admin_locations(); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo theme_admin_locations(); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo theme_admin_locations(); ?>bower_components/datatables.net/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript" src="<?php echo theme_admin_locations(); ?>bower_components/datatables.net-bs/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo theme_admin_locations(); ?>custom/plugins/sweetalert/sweetalert2.min.js"></script>
<script type="text/javascript" src="<?php echo theme_admin_locations(); ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Custom Image Preview -->
<script type="text/javascript" src="<?php echo theme_admin_locations(); ?>custom/plugins/bootstrap-imageupload/js/jasny-bootstrap.min.js"></script>
<!-- Custom Date -->
<script type="text/javascript" src="<?php echo theme_admin_locations(); ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo theme_admin_locations(); ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Mask Money -->
<script type="text/javascript" src="<?php echo theme_admin_locations(); ?>bower_components/jquery-maskmoney/jquery.maskMoney.js"></script>

<script type="text/javascript">
    var BASE_URL = '<?php echo base_url(); ?>';
    var CURRENT_URL = '<?php echo current_url(); ?>';
    var MODULE_URL = '<?php echo $template['partials_module_name']; ?>';
    var AJAX_ERROR_TITLE = '<?php echo AJAX_ERROR_TITLE; ?>';
    var AJAX_ERROR_MESSAGE = '<?php echo AJAX_ERROR_MESSAGE; ?>';
    var CSRF_JS =  <?php echo $CSRF_JS; ?>;
    var CSRF_JSON = '<?php echo $CSRF_JSON; ?>';
    var CSRF_HASH = '<?php echo $CSRF_JSON; ?>';
    var data_output_result = [];
    var data_output_parameter = "<?php echo $this->uri->segment(2); ?>";
    var data_output_result = <?php echo((!empty($output_result_json) ? $output_result_json : json_encode([]))); ?>;
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $.ajaxSetup({data: <?php echo $CSRF_JS; ?>, timeout: 50000});
        $.ajaxSetup({type: 'POST', data: <?php echo $CSRF_JS; ?>, timeout: 50000});
    });


    $(document).ready(function () {
        $('.summernote').summernote({
            placeholder: 'Description',
            fontSizeUnits: ['px'],
            tabsize: 2,
            height: 300,
            toolbar: [
                // ['fontsize', ['fontsize']],
                // ['font', ['bold', 'underline', 'clear']],
                // ['para', ['ul', 'ol', 'paragraph']],
                // ['table', ['table']],
                // ['insert', ['link']],
                // ['height', ['height']],
                // ['view', ['fullscreen', 'codeview']]
                ['style', ['style']],
                //   ['fontsize', ['fontsize']],
                ['font', ['bold', 'italic', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']],
                //   ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                // ['insert', ['link', 'picture', 'video']],
                ['insert', ['link', 'video']],
                //   ['insert', ['link']],
                    ['height', ['height']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
<script type="text/javascript" src="<?php echo theme_admin_locations(); ?>custom/js/custom.js"></script>
