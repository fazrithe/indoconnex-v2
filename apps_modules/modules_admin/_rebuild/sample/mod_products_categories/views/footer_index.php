<script type="text/javascript">
    var dataTableVar = null;
    var CSRF_HASH = '<?php echo $CSRF_JSON; ?>';

    table_refresh();

    $('body').on('click', '.btn_rld', function () {
        table_refresh();
    });

    $('body').on('click', '.btn_add', function () {
        method_add();
    });

    $('body').on('click', '.btn_edt', function () {
        var data_id = $(this).attr('data-id');
        method_edit(data_id);
    });

    $('body').on('click', '.btn_dlt', function () {
        var data_id = $(this).attr('data-id');
        method_delete(data_id);
    });
    $('body').on('click', '.btn_sts', function () {
        var data_id = $(this).attr('data-id');
        var data_status = $(this).attr('data-status');
        method_status(data_id, data_status);
    });

    $('body').on('click', '.btn_rst', function () {
        method_add();
    });

    function table_refresh() {
        $("#data-show-table").load(CURRENT_URL + "/table", function () {
            dataTableVar = $('#dTabtable').DataTable(
            );
        });
    }

    function method_add() {
        method_add_start();
        method_init_column();
    }

    function method_edit(parameter_id) {
        method_edit_start();
        method_init_column();

        var var_form = '#form-action';
        $.ajax({
            url: CURRENT_URL + '/detail',
            type: "POST",
            data: 'data_id=' + parameter_id + CSRF_HASH,
            timeout: 5000,
            dataType: "JSON",
            success: function (response) {
                if (response.status) {
                    method_edit_set_data(var_form, response.data);
                } else {
                    Swal.fire(
                        AJAX_ERROR_TITLE,
                        AJAX_ERROR_MESSAGE,
                        'error'
                    );
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire(
                    AJAX_ERROR_TITLE,
                    AJAX_ERROR_MESSAGE,
                    'error'
                );
            }
        });
    }

    function method_init_column() {
        $('#form-action [name="id"]').val('');
        $('#form-action [name="name"]').val('');
        $('#form-action [name="status"]').val('');
        $('#form-action [name="published"]').val('');
    }

    function method_add_start() {
        $('#form-title-action').html('Add');
        $('#form-title-icon').html('<i class="fa fa-plus-circle"></i>');
        $('#form-title-box').removeClass('bg-orange');
        $('#form-title-box').removeClass('bg-blue');
        $('#form-title-box').addClass('bg-blue');
        $('#form-action').attr('action', CURRENT_URL + '/add_process');
    }

    function method_edit_start() {
        $('#form-title-action').html('Edit');
        $('#form-title-icon').html('<i class="fa fa-edit"></i>');
        $('#form-title-box').removeClass('bg-orange');
        $('#form-title-box').removeClass('bg-blue');
        $('#form-title-box').addClass('bg-orange');
        $('#form-action').attr('action', CURRENT_URL + '/edit_process');
    }

    function method_edit_set_data(parameter_element, parameter_data) {
        $(parameter_element + ' [name="id"]').val(parameter_data.id);
        $(parameter_element + ' [name="data_name"]').val(parameter_data.data_name);
        $(parameter_element + ' [name="data_description"]').val(parameter_data.data_description);
        $(parameter_element + ' [name="status"]').val(parameter_data.status);
        $(parameter_element + ' [name="status"]').val(parameter_data.status).trigger('change');
        $(parameter_element + ' [name="published"]').val(parameter_data.published);
    }

    function method_delete(parameter_id) {
        Swal.fire({
            title: "Are you sure delete the data?",
            text: "Deleted data cannot be recovered!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: CURRENT_URL + '/delete_process',
                    type: "POST",
                    data: 'data_id=' + parameter_id + CSRF_HASH,
                    timeout: 5000,
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire(
                                response.title,
                                response.message,
                                'success'
                            ).then(function () {
                                window.location.href = CURRENT_URL;
                            });

                        } else {
                            Swal.fire(
                                response.title,
                                response.message,
                                'error'
                            ).then(function () {
                                window.location.href = CURRENT_URL;
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        Swal.fire(
                            AJAX_ERROR_TITLE,
                            AJAX_ERROR_MESSAGE,
                            'error'
                        );
                    }
                });
            }
        });
    }


    function method_status(parameter_id, parameter_status) {
        Swal.fire({
            title: "Are you sure update status the data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update status now!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: CURRENT_URL + '/status_process',
                    type: "POST",
                    data: 'data_id=' + parameter_id + '&data_status=' + parameter_status + CSRF_HASH,
                    timeout: 5000,
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire(
                                response.title,
                                response.message,
                                'success'
                            ).then(function () {
                                window.location.href = CURRENT_URL;
                            });

                        } else {
                            Swal.fire(
                                response.title,
                                response.message,
                                'error'
                            ).then(function () {
                                window.location.href = CURRENT_URL;
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        Swal.fire(
                            AJAX_ERROR_TITLE,
                            AJAX_ERROR_MESSAGE,
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>