<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Tender extends Base_users
{
    protected $module_base                  = 'tender/list';
    protected $apps_title_module            = 'profile';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation','pagination');
        $this->load->model('M_tender');
        if(!empty($this->session->userdata('is_login') == FALSE)){
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }
    }

	/** List Tender */
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

        $countdata = $this->M_tender->count_data_user($user_id);
        $config['base_url'] = site_url('tender/list'); //site url
        $config['total_rows'] = $this->M_tender->count_data_user($user_id);
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

        $data['tender_list']         = $this->M_tender->data($user_id,$limit,$offset);
        $data['business']  = $this->db->get_where('pbd_business', array('users_id'=>$user_id))->num_rows();
		$data["tender_categories"]    = $this->db->get_where('pbt_tender_categories', array('status'=>1))->result();
		$data["tender_types"]    = $this->db->get_where('pbt_tender_types', array('status'=>1))->result();
        $data["countries"]          = $this->db->get('loc_countries')->result();
        $data["tender_all"]        = $this->db->get('pbt_tender')->result();
        $data['pagination']         = $this->pagination->create_links();
        $data['total_rows']         = $countdata;
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        config('title', 'My Tender');
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

        $countdata = $this->M_tender->count_data_filter($id);
        $config['base_url'] = site_url('market/list_filter'); //site url
        $config['total_rows'] = $this->M_tender->count_data_filter($id);
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
        $data['tender_list']         = $this->M_tender->data_filter($id,$limit,$offset);
        $data['business']  = $this->db->get_where('pbd_business', array('users_id'=>$user_id))->num_rows();
		$data["tender_categories"]    = $this->db->get_where('pbt_tender_categories', array('status'=>1))->result();
		$data["tender_types"]    = $this->db->get_where('pbt_tender_types', array('status'=>1))->result();
        $data["countries"]          = $this->db->get('loc_countries')->result();
        $data["product_all"]        = $this->db->get_where('pbd_items',array('pbd_business_id'=>$id))->result();
        $data['pagination']         = $this->pagination->create_links();
        $data['total_rows']         = $countdata;
        $data['filter_id']          = $id;
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        config('title', 'My Tender');
        $this->display('list', $data);
    }

	/** Create Tender -> Store */
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
        $data["types"]          = $this->db->get_where('pbt_tender_types',array('status'=>1))->result();
        $data['business_list']  = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        $data["business"]       = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->row();
        $data["categories"]     = $this->db->order_by('data_name', 'asc')->get_where('pbt_tender_categories',array('status'=>1))->result();
        config('title', 'Create Tender');
        $this->display('create', $data);
    }

    public function store($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/tender/create/';
        $this->action_store_tender($parameter_url_source, $parameter_id);
    }

    public function edit($parameter_id)
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

        $data['tender'] = $this->M_tender->getTenderById($parameter_id);
        $data['business_count'] = $this->db->get_where('pbd_business', array('users_id' => $user_id))->num_rows();
        $data["labeles"] = $this->db->get_where('pbd_items_labels', array('status' => 1))->result();
        $data["types"] = $this->db->get_where('pbt_tender_types', array('status' => 1))->result();
        $data['business_list'] = $this->db->get_where('pbd_business', array('users_id' => $user_id))->result();
        $data["business"] = $this->db->get_where('pbd_business', array('users_id' => $user_id))->row();
        $data["categories"] = $this->db->order_by('data_name', 'asc')->get_where('pbt_tender_categories', array('status' => 1))->result();
      
        if(! empty($data['tender']->data_locations)){
			$location = json_decode($data['tender']->data_locations);

			foreach ($location as $value){
				$data['country'] = $this->db->get_where('loc_countries', array('id' => $value->country_id))->row();
				$data['state'] = $this->db->get_where('loc_states', array('id' => $value->state_id))->row();
				$data['city'] = $this->db->get_where('loc_cities', array('id' => $value->city_id))->row();
			}
		}

        config('title', 'Edit Tender');
        $this->display('edit', $data);
    }

	/** Update Tender */
    public function update($parameter_id = null)
    {
        $this->action_update_tender( $parameter_id);
    }


	/** Discover Tender */
    public function discover() {
        $user_id     = $_SESSION['user_id'];
        $name       = $this->input->get('tender-name');
        $location   = $this->input->get('tender-location');
        $type       = $this->input->get('tender-type');
        $category   = $this->input->get('tender-category');
        $location   = $this->input->get('tender-location');

		$page = (int)$this->uri->segment(3);
        if($name || $location || $type || $category || $location){
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
            $countdata = $this->M_tender->count_data();

            $tender   = $this->M_tender->search_tender($name,$type,$category)->result();

            $result = array();
            foreach($tender as $val){
				$result[] = array(
                    'id' => $val->id,
                    'data_name' => $val->data_name,
                    'data_categories' => $val->data_categories,
                    'data_description'  => $val->data_description,
                    'file_path' => $val->file_path,
                    'file_name_original' => $val->file_name_original,
                );
            }
            $data['tender']    = $result;
            $data['tender_name'] = $name;
			$data['tender_type'] = $type;
			$data['tender_category'] = $category;
            $data['business']  = $this->db->get_where('pbd_business', array('users_id'=>$user_id))->num_rows();
			$data["tender_categories"]    = $this->db->get_where('pbt_tender_categories', array('status'=>1))->result();
            $data["tender_types"]        = $this->db->get_where('pbt_tender_types', array('status'=>1))->result();
            $data["countries"]          = $this->db->get('loc_countries')->result();
            $data['total_rows']     = count($result);
            // config('title', 'Discover Tender');
            if ($type && $category && $location) {
                $tender_type = $this->M_tender->getTenderTypeName($type);
                $tender_category = $this->M_tender->getTenderCategoryName($category);
                $tender_location = $this->M_tender->getTenderLocationName($location);
    
                config('title', 'Discover Tender' . ' - ' . $tender_type . ' - ' . $tender_category . ' - ' . $tender_location);
            } else if ($type && $category) {
                $tender_type = $this->M_tender->getTenderTypeName($type);
                $tender_category = $this->M_tender->getTenderCategoryName($category);
    
                config('title', 'Discover Business' . ' - ' . $tender_type . ' - ' . $tender_category);
                
            } else if ($type && $location) {
                $tender_type = $this->M_tender->getTenderTypeName($type);
                $tender_location = $this->M_tender->getTenderLocationName($location);
    
                config('title', 'Discover Business' . ' - ' . $tender_type . ' - ' . $tender_location);
            } else if ($category && $location) {
                $tender_category = $this->M_tender->getTenderCategoryName($category);
                $tender_location = $this->M_tender->getTenderLocationName($location);
    
                config('title', 'Discover Business' . ' - ' . $tender_category . ' - ' . $tender_location);
            } else if ($type) {
                $tender_type = $this->M_tender->getTenderTypeName($type);
    
                config('title', 'Discover Business' . ' - ' . $tender_type);
            } else if ($category) {
                $tender_category = $this->M_tender->getTenderCategoryName($category);
                config('title', 'Discover Business' . ' - ' . $tender_category);
            } else if ($location) {
                $tender_location = $this->M_tender->getTenderLocationName($location);
                config('title', 'Discover Business' . ' - ' . $tender_location);
            } else {
                config('title', 'Discover Business');
            }

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
            $config['base_url'] = site_url('tender/discover'); //site url
            $config['total_rows'] = $this->M_tender->count_data();
            $limit = 6;
            $offset = $this->uri->segment(3) * $limit;
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

            $tender          = $this->M_tender->show_all($limit,$offset);
            $result = array();
            foreach($tender as $val){
                $result[] = array(
                    'id' => $val->id,
                    'data_name' => $val->data_name,
                    'data_categories' => $val->data_categories,
                    'data_description'  => $val->data_description,
                    'file_path' => $val->file_path,
                    'file_name_original' => $val->file_name_original,
                );
            }
            $data['business']  = $this->db->get_where('pbd_business', array('users_id'=>$user_id))->num_rows();
            $data['tender']    = $result;
            $data["tender_categories"]    = $this->db->get_where('pbt_tender_categories', array('status'=>1))->result();
            $data["tender_types"]        = $this->db->get_where('pbt_tender_types', array('status'=>1))->result();
            $data["countries"]          = $this->db->get('loc_countries')->result();
            $data['pagination']     = $this->pagination->create_links();
			$data['total_rows'] = $config['total_rows'];
			$location = $data['users']->data_locations;
			if(!empty(json_decode($location))){
				foreach(json_decode($location) as $val_loc){
					$country_name = $val_loc->country_name;
				}
			}else{
				$country_name = 'Indonesia';
			}
			$data['country_name'] = $country_name;
            config('title', 'Discover Tender');
            $this->display('discover', $data);
        }
    }


	/** Manage Tender */
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

        $countdata = $this->M_tender->count_data_user($user_id);
        $config['base_url'] = site_url('market/list'); //site url
        $config['total_rows'] = $this->M_tender->count_data_user($user_id);
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
        $data['business']  			= $this->db->get_where('pbd_business', array('users_id'=>$user_id))->num_rows();
        $data['tender_list']         = $this->M_tender->data($user_id,$limit,$offset);
        $data["tender_categories"]    = $this->db->get_where('pbt_tender_categories', array('status'=>1))->result();
		$data["tender_types"]    = $this->db->get_where('pbt_tender_types', array('status'=>1))->result();
        $data["countries"]          = $this->db->get('loc_countries')->result();
        $data['pagination']         = $this->pagination->create_links();
        $data['total_rows']         = $countdata;
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        $data["categories"]     = $this->db->order_by('data_name', 'asc')->get_where('pbd_items_categories',array('status'=>1))->result();
        config('title', 'Manage Tender');
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

        $countdata = $this->M_tender->count_data_user_filter($id);
        $config['base_url'] = site_url('market/list'); //site url
        $config['total_rows'] = $this->M_tender->count_data_user_filter($id);
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
        $data['tender_list']         = $this->M_tender->data_filter($id,$limit,$offset);
        $data["tender_categories"]    = $this->db->get_where('pbt_tender_categories', array('status'=>1))->result();
		$data["tender_types"]    = $this->db->get_where('pbt_tender_types', array('status'=>1))->result();
        $data["countries"]          = $this->db->get('loc_countries')->result();
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
        config('title', 'Manage Tender');
        $this->display('manage', $data);
    }

	/** Show Tender */
    public function show($id) {
        $item = $this->db->from('pbt_tender')
            ->where('id', $id)->get();
        $temp = $item->row();

        $seller = $this->db->select('data_name, file_path, file_name_original')->get_where('pbd_business',array('id'=>$temp->pbd_business_id))->row();

        $category = $this->db->from('pbt_tender_categories')
            ->where_in('id', json_decode($temp->data_categories))->get();
        $image = placeholder($temp->file_path, $temp->file_name_original, 'product', '4x3');
		$image_seller = placeholder($seller->file_path, $seller->file_name_original);
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
            'type' => $temp->data_types,
            'category' => $category->row(),
            'description' => $temp->data_description,
            'image' => $image,
            'location' => $location,
			'seller_name' => $seller->data_name,
			'seller_image' => $image_seller,
        ];

        echo json_encode($data);
    }

	/** Delete Tender */
    public function delete()
    {
        $tender_id   = $this->input->post('tender-id');
        $this->db->where('pbt_tender.id',$tender_id);
        $this->db->delete('pbt_tender');
        redirect(base_url('tender/manage'));
    }
}
