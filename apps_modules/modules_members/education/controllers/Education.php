<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Education extends Base_users
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('M_education');
        if(!empty($this->session->userdata('is_login') == FALSE)){
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }
    }

	/** List all education */
    public function index()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Favourite',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
            'business_page'  =>  $this->M_education->business_list()->result(),
            'business_categories' => $this->db->get_where('pbd_business_categories',array('status' => 1))->result(),
            'business_types' => $this->db->get('pbd_business_types')->result(),
            'product'  => $this->M_education->market_list($user_id)->result(),
            'product_categories'  => $this->db->get_where('pbd_items_categories',array('status' => 1))->result(),
            'jobs'  => $this->M_education->job_list($user_id)->result(),
            'jobs_categories'  => $this->db->get_where('pcj_jobs_categories',array('status' => 1))->result(),
            'jobs_types'  => $this->db->get_where('pcj_jobs_types',array('status' => 1))->result(),
            'communities'  => $this->M_education->community_list('Educational')->result(),
            'communities_categories'  => $this->db->get_where('pcs_communities')->result(),
            'article'  => $this->M_education->article_list($user_id)->result(),
            'article_categories'  => $this->db->get_where('pfe_articles_categories')->result(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
        ];
		$result = array();
		foreach($data['business_page'] as $val){
			if(!empty($val->data_types)){
				foreach(json_decode($val->data_types) as $val_types){
					$type = $this->db->get_where('pbd_business_types', array('id'=>$val_types))->row();
					if(!empty($type->data_name)){
						if($type->data_name == 'Educational'){
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
		$data['business'] = $result;
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        
        config('title', ' Campus & Education - All Category');  
        $this->display('index', $data);
    }

    public function store(){
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $this->db->select('*');
        $this->db->where('user_id',$_SESSION['user_id']);
        $this->db->where('relation_table_id',$id);
        $query = $this->db->get('users_favorites');
        $num = $query->num_rows();
        if($num < 1){
            switch ($type) {
                case 'business':
                    $table= 'pbd_business';
                    break;
                case 'market':
                    $table= 'pbd_items';
                    break;
                case 'jobs':
                    $table= 'pcj_jobs';
                    break;
                case 'communities':
                    $table= 'pcs_communities';
                    break;
                case 'articles':
                    $table= 'pfe_articles';
                    break;
                case 'users':
                    $table= 'users';
                    break;
            }
                $post['user_id']           = $_SESSION['user_id'];
                $post['relation_module']    = $type;
                $post['relation_table_name']= $table;
                $post['relation_table_id']  = $id;
                $post['created_at']         = date('Y-m-d H:i:s');
                $post['updated_at']         = date('Y-m-d H:i:s');
            $data['data'] = $this->db->insert('users_favorites', $post);
            $data['token'] = $this->security->get_csrf_hash();
        }else{
            $this->db->where('relation_table_id',$id);
            $this->db->delete('users_favorites');
            $data['token'] = $this->security->get_csrf_hash();
        }
        echo json_encode($data);
    }

	/** List all business education*/
    public function business()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Favourite',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
            'business_categories' => $this->db->get_where('pbd_business_categories',array('status' => 1))->result(),
            'business_types' => $this->db->get('pbd_business_types')->result(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
        ];
		$page = (int)$this->uri->segment(3);
		$limit = 8;
		$offset = 0;
		if($page > 0)
		{
			$offset = ($limit * $page) - $limit;
		}
		$val_business = $this->M_education->business_all($limit, $offset);
		$result = array();
		foreach($val_business as $val){
			if(!empty($val->data_types)){
				foreach(json_decode($val->data_types) as $val_types){
					$type = $this->db->get_where('pbd_business_types', array('id'=>$val_types))->row();
					if(!empty($type->data_name)){
						if($type->data_name == 'Educational'){
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
		$countdata = count($result);
		$config['base_url'] = site_url('education/business'); //site url
		$config['total_rows'] = count($result);
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
		$data['business'] = array_slice($result,$offset,$limit);
		$data['pagination']     = $this->pagination->create_links();
		$data['total_rows']     = $countdata;
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
       
        config('title', ' Campus & Education - Business Page');
        $this->display('business', $data);
    }

    public function market()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Favourite',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
            'product'  => $this->M_education->market_all($user_id)->result(),
            'product_categories'  => $this->db->get_where('pbd_items_categories',array('status' => 1))->result(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
       
        $this->display('market', $data);
    }

    public function job()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Favourite',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
            'jobs'  => $this->M_education->job_all($user_id)->result(),
            'jobs_categories'  => $this->db->get_where('pcj_jobs_categories',array('status' => 1))->result(),
            'jobs_types'  => $this->db->get_where('pcj_jobs_types',array('status' => 1))->result(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
       
        $this->display('job', $data);
    }

	/** List all community education */
    public function community()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Favourite',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
            'communities_categories'  => $this->db->get_where('pcs_communities')->result(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
		$page = (int)$this->uri->segment(3);
		$limit = 6;
		$offset = 0;
		if($page > 0)
		{
			$offset = ($limit * $page) - $limit;
		}
		$countdata = $this->M_education->count_data_community('Educational');
		$config['base_url'] = site_url('business/discover'); //site url
		$config['total_rows'] = $this->M_education->count_data_community('Educational');
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
		$data['communities']  = $this->M_education->community_all('Educational',$limit, $offset);
		$data['pagination']     = $this->pagination->create_links();
		$data['total_rows']     = $countdata;
        config('title', ' Campus & Education - Community');
        $this->display('community', $data);
    }

    public function article()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Favourite',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
            'article'  => $this->M_education->article_all($user_id)->result(),
            'article_categories'  => $this->db->get_where('pfe_articles_categories')->result(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
       
        $this->display('article', $data);
    }
}
