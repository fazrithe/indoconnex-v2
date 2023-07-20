<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_dropdown extends CI_Controller
{

	protected function is_request_ajax()
	{
		if (!$this->input->is_ajax_request()) {
			$output = [
				'status'  => false,
				'message' => 'No access allowed',
			];
			return $this->output->set_output(json_encode($output));
		}
	}

	public function general_dropdown(
		$parameter_table = null,
		$parameter_option_value = null,
		$parameter_option_text = null,
		$parameter_option_selected = null,
		$parameter_sortby_column_set = null,
		$parameter_sortby_column_sort = null
	)
	{
		$this->is_request_ajax();

		$array_dropdown = [];
		if ($this->input->get('default') == 'true') {
			$this->db->where("{$parameter_option_value}", $this->input->post('data_id'));
			if ($parameter_option_text != '') {
				$this->db->select("{$parameter_option_value} as id");
			}
			if ($parameter_option_value != '') {
				$this->db->select("{$parameter_option_text} as text");
			}
		} else {
			if ($parameter_option_text != '') {
				$this->db->select("{$parameter_option_value} as id");
			}
			if ($parameter_option_value != '') {
				$this->db->select("{$parameter_option_text} as text");
				$this->db->like($parameter_option_text, $this->input->post('q'));
			}

			if ($this->input->post('p') != '' && $this->input->post('p_n') != '') {
				$this->db->where(str_replace('#', '', $this->input->post('p_n')), $this->input->post('p'));
			}

			if (!empty($parameter_sortby_column_set)) {
				if (empty($parameter_sortby_column_sort)) {
					$this->db->order_by($parameter_sortby_column_set);
				} else {
					$this->db->order_by($parameter_sortby_column_set, $parameter_sortby_column_sort);
				}
			} else {
				$this->db->order_by("{$parameter_option_text}", "ASC");
			}

		}
		$query = $this->db->get($parameter_table);
		if (!empty($query)) {
			if ($this->input->get('default') == 'true') {
				$result = $query->row_array();
			} else {
				$result = $query->result_array();
			}
			$query->free_result();

			$array_dropdown['items'] = $result;
		} else {
			$array_dropdown['items'] = [];
		}
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($array_dropdown))
		;
	}

	public function general_multiple_dropdown(
		$parameter_table = null,
		$parameter_option_value = null,
		$parameter_option_text = null,
		$parameter_option_selected = null,
		$parameter_sortby_column_set = null,
		$parameter_sortby_column_sort = null
	)
	{
		$this->is_request_ajax();

		$array_dropdown = [];
		if ($this->input->get('default') == 'true') {
			$data_id = '';
			$data_id = json_decode($this->input->post('data_id'));
			if (empty($data_id)) {
				$data_id = $this->input->post('data_id');
			}
			
			$this->db->where_in("{$parameter_option_value}", $data_id);

			if ($parameter_option_text != '') {
				$this->db->select("{$parameter_option_value} as id");
			}
			if ($parameter_option_value != '') {
				$this->db->select("{$parameter_option_text} as text");
			}
		} else {
			if ($parameter_option_text != '') {
				$this->db->select("{$parameter_option_value} as id");
			}
			if ($parameter_option_value != '') {
				$this->db->select("{$parameter_option_text} as text");
				$this->db->like($parameter_option_text, $this->input->post('q'));
			}

			if (!empty($parameter_sortby_column_set)) {
				if (empty($parameter_sortby_column_sort)) {
					$this->db->order_by($parameter_sortby_column_set);
				} else {
					$this->db->order_by($parameter_sortby_column_set, $parameter_sortby_column_sort);
				}
			} else {
				$this->db->order_by("{$parameter_option_text}", "ASC");
			}

		}
		$query = $this->db->get($parameter_table);
		if (!empty($query)) {
			if ($this->input->get('default') == 'true') {
				$result = $query->result_array();
			} else {
				$result = $query->result_array();
			}
			$query->free_result();

			$array_dropdown['items'] = $result;
		} else {
			$array_dropdown['items'] = [];
		}
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($array_dropdown))
		;
	}
}
