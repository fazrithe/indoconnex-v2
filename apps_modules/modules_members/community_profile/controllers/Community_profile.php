<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Community_profile extends Base_users
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('M_community');
        if(!empty($this->session->userdata('is_login') == FALSE)){
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }
    }

	/** Post Community Profile */
    public function index($id)
    {
        $user_id = $_SESSION['user_id'];
        $community_id =  $this->uri->segment(3);
        $check_community          = $this->db->get_where('pcs_communities',array('id'=>$community_id))->row();
        if(empty($check_community)){
            redirect('community/discover');
        }
        if ($this->input->post()) {
            $this->set_form_validation();
            switch ($this->input->post('form')) {
                case 'cover':
                    $this->profile_cover();
                    break;
                case 'photo':
                    $this->profile_photo();
                    break;
                default:
                    echo "Isi variabel tidak di temukan";
                    break;
            }
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module,
                'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
            );
            $data['CSRF'] = [
                'id' => $id,
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
        $data['community']  = $this->db->get_where('pcs_communities',array('id'=>$id))->row();
        $data['com_categories']     = $this->db->get('pcs_communities_categories')->result();
        $data['posts']          = $this->M_community->post($id)->result();
        $data['business_list']     = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        $data['jobs_categories']  = $this->db->get_where('pcj_jobs_categories',array('status' => 1))->result();
        $data['jobs_types']  = $this->db->get_where('pcj_jobs_types',array('status' => 1))->result();
        $data['distributor_types']  = $this->db->get_where('pbd_business_distributor_types',array('status' => 1))->result();
        $data['business_categories'] = $this->db->get_where('pbd_business_categories',array('status' => 1))->result();
        $data['business_types'] = $this->db->get('pbd_business_types')->result();
        $data['count_members']  = $this->M_community->count_member($id);
        $result =  $this->db->select('user_follow_id')->get_where('pcs_communities_follows', array('pcs_communities_id' => $id))->result();

		$friends = [];
		foreach ($result as $key) {
			$friends[] = $key->user_follow_id;
		}
        $data['friends'] = $friends;
        if($data['community']->users_id == $_SESSION['user_id']){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }

        $community_id = json_encode($id);
        
        $sql = "SELECT pcs_communities_id, GROUP_CONCAT(DISTINCT user_follow_id SEPARATOR ', ') as following 
                    FROM pcs_communities_follows 
                    WHERE pcs_communities_id = $community_id
                GROUP BY pcs_communities_id";

        $list_community_members = optional($this->db->query($sql)->row())->following;

        $list_community_members_arr = explode (",", preg_replace('/\s+/', '', $list_community_members)); 

        if (in_array($_SESSION['user_id'], $list_community_members_arr)) {
            $data['is_community_member'] = 1;
        } else {
            $data['is_community_member'] = '';
        }

        config('title', $data['community']->data_name);
        $this->display('discussion',$data);
        }
    }

	/** About Community Profile */
    public function about($id)
    {
        $user_id = $_SESSION['user_id'];
        $community_id =  $this->uri->segment(3);
        $check_community          = $this->db->get_where('pcs_communities',array('id'=>$community_id))->row();
        if(empty($check_community)){
            redirect('community/discover');
        }
        if ($this->input->post()) {
            $this->set_form_validation();
            switch ($this->input->post('form')) {
                case 'cover':
                    $this->profile_cover();
                    break;
                case 'photo':
                    $this->profile_photo();
                    break;
                default:
                    echo "Isi variabel tidak di temukan";
                    break;
            }
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module,
                'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
            );
            $data['CSRF'] = [
                'id' => $id,
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
        $data['community']  = $this->db->get_where('pcs_communities',array('id'=>$id))->row();
        $data['com_categories']     = $this->db->get('pcs_communities_categories')->result();
        $data['posts']          = $this->M_community->post($user_id)->result();
        $result =  $this->db->select('user_follow_id')->get_where('pcs_communities_follows', array('pcs_communities_id' => $id))->result();

		$friends = [];
		foreach ($result as $key) {
			$friends[] = $key->user_follow_id;
		}
        $data['friends'] = $friends;
        if($data['community']->users_id == $_SESSION['user_id']){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }
        config('title', $data['community']->data_name);
        $this->display('about',$data);
        }
    }

	/** Member Community Profile */
    public function member($id)
    {
        $user_id = $_SESSION['user_id'];
        $community_id =  $this->uri->segment(3);
        $check_community          = $this->db->get_where('pcs_communities',array('id'=>$community_id))->row();
        if(empty($check_community)){
            redirect('community/discover');
        }
        if ($this->input->post()) {
            $this->set_form_validation();
            switch ($this->input->post('form')) {
                case 'cover':
                    $this->profile_cover();
                    break;
                case 'photo':
                    $this->profile_photo();
                    break;
                default:
                    echo "Isi variabel tidak di temukan";
                    break;
            }
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module,
                'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
            );
            $data['CSRF'] = [
                'id' => $id,
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
        $data["members"]    = $this->M_community->show_members($id)->result();
        $data['community']  = $this->db->get_where('pcs_communities',array('id'=>$id))->row();
        $data['com_categories']     = $this->db->get('pcs_communities_categories')->result();
        $result =  $this->db->select('user_follow_id')->get_where('pcs_communities_follows', array('pcs_communities_id' => $id))->result();

		$friends = [];
		foreach ($result as $key) {
			$friends[] = $key->user_follow_id;
		}
        $data['friends'] = $friends;
        if($data['community']->users_id == $_SESSION['user_id']){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }
        config('title', $data['community']->data_name);
        $this->display('member', $data);
        }
    }

	/** Photo Community Profile */
    public function photo($id)
    {
        $user_id = $_SESSION['user_id'];
        $community_id =  $this->uri->segment(3);
        $check_community          = $this->db->get_where('pcs_communities',array('id'=>$community_id))->row();
        if(empty($check_community)){
            redirect('community/discover');
        }
        if ($this->input->post()) {
            $this->set_form_validation();
            switch ($this->input->post('form')) {
                case 'cover':
                    $this->profile_cover();
                    break;
                case 'photo':
                    $this->profile_photo();
                    break;
                default:
                    echo "Isi variabel tidak di temukan";
                    break;
            }
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module,
                'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
            );
            $data['CSRF'] = [
                'id' => $id,
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
        $data["albums"]  = $this->M_community->join_album_photo_community($id)->result();
        $data["albums_photo"] = $this->db->get_where('pcs_communities_albums_photo', array('pcs_communities_id'=>$id))->result();
        $data['community']  = $this->db->get_where('pcs_communities',array('id'=>$id))->row();
        $data['com_categories']     = $this->db->get('pcs_communities_categories')->result();
        $result =  $this->db->select('user_follow_id')->get_where('pcs_communities_follows', array('pcs_communities_id' => $id))->result();

		$friends = [];
		foreach ($result as $key) {
			$friends[] = $key->user_follow_id;
		}
        $data['friends'] = $friends;
        if($data['community']->users_id == $_SESSION['user_id']){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }
        config('title', $data['community']->data_name);
        $this->display('photo', $data);
        }
    }

    public function photo_album($id)
    {
        $users_id =  $_SESSION['user_id']; 
        if ($this->input->post()) {
            $this->set_form_validation();
            switch ($this->input->post('form')) {
                case 'cover':
                    $this->profile_cover();
                    break;
                case 'photo':
                    $this->profile_photo();
                    break;
                default:
                    echo "Isi variabel tidak di temukan";
                    break;
            }
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module,
                'users'     => $this->db->get_where('users',array('id'=>$users_id))->row(),
            );
            $data['CSRF'] = [
                'id' => $id,
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
        $data["data_users"] = $this->db->get('users')->result();
        $albums_photo = $this->db->get_where('pcs_communities_albums_photo', array('pcs_communities_albums_id'=>$id))->row();
        $data["albums"]  = $this->M_community->join_album_photo_community_($id)->result();
        $data["albums_photo"] = $this->db->get_where('pcs_communities_albums_photo', array('pcs_communities_albums_id'=>$id))->result();
        $data['community']  = $this->db->get_where('pcs_communities',array('id'=>$albums_photo->pcs_communities_id))->row();
        $data['com_categories']     = $this->db->get('pcs_communities_categories')->result();
        $result =  $this->db->select('user_follow_id')->get_where('pcs_communities_follows', array('pcs_communities_id' => $id))->result();

		$friends = [];
		foreach ($result as $key) {
			$friends[] = $key->user_follow_id;
		}
        $data['friends'] = $friends;
        if($data['community']->users_id == $_SESSION['user_id']){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }
        config('title', $data['community']->data_name);
        $this->display('photo_album',$data);
        }
    }

    public function post_add(){
        $user_id = $_SESSION['user_id'];
        $community_id = $this->input->post('community_id');
        $description = $this->input->post('data_description');
        // dd($description);
        $post['id']                 = $this->generate_new_id_string() . get_random_alphanumeric(5);
        $post['users_id']           = $user_id;
        $post['pcs_communities_id']   = $community_id;
        $post['data_description']   = $this->input->post('data_description');
        $post['published']          = date('Y-m-d H:i:s');
        $post['created_by']         = 1;
        $post['created_at']         = date('Y-m-d H:i:s');
        $post['updated_by']         = 1;
        $post['updated_at']         = date('Y-m-d H:i:s');
        $this->db->insert('pcs_posts', $post);
        redirect(base_url('community/post/'.$community_id)); 
    }

    public function post_edit(){
        $post_text_id   = $this->input->post('post_text_id');
        $user_id = $_SESSION['user_id'];
        $community_id = $this->input->post('community_id');
        $description = $this->input->post('data_description');
        $post['id']                 = $this->generate_new_id_string() . get_random_alphanumeric(5);
        $post['users_id']           = $user_id;
        $post['pcs_communities_id']   = $community_id;
        $post['data_description']   = $this->input->post('data_description');
        $post['published']          = date('Y-m-d H:i:s');
        $post['created_by']         = 1;
        $post['created_at']         = date('Y-m-d H:i:s');
        $post['updated_by']         = 1;
        $post['updated_at']         = date('Y-m-d H:i:s');
        $this->db->where('pcs_posts.id', $post_text_id);
        $update = $this->db->update('pcs_posts', $post);
        redirect(base_url('community/post/'.$community_id)); 
    }

    public function post_delete(){
        $post_text_id   = $this->input->post('post_text_id');
        $community_id   = $this->input->post('community_id');
        $this->db->where('pcs_posts.id',$post_text_id);
        $this->db->delete('pcs_posts');
        redirect(base_url('community/post/'.$community_id)); 
    }

    public function photo_post_add(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/user/dashboard';
        $this->action_photo_post_community($parameter_url_source, $parameter_id);
    }

    public function photo_post_edit(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/user/dashboard';
        $this->action_photo_post_community_edit($parameter_url_source, $parameter_id);
    }
    
    public function video_post_add(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/user/dashboard';
        $this->action_video_post_community($parameter_url_source, $parameter_id);
    }

    public function video_post_edit(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/user/dashboard';
        $this->action_video_post_community_edit($parameter_url_source, $parameter_id);
    }

    public function profile_photo(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/user/dashboard';
        $this->action_photo_profile_community($parameter_url_source, $parameter_id);
    }

    public function profile_cover(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/user/dashboard';
        $this->action_cover_profile_community($parameter_url_source, $parameter_id);
    }

    public function albums_add(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/user/dashboard';
        $this->action_albums_community($parameter_url_source, $parameter_id);
    }

    public function photo_add(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/user/dashboard';
        $this->action_albums_photo_community($parameter_url_source, $parameter_id);
    }
    
    public function lookfor_post_add($id){
        $form = $this->input->post('form');
        if ($form == 'business'){
            $business_id = $this->input->post('select_business_id_business');
            $description = $this->input->post('description_business');
            $data_type = $this->input->post('s_business_types');
            $tbl_type = 'pbd_business_types'; 
            $post['id']                 = $this->generate_new_id_string() . get_random_alphanumeric(5);
            $post['users_id']           = $_SESSION['user_id'];
            $post['pcs_communities_id']= $id;
            $post['pbd_business_id']    = $business_id;
            $post['data_type_table']    = $tbl_type;
            $post['data_type_value']    = $data_type;
            $post['data_description']   = $description;
            $post['status']             = 1;
            $post['published']          = date('Y-m-d H:i:s');
            $post['created_by']         = $_SESSION['user_id'];
            $post['created_at']         = date('Y-m-d H:i:s');
            $post['updated_by']         = $_SESSION['user_id'];
            $post['updated_at']         = date('Y-m-d H:i:s');
            $this->db->insert('pcs_posts_lookfoor', $post);
        } elseif ($form == 'jobs'){
            $description = $this->input->post('description_job');
            $data_type = $this->input->post('s_type_job');
            $data_category = $this->input->post('s_category_job');
            $tbl_type = 'pcj_jobs_types'; 
            $tbl_category = 'pcj_jobs_categories'; 
            $post['id']                 = $this->generate_new_id_string() . get_random_alphanumeric(5);
            $post['users_id']           = $_SESSION['user_id'];
            $post['pcs_communities_id']= $id;
            $post['data_type_table']    = $tbl_type;
            $post['data_type_value']    = $data_type;
            $post['data_categories_table']    = $tbl_category;
            $post['data_categories_value']    = $data_category;
            $post['data_description']   = $description;
            $post['status']             = 1;
            $post['published']          = date('Y-m-d H:i:s');
            $post['created_by']         = $_SESSION['user_id'];
            $post['created_at']         = date('Y-m-d H:i:s');
            $post['updated_by']         = $_SESSION['user_id'];
            $post['updated_at']         = date('Y-m-d H:i:s');
            $this->db->insert('pcs_posts_lookfoor', $post);
        } else {
            $business_id = $this->input->post('select_business_id_business');
            $description = $this->input->post('description_distributor');
            $data_type = $this->input->post('s_type_distributor');
            $tbl_type = 'pbd_business_distributor_types'; 
            $post['id']                 = $this->generate_new_id_string() . get_random_alphanumeric(5);
            $post['users_id']           = $_SESSION['user_id'];
            $post['pcs_communities_id']= $id;
            $post['pbd_business_id']    = $business_id;
            $post['data_type_table']    = $tbl_type;
            $post['data_type_value']    = $data_type;
            $post['data_description']   = $description;
            $post['status']             = 1;
            $post['published']          = date('Y-m-d H:i:s');
            $post['created_by']         = $_SESSION['user_id'];
            $post['created_at']         = date('Y-m-d H:i:s');
            $post['updated_by']         = $_SESSION['user_id'];
            $post['updated_at']         = date('Y-m-d H:i:s');
            $this->db->insert('pcs_posts_lookfoor', $post);
        }
        redirect(base_url('community/post/'.$id));
    }

    public function follow()
    {
        $follow_id = $this->input->post('follow_id');
        $user_id = $_SESSION['user_id'];
        $post['pcs_communities_id'] = $follow_id;
        $post['user_follow_id']     = $user_id;
        $post['created_at']         = date('Y-m-d H:i:s');
        $post['updated_at']         = date('Y-m-d H:i:s');

		$resultchecklikes =  $this->db->select('id')
			->get_where('pcs_communities_follows', ['pcs_communities_id' => $follow_id, 'user_follow_id' => $user_id])
			->num_rows();

		if (empty($resultchecklikes)) {
			$this->db->insert('pcs_communities_follows', $post);
			$data['act'] = 'active';
        } else {
			$this->db->where('user_follow_id',$user_id);
			$this->db->where('pcs_communities_id',$follow_id);
			$this->db->delete('pcs_communities_follows');
			$data['act'] = '';
		}

        $data['CSRF'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $data['follow_id'] = $follow_id;
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
}
