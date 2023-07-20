<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Business_profile_public extends Base_users
{
    protected $module_base                  = 'business/post';
    protected $apps_title_module            = 'profile';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('M_business_public');
    }

    public function index()
    {
        $business_username =  $this->uri->segment(4);
        $this->session->set_userdata('business_username',$business_username);
        $check_business          = $this->db->get_where('pbd_business',array('data_username'=>$business_username))->row();
        if(empty($check_business)){
            redirect('index');
        }
        if ($this->input->post()) {
            $this->set_form_validation();
            switch ($this->input->post('form')) {
                case 'cover':
                    $this->cover_process($business_username);
                    break;
                case 'photo':
                    $this->photo_process($business_username);
                    break;
                default:
                    echo "Isi variabel tidak di temukan";
                    break;
            }
        } else {

            $data         = array(
				'meta_position' => 'b_'.$business_username,
                'apps_title_module' => $this->apps_title_module
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
        $check_like = $this->db->get_where('pfe_media_likes')->result();
        $checklikes = $this->db->query('select * from pfe_media_likes');
        $resultchecklikes = $checklikes->num_rows();
        $data_business          = $this->db->get_where('pbd_business',array('data_username'=>$business_username))->row();
        // $data['users']          = $this->db->get_where('users',array('id'=>$id))->row();
        $data['posts']          = $this->M_business_public->post($data_business->id)->result();
        // $data['post_articles']  = $this->M_business_public->post_article($id)->result();
        $data['all_likes']      = $this->db->get_where('pfe_media_likes')->result();
        $data['likes']          = $resultchecklikes;
        $data['comments']       = $this->M_business_public->show_comment()->result();
        $data['business_categories'] = $this->db->get_where('pbd_business_categories',array('status' => 1))->limit(5)->result();
        $data['business_types'] = $this->db->get('pbd_business_types')->result();
        $data['business']       = $this->db->get_where('pbd_business',array('id'=>$data_business->id))->row();
        $data['business_list']     = $this->db->get_where('pbd_business',array('id'=>$data_business->id))->result();
        $data['jobs_categories']  = $this->db->get_where('pcj_jobs_categories',array('status' => 1))->result();
        $data['jobs_types']  = $this->db->get_where('pcj_jobs_types',array('status' => 1))->result();
        $data['distributor_types']  = $this->db->get_where('pbd_business_distributor_types',array('status' => 1))->result();
        // if($data['users']->id == $data['business']->users_id){
        //     $data['checkusers_profile'] = 1;
        // }else{
        //     $data['checkusers_profile'] = '';
        // }
        $data['count_follows']  = $this->M_business_public->count_follow($check_business->id);

        $this->display('post', $data);
        }
    }

    protected function set_form_validation($ID = FALSE)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br/>');
        /* SET FORM VALIDATION RULES FOR COLUMN */
        $this->form_validation->set_rules("__file", "Cover {$this->apps_title_module}", 'required');
    }

    public function cover_process($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/business/post/' . $parameter_id;
        $this->action_edit_process_cover_business();
    }

    public function photo_process($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/business/post/' . $parameter_id;
        $this->action_edit_process_photo_business();
    }

	/** About Business Profile */
    public function about()
    {
        $business_username =  urldecode($this->uri->segment(4));
		$this->session->set_userdata('business_username',$business_username);
        $check_business          = $this->db->get_where('pbd_business',array('data_username'=>$business_username))->row();
        
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
				'meta_position' => 'b_'.$business_username,
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
        $data['business'] = $this->db->get_where('pbd_business',array('data_username'=>$business_username))->row();
        $data["facilities"]     = $this->db->get_where('mst_facilities',array('status'=>1))->result();
		if(!empty($this->session->userdata('is_login') == FALSE)){
			$data["users"] = $this->db->get('users')->row();
		}else{
			$id =  $_SESSION['user_id'];
			$data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
		}
        if($data['users']->id == $data['business']->users_id){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }

        config('title', $this->db->get_where('pbd_business',array('data_username'=>$business_username))->row()->data_name);

        $this->display('about', $data);
        }
    }

	/** Connection Business Profile */
    public function connection()
    {
        $business_username = $_SESSION['business_username'];
        $businessusername =  $this->uri->segment(3);
        $check_business          = $this->db->get_where('pbd_business',array('data_username'=>$businessusername))->row();
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
				'meta_position' => 'b_'.$business_username,
                'apps_title_module' => $this->apps_title_module
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
        }
        $business = $this->db->get_where('pbd_business',array('data_username'=>$business_username))->row();
        $data["skills"] = $this->db->get('mst_skills')->result();
        $data["users"] = $this->db->get_where('users')->row();
        $data['business']       = $this->db->get_where('pbd_business',array('id'=>$business->id))->row();
        if($data['users']->id == $data['business']->users_id){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }
        $data["followers"] = $this->M_business_public->show_follow($business->id)->result();
        $data["count_followers"] = $this->M_business_public->show_follow($business->id)->num_rows();
        $this->display('connection', $data);
    }

	/** Photo Business Profile */
    public function photo()
    {
        $business_username =  $_SESSION['business_username'];
        $businessusername =  $this->uri->segment(3);
        $check_business          = $this->db->get_where('pbd_business',array('data_username'=>$businessusername))->row();

        if ($this->input->post()) {
            $this->set_form_validation();
            switch ($this->input->post('form')) {
                case 'cover':
                    $this->cover_process($this->input->post('id'));
                    break;
                case 'photo':
                    $this->photo_process($this->input->post('id'));
                    break;
                case 'album_business':
                    $this->album_process($this->input->post('id'));
                    break;
                case 'photo_album_business':
                    $this->photo_album_process($this->input->post('id'));
                    break;
                default:
                    echo "Isi variabel tidak di temukan";
                    break;
            }
        } else {
            $data         = array(
				'meta_position' => 'b_'.$business_username,
                'apps_title_module' => $this->apps_title_module
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
        }
        $business = $this->db->get_where('pbd_business',array('data_username'=>$business_username))->row();
        $data["albums_photo"]  = $this->M_business_public->join_album_photo_business($business->id)->result();
        $data["category_albums"] = $this->db->get_where('pbd_business_photo_categories',array('status'=>1))->result();
        $data["albums"] = $this->db->get_where('pbd_business_photo_categories', array('pbd_business_id'=>$business->id))->result();
        $data["users"] = $this->db->get_where('users')->row();
        $data["data_users"] = $this->db->get('users')->result();
        $data['business']       = $this->db->get_where('pbd_business',array('id'=>$business->id))->row();
        if($data['users']->id == $data['business']->users_id){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }
        $this->display('photo', $data);
    }

    public function album_process($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/user/profile/photo/' . $parameter_id;
        $this->action_edit_process_album_business($parameter_url_source, $parameter_id);
    }

    public function photo_album_process($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/user/profile/photo/' . $parameter_id;
        $this->action_edit_process_photo_album_business($parameter_url_source, $parameter_id);
    }

    public function photo_delete()
    {
        $parameter_id = $this->input->post('id');
        $photo_id = $this->input->post('photo_id');
        $url      = $this->input->post('form');

        $query=$this->db->get_where('users_albums_photo',array('id'=>$photo_id));

        $img_name=$query->result()[0]->file_name_original;
        $img_name_thumbnail=$query->result()[0]->file_name_thumbnail;
        $img_path=$query->result()[0]->file_path;
        $this->load->helper("file");

        if(file_exists($img_path.'/'.$img_name))
        {
            unlink(FCPATH . $img_path.'/'.$img_name);
            unlink(FCPATH . $img_path.'/thumb/'.$img_name_thumbnail);
        }

        $this->db->where('id',$photo_id);
        $this->db->delete('users_albums_photo');

        redirect('user/'.$url.'/'.$parameter_id);

    }

    public function album_delete()
    {
        $parameter_id = $this->input->post('id');
        $album_id = $this->input->post('album_id');
        $url      = $this->input->post('form');

        $query=$this->db->get_where('users_albums',array('id'=>$album_id));
        $img_name=$query->result()[0]->file_name_original;
        $img_name_thumbnail=$query->result()[0]->file_name_thumbnail;
        $img_path=$query->result()[0]->file_path;
        $this->load->helper("file");

            if(file_exists($img_path.'/'.$img_name))
            {
                unlink(FCPATH . $img_path.'/'.$img_name);
                unlink(FCPATH . $img_path.'/thumb/'.$img_name_thumbnail);
            }

        $query_photo=$this->db->get_where('users_albums_photo',array('users_albums_id'=>$album_id));
        $img_name_photo=$query_photo->result()[0]->file_name_original;
        $img_name_thumbnail_photo=$query_photo->result()[0]->file_name_thumbnail;
        $img_path_photo=$query_photo->result()[0]->file_path;
            if(file_exists($img_path_photo.'/'.$img_name_photo))
            {
                $count = $query_photo->num_rows();
                for($i=0;$i<$count;$i++){
                    unlink(FCPATH . $img_path_photo.'/'.$img_name_photo);
                    unlink(FCPATH . $img_path_photo.'/thumb/'.$img_name_thumbnail_photo);
                }
            }

        $this->db->where('id',$album_id);
        $this->db->delete('users_albums');

        redirect('user/'.$url.'/'.$parameter_id);

    }

	/** Photo Album Business Profile */
    public function photo_album($id)
    {
        $users_id =  $_SESSION['user_id'];
        $business_username =  $_SESSION['business_username'];
        $check_business          = $this->db->get_where('pbd_business',array('data_username'=>$business_username))->row();
        if ($this->input->post()) {
            $this->set_form_validation();
            switch ($this->input->post('form')) {
                case 'cover':
                    $this->cover_process($this->input->post('id'));
                    break;
                case 'photo':
                    $this->photo_process($this->input->post('id'));
                    break;
                case 'album_business':
                    $this->album_process($this->input->post('id'));
                    break;
                case 'photo_album_business':
                    $this->photo_album_process($this->input->post('id'));
                    break;
                default:
                    echo "Isi variabel tidak di temukan";
                    break;
            }
        } else {
            $data         = array(
                'apps_title_module' => $this->apps_title_module
            );
            $data['CSRF'] = [
                'id' => $id,
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
        }
        $data["albums_photo"]  = $this->M_business_public->join_photo_business($id)->result();
        $data["category_albums"] = $this->db->get_where('users_albums_categories',array('status'=>1))->result();
        $data["albums"] = $this->db->get_where('pbd_business_photo_categories', ['id' => $id])->row();
        $data["users"] = $this->db->get_where('users',array('id'=>$users_id))->row();
        $data["data_users"] = $this->db->get('users')->result();
        $data['business']       = $this->db->get_where('pbd_business',array('id'=>$check_business->id))->row();
        if($data['users']->id == $data['business']->users_id){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }
        $this->display('photo_album',$data);
    }

	/** Job Business Profile */
    public function job()
    {
        $businessusername =  $this->uri->segment(4);
        $check_business          = $this->db->get_where('pbd_business',array('data_username'=>$businessusername))->row();
   
        $business_id =  $this->uri->segment(4);

            $data         = array(
				'meta_position' => 'b_'.$businessusername,
                'apps_title_module' => $this->apps_title_module
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
            $data["users"] = $this->db->get_where('users')->row();
            $data['business']       = $this->db->get_where('pbd_business',array('id'=>$check_business->id))->row();
            $data["users_profile"]          = $this->db->get_where('users')->row();
            $data["jobs"]          = $this->M_business_public->join_jobs($check_business->id)->result();
            $data["jobs_users"]    = $this->M_business_public->join_jobs($check_business->id)->row();
            $data['jobs_type']  = $this->db->get_where('pcj_jobs_types',array('status'=>1))->result();
            $data['jobs_categories'] = $this->db->get_where('pcj_jobs_categories',array('status'=>1))->result();
            $data['jobs_salary_period'] = $this->db->get_where('pcj_jobs_salary_period',array('status'=>1))->result();
            if($data['business']->users_id){
                $data['checkusers_profile'] = 1;
            }else{
                $data['checkusers_profile'] = '';
            }
        $this->display('job', $data);
    }

	/** Post add business profile */
    public function post_add(){
        $form   = $this->input->post('form');
        $id     = $this->input->post('id');
        $business_username = $_SESSION['business_username'];
        $post['id']                 = $this->generate_new_id_string() . get_random_alphanumeric(5);
        $post['users_id']           = $this->input->post('id');
        $post['data_description']   = $this->input->post('data_description');
        $post['published']          = date('Y-m-d H:i:s');
        $post['created_by']         = 1;
        $post['created_at']         = date('Y-m-d H:i:s');
        $post['updated_by']         = 1;
        $post['updated_at']         = date('Y-m-d H:i:s');
        $this->db->insert('pfe_posts', $post);
        if($form == 'profile'){
            redirect(base_url('user/post/'.$business_username));
        }else{
            redirect(base_url('user/dashboard'));
        }
    }

	/** Post edit business profile */
    public function post_edit(){
        $form   = $this->input->post('form');
        $id     = $this->input->post('id');
        $post_text_id   = $this->input->post('post_text_id');
        $post['users_id']           = $this->input->post('id');
        $post['data_description']   = $this->input->post('data_description');
        $post['published']          = date('Y-m-d H:i:s');
        $post['created_by']         = 1;
        $post['created_at']         = date('Y-m-d H:i:s');
        $post['updated_by']         = 1;
        $post['updated_at']         = date('Y-m-d H:i:s');
        $this->db->where('pfe_posts.id', $post_text_id);
        $form = $this->db->update('pfe_posts', $post);
        if($form == 'profile'){
            redirect(base_url('user/profile/post/'.$id));
        }else{
            redirect(base_url('user/dashboard'));
        }
    }

	/** Post delete business profile */
    public function post_delete(){
        $form   = $this->input->post('form');
        $id     = $this->input->post('id');
        $post_text_id   = $this->input->post('post_text_id');
        $this->db->where('pfe_posts.id',$post_text_id);
        $this->db->delete('pfe_posts');
        redirect(base_url($form.$id));
    }

	/** Image post business profile */
    public function photo_post_add(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/user/dashboard';
        $this->action_photo_post($parameter_url_source, $parameter_id);
    }

	/** Video post business profile */
    public function video_post_add(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/user/dashboard';
        $this->action_video_post($parameter_url_source, $parameter_id);
    }

    public function article_post()
    {
        $id =  $this->uri->segment(5);
        $data         = array(
            'apps_title_module' => $this->apps_title_module
        );
        $data['CSRF'] = [
            'id' => $id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
            ];
        $data["category_article"] = $this->db->get('pfe_articles_categories')->result();
        $data["users"]      = $this->db->get_where('users',array('id'=>$id))->row();
        $this->display('article_add', $data);
    }

    public function article_post_add(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/user/profile/post/article';
        $this->action_article_post($parameter_url_source, $parameter_id);
    }

    public function article_list()
    {
        $id =  $this->uri->segment(5);
        $data         = array(
            'apps_title_module' => $this->apps_title_module
        );
        $data['CSRF'] = [
            'id' => $id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
            ];

        $data["category_article"] = $this->db->get('pfe_articles_categories')->result();
        $data["users"]            = $this->db->get_where('users',array('id'=>$id))->row();
        $data['post_articles']    = $this->M_business_public->post_article($id)->result();
        $this->display('article_list', $data);
    }

    public function article_edit($user_id,$article_id)
    {
        $data         = array(
            'apps_title_module' => $this->apps_title_module
        );
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
            ];

        $data["article"]      = $this->db->get_where('pfe_articles',array('id'=>$article_id))->row();
        $data["category_article"] = $this->db->get('pfe_articles_categories')->result();
        $data["users"]      = $this->db->get_where('users',array('id'=>$user_id))->row();
        $this->display('article_edit', $data);
    }

    public function article_delete($article_id)
    {
        $user_id    = $this->input->post('user_id');
        $this->db->where('id',$article_id);
        $this->db->delete('pfe_articles');
        redirect('user/profile/post/article_list/'.$user_id);
    }

    public function post_like()
    {
        $id = $this->input->post('id');
        $user_id = $this->input->post('user_id');
        $table = 'pfe_posts';
        $checklikes =  $this->db->query('select * from pfe_media_likes
        where users_id="'.$user_id.'" and relate_id="'.$id.'"');
        $resultchecklikes = $checklikes->num_rows();
        if($resultchecklikes == null ){
            $set = '123456789';
            $post['id'] = substr(str_shuffle($set), 0, 12);
            $post['users_id']           = $user_id;
            $post['relate_id']          = $id;
            $post['relate_table']       = $table;
            $post['created_at']         = date('Y-m-d H:i:s');
            $post['updated_at']         = date('Y-m-d H:i:s');
            $this->db->insert('pfe_media_likes', $post);
        }else{
            $this->db->where('users_id',$user_id);
            $this->db->delete('pfe_media_likes');
        }
        $this->db->select('*');
        $this->db->where('relate_id',$id);
        $query = $this->db->get('pfe_media_likes');
        $num = $query->num_rows();
        $data['token'] = $this->security->get_csrf_hash();
        $data['id'] = $id;
        $data['likes'] = $num;
        $data['change_likes'] = $resultchecklikes;
        echo json_encode($data);
    }

    public function post_comment()
    {
        $post_id = $this->input->post('post_id');
        $user_id = $this->input->post('user_id');
        $comment = $this->input->post('comment');
        $table = 'pfe_posts';
            $set = '123456789';
            $post['id'] = substr(str_shuffle($set), 0, 12);
            $post['users_id']           = $user_id;
            $post['relate_id']          = $post_id;
            $post['relate_table']       = $table;
            $post['data_description']   = $comment;
            $post['created_at']         = date('Y-m-d H:i:s');
            $post['updated_at']         = date('Y-m-d H:i:s');
            $this->db->insert('pfe_media_comments', $post);
        $data['token'] = $this->security->get_csrf_hash();
        $data['post_id'] = $post_id;
        $data['comment'] = $comment;
        echo json_encode($data);
    }

    function show_comment($id){
        $data=$this->M_business_public->show_comment_where($id)->result();
        echo json_encode($data);
    }

    function show_comment_all(){
        $data=$this->M_business_public->show_comment()->result();
        echo json_encode($data);
    }

	/** Product & Service business profile */
    public function service($id = null){
        $business_username =  $this->uri->segment(4);
        $this->session->set_userdata('business_username',$business_username);
        $check_business          = $this->db->get_where('pbd_business',array('data_username'=>$business_username))->row();
        // if(empty($check_business)){
        //     redirect('user/dashboard');
        // }
        $data = [
            'title_web' => 'Dashboard',
			'meta_position' => 'b_'.$business_username,
            'users'     => $this->db->get_where('users')->row(),

        ];
        $data['CSRF'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $data['items_list_product']     = $this->M_business_public->data_product($check_business->id);
        $data['items_list_service']     = $this->M_business_public->data_service($check_business->id );
        $business = $this->db->get_where('pbd_business',array('data_username'=>$business_username))->row();
        $data["products"]        = $this->db->get_where('pbd_items',array('pbd_business_id'=>$business->id))->result();
        $data["types"]          = $this->db->get_where('pbd_business_types',array('status'=>1))->result();
        $data["categories"]         = $this->db->get_where('pbd_business_categories',array('status'=>1))->result();
        $data['business']       = $this->db->get_where('pbd_business',array('id'=>$business->id))->row();
        $data['users']          = $this->db->get_where('users')->row();
        if($data['users']->id == $data['business']->users_id){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }
        $this->display('service', $data);
    }

    public function business_pdf($id){
        $this->load->library('pdf');
        $data['business'] = $this->db->get_where('pbd_business',array('id'=>$id))->row();
        $data["facilities"]     = $this->db->get_where('mst_facilities',array('status'=>1))->result();
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        
        $this->pdf->filename = "profile.pdf";
        $this->pdf->load_view('profile_pdf',$data);
    }
}
