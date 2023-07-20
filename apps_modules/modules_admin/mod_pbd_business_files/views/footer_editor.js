var CSRF_HASH = CSRF_JSON;

$(document).ready(function () {
	select_generate_dropdown_ajax(
		"#pbd_business_id",
		"Choose Business",
		"mod_dropdown/general_dropdown/pbd_business/id/data_name",
		data_output_result.pbd_business_id
	);

	select_generate_dropdown_ajax(
		"#pbd_business_files_categories_id",
		"Choose type",
		"mod_dropdown/general_dropdown/pbd_business_files_categories/id/data_name",
		data_output_result.pbd_business_files_categories_id
	);
});
