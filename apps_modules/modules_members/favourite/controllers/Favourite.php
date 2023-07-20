<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Favourite extends Base_users
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('M_favourite');
        if(!empty($this->session->userdata('is_login') == FALSE)){
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }
    }

	/** List all favourite */
    public function index()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Favourite',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
            'business'  => $this->M_favourite->business_list($user_id)->result(),
            'business_categories' => $this->db->get_where('pbd_business_categories',array('status' => 1))->result(),
            'business_types' => $this->db->get('pbd_business_types')->result(),
            'product'  => $this->M_favourite->market_list($user_id)->result(),
            'product_categories'  => $this->db->get_where('pbd_items_categories',array('status' => 1))->result(),
			'product_buy'  => $this->M_favourite->buy_list($user_id)->result(),
			'jobs'  => $this->M_favourite->job_list($user_id)->result(),
            'jobs_categories'  => $this->db->get_where('pcj_jobs_categories',array('status' => 1))->result(),
            'jobs_types'  => $this->db->get_where('pcj_jobs_types',array('status' => 1))->result(),
            'communities'  => $this->M_favourite->community_list($user_id)->result(),
            'communities_categories'  => $this->db->get_where('pcs_communities')->result(),
			'tender'  => $this->M_favourite->tender_list($user_id)->result(),
			'tender_categories'  => $this->db->get_where('pbt_tender_categories',array('status' => 1))->result(),
            'article'  => $this->M_favourite->article_list($user_id)->result(),
            'article_categories'  => $this->db->get_where('pfe_articles_categories')->result(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        config('title', 'Favourite - All Category');
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
				case 'tender':
					$table= 'pbt_tender';
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

	/** List all business favourite */
    public function business()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Favourite',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
            'business'  => $this->M_favourite->business_all($user_id)->result(),
            'business_categories' => $this->db->get_where('pbd_business_categories',array('status' => 1))->result(),
            'business_types' => $this->db->get('pbd_business_types')->result(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        
        config('title', 'Favourite - Business Pages');
        $this->display('business', $data);
    }

	/** Liat all product favourite*/
    public function market()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Favourite',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
            'product'  => $this->M_favourite->market_all($user_id)->result(),
            'product_categories'  => $this->db->get_where('pbd_items_categories',array('status' => 1))->result(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        
        config('title', 'Favourite - Product & Service');
        $this->display('market', $data);
    }

	public function buy()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Favourite',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
            'product'  => $this->M_favourite->buy_all($user_id)->result(),
            'product_categories'  => $this->db->get_where('pbd_items_categories',array('status' => 1))->result(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        
        config('title', 'Favourite - Buy & Sells');
        $this->display('buy', $data);
    }

	/** List all job favourite */
    public function job()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Favourite',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
            'jobs'  => $this->M_favourite->job_all($user_id)->result(),
            'jobs_categories'  => $this->db->get_where('pcj_jobs_categories',array('status' => 1))->result(),
            'jobs_types'  => $this->db->get_where('pcj_jobs_types',array('status' => 1))->result(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        
        config('title', 'Favourite - Job');
        $this->display('job', $data);
    }

	/** List all community favourite */
    public function community()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Favourite',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
            'communities'  => $this->M_favourite->community_all($user_id)->result(),
            'communities_categories'  => $this->db->get_where('pcs_communities')->result(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        
        config('title', 'Favourite - Community');
        $this->display('community', $data);
    }

	/** Liat all article favourite */
    public function article()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Favourite',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
            'article'  => $this->M_favourite->article_all($user_id)->result(),
            'article_categories'  => $this->db->get_where('pfe_articles_categories')->result(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        
        config('title', 'Favourite - Article');
        $this->display('article', $data);
    }

	/** Liat all tender favourite */
	public function tender()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Favourite',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
            'tender'  => $this->M_favourite->tender_all($user_id)->result(),
			'tender_categories'  => $this->db->get_where('pbt_tender_categories',array('status' => 1))->result(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        
        config('title', 'Favourite - Tender');
        $this->display('tender', $data);
    }
}
