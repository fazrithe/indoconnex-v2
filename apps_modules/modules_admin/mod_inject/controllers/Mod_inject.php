<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_admin.php';

class Mod_inject extends Base_admin
{

	public function index()
	{

	}

	public function change_business_address_location($parameter_table_name = null)
	{
		set_time_limit(-1);
		ini_set('memory_limit', '256M');

		$data_insert = array();
		$get_data    = $this->db->get_where($parameter_table_name)->result_array();
		if (!empty($get_data)) {
			$index_numbering = 1;
			foreach ($get_data as $index => $row) {
				$data_locations = (!empty($row['data_locations'])) ? $row['data_locations'] : '';
				if (!empty($data_locations)) {
					$data_locations = (array) json_decode($data_locations);
					if (!empty($data_locations[0])) {
						$data_locations = $data_locations[0];
					}

					if (is_array($data_locations)) {
						if (!empty($data_locations['province_id'])) {
							$data_locations['state_id'] = $data_locations['province_id'];
							unset($data_locations['province_id']);
						}
						if (!empty($data_locations['province_name'])) {
							$data_locations['state_name'] = $data_locations['province_name'];
							unset($data_locations['province_name']);
						}
					}

					$data_locations_array = json_encode(array($data_locations));
				} else {
					$data_locations_array = json_encode(array());
				}


				$this->db->set('data_locations', $data_locations_array);
				$this->db->where('id', $row['id']);
				$this->db->update($parameter_table_name);

				echo 'DATA with ID ' . $row['id'] . ' success transform';
				echo '<br/>';
			}
		}
	}

	public
	function inject_bod_categories()
	{
		set_time_limit(-1);
		ini_set('memory_limit', '256M');

		$DB_newest = $this->load->database('default', TRUE);
		$DB_oldest = $this->load->database('default_old', TRUE);

		$data_insert        = array();
		$data_insert_string = array();
		$data_parent        = '210302603DED01D41B7';
		$get_data_old       = $DB_oldest->get_where('categories', array('parent' => $data_parent))->result_array();
		if (!empty($get_data_old)) {
			$index_numbering = 1;
			foreach ($get_data_old as $index => $row) {
				$get_data_old_lang          = $DB_oldest->get_where('categories_lang', array('categories_id' => $row['id'], 'acs_lang_id' => 'LGEN'))->row_array();
				$data_insert[$index]        = array(
					'id'               => $row['id'],
					'data_position'    => $index_numbering,
					'published'        => $row['published'],
					'data_name'        => $get_data_old_lang['title'],
					'data_permalinks'  => $get_data_old_lang['slug'],
					'data_description' => $get_data_old_lang['description'],
					'created_at'       => $row['ctd'],
					'updated_at'       => $row['mdd'],
					'inj_log'          => 'bod-items-categories'
				);
				$data_insert_string[$index] = $this->db->insert_string('pbd_business_categories', $data_insert[$index]);
				$index_numbering++;
			}
		}

		$data_insert_string_implode = '';
		if (!empty($data_insert_string)) {
			$data_insert_string_implode = implode(';', $data_insert_string);
			$data_insert_string_implode = $data_insert_string_implode . ';';
		}

		echo '<Pre>';
//		print_r($data_insert);
		echo $data_insert_string_implode;
		exit();
	}

	public
	function inject_bod()
	{
		$DB_newest = $this->load->database('default', TRUE);
		$DB_oldest = $this->load->database('default_old', TRUE);

	}

	public
	function inject_bod_items_categories()
	{
		set_time_limit(-1);
		ini_set('memory_limit', '256M');

		$DB_newest = $this->load->database('default', TRUE);
		$DB_oldest = $this->load->database('default_old', TRUE);

		$data_insert        = array();
		$data_insert_string = array();
		$data_parent        = '210302603DED0B33242';
		$get_data_old       = $DB_oldest->get_where('categories', array('parent' => $data_parent))->result_array();
		if (!empty($get_data_old)) {
			$index_numbering = 1;
			foreach ($get_data_old as $index => $row) {
				$get_data_old_lang          = $DB_oldest->get_where('categories_lang', array('categories_id' => $row['id'], 'acs_lang_id' => 'LGEN'))->row_array();
				$data_insert[$index]        = array(
					'id'               => $row['id'],
					'data_position'    => $index_numbering,
					'published'        => $row['published'],
					'data_name'        => $get_data_old_lang['title'],
					'data_permalinks'  => $get_data_old_lang['slug'],
					'data_description' => $get_data_old_lang['description'],
					'created_at'       => $row['ctd'],
					'updated_at'       => $row['mdd'],
					'inj_log'          => 'bod-items-categories'
				);
				$data_insert_string[$index] = $this->db->insert_string('pbd_items_categories', $data_insert[$index]);
				$index_numbering++;
			}
		}

		$data_insert_string_implode = '';
		if (!empty($data_insert_string)) {
			$data_insert_string_implode = implode(';', $data_insert_string);
			$data_insert_string_implode = $data_insert_string_implode . ';';
		}

		echo '<Pre>';
//		print_r($data_insert);
		echo $data_insert_string_implode;
		exit();
	}

	public
	function inject_bod_items()
	{
		set_time_limit(-1);
		ini_set('memory_limit', '256M');

		$DB_newest = $this->load->database('default', TRUE);
		$DB_oldest = $this->load->database('default_old', TRUE);

		$data_insert        = array();
		$data_insert_string = array();
//		$DB_oldest->limit(1);
		$get_data_old = $DB_oldest->get_where('post_bod_product')->result_array();
		if (!empty($get_data_old)) {
			$index_ordering = 1;
			foreach ($get_data_old as $index => $row) {
				$get_data_old_lang = $DB_oldest->get_where('post_bod_product_lang', array('post_id' => $row['id'], 'acs_lang_id' => 'LGEN'))->row_array();
				$get_data_old_imgs = $DB_oldest->get_where('post_bod_product_image', array('post_id' => $row['id']))->row_array();
				if (!empty($get_data_old_lang['title'])) {
					$product_json           = (!empty($row['data_info'])) ? json_decode($row['data_info']) : null;
					$product_type           = '';
					$product_price_low      = '';
					$product_price_low      = '';
					$product_price_high     = '';
					$product_price_status   = '';
					$product_min_order_from = '';
					$product_min_order_to   = '';

					if (!empty($product_json)) {
						$product_json           = (array) $product_json;
						$product_type           = (!empty($product_json['product_type'])) ? $product_json['product_type'] : '';
						$product_price_low      = (!empty($product_json['product_price_low'])) ? $product_json['product_price_low'] : '';
						$product_price_high     = (!empty($product_json['product_price_high'])) ? $product_json['product_price_high'] : '';
						$product_price_status   = (!empty($product_json['product_price_status'])) ? $product_json['product_price_status'] : '';
						$product_min_order_from = (!empty($product_json['product_min_order_from'])) ? $product_json['product_min_order_from'] : '';
						$product_min_order_to   = (!empty($product_json['product_min_order_to'])) ? $product_json['product_min_order_to'] : '';
					}

					$data_insert[$index]        = array(
						'id'                     => $row['id'],
						'published'              => $row['published'],
						'data_categories'        => $row['data_categories'],
						'data_name'              => $get_data_old_lang['title'],
						'data_permalinks'        => $get_data_old_lang['slug'],
						'data_short_description' => $get_data_old_lang['short_description'],
						'data_description'       => $get_data_old_lang['description'],
						'data_locations'         => $row['data_location'],
						'data_type'              => $product_type,
						'price_low'              => (empty($product_price_low)) ? 0 : $product_price_low,
						'price_high'             => (empty($product_price_high)) ? 0 : $product_price_high,
						'status_price_display'   => ($product_price_status == 'minimum') ? 1 : 0,
						'file_path'              => (!empty($get_data_old_imgs['file_location'])) ? $get_data_old_imgs['file_location'] : null,
						'file_name_thumbnail'    => (!empty($get_data_old_imgs['file_thumb'])) ? $get_data_old_imgs['file_thumb'] : null,
						'file_name_original'     => (!empty($get_data_old_imgs['file_original'])) ? $get_data_old_imgs['file_original'] : null,
						'created_at'             => $row['ctd'],
						'updated_at'             => $row['mdd'],
						'inj_log'                => 'bod-items'
					);
					$data_insert_string[$index] = $this->db->insert_string('pbd_items', $data_insert[$index]);

					$index_ordering++;
				}
			}
		}

		$data_insert_string_implode = '';
		if (!empty($data_insert_string)) {
			$data_insert_string_implode = implode(';', $data_insert_string);
			$data_insert_string_implode = $data_insert_string_implode . ';';
		}

		echo '<Pre>';
//		print_r($data_insert);
		echo $data_insert_string_implode;
		exit();
	}

	public
	function inject_info_center_categories()
	{
		set_time_limit(-1);
		ini_set('memory_limit', '256M');

		$DB_newest = $this->load->database('default', TRUE);
		$DB_oldest = $this->load->database('default_old', TRUE);

		$data_insert        = array();
		$data_insert_string = array();
		$data_parent        = '210302603DEE1CC8E84';
		$get_data_old       = $DB_oldest->get_where('categories', array('parent' => $data_parent))->result_array();
		if (!empty($get_data_old)) {
			$index_numbering = 1;
			foreach ($get_data_old as $index => $row) {
				$get_data_old_lang          = $DB_oldest->get_where('categories_lang', array('categories_id' => $row['id'], 'acs_lang_id' => 'LGEN'))->row_array();
				$data_insert[$index]        = array(
					'id'               => $row['id'],
					'data_position'    => $index_numbering,
					'published'        => $row['published'],
					'data_name'        => $get_data_old_lang['title'],
					'data_permalinks'  => $get_data_old_lang['slug'],
					'data_description' => $get_data_old_lang['description'],
					'created_at'       => $row['ctd'],
					'updated_at'       => $row['mdd'],
					'inj_log'          => 'info-center-categories'
				);
				$data_insert_string[$index] = $this->db->insert_string('pnu_news_categories', $data_insert[$index]);
				$index_numbering++;
			}
		}

		$data_insert_string_implode = '';
		if (!empty($data_insert_string)) {
			$data_insert_string_implode = implode(';', $data_insert_string);
			$data_insert_string_implode = $data_insert_string_implode . ';';
		}

		echo '<Pre>';
//		print_r($data_insert);
		echo $data_insert_string_implode;
		exit();
	}

	public
	function inject_info_center()
	{
		set_time_limit(-1);
		ini_set('memory_limit', '256M');

		$DB_newest = $this->load->database('default', TRUE);
		$DB_oldest = $this->load->database('default_old', TRUE);

		$data_insert        = array();
		$data_insert_string = array();
		$get_data_old       = $DB_oldest->get_where('post_inc')->result_array();
		if (!empty($get_data_old)) {
			$index_ordering = 1;
			foreach ($get_data_old as $index => $row) {
				$get_data_old_lang = $DB_oldest->get_where('post_inc_lang', array('post_id' => $row['id'], 'acs_lang_id' => 'LGEN'))->row_array();
				$get_data_old_imgs = $DB_oldest->get_where('post_inc_image', array('post_id' => $row['id']))->row_array();
				if (!empty($get_data_old_lang['title'])) {
					$data_insert[$index]        = array(
						'id'                     => $row['id'],
						'data_type'              => 'business',
						'published'              => $row['published'],
						'data_categories'        => $row['data_categories'],
						'data_name'              => $get_data_old_lang['title'],
						'data_permalinks'        => $get_data_old_lang['slug'],
						'data_short_description' => $get_data_old_lang['short_description'],
						'data_description'       => $get_data_old_lang['description'],
						'data_locations'         => $row['data_location'],
						'file_path'              => (!empty($get_data_old_imgs['file_location'])) ? $get_data_old_imgs['file_location'] : null,
						'file_name_thumbnail'    => (!empty($get_data_old_imgs['file_thumb'])) ? $get_data_old_imgs['file_thumb'] : null,
						'file_name_original'     => (!empty($get_data_old_imgs['file_original'])) ? $get_data_old_imgs['file_original'] : null,
						'created_at'             => $row['ctd'],
						'updated_at'             => $row['mdd'],
						'inj_log'                => 'info-center'
					);
					$data_insert_string[$index] = $this->db->insert_string('pnu_news', $data_insert[$index]);

					$index_ordering++;
				}
			}
		}

		$data_insert_string_implode = '';
		if (!empty($data_insert_string)) {
			$data_insert_string_implode = implode(';', $data_insert_string);
			$data_insert_string_implode = $data_insert_string_implode . ';';
		}

		echo '<Pre>';
//		print_r($data_insert);
		echo $data_insert_string_implode;
		exit();
	}

	public
	function inject_poi_categories()
	{
		set_time_limit(-1);
		ini_set('memory_limit', '256M');

		$DB_newest = $this->load->database('default', TRUE);
		$DB_oldest = $this->load->database('default_old', TRUE);

		$data_insert        = array();
		$data_insert_string = array();
		$data_parent        = '210302603DED4E4AD8C';
		$get_data_old       = $DB_oldest->get_where('categories', array('parent' => $data_parent))->result_array();
		if (!empty($get_data_old)) {
			$index_numbering = 1;
			foreach ($get_data_old as $index => $row) {
				$get_data_old_lang          = $DB_oldest->get_where('categories_lang', array('categories_id' => $row['id'], 'acs_lang_id' => 'LGEN'))->row_array();
				$data_insert[$index]        = array(
					'id'               => $row['id'],
					'data_position'    => $index_numbering,
					'published'        => $row['published'],
					'data_name'        => $get_data_old_lang['title'],
					'data_permalinks'  => $get_data_old_lang['slug'],
					'data_description' => $get_data_old_lang['description'],
					'created_at'       => $row['ctd'],
					'updated_at'       => $row['mdd'],
					'inj_log'          => 'point-of-interest-categories'
				);
				$data_insert_string[$index] = $this->db->insert_string('pbd_items_categories', $data_insert[$index]);
				$index_numbering++;
			}
		}

		$data_insert_string_implode = '';
		if (!empty($data_insert_string)) {
			$data_insert_string_implode = implode(';', $data_insert_string);
			$data_insert_string_implode = $data_insert_string_implode . ';';
		}

		echo '<Pre>';
//		print_r($data_insert);
		echo $data_insert_string_implode;
		exit();
	}

	public
	function inject_poi()
	{
		set_time_limit(-1);
		ini_set('memory_limit', '256M');

		$DB_newest = $this->load->database('default', TRUE);
		$DB_oldest = $this->load->database('default_old', TRUE);

		$data_insert        = array();
		$data_insert_string = array();
		$get_data_old       = $DB_oldest->get_where('post_poi')->result_array();
		if (!empty($get_data_old)) {
			$index_ordering = 1;
			foreach ($get_data_old as $index => $row) {
				$get_data_old_lang = $DB_oldest->get_where('post_poi_lang', array('post_id' => $row['id'], 'acs_lang_id' => 'LGEN'))->row_array();
				$get_data_old_imgs = $DB_oldest->get_where('post_poi_image', array('post_id' => $row['id']))->row_array();
				if (!empty($get_data_old_lang['title'])) {
					$data_insert[$index]        = array(
						'id'                     => $row['id'],
						'published'              => $row['published'],
						'data_categories'        => $row['data_categories'],
						'data_name'              => $get_data_old_lang['title'],
						'data_permalinks'        => $get_data_old_lang['slug'],
						'data_short_description' => $get_data_old_lang['short_description'],
						'data_description'       => $get_data_old_lang['description'],
						'data_locations'         => $row['data_location'],
						'file_path'              => (!empty($get_data_old_imgs['file_location'])) ? $get_data_old_imgs['file_location'] : null,
						'file_name_thumbnail'    => (!empty($get_data_old_imgs['file_thumb'])) ? $get_data_old_imgs['file_thumb'] : null,
						'file_name_original'     => (!empty($get_data_old_imgs['file_original'])) ? $get_data_old_imgs['file_original'] : null,
						'created_at'             => $row['ctd'],
						'updated_at'             => $row['mdd'],
						'inj_log'                => 'point-of-interest'
					);
					$data_insert_string[$index] = $this->db->insert_string('pbd_items', $data_insert[$index]);

					$index_ordering++;
				}
			}
		}

		$data_insert_string_implode = '';
		if (!empty($data_insert_string)) {
			$data_insert_string_implode = implode(';', $data_insert_string);
			$data_insert_string_implode = $data_insert_string_implode . ';';
		}

		echo '<Pre>';
//		print_r($data_insert);
		echo $data_insert_string_implode;
		exit();

	}

}
