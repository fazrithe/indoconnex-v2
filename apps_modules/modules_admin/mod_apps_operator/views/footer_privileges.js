var CSRF_HASH = CSRF_JSON;
$(document).ready(function () {
        /* HANDLE CLICK ON "SELECT ALL" CONTROL */
        $('thead input[name="select_all"]').on('click', function (e) {
            if (this.checked) {
                $('tbody input[type="checkbox"]').prop("checked", true);
            } else {
                $('tbody input[type="checkbox"]').prop('checked', false);
            }
            /* Prevent click event from propagating to parent */
            e.stopPropagation();
        });
        
        $('.select_all_list').on('click', function (e) {
            if (this.checked) {
                $('input[id=list-'+$(this).attr("data-id")+']').prop("checked", true); 
                $('input[id=add-'+$(this).attr("data-id")+']').prop("checked", true); 
                $('input[id=edit-'+$(this).attr("data-id")+']').prop("checked", true); 
                $('input[id=delete-'+$(this).attr("data-id")+']').prop("checked", true); 
            } else {
                $('input[id=list-'+$(this).attr("data-id")+']').prop('checked', false); 
                $('input[id=add-'+$(this).attr("data-id")+']').prop('checked', false); 
                $('input[id=edit-'+$(this).attr("data-id")+']').prop('checked', false); 
                $('input[id=delete-'+$(this).attr("data-id")+']').prop('checked', false); 
            }
        });
    })