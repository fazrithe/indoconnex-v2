<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_front.php';

class News extends Base_front
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
        $this->load->model('M_news');
    }

	/** List News & Events Public */
    public function index()
    {
        if ($this->input->post()) {
           
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module,
                'meta_position' => 1,
				'meta_type' => 'news'
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
			$data['business'] = $this->M_news->search_business($search);
			$data['business_categories']  = $this->M_news->business_category();
			$data['business_types'] = $this->db->get('pbd_business_types')->result();
	
			$data['connections'] = $this->M_news->search_connections($search);
			$data['product_categories']  = $this->M_news->product_category();
			$data['products'] = $this->M_news->search_products($search);
			$data['jobs'] = $this->M_news->search_jobs($search);
			$data['jobs_categories']  = $this->M_news->jobs_category();

			$data['news'] = $this->M_news->news_list();
			$data['search_place'] = 'Search';
			$data['banner']			= $this->db->get_where('pub_page_banners',array('data_position'=>1))->row();
			$data['banner_title']	= "Website Development";
			$data['work']			=  $this->db->get_where('pub_works',array('status'=>1))->result();
			$data["partners"] = $this->db->get_where('pub_partners',array('status'=>1))->result();
			$data["supports"] = $this->db->get_where('pub_supports',array('status'=>1))->result();
			$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
			$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
			$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();

			config('title', 'News & Events');

			$this->display('index', $data);
        }
    }

	/** Detail News & Events Public */
	public function detail($slug){
		$data         = array(
			'apps_title_module' => $this->apps_title_module,
			'meta_position' => $slug,
			'meta_type' => 'page',
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result()
		);
		$data['CSRF'] = [
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash(),
		];
		if(!empty($this->session->userdata('is_login'))){
			$id = $this->session->userdata('user_id');
			$data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
		}
		$data['news'] = $this->M_news->news_detail($slug);
		$data['query'] = $search['query']  = $this->input->get('query');
		$data['country'] = $search['country']  = $this->input->get('country');
		$data['state'] = $search['state']  = $this->input->get('state');
		$data['city'] = $search['city']  = $this->input->get('city');

		$business_categories = $this->input->get('categories');
		$data['business'] = $this->M_news->search_business($search);
		$data['business_categories']  = $this->M_news->business_category();
		$data['business_types'] = $this->db->get('pbd_business_types')->result();

		$data['connections'] = $this->M_news->search_connections($search);
		$data['product_categories']  = $this->M_news->product_category();
		$data['products'] = $this->M_news->search_products($search);
		$data['jobs'] = $this->M_news->search_jobs($search);
		$data['jobs_categories']  = $this->M_news->jobs_category();
		$data['search_place'] = 'Search';
		$data['banner']			= $this->db->get_where('pub_page_banners',array('data_position'=>1))->row();
		$data['banner_title']	= "Website Development";
		$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
		$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
		$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();

		config('title', $this->M_news->news_detail($slug)->data_name);

		$this->display('detail',$data);
	}

}
