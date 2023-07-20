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
		"#data_categories",
		"Choose Categories",
		"mod_dropdown/general_multiple_dropdown/pbt_tender_categories/id/data_name",
		data_output_result.data_categories
	);

	select_multiple_generate_dropdown_ajax(
		"#data_types",
		"Choose Types",
		"mod_dropdown/general_multiple_dropdown/pbt_tender_types/id/data_name",
		data_output_result.data_types
	);


	select_generate_dropdown_ajax(
		"#country_id",
		"Choose Countries",
		"mod_dropdown/general_dropdown/loc_countries/id/name",
		data_output_result.country_id
	);

	select_generate_dropdown_ajax(
		"#state_id",
		"Choose States",
		"mod_dropdown/general_dropdown/loc_states/id/name",
		data_output_result.state_id,
		"#country_id"
	);

	select_generate_dropdown_ajax(
		"#city_id",
		"Choose City",
		"mod_dropdown/general_dropdown/loc_cities/id/name",
		data_output_result.city_id,
		"#state_id"
	);
});
