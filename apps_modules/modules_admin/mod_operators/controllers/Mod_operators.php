<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_admin.php';

class Mod_operators extends Base_admin
{
	private   $module_page                  = array(
		'index'         => 'index',
		'editor'        => 'editor',
		'table'         => 'table',
		'index_footer'  => 'footer_index',
		'editor_footer' => 'footer_editor',
	);
	protected $module_url_default           = 'mod_operators';
	protected $module_base                  = 'mod_operators';
	protected $module_table                 = 'apps_operator';
	protected $module_table_id              = 'id';
	protected $module_duplicate_check       = array(
		/* -------------------------------------------------------- */
		/*
		 * Table is index , value is foreign key on table to check
		 * clear array if not use check chain
		 *
		 * 'column_to_check' => 'Label'
		 *
		 */
		/* -------------------------------------------------------- */
		//        "data_name" => "Name"
	);
	protected $module_duplicate_check_chain = array(
		/* -------------------------------------------------------- */
		/*
		 * Table is index , value is foreign key on table to check
		 * clear array if not use check chain
		 *
		 * 'table_name' => 'column_foreign_key on table'
		 *
		 */
		/* -------------------------------------------------------- */);
	protected $module_related_dropdown      = array(
		/* -------------------------------------------------------- */
		/*
		 * Table is index , value is foreign key on table to check
		 * clear array if not use check chain
		 *
		 * "operators" => array(
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
		/* -------------------------------------------------------- */);
	protected $module_related_join          = array(
		/* -------------------------------------------------------- */
		/*
		 * Table for select join. use on data function table to get data
		 *
		 * "operators" => array(
		 *  "table"  => "operators",
		 *  "key_pk" => "id",
		 *  "key_fk" => "operators_id",
		 *  "column" => array(
		 *     "operators.id as category_id",
		 *     "operators.data_name as category_name"
		 *  )
		 * )
		 */
		/* -------------------------------------------------------- */);
	protected $module_upload_path           = 'public/uploads/operators/';

	public function __construct()
	{
		parent::__construct();
		$this->apps_title_module = 'Administrator';
		$this->apps_breadcrumb[] = array(
			'title' => $this->apps_title_module,
			'link'  => base_url($this->module_url_default)
		);
	}

	protected function set_form_validation($ID = FALSE)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '<br/>');
		if ($ID) {
			$this->form_validation->set_rules("{$this->module_table_id}", "ID {$this->module_title}", 'required');
		}
		/* SET FORM VALIDATION RULES FOR COLUMN */
		$this->form_validation->set_rules("username", "Name {$this->apps_title_module}", 'required');
		$this->form_validation->set_rules("email", "Email {$this->apps_title_module}", 'required');
		$this->form_validation->set_rules("name_full", "Full Name {$this->apps_title_module}", 'required');
	}

	public function index()
	{
		$data = array();
		$this->display($this->module_page['index'], $data, $this->module_page['index_footer']);
	}

	public function table()
	{
		$FORMAT_STATUS = array(
			0 =>
			'<a href="javascript:void(0)" class="btn_sts" data-id="" data-status="1">' .
				'<label class="label label-danger"><i class="fa fa-circle" style="font-size: 6px; vertical-align: middle"></i> &nbsp; Not Active</label>' .
				'</a',
			1 =>
			'<a href="javascript:void(0)" class="btn_sts" data-id="" data-status="0">' .
				'<label class="label label-success"><i class="fa fa-circle" style="font-size: 6px; vertical-align: middle"></i> &nbsp;Active</label>' .
				'</a>',
		);
		$FORMAT_BUTTON = $this->load->view('index_btn_action', array('id' => 1), true);

		$parameter_select  = array(
			'id as no',
			"id",
			'username',
			'email',
			'name_full',
			'phone',
			"CASE WHEN status = 0 THEN '{$FORMAT_STATUS[0]}' ELSE '{$FORMAT_STATUS[1]}' END AS status",
			"'{$FORMAT_BUTTON}' as button",
		);
		$parameter_where   = array();
		$parameter_orderby = array(
			'username ASC',
		);

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
		$datatable_set    = array_map(function ($value) {

			$array_decrypt = array('email', 'name_full', 'phone');
			if (!empty($array_decrypt)) {
				foreach ($array_decrypt as $index => $row) {
					$value[$row] = func_decrypt($value[$row]);
				}
			}

			return array_values($value);
		}, $output_result->result_array());


		$output_array = array(
			'draw'            => "{$this->input->post('draw')}",
			'recordsTotal'    => $filtered_records,
			'recordsFiltered' => $filtered_records,
			'data'            => $datatable_set
		);
		$output_result->free_result();

		return $this->output->set_content_type('application/json')->set_output(json_encode($output_array));
	}

	public function add()
	{
		if ($this->is_request_post()) {
			$this->add_process();
		} else {
			$data = array(
				'template_title_module_action' => 'add'
			);

			$this->apps_breadcrumb[] = array(
				'title' => ucwords("{$data['template_title_module_action']}"),
				'link'  => base_url($this->module_url_default) . '/add'
			);

			$this->display($this->module_page['editor'], $data, $this->module_page['editor_footer']);
		}
	}

	public function edit($parameter_id = null)
	{
		if ($this->is_request_post()) {
			$this->edit_process();
		} else {
			$data = array(
				'template_title_module_action' => 'edit'
			);

			$this->apps_breadcrumb[] = array(
				'title' => ucwords("{$data['template_title_module_action']}"),
				'link'  => base_url($this->module_url_default) . '/add'
			);

			$data['output_result'] = array();
			if ($parameter_id != '') {
				$parameter_where[$this->module_table_id] = $parameter_id;
				$data['output_result']                   = $this->db->get_where($this->module_table, $parameter_where)->row_array();
			}

			$this->display($this->module_page['editor'], $data, $this->module_page['editor_footer']);
		}
	}

	private function action_operators_process()
	{
		if ($this->input->post('id') == '') {
			if ($this->input->post('password_create') == '' || $this->input->post('password_create') == '') {
				/** Password empty */
			} else {
				if ($this->input->post('password_create') != $this->input->post('password_confirm')) {
					/** Error create password*/
				} else {
					$password_hash     = password_hash($this->input->post('password_confirm'), PASSWORD_DEFAULT, array('cost' => 10));
					$password_hash     = func_encrypt($password_hash);
					$_POST['password'] = $password_hash;
				}
			}
		} else {
			if ($this->input->post('password_create') != '' && $this->input->post('password_confirm') != '') {
				$password_hash     = password_hash($this->input->post('password_confirm'), PASSWORD_DEFAULT, array('cost' => 10));
				$password_hash     = func_encrypt($password_hash);
				$_POST['password'] = $password_hash;
			}
		}

		if ($this->input->post('operators_access') != '') {
			$_POST['operators_access'] = func_encrypt(json_encode($this->input->post('operators_access')));
		}

		if ($this->input->post('email') != '') {
			$_POST['email'] = func_encrypt($this->input->post('email'));
		}
		if ($this->input->post('name_full') != '') {
			$_POST['name_full'] = func_encrypt($this->input->post('name_full'));
		}
		if ($this->input->post('name_nick') != '') {
			$_POST['name_nick'] = func_encrypt($this->input->post('name_nick'));
		}
		if ($this->input->post('phone') != '') {
			$_POST['phone'] = func_encrypt($this->input->post('phone'));
		}
		$_POST['title'] = url_title($this->input->post('username'));


		unset($_POST['password_create']);
		unset($_POST['password_confirm']);
	}

	public function add_process()
	{
		$parameter_url_source = $this->module_url_default . '/add';
		$this->action_operators_process();
		$this->action_add_process($parameter_url_source);
	}

	public function edit_process($parameter_id = null)
	{
		$parameter_url_source = $this->module_url_default . '/edit/' . $parameter_id;
		$this->action_operators_process();
		$this->action_edit_process($parameter_url_source, $parameter_id);
	}

	public function status_process($parameter_id = null)
	{
		$this->action_status_process($parameter_id);
	}

	public function status_process_checkbox()
	{
		$data_id     = $this->input->post('checkbox');
		$data_status = $this->input->post('data_status');

		if (is_array($data_id)) {
			if (!empty($data_id)) {
				foreach ($data_id as $index => $row) {
					$output_return = $this->action_status_process($row, $data_status, true);
				}
			}
		}

		$this->apps_output_message = array(
			'status'  => 'success',
			'title'   => lang_text('message_update_title_success'),
			'message' => "{$this->apps_title_module} " . lang_text('message_update_success')
		);

		$this->set_output_action($this->module_url_default);
	}

	public function status_disable_process($parameter_id = null)
	{
		$this->action_status_disable_process($parameter_id);
	}

	public function delete_process($parameter_id = null)
	{
		$this->action_delete_process($parameter_id);
	}

	public function delete_image_process($parameter_id = null)
	{
		$this->action_image_process_delete(
			$this->module_table,
			null,
			$this->module_table_id,
			$this->input->post($this->module_table_id),
			'update'
		);
	}
}
