<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Connections extends Base_users
{
    protected $module_base                  = 'market/list';
    protected $apps_title_module            = 'profile';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation','pagination');
        $this->load->model('M_connection');
        if(!empty($this->session->userdata('is_login') == FALSE)){
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }
    }

	/** List Connections */
    public function list()
    {
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
        $page = (int)$this->uri->segment(3);
        $limit = 6;
		$offset = 0;
        if($page > 0)
			$offset = ($limit * $page) - $limit;
            $countdata = $this->M_connection->count_data_following($user_id);
            $config['base_url'] = site_url('connections/list'); //site url
            $config['total_rows'] = $this->M_connection->count_data_following($user_id);
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
            $config['first_tag_open']   = '<li class="page-item">';
            $config['first_tagl_close'] = '</li>';
            $config['last_tag_open']    = '<li class="page-item">';
            $config['last_tagl_close']  = '</li>';

		$friends = [];
        $result =  $this->db->select('user_follow_id')->get_where('users_follows', array('user_id' => $user_id))->result();
		foreach ($result as $key) {
			$friends[] = $key->user_follow_id;
		}
        $data['friends'] = $friends;
        $data["following"] = $this->M_connection->show_following($user_id,$limit, $offset)->result();
        $data['following_business'] = $this->M_connection->show_following_business($user_id,$limit,$offset)->result();
        $data["followers"] = $this->M_connection->show_followers($user_id,$limit, $offset)->result();
       
        $data['users_follows'] = $this->db->get_where('users',array('username !=' => NULL))->num_rows();
        $data['pagination']     = $this->pagination->create_links();
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        config('title', 'My Connection');
        $this->display('list', $data);
    }

    public function list_filter($id)
    {
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
		$friends = [];
        $result =  $this->db->select('user_follow_id')->get_where('users_follows', array('user_id' => $user_id))->result();
		foreach ($result as $key) {
			$friends[] = $key->user_follow_id;
		}
        $data['friends'] = $friends;
        $data["followers"] = $this->M_connection->show_followers_business($id)->result();
        // echo json_encode($data["followers"]);
        // exit;
        $data['filter_id']  = $id;
        $data['users_follows'] = $this->db->get_where('users',array('username !=' => NULL))->num_rows();
        $data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        config('title', 'My Connection');
        $this->display('list_filter', $data);
    }

	/** Invote Connections */
    public function invite()
    {
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
        $data['connections'] = $this->db->get('users')->result();
        $data['users_follows'] = $this->db->get_where('users',array('username !=' => NULL))->num_rows();
        config('title', 'Invite Friends');
        $this->display('invite', $data);
    }

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
        $data["categories"]         = $this->db->get_where('pbd_items_categories',array('status'=>1))->result();
        $this->display('create', $data);
    }


    public function discover() {
        $user_id     = $_SESSION['user_id'];
        // $name        = $this->input->post('name');
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
            // $page = (int)$this->uri->segment(3);
            $countdata = $this->M_connection->count_data();
            // $config['base_url'] = site_url('connections/discover');
            // $config['total_rows'] = $this->M_connection->count_data();
            // $config['per_page'] = 8;
            // $config["uri_segment"] = 3;
            // $config['use_page_numbers'] = true;
            // $config['first_link']       = 'First';
            // $config['last_link']        = 'Last';
            // $config['next_link']        = 'Next';
            // $config['prev_link']        = 'Prev';
			// $config['attributes'] = ['class' => 'page-link'];
            // $config['full_tag_open']    = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
            // $config['full_tag_close']   = '</ul></nav></div>';
            // $config['num_tag_open']     = '<li class="page-item">';
            // $config['num_tag_close']    = '</li>';
            // $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            // $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
            // $config['next_tag_open']    = '<li class="page-item neighbour">';
            // $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
            // $config['prev_tag_open']    = '<li class="page-item neighbour">';
            // $config['prev_tagl_close']  = 'Next</li>';
            // $config['first_tag_open']   = '<li class="page-item neighbour">';
            // $config['first_tagl_close'] = '</li>';
            // $config['last_tag_open']    = '<li class="page-item neighbour">';
            // $config['last_tagl_close']  = '</li>';
            // $page1 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            // $this->pagination->initialize($config);
            // $data['pagination']     = $this->pagination->create_links();
            // $data['connections'] = $this->M_connection->data($config["per_page"], $page);

            $data['connections'] = $this->M_connection->get_people();

            // $countdata2 = $this->M_connection->count_data_business();
            // $config2["link1"]['base_url'] = site_url('connections/discover/business'); //site url
            // $config2["link1"]['total_rows'] = $this->M_connection->count_data_business();
            // $config2["link1"]['per_page'] = 6;
            // $config2["link1"]["uri_segment"] = 4;
            // $config2["link1"]['use_page_numbers'] = true;
            // $config2["link1"]['first_link']       = 'First';
            // $config2["link1"]['last_link']        = 'Last';
            // $config2["link1"]['next_link']        = 'Next';
            // $config2["link1"]['prev_link']        = 'Prev';
			// $config2["link1"]['attributes'] = ['class' => 'page-link'];
            // $config2["link1"]['full_tag_open']    = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
            // $config2["link1"]['full_tag_close']   = '</ul></nav></div>';
            // $config2["link1"]['num_tag_open']     = '<li class="page-item">';
            // $config2["link1"]['num_tag_close']    = '</li>';
            // $config2["link1"]['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            // $config2["link1"]['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
            // $config2["link1"]['next_tag_open']    = '<li class="page-item neighbour">';
            // $config2["link1"]['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
            // $config2["link1"]['prev_tag_open']    = '<li class="page-item neighbour">';
            // $config2["link1"]['prev_tagl_close']  = 'Next</li>';
            // $config2["link1"]['first_tag_open']   = '<li class="page-item neighbour">';
            // $config2["link1"]['first_tagl_close'] = '</li>';
            // $config2["link1"]['last_tag_open']    = '<li class="page-item neighbour">';
            // $config2["link1"]['last_tagl_close']  = '</li>';
            // $page2 = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            // $pagination2=new CI_Pagination();
            // $pagination2->initialize($config2['link1']);
            // $data['pagination2']     = $pagination2->create_links();
            // $data['connections2'] = $this->M_connection->data_business($config2["link1"]["per_page"], $page2);
            $data['connections2'] = $this->M_connection->get_pages();
        
        $user = $this->db->get_where('users',array('id'=>$user_id))->row();

        $userWorkplaces = json_decode($user->data_exp_work, true);
        $userEducations = json_decode($user->data_education, true);
        $userCommunities = $this->M_connection->get_current_user_community_ids()->result();

        $suggestions_by_workplace = array();
        $suggestions_by_education = array();
        $suggestions_by_community = array();

        $suggests  = $this->M_connection->data_sugest();

        foreach ($userWorkplaces as $userWorkplace) {
            foreach ($suggests as $suggest) {
                if (!empty($suggest->data_exp_work)) {
                    $works = json_decode($suggest->data_exp_work, true);
                    foreach ($works as $work) {
                        if ($work['company_id'] == $userWorkplace['company_id']) {
                            $suggestions_by_workplace[] = array(
                                'id' => $suggest->id,
                                'username' => $suggest->username,
                                'name_first' => $suggest->name_first,
                                'name_middle' => $suggest->name_middle,
                                'name_last' => $suggest->name_last,
                                'file_path' => $suggest->file_path,
                                'file_name_original' => $suggest->file_name_original,
                            );
                        }
                    }
                }
            }
        }

        foreach ($userEducations as $userEducation) {
            foreach ($suggests as $suggest) {
                if (!empty($suggest->data_education)) {
                    $educations = json_decode($suggest->data_education, true);
                    foreach ($educations as $education) {
                        if ($education['education_id'] == $userEducation['education_id']) {
                            $suggestions_by_education[] = array(
                                'id' => $suggest->id,
                                'username' => $suggest->username,
                                'name_first' => $suggest->name_first,
                                'name_middle' => $suggest->name_middle,
                                'name_last' => $suggest->name_last,
                                'file_path' => $suggest->file_path,
                                'file_name_original' => $suggest->file_name_original,
                            );
                        }
                    }
                }
            }
        }

        foreach ($userCommunities as $userCommunity) {
            foreach ($suggests as $suggest) {
                $user_community_ids = $this->M_connection->get_community_ids_by_user_id($suggest->id);
                if ($user_community_ids->result()) {
                    foreach ($user_community_ids->result() as $user_community_id) {
                        if ($user_community_id->pcs_communities_id == $userCommunity->pcs_communities_id) {
                            $suggestions_by_community[] = array(
                                'id' => $suggest->id,
                                'username' => $suggest->username,
                                'name_first' => $suggest->name_first,
                                'name_middle' => $suggest->name_middle,
                                'name_last' => $suggest->name_last,
                                'file_path' => $suggest->file_path,
                                'file_name_original' => $suggest->file_name_original,
                            );
                        }
                    }
                }
            }
        }

        $data['suggestions_by_workplace'] =  array_slice($suggestions_by_workplace, 0, 11);
        $data['suggestions_by_education'] =  array_slice($suggestions_by_education, 0, 11);
        $data['suggestions_by_community'] =  array_slice(array_unique($suggestions_by_community, SORT_REGULAR), 0, 11);
        
        $data['users_follows'] = $this->db->get_where('users',array('username !=' => NULL))->num_rows();
		$all_following =  $this->db->select('user_follow_id')->get_where('users_follows', array('user_id' => $user_id))->result();
        $data['total_rows']     = $countdata;
		$followings = [];
		foreach ($all_following as $following) {
			$followings[] = $following->user_follow_id;
		}
        $data['followings'] = $followings;
        config('title', 'Discover Connection');
        $this->display('discover', $data);
    }

    // public function discover_filter() {
    //     $user_id     = $_SESSION['user_id'];
    //     $name        = $this->input->post('name');
    //     $data = [
    //         'title_web' => 'Dashboard',
    //         'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
	// 		'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
    //     ];
    //     $data['CSRF'] = [
    //         'id' => $user_id,
    //         'name' => $this->security->get_csrf_token_name(),
    //         'hash' => $this->security->get_csrf_hash(),
    //     ];
    //         $page = (int)$this->uri->segment(4);
    //         $countdata = $this->M_connection->count_data_filter($name);
    //         $config['base_url'] = site_url('connections/discover/filter'); //site url
    //         $config['total_rows'] = $this->M_connection->count_data_filter($name);
    //         $config['per_page'] = 6;
    //         $config["uri_segment"] = 4;
    //         $config['use_page_numbers'] = true;
    //         $config['first_link']       = 'First';
    //         $config['last_link']        = 'Last';
    //         $config['next_link']        = 'Next';
    //         $config['prev_link']        = 'Prev';
	// 		$config['attributes'] = ['class' => 'page-link'];
    //         $config['full_tag_open']    = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
    //         $config['full_tag_close']   = '</ul></nav></div>';
    //         $config['num_tag_open']     = '<li class="page-item">';
    //         $config['num_tag_close']    = '</li>';
    //         $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    //         $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
    //         $config['next_tag_open']    = '<li class="page-item neighbour">';
    //         $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
    //         $config['prev_tag_open']    = '<li class="page-item neighbour">';
    //         $config['prev_tagl_close']  = 'Next</li>';
    //         $config['first_tag_open']   = '<li class="page-item neighbour">';
    //         $config['first_tagl_close'] = '</li>';
    //         $config['last_tag_open']    = '<li class="page-item neighbour">';
    //         $config['last_tagl_close']  = '</li>';
    //         $page1 = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    //         $this->pagination->initialize($config);
    //         $data['pagination']     = $this->pagination->create_links();
    //         $data['connections'] = $this->M_connection->data_filter($name,$config["per_page"], $page);
            
    //         $countdata2 = $this->M_connection->count_data_filter_business($name);
    //         $config2["link1"]['base_url'] = site_url('connections/discover/business'); //site url
    //         $config2["link1"]['total_rows'] = $this->M_connection->count_data_filter_business($name);
    //         $config2["link1"]['per_page'] = 6;
    //         $config2["link1"]["uri_segment"] = 5;
    //         $config2["link1"]['use_page_numbers'] = true;
    //         $config2["link1"]['first_link']       = 'First';
    //         $config2["link1"]['last_link']        = 'Last';
    //         $config2["link1"]['next_link']        = 'Next';
    //         $config2["link1"]['prev_link']        = 'Prev';
	// 		$config2["link1"]['attributes'] = ['class' => 'page-link'];
    //         $config2["link1"]['full_tag_open']    = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
    //         $config2["link1"]['full_tag_close']   = '</ul></nav></div>';
    //         $config2["link1"]['num_tag_open']     = '<li class="page-item">';
    //         $config2["link1"]['num_tag_close']    = '</li>';
    //         $config2["link1"]['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    //         $config2["link1"]['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
    //         $config2["link1"]['next_tag_open']    = '<li class="page-item neighbour">';
    //         $config2["link1"]['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
    //         $config2["link1"]['prev_tag_open']    = '<li class="page-item neighbour">';
    //         $config2["link1"]['prev_tagl_close']  = 'Next</li>';
    //         $config2["link1"]['first_tag_open']   = '<li class="page-item neighbour">';
    //         $config2["link1"]['first_tagl_close'] = '</li>';
    //         $config2["link1"]['last_tag_open']    = '<li class="page-item neighbour">';
    //         $config2["link1"]['last_tagl_close']  = '</li>';
    //         $page2 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
    //         $pagination2=new CI_Pagination();
    //         $pagination2->initialize($config2['link1']);
    //         $data['pagination2']     = $pagination2->create_links();
    //         $data['connections2'] = $this->M_connection->data_filter_business($name,$config2["link1"]["per_page"], $page2);
        
	// 		$result1 = array();
	// 		$data_filter = $result1[] = array(
	// 			'name'   => $name
	// 		);
			
	// 	$data['data_filter']    =  $data_filter;
    //     $data['users_follows'] = $this->db->get_where('users',array('username !=' => NULL))->num_rows();
	// 	$result =  $this->db->select('user_follow_id')->get_where('users_follows', array('user_id' => $user_id))->result();
    //     $data['total_rows']     = $countdata;
	// 	$friends = [];
	// 	foreach ($result as $key) {
	// 		$friends[] = $key->user_follow_id;
	// 	}
    //     $data['friends'] = $friends;
    //     config('title', 'Discover Connection');
    //     $this->display('discover-filter', $data);
    // }

    public function discover_people()
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

        $page = (int) $this->uri->segment(4);

        $limit = 10;
		$offset = 0;

		if ($page > 0) {
			$offset = ($limit * $page) - $limit;
		}

         $config['base_url'] = site_url('connections/discover/people');
         $config['total_rows'] = $this->M_connection->count_data();
         $config['per_page'] = $limit;
         $config['use_page_numbers'] = true;
         $config['first_link'] = 'First';
         $config['last_link'] = 'Last';
         $config['next_link'] = 'Next';
         $config['prev_link'] = 'Prev';
         $config['attributes'] = ['class' => 'page-link'];
         $config['full_tag_open'] = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
         $config['full_tag_close'] = '</ul></nav></div>';
         $config['num_tag_open'] = '<li class="page-item">';
         $config['num_tag_close'] = '</li>';
         $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
         $config['cur_tag_close'] = '<span class="sr-only"></span></span></li>';
         $config['next_tag_open'] = '<li class="page-item neighbour">';
         $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></li>';
         $config['prev_tag_open'] = '<li class="page-item neighbour">';
         $config['prev_tagl_close'] = 'Next</li>';
         $config['first_tag_open'] = '<li class="page-item neighbour">';
         $config['first_tagl_close'] = '</li>';
         $config['last_tag_open'] = '<li class="page-item neighbour">';
         $config['last_tagl_close'] = '</li>';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['peoples'] = $this->M_connection->get_all_people($limit, $offset);

        $all_following =  $this->db->select('user_follow_id')->get_where('users_follows', array('user_id' => $user_id))->result();

        $followings = [];

        foreach ($all_following as $following) {
            $followings[] = $following->user_follow_id;
        }

        $data['followings'] = $followings;
        $data['total_people'] = $this->M_connection->count_data();

        config('title', 'Discover Connection People');
        $this->display('discover_people', $data);
    }

    public function discover_filter_people()
    {
        $user_id = $_SESSION['user_id'];

        $people_name = trim($this->input->get('people-name'));

        if (! $people_name) {
            redirect('connections/discover/people');
        }

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

        $page = (int) $this->uri->segment(5);

        $limit = 10;
		$offset = 0;

		if ($page > 0) {
			$offset = ($limit * $page) - $limit;
		}

        $config['base_url'] = site_url('connections/discover/people/filter');
        if (count($this->input->get()) > 0) {
            $config['suffix'] = '?' . http_build_query($this->input->get(), '', "&");
        }
        if (count($this->input->get()) > 0) {
            $config['first_url'] = $config['base_url'].'/1?'.http_build_query($this->input->get());
        }
        $config['total_rows'] = $this->M_connection->filter_people_count($people_name);
        $config['per_page'] = $limit;
        $config['use_page_numbers'] = true;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['attributes'] = ['class' => 'page-link'];
        $config['full_tag_open'] = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only"></span></span></li>';
        $config['next_tag_open'] = '<li class="page-item neighbour">';
        $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></li>';
        $config['prev_tag_open'] = '<li class="page-item neighbour">';
        $config['prev_tagl_close'] = 'Next</li>';
        $config['first_tag_open'] = '<li class="page-item neighbour">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item neighbour">';
        $config['last_tagl_close'] = '</li>';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['peoples'] = $this->M_connection->filter_people($people_name, $limit, $offset);

        $all_following =  $this->db->select('user_follow_id')->get_where('users_follows', array('user_id' => $user_id))->result();

        $followings = [];

        foreach ($all_following as $following) {
            $followings[] = $following->user_follow_id;
        }

        $data['followings'] = $followings;
        $data['people_name'] = $people_name;
        $data['total_people'] = $this->M_connection->filter_people_count($people_name);

        config('title', 'Discover Connection People Filter');
        $this->display('discover_filter_people', $data);
    }

    public function discover_pages()
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

        $page = (int) $this->uri->segment(4);

        $limit = 10;
		$offset = 0;

		if ($page > 0) {
			$offset = ($limit * $page) - $limit;
		}

         $config['base_url'] = site_url('connections/discover/pages');
         $config['total_rows'] = $this->M_connection->count_data_business();
         $config['per_page'] = $limit;
         $config['use_page_numbers'] = true;
         $config['first_link'] = 'First';
         $config['last_link'] = 'Last';
         $config['next_link'] = 'Next';
         $config['prev_link'] = 'Prev';
         $config['attributes'] = ['class' => 'page-link'];
         $config['full_tag_open'] = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
         $config['full_tag_close'] = '</ul></nav></div>';
         $config['num_tag_open'] = '<li class="page-item">';
         $config['num_tag_close'] = '</li>';
         $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
         $config['cur_tag_close'] = '<span class="sr-only"></span></span></li>';
         $config['next_tag_open'] = '<li class="page-item neighbour">';
         $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></li>';
         $config['prev_tag_open'] = '<li class="page-item neighbour">';
         $config['prev_tagl_close'] = 'Next</li>';
         $config['first_tag_open'] = '<li class="page-item neighbour">';
         $config['first_tagl_close'] = '</li>';
         $config['last_tag_open'] = '<li class="page-item neighbour">';
         $config['last_tagl_close'] = '</li>';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['pages'] = $this->M_connection->get_all_pages($limit, $offset);

        $all_following =  $this->db->select('user_follow_id')->get_where('users_follows', array('user_id' => $user_id))->result();

        $followings = [];

        foreach ($all_following as $following) {
            $followings[] = $following->user_follow_id;
        }

        $data['followings'] = $followings;
        $data['total_pages'] = $this->M_connection->count_data_business();

        config('title', 'Discover Connection Pages');
        $this->display('discover_pages', $data);
    }

    public function discover_filter_pages()
    {
        $user_id = $_SESSION['user_id'];

        $pages_name = trim($this->input->get('pages-name'));

        if (! $pages_name) {
            redirect('connections/discover/pages');
        }

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

        $page = (int) $this->uri->segment(5);

        $limit = 10;
		$offset = 0;

		if ($page > 0) {
			$offset = ($limit * $page) - $limit;
		}

        $config['base_url'] = site_url('connections/discover/pages/filter');
        if (count($this->input->get()) > 0) {
        $config['suffix'] = '?' . http_build_query($this->input->get(), '', "&");
        }
        if (count($this->input->get()) > 0) {
            $config['first_url'] = $config['base_url'].'/1?'.http_build_query($this->input->get());
        }
        $config['total_rows'] = $this->M_connection->filter_pages_count($pages_name);
        $config['per_page'] = $limit;
        $config['use_page_numbers'] = true;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['attributes'] = ['class' => 'page-link'];
        $config['full_tag_open'] = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only"></span></span></li>';
        $config['next_tag_open'] = '<li class="page-item neighbour">';
        $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></li>';
        $config['prev_tag_open'] = '<li class="page-item neighbour">';
        $config['prev_tagl_close'] = 'Next</li>';
        $config['first_tag_open'] = '<li class="page-item neighbour">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item neighbour">';
        $config['last_tagl_close'] = '</li>';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['pages_name'] = $pages_name;
        $data['pages'] = $this->M_connection->filter_pages($pages_name, $limit, $offset);

        $all_following =  $this->db->select('user_follow_id')->get_where('users_follows', array('user_id' => $user_id))->result();

        $followings = [];

        foreach ($all_following as $following) {
            $followings[] = $following->user_follow_id;
        }

        $data['followings'] = $followings;
        $data['total_pages'] = $this->M_connection->filter_pages_count($pages_name);

        config('title', 'Discover Connection Filter Pages');
        $this->display('discover_filter_pages', $data);
    }

	/** Follow Connections */
    public function follow()
    {
        $follow_id = $this->input->post('follow_id');
        $user_id = $_SESSION['user_id'];
        $post['user_id']            = $user_id;
        $post['user_follow_id']     = $follow_id;
        $post['created_at']         = date('Y-m-d H:i:s');
        $post['updated_at']         = date('Y-m-d H:i:s');

		$resultchecklikes =  $this->db->select('id')
			->get_where('users_follows', ['user_id' => $user_id, 'user_follow_id' => $follow_id])
			->num_rows();

		if (empty($resultchecklikes)) {
			$this->db->insert('users_follows', $post);
			$data['act'] = 'active';
        } else {
			$this->db->where('user_follow_id',$follow_id);
			$this->db->where('user_id',$user_id);
			$this->db->delete('users_follows');
			$data['act'] = '';
		}

        $data['CSRF'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $data['follow_id'] = $follow_id;
        $data['token'] = $this->security->get_csrf_hash();

        //notifications
        // $this->load->library('fcm');
        // $users = $this->db->get_where('users',array('id'=>$follow_id))->row();
        // $token = $users->fcm_token;
        // $image = $users->file_path.$users->file_name_original;
        // $message = [
        //     'users_id' => $users->id,
        //     'username' => $users->username,
        // ];
        // $this->fcm->setTitle('Invite');
        // $this->fcm->setMessage($message);
        // $this->fcm->setIsBackground(false);

        // $payload = array('notification' => 'Invite');
        // $this->fcm->setPayload($payload);

        // $this->fcm->setImage(base_url($image));
        // $json = $this->fcm->getPush();

        // $this->fcm->send($token, $json);

        echo json_encode($data);
    }

	/** Unfollow Connections */
    public function unfollow()
    {
        $follow_id = $this->input->post('follow_id');
        $user_id = $_SESSION['user_id'];
		$this->db->where('user_follow_id',$follow_id);
		$this->db->where('user_id',$user_id);
		$this->db->delete('users_follows');
        $data['CSRF'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];

        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function show_following()
    {
        $user_id = $_SESSION['user_id'];
        $following = $this->M_connection->show_following($user_id)->result();
        echo json_encode($following);
    }

    public function fcm(){
        $this->load->library('fcm');
        $token = 'ceQ5XUNVu6MoBYI8SfYI8q:APA91bHezFF3vZdYxfhnEuuk6i5aMW8KbDOs_nes0pn7Mxu7Is7FPfWVeRxty_pJprV6zpVlED6j_E32W3fmVWIfE-HkP-in7Wxg9aEJWBKgOZs_ETZh4oMjq4PxS2332BpQWf4l_TDV'; // push token
        $message = "Test notification message";
        $this->fcm->setTitle('Test FCM Notification');
        $this->fcm->setMessage($message);

        /**
         * set to true if the notificaton is used to invoke a function
         * in the background
         */
        $this->fcm->setIsBackground(false);

        /**
         * payload is userd to send additional data in the notification
         * This is purticularly useful for invoking functions in background
         * -----------------------------------------------------------------
         * set payload as null if no custom data is passing in the notification
         */
        $payload = array('notification' => '');
        $this->fcm->setPayload($payload);

        /**
         * Send images in the notification
         */
        $this->fcm->setImage('https://firebase.google.com/_static/9f55fd91be/images/firebase/lockup.png');

        /**
         * Get the compiled notification data as an array
         */
        $json = $this->fcm->getPush();

        $p = $this->fcm->send($token, $json);

        print_r($p);
    }
}
