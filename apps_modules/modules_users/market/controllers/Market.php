<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Market extends Base_users
{
    protected $module_base                  = 'market/list';
    protected $apps_title_module            = 'profile';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation','pagination');
        $this->load->model('M_market');
        if(!empty($this->session->userdata('is_login') == FALSE)){
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }
    }

    public function list()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Dashboard',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),

        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $data['business_list'] = $this->db->get_where('pbd_business',array('created_by'=>$user_id))->result();
        $data['items_list'] = $this->db->get_where('pbd_items',array('status'=>1))->result();
        $this->display('list', $data);
    }

    public function create()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Dashboard',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),

        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $data["labeles"]         = $this->db->get_where('pbd_items_labels',array('status'=>1))->result();
        $data["types"]         = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
        $data['business_list'] = $this->db->get_where('pbd_business',array('created_by'=>$user_id))->result();
        $data["categories"]         = $this->db->get_where('pbd_items_categories',array('status'=>1))->result();
        $this->display('create', $data);
    }

    public function store($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/market/create/';
        $this->action_store_market($parameter_url_source, $parameter_id);
    }

    public function update($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/market/create/';
        $this->action_update_market($parameter_url_source, $parameter_id);
    }

    public function delete_product()
    {
        $product_id = $this->input->post('product_id');
        $this->db->where('id',$product_id);
        $this->db->delete('users_albums_photo');
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Dashboard',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),

        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $data["types"]         = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
        $data["categories"]         = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
        $this->display('index', $data);
    }

    public function discover() {

        $user_id     = $_SESSION['user_id'];
        $name       = $this->input->get('product-name');
        $location   = $this->input->get('product-location');
        $type       = $this->input->get('product-type');
        $category   = $this->input->get('product-category');

        if($name || $location || $type || $category){
            $data = [
                'title_web' => 'Dashboard',
                'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),

            ];
            $data['CSRF'] = [
                'id' => $user_id,
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
            // $data['business']      = $this->m_business->search_business($name)->result();

            $countdata = 0; //$this->M_business->count_data();
            $config['base_url'] = site_url('market/discover'); //site url
            $config['total_rows'] = $countdata;
            $config['per_page'] = 6;
            $config["uri_segment"] = 6;  // uri parameter
            $choice = (int) ceil((double)$config["total_rows"] / $config["per_page"]);
            $config["num_links"] = floor($choice);
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
            $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close']    = '</span></li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
            $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close']  = '</span>Next</li>';
            $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close']  = '</span></li>';

            $this->pagination->initialize($config);

            $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['products'] = $this->M_market->search_product($name,$type,$config['per_page'],$data['page']);
            $data["item_categories"]    = $this->db->get_where('pbd_items_categories', array('status'=>1))->result();
            $data["item_labels"]        = $this->db->get_where('pbd_items_labels', array('status'=>1))->result();
            $data["countries"]          = $this->db->get('loc_countries')->result();
            $data['pagination']     = $this->pagination->create_links();
            $data['total_rows']     = $countdata;
            $data['choice']         = $choice;
            $this->display('discover', $data);
        }else{

            $data = [
                'title_web' => 'Dashboard',
                'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),

            ];
            $data['CSRF'] = [
                'id' => $user_id,
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
            $countdata = 0;#$this->M_business->count_data();
            $config['base_url'] = site_url('market/discover'); //site url
            $config['total_rows'] = $countdata;
            $config['per_page'] = 6;
            $config["uri_segment"] = 6;  // uri parameter
            $choice = (int) ceil((double)$config["total_rows"] / $config["per_page"]);
            $config["num_links"] = floor($choice);
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
            $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close']    = '</span></li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
            $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close']  = '</span>Next</li>';
            $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close']  = '</span></li>';

            $this->pagination->initialize($config);

            $data['page']               = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['products']           = $this->M_market->search_product($name,$type,$config['per_page'],$data['page']);
            $data["item_categories"]    = $this->db->get_where('pbd_items_categories', array('status'=>1))->result();
            $data["item_labels"]        = $this->db->get_where('pbd_items_labels', array('status'=>1))->result();
            $data["countries"]          = $this->db->get('loc_countries')->result();
            $data["product_all"]        = $this->db->get('pbd_items')->result();
            $data['pagination']         = $this->pagination->create_links();
            $data['total_rows']         = $countdata;
            $data['choice']             = $choice;
            $this->display('discover', $data);
        }
    }
}
