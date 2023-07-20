<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_front.php';

class Under_public extends Base_front
{
    protected $module_base                  = 'dahboard';
    protected $apps_title_module            = 'Dashboard';
    private   $_table                       = "users";
    protected $apps_output_message = array(
        'status'  => '',
        'title'   => '',
        'message' => ''
    );
    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        $this->lang->load('output_message');
        $this->load->helper(array('form', 'url','string'));
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        if ($this->input->post()) {

        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module,
                'meta_position' => 1,
				'meta_type' => 'page'
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
            if(!empty($this->session->userdata('is_login'))){
                $id = $this->session->userdata('user_id');
                $data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
            }
            $this->display('index', $data);
        }
    }

}
