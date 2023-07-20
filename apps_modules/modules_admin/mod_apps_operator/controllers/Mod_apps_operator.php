<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_admin.php';

class Mod_apps_operator extends Base_admin
{

	private   $module_page                  = array(
		'index'             => 'index',
		'editor'            => 'editor',
		'privileges'        => 'privileges',
		'table'             => 'table',
		'index_footer'      => 'footer_index',
		'editor_footer'     => 'footer_editor',
		'privileges_footer' => 'footer_privileges',
	);
	protected $module_url_default           = 'mod_apps_operator';
	protected $module_base                  = 'mod_apps_operator';
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
		 * "apps_operator" => array(
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
		 * "apps_operator" => array(
		 *  "table"  => "apps_operator",
		 *  "key_pk" => "id",
		 *  "key_fk" => "apps_operator_id",
		 *  "column" => array(
		 *     "apps_operator.id as category_id",
		 *     "apps_operator.data_name as category_name"
		 *  )
		 * )
		 */
		/* -------------------------------------------------------- */);
	protected $module_upload_path           = 'public/uploads/apps_operator/';

	public function __construct()
	{
		parent::__construct();
		$this->apps_title_module = 'Operator';
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

	public function table_reorder()
	{
		$this->is_request_ajax();

		$data = array();

		if (!empty($this->input->post('parameter_order'))) {
			foreach ($this->input->post('parameter_order') as $key => $val) {
				$data[] = array('id' => $key, 'data_position' => $val);
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

	private function action_apps_operator_process()
	{
		if ($this->input->post('id') == '') {
			if ($this->input->post('password_create') == '' || $this->input->post('password_create') == '') {
				/** Password empty */
			} else {
				if ($this->input->post('password_create') != $this->input->post('password_confirm')) {
					/** Error create password */
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

		if ($this->input->post('apps_operator_access') != '') {
			$_POST['apps_operator_access'] = func_encrypt(json_encode($this->input->post('apps_operator_access')));
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
		$this->action_apps_operator_process();
		$this->action_add_process($parameter_url_source);
	}

	public function edit_process($parameter_id = null)
	{
		$parameter_url_source = $this->module_url_default . '/edit/' . $parameter_id;
		$this->action_apps_operator_process();
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

	/*
	 * SET OPERATOR PRIVILEGE
	 */

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

	public function privileges($parameter_id = null)
	{
		if ($this->is_request_post()) {
			$this->db->trans_start();
			// clear privilege from db
			$this->{$this->apps_model}->delete_data('apps_operator_privilege', array('operator_id' => $parameter_id));
			// add all selected privilege
			$data_menus = $this->input->post('menu_id');
//            $privileges = $this->input->post('privileges');
			$list        = $this->input->post('list');
			$add         = $this->input->post('add');
			$edit        = $this->input->post('edit');
			$delete      = $this->input->post('delete');
			$operator_id = $this->input->post('operator_id');

			foreach ($data_menus as $menu) {
				$list_m   = empty($list[$menu]) ? '0' : $list[$menu];
				$add_m    = empty($add[$menu]) ? '0' : $add[$menu];
				$edit_m   = empty($edit[$menu]) ? '0' : $edit[$menu];
				$delete_m = empty($delete[$menu]) ? '0' : $delete[$menu];

				$privilege = $list_m . $add_m . $edit_m . $delete_m;

				$var_add = array(
					'operator_id' => $operator_id,
					'menus_id'    => $menu,
					'privilege'   => $privilege
				);
//                echo "<pre>";print_r($var_add);exit();
				$this->{$this->apps_model}->add_data('apps_operator_privilege', $var_add);
			}

			$this->db->trans_complete();
			if ($this->db->trans_status() === true) {
				$this->db->trans_commit();
				$this->apps_output_message = [
					'status'  => 'success',
					'title'   => lang_text('message_edit_title_success'),
					'message' => "{$this->apps_title_module} Privilege " . lang_text('message_edit_success'),
				];
			} else {
				$this->db->trans_rollback();
				$this->apps_output_message = [
					'status'  => 'error',
					'title'   => lang_text('message_edit_title_failed'),
					'message' => "{$this->apps_title_module} Privilege " . lang_text('message_edit_failed'),
				];
			}

			if ($this->apps_output_message['status'] == 'error') {
				$this->module_url_default = $this->module_url_default . '/privileges/' . $parameter_id;
			}

			$this->set_output_action($this->module_url_default);
		} else {
			$data = array(
				'template_title_module_action' => 'privilege'
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

			// $parameter_select = array(
			//     "apps_menus.id",
			//     "parent_lv2.menu_name as menu_name_lv2",
			//     "parent_lv1.menu_name as menu_name_lv1",
			//     'apps_menus.menu_name',
			//     'apps_menus.menu_icon',
			//     'apps_menus.menu_link',
			//     "privilege"
			// );

			// $parameter_orderby = array(
			//     'apps_menus.menu_ordering ASC',
			// );

			// $this->db->select($parameter_select);
			// $this->db->join('apps_operator_privilege', "apps_menus.id = apps_operator_privilege.menus_id AND apps_operator_privilege.operator_id = '" . $parameter_id . "'", 'left');
			// $this->db->join('apps_menus as parent_lv1', 'apps_menus.parent = parent_lv1.id', 'left');
			// $this->db->join('apps_menus as parent_lv2', 'parent_lv1.parent = parent_lv2.id', 'left');
			// $this->db->where('apps_menus.status', '1');
			// if (!empty($parameter_orderby)) {
			//     $this->db->order_by(implode(',', $parameter_orderby));
			// }

			// $menus = $this->db->get('apps_menus')->result_array();
			// $array = array();

			// foreach ($menus as $index => $value) {
			//     $page = '';
			//     if (!empty($value['menu_name_lv2'])) {
			//         $page = $value['menu_name_lv2'] . " > " . $value['menu_name_lv1'] . " > " . $value['menu_name'];
			//     } else if (!empty($value['menu_name_lv1'])) {
			//         $page = $value['menu_name_lv1'] . " > " . $value['menu_name'];
			//     } else {
			//         $page = $value['menu_name'];
			//     }

			//     if (empty($value['privilege'])) {
			//         $value['privilege'] = '0000';
			//     }

			//     $has_child = false;
			//     if (!empty($menus[$index + 1])) {
			//         if (empty($value['menu_name_lv2']) && empty($value['menu_name_lv1'])) {
			//             if (!empty($menus['data'][$index + 1]['menu_name_lv1'])) {
			//                 $has_child = true;
			//             }
			//         } else if (empty($value['menu_name_lv2']) && !empty($value['menu_name_lv1'])) {
			//             if (!empty($menus['data'][$index + 1]['menu_name_lv2'])) {
			//                 $has_child = true;
			//             }
			//         }
			//     }

			//     $privilege = str_split($value['privilege']);

			//     $array[$index]['id'] = $value['id'];
			//     $array[$index]['menu_name'] = $value['menu_name'];
			//     $array[$index]['menu_icon'] = $value['menu_icon'];
			//     $array[$index]['menu_link'] = $value['menu_link'];
			//     $array[$index]['list'] = $privilege[0];
			//     $array[$index]['add'] = $privilege[1];
			//     $array[$index]['edit'] = $privilege[2];
			//     $array[$index]['delete'] = $privilege[3];
			//     $array[$index]['has_child'] = $has_child;
			// }

			// $data['menu_list'] = $array;
//            echo "<pre>";print_r($data);exit();

			// $data['menu_list'] = $this->get_menu_by_operator($parameter_id);
//			$data['menu_list'] = $this->get_menu_recursive($parameter_id);
			$data['menu_list'] = $this->get_menu_by_parent_recursive($parameter_id);

			// echo '<Pre>';
			// print_r($data['menu_list']);
			// exit();

			$this->display($this->module_page['privileges'], $data, $this->module_page['privileges_footer']);
		}
	}

	// public function is_parent($id = null)
	// {
	//     $sql   = "SELECT * FROM apps_menus WHERE parent = ?";
	//     $query = $this->db->query($sql, $id);
	//     if ($query->num_rows() > 0) {
	//         return true;
	//     }
	//     return false;
	// }

	// public function get_menus_parent($operator_id){
	//     $sql   = "SELECT apps_menus.`id`, apps_menus.parent, '1' AS lvl, apps_menus.`menu_link`,
	//             apps_menus.`menu_name`, apps_menus.`status`, IFNULL(apps_operator_privilege.`privilege`, '0000') AS privilege, apps_menus.menu_icon, apps_menus.menu_display
	//             FROM apps_menus
	//             INNER JOIN apps_operator_privilege ON apps_menus.`id` = apps_operator_privilege.`menus_id` AND apps_operator_privilege.`operator_id` = ?
	//             WHERE apps_menus.`status` = '1'
	//             AND apps_menus.parent = '0'
	//             AND apps_operator_privilege.`privilege` NOT LIKE '0%'
	//             ORDER BY apps_menus.`menu_ordering` ASC";
	//     $query = $this->db->query($sql, $operator_id);
	//     if ($query->num_rows() > 0) {
	//         $result      = $query->result_array();
	//         $query->free_result();
	//         return $result;
	//     } else {
	//         return array();
	//     }
	// }

	// public function get_menus_childs($operator_id = '', $parent = ''){
	//     $sql   = "SELECT apps_menus.`id`, apps_menus.parent, apps_menus.`menu_link`,
	//             apps_menus.`menu_name`, apps_menus.`status`, IFNULL(apps_operator_privilege.`privilege`, '0000') AS privilege, apps_menus.menu_icon, apps_menus.menu_display
	//             FROM apps_menus
	//             INNER JOIN apps_operator_privilege ON apps_menus.`id` = apps_operator_privilege.`menus_id` AND apps_operator_privilege.`operator_id` = ?
	//             WHERE apps_menus.`status` = '1'
	//             AND apps_menus.parent = ?
	//             AND apps_operator_privilege.`privilege` NOT LIKE '0%'
	//             ORDER BY apps_menus.`menu_ordering` ASC";
	//     $query = $this->db->query($sql, array($operator_id, $parent));
	//     if ($query->num_rows() > 0) {
	//         $result      = $query->result_array();
	//         $query->free_result();
	//         return $result;
	//     } else {
	//         return array();
	//     }
	// }

	public function get_menu_by_operator($operator_id)
	{
		// $operator_id = $this->session->userdata('IDX_SESS')['app_id'];
		$query = $this->db->query("SET sql_mode = ''");
		if (!empty($operator_id)) {
			$menus = $this->get_menus_parent($operator_id);
			$data  = array();
			$int   = 0;
			$i     = 0;
			$j     = 0;

			foreach ($menus as $key => $menu) {
				$i                       = $int;
				$prefix                  = '';
				$data[$int]              = $menu;
				$data[$int]['has_child'] = $this->is_parent($menu['id']);
				$link[]                  = $menu['menu_link'];
				$level                   = $data[$int]['lvl'];
				$privilege               = str_split($data[$int]['privilege']);
				$data[$int]['list']      = $privilege[0];
				$data[$int]['add']       = $privilege[1];
				$data[$int]['edit']      = $privilege[2];
				$data[$int]['delete']    = $privilege[3];
				if ($data[$int]['has_child']) {
					$childs = $this->get_menus_childs($operator_id, $menu['id']);

//					echo '<pre>';
//					print_r($childs);
//					exit();

					foreach ($childs as $child) {
						$prefix = '-- ';
						$int++;
						$j                       = $int;
						$data[$int]              = $child;
						$data[$int]['menu_name'] = $prefix . $data[$int]['menu_name'];
						$data[$int]['has_child'] = $this->is_parent($child['id']);
						$privilege               = str_split($data[$int]['privilege']);
						$data[$int]['list']      = $privilege[0];
						$data[$int]['add']       = $privilege[1];
						$data[$int]['edit']      = $privilege[2];
						$data[$int]['delete']    = $privilege[3];
						$link_child[]            = $menu['menu_link'];
						$data[$int]['lvl']       = $level + 1;
						if ($data[$int]['has_child']) {
							$childs_2 = $this->get_menus_childs($operator_id, $child['id']);
							foreach ($childs_2 as $child_2) {
								$prefix = '---- ';
								$int++;
								$data[$int]              = $child_2;
								$data[$int]['menu_name'] = $prefix . $data[$int]['menu_name'];
								$data[$int]['has_child'] = false;
								$data[$int]['lvl']       = $level + 2;
								$privilege               = str_split($data[$int]['privilege']);
								$data[$int]['list']      = $privilege[0];
								$data[$int]['add']       = $privilege[1];
								$data[$int]['edit']      = $privilege[2];
								$data[$int]['delete']    = $privilege[3];
							}
						}
					}
				}
				$int++;
			}
		}
		// echo "<pre>";
		// print_r($data);
		// exit();
		return $data;
	}

	public function get_menu_by_parent_recursive($operator_id = null, $parent_id = 0, $level = 1, $prefix = '', $total_data = 0) {
		$data  = array();
		if($parent_id != 0){
			$prefix .= '--';
			$level = $level++;
		} else {
			$prefix = '';
			$level = 1;
		}
		if (!empty($operator_id)) {
			$menus = $this->get_menus_childs($operator_id, $parent_id);
			foreach ($menus as $key => $menu) {
				$data[$total_data] 				= $menu;
				if($prefix != ''){
					$data[$total_data]['menu_name'] = $prefix . " " . $data[$total_data]['menu_name'];
				}
				$data[$total_data]['has_child'] = $this->is_parent($menu['id']);
				$data[$total_data]['lvl'] 		= $level;
				$privilege              		= str_split($data[$total_data]['privilege']);
				$data[$total_data]['list']      = $privilege[0];
				$data[$total_data]['add']       = $privilege[1];
				$data[$total_data]['edit']      = $privilege[2];
				$data[$total_data]['delete']    = $privilege[3];
				if($data[$total_data]['has_child']){
					$total_data++;
					$result = $this->get_menu_by_parent_recursive($operator_id, $menu['id'], $level, $prefix, $total_data);
					$data += $result;
					// array_push($data,$result);
				}
				if(!empty($result)){
				$total_data = $total_data + count($result);
				} else {
					$total_data++;
				}
			}
		}
		return $data;
	}
}
