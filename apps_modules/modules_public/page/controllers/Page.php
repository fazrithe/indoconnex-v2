<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_front.php';

class Page extends Base_front
{
    protected $module_base                  = 'dahboard';
    protected $apps_title_module            = 'Dashboard';
    private   $_table                       = "users";
    protected $apps_output_message = array(
        'status'  => '',
        'title'   => '',
        'message' => ''
    );
    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        $this->lang->load('output_message');
        $this->load->helper(array('form', 'url','string'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('M_page');
    }

    public function business($title)
    {
		$title_business = preg_replace("/[^a-zA-Z0-9]/", " ", $title);
        if ($this->input->post()) {
           
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module,
                'meta_position' => 1,
				'meta_type' => 'page'
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
            if(!empty($this->session->userdata('is_login'))){
                $id = $this->session->userdata('user_id');
                $data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
            }
			$data['query'] = $search['query']  = $this->input->get('query');
			$data['country'] = $search['country']  = $this->input->get('country');
			$data['state'] = $search['state']  = $this->input->get('state');
			$data['city'] = $search['city']  = $this->input->get('city');
	
			$business_categories = $this->input->get('categories');
			$data['business'] = $this->M_page->search_business($search);
			$data['business_categories']  = $this->M_page->business_category();
			$data['business_types'] = $this->db->get('pbd_business_types')->result();
	
			$data['connections'] = $this->M_page->search_connections($search);
			$data['product_categories']  = $this->M_page->product_category();
			$data['products'] = $this->M_page->search_products($search);
			$data['jobs'] = $this->M_page->search_jobs($search);
			$data['jobs_categories']  = $this->M_page->jobs_category();

			$data['search_place'] = 'Search';
			$widget_id					= $this->M_page->widget($title_business)->row();
			
			$page = (int)$this->uri->segment(4);
			$limit = 18;
			$offset = 0;
			if($page > 0)
			{
				$offset = ($limit * $page) - $limit;
			}
			$countdata = $this->M_page->count_data_widget($widget_id->id);
			$config['base_url'] = site_url('page/business/business-directory'); //site url
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

			config('title', $widget_id->data_name);
			
			$this->pagination->initialize($config);


			// $data['cards']				= $this->db->get_where('pub_widgets',array('status' => 1,'parent' => $widget_id->id))->result();
			$data['cards'] 				= $this->M_page->data_widget($widget_id->id,$limit, $offset);
			$data['pagination']     = $this->pagination->create_links();
			$data['title']				= $widget_id->data_name;
			$data['business']  			= $this->M_page->business_list()->result();
            $data['business_categories']= $this->db->get_where('pbd_business_categories',array('status' => 1))->result();
			$data['business_types']		= $this->db->get_where('pbd_business_types',array('status' => 1))->result();
			$data['work']				= $this->db->get_where('pub_works',array('status'=>1))->result();
			$data["partners"] 			= $this->db->get_where('pub_partners',array('status'=>1))->result();
			$data["supports"] 			= $this->db->get_where('pub_supports',array('status'=>1))->result();
			$data['about_us']		=  $this->db->get_where('pub_profile',array('data_section'=>'section_about'))->row();
			$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
			$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
			$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();
			$this->display('business', $data);
        }
    }

	public function jobs_employee($title)
    {
		$title_jobs = preg_replace("/[^a-zA-Z0-9]/", " ", $title);
        if ($this->input->post()) {
           
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module,
                'meta_position' => 1,
				'meta_type' => 'page'
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
            if(!empty($this->session->userdata('is_login'))){
                $id = $this->session->userdata('user_id');
                $data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
            }
			$data['query'] = $search['query']  = $this->input->get('query');
			$data['country'] = $search['country']  = $this->input->get('country');
			$data['state'] = $search['state']  = $this->input->get('state');
			$data['city'] = $search['city']  = $this->input->get('city');
	
			$business_categories = $this->input->get('categories');
			$data['business'] = $this->M_page->search_business($search);
			$data['business_categories']  = $this->M_page->business_category();
			$data['business_types'] = $this->db->get('pbd_business_types')->result();
	
			$data['connections'] = $this->M_page->search_connections($search);
			$data['product_categories']  = $this->M_page->product_category();
			$data['products'] = $this->M_page->search_products($search);
			$data['jobs'] = $this->M_page->search_jobs($search);
			$data['jobs_categories']  = $this->M_page->jobs_category();

			$data['search_place'] = 'Search';
			$widget_id					= $this->M_page->widget($title_jobs)->row();
			$data['title']				= $widget_id->data_name;
			$data['cards']				= $this->db->get_where('pub_widgets',array('status' => 1,'parent' => $widget_id->id))->result();
			$data['employee']           = $this->M_page->data_jobs_users()->result();
            $data['salary_period']  = $this->db->get_where('pcj_jobs_salary_period',array('status'=>1))->result();
            $data['jobs_type']  = $this->db->get_where('pcj_jobs_types',array('status'=>1))->result();
            $data['jobs_categories'] = $this->db->get_where('pcj_jobs_categories',array('status'=>1))->result();
			$data['job_types']			= $this->db->get_where('pcj_jobs_types',array('status' => 1))->result();
			$data['work']				= $this->db->get_where('pub_works',array('status'=>1))->result();
			$data["partners"] 			= $this->db->get_where('pub_partners',array('status'=>1))->result();
			$data["supports"] 			= $this->db->get_where('pub_supports',array('status'=>1))->result();
			$data['about_us']		=  $this->db->get_where('pub_profile',array('data_section'=>'section_about'))->row();
			$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
			$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
			$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();

			config('title', $widget_id->data_name);

			$this->display('jobs-employee', $data);
        }
    }


	public function jobs()
    {
		$title = "employee-search";
		$title_jobs = preg_replace("/[^a-zA-Z0-9]/", " ", $title);
        if ($this->input->post()) {
           
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module,
                'meta_position' => 1,
				'meta_type' => 'page'
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
            if(!empty($this->session->userdata('is_login'))){
                $id = $this->session->userdata('user_id');
                $data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
            }
			$data['query'] = $search['query']  = $this->input->get('query');
			$data['country'] = $search['country']  = $this->input->get('country');
			$data['state'] = $search['state']  = $this->input->get('state');
			$data['city'] = $search['city']  = $this->input->get('city');
	
			$business_categories = $this->input->get('categories');
			$data['business'] = $this->M_page->search_business($search);
			$data['business_categories']  = $this->M_page->business_category();
			$data['business_types'] = $this->db->get('pbd_business_types')->result();
	
			$data['connections'] = $this->M_page->search_connections($search);
			$data['product_categories']  = $this->M_page->product_category();
			$data['products'] = $this->M_page->search_products($search);
			$data['jobs'] = $this->M_page->search_jobs($search);
			$data['jobs_categories']  = $this->M_page->jobs_category();

			$data['search_place'] = 'Search';
			$widget_id					= $this->M_page->widget($title_jobs)->row();
			$data['title']				= $widget_id->data_name;
			$data['cards']				= $this->db->get_where('pub_widgets',array('status' => 1,'parent' => $widget_id->id))->result();
			$data['jobs']           = $this->M_page->data_jobs()->result();
            $data['salary_period']  = $this->db->get_where('pcj_jobs_salary_period',array('status'=>1))->result();
            $data['jobs_type']  = $this->db->get_where('pcj_jobs_types',array('status'=>1))->result();
            $data['jobs_categories'] = $this->db->get_where('pcj_jobs_categories',array('status'=>1))->result();
			$data['job_types']			= $this->db->get_where('pcj_jobs_types',array('status' => 1))->result();
			$data['work']				= $this->db->get_where('pub_works',array('status'=>1))->result();
			$data["partners"] 			= $this->db->get_where('pub_partners',array('status'=>1))->result();
			$data["supports"] 			= $this->db->get_where('pub_supports',array('status'=>1))->result();
			$data['about_us']		=  $this->db->get_where('pub_profile',array('data_section'=>'section_about'))->row();
			$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
			$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
			$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();

			config('title', $widget_id->data_name);

			$this->display('jobs', $data);
        }
    }

	public function page($title)
    {
		$title_jobs = preg_replace("/[^a-zA-Z0-9]/", " ", $title);
        if ($this->input->post()) {
           
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module,
                'meta_position' => 1,
				'meta_type' => 'page'
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
            if(!empty($this->session->userdata('is_login'))){
                $id = $this->session->userdata('user_id');
                $data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
            }
			$data['query'] = $search['query']  = $this->input->get('query');
			$data['country'] = $search['country']  = $this->input->get('country');
			$data['state'] = $search['state']  = $this->input->get('state');
			$data['city'] = $search['city']  = $this->input->get('city');
	
			$business_categories = $this->input->get('categories');
			$data['business'] = $this->M_page->search_business($search);
			$data['business_categories']  = $this->M_page->business_category();
			$data['business_types'] = $this->db->get('pbd_business_types')->result();
	
			$data['connections'] = $this->M_page->search_connections($search);
			$data['product_categories']  = $this->M_page->product_category();
			$data['products'] = $this->M_page->search_products($search);
			$data['jobs'] = $this->M_page->search_jobs($search);
			$data['jobs_categories']  = $this->M_page->jobs_category();

			$data['search_place'] = 'Search';
			$widget_id					= $this->M_page->widget($title_jobs)->row();
			$data['title']				= $widget_id->data_name;
			$data['cards']				= $this->db->get_where('pub_widgets',array('status' => 1,'parent' => $widget_id->id))->result();
			$data['work']				= $this->db->get_where('pub_works',array('status'=>1))->result();
			$data["partners"] 			= $this->db->get_where('pub_partners',array('status'=>1))->result();
			$data["supports"] 			= $this->db->get_where('pub_supports',array('status'=>1))->result();
			$data['about_us']			= $this->db->get_where('pub_profile',array('data_section'=>'section_about'))->row();
			$data['industries']			= $this->db->get_where('pcj_jobs_industries',array('status'=>1))->result();
			$business_cat    			= $this->M_page->business_cat($title_jobs)->row();
			$val_business 				= $this->M_page->data_business()->result();
			$article_cat			= $this->M_page->article_cat($title_jobs)->row();
			if(!empty($business_cat)){
			$result = array();
				foreach($val_business as $val){
					if(!empty($val->data_categories)){
						foreach(json_decode($val->data_categories) as $val_categories){
							if($val_categories == $business_cat->id){
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
			}else{
				$result       = null;
			}
			if($result != null){
			$data['business']       = array_slice($result,0,6);
			}else{
				$data['business']       = null;
			}
			$data["categories_article"]         = $this->M_page->article_cat($title_jobs)->row();
			if(!empty($business_cat)){
				$data['articles'] 		= $this->M_page->data_article($article_cat->id);
			}else{
				$data['articles'] 		= '';
			}
			$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
			$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
			$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();

			config('title', $widget_id->data_name);

			$this->display('personal', $data);
        }
    }

	public function personal($title)
    {
		$title_jobs = preg_replace("/[^a-zA-Z0-9]/", " ", $title);
		
        if ($this->input->post()) {
           
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module,
                'meta_position' => 1,
				'meta_type' => 'page'
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
            if(!empty($this->session->userdata('is_login'))){
                $id = $this->session->userdata('user_id');
                $data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
            }
			$data['query'] = $search['query']  = $this->input->get('query');
			$data['country'] = $search['country']  = $this->input->get('country');
			$data['state'] = $search['state']  = $this->input->get('state');
			$data['city'] = $search['city']  = $this->input->get('city');
	
			$business_categories = $this->input->get('categories');
			$data['business'] = $this->M_page->search_business($search);
			$data['business_categories']  = $this->M_page->business_category();
			$data['business_types'] = $this->db->get('pbd_business_types')->result();
	
			$data['connections'] = $this->M_page->search_connections($search);
			$data['product_categories']  = $this->M_page->product_category();
			$data['products'] = $this->M_page->search_products($search);
			$data['jobs'] = $this->M_page->search_jobs($search);
			$data['jobs_categories']  = $this->M_page->jobs_category();

			$data['search_place'] = 'Search';
			$widget_id					= $this->M_page->widget($title)->row();
			
			$data['title']				= $widget_id->data_name;
			$data['widget']				= $this->M_page->widget($title)->row();
			
			$data['cards']				= $this->db->get_where('pub_widgets',array('status' => 1,'parent' => $widget_id->id))->result();
			$data['work']				= $this->db->get_where('pub_works',array('status'=>1))->result();
			$data["partners"] 			= $this->db->get_where('pub_partners',array('status'=>1))->result();
			$data["supports"] 			= $this->db->get_where('pub_supports',array('status'=>1))->result();
			$data['about_us']			= $this->db->get_where('pub_profile',array('data_section'=>'section_about'))->row();
			$data['industries']			= $this->db->get_where('pcj_jobs_industries',array('status'=>1))->result();
			$business_categories    	= $this->M_page->business_cat($data['widget']->data_name)->row();
			$data['business_categories_all'] = $this->M_page->business_cat_all($data['widget']->data_name)->row();
			$data['article_categories_all'] = $this->M_page->article_cat($data['widget']->data_name)->row();
			$article_cat			    = $this->M_page->article_cat($widget_id->data_name)->row();
			if(!empty($business_categories->id) or !empty($widget_id->data_name) or !empty($article_cat->id)){
				
			if(!empty($business_categories->id)){
			$val_business 				= $this->M_page->data_business($business_categories->id)->result();
			}
			$article_cat			    = $this->M_page->article_cat($widget_id->data_name)->row();
			if(!empty($business_categories)){
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
							

							// if($val_categories == $business_cat->id){
							// $result[] = array(
							// 'id' => $val->id,
							// 'data_name' => $val->data_name,
							// 'data_username'  => $val->data_username,
							// 'data_types' => $val->data_types,
							// 'data_categories' => $val->data_categories,
							// 'data_locations' => $val->data_locations,
							// 'data_name' => $val->data_name,
							// 'file_path' => $val->file_path,
							// 'file_name_original' => $val->file_name_original,
							// );
							// }
				}
			}else{
				$result       = null;
			}
			if(empty($result)){
				$data['business']       = null;
			}else{
				$data['business']       = array_slice($result,0,6);
			}
			if(empty($data['business'])){
				redirect(base_url('/'));
			}
			$data["categories_article"]         = $this->M_page->article_cat($title_jobs)->row();
			
			if(!empty($article_cat)){
				$data['articles'] 		= $this->M_page->data_article($article_cat->id);
			}else{
				$data['articles'] 		= '';
			}
			$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
			$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
			$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();

			config('title', $widget_id->data_name);

			$this->display('personal', $data);
			}else{
				redirect(base_url('/'));
			}
        }
    }


}
