var CSRF_HASH = CSRF_JSON;

$(document).ready(function () {
    select_generate_dropdown_ajax(
        "#parent",
        "Choose Business Categories Parent",
        "mod_dropdown/general_dropdown/pbd_business_categories/id/data_name",
        data_output_result.parent
    );
});