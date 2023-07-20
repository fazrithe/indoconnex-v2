<?php

require 'vendor/autoload.php';

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_admin.php';

class Mod_inject_business extends Base_admin
{

	public function index()
	{
		if ($_POST) {
			$this->do_import();
		} else {

			$data['CSRF']      = $this->csrf;
			$data['CSRF_JSON'] = "&{$this->csrf['name']}={$this->csrf['hash']}";
			$data['CSRF_JS']   = $this->csrf_js;
			$this->load->view('index', $data);
		}
	}

	public function do_import()
	{
		echo '<pre>';
		print_r($_FILES);

		$output                   = null;
		$data_import              = array();
		$output_filename          = 'userfile';
		$output_filename_tempname = 'tmp_name';
		$excel_active_sheet       = 0;
		$excel_object             = $this->import_init($output_filename, $output_filename_tempname);
		$excel_lastrow            = $excel_object->getActiveSheet()->getHighestRow();

		$data_insert_string = array();

		$ordering_i = 0;
		for ($i = 2; $i <= $excel_lastrow; $i++) {
			$import_business_name           = $excel_object->getSheet($excel_active_sheet)->getCell("B{$i}")->getValue();
			$import_business_type_id        = $excel_object->getSheet($excel_active_sheet)->getCell("C{$i}")->getValue();
			$import_business_categories_id  = $excel_object->getSheet($excel_active_sheet)->getCell("D{$i}")->getValue();
			$import_business_description    = $excel_object->getSheet($excel_active_sheet)->getCell("E{$i}")->getValue();
			$import_business_country_id     = $excel_object->getSheet($excel_active_sheet)->getCell("F{$i}")->getValue();
			$import_business_state_id       = $excel_object->getSheet($excel_active_sheet)->getCell("G{$i}")->getValue();
			$import_business_city_id        = $excel_object->getSheet($excel_active_sheet)->getCell("H{$i}")->getValue();
			$import_business_address        = $excel_object->getSheet($excel_active_sheet)->getCell("I{$i}")->getValue();
			$import_business_email          = $excel_object->getSheet($excel_active_sheet)->getCell("J{$i}")->getValue();
			$import_business_phone          = $excel_object->getSheet($excel_active_sheet)->getCell("K{$i}")->getValue();
			$import_business_whour          = $excel_object->getSheet($excel_active_sheet)->getCell("L{$i}")->getValue();
			$import_business_facilities     = $excel_object->getSheet($excel_active_sheet)->getCell("M{$i}")->getValue();
			$import_business_number_of_team = $excel_object->getSheet($excel_active_sheet)->getCell("N{$i}")->getValue();
			$import_business_payment_method = $excel_object->getSheet($excel_active_sheet)->getCell("O{$i}")->getValue();

			if (!empty($import_business_name)) {
				$get_country                = $this->db->select('name')->get_where('loc_countries', array('id' => $import_business_country_id))->row_array();
				$get_state                  = $this->db->select('name')->get_where('loc_states', array('id' => $import_business_country_id))->row_array();
				$get_city                   = $this->db->select('name')->get_where('loc_cities', array('id' => $import_business_country_id))->row_array();
				$import_business_location[] = array(
					'country_id'   => $import_business_country_id,
					'country_name' => (!empty($get_country)) ? $get_country['name'] : '',
					'state_id'     => $import_business_state_id,
					'state_name'   => (!empty($get_state)) ? $get_state['name'] : '',
					'city_id'      => $import_business_city_id,
					'city_name'    => (!empty($get_city)) ? $get_city['name'] : '',
				);

				$data_import[$ordering_i]        = [
					'id'               => $this->generate_new_id_string(),
					'created_by'       => 999,
					'created_at'       => date('Y-m-d H:i:s'),
					'updated_by'       => 999,
					'updated_at'       => date('Y-m-d H:i:s'),
					'published'        => date('Y-m-d H:i:s'),
					'status'           => 1,
					'data_name'        => $import_business_name,
					'data_description' => $import_business_description,
					'bd_email'         => $import_business_email,
					'bd_phone'         => $import_business_phone,
					'bd_address'       => $import_business_address,
					'bd_hours_work'    => $import_business_whour,
					'bd_paymentmethod' => $import_business_payment_method,
					'bd_team_number'   => $import_business_number_of_team,
					'data_categories'  => json_encode((array) $import_business_categories_id),
					'data_types'       => json_encode((array) $import_business_type_id),
					'data_locations'   => json_encode($import_business_location),
					'data_facilities'  => json_encode((array) $import_business_facilities),

				];
				$data_insert_string[$ordering_i] = $this->db->insert_string('pbd_business', $data_import[$ordering_i]);
				$ordering_i++;
			}
		}

		$data_insert_string_implode = '';
		if (!empty($data_insert_string)) {
			$data_insert_string_implode = implode(';', $data_insert_string);
			$data_insert_string_implode = $data_insert_string_implode . ';';
		}

		echo '<Pre>';
//		print_r($data_import);
		echo $data_insert_string_implode;
		exit();


//		if (!empty($data_import)) {
//			$this->{$this->module_model}->add_data_batch($this->module_table, $data_import);
//		}
//		$this->db->trans_complete();
//		if ($this->db->trans_status() === TRUE) {
//
//			$log_message = LOG_IMPORT . " data success.";
//
//			$output = $this->output_message('alert', 'success', ['status' => true], $this->module_title, 'add');
//		} else {
//
//			$output = $this->output_message('alert', 'error', ['status' => true], $this->module_title, 'add');
//		}


	}

	protected function import_init($output_filename = null, $output_filename_tempname = null)
	{
		set_time_limit(-1);
		ini_set('memory_limit', '256M');
		$this->load->library('PHPExcel-1.8/Classes/PHPExcel');

		$output_filename_temporary = $_FILES[$output_filename][$output_filename_tempname];
		$excel_reader              = PHPExcel_IOFactory::createReaderForFile($output_filename_temporary);
		$excel_reader->setReadDataOnly(true);
		$excel_object = $excel_reader->load($output_filename_temporary);
		return $excel_object;
	}


}
