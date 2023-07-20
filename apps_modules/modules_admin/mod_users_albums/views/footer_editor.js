var CSRF_HASH = CSRF_JSON;

$(document).ready(function () {
	select_generate_dropdown_ajax(
		"#users_id",
		"Choose Users",
		"mod_dropdown/general_dropdown/users/id/name_full",
		data_output_result.users_id
	);
//	select_generate_dropdown_ajax(
//		"#pbd_business_id",
//		"Choose Business",
//		"mod_dropdown/general_dropdown/users_albums/id/data_name",
//		data_output_result.pbd_business_id
//	);

	select_generate_dropdown_ajax(
		"#users_albums_categories_id",
		"Choose Albums Categories",
		"mod_dropdown/general_dropdown/users_albums_categories/id/data_name",
		data_output_result.users_albums_categories_id
	);
});
