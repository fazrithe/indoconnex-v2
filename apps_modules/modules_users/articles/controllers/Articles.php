<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Articles extends Base_users
{
    protected $module_base                  = 'articles/list';
    protected $apps_title_module            = 'profile';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation','pagination');
        $this->load->model('M_articles');
        if(!empty($this->session->userdata('is_login') == FALSE)){
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }
    }

    public function list($sender_id = null)
    {

        $user_id = $_SESSION['user_id'];
        if(empty($sender_id)) {
        }
        $data         = array(
            'apps_title_module' => $this->apps_title_module
        );
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
            ];
        $data["users_session"]          = $this->db->get_where('users',array('username'=>$_SESSION['username']))->row();
        $data["category_article"] = $this->db->get('pfe_articles_categories')->result();
        $data["users"]            = $this->db->get_where('users',array('id'=>$user_id))->row();
        $data['post_articles']    = $this->M_articles->post_article($user_id)->result();
        $data['business_list']    = $this->db->get_where('pbd_business', array('status'=>1,'created_by'=>$user_id))->result();
        $data["categories_article"]         = $this->db->get_where('pfe_articles_categories',array('status'=>1))->result();
        $this->display('list', $data);
    }

    public function create($creator_id = null)
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
        $data["users_session"]          = $this->db->get_where('users',array('username'=>$_SESSION['username']))->row();
        $data['business_list']    = $this->db->get_where('pbd_business', array('status'=>1,'created_by'=>$user_id))->result();
        $data["categories_article"]         = $this->db->get_where('pfe_articles_categories',array('status'=>1))->result();
        $this->display('create', $data);
    }

    public function store($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/articles/create/';
        $this->action_article_post($parameter_url_source, $parameter_id);
    }

    public function update($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/articles/';
        $this->action_update_articles($parameter_url_source, $parameter_id);
    }

    public function update_about()
    {
        $this->form_validation->set_rules('articles-description','articles Description','required');
        if($this->form_validation->run() != false){
            $id = $this->input->post('id');
            $post['data_about']      = $this->input->post('articles-description');
            $post['created_by']     = $_SESSION['user_id'];
            $post['updated_at']     = date('Y-m-d H:i:s');
            $this->db->where('id',$id);
            $this->db->update('pbd_articles', $post);
            redirect(base_url('articles/list/'));
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
            $data["types"]         = $this->db->get_where('pbd_articles_types',array('status'=>1))->result();
            $data["categories"]         = $this->db->get_where('pbd_articles_categories',array('status'=>1))->result();
            $this->display('index', $data);
		}
    }

    protected function set_form_validation($ID = FALSE)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br/>');
        /* SET FORM VALIDATION RULES FOR COLUMN */
        $this->form_validation->set_rules("articles-name", "articles Name {$this->apps_title_module}", 'required');
    }

    public function photo_process($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/articles/profile/post/' . $parameter_id;
        $this->action_edit_process_photo_articles($parameter_url_source, $parameter_id);
    }

    public function cover_process($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/articles/profile/post/' . $parameter_id;
        $this->action_edit_process_cover_articles($parameter_url_source, $parameter_id);
    }

    private function update_articles_verification()
    {
        $user_id = $_SESSION['user_id'];
        $this->form_validation->set_rules('articles-name','articles Name','required');
		$this->form_validation->set_rules('articles-email','articles Email','required');
        if ($this->form_validation->run() === false) {
                /** Scenario State Error from Form Validation */
                $this->session->set_flashdata('Error', 'Privacy not saved');
        }else{
            $post['number_id']            = $this->input->post('articles-number-id');
            $post['registration_number']  = $this->input->post('articles-registration-number');
            $this->db->where('pdb_articles.created_by', $user_id);
            $update = $this->db->update('users', $post);
            if($update == true){
            $this->session->set_flashdata('success', 'Privacy has been saved');
            }
        }
        $data['CSRF'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];

        redirect('articles/list');
    }

    public function discover() {

        $user_id     = $_SESSION['user_id'];
        $name       = $this->input->get('articles-name');
        $location   = $this->input->get('articles-location');
        $type       = $this->input->get('articles-type');
        $category   = $this->input->get('articles-category');

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
            // $data['articles']      = $this->m_articles->search_articles($name)->result();

            $countdata = $this->M_articles->count_data();
            $config['base_url'] = site_url('articles/discover'); //site url
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
            // $data['articles'] = $this->M_articles->search_articles($name,$type,$config['per_page'],$data['page']);

            // $data["types"]          = $this->db->get_where('pbd_articles_types',array('status'=>1))->result();
            // $data["categories"]     = $this->db->get_where('pbd_articles_categories',array('status'=>1))->result();
            $data['pagination']     = $this->pagination->create_links();
            $data['total_rows']     = $countdata;
            $data['choice']         = $choice;
            $data["users_session"]          = $this->db->get_where('users',array('username'=>$_SESSION['username']))->row();
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
            $countdata = $this->M_articles->count_data();
            $config['base_url'] = site_url('articles/discover'); //site url
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
            $data['articles'] = $this->M_articles->data($config['per_page'],$data['page']);

            // $data["types"]          = $this->db->get_where('pbd_articles_types',array('status'=>1))->result();
            // $data["categories"]     = $this->db->get_where('pbd_articles_categories',array('status'=>1))->result();
            // $data["articles_all"]   = $this->db->get('pbd_articles')->result();
            $data['pagination']     = $this->pagination->create_links();
            $data['total_rows']     = $countdata;
            $data['choice']         = $choice; $data["users_session"]          = $this->db->get_where('users',array('username'=>$_SESSION['username']))->row();$data["users_session"]          = $this->db->get_where('users',array('id'=>$_SESSION['user_id']))->row();
            $this->display('discover', $data);
        }
    }

    public function article_post()
    {
        $id =  $this->uri->segment(5);
        $data         = array(
            'apps_title_module' => $this->apps_title_module
        );
        $data['CSRF'] = [
            'id' => $id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
            ];
            $data["users_session"]          = $this->db->get_where('users',array('username'=>$_SESSION['username']))->row();
        $data["category_article"] = $this->db->get('pfe_articles_categories')->result();
        $data["users"]      = $this->db->get_where('users',array('id'=>$id))->row();
        $this->display('article_add', $data);
    }

    public function article_post_add(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/user/profile/post/article';
        $this->action_article_post($parameter_url_source, $parameter_id);
    }

    public function edit($user_id,$article_id)
    {
        $data         = array(
            'apps_title_module' => $this->apps_title_module
        );
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
            ];
            $data["users_session"]          = $this->db->get_where('users',array('username'=>$_SESSION['username']))->row();
        $data["article"]      = $this->db->get_where('pfe_articles',array('id'=>$article_id))->row();
        $data["categories_article"]         = $this->db->get_where('pfe_articles_categories',array('status'=>1))->result();
        $data["users"]      = $this->db->get_where('users',array('id'=>$user_id))->row();
        $this->display('edit', $data);
    }

    public function delete($article_id)
    {
        $user_id    = $this->input->post('user_id');
        $this->db->where('id',$article_id);
        $this->db->delete('pfe_articles');
        redirect('articles/list/'.$user_id);
    }

    public function manage() {

        $user_id     = $_SESSION['user_id'];
        $articles_id = '2109026130466B8C414SJR0W';
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
        $data['articles']       = $this->db->get_where('pbd_articles',array('id'=>$articles_id))->row();
        $this->display('manage', $data);
    }

    function show_article($id){
        $user_id = $_SESSION['user_id'];
        if($id == 1){
            $data=$this->M_articles->show_article($user_id)->result();
            echo json_encode($data);
        }else{
            $data=$this->M_articles->show_article_business($id)->result();
            echo json_encode($data);
        }
    }
}
