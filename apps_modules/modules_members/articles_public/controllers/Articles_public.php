<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Articles_public extends Base_users
{
    protected $module_base                  = 'articles/list';
    protected $apps_title_module            = 'profile';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation','pagination');
        $this->load->model('M_articles_public', 'M_articles');
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
            $this->display('list', $data);
    }

	/** Discover Article */
    public function discover() {
        $name       = trim($this->input->get('article-name'));
        $category   = $this->input->get('article-category');
		$page       = (int) $this->uri->segment(4);  

		$data = [
			'title_web' => 'Dashboard',
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
		];

		$data['CSRF'] = [
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash(),
		];

		$limit = 6;
		$offset = 0;

		if ($page > 0) {
			$offset = ($limit * $page) - $limit;
        }
        
        if ($name || $category) {
            $config['base_url'] = site_url('public/discover/articles');
            if($category && $name){
                $countdata = $this->M_articles->count_data_search_filter($name,$category);
                $config['total_rows'] = $this->M_articles->count_data_search_filter($name,$category);
            }elseif($name){
                $countdata = $this->M_articles->count_data_search($name);
                $config['total_rows'] = $this->M_articles->count_data_search($name);
            }else{
                $countdata = $this->M_articles->count_data_search_cat($category);
                $config['total_rows'] = $this->M_articles->count_data_search_cat($category);
            }

            if (count($this->input->get()) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
            if (count($this->input->get()) > 0) $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);

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
            $data['pagination']     = $this->pagination->create_links();
            $data['total_rows']     = $countdata;
            $data["categories_article"] = $this->db->select('id, data_name')->get_where('pfe_articles_categories',array('status'=>1))->result();
            $data['data_filter'] = ['category' => $category];
            $data['article_name'] = $name;          

            if ($category) {
                config('title', 'Discover Article' . ' - ' . $this->M_articles->getCategoryName($category));
            } else {
                config('title', 'Discover Article' . ' - ' . $name);
            }

            $this->display('discover_filter', $data);
        } else {
            $countdata = $this->M_articles->count_data();
            $config['base_url'] = site_url('public/discover/articles');
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
            $data["categories_article"]         = $this->db->select('id, data_name')->get_where('pfe_articles_categories',array('status'=>1))->result();

            config('title', 'Discover Article');

            $this->display('discover', $data);
        }
    }

	/** Show Detail Article */
    function detail($article_id) {
        $data = [
            'title_web' => 'Dashboard',
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
        ];
        $data['CSRF'] = [
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

        config('title', $this->db->get_where('pfe_articles',array('id'=>$article_id))->row()->data_name);

        $this->display('show', $data);
    }
}
