<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_authentication extends CI_Controller
{
	private   $module_page         = array(
		'index'        => 'index',
		'index_footer' => 'footer_index',
	);
	protected $module_base         = 'mod_authentication';
	protected $apps_title_module   = 'Login';
	protected $apps_output_message = array(
		'status'  => '',
		'title'   => '',
		'message' => ''
	);

	public function __construct()
	{
		parent::__construct();
		$this->lang->load('output_message');
	}

	protected function set_form_validation($ID = FALSE)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '<br/>');
		/* SET FORM VALIDATION RULES FOR COLUMN */
		$this->form_validation->set_rules("username", "Username {$this->apps_title_module}", 'required');
		$this->form_validation->set_rules("password", "Password {$this->apps_title_module}", 'required');
	}

	public function index()
	{
		$check_loggedin = $this->session->userdata(SESSION_LOGAPPS);
		if (!empty($check_loggedin['app_user_username'])) {
			redirect('mod_dashboard');
		}

		if ($this->input->post()) {
			$this->set_form_validation();
			$this->login_process();
		} else {

			$data         = array(
				'apps_title_module' => $this->apps_title_module
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];

			$this->load->view($this->module_page['index'], $data);
		}
	}

	private function login_process()
	{
		$parameter_redirect_url = base_url('mod_authentication');

		$this->apps_output_message = array(
			'status'  => 'error',
			'title'   => lang_text('message_login_title_failed'),
			'message' => lang_text('message_login_failed')
		);

		if (valdate_csrf_nonce($this->module_base, $this->input->post()) == FALSE) {
			$this->apps_output_message = array(
				'status'  => 'error',
				'title'   => FORM_VALIDATION_CSRF_TITLE,
				'message' => FORM_VALIDATION_CSRF_MESSAGE
			);
		} else {

			if ($this->form_validation->run() === false) {
				/** Scenario State Error from Form Validation */
				$this->apps_output_message = array(
					'status'  => 'error',
					'title'   => lang_text('message_login_title_failed'),
					'message' => validation_errors()
				);
			} else {

				$is_logged_in_status     = false;
				$output_result_data_user = array();

				$this->db->where('username', $this->input->post('username'));
				$output_result_data_user_check = $this->db->get('apps_operator')->row_array();
				if (!empty($output_result_data_user_check)) {
					$column_input_password = $this->input->post('password');
					//$column_input_password = (password_hash($column_input_password, PASSWORD_DEFAULT, array('cost' => 10)));
					$password_user_check = func_decrypt($output_result_data_user_check['password']);
					if (password_verify($column_input_password, $password_user_check)) {
						$is_logged_in_status     = true;
						$output_result_data_user = $output_result_data_user_check;
					}
				}

				if ($is_logged_in_status == true) {

					if (!empty($output_result_data_user['email'])) {
						$session_data = array(
							'app_email'         => $output_result_data_user['email'],
							'app_user_username' => $output_result_data_user['username'],
							'app_user_name'     => $output_result_data_user['name_full'],
							'app_user_acl'      => $output_result_data_user['operator_access'],
							'app_id'            => $output_result_data_user['id'],
							'app_user_id'       => $output_result_data_user['id'],
							'app_last_check'    => time(),
						);
						$this->session->set_userdata(SESSION_LOGAPPS, $session_data);

						$this->apps_output_message = array(
							'status'  => 'success',
							'title'   => lang_text('message_login_title_success'),
							'message' => lang_text('message_login_success')
						);

						/*
						 * GET PRIVILEGE MENU
						 */

						if (PRIVILEGES_ON) {
							$menu = $this->get_menu(0, '');

							// echo "<pre>";
							// print_r($menu);
							// exit();

							$this->session->set_userdata('menu', $menu);
						}

						$parameter_redirect_url = base_url('mod_dashboard');
					}
				}
			}
		}

		$this->set_output_action($parameter_redirect_url);
	}

	public function logout()
	{
		$this->session->unset_userdata(SESSION_LOGAPPS);
		redirect(base_url('mod_login'));
	}


	protected function set_output_action($parameter_redirect_url = null)
	{
		if ($this->apps_output_message['status'] == 'success') {
			/** Set flash error message and title */
			$this->session->set_flashdata('output_success_title', $this->apps_output_message['title']);
			$this->session->set_flashdata('output_success', $this->apps_output_message['message']);
		}

		if ($this->apps_output_message['status'] == 'error') {
			/** Set flash error message and title */
			$this->session->set_flashdata('output_error_title', $this->apps_output_message['title']);
			$this->session->set_flashdata('output_error', $this->apps_output_message['message']);
		}

		redirect($parameter_redirect_url);
	}

	// get list menu by privileges
	// public function get_menu()
	// {
	//     $operator_id = $this->session->userdata('IDX_SESS')['app_id'];
	//     $query = $this->db->query("SET sql_mode = ''");
	//     if (!empty($operator_id)) {
	//         $sql   = "SELECT apps_menus.`id`, apps_menus.parent, IF(parent_lv2.`menu_name` IS NOT NULL, 3, IF(parent_lv1.`menu_name` IS NOT NULL, 2, 1)) AS lvl, apps_menus.`menu_link`,
	//                   apps_menus.`menu_name`, apps_menus.`status`, IFNULL(apps_operator_privilege.`privilege`, '0000') AS privilege, apps_menus.menu_icon, apps_menus.menu_display
	//                   FROM apps_menus
	//                   INNER JOIN apps_operator_privilege ON apps_menus.`id` = apps_operator_privilege.`menus_id` AND apps_operator_privilege.`operator_id` = ?
	//                   LEFT JOIN apps_menus AS parent_lv1 ON apps_menus.`parent` = parent_lv1.`id`
	//                   LEFT JOIN apps_menus AS parent_lv2 ON parent_lv1.`parent` = parent_lv2.`id`
	//                   WHERE apps_menus.`status` = '1'
	//                   AND apps_operator_privilege.`privilege` NOT LIKE '0%'
	//                   ORDER BY apps_menus.`menu_ordering` ASC";
	//         $query = $this->db->query($sql, $operator_id);
	//         if ($query->num_rows() > 0) {
	//             $result      = $query->result_array();
	//             $data        = array();
	//             $link        = array();
	//             $link_child  = array();
	//             $child       = array();
	//             $child_array = array();
	//             $i           = 0;
	//             $j           = 0;
	//             foreach ($result as $key => $r) {
	//                 $data[$key]              = $r;
	//                 $data[$key]['is_parent'] = $this->is_parent($r['id']);
	//                 if ($r['privilege'] == '1000' && empty($result[$key + 1])) {
	//                     break;
	//                 }
	//                 if (!empty($result[$key + 1])) {
	//                     if ($result[$key + 1]['lvl'] != 1) {
	//                         if (!in_array($result[$key + 1]['menu_link'], $link)) {
	//                             $link[] = $result[$key + 1]['menu_link'];
	//                         }
	//                         if (!in_array($result[$key + 1]['id'], $child)) {
	//                             $child[] = $result[$key + 1]['id'];
	//                         }
	//                     } else if ($result[$key + 1]['lvl'] == 1) {
	//                         $data[$i]['link_array'] = $link;
	//                         $data[$i]['child']      = $child;
	//                         $link                   = array();
	//                         $child                  = array();
	//                         $i                      = $key + 1;
	//                     }
	//                     if ($result[$key + 1]['lvl'] == 3) {
	//                         if (!in_array($result[$key + 1]['menu_link'], $link_child)) {
	//                             $link_child[] = $result[$key + 1]['menu_link'];
	//                         }
	//                         if (!in_array($result[$key + 1]['id'], $child_array)) {
	//                             $child_array[] = $result[$key + 1]['id'];
	//                         }
	//                     } else if ($result[$key + 1]['lvl'] == 2) {
	//                         $data[$j]['link_array'] = $link_child;
	//                         $data[$j]['child']      = $child_array;
	//                         $link_child             = array();
	//                         $child_array            = array();
	//                         $j                      = $key + 1;
	//                     }
	//                 } else if (!empty($link)) {
	//                     $data[$i]['link_array'] = $link;
	//                     $data[$i]['child']      = $child;
	//                 }
	//             }
	//             return $data;
	//         } else {
	//             return array();
	//         }
	//     }
	//     return array();
	// }

	public function is_parent($id = null)
	{
		$sql   = "SELECT * FROM apps_menus WHERE parent = ?";
		$query = $this->db->query($sql, $id);
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}

	public function get_menus_parent($operator_id)
	{
		$sql   = "SELECT apps_menus.`id`, apps_menus.parent, '1' AS lvl, apps_menus.`menu_link`,
                apps_menus.`menu_name`, apps_menus.`status`, IFNULL(apps_operator_privilege.`privilege`, '0000') AS privilege, apps_menus.menu_icon, apps_menus.menu_display 
                FROM apps_menus 
                INNER JOIN apps_operator_privilege ON apps_menus.`id` = apps_operator_privilege.`menus_id` AND apps_operator_privilege.`operator_id` = ?
                WHERE apps_menus.`status` = '1'
                AND apps_menus.parent = '0'
                AND apps_operator_privilege.`privilege` NOT LIKE '0%'
                ORDER BY apps_menus.`menu_ordering` ASC";
		$query = $this->db->query($sql, $operator_id);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
	}

	public function get_menus_childs($operator_id = '', $parent = '')
	{
		$sql   = "SELECT apps_menus.`id`, apps_menus.parent, apps_menus.`menu_link`,
                apps_menus.`menu_name`, apps_menus.`status`, IFNULL(apps_operator_privilege.`privilege`, '0000') AS privilege, apps_menus.menu_icon, apps_menus.menu_display 
                FROM apps_menus 
                INNER JOIN apps_operator_privilege ON apps_menus.`id` = apps_operator_privilege.`menus_id` AND apps_operator_privilege.`operator_id` = ?
                WHERE apps_menus.`status` = '1'
                AND apps_menus.parent = ?
                AND apps_operator_privilege.`privilege` NOT LIKE '0%'
                ORDER BY apps_menus.`menu_ordering` ASC";
		$query = $this->db->query($sql, array($operator_id, $parent));
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
	}

	public function get_menu($parameter_parent = 0, $parameter_html = '')
	{
		$operator_id    = $this->session->userdata('IDX_SESS')['app_id'];
		$parameter_html = '';
		$this->db->select('id, parent, menu_ordering, menu_name, menu_icon, menu_link, menu_display');
		$this->db->join('apps_operator_privilege', "apps_menus.id = apps_operator_privilege.menus_id AND apps_operator_privilege.operator_id = '" . $operator_id . "'", 'INNER');
		$this->db->where('status', 1);
		$this->db->where('menu_display', 1);
		$this->db->where('parent', $parameter_parent);
		$this->db->like('privilege', '1', 'after');
//		$this->db->where('apps_operator_privilege.operator_id', $operator_id);
		$this->db->order_by('menu_ordering', 'ASC');
		$get_menu_by_parent = $this->db->get('apps_menus');
		if ($get_menu_by_parent->num_rows() > 0) {
			$get_menu_by_parent_result = $get_menu_by_parent->result_array();
			$get_menu_by_parent->free_result();
			foreach ($get_menu_by_parent_result as $index => $row) {
				$menu_id      = '';
				$menu_link    = '';
				$menu_text    = '';
				$class_active = '';

				$menu_id   = $row['id'];
				$menu_link = base_url() . $row['menu_link'];
				$menu_icon = $row['menu_icon'];
				$menu_text = $row['menu_name'];

				if ($menu_icon == '') {
					$menu_icon = 'fa fa-globe';
				}

				$check_have_child = $this->db->get_where('apps_menus', array('parent' => $menu_id))->num_rows();
				if ($check_have_child == 0) {
					$parameter_html .= "<li class='menu-li {$class_active}'><a href='{$menu_link}'><i class='{$menu_icon}'></i><span>{$menu_text}</span></a></li>";
				} else {
					$result = $this->get_menu($menu_id, $parameter_html);

					if (!empty($result)) {
						$parameter_html .= "<li class='treeview menu-li {$class_active}'>";
						$parameter_html .= "<a href='#'><i class='{$menu_icon}'></i><span>{$menu_text}</span> <span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></span></a>";
						$parameter_html .= "<ul class='treeview-menu'>";

						$parameter_html .= $result;

						$parameter_html .= "</ul>";
						$parameter_html .= "</li>";
					}
				}
			}
		}

		return $parameter_html;
	}
}
