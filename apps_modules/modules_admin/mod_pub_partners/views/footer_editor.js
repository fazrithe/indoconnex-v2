var CSRF_HASH = CSRF_JSON;

$(document).ready(function () {
    select_generate_dropdown_ajax(
        "#parent",
        "Choose Parent",
        "mod_dropdown/general_dropdown/pub_partners/id/data_name",
        data_output_result.parent
    );
});