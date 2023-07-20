<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_admin.php';

class Mod_apps_menus extends Base_admin
{

	private   $module_page                  = array(
		'index'         => 'index',
		'editor'        => 'editor',
		'table'         => 'table',
		'index_footer'  => 'footer_index',
		'editor_footer' => 'footer_editor',
	);
	protected $module_url_default           = 'mod_apps_menus';
	protected $module_base                  = 'mod_apps_menus';
	protected $module_table                 = 'apps_menus';
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
		"menu_name" => "Menu"
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
		 * "apps_menus" => array(
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
		 * "apps_menus" => array(
		 *  "table"  => "apps_menus",
		 *  "key_pk" => "id",
		 *  "key_fk" => "apps_menus_id",
		 *  "column" => array(
		 *     "apps_menus.id as category_id",
		 *     "apps_menus.data_name as category_name"
		 *  )
		 * )
		 */
		/* -------------------------------------------------------- */);
	protected $module_upload_path           = 'public/uploads/apps_menus/';

	public function __construct()
	{
		parent::__construct();
		$this->apps_title_module = 'Menus';
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
		$this->form_validation->set_rules("menu_name", "Name {$this->apps_title_module}", 'required');
		$this->form_validation->set_rules("menu_link", "Link {$this->apps_title_module}", 'required');
	}

	public function index()
	{
		$data = array();
		$this->display($this->module_page['index'], $data, $this->module_page['index_footer']);
	}

	private function get_menu_recursive($parent = 0, $result = [], $prefix = '')
	{
		$output = $result;
		$result = $this->get_menu_by_parent($parent, $prefix);
		if (count($result) > 0) {
			foreach ($result as $index => $row) {
				$output[] = $row;
				if ($this->get_menu_by_parent($row[$this->module_table_id], '', true) > 0) {
					if ($prefix == '') {
						$prefix = '--';
					} else {
						$prefix = "{$prefix}-";
					}
					$output = $this->get_menu_recursive($row[$this->module_table_id], $output, $prefix);
				}
			}
		}
		return $output;
	}

	private function get_menu_by_parent($parent = 0, $prefix = '', $counted_mode = false)
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
		$title         = "CONCAT('{$prefix}', a.menu_name) as menu_name";
		$sql           = "SELECT
	                        a.id as no,
	                        a.id as {$this->module_table_id}, 
	                        {$title}, menu_icon, menu_link,
	                        CASE WHEN status = 0 THEN '{$FORMAT_STATUS[0]}' ELSE '{$FORMAT_STATUS[1]}' END AS status,
	                        DATE_FORMAT(created_at, '%d/%m/%Y %H:%i') as created_at,
	                        '{$FORMAT_BUTTON}' as button
	                      FROM {$this->module_table} a
	                      WHERE 1=1 AND a.parent = ?
	                      ORDER BY a.menu_ordering ASC, a.menu_name ASC";
		$query         = $this->db->query($sql, array($parent));
		if ($counted_mode) {
			return $query->num_rows();
		} else {
			if ($query->num_rows() > 0) {
				$result = $query->result_array();
				$query->free_result();
				return $result;
			}
		}
	}

	public function table()
	{
		$datatable_set    = array_map(function ($value) {
			if (!empty($datatable_set_decrypt)) {
				foreach ($datatable_set_decrypt as $index => $row) {
					$value[$row] = func_decrypt($value[$row]);
				}
			}
			return array_values($value);
		}, $this->get_menu_recursive(0));
		$filtered_records = $this->db->get($this->module_table)->num_rows();

		$output_array = [
			'draw'            => "{$this->input->post('draw')}",
			'recordsTotal'    => $filtered_records,
			'recordsFiltered' => $filtered_records,
			'data'            => $datatable_set,
		];

		return $this->output->set_content_type('application/json')->set_output(json_encode($output_array));
	}

	public function table_()
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
			'menu_name',
			'menu_icon',
			'menu_link',
			"CASE WHEN status = 0 THEN '{$FORMAT_STATUS[0]}' ELSE '{$FORMAT_STATUS[1]}' END AS status",
			"CASE WHEN menu_display = 0 THEN '{$FORMAT_STATUS[0]}' ELSE '{$FORMAT_STATUS[1]}' END AS menu_display",
			"'{$FORMAT_BUTTON}' as button",
		);
		$parameter_where   = array("parent" => '0');
		$parameter_orderby = array(
			'menu_ordering ASC',
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

		// get menu child
		$array = array();
		$int   = 0;
		foreach ($output_result->result_array() as $result) {
			$prefix      = '';
			$array[$int] = $result;
			if ($this->is_parent($result['id'])) {
				$parameter_where = array("parent" => $result['id']);
				$this->db->select($parameter_select);
				if (!empty($parameter_where)) {
					$this->db->group_start();
					$this->db->where($parameter_where);
					$this->db->group_end();
				}
				if (!empty($parameter_orderby)) {
					$this->db->order_by(implode(',', $parameter_orderby));
				}
				$childs           = $this->db->get($this->module_table);
				$filtered_records = $filtered_records + $childs->num_rows();
				foreach ($childs->result_array() as $child) {
					$prefix = '-- ';
					$int++;
					$array[$int]              = $child;
					$array[$int]['menu_name'] = $prefix . $array[$int]['menu_name'];
					if ($this->is_parent($child['id'])) {
						$parameter_where = array("parent" => $child['id']);
						$this->db->select($parameter_select);
						if (!empty($parameter_where)) {
							$this->db->group_start();
							$this->db->where($parameter_where);
							$this->db->group_end();
						}
						if (!empty($parameter_orderby)) {
							$this->db->order_by(implode(',', $parameter_orderby));
						}
						$childs_2         = $this->db->get($this->module_table);
						$filtered_records = $filtered_records + $childs_2->num_rows();
						foreach ($childs_2->result_array() as $child_2) {
							$prefix = '---- ';
							$int++;
							$array[$int]              = $child_2;
							$array[$int]['menu_name'] = $prefix . $array[$int]['menu_name'];
						}
					}
				}
			}
			$int++;
		}

		// echo "<pre>";
		// print_r($array);
		// exit();

		$datatable_set = array_map(function ($value) {

			return array_values($value);
		}, $array);

		$output_array = array(
			'draw'            => "{$this->input->post('draw')}",
			'recordsTotal'    => $filtered_records,
			'recordsFiltered' => $filtered_records,
			'data'            => $datatable_set
		);
		$output_result->free_result();

		return $this->output->set_content_type('application/json')->set_output(json_encode($output_array));
	}

	public function table_reorder()
	{
		$this->is_request_ajax();

		$data = array();

		if (!empty($this->input->post('parameter_order'))) {
			foreach ($this->input->post('parameter_order') as $key => $val) {
				$data[] = array('id' => $key, 'menu_ordering' => $val);
			}
		}

		if (!empty($data)) {
			if ($this->db->update_batch($this->module_table, $data, 'id')) {
				$output_action = [
					'status'  => true,
					'message' => 'Reorder Success'
				];
			} else {
				$output_action = [
					'status'  => false,
					'message' => 'Reorder Failed'
				];
			}
		} else {
			$output_action = [
				'status'  => true,
				'message' => 'No action'
			];
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($output_action));
	}

	public function add()
	{
		if ($this->is_request_post()) {
			$this->add_process();
		} else {
			$data = array(
				'template_title_module_action' => 'add',
				'data_default_ordering'        => $this->generate_menu_position(),
			);

			$this->apps_breadcrumb[] = array(
				'title' => ucwords("{$data['template_title_module_action']}"),
				'link'  => base_url($this->module_url_default) . '/add',
			);

			/*
			 * GET MENU LIST
			 */

			$parameter_select  = array(
				"id",
				'menu_name',
				'menu_icon',
			);
			$parameter_orderby = array(
				'menu_ordering ASC',
			);

			$this->db->select($parameter_select);
			if (!empty($parameter_orderby)) {
				$this->db->order_by(implode(',', $parameter_orderby));
			}

			$data['menu_list'] = $this->db->get($this->module_table);
			$data['menu_list'] = $data['menu_list']->result_array();
			//echo "<pre>";print_r($data);exit();
			$this->display($this->module_page['editor'], $data, $this->module_page['editor_footer']);
		}
	}

	public function edit($parameter_id = null)
	{
		if ($this->is_request_post()) {
			$this->edit_process();
		} else {
			$data = array(
				'template_title_module_action' => 'edit',
				'data_default_ordering'        => $this->generate_menu_position(),
			);

			$this->apps_breadcrumb[] = array(
				'title' => ucwords("{$data['template_title_module_action']}"),
				'link'  => base_url($this->module_url_default) . '/add',
			);

			$data['output_result'] = array();
			if ($parameter_id != '') {
				$parameter_where[$this->module_table_id] = $parameter_id;
				$data['output_result']                   = $this->db->get_where($this->module_table, $parameter_where)->row_array();
				$data['output_result_json']              = json_encode($data['output_result']);
			}

			/*
			 * GET MENU LIST
			 */

			$parameter_select  = array(
				"id",
				'menu_name',
				'menu_icon',
			);
			$parameter_orderby = array(
				'menu_ordering ASC',
			);

			$this->db->select($parameter_select);
			if (!empty($parameter_orderby)) {
				$this->db->order_by(implode(',', $parameter_orderby));
			}

			$data['menu_list'] = $this->db->get($this->module_table);
			$data['menu_list'] = $data['menu_list']->result_array();

			$this->display($this->module_page['editor'], $data, $this->module_page['editor_footer']);
		}
	}

	private function action_apps_menus_process()
	{


		if ($this->input->post('apps_menus_access') != '') {
			$_POST['apps_menus_access'] = func_encrypt(json_encode($this->input->post('apps_menus_access')));
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
		$this->action_add_process($parameter_url_source);
	}

	public function edit_process($parameter_id = null)
	{
		$parameter_url_source = $this->module_url_default . '/edit/' . $parameter_id;
		$this->action_edit_process($parameter_url_source, $parameter_id);
	}

	public function status_process($parameter_id = null)
	{
		$this->action_status_process($parameter_id);
	}

	public function status_process_checkbox()
	{
		$this->action_status_checkbox_process();
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
			$this->module_table, '', $this->module_table_id, $this->input->post($this->module_table_id), 'update'
		);
	}

}
