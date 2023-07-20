<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Buys extends Base_users
{
    protected $module_base                  = 'market/list';
    protected $apps_title_module            = 'profile';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation','pagination');
        $this->load->model('M_buys');
        if(!empty($this->session->userdata('is_login') == FALSE)){
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }
    }

	/** List Buy & Sells */
    public function list()
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

		$page = (int)$this->uri->segment(3);
		$limit = 6;

		$offset = 0;
		if($page > 0)
			$offset = ($limit * $page) - $limit;

        $countdata = $this->M_buys->count_data_user($user_id);
        $config['base_url'] = site_url('market/list'); //site url
        $config['total_rows'] = $this->M_buys->count_data_user($user_id);
        $config['per_page'] = $limit;
		$config['use_page_numbers'] = true;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
		$config['attributes'] 		= ['class' => 'page-link'];
		$config['full_tag_open']    = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
        $config['next_tag_open']    = '<li class="page-item neighbour">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
        $config['prev_tag_open']    = '<li class="page-item neighbour">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item neighbour">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open']    = '<li class="page-item neighbour">';
        $config['last_tagl_close']  = '</li>';

        $this->pagination->initialize($config);

        $data['items_list']         = $this->M_buys->data($user_id,$limit,$offset);
        $data['business']  = $this->db->get_where('pbd_business', array('users_id'=>$user_id))->num_rows();
        $data["item_categories"]    = $this->db->get_where('pbd_items_categories', array('status'=>1))->result();
        $data["item_labels"]        = $this->db->get_where('pbd_items_labels', array('status'=>1))->result();
        $data["countries"]          = $this->db->get('loc_countries')->result();
        $data["product_all"]        = $this->db->get('pbd_items')->result();
        $data['pagination']         = $this->pagination->create_links();
        $data['total_rows']         = $countdata;
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        config('title', 'My Buy & Sells');
        $this->display('list', $data);
    }

    public function list_filter($id)
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

		$page = (int)$this->uri->segment(2);
		$limit = 6;

		$offset = 0;
		if($page > 0)
			$offset = ($limit * $page) - $limit;

        $countdata = $this->M_buys->count_data_filter($id);
        $config['base_url'] = site_url('market/list_filter'); //site url
        $config['total_rows'] = $this->M_buys->count_data_filter($id);
        $config['per_page'] = $limit;
		$config['use_page_numbers'] = true;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
		$config['attributes'] 		= ['class' => 'page-link'];
		$config['full_tag_open']    = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
        $config['next_tag_open']    = '<li class="page-item neighbour">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
        $config['prev_tag_open']    = '<li class="page-item neighbour">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item neighbour">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open']    = '<li class="page-item neighbour">';
        $config['last_tagl_close']  = '</li>';

        $this->pagination->initialize($config);
        $data['business']  = $this->db->get_where('pbd_business', array('users_id'=>$user_id))->num_rows();
        $data['items_list']         = $this->M_buys->data_filter($id,$limit,$offset);
        $data["item_categories"]    = $this->db->get_where('pbd_items_categories', array('status'=>1))->result();
        $data["item_labels"]        = $this->db->get_where('pbd_items_labels', array('status'=>1))->result();
        $data["countries"]          = $this->db->get('loc_countries')->result();
        $data["product_all"]        = $this->db->get_where('pbd_items',array('pbd_business_id'=>$id))->result();
        $data['pagination']         = $this->pagination->create_links();
        $data['total_rows']         = $countdata;
        $data['filter_id']          = $id;
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        config('title', 'My Buy & Sells');
        $this->display('list', $data);
    }

	/** Create Buy & Sells -> Store */
    public function create()
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
        $data['business_count']  = $this->db->get_where('pbd_business', array('users_id'=>$user_id))->num_rows();
        $data["labeles"]        = $this->db->get_where('pbd_items_labels',array('status'=>1))->result();
        $data["types"]          = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
        $data['business_list']  = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        $data["business"]       = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->row();
        $data["categories"]     = $this->db->get_where('pbd_items_categories',array('status'=>1))->result();
		$data["brands"]     	= $this->db->get_where('pbd_items_sells_brands',array('status'=>1))->result();
		config('title', 'Create Buy & Sells');
        $this->display('create', $data);
    }

    public function store($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/buysells/create/';
        $this->action_store_buy($parameter_url_source, $parameter_id);
    }

	/** Update Buys & Sells */
    public function update($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/market/create/';
        $this->action_update_buy($parameter_url_source, $parameter_id);
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

	/** Discover Buy & Sells */
    public function discover() {
        $user_id     = $_SESSION['user_id'];
        $name       = $this->input->get('product-name');
        $type       = $this->input->get('product-type');
        $category   = $this->input->get('product-category');
        $label      = $this->input->get('product-label');
        $price      = $this->input->get('product-price');
        $currency   = $this->input->get('product-currency');
        $location   = $this->input->get('product-location');

		$page = (int)$this->uri->segment(3);
        if($name || $type || $category || $label){
			// $this->db->select('*');
			// $this->db->like('data_name',$type, 'both');
			// $type_id = $this->db->get('pbd_items_categories_buys')->row();
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
            $countdata = $this->M_buys->count_data();

            $product   = $this->M_buys->search_product($name,$type)->result();
            $result = array();
            foreach($product as $val){
                $result[] = array(
                    'id' => $val->id,
                    'data_name' => $val->data_name,
                    'data_categories' => $val->data_categories,
                    'data_description'  => $val->data_description,
                    'price_currency' => $val->price_currency,
                    'price_type' => $val->price_type,
                    'price_low' => $val->price_low,
                    'file_path' => $val->file_path,
                    'file_name_original' => $val->file_name_original,
                );
        
            }
            $data['products']    = $result;
            $data['product_name'] = $name;
            $data['business']  = $this->db->get_where('pbd_business', array('users_id'=>$user_id))->num_rows();
            // $data['products'] = $this->M_buys->search_product($name,$type,$label,$limit,$offset);
            $data["item_categories"]    = $this->db->get_where('pbd_items_categories_buys', array('status'=>1, 'parent'=>0))->result();
            $data["item_labels"]        = $this->db->get_where('pbd_items_labels', array('status'=>1))->result();
            $data["countries"]          = $this->db->get('loc_countries')->result();
            $data['total_rows']     = $countdata;
            config('title', 'Discover Buy & Sells');
            $this->display('discover-filter', $data);
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
            $countdata = $this->M_buys->count_data();
            $config['base_url'] = site_url('buysells/discover'); //site url
            $config['total_rows'] = $this->M_buys->count_data();
            $limit = 6;
            $offset = $this->uri->segment(3);
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

            $product           = $this->M_buys->show_all($limit,$offset);
            $result = array();
            foreach($product as $val){
                $result[] = array(
                    'id' => $val->id,
                    'data_name' => $val->data_name,
                    'data_categories' => $val->data_categories,
                    'data_description'  => $val->data_description,
                    'price_currency' => $val->price_currency,
                    'price_type' => $val->price_type,
                    'price_low' => $val->price_low,
                    'file_path' => $val->file_path,
                    'file_name_original' => $val->file_name_original,
                );
            }
            $data['business']  = $this->db->get_where('pbd_business', array('users_id'=>$user_id))->num_rows();
            $data['products']    = $result;
            $data["item_categories"]    = $this->db->get_where('pbd_items_categories_buys', array('status'=>1, 'parent'=>0))->result();
            $data["item_labels"]        = $this->db->get_where('pbd_items_labels', array('status'=>1))->result();
            $data["countries"]          = $this->db->get('loc_countries')->result();
            $data["product_all"]        = $this->db->get('pbd_items')->result();
            $data['pagination']     = $this->pagination->create_links();
            $data['total_rows']         = $countdata;
            config('title', 'Discover Buy & Sells');
            $this->display('discover', $data);
        }
    }

	/** Manage Buy * Sells */
    public function manage()
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

		$page = (int)$this->uri->segment(3);
		$limit = 6;

		$offset = 0;
		if($page > 0)
			$offset = ($limit * $page) - $limit;

        $countdata = $this->M_buys->count_data_user($user_id);
        $config['base_url'] = site_url('market/list'); //site url
        $config['total_rows'] = $this->M_buys->count_data_user($user_id);
        $config['per_page'] = $limit;
		$config['use_page_numbers'] = true;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
		$config['attributes'] 		= ['class' => 'page-link'];
		$config['full_tag_open']    = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
        $config['next_tag_open']    = '<li class="page-item neighbour">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
        $config['prev_tag_open']    = '<li class="page-item neighbour">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item neighbour">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open']    = '<li class="page-item neighbour">';
        $config['last_tagl_close']  = '</li>';

        $this->pagination->initialize($config);
        $data['business']  = $this->db->get_where('pbd_business', array('users_id'=>$user_id))->num_rows();
        $data['items_list_product']         = $this->M_buys->data_product($user_id,$limit,$offset);
        $data['items_list_service']         = $this->M_buys->data_service($user_id,$limit,$offset);
        $data["item_categories"]    = $this->db->get_where('pbd_items_categories', array('status'=>1))->result();
        $data["item_labels"]        = $this->db->get_where('pbd_items_labels', array('status'=>1))->result();
        $data["countries"]          = $this->db->get('loc_countries')->result();
        $data["product_all"]        = $this->db->get('pbd_items')->result();
        $data['pagination']         = $this->pagination->create_links();
        $data['total_rows']         = $countdata;
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        $data['price_type']         = [
            '1' => 'Free (For Donation, Unused Products)',
            '2' => 'Fixed Price (Ex. IDR100.000)',
            '3' => 'Starting at (Ex. Start from IDR100.000)',
            '4' => 'Ask for Price (Via Whatsapp/Email)',
            '5' => 'Variable Price (Ex. 1-10 IDR100.000, 11-20 IDR88.000)',
        ];
        $data["categories"]         = $this->db->get_where('pbd_items_categories',array('status'=>1))->result();
        config('title', 'Manage Buy & Sells');
        $this->display('manage', $data);
    }

    public function manage_filter($id)
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

		$page = (int)$this->uri->segment(2);
		$limit = 6;

		$offset = 0;
		if($page > 0)
			$offset = ($limit * $page) - $limit;

        $countdata = $this->M_buys->count_data_user_filter($id);
        $config['base_url'] = site_url('market/list'); //site url
        $config['total_rows'] = $this->M_buys->count_data_user_filter($id);
        $config['per_page'] = $limit;
		$config['use_page_numbers'] = true;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
		$config['attributes'] 		= ['class' => 'page-link'];
		$config['full_tag_open']    = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
        $config['next_tag_open']    = '<li class="page-item neighbour">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
        $config['prev_tag_open']    = '<li class="page-item neighbour">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item neighbour">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open']    = '<li class="page-item neighbour">';
        $config['last_tagl_close']  = '</li>';

        $this->pagination->initialize($config);
        $data['business']  = $this->db->get_where('pbd_business', array('users_id'=>$user_id))->num_rows();
        $data['items_list_product']         = $this->M_buys->data_product_filter($id,$limit,$offset);
        $data['items_list_service']         = $this->M_buys->data_service_filter($id,$limit,$offset);
        $data["item_categories"]    = $this->db->get_where('pbd_items_categories', array('status'=>1))->result();
        $data["item_labels"]        = $this->db->get_where('pbd_items_labels', array('status'=>1))->result();
        $data["countries"]          = $this->db->get('loc_countries')->result();
        $data["product_all"]        = $this->db->get('pbd_items')->result();
        $data['pagination']         = $this->pagination->create_links();
        $data['total_rows']         = $countdata;
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        $data['price_type']         = [
            '1' => 'Free (For Donation, Unused Products)',
            '2' => 'Fixed Price (Ex. IDR100.000)',
            '3' => 'Starting at (Ex. Start from IDR100.000)',
            '4' => 'Ask for Price (Via Whatsapp/Email)',
            '5' => 'Variable Price (Ex. 1-10 IDR100.000, 11-20 IDR88.000)',
        ];
        $data['filter_id']          = $id;
        $data["categories"]         = $this->db->get_where('pbd_items_categories',array('status'=>1))->result();
        config('title', 'Manage Buy & Sells');
        $this->display('manage', $data);
    }

	/** Show Buy & sells */
    public function show($id) {
        $item = $this->db->from('pbd_items')
            ->where('id', $id)->get();
        $temp = $item->row();

        $seller = $this->db->select('data_name, data_username, file_path, file_name_original, bd_email as email, bd_phone as phone')->get_where('pbd_business',array('id'=>$temp->pbd_business_id))->row();

        $category = $this->db->from('pbd_items_categories')
            ->where_in('id', json_decode($temp->data_categories))->get();
        $image = placeholder($temp->file_path, $temp->file_name_original, 'product', '4x3');
        $sellImg = placeholder('', '', 'business');
        if(!empty($seller->file_path) && !empty($seller->file_name_original)) {
            $sellImg = placeholder($seller->file_path, $seller->file_name_original, 'business');
        }
        $location = json_encode([[
            'city_name' => 'Unknown City',
            'country_name' => 'Unknown Country',
        ]]);

        if (!empty($temp->data_locations)) {
            $location = $temp->data_locations;
        }

        $data = [
            'name' => $temp->data_name,
            'sku' => $temp->data_sku,
            'type' => $temp->data_type,
            'category' => $category->row(),
            'description' => $temp->data_description,
            'label' =>$temp->data_label,
            'image' => $image,
            'seller' => $seller,
            'compimg' => $sellImg,
            'location' => $location,
            'price' => [
                'type' => $temp->price_type,
                'currency' => $temp->price_currency,
                'low' => $temp->price_low,
                'high' => $temp->price_high,
                'table' => json_decode($temp->price_variant)
            ],
        ];

        echo json_encode($data);
    }

	/** Delete Buy & Sells */
    public function delete()
    {
        $items_id   = $this->input->post('items-id');
        $this->db->where('id',$items_id);
        $this->db->delete('pbd_items');
		$items_id   = $this->input->post('items-id');
        $this->db->where('pbd_items_id',$items_id);
        $this->db->delete('pbd_items_sells');
        redirect(base_url('buysells/manage'));
    }

	
	public function edit($id)
	{
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
		$data['business_count']  = $this->db->get_where('pbd_business', array('users_id'=>$user_id))->num_rows();
        $data["labeles"]        = $this->db->get_where('pbd_items_labels',array('status'=>1))->result();
        $data["types"]          = ['item'=>'Item','vehicle'=>'Vehicle','property'=>'Property'];
		$data["conditions"]     = ['New'=>'New','Second'=>'Second'];
		$data["status"]         = ['For Rent'=>'For Rent','For Sale'=>'For Sale','For Hire'=>'For Fire'];
		$data['price_type']         = [
            '1' => 'Free (For Donation, Unused Products)',
            '2' => 'Fixed Price (Ex. IDR100.000)',
            '3' => 'Starting at (Ex. Start from IDR100.000)',
            '4' => 'Ask for Price (Via Whatsapp/Email)',
            '5' => 'Variable Price (Ex. 1-10 IDR100.000, 11-20 IDR88.000)',
        ];
		$data["currency"]     = ['USD'=>'USD','IDR'=>'IDR','AUD'=>'AUD'];
		$data['business_list']  = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        $data["business"]       = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->row();
		$data['items']       = $this->M_buys->data_join($id)->row();
		$data['items_list'] = $this->db->get_where('pbd_items',array('users_id'=>$user_id,'status'=>1))->result();
		// dd($data['items_list']);
		if(!empty($data['items']->data_locations)){
			$result = json_decode($data['items']->data_locations);
			foreach($result as $value){
				$data['country']  = $this->db->get_where('loc_countries',array('id'=>$value->country_id))->row();
				$data['state']  = $this->db->get_where('loc_states',array('id'=>$value->state_id))->row();
				$data['city']  = $this->db->get_where('loc_cities',array('id'=>$value->city_id))->row();
			}
		}

		if(!empty($data['items']->data_categories)){
			$result_cat = json_decode($data['items']->data_categories);
			foreach($result_cat as $value_cat){
				$cat = $this->db->get_where('pbd_items_categories_buys',array('id'=>$value_cat,'status'=>1))->row();
			}	
		}

		if(!empty($data['items']->data_sub_categories)){
			$result_cat = json_decode($data['items']->data_sub_categories);
			foreach($result_cat as $value_cat){
				$cat_sub = $this->db->get_where('pbd_items_categories_buys',array('id'=>$value_cat,'status'=>1))->row();
			}	
		}
		$data["sells"] = $this->db->get_where('pbd_items_sells',array('pbd_items_id' =>$id))->row();
		$data["categories"]     = $this->db->get_where('pbd_items_categories_buys',array('parent'=>$cat->parent,'status'=>1))->result();
		$categories     = $this->db->get_where('pbd_items_categories_buys',array('parent'=>$cat->parent,'status'=>1))->row();
		if(!empty($cat_sub)){
		$data["sub_categories"]     = $this->db->get_where('pbd_items_categories_buys',array('parent'=>$cat_sub->parent,'status'=>1))->result();
		$sub_categories     = $this->db->get_where('pbd_items_categories_buys',array('parent'=>$cat_sub->parent,'status'=>1))->row();
		
		$data["part_categories"]     = $this->db->get_where('pbd_items_categories_buys',array('parent'=>$sub_categories->id,'status'=>1))->result();
		$part_categories     = $this->db->get_where('pbd_items_categories_buys',array('parent'=>$sub_categories->id,'status'=>1))->result();
		}else{
			$data["sub_categories"] = '';
			$data["part_categories"]  = '';
		}
		config('title', 'Edit Buy & Sells');
		$this->display('edit', $data);
	}

	public function get_category(){
		$name=$this->input->post('name');
        $category=$this->M_buys->get_subcategory($name);
		$data=$this->db->get_where('pbd_items_categories_buys',array('parent'=>$category->id,'status'=>1))->result();
        echo json_encode($data);
	}

	public function get_sub_category(){
		$id=$this->input->post('id');
        // $category=$this->M_buys->get_subcategory_child($id);
		$category=$this->db->get_where('pbd_items_categories_buys',array('parent'=>$id,'status'=>1))->result();
		$category_row=$this->db->get_where('pbd_items_categories_buys',array('parent'=>$id,'status'=>1))->num_rows();
		$data = [
			"category" => $category,
			"category_count" => $category_row,
		];
		echo json_encode($data);
	}
}
