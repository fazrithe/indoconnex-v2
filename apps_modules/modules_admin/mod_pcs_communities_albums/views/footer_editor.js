var CSRF_HASH = CSRF_JSON;

$(document).ready(function () {
	select_generate_dropdown_ajax(
		"#user_id",
		"Choose Users",
		"mod_dropdown/general_dropdown/users/id/name_full",
		data_output_result.user_id
	);
	select_generate_dropdown_ajax(
		"#pcs_communities_id",
		"Choose Communities",
		"mod_dropdown/general_dropdown/pcs_communities/id/data_name",
		data_output_result.pcs_communities_id
	);

//	select_generate_dropdown_ajax(
//		"#users_albums_categories_id",
//		"Choose Albums Categories",
//		"mod_dropdown/general_dropdown/users_albums_categories/id/data_name",
//		data_output_result.users_albums_categories_id
//	);
});
