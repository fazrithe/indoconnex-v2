<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Jobs extends Base_users
{
    protected $module_base                  = 'jobs/list';
    protected $apps_title_module            = 'profile';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation','pagination');
        $this->load->model('M_jobs');
        $this->load->helper(array('url','download'));
        if(!empty($this->session->userdata('is_login') == FALSE)){
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }
    }

	/** List Job Posting */
    public function list()
    {
        if(empty($id)) {
            $id = $_SESSION['user_id'];
        }

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
        $countdata = $this->M_jobs->count_data_user($id);
        $config['base_url'] = site_url('jobs/list'); //site url
        $config['total_rows'] = $this->M_jobs->count_data_user($id);
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
        $data['pagination']     = $this->pagination->create_links();
        $data['jobs'] = $this->M_jobs->list($id,$limit,$offset)->result();
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        config('title', 'My Jobs Page');
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
        $page = (int)$this->uri->segment(3);
        $limit = 6;
        $offset = 0;
        if($page > 0)
        $offset = ($limit * $page) - $limit;
        $countdata = $this->M_jobs->count_data_business($id);
        $config['base_url'] = site_url('jobs/list'); //site url
        $config['total_rows'] = $this->M_jobs->count_data_business($id);
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
        $data['pagination']     = $this->pagination->create_links();
        $data['jobs'] = $this->M_jobs->list_filter($id,$limit,$offset)->result();
        $data['filter_id']          = $id;
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        config('title', 'My Jobs Page');
        $this->display('list', $data);
    }

	/** Job applications */
    public function applications()
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
        $data['jobs_list'] = $this->db->get_where('pcj_jobs',array('created_by'=>$user_id))->result();
        $this->display('list', $data);
    }

	/** Create Jobs -> Store */
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
        $data['salary_period']  = $this->db->get_where('pcj_jobs_salary_period',array('status'=>1))->result();
        $data['jobs_type']  = $this->db->get_where('pcj_jobs_types',array('status'=>1))->result();
        $data['jobs_categories'] = $this->db->get_where('pcj_jobs_categories',array('status'=>1))->result();
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        config('title', 'Create Job');
        $this->display('create', $data);
    }

    public function store($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/jobs/create/';
        $this->action_store_jobs($parameter_url_source, $parameter_id);
    }

	/** Update jobs */
    public function edit($parameter_id = null)
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

        $data['job'] = $this->M_jobs->getJobById($parameter_id);
        $data['salary_period'] = $this->db->get_where('pcj_jobs_salary_period', array('status' => 1))->result();
        $data['jobs_type'] = $this->db->get_where('pcj_jobs_types', array('status' => 1))->result();
        $data['jobs_categories'] = $this->db->get_where('pcj_jobs_categories', array('status' => 1))->result();
        $data['business_list'] = $this->db->get_where('pbd_business', array('users_id' => $user_id))->result();

        if(! empty($data['job']->data_location)){
			$location = json_decode($data['job']->data_location);

			foreach ($location as $value){
				$data['country'] = $this->db->get_where('loc_countries', array('id' => $value->country_id))->row();
				$data['state'] = $this->db->get_where('loc_states', array('id' => $value->state_id))->row();
				$data['city'] = $this->db->get_where('loc_cities', array('id' => $value->city_id))->row();
			}
		}

        config('title', 'Edit Job');
        $this->display('edit', $data);
    }

    public function update($parameter_id = null)
    {
        $this->action_update_jobs($parameter_id);
    }

	/** Dicover Jobs */
    public function discover() {
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
                $offset = ($limit * $page) - $limit;
                $countdata = $this->M_jobs->count_data($limit, $offset);
                $config['base_url'] = site_url('jobs/discover'); //site url
                $config['total_rows'] = $this->M_jobs->count_data();
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
            $data['jobs']           = $this->M_jobs->data_jobs($limit,$offset)->result();
			$data["countries"]      = $this->db->get('loc_countries')->result();
            $data['pagination']     = $this->pagination->create_links();
            $data['total_rows']     = $countdata;
            $data['jobs_type']  = $this->db->get_where('pcj_jobs_types',array('status'=>1))->result();
			$this->db->order_by('data_name', 'ASC');
			$query_category = $this->db->get_where('pcj_jobs_categories',array('status'=>1));
            $data["jobs_categories"]    = $query_category->result();
			$location = $data['users']->data_locations;
			if(!empty(json_decode($location))){
				foreach(json_decode($location) as $val_loc){
					$country_name = $val_loc->country_name;
				}
			}else{
				$country_name = 'Indonesia';
			}
			$data['country_name'] = $country_name;
            config('title', 'Discover Job Page');
            $this->display('discover-job', $data);
    }

    public function discover_filter() {
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

            $name = $this->input->get('job-name');
            $type = $this->input->get('job-type');
            $category = $this->input->get('job-category');
            $salary_min = $this->input->get('salary-min');
            $salary_max = $this->input->get('salary-max');
			$location	= $this->input->get('job-location');
            $jobs = $this->M_jobs->filter($name,$type,$category,$salary_min,$salary_max);
			// dd($jobs);
            $result = array();
            foreach($jobs as $value){
				if(!empty($location and $value->data_location)){
					foreach(json_decode($value->data_location) as $val_locations){
						if($val_locations->country_id == $location){
                            $result[] = array(
                                'id' => $value->id,
                                'data_name' => $value->data_name,
                                'full_name' => $value->fullname,
                                'data_location' => $value->data_location,
                                'file_path' => $value->file_path,
                                'file_name_original' => $value->file_name_original,
                                'jobs_types_id' => $value->jobs_types_id,
                                'jobs_categories' => $value->data_categories,
                                'jb_salary_min' => $value->jb_salary_min,
                                'jb_salary_max' => $value->jb_salary_max,
                            );
						}
					}
				}else{
					$result[] = array(
						'id' => $value->id,
						'data_name' => $value->data_name,
                        'full_name' => $value->fullname,
						'data_location' => $value->data_location,
						'file_path' => $value->file_path,
						'file_name_original' => $value->file_name_original,
						'jobs_types_id' => $value->jobs_types_id,
						'jobs_categories' => $value->data_categories,
						'jb_salary_min' => $value->jb_salary_min,
						'jb_salary_max' => $value->jb_salary_max,
					);
				}
        
            }
			$result1 = array();
			$data_filter = $result1[] = array(
				'name'   => $name,
				'type'   => $type,
				'category' => $category,
				'location'	=> $location,
				'salary_min' => $salary_min,
				'salary_max' => $salary_max
			);
			
			$data['data_filter']    =  $data_filter;
            $data['jobs'] = $result;
            $data['jobs_name'] = $name;
            $data['total_rows']     = count($result);
            $data['pagination']     = $this->pagination->create_links();
            $data["countries"]      = $this->db->get('loc_countries')->result();
            $data['jobs_type']  = $this->db->get_where('pcj_jobs_types',array('status'=>1))->result();
			$this->db->order_by('data_name', 'ASC');
			$query_category = $this->db->get_where('pcj_jobs_categories',array('status'=>1));
            $data["jobs_categories"]    = $query_category->result();
            // config('title', 'Discover Job Page');
            if ($type && $category && $location) {
                $business_type = $this->M_jobs->getJobTypeName($type);
                $business_category = $this->M_jobs->getJobCategoryName($category);
                $business_location = $this->M_jobs->getJobLocationName($location);
    
                config('title', 'Discover Job Page' . ' - ' . $business_type . ' - ' . $business_category . ' - ' . $business_location);
            } else if ($type && $category) {
                $business_type = $this->M_jobs->getJobTypeName($type);
                $business_category = $this->M_jobs->getJobCategoryName($category);
    
                config('title', 'Discover Job Page' . ' - ' . $business_type . ' - ' . $business_category);
                
            } else if ($type && $location) {
                $business_type = $this->M_jobs->getJobTypeName($type);
                $business_location = $this->M_jobs->getJobLocationName($location);
    
                config('title', 'Discover Job Page' . ' - ' . $business_type . ' - ' . $business_location);
            } else if ($category && $location) {
                $business_category = $this->M_jobs->getJobCategoryName($category);
                $business_location = $this->M_jobs->getJobLocationName($location);
    
                config('title', 'Discover Job Page' . ' - ' . $business_category . ' - ' . $business_location);
            } else if ($type) {
                $business_type = $this->M_jobs->getJobTypeName($type);
    
                config('title', 'Discover Job Page' . ' - ' . $business_type);
            } else if ($category) {
                $business_category = $this->M_jobs->getJobCategoryName($category);
                config('title', 'Discover Job Page' . ' - ' . $business_category);
            } else if ($location) {
                $business_location = $this->M_jobs->getJobLocationName($location);
                config('title', 'Discover Job Page' . ' - ' . $business_location);
            } else {
                config('title', 'Discover Job Page');
            }
            $this->display('discover-job-filter', $data);
    }

	/** Find Employee */
    public function employee() {
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
                $offset = ($limit * $page) - $limit;
            $countdata = $this->M_jobs->count_data_jobs_user($limit,$offset);
            $config['base_url'] = site_url('jobs/employee'); //site url
            $config['total_rows'] = $this->M_jobs->count_data_jobs_user($limit,$offset);
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
            $data['pagination']     = $this->pagination->create_links();
			$data["countries"]      = $this->db->get('loc_countries')->result();
            $data['employee']           = $this->M_jobs->data_jobs_users($limit,$offset)->result();
            $data['salary_period']  = $this->db->get_where('pcj_jobs_salary_period',array('status'=>1))->result();
            $data['jobs_type']  = $this->db->get_where('pcj_jobs_types',array('status'=>1))->result();
			$this->db->order_by('data_name', 'ASC');
			$query_category = $this->db->get_where('pcj_jobs_categories',array('status'=>1));
            $data["jobs_categories"]    = $query_category->result();
            $data['pagination']     = $this->pagination->create_links();
            $data['total_rows']     = $countdata;
			$location = $data['users']->data_locations;
			if(!empty(json_decode($location))){
				foreach(json_decode($location) as $val_loc){
					$country_name = $val_loc->country_name;
				}
			}else{
				$country_name = 'Indonesia';
			}
			$data['country_name'] = $country_name;
            config('title', 'Discover Find Employee');
            $this->display('discover-employee', $data);
    }

	public function employee_filter(){
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
		$name       = $this->input->get('job-name');
		$type       = $this->input->get('job-type');
		$category = $this->input->get('job-category');
        $salary_min = $this->input->get('salary-min');
        $salary_max = $this->input->get('salary-max');
		$location	= $this->input->get('job-location');
        $em_jobs = $this->M_jobs->employee_filter($name,$type,$category,$salary_min,$salary_max);
		// dd($em_jobs);
        $result = array();
        foreach($em_jobs as $value){
			if(!empty($location and $value->data_location)){
				foreach(json_decode($value->data_location) as $val_locations){
					if($val_locations->country_id == $location){
                    $result[] = array(
                        'id' => $value->id,
                        'users_id' => $value->users_id,
                        'username' => $value->username,
                        'fullname' => $value->fullname,
                        'jobs_salary_period_id' => $value->jobs_salary_period_id,
                        'jobs_types_id' => $value->jobs_types_id,
                        'data_categories' => $value->data_categories,
                        'data_name' => $value->data_name,
                        'data_location' => $value->data_location,
                        'file_path' => $value->file_path,
                        'file_name_original' => $value->file_name_original,
                        'jobs_types_id' => $value->jobs_types_id,
                        'jobs_categories' => $value->data_categories,
                        'jb_salary_min' => $value->jb_salary_min,
                        'jb_salary_max' => $value->jb_salary_max,
                    );
					}
                }
            }
        }
        
		$result1 = array();
        $data_filter = $result1[] = array(
			'name'   => $name,
			'type'   => $type,
			'category' => $category,
			'location'	=> $location,
			'salary_min' => $salary_min,
			'salary_max' => $salary_max
		);
        $data['data_filter']    =  $data_filter;
        $data['jb_em_name']     = $name;
        $data['pagination']     = $this->pagination->create_links();
        $data['employee']       = $result;
		$data["countries"]      = $this->db->get('loc_countries')->result();
        $data['salary_period']  = $this->db->get_where('pcj_jobs_salary_period',array('status'=>1))->result();
        $data['jobs_type']      = $this->db->get_where('pcj_jobs_types',array('status'=>1))->result();
		$this->db->order_by('data_name', 'ASC');
		$query_category = $this->db->get_where('pcj_jobs_categories',array('status'=>1));
		$data["jobs_categories"]    = $query_category->result();
        $data['pagination']     = $this->pagination->create_links();
        $data['total_rows']     = count($result);
        // config('title', 'Discover Find Employee');
        if ($type && $category && $location) {
            $business_type = $this->M_jobs->getJobTypeName($type);
            $business_category = $this->M_jobs->getJobCategoryName($category);
            $business_location = $this->M_jobs->getJobLocationName($location);

            config('title', 'Discover Find Employee' . ' - ' . $business_type . ' - ' . $business_category . ' - ' . $business_location);
        } else if ($type && $category) {
            $business_type = $this->M_jobs->getJobTypeName($type);
            $business_category = $this->M_jobs->getJobCategoryName($category);

            config('title', 'Discover Find Employee' . ' - ' . $business_type . ' - ' . $business_category);
            
        } else if ($type && $location) {
            $business_type = $this->M_jobs->getJobTypeName($type);
            $business_location = $this->M_jobs->getJobLocationName($location);

            config('title', 'Discover Find Employee' . ' - ' . $business_type . ' - ' . $business_location);
        } else if ($category && $location) {
            $business_category = $this->M_jobs->getJobCategoryName($category);
            $business_location = $this->M_jobs->getJobLocationName($location);

            config('title', 'Discover Find Employee' . ' - ' . $business_category . ' - ' . $business_location);
        } else if ($type) {
            $business_type = $this->M_jobs->getJobTypeName($type);

            config('title', 'Discover Find Employee' . ' - ' . $business_type);
        } else if ($category) {
            $business_category = $this->M_jobs->getJobCategoryName($category);
            config('title', 'Discover Find Employee' . ' - ' . $business_category);
        } else if ($location) {
            $business_location = $this->M_jobs->getJobLocationName($location);
            config('title', 'Discover Find Employee' . ' - ' . $business_location);
        } else {
            config('title', 'Discover Find Employee');
        }
        $this->display('discover-employee-filter', $data);

	}

    public function applicant() {
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

        $data['jobs'] = $this->M_jobs->list_applicant($user_id)->result();
        $data['applicants'] = $this->M_jobs->applicant()->result();
        $data['business_list']  = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        config('title', 'Job Applicant');
        $this->display('applicant', $data);
    }

    public function applicant_filter($id) {
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

        $data['jobs'] = $this->M_jobs->list_applicant_business($id)->result();
        $data['filter_id'] = $id;
        $data['applicants'] = $this->M_jobs->applicant()->result();
        $data['business_list']  = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        config('title', 'Job Applicant');
        $this->display('applicant', $data);
    }

    public function setting($id) {
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
        $data["types"]          = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
        $data["categories"]     = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
        $data['business']       = $this->db->get_where('pbd_business',array('id'=>$id))->row();
        $data['business_list']  = $this->db->get_where('pbd_business',array('id'=>$id))->result();
        $result = json_decode($data['business']->data_locations);
        foreach($result as $value){
            $data['country']  = $this->db->get_where('loc_countries',array('id'=>$value->country_id))->row();
            $data['state']  = $this->db->get_where('loc_states',array('id'=>$value->state_id))->row();
            $data['city']  = $this->db->get_where('loc_cities',array('id'=>$value->city_id))->row();
        }
        $this->display('manage', $data);
    }

    public function service($query = null) {

        $user_id     = $_SESSION['user_id'];
        $business_id = '2109026130466B8C414SJR0W';
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

        $this->display('service', $data);
    }

	/** Managae Jobs */
    public function manage() {

        if(empty($id)) {
            $id = $_SESSION['user_id'];
        }

        $data = [
            'title_web' => 'Dashboard',
            'users'     => $this->db->get_where('users',array('id'=>$id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
        ];
        $data['CSRF'] = [
            'id' => $id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $page = (int)$this->uri->segment(3);
        $limit = 6;
        $offset = 0;
        if($page > 0)
        $offset = ($limit * $page) - $limit;
        $countdata = $this->M_jobs->count_data_user($id);
        $config['base_url'] = site_url('jobs/discover'); //site url
        $config['total_rows'] = $this->M_jobs->count_data_user($id);
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
        $data['pagination']     = $this->pagination->create_links();
        $data['jobs'] = $this->M_jobs->list($id,$limit,$offset)->result();
        $data['types'] = $this->db->get('pcj_jobs_types')->result();
        $data['categories'] = $this->db->get_where('pcj_jobs_categories',array('status'=>1))->result();
        $data['salary_period']  = $this->db->get_where('pcj_jobs_salary_period',array('status'=>1))->result();
        $data['currency'] = [
			'USD','IDR','AUD'
		];
        config('title', 'Manage Job');
		$this->display('manage', $data);
    }

    public function apply($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/jobs/apply/';
        $this->action_store_apply($parameter_url_source, $parameter_id);
    }

    public function detail($id)
    {

        $users_id =  $_SESSION['user_id'];
        $check_business          = $this->db->get_where('pcj_jobs',array('id'=>$id))->row();
        if(empty($check_business)){
            redirect('user/dashboard');
        }
        if ($this->input->post()) {
            $this->set_form_validation();
            switch ($this->input->post('form')) {
                case 'cover':
                    $this->cover_process($this->input->post('id'));
                    break;
                case 'photo':
                    $this->photo_process($this->input->post('id'));
                    break;
                default:
                    echo "Isi variabel tidak di temukan";
                    break;
            }
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module,
				'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
            );
            $data['CSRF'] = [
                'id' => $id,
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
        $data['jobs'] = $this->M_jobs->detail($id)->row();
        $data['jobs_categories'] = $this->db->get('pcj_jobs_categories')->result();
        $data['jobs_period'] = $this->db->get('pcj_jobs_salary_period')->result();
        $data["users"] = $this->db->get_where('users',array('id'=>$users_id))->row();
        $data["check_jobs"]          = $this->db->get_where('pcj_jobs_applicants',array('users_id'=>$users_id))->row();
        if($data['users']->id == $data['jobs']->users_id){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }
        config('title', 'Job - ' . $data['jobs']->data_name);
        $this->display('detail', $data);
        }
    }

	/** Delete Jobs */
    public function delete()
    {
        $job_id   = $this->input->post('job-id');
        $this->db->where('pcj_jobs.id',$job_id);
        $this->db->delete('pcj_jobs');
        redirect(base_url('jobs/manage'));
    }

	/** Preference Jobs */
    public function preference()
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
        $data['jobs']   = $this->db->get_where('users_jobs',array('users_id'=>$user_id))->row();
        if(!empty($data['jobs']->data_location)){
            $result = json_decode($data['jobs']->data_location);
                foreach($result as $value){
                    $data['country']  = $this->db->get_where('loc_countries',array('id'=>$value->country_id))->row();
                    $data['state']  = $this->db->get_where('loc_states',array('id'=>$value->state_id))->row();
                    $data['city']  = $this->db->get_where('loc_cities',array('id'=>$value->city_id))->row();
                }
        }else{
            $data['country']  = '';
            $data['state']  = '';
            $data['city']  = '';
        }
		$data['jobs_currency'] = [
			'USD','IDR','AUD'
		];
        $data['salary_period']  = $this->db->get_where('pcj_jobs_salary_period',array('status'=>1))->result();
        $data['jobs_type']  = $this->db->get_where('pcj_jobs_types',array('status'=>1))->result();
        $data['jobs_categories'] = $this->db->get_where('pcj_jobs_categories',array('status'=>1))->result();
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        config('title', 'My Job Preference');
        $this->display('preference-job', $data);
    }

    public function preference_update($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/jobs/update/';
        $this->action_update_preference_jobs($parameter_url_source, $parameter_id);
    }

    public function download_cv($id)
    {
        $cv = $this->db->get_where('users_jobs',array('id'=>$id))->row();
        $path = $cv->upload_file_path;
		force_download($path.$cv->upload_file_name,NULL);
	}

    public function photo_process(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/jobs/detail';
        $this->action_photo_profile_job($parameter_url_source, $parameter_id);
    }

    public function cover_process(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/jobs/detail';
        $this->action_cover_profile_job($parameter_url_source, $parameter_id);
    }

}
