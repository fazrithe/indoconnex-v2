<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Jobs_public extends Base_users
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
    }

	/** Find Employee */
    public function employee() {
			$page = (int)$this->uri->segment(3);
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
            $data['jobs_categories'] = $this->db->get_where('pcj_jobs_categories',array('status'=>1))->result();
            $data['pagination']     = $this->pagination->create_links();
            $data['total_rows']     = $countdata;

            config('title', 'Discover Find Employee');

            $this->display('discover-employee', $data);
    }

	public function employee_filter(){
        $data = [
            'title_web' => 'Dashboard',
            'users'     => $this->db->get_where('users')->row(),
        	];
        $data['CSRF'] = [
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
            }else{
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
        $data['jobs_categories'] = $this->db->get_where('pcj_jobs_categories',array('status'=>1))->result();
        $data['pagination']     = $this->pagination->create_links();
        $data['total_rows']     = count($result);

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

	/** Dicover Jobs */
    public function jobs() {
		$page = (int)$this->uri->segment(3);
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
                $offset = ($limit * $page) - $limit;
                $countdata = $this->M_jobs->count_data($limit, $offset);
                $config['base_url'] = site_url('public/jobs'); //site url
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
            $data['jobs_categories'] = $this->db->get_where('pcj_jobs_categories',array('status'=>1))->result();

            config('title', 'Discover Job Page');

            $this->display('discover-job', $data);
    }

    public function jobs_filter() {
		$page = (int)$this->uri->segment(3);
            $data = [
                'title_web' => 'Dashboard',
                'users'     => $this->db->get_where('users')->row(),
				'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
            ];
            $data['CSRF'] = [
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
            $data['jobs_categories'] = $this->db->get_where('pcj_jobs_categories',array('status'=>1))->result();

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

	public function jobs_detail($id)
    {

        $check_business          = $this->db->get_where('pcj_jobs',array('id'=>$id))->row();
        if(empty($check_business)){
            redirect('user/dashboard');
        }
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
        $data["users"] = $this->db->get_where('users')->row();

        config('title', 'Job - ' . $this->M_jobs->detail($id)->row()->data_name);

        $this->display('detail', $data);
    }

}
