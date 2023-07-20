var dataTableVar = null;
var rows_selected = [];
var editor = null;
var readyForDraw = true;
var CSRF_HASH = CSRF_JSON;
$(document).ready(function () {
    dataTableVar = $('#data_tables').DataTable({

        "autoWidth": true,
        "processing": true,
        "serverSide": true,
        "searchDelay": 500,
        "ajax": {
            "url": CURRENT_URL + '/table',
            "type": "POST"
        },
        "ordering": true,
        "order": [
            [2, "ASC"],
        ],
        /*
        "iDisplayLength": 10,
        'rowCallback': function (row, data, dataIndex) {
            var rowId = data[0];
            if ($.inArray(rowId, rows_selected) !== -1) {
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');
            }
        },
        */

        "columns": [
            {
                "visible": false, "width": "1%", "orderable": false,
                // "data": "data_position",
                "render": function (data, type, row, meta) {
                    return '<input type="checkbox" name="' + row.id + '[]" value="' + data + '">';
                }
            },
            {
                "visible": true, "width": "1%", "orderable": true, 'className': 'reorder',
                // "data": "data_position",
                "render": function (data, type, row, meta) {
                    // return row.data_position;
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {"visible": true, "data": "data_name"},
            {"visible": true, "data": "data_description"},
            {"visible": true, "data": "published", "width": "10%"},
            {
                "visible": true, "width": "1%",
                "render": function (data, type, row, meta) {
                    var html = '';
                    if (row.status === '0') {
                        html = '' +
                            '<a href="javascript:void(0)" class="btn_sts" data-id="' + row.id + '" data-status="1">' +
                            '<label class="label label-danger">Not Active</label>' +
                            '</a';
                    } else {
                        html = '' +
                            '<a href="javascript:void(0)" class="btn_sts" data-id="' + row.id + '" data-status="0">' +
                            '<label class="label label-success">Active</label>' +
                            '</a';
                    }
                    return html;
                }
            },
            {
                "visible": true, "width": "10%",
                "render": function (data, type, row, meta) {
                    var html = '';
                    if (row.status_disable === '0') {
                        html = '' +
                            '<a href="javascript:void(0)" class="btn_std" data-id="' + row.id + '" data-status="1">' +
                            '<label class="label label-danger">Can\'t Deleted</label>' +
                            '</a';
                    } else {
                        html = '' +
                            '<a href="javascript:void(0)" class="btn_std" data-id="' + row.id + '" data-status="0">' +
                            '<label class="label label-success">Can be Deleted</label>' +
                            '</a';
                    }
                    return html;
                }
            },
            {
                "render": function (data, type, row, meta) {
                    var html_id = row.id;
                    var html_button = '<div class="dropdown">' +
                        '<button class="btn btn-default btn-flat btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                        '<i class="fa fa-gear"></i>' +
                        '<span class="caret"></span>' +
                        '</button>' +

                        '<ul class="dropdown-menu dropdown-menu-right">' +
                        '<li><a href="javascript:void(0)" data-id="' + html_id + '" class="btn_edt"><i class="fa fa-pencil"></i> Edit</a></li>' +
                        '<li><a href="javascript:void(0)" data-id="' + html_id + '" class="btn_dlt"><i class="fa fa-trash"></i> Delete</a></li>' +
                        '</ul>' +
                        '</div>';
                    return html_button;
                }
            }
        ],
        /*
        "rowReorder": {
            'selector': '.reorder',
            'dataSrc': 'data_position',
            'editor': editor,
            'update': true
        },
        "preDrawCallback": function () {
            return readyForDraw;
        }
        */
    });

    /*
    dataTableVar.on('row-reorder', function (e, diff, edit) {
        readyForDraw = false
        var data = {};
        for (var i = 0, ien = diff.length; i < ien; i++) {
            edit.triggerRow.data()['data_position'];
            var rowData = dataTableVar.row(diff[i].node).data();
            data[rowData['id']] = diff[i].newData
            if (i === (diff.length - 1)) {
                change_ordering(data)
            }
        }
    });
    */

    /* BUTTON - BUTTON RELOAD DATATABLE */
    $('#btn_widget').on('click', '.btn_rld', function () {
        dataTableVar.ajax.reload();
    });
});

$(function () {

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

    $('body').on('click', '.btn_std', function () {
        var data_id = $(this).attr('data-id');
        var data_status = $(this).attr('data-status');
        method_status_disable(data_id, data_status);
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

    function method_status_disable(parameter_id, parameter_status) {
        Swal.fire({
            title: "Are you sure update status disable the data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update status now!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: CURRENT_URL + '/status_disable_process',
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
});