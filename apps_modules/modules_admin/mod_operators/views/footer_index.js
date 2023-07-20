var dataTableVar = null;
var rows_selected = [];
var editor = null;
var readyForDraw = true;
var CSRF_HASH = CSRF_JSON;
$(document).ready(function () {
    dataTableVar = $('#data_tables').DataTable({
        "autoWidth": true,
        "processing": true,
        "deferRender": true,
        "searchDelay": 500,
        "ajax": CURRENT_URL + '/' + 'table',
        "order": [[2, "asc"]],
        "language": {
            'processing': '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
        'columnDefs': [
            {
                'targets': 0, 'visible': true, 'orderable': false,
                "render": function (data, type, row, meta) {
                    /*  return meta.row + meta.settings._iDisplayStart + 1 +*/
                    return '' +
                        '<input type="hidden" name="id" value="' + data + '">' +
                        '<input type="checkbox" name="checkbox[]" value="' + data + '">';
                }
            },
            {'targets': 1, 'orderable': false, 'visible': false},
            {'targets': 7, 'orderable': false},
        ],
    });

    $('#filter_search').on('keyup', function () {
        dataTableVar.search(this.value).draw();
    });

    $('#filter_length').on('change', function () {
        dataTableVar.page.len($(this).val()).draw();
    });

    /* HANDLE CLICK ON CHECKBOX */
    $('#data_tables tbody').on('click', 'input[type="checkbox"]', function (e) {
        var $row = $(this).closest('tr');
        /* Get row data */
        var data = dataTableVar.row($row).data();
        /* Get row ID */
        var rowId = data[0];
        /* Determine whether row ID is in the list of selected row IDs */
        var index = $.inArray(rowId, rows_selected);
        /* if checkbox is checked and row ID is not in list of selected row IDs */
        if (this.checked && index === -1) {
            rows_selected.push(rowId);
            /* Otherwise, if checkbox is not checked and row ID is in list of selected row IDs */
        } else if (!this.checked && index !== -1) {
            rows_selected.splice(index, 1);
        }
        if (this.checked) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }
        /* Update state of "Select all" control */
        updateDataTableSelectAllCtrl(dataTableVar);
        /* Prevent click event from propagating to parent */
        e.stopPropagation();
    });

    /* HANDLE CLICK ON "SELECT ALL" CONTROL */
    $('thead input[name="select_all"]', dataTableVar.table().container()).on('click', function (e) {
        if (this.checked) {
            $('#data_tables tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#data_tables tbody input[type="checkbox"]:checked').trigger('click');
        }
        /* Prevent click event from propagating to parent */
        e.stopPropagation();
    });

    /* HANDLE TABLE DRAW EVENT */
    dataTableVar.on('draw', function () {
        /* Update state of "Select all" control */
        updateDataTableSelectAllCtrl(dataTableVar);
    });
});


/** BUTTON - ACTION REFRESH DATA TABLE */
$('#btn_widget').on('click', '.btn_rld', function () {
    dataTableVar.ajax.reload();
});

/** BUTTON - ACTION ADD DATA */
$('body').on('click', '.btn_add', function () {
    window.location.href = CURRENT_URL + '/add';
});

/** BUTTON - ACTION EDIT DATA */
$('body').on('click', '.btn_edt', function () {
    var data_id = $(this).parents('tr').find('input').eq(0).val();
    window.location.href = CURRENT_URL + '/edit/' + data_id;
});

/** BUTTON - ACTION DELETE DATA */
$('body').on('click', '.btn_dlt', function () {
    var data_id = $(this).attr('data-id');
    method_delete(data_id);
});

/** BUTTON - ACTION STATUS UPDATE DATA */
$('body').on('click', '.btn_sts', function () {
    var data_id = $(this).parents('tr').find('input').eq(0).val();
    var data_status = $(this).attr('data-status');
    method_status(data_id, data_status);
});
/** BUTTON - ACTION STATUS UPDATE DATA */
$('body').on('click', '.btn_cbx', function () {
    var data_form = '#form-tbl';
    var data_id = $(this).parents('tr').find('input').eq(0).val();
    var data_status = $(this).attr('data-status');
    if ($(' input[type="checkbox"]:checked').length === 0) {
        Swal.fire(AJAX_ERROR_TITLE, 'Please select data with checkboxes before submit !', 'error');
    } else {
        Swal.fire({
            title: "Are you sure <strong>BATCH</strong> update status the data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update status now!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: CURRENT_URL + '/status_process_checkbox',
                    type: "POST",
                    data: $(data_form).serialize() + '&data_status=' + data_status + CSRF_HASH,
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
});