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
		$this->load->helper(array('url','file'));
        if(!empty($this->session->userdata('is_login') == FALSE)){
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }
    }

	/** List Product/Service */
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

        $countdata = $this->M_market->count_data_user($user_id);
        $config['base_url'] = site_url('market/list'); //site url
        $config['total_rows'] = $this->M_market->count_data_user($user_id);
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

        $data['items_list']         = $this->M_market->data($user_id,$limit,$offset);
        $data['business']  = $this->db->get_where('pbd_business', array('users_id'=>$user_id))->num_rows();
        $data["item_categories"]    = $this->db->get_where('pbd_items_categories', array('status'=>1))->result();
        $data["item_labels"]        = $this->db->get_where('pbd_items_labels', array('status'=>1))->result();
        $data["countries"]          = $this->db->get('loc_countries')->result();
        $data["product_all"]        = $this->db->get('pbd_items')->result();
        $data['pagination']         = $this->pagination->create_links();
        $data['total_rows']         = $countdata;
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        config('title', 'My Product/Service');
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

        $countdata = $this->M_market->count_data_filter($id);
        $config['base_url'] = site_url('market/list_filter'); //site url
        $config['total_rows'] = $this->M_market->count_data_filter($id);
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
        $data['items_list']         = $this->M_market->data_filter($id,$limit,$offset);
        $data["item_categories"]    = $this->db->get_where('pbd_items_categories', array('status'=>1))->result();
        $data["item_labels"]        = $this->db->get_where('pbd_items_labels', array('status'=>1))->result();
        $data["countries"]          = $this->db->get('loc_countries')->result();
        $data["product_all"]        = $this->db->get_where('pbd_items',array('pbd_business_id'=>$id))->result();
        $data['pagination']         = $this->pagination->create_links();
        $data['total_rows']         = $countdata;
        $data['filter_id']          = $id;
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        config('title', 'My Product/Service');
        $this->display('list', $data);
    }

	/** Create Product/Service */
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
        $data["types"]          = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
        $data['business_list']  = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        $data["business"]       = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->row();
        $data["categories"]     = $this->db->order_by('data_name', 'asc')->get_where('pbd_items_categories',array('status'=>1))->result();
        $data["labels"]      	= $this->db->order_by('data_name', 'asc')->get_where('pbd_items_labels',array('status'=>1))->result();
		config('title', 'Create Product/Service');
        $this->display('create', $data);
    }

	/** Store Product/Service */
    public function store($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/market/create/';
        $this->action_store_market($parameter_url_source, $parameter_id);
    }

    /** Edit Product/Service */
    public function edit($parameter_id = null)
    {
        if ($this->is_request_post()) {

			$this->update($parameter_id);

		} else {
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

            $data['item'] = $this->M_market->getItemById($parameter_id);
            $data['business_count'] = $this->db->get_where('pbd_business', array('users_id'=>$user_id))->num_rows();
            $data["types"] = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
            $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
            $data["business"] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->row();
            $data["categories"] = $this->db->order_by('data_name', 'asc')->get_where('pbd_items_categories',array('status'=>1))->result();
            $data["labels"] = $this->db->order_by('data_name', 'asc')->get_where('pbd_items_labels',array('status'=>1))->result();
            $data["gallery"] = $this->db->get_where('gallery_photo', array('module_id'=>$parameter_id))->result();
			$data['price_type']         = [
                '1' => 'Free / Giveaway',
                '2' => 'Fixed Price',
                '3' => 'Starting at',
                '4' => 'Ask for Price',
                '5' => 'Variable Price',
            ];
            $data["currency"]     = ['USD'=>'USD','IDR'=>'IDR','AUD'=>'AUD'];
            
            config('title', 'Edit Product/Service');
            $this->display('edit', $data);
        } 
    }

	/** Update Product/Service */
    public function update($parameter_id = null)
    {
        $this->action_update_market( $parameter_id);
    }

	/** Delete Product/Service */
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
        $data["categories"]     = $this->db->order_by('data_name', 'asc')->get_where('pbd_items_categories',array('status'=>1))->result();
        $this->display('index', $data);
    }

	/** Discover Product/ Service */
    public function discover() {
        $user_id     = $_SESSION['user_id'];
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
            $page = (int) $this->uri->segment(3);
            $limit = 6;
            $offset = 0;
            if($page > 0) {
                $offset = ($limit * $page) - $limit;
            }
            $config['base_url'] = site_url('market/discover'); //site url
            $config['total_rows'] = $this->M_market->count_data();
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

            $product           = $this->M_market->show_all($limit,$offset);
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
			$this->db->order_by('data_name', 'ASC');
			$query_category = $this->db->get_where('pbd_items_categories',array('status'=>1));
			$location = $data['users']->data_locations;
			if(!empty(json_decode($location))){
				foreach(json_decode($location) as $val_loc){
					$country_name = $val_loc->country_name;
				}
			}else{
				$country_name = 'Indonesia';
			}
			$data['country_name'] = $country_name;
            $data["item_categories"]    = $query_category->result();
            $data["item_labels"]        = $this->db->get_where('pbd_items_labels', array('status'=>1))->result();
            $data["countries"]          = $this->db->get('loc_countries')->result();
            $data["product_all"]        = $this->db->get('pbd_items')->result();
            $data['pagination']     = $this->pagination->create_links();
			$data['total_rows'] = $config['total_rows'];
            config('title', 'Discover Product/Service');
            $this->display('discover', $data);
        
    }

	public function discover_filter(){
		$user_id     = $_SESSION['user_id'];
        $name       = $this->input->get('product-name');
        $location   = $this->input->get('product-location');
        $type       = $this->input->get('product-type');
        $category   = $this->input->get('product-category');
        $label      = $this->input->get('product-label');
        $price      = $this->input->get('product-price');
        $currency   = $this->input->get('product-currency');
        $location   = $this->input->get('product-location');

		$page = (int)$this->uri->segment(4);
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
			$countdata = $this->M_market->count_data_filter($name,$type,$category,$label,$price,$currency,$location);
			$limit = 6;
			$offset = 0;
			if($page > 0)
			{
				$offset = ($limit * $page) - $limit;
			}
			$product   = $this->M_market->filter($name,$type,$category,$label,$price,$currency,$location,$limit,$offset);
			$config['base_url'] = site_url('market/discover/search'); //site url
			if (count($this->input->get()) > 0) $config['suffix'] = '?' . http_build_query($this->input->get(), '', "&");
			if (count($this->input->get()) > 0) $config['first_url'] = $config['base_url'].'/1?'.http_build_query($this->input->get());
			$config['total_rows'] = $countdata;
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
			$result = array();
            foreach($product as $val){
				if(!empty($location and $val->data_locations)){
					foreach(json_decode($val->data_locations) as $val_locations){
						if($val_locations->country_id == $location){
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
					}
				}else{
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
            }
			$result1 = array();
			$data_filter = $result1[] = array(
				'name'   => $name,
				'type'   => $type,
				'category' => $category,
                'price' => $price,
                'currency' => $currency,
				'label'	=> $label,
				'location' => $location
			);
			$data['data_filter']    =  $data_filter;
            $data['products']    = $result;
            $data['product_name'] = $name;
            $data['business']  = $this->db->get_where('pbd_business', array('users_id'=>$user_id))->num_rows();
            // $data['products'] = $this->M_market->search_product($name,$type,$label,$limit,$offset);
			$this->db->order_by('data_name', 'ASC');
			$query_category = $this->db->get_where('pbd_items_categories',array('status'=>1));
            $data["item_categories"]    = $query_category->result();
            $data["item_labels"]        = $this->db->get_where('pbd_items_labels', array('status'=>1))->result();
            $data["countries"]          = $this->db->get('loc_countries')->result();
            $data['total_rows']     = $countdata;
            config('title', 'Discover Product/Service');
            $this->display('discover-filter', $data);
	}


	/** Manage Product/Service */
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

        $countdata = $this->M_market->count_data_user($user_id);
        $config['base_url'] = site_url('market/list'); //site url
        $config['total_rows'] = $this->M_market->count_data_user($user_id);
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
        $data['items_list_product']         = $this->M_market->data_product($user_id,$limit,$offset);
        $data['items_list_service']         = $this->M_market->data_service($user_id,$limit,$offset);
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
        $data["categories"]     = $this->db->order_by('data_name', 'asc')->get_where('pbd_items_categories',array('status'=>1))->result();
        config('title', 'Manage Product/Service');
        $this->display('manage', $data);
    }

    public function manage_filter($id)
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

		$page = (int)$this->uri->segment(2);
		$limit = 6;

		$offset = 0;
		if($page > 0)
			$offset = ($limit * $page) - $limit;

        $countdata = $this->M_market->count_data_user_filter($id);
        $config['base_url'] = site_url('market/list'); //site url
        $config['total_rows'] = $this->M_market->count_data_user_filter($id);
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
        $data['items_list_product']         = $this->M_market->data_product_filter($id,$limit,$offset);
        $data['items_list_service']         = $this->M_market->data_service_filter($id,$limit,$offset);
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
        $data["categories"]     = $this->db->order_by('data_name', 'asc')->get_where('pbd_items_categories',array('status'=>1))->result();
        config('title', 'Manage Product/Service');
        $this->display('manage', $data);
    }

    public function show($id) {
        $item = $this->db->from('pbd_items')
            ->where('id', $id)->get();
        $temp = $item->row();
		if(!empty($temp->pbd_business_id)){
        $seller = $this->db->select('users_id as id, data_name as name_full, data_username as username, file_path, file_name_original')->get_where('pbd_business',array('id'=>$temp->pbd_business_id))->row();
		}else if(!empty($temp->users_id)){
		$seller = $this->db->select('id, name_full, username, file_path, file_name_original')->get_where('users',array('id'=>$temp->users_id))->row();
		}

        if ($temp->data_categories) {
            if ($temp->data_type == 'product' || $temp->data_type == 'service') {
                $category = $this->db->from('pbd_items_categories')->where_in('id', json_decode($temp->data_categories))->get()->row();
            } else if ($temp->data_type == '' && $temp->status_buy_sells) {
                $category = $this->db->from('pbd_items_categories_buys')->where_in('id', json_decode($temp->data_categories))->get()->row();
            } else if ($temp->data_type == '' && ! $temp->status_buy_sells) {
                $category = $this->db->from('pbd_items_categories')->where_in('id', json_decode($temp->data_categories))->get()->row();
            }
        } else {
            $category = [
                'data_name' => 'Uncategorized',
            ];
        }
        
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
            $location = json_decode($temp->data_locations);
            $location = json_encode([[
                'city_name' => $location[0]->city_name ?? 'Unknown City',
                'country_name' => $location[0]->country_name ?? 'Unknown Country'
            ]]);
        }

        $data = [
            'name' => $temp->data_name,
            'status' => $this->db->get_where('pbd_items_sells', ['pbd_items_id' => $temp->id])->row()->data_status ?? '',
            'sku' => $temp->data_sku,
            'type' => $temp->data_type,
            'category' => $category,
            'description' => strip_tags($temp->data_description),
            'label' =>$temp->data_label,
            'image' => $image,
			'seller' => [
                'id' => $seller->id ?? '',
                'name' => $seller->name_full ?? '',
                'username' => $seller->username ?? '',
                'file_path' => $seller->file_path ?? '',
				'file_name_original' => $seller->file_name_original ?? '',
            ],
            'compimg' => $sellImg,
            'location' => $location,
			'email' => $temp->data_email,
			'phone' => $temp->data_phone,
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

    public function delete()
    {
        $items_id   = $this->input->post('items-id');
        $this->db->where('pbd_items.id',$items_id);
        $this->db->delete('pbd_items');
        redirect(base_url('market/manage'));
    }

	public function upload_gallery()
	{
		$user_id     = $_SESSION['user_id'];
		$config['upload_path']   = 'public/uploads/products/gallery';
        $config['allowed_types'] = 'gif|jpg|png|ico';
        $this->load->library('upload',$config);

        if($this->upload->do_upload('userfile')){
        	$token=$this->input->post('token_photo');
			$secret_id=$this->input->post('secret_id');
        	$name=$this->upload->data('file_name');
			$this->session->set_userdata('token_photo', $token);
        	$this->db->insert('gallery_photo',array('user_id'=>$user_id,'module_id'=>1,'module_table'=>'market','name'=>$name,'token'=>$token,'secret_id'=>$secret_id));
        }
	}

	// function delete_photo(){
		
	// 	$token=$this->input->post('token');
		
	// 	$foto=$this->db->get_where('gallery_photo',array('secret_id'=>$token));

	// 	if($foto->num_rows()>0){
	// 		$hasil=$foto->row();
	// 		$nama_foto=$hasil->nama_foto;
	// 		if(file_exists($file='public/uploads/products/gallery/'.$nama_foto)){
	// 			unlink($file);
	// 		}
	// 		$this->db->delete('gallery_photo',array('secret_id'=>$token));
	// 	}

	// 	echo "{}";
	// }
	
	function delete_photo(){
		
		$token=$this->input->post('token');
		
		$foto=$this->db->get_where('gallery_photo',array('secret_id'=>$token));

		if($foto->num_rows()>0){
			$hasil=$foto->row();
			$nama_foto=$hasil->nama_foto;
			if(file_exists($file='public/uploads/products/gallery/'.$nama_foto)){
				unlink($file);
			}
			$this->db->delete('gallery_photo',array('secret_id'=>$token));
		}
		$getToken = $this->db->get_where('gallery_photo',array('secret_id'=>$token))->row();
		if($foto->num_rows()>0){
			$data = $this->db->get_where('gallery_photo',array('token'=>$getToken->token))->result();
		}else{
			$data = [];
		}
		echo json_encode("Success");
	}
	
}
