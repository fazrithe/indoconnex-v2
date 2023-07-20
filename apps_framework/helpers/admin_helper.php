<?php

function select_data_element_show($parameter_option_array = null, $parameter_option_selected = null, $parameter_placeholder = null, $parameter_name = null, $parameter_default_empty = false)
{
	$output_option_set = '';
	if ($parameter_default_empty == false) {
		$output_option_set = '';
	}
	if (!empty($parameter_option_array)) {
		foreach ($parameter_option_array as $index => $row) {
			$option_id   = $row['id'];
			$option_text = $row['text'];
			if (!empty($parameter_option_selected)) {
				if (is_array($parameter_option_selected)) {
					if (isset($parameter_option_selected[$parameter_name])) {
						if ($option_id == $parameter_option_selected[$parameter_name]) {
							$output_option_set = "{$option_text}";
						}
					}
				}
			}
		}
	}
	return $output_option_set;
}

function select_dropdown_generate_option($parameter_option_array = null, $parameter_option_selected = null, $parameter_placeholder = null, $parameter_name = null, $parameter_default_empty = false)
{
	$template_option_start = '<option value="">';
	$template_option_end   = '</option>';
	$output_option_set     = [];
	if ($parameter_default_empty == false) {
		$output_option_set = [
			$template_option_start . 'Choose' . ' ' . $parameter_placeholder . $template_option_end,
		];
	}
	if (!empty($parameter_option_array)) {
		foreach ($parameter_option_array as $index => $row) {
			$option_id       = $row['id'];
			$option_text     = $row['text'];
			$option_select     = $row['selected'];
			$option_selected = '';
			if (!empty($parameter_option_selected)) {
				if (is_array($parameter_option_selected)) {
					if (isset($parameter_option_selected[$parameter_name])) {
						$option_selected = ($option_id == $parameter_option_selected[$parameter_name]) ? 'selected' : '';
					}
				} else {
					$option_selected = ($option_id == $parameter_option_selected) ? 'selected' : '';
				}
			}
			$output_option_set[] = "<option value='{$option_id}' {$option_selected} {$option_select}>{$option_text}</option>";
		}
	}

	$output_option_set = implode('', $output_option_set);
	return $output_option_set;
}

function format_date_day($date_index = null)
{
	$hari = array(
		1 => 'Monday',
		2 => 'Tuesday',
		3 => 'Wednesday',
		4 => 'Thursday',
		5 => 'Friday',
		6 => 'Saturday',
		7 => 'Sunday',
	);
	return $hari[$date_index];
}
