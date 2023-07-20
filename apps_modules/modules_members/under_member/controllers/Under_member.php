<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Under_member extends Base_users
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        if(!empty($this->session->userdata('is_login') == FALSE)){
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }
    }

    public function index()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Partnership',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $this->display('index', $data);
    }

}
