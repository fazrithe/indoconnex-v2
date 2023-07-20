var CSRF_HASH = CSRF_JSON;

$(document).ready(function () {
        select_generate_dropdown_ajax(
		"#users_id",
		"Choose Users",
		"mod_dropdown/general_dropdown/users/id/name_full",
		data_output_result.users_id
	);
	select_multiple_generate_dropdown_ajax(
		"#data_categories",
		"Choose Categories",
		"mod_dropdown/general_multiple_dropdown/pcs_communities_categories/id/data_name",
		data_output_result.data_categories
	);
});