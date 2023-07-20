var CSRF_HASH = CSRF_JSON;

$(document).ready(function () {

	select_data_dropdown_to_element_multiple(
		"#data_categories",
		"Choose Categories Business",
		"mod_dropdown/general_multiple_dropdown/pbd_business_categories/id/data_name",
		data_output_result.data_categories
	);

	select_data_dropdown_to_element_multiple(
		"#data_facilities",
		"Choose Business Facilities",
		"mod_dropdown/general_multiple_dropdown/mst_facilities/id/data_name",
		data_output_result.data_facilities
	);

	select_data_dropdown_to_element_multiple(
		"#data_types",
		"Choose type",
		"mod_dropdown/general_multiple_dropdown/pbd_business_types/id/data_name",
		data_output_result.data_types
	);

	select_data_dropdown_to_element(
		"#country_id",
		"Choose Countries",
		"mod_dropdown/general_dropdown/loc_countries/id/name",
		data_output_result.country_id
	);

	select_data_dropdown_to_element(
		"#state_id",
		"Choose States",
		"mod_dropdown/general_dropdown/loc_states/id/name",
		data_output_result.state_id,
		"#country_id"
	);

	select_data_dropdown_to_element(
		"#city_id",
		"Choose City",
		"mod_dropdown/general_dropdown/loc_cities/id/name",
		data_output_result.city_id,
		"#state_id"
	);
});
