<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Business extends Base_users
{
    protected $module_base                  = 'business/list';
    protected $apps_title_module            = 'profile';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation','pagination');
        $this->load->model('M_business');
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

        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id,'status'=>1))->result();
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
      
        $data["types"]         = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
        $data["categories"]         = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
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
            $data["users_session"]          = $this->db->get_where('users',array('username'=>$_SESSION['username']))->row();
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
        $category   = $this->input->get('business-categories');

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

            $countdata = $this->M_business->count_data();
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

            $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $val_business = $this->M_business->search_business($name,$config['per_page'],$data['page']);
            $result = array();
            foreach($val_business as $val){
                foreach(json_decode($val->data_types) as $val_types){
                    foreach(json_decode($val->data_categories) as $val_categories){
                        foreach(json_decode($val->data_locations) as $val_locations){
                            if($val_types == $type and $val_categories == $category and $val_locations->country_id == $location
                            or $val_types == $type or $val_categories == $category or $val_locations->country_id == $location
                            ){
                                $result[] = array(
                                'id' => $val->id,
                                'data_name' => $val->data_name,
                                'data_username'  => $val->data_username,
                                'data_types' => $val->data_types,
                                'data_categories' => $val->data_categories,
                                'data_locations' => $val->data_locations,
                                'data_name' => $val->data_name,
                                'file_path' => $val->file_path,
                                'file_name_original' => $val->file_name_original,
                                );
                            }
                        }
                    }
                }
            }
            $data['business']       = $result;
            $data["types"]          = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
            $data["categories"]     = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
            $data["countries"]     = $this->db->get('loc_countries')->result();
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
            $countdata = $this->M_business->count_data();
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

            $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $val_business = $this->M_business->data($config['per_page'],$data['page']);
            $result = array();
            foreach($val_business as $val){
                foreach(json_decode($val->data_types) as $val_types){
                    $result[] = array(
                    'id' => $val->id,
                    'data_name' => $val->data_name,
                    'data_username'  => $val->data_username,
                    'data_types' => $val->data_types,
                    'data_categories' => $val->data_categories,
                    'data_locations' => $val->data_locations,
                    'data_name' => $val->data_name,
                    'file_path' => $val->file_path,
                    'file_name_original' => $val->file_name_original,
                    );
                }
            }
            $data['business']       = $result;
            $data["types"]          = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
            $data["categories"]     = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
            $data["countries"]     = $this->db->get('loc_countries')->result();
            $data["business_all"]   = $this->db->get('pbd_business')->result();
            $data['pagination']     = $this->pagination->create_links();
            $data['total_rows']     = $countdata;
            $data['choice']         = $choice;
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
        $data = [
            'title_web' => 'Dashboard',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),

        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $data["users_session"]          = $this->db->get_where('users',array('username'=>$_SESSION['username']))->row();
        $data["types"]          = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
        $data["categories"]     = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
        $data["facilities"]     = $this->db->get_where('mst_facilities',array('status'=>1))->result();
        $data['business']       = $this->db->get_where('pbd_business',array('id'=>$id))->row();
        $data['business_list']  = $this->db->get_where('pbd_business')->result();
        if(!empty($data['business']->data_locations)){
            $result = json_decode($data['business']->data_locations);
            foreach($result as $value){
                $data['country']  = $this->db->get_where('loc_countries',array('id'=>$value->country_id))->row();
                $data['state']  = $this->db->get_where('loc_states',array('id'=>$value->state_id))->row();
                $data['city']  = $this->db->get_where('loc_cities',array('id'=>$value->city_id))->row();
            }
        }
        $this->display('manage', $data);
    }
}
