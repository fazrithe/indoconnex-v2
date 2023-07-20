<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Business_public extends Base_users
{
	protected $module_base                  = 'business/list';
	protected $apps_title_module            = 'profile';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation','pagination');
		$this->load->model('M_business');
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
		$this->display('list', $data);
	}

	/** Discover Business Page */
	public function discover()
	{

		$page = (int)$this->uri->segment(4);
		$data = [
			'title_web' => 'Dashboard',
			'users'     => $this->db->get_where('users')->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
		];
		$data['CSRF'] = [
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash(),
		];
		$limit = 6;
		$offset = 0;
		if($page > 0)
		{
			$offset = ($limit * $page) - $limit;
		}
		$val_business = $this->M_business->data($limit, $offset);
		$countdata = $this->M_business->count_data();
		$config['base_url'] = site_url('public/business/discover'); //site url
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
		$data['business']       = $result;
		$data["types"]          = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
		$data["categories"]     = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
		$data["countries"]     = $this->db->get('loc_countries')->result();
		$data["business_all"]   = $this->db->get('pbd_business')->result();
		$data['pagination']     = $this->pagination->create_links();
		$data['total_rows']     = $countdata;

		config('title', 'Discover Business Pages');

		$this->display('discover', $data);
	}

	public function discover_filter()
	{
		$name       = $this->input->get('business-name');
		$location   = $this->input->get('business-location');
		$type       = $this->input->get('business-type');
		$category   = $this->input->get('business-categories');
		$page = (int)$this->uri->segment(5);
		$data = [
			'title_web' => 'Dashboard',
			'users'     => $this->db->get_where('users')->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),

		];
		$data['CSRF'] = [
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash(),
		];
		$countdata = $this->M_business->count_data_filter($category,$category, $type, $location, $name);

		$limit = 6;
		$offset = 0;
		if($page > 0)
		{
			$offset = ($limit * $page) - $limit;
		}
		
		$val_business = $this->M_business->filter($category,$category, $type, $location, $name, $limit, $offset);

		$config['base_url'] = site_url('public/discover/business/filter'); //site url
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
				if(!empty($location and $val->data_locations)){
					foreach(json_decode($val->data_locations) as $val_locations){
						if($val_locations->country_id == $location){
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
				}else{
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

		$result1 = array();
		$data_filter = $result1[] = array(
			'name'   => $name,
			'type'   => $type,
			'category' => $category,
			'location' => $location,
		);

		$data['data_filter']    =  $data_filter;
		$data['business']       = $result;
		$data["types"]          = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
		$data["categories"]     = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
		$data["countries"]      = $this->db->get('loc_countries')->result();
		$data['total_rows']     = $countdata;
		$data['pagination']     = $this->pagination->create_links();

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

}
