var CSRF_HASH = CSRF_JSON;

$(document).ready(function () {
    select_generate_dropdown_ajax(
        "#parent",
        "Choose Business partnership Types Parent",
        "mod_dropdown/general_dropdown/pbd_business_partnership_types/id/data_name",
        data_output_result.parent
    );
});