<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Community extends Base_users
{
    protected $module_base                  = 'market/list';
    protected $apps_title_module            = 'profile';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation','pagination');
        $this->load->model('M_community');
        if(!empty($this->session->userdata('is_login') == FALSE)){
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }
    }

	/** List Community */
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

        $countdata = $this->M_community->count_data_user($user_id);
        $config['base_url'] = site_url('market/list'); //site url
        $config['total_rows'] = $this->M_community->count_data_user($user_id);
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

        $data['communities_list']         = $this->M_community->data($user_id,$limit,$offset);
        $data['pagination']         = $this->pagination->create_links();
        $data['total_rows']         = $countdata;
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        config('title', 'My Community');
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

        $countdata = $this->M_community->count_data_filter($id);
        $config['base_url'] = site_url('market/list_filter'); //site url
        $config['total_rows'] = $this->M_community->count_data_filter($id);
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

        $data['items_list']         = $this->M_community->data_filter($id,$limit,$offset);
        $data["item_categories"]    = $this->db->get_where('pbd_items_categories', array('status'=>1))->result();
        $data["item_labels"]        = $this->db->get_where('pbd_items_labels', array('status'=>1))->result();
        $data["countries"]          = $this->db->get('loc_countries')->result();
        $data["product_all"]        = $this->db->get_where('pbd_items',array('pbd_business_id'=>$id))->result();
        $data['pagination']         = $this->pagination->create_links();
        $data['total_rows']         = $countdata;
        $data['filter_id']          = $id;
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        config('title', 'My Community');
        $this->display('list', $data);
    }

	/** Create Community -> Store */
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
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        $data["categories"]         = $this->db->get_where('pcs_communities_categories',array('status'=>1))->result();
        config('title', 'Create Community');
        $this->display('create', $data);
    }

    public function store($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/market/create/';
        $this->action_store_community($parameter_url_source, $parameter_id);
    }

	/** Update Community */
    public function update($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/market/create/';
        $this->action_update_community($parameter_url_source, $parameter_id);
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

	/** Discover Community */
    public function discover() {
        $user_id     = $_SESSION['user_id'];
        $name       = $this->input->post('community-name');
        $category    = $this->input->post('community-category');
        $privacy   = $this->input->post('community-privacy');

		$page = (int)$this->uri->segment(3);
        if($name ||  $category || $privacy){
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
            $countdata = $this->M_community->count_data();
            $config['base_url'] = site_url('community/discover'); //site url
            $config['total_rows'] = $this->M_community->count_data();
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
			$result1 = array();
			$data_filter = $result1[] = array(
				'name'   => $name,
				'category' => $category,
				'privacy'	=> $privacy
			);
			
			$data['data_filter']    =  $data_filter;
            $data['communities']    = $this->M_community->show_search($name,$category,$privacy,$limit,$offset);
			$this->db->order_by('data_name', 'ASC');
			$query_category = $this->db->get_where('pcs_communities_categories',array('status'=>1));
            $data["categories"]    = $query_category->result();
			$data['pagination']     = $this->pagination->create_links();
            $data['total_rows']     = $countdata;
            config('title', 'Discover Community');
            if ($category || $privacy) {
                if ($privacy == 1) {
                    $privacy = 'Service';
                } else {
                    $privacy = 'Public';
                }
			    $community_category = $this->M_community->getCommunityCategoryName($category);
			    config('title', 'Discover Community' . ' - ' . $community_category . ' - ' . $privacy);
            }
            $this->display('discover', $data);
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
            $countdata = $this->M_community->count_data();
            $config['base_url'] = site_url('community/discover'); //site url
            $config['total_rows'] = $this->M_community->count_data();
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
			$data_filter = $result1[] = array(
				'name'   => $name,
				'category' => $category,
				'privacy'	=> $privacy
			);
			
			$data['data_filter']    =  $data_filter;
            $data['communities']    = $this->M_community->show_all($limit,$offset);
            $this->db->order_by('data_name', 'ASC');
			$query_category = $this->db->get_where('pcs_communities_categories',array('status'=>1));
            $data["categories"]    = $query_category->result();
            $data['pagination']     = $this->pagination->create_links();
            $data['total_rows']     = $countdata;
            config('title', 'Discover Community');
            $this->display('discover', $data);
        }
    }

	/** Manage Community */
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

        $countdata = $this->M_community->count_data_user($user_id);
        $config['base_url'] = site_url('market/list'); //site url
        $config['total_rows'] = $this->M_community->count_data_user($user_id);
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
        $data['communities']         = $this->M_community->data_community($user_id,$limit,$offset);
        $data['com_categories']     = $this->db->get('pcs_communities_categories')->result();
        $data['pagination']         = $this->pagination->create_links();
        $data['total_rows']         = $countdata;
        config('title', 'Manage Community');
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

        $countdata = $this->M_community->count_data_user_filter($id);
        $config['base_url'] = site_url('market/list'); //site url
        $config['total_rows'] = $this->M_community->count_data_user_filter($id);
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
        $data['items_list_product']         = $this->M_community->data_product_filter($id,$limit,$offset);
        $data['items_list_service']         = $this->M_community->data_service_filter($id,$limit,$offset);
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
        config('title', 'Manage Community');
        $this->display('manage', $data);
    }

    public function show($id) {
        $item = $this->db->from('pbd_items')
            ->where('id', $id)->get();
        $temp = $item->row();
        $seller = [

        ];
        if (!empty($temp->pbd_business_id) && empty($temp->users_id)) {
            $seller =  $this->db->select('username')->get_where('pbd_business',array('id'=>$temp->pbd_business_id))->row();
        } else if(!empty($temp->users_id)) {
            $seller =  $this->db->select('username')->get_where('users',array('id'=>$temp->users_id))->row();
        }

        $category = $this->db->from('pbd_items_categories')
            ->where_in('id', json_decode($temp->data_categories))->get();
        $image = 'public/themes/user/images/placehold/product-4x3.png';
        // echo $temp->file_name_original;
        // exit;
        if (!empty($temp->file_name_original)) {
            $image = $temp->file_path . $temp->file_name_original;
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

	/** Delete Community */
    public function delete()
    {
        $items_id   = $this->input->post('community-id');
        $this->db->where('pcs_communities.id',$items_id);
        $this->db->delete('pcs_communities');
        redirect(base_url('community/manage'));
    }

    function categories_all()
    {
        $q = $this->input->get('q');
        echo json_encode($this->M_community->getCategory($q));
    }

}
