<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base.php';

class Base_admin extends Base
{
	protected $module_base                  = '';
	protected $module_menu                  = array();
	protected $module_portal                = 'admin';
	protected $module_global_view           = 'apps_modules/modules_admin/';
	protected $apps_title                   = 'Portal Administrator';
	protected $apps_title_module            = 'General';
	protected $apps_breadcrumb              = [];
	protected $apps_setting                 = [];
	protected $apps_output_message          = [
		'status'  => '',
		'title'   => '',
		'message' => '',
	];
	protected $module_url_default           = '';
	protected $module_table                 = '';
	protected $module_table_id              = 'id';
	protected $csrf                         = [
		'name' => '',
		'hash' => '',
	];
	protected $csrf_js                      = [];
	protected $module_duplicate_check       = [];
	protected $module_duplicate_check_chain = [];
	protected $module_upload_path           = 'public/uploads/';
	protected $module_upload_size           = [
		'original'  => 1136,
		'thumbnail' => 160,
	];

	protected $allowed_menus = [
		'#',
		'mod_dashboard',
		'mod_apps_menus',
		'mod_apps_operator',
		'mod_users',
	];

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','session','user_agent','swiftmailer'));
		$this->apps_breadcrumb[] = [
			'title' => 'Dashboard',
			'link'  => base_url('mod_dashboard'),
		];

		$this->load->helper('admin','form', 'url','string');
		
		$this->config->set_item('menu', $this->session->userdata('menu'));

		$this->csrf = [
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash(),
		];

		$this->csrf_js = json_encode((object) [
			$this->security->get_csrf_token_name() => $this->security->get_csrf_hash(),
		]);

		$check_loggedin = $this->session->userdata(SESSION_LOGAPPS);
		if (empty($check_loggedin['app_user_username'])) {
			redirect('mod_login');
		} else {
			$this->apps_session['user_id'] = $check_loggedin['app_id'];
		}

		if (PRIVILEGES_ON) {
			$this->config->set_item('privilege', str_split($this->get_privilege()));
		}

	}

	protected function generate_ordering_position()
	{
		$this->db->select('data_position');
		$this->db->order_by('data_position', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get($this->module_table);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
			return $result['data_position'] + 1;
		} else {
			return 1;
		}
	}

	protected function generate_menu_position()
	{
		$this->db->select('menu_ordering');
		$this->db->order_by('menu_ordering', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get($this->module_table);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
			return $result['menu_ordering'] + 1;
		} else {
			return 1;
		}
	}

	protected function generate_array_from_table_column($table = null, $data = null, $mode = null)
	{
		$output           = [];
		$get_column_table = $this->{$this->apps_model}->show_table_column($table);

		/* VALIDATE TABLE HAVE COLUMN */
		if (!empty($get_column_table) && is_array($output)) {
			foreach ($get_column_table as $index => $row) {
				if ($row['Key'] != 'PRI') {

					if (!empty($data[$row['Field']])) {
						$output[$row['Field']] = (!empty($data[$row['Field']])) ? $data[$row['Field']] : null;
					}

					if (isset($data[$row['Field']])) {
						if (!is_array($data[$row['Field']])) {
							if ($data[$row['Field']] == 0) {
								$output[$row['Field']] = $data[$row['Field']];
							}
						}
					}


					if ($row['Default'] != '') {
						$output[$row['Field']] = (!empty($data[$row['Field']])) ? $data[$row['Field']] : $row['Default'];
						if (!empty($output[$row['Field']])) {
							if (array_key_exists($row['Field'], $data)) {
								$output[$row['Field']] = $data[$row['Field']];
							}
						}
					}

					if (!empty($data[$row['Field']])) {
						if (is_array($data[$row['Field']])) {
							$output[$row['Field']] = json_encode($data[$row['Field']]);
						}
					}

					/* SET DEFAULT FOR BASED ON CASE COLUMN */
					if ($row['Field'] == 'parent') {
						$output['parent'] = (!empty($data['parent'])) ? $data['parent'] : 0;
					}

					if ($row['Field'] == 'ordering') {
						$output['ordering'] = (!empty($data['ordering'])) ? $data['ordering'] : 0;
					}

					if ($row['Field'] == 'data_permalinks') {
						$output['data_permalinks'] = (!empty($data['title'])) ? strtolower(url_title($data['title'])) : null;
					}

					if ($row['Field'] == 'password') {
						$output['password'] = (!empty($data['password'])) ? $data['password'] : null;
						if (empty($data['password'])) {
							unset($output['password']);
						}
					}

					if ($row['Field'] == 'published') {
						if ($mode == '') {
							$output['published'] = (!empty($data['published'])) ? date('d/m/Y H:i:s', strtotime($data['published'])) : null;
						} else {
							$output['published'] = (!empty($data['published'])) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['published']))) : date('Y-m-d');
						}
					}

					if ($row['Field'] == 'date_open') {
						if ($mode == '') {
							$output['date_open'] = (!empty($data['date_open'])) ? date('d/m/Y H:i:s', strtotime($data['date_open'])) : null;
						} else {
							$output['date_open'] = (!empty($data['date_open'])) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['date_open']))) : date('Y-m-d');
						}
					}

					if ($row['Field'] == 'date_close') {
						if ($mode == '') {
							$output['date_close'] = (!empty($data['date_close'])) ? date('d/m/Y H:i:s', strtotime($data['date_close'])) : null;
						} else {
							$output['date_close'] = (!empty($data['date_close'])) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['date_close']))) : date('Y-m-d');
						}
					}

					if ($mode != 'edit') {
						$output['created_by'] = (!empty($this->apps_session['user_id'])) ? $this->apps_session['user_id'] : null;
						$output['created_at'] = date('Y-m-d H:i:s');
					} else {
						$output['updated_by'] = (!empty($this->apps_session['user_id'])) ? $this->apps_session['user_id'] : null;
						$output['updated_at'] = date('Y-m-d H:i:s');
						unset($output['created_at']);
						unset($output['created_by']);
					}

					/* ON MODE ADD - CTB & CTD SET */
					if ($mode != '' || $mode != null) {
						if ($mode == 'add') {
							$output['created_by'] = (!empty($this->apps_session['user_id'])) ? $this->apps_session['user_id'] : null;
							$output['created_at'] = date('Y-m-d H:i:s');
						}
						/* ON ALL MODE - MDB & MDD SET */
						$output['updated_by'] = (!empty($this->apps_session['user_id'])) ? $this->apps_session['user_id'] : null;
						$output['updated_at'] = date('Y-m-d H:i:s');
					}
				} else {
					/* COLUMN PRIMARY CAN SET IF MODE = EDIT */
					if (($mode != '' || $mode != null) && $mode == 'edit') {
						$output[$row['Field']] = (!empty($data[$row['Field']])) ? $data[$row['Field']] : null;
					}
				}
			}
		}
		/* ON MODE ADD - CTB & CTD not SET by DEFAULT */
		if ($mode != 'add') {
			unset($output['ctb']);
			unset($output['ctd']);
		}

		return $output;
	}

	protected function set_output_action(
		$parameter_redirect_url = null,
		$parameter_output_message = null
	)
	{
		if ($this->input->is_ajax_request()) {
			if (empty($parameter_output_message)) {
				return $this->output->set_output(json_encode($this->apps_output_message));
			} else {
				return $this->output->set_output(json_encode($this->apps_output_message));
			}
		} else {
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
	}

	protected function set_duplicate_check()
	{
		$output_duplicate_check_message = [
			'status'  => false,
			'message' => '',
		];

		$output_duplicate_check_message_build = '';
		if (!empty($this->module_duplicate_check)) {
			foreach ($this->module_duplicate_check as $index => $row) {
				if ($this->input->post($index) != '') {
					$parameter_where_duplicate_check = [];

					/** System Duplicate Check */
					$parameter_where_duplicate_check[$index] = $this->input->post($index);

					if($index != 'data_link') {
						if (!empty($this->module_duplicate_check_chain)) {
							foreach ($this->module_duplicate_check_chain as $index_detail => $row_detail) {
								$parameter_where_duplicate_check[$index_detail] = $this->input->post($index_detail);
							}
						}
					}

					if (!empty($this->input->post($this->module_table_id))) {
						$parameter_where_duplicate_check[$this->module_table_id] = $this->input->post($this->module_table_id);
					}

					$output_duplicate_check_record = $this->db->get_where($this->module_table, $parameter_where_duplicate_check)->num_rows();
					if ($output_duplicate_check_message_build != '') {
						$output_duplicate_check_message_build = '<br/>';
					}
					if ($output_duplicate_check_record > 0) {
						$output_duplicate_check_message_build = lang_text('message_duplicate_check_by_column') . " <strong>{$row} {$this->apps_title_module} </strong>";
					}
				}
			}
		} else {
			$output_duplicate_check_message['status'] = true;
		}
		if ($output_duplicate_check_message_build != '') {
			$output_duplicate_check_message['status']  = false;
			$output_duplicate_check_message['message'] = $output_duplicate_check_message_build;
		} else {
			$output_duplicate_check_message['status'] = true;
		}


		return $output_duplicate_check_message;
	}

	protected function action_add_process($parameter_url_source = null)
	{
		if ($this->is_request_post()) {
			$this->set_form_validation();

			$apps_title_action  = 'Add';
			$apps_output_action = false;

			/** TRANSACT SQL for better Query Validation */
			$this->db->trans_start();

			$var_add = [];

			/**
			 * ----------------------------------------------------------------------------------------------------
			 * 0. VALIDATE CSRF
			 * ----------------------------------------------------------------------------------------------------
			 */

			if (valdate_csrf_nonce($this->module_base, $this->input->post()) == false) {
				$this->apps_output_message = [
					'status'  => 'error',
					'title'   => FORM_VALIDATION_CSRF_TITLE,
					'message' => FORM_VALIDATION_CSRF_MESSAGE,
				];
			} else {

				/**
				 * ----------------------------------------------------------------------------------------------------
				 * 1. VALIDATE WITH FORM VALIDATION
				 * ----------------------------------------------------------------------------------------------------
				 */
				if ($this->form_validation->run() === false) {
					/** Scenario State Error from Form Validation */
					$this->apps_output_message = [
						'status'  => 'error',
						'title'   => lang_text('message_add_title_failed'),
						'message' => validation_errors(),
					];
				} else {
					$output_process_check_duplicate = $this->set_duplicate_check();

					if ($output_process_check_duplicate['status'] == false) {
						$this->apps_output_message = [
							'status'  => 'error',
							'title'   => lang_text('message_duplicate_check_title'),
							'message' => $output_process_check_duplicate['message'],
						];
					} else {
						/**
						 * ----------------------------------------------------------------------------------------------------
						 * 2. VALIDATE DATA POST IF NOT EMPTY to SET VARIABLE ARRAY
						 * ----------------------------------------------------------------------------------------------------
						 */

						$var_add = $this->generate_array_from_table_column($this->module_table, $this->input->post(), 'add');
						if (empty($var_add)) {
							$this->apps_output_message = [
								'status'  => 'error',
								'title'   => lang_text('message_add_title_failed'),
								'message' => lang_text('message_error_default'),
							];
						} else {
							/** add field for PRIMARY KEY ID */
							$var_add[$this->module_table_id] = $this->generate_new_id_string();

							if ($this->module_table == 'pnu_news') {
								/** generate slug */
								$var_add['data_slug'] = sanitize_title_with_dashes($var_add['data_name']);
							}

							if ($this->module_table == 'pbd_business') {
								$text = substr($var_add['bd_maps'], 37);
								$url = substr($var_add['bd_maps'], 0, 37);
								$text_replace = str_replace(' ', '%20', $text);
								$text_replace_t = str_replace(':', '%3A', $text_replace);
								$text_replace_n = str_replace('&', '%26', $text_replace_t);
								$bd_map = $url.''.$text_replace_n;
								$var_add['bd_maps'] = trim($bd_map);
								// $data1= array_merge($var_add['bd_maps'],$var_add);
								/** generate slug */
								$apps_output_action = $this->{$this->apps_model}->add_data($this->module_table, $var_add);
							}else{
								/** Action process Add */
								$apps_output_action = $this->{$this->apps_model}->add_data($this->module_table, $var_add);
						
							}
							
						}
					}
				}
			}

			$this->db->trans_complete();
			if ($this->db->trans_status() === true) {
				$this->db->trans_commit();

				if ($apps_output_action == true) {

					$this->action_image_process(
						'__files',
						$this->module_table,
						['id' => $this->module_table_id, 'value' => $var_add[$this->module_table_id]],
						['id' => $this->module_table_id, 'value' => $var_add[$this->module_table_id]],
						$this->module_upload_path,
						$this->module_upload_size,
						$this->module_table
					);

					$this->action_image_process(
						'__files_cover',
						$this->module_table,
						['id' => $this->module_table_id, 'value' => $var_add[$this->module_table_id]],
						['id' => $this->module_table_id, 'value' => $var_add[$this->module_table_id]],
						$this->module_upload_path,
						$this->module_upload_size,
						$this->module_table
					);

					$this->apps_output_message = [
						'status'  => 'success',
						'title'   => lang_text('message_add_title_success'),
						'message' => "{$this->apps_title_module} " . lang_text('message_add_success'),
					];
				}
			} else {
				$this->db->trans_rollback();
				$this->apps_output_message = [
					'status'  => 'error',
					'title'   => lang_text('message_add_title_failed'),
					'message' => "{$this->apps_title_module} " . lang_text('message_add_failed'),
				];
			}

			if ($this->apps_output_message['status'] == 'error') {
				$this->module_url_default = $parameter_url_source;
			}

			$this->set_output_action($this->module_url_default);
		}
	}

	protected function action_edit_process(
		$parameter_url_source = null,
		$parameter_id = null
	)
	{
		if ($this->is_request_post()) {
			$this->set_form_validation();

			$apps_title_action  = 'Edit';
			$apps_output_action = false;

			/** TRANSACT SQL for better Query Validation */
			$this->db->trans_start();

			$var_edit    = [];
			$var_edit_id = [];

			if (empty($parameter_id)) {
				$parameter_id = $this->input->post($this->module_table_id);
			}

			/**
			 * ----------------------------------------------------------------------------------------------------
			 * 1. VALIDATE WITH FORM VALIDATION
			 * ----------------------------------------------------------------------------------------------------
			 */
			if ($this->form_validation->run() === false) {
				/** Scenario State Error from Form Validation */
				$this->apps_output_message = [
					'status'  => 'error',
					'title'   => lang_text('message_edit_title_failed'),
					'message' => validation_errors(),
				];
			} else {
				/**
				 * ----------------------------------------------------------------------------------------------------
				 * 2. VALIDATE DATA POST IF NOT EMPTY to SET VARIABLE ARRAY
				 * ----------------------------------------------------------------------------------------------------
				 */

				$var_edit = $this->generate_array_from_table_column($this->module_table, $this->input->post(), 'edit');
				unset($var_edit[$this->module_table_id]);

				if (empty($var_edit)) {
					$this->apps_output_message = [
						'status'  => 'error',
						'title'   => lang_text('message_edit_title_failed'),
						'message' => lang_text('message_error_default'),
					];
				} else {
					/** add field for PRIMARY KEY ID */
					$var_edit_id[$this->module_table_id] = $parameter_id;

					if ($this->module_table == 'pnu_news') {
						/** generate slug */
						$var_edit['data_slug'] = sanitize_title_with_dashes($var_edit['data_name']);
					}

					if ($this->module_table == 'pbd_business') {
						$text = substr($var_edit['bd_maps'], 37);
						$url = substr($var_edit['bd_maps'], 0, 37);
						$text_replace = str_replace(' ', '%20', $text);
						$text_replace_t = str_replace(':', '%3A', $text_replace);
						$text_replace_n = str_replace('&', '%26', $text_replace_t);
						$bd_map = $url.''.$text_replace_n;
						$var_edit['bd_maps'] =$bd_map;
						// $data1= array_merge($var_add['bd_maps'],$var_add);
						/** generate slug */
						$apps_output_action = $this->{$this->apps_model}->update_data($this->module_table, $this->module_table_id, $var_edit_id, $var_edit);
					}else{
						/** Action process Add */
						$apps_output_action = $this->{$this->apps_model}->update_data($this->module_table, $this->module_table_id, $var_edit_id, $var_edit);
					}
					
				}
			}

//			echo '<pre>';
//			print_r($var_edit);

			$this->db->trans_complete();
			if ($this->db->trans_status() === true) {
				$this->db->trans_commit();

				if ($apps_output_action == true) {

					$this->action_image_process(
						'__files',
						$this->module_table,
						['id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]],
						['id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]],
						$this->module_upload_path,
						$this->module_upload_size,
						$this->module_table,
					);

					$this->action_image_process(
						'__files_cover',
						$this->module_table,
						['id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]],
						['id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]],
						$this->module_upload_path,
						$this->module_upload_size,
						$this->module_table,
					);


//					exit();

					$this->apps_output_message = [
						'status'  => 'success',
						'title'   => lang_text('message_edit_title_success'),
						'message' => "{$this->apps_title_module} " . lang_text('message_edit_success'),
					];

					echo '<pre>';

				}
			} else {
				$this->db->trans_rollback();
				$this->apps_output_message = [
					'status'  => 'error',
					'title'   => lang_text('message_edit_title_failed'),
					'message' => "{$this->apps_title_module} " . lang_text('message_edit_failed'),
				];
			}

			if ($this->apps_output_message['status'] == 'error') {
				$this->module_url_default = $parameter_url_source;
			}

			$this->set_output_action($this->module_url_default);
		}
	}

	protected function action_status_process($parameter_id = null, $parameter_status = 0, $parameter_is_return_output = false)
	{
		if ($this->is_request_post()) {
			$this->is_request_ajax();

			$apps_output_action = false;

			$var_update = [];
			if ($this->input->post()) {
				if (!empty($parameter_id)) {
					/** Based on parameter set on URL to update data */
				} else {
					/** Based on data post index variable primary id */
					$parameter_id = $this->input->post('data_id');
				}

				if (!empty($parameter_status)) {
					/** Based on parameter set on URL to update data */
				} else {
					/** Based on data post index variable primary status */
					$parameter_status = $this->input->post('data_status');
				}

				if ($parameter_id != '') {
					$parameter_status_column            = 'status';
					$var_edit[$parameter_status_column] = $parameter_status;
					/** add field for PRIMARY KEY ID */
					$var_edit_id[$this->module_table_id] = $parameter_id;

					/** Action process Add */
					$apps_output_action = $this->{$this->apps_model}->update_data($this->module_table, $this->module_table_id, $var_edit_id, $var_edit);
					if ($apps_output_action == true) {

						$this->apps_output_message = [
							'status'  => 'success',
							'title'   => lang_text('message_update_title_success'),
							'message' => "{$this->apps_title_module} " . lang_text('message_update_success'),
						];
					} else {

						$this->apps_output_message = [
							'status'  => 'error',
							'title'   => lang_text('message_update_title_failed'),
							'message' => "{$this->apps_title_module} " . lang_text('message_update_failed'),
						];
					}
				} else {

					$this->apps_output_message = [
						'status'  => 'error',
						'title'   => lang_text('message_update_title_failed'),
						'message' => "{$this->apps_title_module} " . lang_text('message_update_failed'),
					];
				}
			} else {

				$this->apps_output_message = [
					'status'  => 'error',
					'title'   => lang_text('message_update_title_failed'),
					'message' => "{$this->apps_title_module} " . lang_text('message_update_failed'),
				];
			}

			if ($parameter_is_return_output == false) {
				$this->set_output_action($this->module_url_default);
			} else {
				return $this->apps_output_message;
			}
		}
	}

	protected function action_status_disable_process($parameter_id = null)
	{
		if ($this->is_request_post()) {
			$this->is_request_ajax();

			$apps_output_action = false;

			$parameter_status = 0;

			$var_update = [];
			if ($this->input->post()) {
				if (!empty($parameter_id)) {
					/** Based on parameter set on URL to update data */
				} else {
					/** Based on data post index variable primary id */
					$parameter_id = $this->input->post('data_id');
				}

				if (!empty($parameter_status)) {
					/** Based on parameter set on URL to update data */
				} else {
					/** Based on data post index variable primary status */
					$parameter_status = $this->input->post('data_status');
				}

				if ($parameter_id != '') {
					$parameter_status_column            = 'status_disable';
					$var_edit[$parameter_status_column] = $parameter_status;
					/** add field for PRIMARY KEY ID */
					$var_edit_id[$this->module_table_id] = $parameter_id;

					/** Action process Add */
					$apps_output_action = $this->{$this->apps_model}->update_data($this->module_table, $this->module_table_id, $var_edit_id, $var_edit);
					if ($apps_output_action == true) {

						$this->apps_output_message = [
							'status'  => 'success',
							'title'   => lang_text('message_update_title_success'),
							'message' => "{$this->apps_title_module} " . lang_text('message_update_success'),
						];
					} else {

						$this->apps_output_message = [
							'status'  => 'error',
							'title'   => lang_text('message_update_title_failed'),
							'message' => "{$this->apps_title_module} " . lang_text('message_update_failed'),
						];
					}
				} else {

					$this->apps_output_message = [
						'status'  => 'error',
						'title'   => lang_text('message_update_title_failed'),
						'message' => "{$this->apps_title_module} " . lang_text('message_update_failed'),
					];
				}
			} else {

				$this->apps_output_message = [
					'status'  => 'error',
					'title'   => lang_text('message_update_title_failed'),
					'message' => "{$this->apps_title_module} " . lang_text('message_update_failed'),
				];
			}

			$this->set_output_action($this->module_url_default);
		}
	}

	protected function action_delete_process($parameter_id = null, $parameter_is_return_output = false)
	{
		if ($this->is_request_post()) {
			$this->is_request_ajax();

			$output_action = false;

			$var_delete = [];
			if ($this->input->post()) {
				if (!empty($parameter_id)) {
					/** Based on parameter set on URL to delete data */
				} else {
					/** Based on data post index variable primary id */
					$parameter_id = $this->input->post('data_id');
				}

				if ($parameter_id != '') {
					$var_delete[$this->module_table_id] = $parameter_id;

					$output_action = $this->{$this->apps_model}->delete_data($this->module_table, $var_delete);

					if ($output_action == true) {

						$this->apps_output_message = [
							'status'  => 'success',
							'title'   => lang_text('message_delete_title_success'),
							'message' => "{$this->apps_title_module} " . lang_text('message_delete_success'),
						];
					} else {

						$this->apps_output_message = [
							'status'  => 'error',
							'title'   => lang_text('message_delete_title_failed'),
							'message' => "{$this->apps_title_module} " . lang_text('message_delete_failed'),
						];
					}
				} else {

					$this->apps_output_message = [
						'status'  => 'error',
						'title'   => lang_text('message_delete_title_failed'),
						'message' => "{$this->apps_title_module} " . lang_text('message_delete_failed'),
					];
				}
			} else {

				$this->apps_output_message = [
					'status'  => 'error',
					'title'   => lang_text('message_delete_title_failed'),
					'message' => "{$this->apps_title_module} " . lang_text('message_delete_failed'),
				];
			}

			if ($parameter_is_return_output == false) {
				$this->set_output_action($this->module_url_default);
			} else {
				return $this->apps_output_message;
			}
		}
	}

	protected function action_checkbox_status_process()
	{
		$data_id = $this->input->post('checkbox');

		if (is_array($data_id)) {
			if (!empty($data_id)) {
				foreach ($data_id as $index => $row) {
					$output_return = $this->action_status_process($row, true);
				}
			}
		}

		$this->apps_output_message = [
			'status'  => 'success',
			'title'   => lang_text('message_update_title_success'),
			'message' => "{$this->apps_title_module} " . lang_text('message_update_success'),
		];

		$this->set_output_action($this->module_url_default);
	}

	protected function action_checkbox_delete_process()
	{
		$data_id     = $this->input->post('checkbox');
		$data_status = $this->input->post('data_delete');

		if (is_array($data_id)) {
			if (!empty($data_id)) {
				foreach ($data_id as $index => $row) {
					$output_return = $this->action_delete_process($row, $data_status, true);
				}
			}
		}

		$this->apps_output_message = [
			'status'  => 'success',
			'title'   => lang_text('message_delete_title_success'),
			'message' => "{$this->apps_title_module} " . lang_text('message_delete_success'),
		];

		$this->set_output_action($this->module_url_default);
	}

	/**
	 * -------------------------------------------------------------------------------------------------------------------
	 * FUNCTION for ACTION
	 * -------------------------------------------------------------------------------------------------------------------
	 */

	protected function action_image_process(
		$parameter_upload_column_name = null,
		$parameter_upload_table = null,
		$parameter_upload_table_key = ['id' => null, 'value' => null],
		$parameter_upload_table_related_key = null,
		$parameter_upload_destination = null,
		$parameter_upload_size_maximum = [
			'original'  => 1136,
			'thumbnail' => 160,
		],
		$parameter_upload_table_reference = null
	)
	{
		/**
		 * 1. Validate input file (multiple or not)
		 * 2. Check file type for upload image
		 * 3. Check process is new / update data image
		 * 4. Process upload image and generate thumbnail
		 * 5. Create record for succes image upload on server to database
		 */

		$upload_column_name = '__files';
		if (!empty($parameter_upload_column_name)) {
			$upload_column_name = $parameter_upload_column_name;
		}
		if (!empty($_FILES[$upload_column_name]['name'])) {
			$var_upload_image = $this->action_image_process_upload(
				$parameter_upload_column_name,
				$parameter_upload_table,
				$parameter_upload_table_key,
				$parameter_upload_table_related_key,
				$parameter_upload_destination,
				$parameter_upload_size_maximum,
				$parameter_upload_table_reference
			);

//			echo '<Pre>';
//			print_r($var_upload_image);

			if (!empty($var_upload_image)) {

				if (!empty($var_upload_image['data']['add'])) {
					if ($this->module_table == $parameter_upload_table) {

						/** IF TABLE FILE UPLOAD IMAGE SAME AS MODULE TABLE , JUST UPDATE IT */
						foreach ($var_upload_image['data']['add'] as $index => $row) {
							$var_upload_image_id[$parameter_upload_table_key['id']] = $parameter_upload_table_key['value'];
							unset($var_upload_image['data']['add'][$index][$parameter_upload_table_key['id']]);

							$this->{$this->apps_model}->update_data($parameter_upload_table, $parameter_upload_table_key['id'], $var_upload_image_id, $var_upload_image['data']['add'][$index]);
						}
					} else {
						$this->{$this->apps_model}->add_data_batch($parameter_upload_table, $var_upload_image['data']['add']);
					}
				}

				if (!empty($var_upload_image['data']['edit'])) {
					$this->{$this->apps_model}->update_data_batch($parameter_upload_table, $var_upload_image['data']['edit'], $parameter_upload_table_key);
				}
			}
		}

	}

	protected function action_image_process_delete(
		$parameter_table = null,
		$parameter_table_where = null,
		$parameter_table_id_key = null,
		$parameter_table_id_value = null,
		$parameter_output_action = 'delete'
	)
	{
		/**
		 * 1. Validate data for delete image
		 * 2. Check data from database (file name and file path)
		 * 3. Check image on server, if exist
		 * 4. if Exist, delete image on server
		 * 5. if delete success, process to delete data record on database
		 */

		if ($this->is_request_post()) {
			$this->is_request_ajax();

			$output_action = false;
			$output        = [];
			$output_unlink = [];

			$var_delete = [];
			if ($this->input->post()) {
				if (!empty($parameter_id)) {
					/** Based on parameter set on URL to delete data */
				} else {
					/** Based on data post index variable primary id */
					$parameter_id = $this->input->post('data_id');
				}

				$parameter_id = $parameter_table_id_value;

				if ($parameter_id != '') {
					$var_delete[$this->module_table_id]            = $parameter_id;
					$parameter_table_where[$this->module_table_id] = $parameter_id;

					$output_result = $this->db->get_where($parameter_table, $parameter_table_where)->result_array();

					$parameter_name = 'file';
					if ($this->input->post('data_type') != '__files') {
						$parameter_name = 'cover_file';
					}

					if (!empty($output_result)) {
						foreach ($output_result as $index => $row) {

							$file_thumbnail = "{$row["{$parameter_name}_path"]}thumb/{$row["{$parameter_name}_name_thumbnail"]}";
							$file_original  = "{$row["{$parameter_name}_path"]}/{$row["{$parameter_name}_name_original"]}";

							$output_unlink[$index] = [
								'original'  => is_file($file_original) ? $file_original : null,
								'thumbnail' => is_file($file_thumbnail) ? $file_thumbnail : null,
							];

							if ($parameter_output_action == 'delete') {
								$output[$index] = $row[$parameter_table_id_key];
							} else if ($parameter_output_action == 'update') {
								$output[$index] = [
									$parameter_table_id_key            => $row[$parameter_table_id_key],
									"{$parameter_name}_name_thumbnail" => null,
									"{$parameter_name}_name_original"  => null,
									"{$parameter_name}_path"           => null,
								];
							}
						}


						if ($parameter_output_action == 'delete') {
							if (!empty($output)) {
								$output_action = $this->{$this->apps_model}->delete_data_batch($parameter_table, $parameter_table_id_key, $output);
							}
						} else if ($parameter_output_action == 'update') {
							if (!empty($output)) {
								$output_action = $this->{$this->apps_model}->update_data_batch($parameter_table, $output, $parameter_table_id_key);
							}
						}


						if (!empty($output_unlink)) {

							foreach ($output_unlink as $index => $row) {
								$file_thumbnail = $row['thumbnail'];
								$file_original  = $row['original'];

								if ($file_thumbnail != '') {
									if (file_exists($file_thumbnail)) {
										unlink($file_thumbnail);
									}
								}
								if ($file_original != '') {
									if (file_exists($file_original)) {
										unlink($file_original);
									}
								}
							}
						}

						$this->apps_output_message = [
							'status'  => 'success',
							'title'   => lang_text('message_delete_title_success'),
							'message' => "{$this->apps_title_module} " . lang_text('message_delete_success'),
						];
					} else {

						$this->apps_output_message = [
							'status'  => 'error',
							'title'   => lang_text('message_delete_title_failed'),
							'message' => "{$this->apps_title_module} " . lang_text('message_delete_failed'),
						];
					}
				} else {

					$this->apps_output_message = [
						'status'  => 'error',
						'title'   => lang_text('message_delete_title_failed'),
						'message' => "{$this->apps_title_module} " . lang_text('message_delete_failed'),
					];
				}
			} else {

				$this->apps_output_message = [
					'status'  => 'error',
					'title'   => lang_text('message_delete_title_failed'),
					'message' => "{$this->apps_title_module} " . lang_text('message_delete_failed'),
				];
			}

			$this->set_output_action($this->module_url_default);
		}
	}

	private function action_image_process_upload(
		$parameter_upload_column_name = null,
		$parameter_upload_table = null,
		$parameter_upload_table_key = ['id' => null, 'value' => null],
		$parameter_upload_table_related_key = null,
		$parameter_upload_destination = null,
		$parameter_upload_size_maximum = [
			'original'  => 1136,
			'thumbnail' => 160,
		],
		$parameter_upload_table_reference = null
	)
	{
		/**
		 *  1. Process upload image to server
		 *  2. validate file type and size
		 *  3. create multiple file for other dimension proportional
		 */

		$path_original  = $parameter_upload_destination;
		$path_thumbnail = $parameter_upload_destination . '/thumb';

		$this->load->library('image_upload_resize');

		$config["generate_image_file"]          = true;
		$config["generate_thumbnails"]          = true;
		$config["image_max_size"]               = $parameter_upload_size_maximum['original'];  // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
		$config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail']; // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
		$config["thumbnail_prefix"]             = "thumb_";                                    // NORMAL THUMB PREFIX
		$config["destination_folder"]           = "{$path_original}/";                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
		$config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                        // UPLOAD DIRECTORY ENDS WITH / (SLASH)
		$config["quality"]                      = 90;                                          // JPEG QUALITY
		$config["random_file_name"]             = true;                                        // RANDOMIZE EACH FILE NAME
		$config["upload_url"]                   = base_url($path_original) . '/';
		$config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

		$config["file_data"] = $_FILES[$parameter_upload_column_name];

		$upload_image_responses = $this->image_upload_resize->resize($config);
		$output_editable        = null;
		try {
			$variable['add']  = null;
			$variable['edit'] = null;

			if (!empty($upload_image_responses['images'])) {
				foreach ($upload_image_responses["images"] as $index => $response) {
					$config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
					if ($response != '') {
						if ($parameter_upload_column_name == '__files') {
							if (!isset($output_editable[$index])) {
								$variable['add'][$index] = [
									$parameter_upload_table_related_key['id'] => $parameter_upload_table_related_key['value'],
									'file_name_thumbnail'                     => 'thumb_' . $response,
									'file_name_original'                      => $response,
									'file_path'                               => $config["destination_folder"],
									'file_json'                               => func_encrypt(json_encode($_FILES)),
									'created_by'                              => 1,
									'created_at'                              => date('Y-m-d H:i:s'),
									'updated_by'                              => 1,
									'updated_at'                              => date('Y-m-d H:i:s'),
								];

								if ($parameter_upload_table != $parameter_upload_table_reference) {
									$variable['add'][$index][$parameter_upload_table_key['id']] = $this->generate_new_id_string() . get_random_alphanumeric(5);
								}
							} else {
								$variable['edit'][$index] = [
									$parameter_upload_table_related_key['id'] => $parameter_upload_table_related_key['value'],
									$parameter_upload_table_key['id']         => $output_editable[$index],
									'file_name_thumbnail'                     => 'thumb_' . $response,
									'file_name_original'                      => $response,
									'file_path'                               => $config["destination_folder"],
									'file_json'                               => func_encrypt(json_encode($_FILES)),
									'updated_by'                              => 1,
									'updated_at'                              => date('Y-m-d H:i:s'),
								];

								if ($parameter_upload_table != $parameter_upload_table_reference) {
									$variable['edit'][$index][$parameter_upload_table_key['id']] = $output_editable[$index];
								}
							}
						} else {
							if (!isset($output_editable[$index])) {
								$variable['add'][$index] = [
									$parameter_upload_table_related_key['id'] => $parameter_upload_table_related_key['value'],
									$parameter_upload_table_key['id']         => $this->generate_new_id_string() . get_random_alphanumeric(5),
									'cover_file_name_thumbnail'               => 'thumb_' . $response,
									'cover_file_name_original'                => $response,
									'cover_file_path'                         => $config["destination_folder"],
									'cover_file_json'                         => func_encrypt(json_encode($_FILES)),
									'created_by'                              => 1,
									'created_at'                              => date('Y-m-d H:i:s'),
									'updated_by'                              => 1,
									'updated_at'                              => date('Y-m-d H:i:s'),
								];

								if ($parameter_upload_table != $parameter_upload_table_reference) {
									$variable['add'][$index][$parameter_upload_table_key['id']] = $this->generate_new_id_string() . get_random_alphanumeric(5);
								}
							} else {
								$variable['edit'][$index] = [
									$parameter_upload_table_related_key['id'] => $parameter_upload_table_related_key['value'],
									'cover_file_name_thumbnail'               => 'thumb_' . $response,
									'cover_file_name_original'                => $response,
									'cover_file_path'                         => $config["destination_folder"],
									'cover_file_json'                         => func_encrypt(json_encode($_FILES)),
									'updated_by'                              => 1,
									'updated_at'                              => date('Y-m-d H:i:s'),
								];

								if ($parameter_upload_table != $parameter_upload_table_reference) {
									$variable['edit'][$index][$parameter_upload_table_key['id']] = $output_editable[$index];
								}
							}
						}
					}
				}
			}

			$output['data']    = $variable;
			$output['status']  = true;
			$output['message'] = '';
		} catch (Exception $e) {
			$output['data']    = null;
			$output['status']  = false;
			$output['message'] = $e->getMessage();
		}

		return $output;
	}

	private function action_image_process_update()
	{
		/**
		 * 1. Process upload image to server
		 * 2. Get existing file from record database
		 * 3. Check file exist or not on server
		 * 4. if file exist, ready for delete image on server
		 * 5. Upload new image on server
		 * 6. Update record for database with new data image
		 */
	}

	// get list menu by privileges
	// public function get_menu()
	// {
	// 	$operator_id = $this->session->userdata('IDX_SESS')['app_id'];
	// 	$query       = $this->db->query("SET sql_mode = ''");
	// 	if (!empty($operator_id)) {
	// 		$sql   = "SELECT apps_menus.`id`, apps_menus.parent, IF(parent_lv2.`menu_name` IS NOT NULL, 3, IF(parent_lv1.`menu_name` IS NOT NULL, 2, 1)) AS lvl, apps_menus.`menu_link`,
	//                   apps_menus.`menu_name`, apps_menus.`status`, IFNULL(apps_operator_privilege.`privilege`, '0000') AS privilege, apps_menus.menu_icon, apps_menus.menu_display
	//                   FROM apps_menus
	//                   INNER JOIN apps_operator_privilege ON apps_menus.`id` = apps_operator_privilege.`menus_id` AND apps_operator_privilege.`operator_id` = ?
	//                   LEFT JOIN apps_menus AS parent_lv1 ON apps_menus.`parent` = parent_lv1.`id`
	//                   LEFT JOIN apps_menus AS parent_lv2 ON parent_lv1.`parent` = parent_lv2.`id`
	//                   WHERE apps_menus.`status` = '1'
	//                   AND apps_operator_privilege.`privilege` NOT LIKE '0%'
	//                   ORDER BY apps_menus.`menu_ordering` ASC";
	// 		$query = $this->db->query($sql, $operator_id);
	// 		if ($query->num_rows() > 0) {
	// 			$result      = $query->result_array();
	// 			$data        = array();
	// 			$link        = array();
	// 			$link_child  = array();
	// 			$child       = array();
	// 			$child_array = array();
	// 			$i           = 0;
	// 			$j           = 0;
	// 			foreach ($result as $key => $r) {
	// 				$data[$key]              = $r;
	// 				$data[$key]['is_parent'] = $this->is_parent($r['id']);
	// 				if ($r['privilege'] == '1000' && empty($result[$key + 1])) {
	// 					break;
	// 				}
	// 				if (!empty($result[$key + 1])) {
	// 					if ($result[$key + 1]['lvl'] != 1) {
	// 						if (!in_array($result[$key + 1]['menu_link'], $link)) {
	// 							$link[] = $result[$key + 1]['menu_link'];
	// 						}
	// 						if (!in_array($result[$key + 1]['id'], $child)) {
	// 							$child[] = $result[$key + 1]['id'];
	// 						}
	// 					} else if ($result[$key + 1]['lvl'] == 1) {
	// 						$data[$i]['link_array'] = $link;
	// 						$data[$i]['child']      = $child;
	// 						$link                   = array();
	// 						$child                  = array();
	// 						$i                      = $key + 1;
	// 					}
	// 					if ($result[$key + 1]['lvl'] == 3) {
	// 						if (!in_array($result[$key + 1]['menu_link'], $link_child)) {
	// 							$link_child[] = $result[$key + 1]['menu_link'];
	// 						}
	// 						if (!in_array($result[$key + 1]['id'], $child_array)) {
	// 							$child_array[] = $result[$key + 1]['id'];
	// 						}
	// 					} else if ($result[$key + 1]['lvl'] == 2) {
	// 						$data[$j]['link_array'] = $link_child;
	// 						$data[$j]['child']      = $child_array;
	// 						$link_child             = array();
	// 						$child_array            = array();
	// 						$j                      = $key + 1;
	// 					}
	// 				} else if (!empty($link)) {
	// 					$data[$i]['link_array'] = $link;
	// 					$data[$i]['child']      = $child;
	// 				}
	// 			}
	// 			return $data;
	// 		} else {
	// 			return array();
	// 		}
	// 	}
	// 	return array();
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
                LEFT JOIN apps_operator_privilege ON apps_menus.`id` = apps_operator_privilege.`menus_id` AND apps_operator_privilege.`operator_id` = ?
                WHERE apps_menus.`status` = '1'
                AND apps_menus.parent = '0'
                -- AND apps_operator_privilege.`privilege` NOT LIKE '0%'
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
		/*
		$sql = "SELECT apps_menus.`id`, apps_menus.parent, apps_menus.`menu_link`,
                apps_menus.`menu_name`, apps_menus.`status`, IFNULL(apps_operator_privilege.`privilege`, '0000') AS privilege, apps_menus.menu_icon, apps_menus.menu_display
                FROM apps_menus
                LEFT JOIN apps_operator_privilege ON apps_menus.`id` = apps_operator_privilege.`menus_id` AND apps_operator_privilege.`operator_id` = ?
                WHERE apps_menus.`status` = '1'
                AND apps_menus.parent = ?
                AND apps_operator_privilege.`privilege` NOT LIKE '0%'
                ORDER BY apps_menus.`menu_ordering` ASC";
		*/

		$sql   = "SELECT
				    apps_menus.`id`,
				    apps_menus.parent,
				    apps_menus.`menu_link`,
				    apps_menus.`menu_name`,
				    apps_menus.`status`,
				    IFNULL(
				         apps_operator_privilege.`privilege`,
				         '0000'
				     ) AS privilege,
				    apps_menus.menu_icon,
				    apps_menus.menu_display
				FROM
				    apps_menus
				     LEFT JOIN apps_operator_privilege ON apps_menus.`id` = apps_operator_privilege.`menus_id` AND apps_operator_privilege.`operator_id` = ?
				WHERE
				    1 = 1 AND apps_menus.`status` = '1' AND apps_menus.parent = ?
				    -- AND apps_operator_privilege.`privilege` NOT LIKE '0%'
				ORDER BY
				    apps_menus.`menu_ordering` ASC";
		$query = $this->db->query($sql, array($operator_id, $parent));
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
	}

	public function get_menu()
	{
		$operator_id = $this->session->userdata('IDX_SESS')['app_id'];
		$query       = $this->db->query("SET sql_mode = ''");
		if (!empty($operator_id)) {
			$menus       = $this->get_menus_parent($operator_id);
			$data        = array();
			$link        = array();
			$link_child  = array();
			$child_id    = array();
			$child_array = array();
			$int         = 0;
			$i           = 0;
			$j           = 0;
			foreach ($menus as $key => $menu) {
				$i                       = $int;
				$link                    = array();
				$child_id                = array();
				$data[$int]              = $menu;
				$data[$int]['is_parent'] = $this->is_parent($menu['id']);
				$link[]                  = $menu['menu_link'];
				$level                   = $data[$int]['lvl'];
				if ($data[$int]['is_parent']) {
					$childs = $this->get_menus_childs($operator_id, $menu['id']);
					foreach ($childs as $child) {
						$link_child  = array();
						$child_array = array();
						$link[]      = $child['menu_link'];
						$child_id[]  = $child['id'];
						$int++;
						$j                       = $int;
						$data[$int]              = $child;
						$data[$int]['is_parent'] = $this->is_parent($child['id']);
						$link_child[]            = $menu['menu_link'];
						$data[$int]['lvl']       = $level + 1;
						if ($data[$int]['is_parent']) {
							$childs_2 = $this->get_menus_childs($child['id']);
							foreach ($childs_2 as $child_2) {
								$link[]        = $child_2['menu_link'];
								$child_id[]    = $child_2['id'];
								$link_child[]  = $child_2['menu_link'];
								$child_array[] = $child_2['id'];
								$int++;
								$data[$int]        = $child;
								$data[$int]['lvl'] = $level + 2;
							}
						}
						if ($menu['privilege'] == '1000' && empty($childs[$key + 1])) {
							break;
						}
						$data[$j]['link_array'] = $link_child;
						$data[$j]['child']      = $child_array;
					}
				}
				if ($menu['privilege'] == '1000' && empty($menus[$key + 1])) {
					break;
				}
				$data[$i]['link_array'] = $link;
				$data[$i]['child']      = $child_id;
				$int++;
			}
		}
		// echo "<pre>";
		// print_r($data);
		// exit();
		return $data;
	}

	private function get_menu_sidebar($parameter_parent = 0, $parameter_html = '')
	{
		$operator_id = $this->session->userdata('IDX_SESS')['app_id'];

		$parameter_html = '';
		$this->db->select('id, parent, menu_ordering, menu_name, menu_icon, menu_link, menu_display');
		if (PRIVILEGES_ON == true) {
			$this->db->join('apps_operator_privilege', "apps_menus.id = apps_operator_privilege.menus_id AND apps_operator_privilege.operator_id = '" . $operator_id . "'", 'INNER');
		} else {
			$this->db->join('apps_operator_privilege', "apps_menus.id = apps_operator_privilege.menus_id AND apps_operator_privilege.operator_id = '" . $operator_id . "'", 'LEFT');
		}
		$this->db->where('status', 1);
		$this->db->where('menu_display', 1);
		$this->db->where('parent', $parameter_parent);
		if (PRIVILEGES_ON == true) {
			$this->db->like('privilege', '1', 'after');
		}
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
					$result = $this->get_menu_sidebar($menu_id, $parameter_html);

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

	protected function display($tpl_content = 'partials/default.php', $parameter_data = [], $tpl_footer = '')
	{

		//		$menu = $this->get_menu();
		//		$this->session->set_userdata('menu', $menu);

		$data = $parameter_data;

		$config_file_js  = $this->file_js;
		$config_file_css = $this->file_css;

		/** Add default */
		$data['template_title']        = $this->apps_title_module . ' | ' . $this->apps_title;
		$data['template_title_module'] = $this->apps_title_module;
		$data['template_setting']      = $this->apps_setting;
		$data['template_breadcrumb']   = $this->apps_breadcrumb;
		$data['FILE_CSS']              = $this->file_css;
		$data['FILE_JS']               = $this->file_js;
		$data['CSRF']                  = $this->csrf;
		$data['CSRF_JSON']             = "&{$this->csrf['name']}={$this->csrf['hash']}";
		$data['CSRF_JS']               = $this->csrf_js;
		$page_partials                 = [
			'partials_menu'               => $this->get_menu_sidebar(0, ''),
			'partials_meta_css'           => "{$this->module_portal}/partials/meta_css",
			'partials_header'             => "{$this->module_portal}/partials/header",
			'partials_sidebar'            => "{$this->module_portal}/partials/sidebar",
			'partials_navbar'             => "{$this->module_portal}/partials/navbar",
			'partials_footer'             => "{$this->module_portal}/partials/footer",
			'partials_footer_script'      => "{$this->module_portal}/partials/script",
			'page_content'                => $tpl_content,
			'partials_footer_script_page' => $tpl_footer,
			'partials_global'             => "{$this->module_global_view}",
			'partials_view'               => "{$this->module_base}/views/",
			'partials_module_name'        => $this->module_base,
		];

		$data['template'] = $page_partials;

		$this->load->view('admin/themes', $data);
	}

	public function get_privilege()
	{

		// get privilege menu
		$menu        = $this->uri->segment(1);
		$operator_id = $this->session->userdata('IDX_SESS')['app_id'];
		$privilege   = '1000';
		if (!in_array($menu, $this->allowed_menus)) {
			$params    = array($operator_id, $menu);
			$privilege = $this->get_privilege_by_menu($params);
			$CRUD      = str_split($privilege);
			$list      = $CRUD[0];
			$add       = $CRUD[1];
			$edit      = $CRUD[2];
			$delete    = $CRUD[3];

			if (!empty($this->uri->segment(2))) {
				$submenu = $this->uri->segment(2);
				if ($submenu == 'add' && !$add) {
					$this->apps_output_message = [
						'status'  => 'error',
						'title'   => '',
						'message' => "You are not allowed to access that menu",
					];
					$this->set_output_action($menu);
					// redirect($menu);
				} else if ($submenu == 'edit' && !$edit) {
					$this->apps_output_message = [
						'status'  => 'error',
						'title'   => '',
						'message' => "You are not allowed to access that menu",
					];
					$this->set_output_action($menu);
				} else if ($submenu == 'delete' && !$delete) {
					$this->apps_output_message = [
						'status'  => 'error',
						'title'   => '',
						'message' => "You are not allowed to access that menu",
					];
					$this->set_output_action($menu);
				}
			} else {
				if (!$list) {
					$this->apps_output_message = [
						'status'  => 'error',
						'title'   => '',
						'message' => "You are not allowed to access that menu",
					];
					$this->set_output_action("mod_dashboard");
					// redirect("mod_dashboard");
				}
			}
		}

		return $privilege;
	}

	// get menu privilege
	public function get_privilege_by_menu($params = null)
	{
		$sql   = "SELECT privilege FROM apps_operator_privilege a
                INNER JOIN apps_menus b ON a.`menus_id` = b.`id`
                WHERE a.`operator_id` = ? AND b.`menu_link` = ?";
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
			return $result['privilege'];
		} else {
			return '';
		}
	}

	/**
	 * ========================================================================================================
	 * ACTION GLOBAL FOR CMS ADMIN
	 * ========================================================================================================
	 */

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
		$this->action_checkbox_status_process();
	}

	public function delete_process($parameter_id = null)
	{
		$this->action_delete_process($parameter_id);
	}

	public function delete_checkbox_process()
	{
		$this->action_checkbox_delete_process();
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

	protected function custom_process()
	{
		if (!empty($_POST['bd_hours_work'])) {
			$_POST['bd_hours_work'] = str_replace('<br />', '', $_POST['bd_hours_work']);
			$_POST['bd_hours_work'] = str_replace('<br/>', '', $_POST['bd_hours_work']);
			$_POST['bd_hours_work'] = str_replace('<br >', '', $_POST['bd_hours_work']);
			$_POST['bd_hours_work'] = str_replace('<br>', '', $_POST['bd_hours_work']);
			$_POST['bd_hours_work'] = ($_POST['bd_hours_work']);

			if (!empty($_POST['bd_hours_work'])) {
				foreach ($_POST['bd_hours_work'] as $index => $row) {
					if (($_POST['bd_hours_work'][$index]['status']) == 'open') {
						unset($_POST['bd_hours_work'][$index]['status']);
					} else {
						unset($_POST['bd_hours_work'][$index]);
					}
				}
			}

			$_POST['bd_hours_work'] = json_encode([$_POST['bd_hours_work']]);
		}


		if (!empty($_POST['country_id'])) {
			$_POST['data_locations']['country_id'] = ($_POST['country_id']);
			$get_loc_country                       = $this->db->get_where('loc_countries', array('id' => $_POST['country_id']))->row_array();
			if (!empty($get_loc_country)) {
				$_POST['data_locations']['country_name'] = $get_loc_country['name'];
			}
			unset($_POST['country_id']);
		}
		if (!empty($_POST['state_id'])) {
			$_POST['data_locations']['state_id'] = ($_POST['state_id']);
			$get_loc_state                       = $this->db->get_where('loc_states', array('id' => $_POST['state_id']))->row_array();
			if (!empty($get_loc_state)) {
				$_POST['data_locations']['state_name'] = $get_loc_state['name'];
			}
			unset($_POST['state_id']);
		}

		if (!empty($_POST['city_id'])) {
			$_POST['data_locations']['city_id'] = ($_POST['city_id']);
			$get_loc_city                       = $this->db->get_where('loc_cities', array('id' => $_POST['city_id']))->row_array();
			if (!empty($get_loc_city)) {
				$_POST['data_locations']['city_name'] = $get_loc_city['name'];
			}
			unset($_POST['city_id']);
		}

		if (!empty($_POST['data_locations'])) {
			$_POST['data_locations'] = json_encode(array($_POST['data_locations']));
		}
		if (!empty($_POST['data_categories'])) {
			$_POST['data_categories'] = json_encode($_POST['data_categories']);
		}
		if (!empty($_POST['data_facilities'])) {
			$_POST['data_facilities'] = json_encode($_POST['data_facilities']);
		}

		if (isset($_POST['price_currency'])) {
			if ($_POST['price_currency'] == 'IDR') {
				if (isset($_POST['price_low'])) {
					$_POST['price_low'] = str_replace('.', '', $_POST['price_low']);
					$_POST['price_low'] = str_replace(',', '', $_POST['price_low']);
				}

				if (isset($_POST['price_high'])) {
					$_POST['price_high'] = str_replace('.', '', $_POST['price_high']);
					$_POST['price_high'] = str_replace(',', '', $_POST['price_high']);
				}
			} else {
				if (isset($_POST['price_low'])) {
					$_POST['price_low'] = str_replace(',', '', $_POST['price_low']);
				}
				if (isset($_POST['price_high'])) {
					$_POST['price_high'] = str_replace(',', '', $_POST['price_high']);
				}
			}
		}


		if (isset($_POST['jb_salary_currency'])) {
			if ($_POST['jb_salary_currency'] == 'IDR') {
				if (isset($_POST['jb_salary_min'])) {
					$_POST['jb_salary_min'] = str_replace('.', '', $_POST['jb_salary_min']);
					$_POST['jb_salary_min'] = str_replace(',', '', $_POST['jb_salary_min']);
				}
				if (isset($_POST['jb_salary_max'])) {
					$_POST['jb_salary_max'] = str_replace('.', '', $_POST['jb_salary_max']);
					$_POST['jb_salary_max'] = str_replace(',', '', $_POST['jb_salary_max']);
				}
			} else {
				if (isset($_POST['jb_salary_min'])) {
					$_POST['jb_salary_min'] = str_replace(',', '', $_POST['jb_salary_min']);
				}
				if (isset($_POST['jb_salary_max'])) {
					$_POST['jb_salary_max'] = str_replace(',', '', $_POST['jb_salary_max']);
				}
			}

		}

		if (isset($_POST['price_type'])) {

			if ($_POST['price_type'] == 2) {
				/* Fixed Price*/
				$_POST['price_high']    = $_POST['price_low'];
				$_POST['price_variant'] = null;
			} else if ($_POST['price_type'] == 3) {
				$_POST['price_high']    = 0;
				$_POST['price_variant'] = null;
			} else if ($_POST['price_type'] == 4) {
				$_POST['price_low']     = 0;
				$_POST['price_high']    = 0;
				$_POST['price_variant'] = null;
			} else if ($_POST['price_type'] == 5) {
				$_POST['price_low']  = 0;
				$_POST['price_high'] = 0;

				$array_json = array();
				if (!empty($_POST['price_variant'])) {
					foreach ($_POST['price_variant'] as $index => $row) {
						if ($row['qty'] == '') {
							unset($_POST['price_variant'][$index]);
						} else {
							if ($_POST['price_currency'] == 'IDR') {
								$_POST['price_variant'][$index]['price'] = str_replace('.', '', $_POST['price_variant'][$index]['price']);
								$_POST['price_variant'][$index]['price'] = str_replace(',', '', $_POST['price_variant'][$index]['price']);
							} else {
								$_POST['price_variant'][$index]['price'] = str_replace(',', '', $_POST['price_variant'][$index]['price']);
							}


							$array_json[] = $_POST['price_variant'][$index];
						}
					}
				}

				$_POST['price_variant'] = json_encode($array_json);
			}
		}

		/** Business Contact Info dataset formatter */

		$data_set_post = 'data_business_contact';
		$data_set_save = 'data_contact_info';
		if (isset($_POST[$data_set_post])) {

			if (isset($_POST[$data_set_post]['email'])) {
				$_POST[$data_set_post]['email'] = array_filter($_POST[$data_set_post]['email']);
				sort($_POST[$data_set_post]['email']);
			}

			if (isset($_POST[$data_set_post]['phone'])) {
				$_POST[$data_set_post]['phone'] = array_filter($_POST[$data_set_post]['phone']);
				sort($_POST[$data_set_post]['phone']);
			}

			$_POST[$data_set_save] = json_encode($_POST[$data_set_post]);
			unset($_POST[$data_set_post]);
		}

		/** Community dataset formatter */

		$data_set_post = 'data_community_contact';
		$data_set_save = 'data_contact_info';
		if (isset($_POST[$data_set_post])) {

			if (isset($_POST[$data_set_post]['email'])) {
				$_POST[$data_set_post]['email'] = array_filter($_POST[$data_set_post]['email']);
				sort($_POST[$data_set_post]['email']);
			}

			if (isset($_POST[$data_set_post]['phone'])) {
				$_POST[$data_set_post]['phone'] = array_filter($_POST[$data_set_post]['phone']);
				sort($_POST[$data_set_post]['phone']);
			}

			$_POST[$data_set_save] = json_encode($_POST[$data_set_post]);
			unset($_POST[$data_set_post]);
		}

		$data_set_post = 'data_social_links';
		$data_set_save = 'data_social_links';
		if (isset($_POST[$data_set_post])) {
			$_POST[$data_set_save] = json_encode(array($_POST[$data_set_post]));
		}

		$data_set_post = 'data_contact_website';
		$data_set_save = 'data_contact_website';
		if (isset($_POST[$data_set_post])) {
			$_POST[$data_set_post] = array_filter($_POST[$data_set_post]);
			if (!empty($_POST[$data_set_post])) {
				foreach ($_POST[$data_set_post] as $index => $row) {
					if ($row['website'] == '') {
						unset($_POST[$data_set_post][$index]);
					}
				}
			}
			sort($_POST[$data_set_post]);
			$_POST[$data_set_save] = json_encode($_POST[$data_set_post]);
		}

		if (isset($_POST['bd_maps'])) {
			$get_src = $this->get_iframe_src($_POST['bd_maps']);
			if (!empty($get_src)) {
				$get_src          = $get_src[0];
				$_POST['bd_maps'] = $get_src;
			}
		}

//		echo '<Pre>';
//		print_r($_POST);
//		exit();
	}

	private function get_iframe_src($input)
	{
		preg_match_all("/<iframe[^>]*src=[\"|']([^'\"]+)[\"|'][^>]*>/i", $input, $output);
		$return = array();
		if (isset($output[1][0])) {
			$return = $output[1];
		}
		return $return;
	}

	public function approve_process($id){
		$note = $this->input->post('note');
		$variable = [
			'note' => $this->input->post('note'),
			'status' => $this->input->post('status')
		];

		$status = [
			'status_verification' => 1
		];

		$this->db->where('id',$id);
		$this->db->update('pbd_business', $status);

		$this->db->where('business_id',$id);
		$this->db->update('pbd_business_claims', $variable);
		$check  =  $this->db->get_where('pbd_business_claims',["business_id" => $id])->row();
		if(!empty($check->email)){
			
			$template = '<!DOCTYPE html>
			<html>
			  <head>
				<meta charset="utf-8" />
				<meta http-equiv="x-ua-compatible" content="ie=edge" />
				<title>IndoConnex Account Activation</title>
				<meta name="viewport" content="width=device-width, initial-scale=1" />
				<style type="text/css">
				  /**
			   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
			   */
				  @media screen {
					@font-face {
					  font-family: "Source Sans Pro";
					  font-style: normal;
					  font-weight: 400;
					  src: local("Source Sans Pro Regular"), local("SourceSansPro-Regular"),
						url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff)
						  format("woff");
					}

					@font-face {
					  font-family: "Source Sans Pro";
					  font-style: normal;
					  font-weight: 700;
					  src: local("Source Sans Pro Bold"), local("SourceSansPro-Bold"),
						url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff)
						  format("woff");
					}
				  }

				  /**
			   * Avoid browser level font resizing.
			   * 1. Windows Mobile
			   * 2. iOS / OSX
			   */
				  body,
				  table,
				  td,
				  a {
					-ms-text-size-adjust: 100%; /* 1 */
					-webkit-text-size-adjust: 100%; /* 2 */
				  }

				  /**
			   * Remove extra space added to tables and cells in Outlook.
			   */
				  table,
				  td {
					mso-table-rspace: 0pt;
					mso-table-lspace: 0pt;
				  }

				  /**
			   * Better fluid images in Internet Explorer.
			   */
				  img {
					-ms-interpolation-mode: bicubic;
				  }

				  /**
			   * Remove blue links for iOS devices.
			   */
				  a[x-apple-data-detectors] {
					font-family: inherit !important;
					font-size: inherit !important;
					font-weight: inherit !important;
					line-height: inherit !important;
					color: inherit !important;
					text-decoration: none !important;
				  }

				  /**
			   * Fix centering issues in Android 4.4.
			   */
				  div[style*=\'margin: 16px 0;\'] {
					margin: 0 !important;
				  }

				  body {
					width: 100% !important;
					height: 100% !important;
					padding: 0 !important;
					margin: 0 !important;
				  }

				  /**
			   * Collapse table borders to avoid space between cells.
			   */
				  table {
					border-collapse: collapse !important;
				  }

				  a {
					color: #1a82e2;
				  }

				  img {
					height: auto;
					line-height: 100%;
					text-decoration: none;
					border: 0;
					outline: none;
				  }
				</style>
			  </head>
			  <body style="background-color: #e9ecef">

				<!-- start body -->
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
				  <!-- start logo -->
				  <tr>
					<td align="center" bgcolor="#e9ecef">
					  <!--[if (gte mso 9)|(IE)]>
					<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
					<tr>
					<td align="center" valign="top" width="600">
					<![endif]-->
					  <table
						border="0"
						cellpadding="0"
						cellspacing="0"
						width="100%"
						style="max-width: 600px"
					  >
						<tr>
						  <td align="center" valign="top" style="padding: 36px 24px">
							<a
							  href="'.base_url().'"
							  target="_blank"
							  style="display: inline-block"
							>
							  <img
								src="https://dev.indoconnex.com/public/themes/user/images/logo/indoconnex-logo.png"
								alt="Logo"
								border="0"
								width="100"
								style="
								  display: block;
								  width: 100px;
								  max-width: 100px;
								  min-width: 100px;
								"
							  />
							</a>
						  </td>
						</tr>
					  </table>
					  <!--[if (gte mso 9)|(IE)]>
					</td>
					</tr>
					</table>
					<![endif]-->
					</td>
				  </tr>
				  <!-- end logo -->

				  <!-- start hero -->
				  <tr>
					<td align="center" bgcolor="#e9ecef">
					  <!--[if (gte mso 9)|(IE)]>
					<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
					<tr>
					<td align="center" valign="top" width="600">
					<![endif]-->
					  <table
						border="0"
						cellpadding="0"
						cellspacing="0"
						width="100%"
						style="max-width: 600px"
					  >
						<tr>
						  <td
							align="left"
							bgcolor="#ffffff"
							style="
							  padding: 36px 24px 0;
							  font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;
							  border-top: 3px solid #d4dadf;
							"
						  >
							<h1
							  style="
								margin: 0;
								font-size: 32px;
								font-weight: 700;
								letter-spacing: -1px;
								line-height: 48px;
							  "
							>
							  Your Business
							</h1>
						  </td>
						</tr>
					  </table>
					  <!--[if (gte mso 9)|(IE)]>
					</td>
					</tr>
					</table>
					<![endif]-->
					</td>
				  </tr>
				  <!-- end hero -->

				  <!-- start copy block -->
				  <tr>
					<td align="center" bgcolor="#e9ecef">
					  <!--[if (gte mso 9)|(IE)]>
					<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
					<tr>
					<td align="center" valign="top" width="600">
					<![endif]-->
					  <table
						border="0"
						cellpadding="0"
						cellspacing="0"
						width="100%"
						style="max-width: 600px"
					  >

						<!-- start button -->
						<tr>
						  <td align="left" bgcolor="#ffffff">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
							  <tr>
								<td align="center" bgcolor="#ffffff" style="padding: 12px">
								  <table border="0" cellpadding="0" cellspacing="0">
									<tr>
									  <td
										align="center"
										bgcolor="#1a82e2"
										style="border-radius: 6px"
									  >
									  </td>
									</tr>
								  </table>
								</td>
							  </tr>
							</table>
						  </td>
						</tr>
						<!-- end button -->

						<!-- start copy -->
						<tr>
						  <td
							align="left"
							bgcolor="#ffffff"
							style="
							  padding: 24px;
							  font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;
							  font-size: 16px;
							  line-height: 24px;
							"
						  >
							<p style="margin: 0">
							 "'.$note.'"
							</p>
						  </td>
						</tr>
						<!-- end copy -->

						<!-- start copy -->
						<tr>
						  <td
							align="left"
							bgcolor="#ffffff"
							style="
							  padding: 24px;
							  font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;
							  font-size: 16px;
							  line-height: 24px;
							  border-bottom: 3px solid #d4dadf;
							"
						  >
							<p style="margin: 0">
							  Cheers,<br />
							  IndoConnex Team
							</p>
						  </td>
						</tr>
						<!-- end copy -->
					  </table>
					  <!--[if (gte mso 9)|(IE)]>
					</td>
					</tr>
					</table>
					<![endif]-->
					</td>
				  </tr>
				  <!-- end copy block -->

				  <!-- start footer -->
				  <tr>
					<td align="center" bgcolor="#e9ecef" style="padding: 24px">
					  <!--[if (gte mso 9)|(IE)]>
					<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
					<tr>
					<td align="center" valign="top" width="600">
					<![endif]-->
					  <table
						border="0"
						cellpadding="0"
						cellspacing="0"
						width="100%"
						style="max-width: 600px"
					  >
						<!-- start unsubscribe -->
						<tr>
						  <td
							align="center"
							bgcolor="#e9ecef"
							style="
							  padding: 12px 24px;
							  font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;
							  font-size: 14px;
							  line-height: 20px;
							  color: #666;
							"
						  >
							<p style="margin: 0">
							  To stop receiving these emails, you can
							  <a href="'.base_url().'" target="_blank">unsubscribe</a>
							  at any time.
							</p>
							<p style="margin: 0"></p>
						  </td>
						</tr>
						<!-- end unsubscribe -->
					  </table>
					  <!--[if (gte mso 9)|(IE)]>
					</td>
					</tr>
					</table>
					<![endif]-->
					</td>
				  </tr>
				  <!-- end footer -->
				</table>
				<!-- end body -->
			  </body>
			</html>
			';
			$send_email_to  = $check->email;
			$send_email_cc  = '';
			$send_email_bcc = '';

			$data_email['email_body_message'] = $template;
			$date_request                     = date('d/m/Y H:i:s');
			$message_subject                  = "Claim Business Successful";
			$message_body                     = $data_email['email_body_message'];
			if (!empty($send_email_to)) {
				$this->swiftmailer->send_email($send_email_to, $message_subject, $message_body, $send_email_cc, $send_email_bcc);
				$this->apps_output_message = array(
					'status'  => 'success',
					'title'   => lang_text('message_register_title_success'),
					'message' => lang_text('message_register_success')
				);
				
					redirect(base_url('mod_pbd_business_claim'));
			}else{
				$this->apps_output_message = array(
					'status'  => 'success',
					'title'   => lang_text('message_register_title_error'),
					'message' => lang_text('message_register_error')
				);
				
				redirect(base_url('mod_pbd_business_claim'));
			}
		}
	}

	public function cancel_process($id){
		$variable = [
			'note' => $this->input->post('note'),
			'status' => $this->input->post('status')
		];

		$this->db->where('business_id',$id);
		$this->db->update('pbd_business_claims', $variable);
		redirect(base_url('mod_pbd_business_claim'));
	}
}
