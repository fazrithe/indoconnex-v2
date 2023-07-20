<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Jobs extends Base_users
{
    protected $module_base                  = 'jobs/list';
    protected $apps_title_module            = 'profile';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation','pagination');
        // $this->load->model('M_business');
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
        // $data["types"]         = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
        // $data["categories"]         = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
        $this->display('create', $data);
    }

    public function store($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/business/create/';
        $this->action_store_business($parameter_url_source, $parameter_id);
    }

    public function update($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/business/';
        $this->action_update_business($parameter_url_source, $parameter_id);
    }

    public function update_about()
    {
        $this->form_validation->set_rules('business-description','Business Description','required');
        if($this->form_validation->run() != false){
            $id = $this->input->post('id');
            $post['data_about']      = $this->input->post('business-description');
            $post['created_by']     = $_SESSION['user_id'];
            $post['updated_at']     = date('Y-m-d H:i:s');
            $this->db->where('id',$id);
            $this->db->update('pbd_business', $post);
            redirect(base_url('business/list/'));
		}else{
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
    }

    protected function set_form_validation($ID = FALSE)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br/>');
        /* SET FORM VALIDATION RULES FOR COLUMN */
        $this->form_validation->set_rules("business-name", "Business Name {$this->apps_title_module}", 'required');
    }

    public function photo_process($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/business/profile/post/' . $parameter_id;
        $this->action_edit_process_photo_business($parameter_url_source, $parameter_id);
    }

    public function cover_process($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/business/profile/post/' . $parameter_id;
        $this->action_edit_process_cover_business($parameter_url_source, $parameter_id);
    }

    private function update_business_verification()
    {
        $user_id = $_SESSION['user_id'];
        $this->form_validation->set_rules('business-name','Business Name','required');
		$this->form_validation->set_rules('business-email','Business Email','required');
        if ($this->form_validation->run() === false) {
                /** Scenario State Error from Form Validation */
                $this->session->set_flashdata('Error', 'Privacy not saved');
        }else{
            $post['number_id']            = $this->input->post('business-number-id');
            $post['registration_number']  = $this->input->post('business-registration-number');
            $this->db->where('pdb_business.created_by', $user_id);
            $update = $this->db->update('users', $post);
            if($update == true){
            $this->session->set_flashdata('success', 'Privacy has been saved');
            }
        }
        $data['CSRF'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];

        redirect('business/list');
    }

    public function store_product()
    {
        $this->form_validation->set_rules('product-name','Business Name','required');
		$this->form_validation->set_rules('product-price','Business Email','required');
        if($this->form_validation->run() != false){
            $post['id']                     = $this->generate_new_id_string() . get_random_alphanumeric(5);
            $post['data_name']          = $this->input->post('product-name');
            $post['price_type']         = $this->input->post('product-price-type');
            $post['price_low']         = $this->input->post('product-price');
            $post['data_description']  = $this->input->post('product-description');
            $categories  = $this->input->post('product-categories');
            $result_category = array();
            foreach($categories AS $key => $val){
                 $result_category[] = array(
                  'id' => $categories[$key],
                 );
            }
            $post['data_categories'] = json_encode($result_category);
            $post['status']         = 1;
            $post['created_by']     = $_SESSION['user_id'];
            $post['created_at']      = date('Y-m-d H:i:s');
            $this->db->insert('pbd_items', $post);
            redirect(base_url('business/list/'));
		}else{
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
    }

    public function update_product()
    {
        $this->form_validation->set_rules('product-name','Business Name','required');
		$this->form_validation->set_rules('product-price','Business Email','required');
        if($this->form_validation->run() != false){
            $id              = $this->input->post('id');
            $post['data_name']         = $this->input->post('product-name');
            $post['price_type']        = $this->input->post('product-price-type');
            $post['price_low']         = $this->input->post('product-price');
            $post['data_description']  = $this->input->post('product-description');
            $categories  = $this->input->post('product-categories');
            $result_category = array();
            foreach($categories AS $key => $val){
                 $result_category[] = array(
                  'id' => $categories[$key],
                 );
            }
            $post['data_categories'] = json_encode($result_category);
            $post['status']         = 1;
            $post['created_by']     = $_SESSION['user_id'];
            $post['created_at']      = date('Y-m-d H:i:s');
            $this->db->where('id',$id);
            $this->db->update('pbd_items', $post);
            redirect(base_url('business/list/'));
		}else{
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
        $name       = $this->input->get('business-name');
        $location   = $this->input->get('business-location');
        $type       = $this->input->get('business-type');
        $category   = $this->input->get('business-category');

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

            // $countdata = $this->M_business->count_data();
            $config['base_url'] = site_url('business/discover'); //site url
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
            $data["users_session"] = $this->db->get_where('users',array('id'=>$_SESSION['user_id']))->row();
            $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            // $data['business'] = $this->M_business->search_business($name,$type,$config['per_page'],$data['page']);

            $data["types"]          = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
            $data["categories"]     = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
            $data['pagination']     = $this->pagination->create_links();
            // $data['total_rows']     = $countdata;
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
            // $countdata = $this->M_business->count_data();
            $config['base_url'] = site_url('business/discover'); //site url
            // $config['total_rows'] = $countdata;
            $config['per_page'] = 6;
            $config["uri_segment"] = 6;  // uri parameter
            // $choice = (int) ceil((double)$config["total_rows"] / $config["per_page"]);
            // $config["num_links"] = floor($choice);
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
            $data["users_session"] = $this->db->get_where('users',array('id'=>$_SESSION['user_id']))->row();
            $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            // $data['business'] = $this->M_business->data($config['per_page'],$data['page']);

            $data["types"]          = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
            $data["categories"]     = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
            $data["business_all"]   = $this->db->get('pbd_business')->result();
            $data['pagination']     = $this->pagination->create_links();
            // $data['total_rows']     = $countdata;
            // $data['choice']         = $choice;
            $this->display('discover', $data);
        }
    }

    public function setting($id) {
        $user_id     = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Dashboard',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),

        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $data["types"]          = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
        $data["categories"]     = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
        $data['business']       = $this->db->get_where('pbd_business',array('id'=>$id))->row();
        $data['business_list']  = $this->db->get_where('pbd_business',array('id'=>$id))->result();
        $result = json_decode($data['business']->data_locations);
        foreach($result as $value){
            $data['country']  = $this->db->get_where('loc_countries',array('id'=>$value->country_id))->row();
            $data['state']  = $this->db->get_where('loc_states',array('id'=>$value->state_id))->row();
            $data['city']  = $this->db->get_where('loc_cities',array('id'=>$value->city_id))->row();
        }
        $this->display('manage', $data);
    }

    public function service($query = null) {

        $user_id     = $_SESSION['user_id'];
        $business_id = '2109026130466B8C414SJR0W';
        $data = [
            'title_web' => 'Dashboard',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),

        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];

        $this->display('service', $data);
    }

    public function manage() {

        $user_id     = $_SESSION['user_id'];
        $business_id = '2109026130466B8C414SJR0W';
        $data = [
            'title_web' => 'Dashboard',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $data['business']       = $this->db->get_where('pbd_business',array('id'=>$business_id))->row();
        $this->display('manage', $data);
    }
}
