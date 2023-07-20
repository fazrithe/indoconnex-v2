var CSRF_HASH = CSRF_JSON;

$(document).ready(function () {
    select_generate_dropdown_ajax(
        "#parent",
        "Choose Recipe Cuisines Parent",
        "mod_dropdown/general_dropdown/pfe_recipes_cuisines/id/data_name",
        data_output_result.parent
    );
});
