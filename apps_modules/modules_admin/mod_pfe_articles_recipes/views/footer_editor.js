var CSRF_HASH = CSRF_JSON;

$(document).ready(function () {


	select_generate_dropdown_ajax(
		"#users_id",
		"Choose Users",
		"mod_dropdown/general_dropdown/users/id/name_full",
		data_output_result.users_id
	);
	select_generate_dropdown_ajax(
		"#pbd_business_id",
		"Choose Business",
		"mod_dropdown/general_dropdown/pbd_business/id/data_name",
		data_output_result.pbd_business_id
	);

	select_multiple_generate_dropdown_ajax(
		"#data_categories_recipes",
		"Choose Categories",
		"mod_dropdown/general_multiple_dropdown/pfe_recipes_categories/id/data_name",
		data_output_result.data_categories
	);

	select_multiple_generate_dropdown_ajax(
		"#recipes_cuisines",
		"Choose Cuisines",
		"mod_dropdown/general_multiple_dropdown/pfe_recipes_cuisines/id/data_name",
		data_output_result.data_categories
	);
});
