var CSRF_HASH = CSRF_JSON;
$(document).ready(function () {
	select_generate_dropdown_ajax(
		"#parent",
		"Choose Parent",
		"mod_dropdown/general_dropdown/apps_menus/id/menu_name",
		data_output_result.parent
	);
});