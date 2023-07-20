var CSRF_HASH = CSRF_JSON;

$(document).ready(function () {
    select_generate_dropdown_ajax(
        "#parent",
        "Choose Job Industries Parent",
        "mod_dropdown/general_dropdown/pcj_jobs_industries/id/data_name",
        data_output_result.parent
    );
});