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

	/** List Business Page */
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

		$data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id,'status'=>1))->result();
		$data['business_claims'] = $this->M_business->business_claim($user_id)->result();
		// echo json_encode($data['business_claim']);
		// exit();
		config('title', 'My Business Page');
		$this->display('list', $data);
	}

	/** Create Business */
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

		$data["types"]         = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
		$data["categories"]         = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
		config('title', 'Create Business Page');
		$this->display('create', $data);
	}

	/** Store Business */
	public function store($parameter_id = null)
	{
		$parameter_url_source = $this->module_url_default . '/business/create/';
		$this->action_store_business($parameter_url_source, $parameter_id);
	}

	/** Update Business */
	public function update($parameter_id = null)
	{
		$parameter_url_source = $this->module_url_default . '/business/';
		$this->action_update_business($parameter_url_source, $parameter_id);
	}

	/** Suggest Business */
	public function add_suggest($parameter_id = null)
	{
		$parameter_url_source = $this->module_url_default . '/business/';
		$this->action_suggest_business($parameter_url_source, $parameter_id);
	}

	/** Claim Business */
	public function add_claim($parameter_id = null)
	{
		$parameter_url_source = $this->module_url_default . '/business/';
		$this->action_claim_business($parameter_url_source, $parameter_id);
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

	/** Discover Business Page */
	public function discover()
	{
		$user_id     = $_SESSION['user_id'];
		$page = (int)$this->uri->segment(3);
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
		$limit = 6;
		$offset = 0;
		if($page > 0)
		{
			$offset = ($limit * $page) - $limit;
		}
		$countdata = $this->M_business->count_data($limit, $offset);
		$config['base_url'] = site_url('business/discover'); //site url
		$config['total_rows'] = $this->M_business->count_data();
		$val_business = $this->M_business->data($limit, $offset);
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
		foreach($val_business as $val){
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
		$data['business']       = $result;
		$this->db->order_by('data_name', 'ASC');
		$query_type = $this->db->get_where('pbd_business_types',array('status'=>1));
		$this->db->order_by('data_name', 'ASC');
		$query_category = $this->db->get_where('pbd_business_categories',array('status'=>1));
		$location = $data['users']->data_locations;
			if(!empty(json_decode($location))){
				foreach(json_decode($location) as $val_loc){
					$country_name = $val_loc->country_name;
				}
			}else{
				$country_name = 'Indonesia';
			}
		$data['country_name'] = $country_name;
		$data["types"]          = $query_type->result();
		$data["categories"]     = $query_category->result();
		$data["countries"]     = $this->db->get('loc_countries')->result();
		$data["business_all"]   = $this->db->get('pbd_business')->result();
		$data['pagination']     = $this->pagination->create_links();
		$data['total_rows']     = $countdata;
		config('title', 'Discover Business Pages');
		$this->display('discover', $data);
	}

	public function discover_filter()
	{

		$user_id     = $_SESSION['user_id'];
		$name       = $this->input->get('business-name');
		$location   = $this->input->get('business-location');
		$type       = $this->input->get('business-type');
		$category   = $this->input->get('business-categories');
		$sub_category   = $this->input->get('sub-business-categories');
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
		$countdata = $this->M_business->count_data_filter($sub_category, $category, $type, $location, $name);
		$limit = 6;
		$offset = 0;
		if($page > 0)
		{
			$offset = ($limit * $page) - $limit;
		}
		$val_business = $this->M_business->filter($sub_category, $category, $type, $location, $name, $limit, $offset);
		$config['base_url'] = site_url('business/discover/filter'); //site url
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
			foreach($val_business as $val){
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
		$result1 = array();
		$data_filter = $result1[] = array(
			'name'   => $name,
			'type'   => $type,
			'category' => $category,
			'sub_category' => $sub_category,
			'location' => $location,
		);

		$data['data_filter']    =  $data_filter;
		$data['business']       = $result;
		$this->db->order_by('data_name', 'ASC');
		$query_type = $this->db->get_where('pbd_business_types',array('status'=>1));
		$this->db->order_by('data_name', 'ASC');
		$query_category = $this->db->get_where('pbd_business_categories',array('status'=>1));
		$data["types"]          = $query_type->result();
		$data["categories"]     = $query_category->result();
		$data["countries"]      = $this->db->get('loc_countries')->result();
		$data['total_rows']     = $countdata;
		$data['pagination']     = $this->pagination->create_links();
		// config('title', 'Discover Business Pages');
		if ($type && $category && $location) {
			$business_type = $this->M_business->getBusinessTypeName($type);
			$business_category = $this->M_business->getBusinessCategoryName($category);
			$business_location = $this->M_business->getBusinessLocationName($location);

			config('title', 'Discover Business Pages' . ' - ' . $business_type . ' - ' . $business_category . ' - ' . $business_location);
		} else if ($type && $category) {
			$business_type = $this->M_business->getBusinessTypeName($type);
			$business_category = $this->M_business->getBusinessCategoryName($category);

			config('title', 'Discover Business Pages' . ' - ' . $business_type . ' - ' . $business_category);
			
		} else if ($type && $location) {
			$business_type = $this->M_business->getBusinessTypeName($type);
			$business_location = $this->M_business->getBusinessLocationName($location);

			config('title', 'Discover Business Pages' . ' - ' . $business_type . ' - ' . $business_location);
		} else if ($category && $location) {
			$business_category = $this->M_business->getBusinessCategoryName($category);
			$business_location = $this->M_business->getBusinessLocationName($location);

			config('title', 'Discover Business Pages' . ' - ' . $business_category . ' - ' . $business_location);
		} else if ($type) {
			$business_type = $this->M_business->getBusinessTypeName($type);

			config('title', 'Discover Business Pages' . ' - ' . $business_type);
		} else if ($category) {
			$business_category = $this->M_business->getBusinessCategoryName($category);
			config('title', 'Discover Business Pages' . ' - ' . $business_category);
		} else if ($location) {
			$business_location = $this->M_business->getBusinessLocationName($location);
			config('title', 'Discover Business Pages' . ' - ' . $business_location);
		} else {
			config('title', 'Discover Business Pages');
		}
		
		$this->display('discover-filter', $data);
	}

	public function setting($id)
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

		$data["types"]          = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
		$data["categories"]     = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
		$data["facilities"]     = $this->db->get_where('mst_facilities',array('status'=>1))->result();
		$data['business']       = $this->db->get_where('pbd_business',array('id'=>$id))->row();
		$data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id,'status'=>1))->result();
		if(!empty($data['business']->data_locations)){
			$result = json_decode($data['business']->data_locations);
			foreach($result as $value){
				$data['country']  = $this->db->get_where('loc_countries',array('id'=>$value->country_id))->row();
				$data['state']  = $this->db->get_where('loc_states',array('id'=>$value->state_id))->row();
				$data['city']  = $this->db->get_where('loc_cities',array('id'=>$value->city_id))->row();
			}
		}
		config('title', 'Manage Business Page' . ' - ' . $this->db->get_where('pbd_business',array('id'=>$id))->row()->data_name);
		$this->display('manage', $data);
	}

	public function suggest($id)
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

		$data["types"]          = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
		$data["categories"]     = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
		$data["facilities"]     = $this->db->get_where('mst_facilities',array('status'=>1))->result();
		$data['business']       = $this->db->get_where('pbd_business',array('id'=>$id))->row();
		$data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id,'status'=>1))->result();
		if(!empty($data['business']->data_locations)){
			$result = json_decode($data['business']->data_locations);
			foreach($result as $value){
				$data['country']  = $this->db->get_where('loc_countries',array('id'=>$value->country_id))->row();
				$data['state']  = $this->db->get_where('loc_states',array('id'=>$value->state_id))->row();
				$data['city']  = $this->db->get_where('loc_cities',array('id'=>$value->city_id))->row();
			}
		}
		config('title', 'Manage Business Page' . ' - ' . $this->db->get_where('pbd_business',array('id'=>$id))->row()->data_name);
		$this->display('suggest', $data);
	}

	public function claim($id)
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

		$data["types"]          = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
		$data["categories"]     = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
		$data["facilities"]     = $this->db->get_where('mst_facilities',array('status'=>1))->result();
		$data['business']       = $this->db->get_where('pbd_business',array('id'=>$id))->row();
		$data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id,'status'=>1))->result();
		if(!empty($data['business']->data_locations)){
			$result = json_decode($data['business']->data_locations);
			foreach($result as $value){
				$data['country']  = $this->db->get_where('loc_countries',array('id'=>$value->country_id))->row();
				$data['state']  = $this->db->get_where('loc_states',array('id'=>$value->state_id))->row();
				$data['city']  = $this->db->get_where('loc_cities',array('id'=>$value->city_id))->row();
			}
		}
		config('title', 'Manage Business Page' . ' - ' . $this->db->get_where('pbd_business',array('id'=>$id))->row()->data_name);
		$this->display('claim', $data);
	}


	public function categories()
	{
		$query = $this->input->post('query');
		$status = true;

		$data['CSRF'] = [
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash(),
		];
		$data['data'] = $this->db->from('pbd_business_categories')
			->where('status', 1)
			->like('data_name', $query)
			->limit(10)
			->get()
			->result_array();

		if (empty($data['data'])) {
			$status = false;
		}
		$data['status'] = $status;
		echo json_encode($data);
	}

	/** Delete Business */
	public function delete()
	{
		$business_id    = $this->input->post('business_id');
		$this->db->where('id',$business_id);
		$this->db->delete('pbd_business');

		$this->db->where('pbd_business_id',$business_id);
		$this->db->delete('pbd_items');

		$this->db->where('pbd_business_id',$business_id);
		$this->db->delete('pcj_jobs');

		$this->db->where('pbd_business_id',$business_id);
		$this->db->delete('pfe_posts');

		$this->db->where('pbd_business_id',$business_id);
		$this->db->delete('pfe_articles');

		$this->db->where('user_follow_id',$business_id);
		$this->db->delete('users_follows');

		redirect('business/list');
	}

	public function get_category(){
		$id = $this->input->post('id');
        $category = $this->M_business->get_subcategory($id);
		$data = $this->db->get_where('pbd_business_categories',array('parent'=>$category->id,'status'=>1))->result();
        $category_row=$this->db->get_where('pbd_business_categories',array('parent'=>$category->id,'status'=>1))->num_rows();
		$data = [
			"category" => $data,
			"category_count" => $category_row,
		];
		echo json_encode($data);
	}
}
