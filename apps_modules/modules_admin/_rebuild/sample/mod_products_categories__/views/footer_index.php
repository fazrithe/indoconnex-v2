<script type="text/javascript">
    var dataTableVar = null;
    var CSRF_HASH = '<?php echo $CSRF_JSON; ?>';

    table_refresh()

    $('body').on('click', '.btn_rld', function () {
        table_refresh();
    });

    $('body').on('click', '.btn_add', function () {
        window.location.href = CURRENT_URL + '/add';
    });

    $('body').on('click', '.btn_edt', function () {
        var data_id = $(this).attr('data-id');
        window.location.href = CURRENT_URL + '/edit/' + data_id;
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

    function table_refresh() {
        $("#data-show-table").load(CURRENT_URL + "/table", function () {
            dataTableVar = $('#dTabtable').DataTable();
        });
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