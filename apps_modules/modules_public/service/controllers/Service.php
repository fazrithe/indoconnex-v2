<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_front.php';

class Service extends Base_front
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
        $this->load->model('M_service');
    }

	/** Product & Service Public */
    public function index($title)
    {
		$title_service = preg_replace("/[^a-zA-Z0-9]/", " ", $title);
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
			$data['search_place'] 	= 'Search';
			
			$data['query'] = $search['query']  = $this->input->get('query');
			$data['country'] = $search['country']  = $this->input->get('country');
			$data['state'] = $search['state']  = $this->input->get('state');
			$data['city'] = $search['city']  = $this->input->get('city');
			$data['service_name']	= $title_service;
			$data['about_us']		=  $this->db->get_where('pub_profile',array('data_section'=>'section_about'))->row();
			$data['banner']			= $this->db->get_where('pub_page_banners',array('data_position'=>2))->row();
			$data['banner_title']	= "Website Development";
			$data["partners"] = $this->db->get_where('pub_partners',array('status'=>1))->result();
			$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
			$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
			$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();
			if($title_service == 'Indoconnex Website'){
                config('title', 'Indoconnex Websites');
				$this->display('index', $data);
			}else if($title_service == 'UI UX Design'){
                config('title', 'UI/UX Design');
				$this->display('ui_ux', $data);
            }else if($title_service == 'Graphic Design'){
                config('title', 'Graphic Design');
				$this->display('graphic_design', $data);
			}else if($title_service == 'Software Development Outsourcing'){
                config('title', 'Graphic Design');
				$this->display('software_development', $data);
            }else{
                config('title', 'Coming Soon');
				$this->display('under', $data);
			}
        }
    }

}
