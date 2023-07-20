var CSRF_HASH = CSRF_JSON;

$(document).ready(function () {
    select_generate_dropdown_ajax(
        "#parent",
        "Choose Items Categories Parent",
        "mod_dropdown/general_dropdown/pcs_communities_categories/id/data_name",
        data_output_result.parent
    );
});