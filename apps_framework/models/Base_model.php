<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Base_model extends CI_Model
{
	protected $default_lang_id = 1;
	protected $default_lang_pr = '';

	public function __construct()
	{
		parent::__construct();
	}

	public function add_data($tabel, $data)
	{
		if (empty($tabel) || empty($data))
			return false;
		return $this->db->insert($tabel, $data);
	}

	// public function add_data_business($tabel, $data)
	// {
	// 	if (empty($tabel) || empty($data))
	// 		return false;
	// 		$text = substr($data['bd_maps'], 37);
	// 		$url = substr($data['bd_maps'], 0, 37);
	// 		$text_replace = str_replace(' ', '%20', $text);
	// 		$text_replace_t = str_replace(':', '%3A', $text_replace);
	// 		$text_replace_n = str_replace('&', '%26', $text_replace_t);
	// 		$bd_map = $url.''.$text_replace_n;
	// 		$data_business = [
	// 		'id'	=> random_string('alnum',20),
	// 		'data_categories' => $data['data_categories'],
	// 		'data_types' => $data['data_types'],
	// 		'data_name' => $data['data_name'],
	// 		'data_username' => $data['data_username'],
	// 		'data_description' => $data['data_description'],
	// 		'data_facilities' => $data['data_facilities'],
	// 		'bd_regnumber' => $data['bd_regnumber'],
	// 		'bd_email' => $data['bd_email'],
	// 		'bd_phone' => $data['bd_phone'],
	// 		'data_locations' => $data['data_locations'],
	// 		'bd_address' => $data['bd_address'],
	// 		'bd_address_zipcode' => $data['bd_address_zipcode'],
	// 		'bd_hours_open' => $data['bd_hours_open'],
	// 		'bd_hours_work' => $data['bd_hours_work'],
	// 		'bd_paymentmethod' => $data['bd_paymentmethod'],
	// 		'bd_team_number' => $data['bd_team_number'],
	// 		'bd_annual_sales' => $data['bd_annual_sales'],
	// 		'bd_established_year' => $data['bd_established_year'],
	// 		'bd_established_date' => $data['bd_established_date'],
	// 		'bd_main_markets' => $data['bd_main_markets'],
	// 		'data_contact_info' => $data['data_contact_info'],
	// 		'data_social_links' => $data['data_social_links'],
	// 		'published' => $data['published'],
	// 		'status' => $data['status'],
	// 		'bd_maps'	=>  $bd_map,
	// 	];
	
	// 	return $this->db->insert($tabel, $data_business);

	// }

	public function add_data_batch($tabel, $data)
	{
		if (empty($tabel) || empty($data))
			return false;
		return $this->db->insert_batch($tabel, $data);
	}

	public function update_data_batch($tabel, $data, $kolom)
	{
		if (empty($tabel) || empty($data))
			return false;
		return $this->db->update_batch($tabel, $data, $kolom);
	}

	public function update_data($tabel, $kolom, $id = null, $data)
	{
		if (empty($tabel) || empty($data) || empty($kolom) || empty($id)) {
			return false;
		}

		if (is_array($kolom)) {
			foreach ($kolom as $index => $row) {
				$this->db->where($row, $id[$row]);
			}
		} else {
			if ($id != '') {
				$this->db->where($kolom, $id[$kolom]);
			} else {
				$this->db->where($kolom);
			}
		}
		return $this->db->update($tabel, $data);
	}

	public function delete_data($tabel, $parameter)
	{
		if (empty($tabel) or empty($parameter))
			return false;
		return $this->db->delete($tabel, $parameter);
	}

	public function delete_data_batch($tabel, $selection, $parameter)
	{
		if (empty($tabel) or empty($parameter))
			return false;
		$this->db->where_in($selection, $parameter);
		return $this->db->delete($tabel);
	}

	public function get_db_error_message()
	{
		$string    = '';
		$get_error = $this->db->error();
		switch ($get_error['code']):
			case 1451:
				$string = 'Data sudah digunakan di tabel lain. Silahkan cek kembali';
				break;
			default:
				$string = $get_error['message'];
				break;
		endswitch;
		return $string;
	}

	/* GET LAST ID AFTER ACTION INSERT */
	public function last_id()
	{
		return $this->db->insert_id();
	}

	/* USE FOR GET COLUMN NAME FROM TABLE DATABASE */
	public function show_table_column($params = null)
	{
		$sql   = 'SHOW COLUMNS FROM ' . $params;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
	}
}
