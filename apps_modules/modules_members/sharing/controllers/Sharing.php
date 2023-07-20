<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Sharing extends Base_users
{
    private   $module_page         = array(
        'index'        => 'index',
    );
    protected $module_base                  = 'Sharing';
    protected $apps_output_message = array(
        'status'  => '',
        'title'   => '',
        'message' => ''
    );

    public function __construct()
    {
      parent::__construct();
      $this->load->model('M_sharing');
    }

    public function index($post)
    {
        $data = [
            'title_web' => 'Indoconnex',
            'posts'     => $this->M_sharing->post_all($post)->result(),
            'users_all' => $this->M_sharing->get_users('users')->result(),
            'business'  => $this->db->get_where('pbd_business',array('status' => 1), 4)->result(),
            'business_categories' => $this->db->get('pbd_business_categories')->result(),

        ];
        $data['CSRF'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $this->display('index', $data);
    }
}
