var CSRF_HASH = CSRF_JSON;

$(document).ready(function () {
	select_generate_dropdown_ajax(
		"#parent",
		"Choose News Categories Parent",
		"mod_dropdown/general_dropdown/pnu_news_categories/id/data_name",
		data_output_result.parent
	);
});