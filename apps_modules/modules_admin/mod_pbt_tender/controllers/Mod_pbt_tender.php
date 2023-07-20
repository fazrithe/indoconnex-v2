<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_admin.php';

class Mod_pbt_tender extends Base_admin
{
	private   $module_page                  = [
		'index'         => 'index',
		'editor'        => 'editor',
		'table'         => 'table',
		'index_footer'  => 'footer_index',
		'editor_footer' => 'footer_editor',
	];
	protected $module_url_default           = 'mod_pbt_tender';
	protected $module_base                  = 'mod_pbt_tender';
	protected $module_table                 = 'pbt_tender';
	protected $module_table_id              = 'id';
	protected $module_duplicate_check       = [
		/* -------------------------------------------------------- */
		/*
		 * Table is index , value is foreign key on table to check
		 * clear array if not use check chain
		 *
		 * 'column_to_check' => 'Label'
		 *
		 */
		/* -------------------------------------------------------- */
		"data_name" => "Name",
	];
	protected $module_duplicate_check_chain = [
		/* -------------------------------------------------------- */
		/*
		 * Table is index , value is foreign key on table to check
		 * clear array if not use check chain
		 *
		 * 'table_name' => 'column_foreign_key on table'
		 *
		 */
		/* -------------------------------------------------------- */];
	protected $module_related_dropdown      = [
		/* -------------------------------------------------------- */
		/*
		 * Table is index , value is foreign key on table to check
		 * clear array if not use check chain
		 *
		 * "pbt_tender" => array(
		 *   "table"  => "table_name",
		 *   "label"  => "Label",
		 *   "name"   => "input_name",
		 *   "column" => array(
		 *     "id"   => "column_database_id",
		 *     "name" => "column_database_name"
		 *    )
		 * )
		 *
		 */
		/* -------------------------------------------------------- */];
	protected $module_related_join          = [
		/* -------------------------------------------------------- */
		/*
		 * Table for select join. use on data function table to get data
		 *
		 * "pbt_tender" => array(
		 *  "table"  => "pbt_tender",
		 *  "key_pk" => "id",
		 *  "key_fk" => "pbt_tender_id",
		 *  "column" => array(
		 *     "pbt_tender.id as category_id",
		 *     "pbt_tender.data_name as category_name"
		 *  )
		 * )
		 */
		/* -------------------------------------------------------- */];
	protected $module_upload_path           = 'public/uploads/pbt_tender/';

	public function __construct()
	{
		parent::__construct();
		$this->apps_title_module = 'Tender';
		$this->apps_breadcrumb[] = [
			'title' => $this->apps_title_module,
			'link'  => base_url($this->module_url_default),
		];
	}

	protected function set_form_validation($ID = false)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '<br/>');
		if ($ID) {
			$this->form_validation->set_rules("{$this->module_table_id}", "ID {$this->module_title}", 'required');
		}
		/* SET FORM VALIDATION RULES FOR COLUMN */
		$this->form_validation->set_rules("users_id", "Users {$this->apps_title_module}", 'required');
		$this->form_validation->set_rules("data_name", "Name {$this->apps_title_module}", 'required');
		/* $this->form_validation->set_rules("data_description", "Description {$this->apps_title_module}", 'required'); */
	}

	public function index()
	{
		$data = [];
		$this->load_extra_css('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css');
		$this->load_extra_js('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js');

		$this->display($this->module_page['index'], $data, $this->module_page['index_footer']);
	}

	public function table()
	{
		$FORMAT_STATUS = [
			0 =>
				'<a href="javascript:void(0)" class="btn_sts" data-id="" data-status="1">' .
				'<label class="label label-danger"><i class="fa fa-circle" style="font-size: 6px; vertical-align: middle"></i> &nbsp; Not Active</label>' .
				'</a',
			1 =>
				'<a href="javascript:void(0)" class="btn_sts" data-id="" data-status="0">' .
				'<label class="label label-success"><i class="fa fa-circle" style="font-size: 6px; vertical-align: middle"></i> &nbsp;Active</label>' .
				'</a>',
		];
		$FORMAT_BUTTON = $this->load->view('index_btn_action', ['id' => 1], true);

		$parameter_select  = [
			'id as no',
			"id",
			'data_name',
			'data_description',
			'DATE_FORMAT(created_at, "%d/%m/%Y %H:%i")',
			'DATE_FORMAT(updated_at, "%d/%m/%Y %H:%i")',
			"CASE WHEN status = 0 THEN '{$FORMAT_STATUS[0]}' ELSE '{$FORMAT_STATUS[1]}' END AS status",
			"'{$FORMAT_BUTTON}' as button",
		];
		$parameter_where   = [];
		$parameter_orderby = [
			'data_name ASC',
		];

		if ($this->input->post('filter_categories') != '') {
			$filter_categories = $this->input->post('filter_categories');
			$this->db->like('data_categories', $filter_categories);
		}

		$this->db->select($parameter_select);
		if (!empty($parameter_where)) {
			$this->db->group_start();
			$this->db->where($parameter_where);
			$this->db->group_end();
		}
		if (!empty($parameter_orderby)) {
			$this->db->order_by(implode(',', $parameter_orderby));
		}
		$output_result    = $this->db->get($this->module_table);
		$filtered_records = $output_result->num_rows();

		$datatable_set_decrypt = [];
		$datatable_set         = array_map(function ($value) {
			if (!empty($datatable_set_decrypt)) {
				foreach ($datatable_set_decrypt as $index => $row) {
					$value[$row] = func_decrypt($value[$row]);
				}
			}
			return array_values($value);
		}, $output_result->result_array());

		$output_array = [
			'draw'            => "{$this->input->post('draw')}",
			'recordsTotal'    => $filtered_records,
			'recordsFiltered' => $filtered_records,
			'data'            => $datatable_set,
		];
		$output_result->free_result();

		return $this->output->set_content_type('application/json')->set_output(json_encode($output_array));
	}

	public function add()
	{
		if ($this->is_request_post()) {
			$this->custom_process();

			$this->add_process();
		} else {
			$data = [
				'template_title_module_action' => 'add',
				'output_result'                => [],
			];

			$this->apps_breadcrumb[] = [
				'title' => ucwords("{$data['template_title_module_action']}"),
				'link'  => base_url($this->module_url_default) . '/add',
			];

			$this->load_extra_css('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css');
			$this->load_extra_js('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js');

			$this->display($this->module_page['editor'], $data, $this->module_page['editor_footer']);
		}
	}

	public function edit($parameter_id = null)
	{
		if ($this->is_request_post()) {
			$this->custom_process();

			$this->edit_process($parameter_id);
		} else {
			$data = [
				'template_title_module_action' => 'edit',
				'output_result'                => [],
				'output_result_json'           => [],
			];

			$this->apps_breadcrumb[] = [
				'title' => ucwords("{$data['template_title_module_action']}"),
				'link'  => base_url($this->module_url_default) . '/add',
			];

			$data['output_result'] = [];
			if ($parameter_id != '') {
				$parameter_where[$this->module_table_id] = $parameter_id;
				$data['output_result']                   = $this->db->get_where($this->module_table, $parameter_where)->row_array();

				if (!empty($data['output_result'])) {
					$data['output_result']['published']  = date('d/m/Y H:i:s', strtotime($data['output_result']['published']));
					$data['output_result']['date_open']  = date('d/m/Y H:i:s', strtotime($data['output_result']['date_open']));
					$data['output_result']['date_close'] = date('d/m/Y H:i:s', strtotime($data['output_result']['date_close']));

					$data_location = (!empty($data['output_result']['data_locations'])) ? (array) json_decode($data['output_result']['data_locations']) : array();

					if (!empty($data_location[0])) {
						$data_location = (array) $data_location[0];
					}

					$data['output_result']['country_id'] = null;
					$data['output_result']['state_id']   = null;
					$data['output_result']['city_id']    = null;
					if (!empty($data_location)) {
						if (!empty($data_location['state_id'])) {
							$data_location['state_id'] = $data_location['state_id'];
						}
						if (!empty($data_location['country_id'])) {
							$data['output_result']['country_id'] = $data_location['country_id'];
						}
						if (!empty($data_location['country_id'])) {
							$data['output_result']['country_id'] = $data_location['country_id'];
						}
						if (!empty($data_location['state_id'])) {
							$data['output_result']['state_id'] = $data_location['state_id'];
						}
						if (!empty($data_location['city_id'])) {
							$data['output_result']['city_id'] = $data_location['city_id'];
						}
					}


					$data['output_result_json'] = json_encode($data['output_result']);
				}
			}

			$this->load_extra_css('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css');
			$this->load_extra_js('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js');

			$this->display($this->module_page['editor'], $data, $this->module_page['editor_footer']);
		}
	}
}
