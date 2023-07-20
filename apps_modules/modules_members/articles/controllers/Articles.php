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

	/** List Article */
    public function list($sender_id = null)
    {

        $user_id = $_SESSION['user_id'];
        if(empty($sender_id)) {
        }
        $data         = array(
            'apps_title_module' => $this->apps_title_module,
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
        );
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
            ];
            $page = (int)$this->uri->segment(3);
            $limit = 6;
            $offset = 0;
            if($page > 0)
                $offset = ($limit * $page) - $limit;
            $countdata = $this->M_articles->count_data();
            $config['base_url'] = site_url('articles/list'); //site url
            $config['total_rows'] = $this->M_articles->count_data_list($user_id,);
            $config['per_page'] = $limit;
			$config['use_page_numbers'] = true;
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
			$config['attributes'] = ['class' => 'page-link'];
            $config['full_tag_open']    = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item">';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
            $config['next_tag_open']    = '<li class="page-item neighbour">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
            $config['prev_tag_open']    = '<li class="page-item neighbour">';
            $config['prev_tagl_close']  = 'Next</li>';
            $config['first_tag_open']   = '<li class="page-item neighbour">';
            $config['first_tagl_close'] = '</li>';
            $config['last_tag_open']    = '<li class="page-item neighbour">';
            $config['last_tagl_close']  = '</li>';
            $this->pagination->initialize($config);
            $data['post_articles'] = $this->M_articles->data($user_id,$limit, $offset);
            $data['pagination']     = $this->pagination->create_links();
            $data['total_rows']     = $countdata;
            $data["category_article"] = $this->db->get('pfe_articles_categories')->result();
            $data["users"]            = $this->db->get_where('users',array('id'=>$user_id))->row();
            // $data['post_articles']    = $this->M_articles->post_article($user_id)->result();
            $data['business_list']    = $this->db->get_where('pbd_business', array('status'=>1,'created_by'=>$user_id))->result();
            $data["categories_article"]         = $this->db->get_where('pfe_articles_categories',array('status'=>1))->result();
            config('title', 'My Article');
            $this->display('list', $data);
    }

    public function list_filter($id)
    {
        $user_id = $_SESSION['user_id'];

        $data         = array(
            'apps_title_module' => $this->apps_title_module,
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
        );
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
            ];
            $page = (int)$this->uri->segment(2);
            $limit = 6;
            $offset = 0;
            if($page > 0)
                $offset = ($limit * $page) - $limit;
            $countdata = $this->M_articles->count_data_filter($id);
            $config['base_url'] = site_url('articles/list_filter'); //site url
            $config['total_rows'] = $this->M_articles->count_data_filter($id);
            $config['per_page'] = $limit;
			$config['use_page_numbers'] = true;
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
			$config['attributes'] = ['class' => 'page-link'];
            $config['full_tag_open']    = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item">';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
            $config['next_tag_open']    = '<li class="page-item neighbour">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
            $config['prev_tag_open']    = '<li class="page-item neighbour">';
            $config['prev_tagl_close']  = 'Next</li>';
            $config['first_tag_open']   = '<li class="page-item neighbour">';
            $config['first_tagl_close'] = '</li>';
            $config['last_tag_open']    = '<li class="page-item neighbour">';
            $config['last_tagl_close']  = '</li>';
            $this->pagination->initialize($config);
            $data['post_articles'] = $this->M_articles->data_filter($id,$limit, $offset);
            $data['pagination']     = $this->pagination->create_links();
            $data['total_rows']     = $countdata;
            $data['filter_id']          = $id;
            $data["category_article"] = $this->db->get('pfe_articles_categories')->result();
            $data["users"]            = $this->db->get_where('users',array('id'=>$user_id))->row();
            // $data['post_articles']    = $this->M_articles->post_article($user_id)->result();
            $data['business_list']    = $this->db->get_where('pbd_business', array('status'=>1,'created_by'=>$user_id))->result();
            $data["categories_article"]         = $this->db->get_where('pfe_articles_categories',array('status'=>1))->result();
            config('title', 'My Article');
            $this->display('list', $data);
    }

	/** Create Article -> Store */
    public function create($creator_id = null)
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Dashboard',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $data['business_list']    = $this->db->get_where('pbd_business', array('status'=>1,'users_id'=>$user_id))->result();
        $data["categories_article"]         = $this->db->get_where('pfe_articles_categories',array('status'=>1))->result();
        config('title', 'Create New Article');
        $this->display('create', $data);
    }

    public function store($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/articles/create/';
        $this->action_article_post($parameter_url_source, $parameter_id);
    }

	/** Update Article */
    public function update($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/articles/';
        $this->action_article_update($parameter_url_source, $parameter_id);
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

	/** Discover Article */
    public function discover() {

        $user_id     = $_SESSION['user_id'];
        $name       = trim($this->input->get('article-name'));
        $category   = $this->input->get('article-category');
		$page = (int) $this->uri->segment(3);

		$data = [
			'title_web' => 'Dashboard',
			'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
		];

		$data['CSRF'] = [
			'id' => $user_id,
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash(),
		];

        $page = (int)$this->uri->segment(3);
		$limit = 6;
		$offset = 0;

		if ($page > 0) {
			$offset = ($limit * $page) - $limit;
        }
        
        if ($name || $category) {
            $config['base_url'] = site_url('articles/discover');
            if ($category && $name) {
                $countdata = $this->M_articles->count_data_search_filter($name,$category);
                $config['total_rows'] = $this->M_articles->count_data_search_filter($name,$category);
            } elseif($name) {
                $countdata = $this->M_articles->count_data_search($name);
                $config['total_rows'] = $this->M_articles->count_data_search($name);
            } else {
                $countdata = $this->M_articles->count_data_search_cat($category);
                $config['total_rows'] = $this->M_articles->count_data_search_cat($category);
            }

            if (count($this->input->get()) > 0) {
                $config['suffix'] = '?' . http_build_query($_GET, '', "&");
                $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            } 

            $config['per_page']         = $limit;
			$config['use_page_numbers'] = true;
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
			$config['attributes']       = ['class' => 'page-link'];
            $config['full_tag_open']    = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item">';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
            $config['next_tag_open']    = '<li class="page-item neighbour">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
            $config['prev_tag_open']    = '<li class="page-item neighbour">';
            $config['prev_tagl_close']  = 'Next</li>';
            $config['first_tag_open']   = '<li class="page-item neighbour">';
            $config['first_tagl_close'] = '</li>';
            $config['last_tag_open']    = '<li class="page-item neighbour">';
            $config['last_tagl_close']  = '</li>';
            $this->pagination->initialize($config);

            if ($category && $name) {
                $data['articles'] = $this->M_articles->data_search_filter($name,$category,$limit,$offset);
            } elseif($name) {
                $data['articles'] = $this->M_articles->data_search($name,$limit,$offset);
            } else {
                $data['articles'] = $this->M_articles->data_search_cat($category,$limit,$offset);
            }

            $data['pagination'] = $this->pagination->create_links();
            $data['total_rows'] = $countdata;
            $data["categories_article"] = $this->db->get_where('pfe_articles_categories',array('status'=>1))->result();
            $data['data_filter'] = ['category' => $category];
            $data['article_name'] = $name; 
            
            if ($category) {
                config('title', 'Discover Article' . ' - ' . $this->M_articles->getCategoryName($category));
            } else {
                config('title', 'Discover Article' . ' - ' . $name);
            }
            
            $this->display('discover_filter', $data);
        }else{

            $data = [
                'title_web' => 'Dashboard',
                'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
				'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
            ];
            $data['CSRF'] = [
                'id' => $user_id,
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
            $countdata = $this->M_articles->count_data();
            $config['base_url'] = site_url('articles/discover'); //site url
            $config['total_rows'] = $this->M_articles->count_data();
            $config['per_page'] = $limit;
			$config['use_page_numbers'] = true;
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
			$config['attributes'] = ['class' => 'page-link'];
            $config['full_tag_open']    = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item">';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
            $config['next_tag_open']    = '<li class="page-item neighbour">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
            $config['prev_tag_open']    = '<li class="page-item neighbour">';
            $config['prev_tagl_close']  = 'Next</li>';
            $config['first_tag_open']   = '<li class="page-item neighbour">';
            $config['first_tagl_close'] = '</li>';
            $config['last_tag_open']    = '<li class="page-item neighbour">';
            $config['last_tagl_close']  = '</li>';
            $this->pagination->initialize($config);
            $data['articles'] = $this->M_articles->data_all($limit, $offset);
            $data['pagination']     = $this->pagination->create_links();
            $data['total_rows']     = $countdata;
            $data["categories_article"]         = $this->db->get_where('pfe_articles_categories',array('status'=>1))->result();
            config('title', 'Discover Article');
            $this->display('discover', $data);
        }
    }

    public function article_post()
    {
        $id =  $this->uri->segment(5);
        $data         = array(
            'apps_title_module' => $this->apps_title_module,
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
        );
        $data['CSRF'] = [
            'id' => $id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
            ];

        $data["category_article"] = $this->db->get('pfe_articles_categories')->result();
        $data["users"]      = $this->db->get_where('users',array('id'=>$id))->row();
        $this->display('article_add', $data);
    }

    public function article_post_add(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/user/profile/post/article';
        $this->action_article_post($parameter_url_source, $parameter_id);
    }

	/** Article Edit -> store */
    public function edit($user_id,$article_id)
    {
        $data         = array(
            'apps_title_module' => $this->apps_title_module,
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
        );
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
            ];

        $data["article"]      = $this->db->get_where('pfe_articles',array('id'=>$article_id))->row();
        $data["categories_article"]         = $this->db->get_where('pfe_articles_categories',array('status'=>1))->result();
        $data["users"]      = $this->db->get_where('users',array('id'=>$user_id))->row();
        config('title', 'Edit Article');
        $this->display('edit', $data);
    }

	/** Delete Article */
    public function delete($article_id)
    {
        $user_id    = $this->input->post('user_id');
        $this->db->where('id',$article_id);
        $this->db->delete('pfe_articles');
        redirect('articles/manage');
    }

	/** Manage Article */
    public function manage() {

        $user_id = $_SESSION['user_id'];
        if(empty($sender_id)) {
        }
        $data         = array(
            'apps_title_module' => $this->apps_title_module,
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
        );
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
            ];
            $page = (int)$this->uri->segment(3);
            $limit = 6;
            $offset = 0;
            if($page > 0)
                $offset = ($limit * $page) - $limit;
            $countdata = $this->M_articles->count_data();
            $config['base_url'] = site_url('articles/manage'); //site url
            $config['total_rows'] = $this->M_articles->count_data_list($user_id);
            $config['per_page'] = $limit;
			$config['use_page_numbers'] = true;
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
			$config['attributes'] = ['class' => 'page-link'];
            $config['full_tag_open']    = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item">';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
            $config['next_tag_open']    = '<li class="page-item neighbour">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
            $config['prev_tag_open']    = '<li class="page-item neighbour">';
            $config['prev_tagl_close']  = 'Next</li>';
            $config['first_tag_open']   = '<li class="page-item neighbour">';
            $config['first_tagl_close'] = '</li>';
            $config['last_tag_open']    = '<li class="page-item neighbour">';
            $config['last_tagl_close']  = '</li>';
            $this->pagination->initialize($config);
            $data['post_articles'] = $this->M_articles->data($user_id,$limit, $offset);
            $data['pagination']     = $this->pagination->create_links();
            $data['total_rows']     = $countdata;
            $data["category_article"] = $this->db->get('pfe_articles_categories')->result();
            $data["users"]            = $this->db->get_where('users',array('id'=>$user_id))->row();
            // $data['post_articles']    = $this->M_articles->post_article($user_id)->result();
            $data['business_list']    = $this->db->get_where('pbd_business', array('status'=>1,'created_by'=>$user_id))->result();
            $data["categories_article"]         = $this->db->get_where('pfe_articles_categories',array('status'=>1))->result();
            config('title', 'Manage Article');
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

	/** Show Detail Article */
    function detail($article_id) {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Dashboard',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];

        $data["article"] = $this->db->select('id, pbd_business_id, users_id, file_path, file_name_original, data_name, data_description, data_type, data_categories, published')->get_where('pfe_articles',array('id'=>$article_id))->row();
        $data["category"] = new stdClass();
        $data["category"]->data_name = 'No Category';

        if (!empty($data["article"]->data_categories)) {
            $data["category"] = $this->db->get_where('pfe_articles_categories', [
                'status'=>1,
                'id' => $data["article"]->data_categories
            ])->row();
        }

        if ($data["article"]->data_type == 'personal') {
            $data['poster'] = $this->db->get_where('users', [
                'id'=> $data["article"]->users_id,
            ])->row();
        } else {
            $data['poster'] = $this->db->get_where('pdb_business', [
                'id'=> $data["article"]->pbd_business_id,
            ])->row();
        }
        if($data["article"]->users_id == $_SESSION['user_id'] || $data["article"]->pbd_business_id == $_SESSION['user_id']){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }
        config('title', $data["article"]->data_name);
        $this->display('show', $data);
    }

    function categories_all()
    {
        $q = $this->input->get('q');
        echo json_encode($this->M_articles->getCategory($q));
    }
}
