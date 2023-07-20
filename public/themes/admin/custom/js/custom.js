/** Select 2 for custom dropdown with search column */
$('.select2').select2({width: '100%'});
$('.select2multiple').select2({width: '100%', "multiple": true, "closeOnSelect": true});

$(document.body).on('hide.bs.modal', function () {
    $('body').css('padding-right', '0');
});
$(document.body).on('hidden.bs.modal', function () {
    $('body').css('padding-right', '0');
});

/** Date time picker for choose date without time format */
$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    changeMonth: true,
    changeYear: true,
    autoclose: true
});

/** Date time picker for choose date with time format */
$('.datetimepicker').daterangepicker({
    singleDatePicker: true,
    autoclose: true,
    changeMonth: true,
    changeYear: true,
    timePicker: true,
    timePicker24Hour: true,
    /* timePickerIncrement: 30, */
    locale: {format: 'DD/MM/YYYY H:mm'}
});


$(document).ready(function () {
    $.ajaxSetup({data: CSRF_JS});
    $.ajaxSetup({type: 'POST', data: CSRF_JS});
});

function updateDataTableSelectAllCtrl(table) {
    var $table = dataTableVar.table().node();
    var $chkbox_all = $('tbody input[type="checkbox"]', $table);
    var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
    var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);

    // If none of the checkboxes are checked
    if ($chkbox_checked.length === 0) {
        chkbox_select_all.checked = false;
        if ('indeterminate' in chkbox_select_all) {
            chkbox_select_all.indeterminate = false;
        }
        // If all of the checkboxes are checked
    } else if ($chkbox_checked.length === $chkbox_all.length) {
        chkbox_select_all.checked = true;
        if ('indeterminate' in chkbox_select_all) {
            chkbox_select_all.indeterminate = false;
        }
        // If some of the checkboxes are checked
    } else {
        chkbox_select_all.checked = true;
        if ('indeterminate' in chkbox_select_all) {
            chkbox_select_all.indeterminate = true;
        }
    }
}


function change_ordering(data) {
    if (Object.keys(data).length > 0) {
        $.ajax({
            url: CURRENT_URL + "/table_reorder",
            type: "POST",
            dataType: 'json',
            data: {parameter_order: data},
        })
            .done(function (data) {
                if (data.status == true) {
                    readyForDraw = true
                    dataTableVar.ajax.reload(null, false)
                }
            })
            .fail(function () {
                console.log('Something wrong');
            })
            .always(function () {
            });
    }
}