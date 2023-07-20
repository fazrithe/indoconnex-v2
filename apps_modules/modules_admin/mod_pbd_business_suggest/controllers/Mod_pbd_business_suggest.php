<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_admin.php';

class Mod_pbd_business_suggest extends Base_admin
{
	private   $module_page                  = [
		'index'         => 'index',
		'editor'        => 'editor',
		'detail'        => 'detail',
		'table'         => 'table',
		'index_footer'  => 'footer_index',
		'editor_footer' => 'footer_editor',
		'detail_footer' => 'footer_detail',
	];
	protected $module_url_default           = 'mod_pbd_business';
	protected $module_base                  = 'mod_pbd_business';
	protected $module_table                 = 'pbd_business_suggestions';
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
		 * "pbd_business" => array(
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
		 * "pbd_business" => array(
		 *  "table"  => "pbd_business",
		 *  "key_pk" => "id",
		 *  "key_fk" => "pbd_business_id",
		 *  "column" => array(
		 *     "pbd_business.id as category_id",
		 *     "pbd_business.data_name as category_name"
		 *  )
		 * )
		 */
		/* -------------------------------------------------------- */];
	protected $module_upload_path           = 'public/uploads/pbd_business/';

	public function __construct()
	{
		parent::__construct();
		$this->apps_title_module = 'Suggest Pages';
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
		$this->form_validation->set_rules("data_name", "Name {$this->apps_title_module}", 'required');
		/* $this->form_validation->set_rules("data_description", "Description {$this->apps_title_module}", 'required'); */
	}

	public function index()
	{
		$data = [];
		$this->display($this->module_page['index'], $data, $this->module_page['index_footer']);
	}

	public function table()
	{
		$FORMAT_STATUS = [
			0 =>
				'<a href="javascript:void(0)" class="btn_sts" data-id="" data-status="1">' .
				'<label class="label label-warning"><i class="fa fa-circle" style="font-size: 6px; vertical-align: middle"></i> &nbsp; Pending</label>' .
				'</a',
			1 =>
				'<a href="javascript:void(0)" class="btn_sts" data-id="" data-status="0">' .
				'<label class="label label-success"><i class="fa fa-circle" style="font-size: 6px; vertical-align: middle"></i> &nbsp; Approve</label>' .
				'</a>',
		];
		$FORMAT_BUTTON = $this->load->view('index_btn_action_suggest', ['id' => 1], true);

		$parameter_select  = [
			"pbd_business_suggestions.id as no",
			"pbd_business_suggestions.id",
			'data_name',
			'data_description',
			'users.username as users_id',
			'DATE_FORMAT(pbd_business_suggestions.created_at, "%d/%m/%Y %H:%i")',
			'DATE_FORMAT(pbd_business_suggestions.updated_at, "%d/%m/%Y %H:%i")',
			'status_page',
			"CASE WHEN pbd_business_suggestions.status = 0 THEN '{$FORMAT_STATUS[0]}' ELSE '{$FORMAT_STATUS[1]}' END AS status",
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
			
			$this->db->join('users','users.id = pbd_business_suggestions.users_id'); 
			$this->db->group_start();
			$this->db->where($parameter_where);
			$this->db->group_end();
		}
		if (!empty($parameter_orderby)) {
			
			$this->db->join('users','users.id = pbd_business_suggestions.users_id'); 
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
					$data['output_result']['published'] = date('d/m/Y H:i:s', strtotime($data['output_result']['published']));
					$data_location                      = (!empty($data['output_result']['data_locations'])) ? (array) json_decode($data['output_result']['data_locations']) : array();

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

	public function detail($parameter_id = null)
	{
		$data = [
			'template_title_module_action' => 'detail',
			'output_result'                => [],
			'output_result_json'           => [],
		];

		$this->apps_breadcrumb[] = [
			'title' => ucwords("{$data['template_title_module_action']}"),
			'link'  => base_url($this->module_url_default) . '/detail/' . $parameter_id,
		];

		$data['output_result'] = [];
		if ($parameter_id != '') {
			$parameter_where[$this->module_table_id] = $parameter_id;
			$data['output_result']                   = $this->db->get_where($this->module_table, $parameter_where)->row_array();

			if (!empty($data['output_result'])) {
				$data['output_result']['published'] = date('d/m/Y H:i:s', strtotime($data['output_result']['published']));
				$data_location                      = (!empty($data['output_result']['data_locations'])) ? (array) json_decode($data['output_result']['data_locations']) : array();

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
		$this->display($this->module_page['detail'], $data, $this->module_page['detail_footer']);

	}
}
