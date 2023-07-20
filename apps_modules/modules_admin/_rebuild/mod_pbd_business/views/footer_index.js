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

$(function () {
    /* BUTTON - BUTTON RELOAD DATATABLE */
    $('#btn_widget').on('click', '.btn_rld', function () {
        dataTableVar.ajax.reload();
    });

    $('body').on('click', '.btn_rld', function () {
        dataTableVar.ajax.reload();
    });

    $('body').on('click', '.btn_add', function () {
        window.location.href = CURRENT_URL + '/add';
    });

    $('body').on('click', '.btn_edt', function () {
        var data_id = $(this).attr('data-id');
        window.location.href = CURRENT_URL + '/edit/' + data_id;
    });

	$('body').on('click', '.btn_dtl', function () {
        var data_id = $(this).attr('data-id');
        window.location.href = CURRENT_URL + '/detail/' + data_id;
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

    $('body').on('click', '.btn_std', function () {
        var data_id = $(this).attr('data-id');
        var data_status = $(this).attr('data-status');
        method_status_disable(data_id, data_status);
    });

});