<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_forgot_password extends CI_Controller
{
    private   $module_page         = array(
        'index'        => 'index',
        'index_footer' => 'footer_index',
    );
    protected $module_base         = 'mod_forgot_password';
    protected $apps_title_module   = 'Recover your password';
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
    }

    public function index()
    {
        $check_loggedin = $this->session->userdata(SESSION_LOGAPPS);
        if (!empty($check_loggedin['app_user_username'])) {
            redirect('mod_dashboard');
        }

        if ($this->input->post()) {
            $this->set_form_validation();
            $this->forgot_password_process();
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

    private function forgot_password_process()
    {
        $parameter_redirect_url = base_url('mod_authentication');

        $this->apps_output_message = array(
            'status'  => 'error',
            'title'   => lang_text('message_forgotpassword_title_failed'),
            'message' => lang_text('message_forgotpassword_failed')
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
                    'title'   => lang_text('message_forgotpassword_title_failed'),
                    'message' => validation_errors()
                );
            } else {

                $is_logged_in_status     = false;
                $output_result_data_user = array();

                $this->db->where('username', $this->input->post('username'));
                $output_result_data_user_check = $this->db->get('apps_operator')->row_array();
                if (!empty($output_result_data_user_check)) {
                    $password_set            = 'indoconnex_123.';
                    $data_update_password    = array(
                        'password' => func_encrypt(password_hash($password_set, PASSWORD_DEFAULT, array('cost' => 10)))
                    );
                    $data_update_password_id = array(
                        'id' => $output_result_data_user_check['id']
                    );

                    $this->base_model->update_data('apps_operator', 'id', $data_update_password_id, $data_update_password);

                    $is_logged_in_status     = true;
                    $output_result_data_user = $output_result_data_user_check;
                }

                if ($is_logged_in_status == true) {

                    if (!empty($output_result_data_user['email'])) {

                        $this->apps_output_message = array(
                            'status'  => 'success',
                            'title'   => lang_text('message_forgotpassword_title_success'),
                            'message' => lang_text('message_forgotpassword_success')
                        );

                        $parameter_redirect_url = base_url('mod_login');
                    }
                }
            }
        }

        $this->set_output_action($parameter_redirect_url);
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
}
