<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Api extends Base_users
{
    private   $module_page         = array(
        'index'        => 'index',
    );
    protected $module_base                  = 'api';
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
        $this->load->model('Main_model');

        if(!empty($this->session->userdata('is_login') == FALSE)){
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }

    }

    public function country()
    {
        $searchTerm = $this->input->post('searchTerm');
        $data_id = $this->Main_model->getCountry_rows($searchTerm);
        $data['response'] = $this->Main_model->getCountry($searchTerm);
        $data['CSRF'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $data['country_id'] = $data_id->id;
        echo json_encode($data);
    }

    public function country_update($id)
    {
        $searchTerm = $this->input->post('searchTerm');
        $data_id = $this->Main_model->getCountry_rows($searchTerm);
        $data['response'] = $this->Main_model->getCountry($searchTerm);
        $data['CSRF'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $data['country_id'] = $data_id->id;
        echo json_encode($data);
    }

    public function state($country_id)
    {
        $searchTerm = $this->input->post('searchTerm');
        $data['response'] = $this->Main_model->getState($country_id, $searchTerm);
        $data['CSRF'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $data['token2'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function city($state_id)
    {
        $searchTerm = $this->input->post('searchTerm');
        $data['response'] = $this->Main_model->getCity($state_id, $searchTerm);
        $data['CSRF'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $data['token2'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function business()
    {
        $data=$this->db->get('pbd_business')->result();
        echo json_encode($data);

    }

    public function business_type($id)
    {
        $data=$this->db->get_where('pbd_business_types', array('id'=> $id))->result();
        echo json_encode($data);
    }

    public function job_category($id)
    {
        $data=$this->db->get_where('pcj_jobs_categories', array('id'=> $id))->result();
        echo json_encode($data);
    }

    public function job_type($id)
    {
        $data=$this->db->get_where('pcj_jobs_types', array('id'=> $id))->result();
        echo json_encode($data);
    }

    public function distributor_type($id)
    {
        $data=$this->db->get_where('pbd_business_distributor_types', array('id'=> $id))->result();
        echo json_encode($data);
    }
}
