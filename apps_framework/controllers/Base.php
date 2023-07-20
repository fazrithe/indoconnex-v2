<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Base extends MX_Controller
{
	protected $apps_title        = '';
	protected $apps_title_module = '';
	protected $apps_breadcrumb   = array();
	protected $apps_setting      = array();
	protected $apps_model        = 'base_model';
	protected $apps_session      = array();
	protected $file_css          = '';
	protected $file_js           = '';

	public function __construct()
	{
		parent::__construct();
		$this->lang->load('output_message');
	}

	/**
	 * -------------------------------------------------------------------------------------------------------------------
	 * FUNCTION GENERAL for program
	 * -------------------------------------------------------------------------------------------------------------------
	 */

	protected function is_request_ajax()
	{
		if (!$this->input->is_ajax_request()) {
			$output = [
				'status'  => false,
				'message' => 'No access allowed'
			];
			return $this->output->set_output(json_encode($output));
		}
	}

	protected function is_request_get()
	{
		$output_status = false;
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$output_status = true;
		}
		return $output_status;
	}

	protected function is_request_post()
	{
		$output_status = false;
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$output_status = true;
		}
		return $output_status;
	}

	/**
	 * -------------------------------------------------------------------------------------------------------------------
	 * FUNCTION for GENERATE DATA
	 * -------------------------------------------------------------------------------------------------------------------
	 */

	protected function generate_new_id_string()
	{
		return strtoupper(date('ymd') . uniqid());
	}

	protected function generate_array_from_table_column($table = null, $data = null, $mode = null)
	{
		$output           = [];
		$get_column_table = $this->{$this->apps_model}->show_table_column($table);

		/* VALIDATE TABLE HAVE COLUMN */
		if (!empty($get_column_table) && is_array($output)) {
			foreach ($get_column_table as $index => $row) {
				if ($row['Key'] != 'PRI') {
					$output[$row['Field']] = (!empty($data[$row['Field']])) ? $data[$row['Field']] : null;

					if ($row['Default'] != '') {
						$output[$row['Field']] = (!empty($data[$row['Field']])) ? $data[$row['Field']] : $row['Default'];
						if (!empty($output[$row['Field']])) {
							if (array_key_exists($row['Field'], $data)) {
								$output[$row['Field']] = $data[$row['Field']];
							}
						}
					}

					/* SET DEFAULT FOR BASED ON CASE COLUMN */
					if ($row['Field'] == 'parent') {
						$output['parent'] = (!empty($data['parent'])) ? $data['parent'] : 0;
					}

					if ($row['Field'] == 'ordering') {
						$output['ordering'] = (!empty($data['ordering'])) ? $data['ordering'] : 0;
					}

					if ($row['Field'] == 'slug') {
						$output['slug'] = (!empty($data['title'])) ? strtolower(url_title($data['title'])) : null;
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

	protected function generate_array_from_table_lang_column()
	{

	}

	protected function generate_dropdown_without_lang()
	{

	}

	protected function generate_dropdown_with_lang()
	{

	}

	protected function generate_select_general()
	{

	}

	protected function generate_random_alphanumeric()
	{

	}

	protected function generate_random_number()
	{

	}

	protected function generate_logs_activity()
	{

	}

	/**
	 * -------------------------------------------------------------------------------------------------------------------
	 * FUNCTION for LOAD, UNLOAD, SET, UNSET
	 * -------------------------------------------------------------------------------------------------------------------
	 */

	protected function load_extra_css($address = null, $external = false)
	{
		if ($external) {
			$this->file_css .= '<link rel="stylesheet" type="text/css" href="' . $address . '"/>';
		} else {
			$this->file_css .= '<link rel="stylesheet" type="text/css" href="' . ($address) . '"/>';
		}
	}

	protected function load_extra_js($address = null, $external = false)
	{
		if ($external) {
			$this->file_js .= '<script type="text/javascript" src="' . $address . '"></script>';
		} else {
			$this->file_js .= '<script type="text/javascript" src="' . ($address) . '"></script>';
		}

	}

	protected function set_configuration()
	{

	}

	protected function get_configuration()
	{

	}

	protected function set_output()
	{

	}

	protected function get_output()
	{

	}

	protected function set_form_validation()
	{

	}

	/**
	 * -------------------------------------------------------------------------------------------------------------------
	 * FUNCTION for ACTION
	 * -------------------------------------------------------------------------------------------------------------------
	 */

	protected function action_image_process()
	{
		/**
		 * 1. Validate input file (multiple or not)
		 * 2. Check file type for upload image
		 * 3. Check process is new / update data image
		 * 4. Process upload image and generate thumbnail
		 * 5. Create record for succes image upload on server to database
		 */

	}

	protected function action_image_process_delete()
	{
		/**
		 * 1. Validate data for delete image
		 * 2. Check data from database (file name and file path)
		 * 3. Check image on server, if exist
		 * 4. if Exist, delete image on server
		 * 5. if delete success, process to delete data record on database
		 */

	}

	private function action_image_process_upload()
	{
		/**
		 *  1. Process upload image to server
		 *  2. validate file type and size
		 *  3. create multiple file for other dimension proportional
		 */

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
}
