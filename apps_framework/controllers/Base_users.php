<?php

use phpDocumentor\Reflection\Types\This;

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base.php';

class Base_users extends Base
{
    protected $module_base        = '';
    protected $module_portal      = 'users';
    protected $module_global_view = 'apps/views/';

    protected $module_url_default = 'post';
    protected $module_url_default_photo = 'photo';
    protected $module_url_default_photo_business = 'business/photo';
    protected $module_url_default_photo_post = 'user/dashboard';
    protected $module_url_default_photo_post_profile = 'user/profile/post';
    protected $module_url_default_article = 'articles/list';
    protected $module_url_default_business = 'business/post';
    protected $apps_title        = 'Home';
    protected $apps_title_module = 'General';
    protected $apps_breadcrumb   = array();
    protected $apps_setting      = array();
    protected $apps_output_message          = array(
        'status'  => '',
        'title'   => '',
        'message' => ''
    );
    protected $module_table                 = 'users';
    protected $module_table_business        = 'pbd_business';
    protected $module_table_id              = 'id';
    protected $csrf                         = [
        'name' => '',
        'hash' => '',
    ];
    protected $csrf_js                      = [];
    protected $module_duplicate_check       = array();
    protected $module_duplicate_check_chain = array();
    protected $module_upload_path_cover     = 'public/uploads/profile/cover';
    protected $module_upload_path_photo     = 'public/uploads/profile/photo';
    protected $module_upload_path_photo_business     = 'public/uploads/business/photo';
    protected $module_upload_path_album     = 'public/uploads/profile/album';
    protected $module_upload_path_album_business     = 'public/uploads/business/album';
    protected $module_upload_path_photo_album_business     = 'public/uploads/business/photo';
    protected $module_upload_path_work      = 'public/uploads/profile/work';
    protected $module_upload_path_photo_post     = 'public/uploads/profile/post/photo';
    protected $module_upload_path_article_post     = 'public/uploads/profile/post/article';
    protected $module_upload_size           = array(
        'original'  => 1136,
        'thumbnail' => 160
    );

    public function __construct()
    {
        parent::__construct();
        $this->apps_breadcrumb[] = array(
            'title' => 'Dashboard',
            'link'  => base_url('mod_dashboard')
        );
        $this->csrf = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];

        $this->csrf_js = json_encode((object) [
            $this->security->get_csrf_token_name() => $this->security->get_csrf_hash(),
        ]);


    }

    protected function display($tpl_content = 'partials/default.php', $parameter_data = [], $tpl_footer = '')
    {
        $data = $parameter_data;

        /** Add default */
        $data['template_title']        = $this->apps_title_module . ' | ' . $this->apps_title;
        $data['template_title_module'] = $this->apps_title_module;
        $data['template_setting']      = $this->apps_setting;
        $data['template_breadcrumb']   = $this->apps_breadcrumb;
        $data['FILE_CSS']              = $this->file_css;
        $data['FILE_JS']               = $this->file_js;
        $data['CSRF_JSON']             = "&{$this->csrf['name']}={$this->csrf['hash']}";
        $data['CSRF_JS']               = $this->csrf_js;
        $page_partials                 = [
            'partials_meta_css'           => "{$this->module_portal}/partials/meta_css",
			'partials_meta_profile_seo'   => "{$this->module_portal}/partials/seo/meta_profile_seo",
			'partials_login_seo'   		  => "{$this->module_portal}/partials/seo/meta_login_seo",
            'partials_header'             => "{$this->module_portal}/partials/header",
            'partials_header_user'        => "{$this->module_portal}/partials/header_user",
            'partials_sidebar'            => "{$this->module_portal}/partials/sidebar",
            'partials_sidebar_dashboard'            => "{$this->module_portal}/partials/sidebars/sidebar_dashboard",
            'partials_sidebar_setting'    => "{$this->module_portal}/partials/sidebar_setting",
            'partials_sidebar_article'    => "{$this->module_portal}/partials/sidebar_article",
            'partials_sidebar_article_public'    => "{$this->module_portal}/partials/sidebar_article_public",
            'partials_sidebar_news_public'    => "{$this->module_portal}/partials/sidebar_news_public",
            'partials_sidebar_jobs'    => "{$this->module_portal}/partials/sidebar_jobs",
			'partials_sidebar_jobs_public'    => "{$this->module_portal}/partials/sidebar_jobs_public",
            'partials_sidebar_market'    => "{$this->module_portal}/partials/sidebars/market_list",
			'partials_sidebar_tender'    => "{$this->module_portal}/partials/sidebars/tender_list",
            'partials_sidebar_buys'    => "{$this->module_portal}/partials/sidebars/buys_list",
            'partials_sidebar_community'    => "{$this->module_portal}/partials/sidebars/community_list",
            'partials_sidebar_covid'    => "{$this->module_portal}/partials/sidebars/covid_list",
            'partials_sidebar_covid_public'    => "{$this->module_portal}/partials/sidebars/covid_list_public",
            'partials_sidebar_favourite'    => "{$this->module_portal}/partials/sidebars/favourite_list",
			'partials_sidebar_education'    => "{$this->module_portal}/partials/sidebars/education_list",
            'partials_sidebar_connection'    => "{$this->module_portal}/partials/sidebars/connection_list",
            'sidebar_user_about'    => "{$this->module_portal}/partials/sidebars/users/about",
			'sidebar_user_about_public'    => "{$this->module_portal}/partials/sidebars/users/about_public",
            'sidebar_user_profile'    => "{$this->module_portal}/partials/sidebars/users/profile",
            'partials_sidebar_ads'        => "{$this->module_portal}/partials/sidebar_ads",
            'partials_sidebar_business' => "{$this->module_portal}/partials/sidebars/business/list",
			'partials_sidebar_business_public' => "{$this->module_portal}/partials/sidebars/business/list_public",
            'partials_sidebar_pages' => "{$this->module_portal}/partials/sidebars/pages/list",
			'partials_sidebar_place' => "{$this->module_portal}/partials/sidebars/place/list",
			'sidebar_business_profile' => "{$this->module_portal}/partials/sidebars/business/profile",
            'sidebar_community_profile' => "{$this->module_portal}/partials/sidebars/community/profile",
            'partials_navbar'             => "{$this->module_portal}/partials/navbar",
            'partials_navbar_user'        => "{$this->module_portal}/partials/hero/user-profile",
			'partials_navbar_user_public'        => "{$this->module_portal}/partials/hero/user-profile_public",
            'partials_navbar_business'        => "{$this->module_portal}/partials/hero/business-profile",
			'partials_navbar_business_public'        => "{$this->module_portal}/partials/hero/business-profile-public",
            'partials_navbar_community'        => "{$this->module_portal}/partials/hero/community-profile",
            'partials_modal_user'         => "{$this->module_portal}/partials/modal_user",
            'partials_modal_album_photo'  => "{$this->module_portal}/partials/modal_album_photo",
            'partials_modal_album_photo_business'  => "{$this->module_portal}/partials/modals/business/modal_album_photo",
            'partials_modal_album_photo_community'  => "{$this->module_portal}/partials/modals/community/modal_album_photo",
            'partials_modal_album_photo_job' => "{$this->module_portal}/partials/modals/modal_album_photo_job",
            'partials_modal_post'         => "{$this->module_portal}/partials/modal_post",
            'partials_modal_post_community'         => "{$this->module_portal}/partials/modal_post_community",
            'partials_modal_comment_post' => "{$this->module_portal}/partials/modal_comment_post",
            'partials_modal_comment_post_business' => "{$this->module_portal}/partials/modal_comment_post_business",
            'partials_modal_comment_post_community' => "{$this->module_portal}/partials/modal_comment_post_community",
            'partials_modal_article'      => "{$this->module_portal}/partials/modal_article",
            'partials_modal_tender_delete'      => "{$this->module_portal}/partials/modal_tender",
            'partials_modal_job_delete'      => "{$this->module_portal}/partials/modal_job_delete",
            'partials_modal_buysells_delete'      => "{$this->module_portal}/partials/modal_buysells_delete",
            'partials_modal_product'      => "{$this->module_portal}/partials/modals/business/modal_product",
            'partials_modal_market_detail'      => "{$this->module_portal}/partials/modals/market/modal_product_detail",
			'partials_modal_tender_detail'      => "{$this->module_portal}/partials/modals/tender/modal_tender_detail",
            'partials_modal_tender'      => "{$this->module_portal}/partials/modals/tender/modal_tender",
			'partials_modal_jobs'      => "{$this->module_portal}/partials/modals/jobs/modal_jobs",
            'partials_modal_share'      => "{$this->module_portal}/partials/modal_share",
            'partial_user_post'           => "{$this->module_portal}/partials/user_post",
            'partial_user_post_dashboard' => "{$this->module_portal}/partials/user_post_dashboard",
            'partials_footer'             => "{$this->module_portal}/partials/footer",
            'partials_footer_script'      => "{$this->module_portal}/partials/script",
            'action_ajax_notify'         => "{$this->module_portal}/partials/action_ajax_notify",
            'action_ajax_profile'         => "{$this->module_portal}/partials/action_ajax_profile",
            'action_ajax_community'         => "{$this->module_portal}/partials/action_ajax_community",
            'action_ajax_album'         => "{$this->module_portal}/partials/action_ajax_album",
            'action_ajax_jobs'         => "{$this->module_portal}/partials/action_ajax_jobs",
            'action_ajax_business'         => "{$this->module_portal}/partials/action_ajax_business",
            'action_ajax_connection'         => "{$this->module_portal}/partials/action_ajax_connection",
            'action_ajax_covid'         => "{$this->module_portal}/partials/action_ajax_covid",
            'action_ajax_market' => "{$this->module_portal}/partials/action_ajax_market",
			'action_ajax_search' => "{$this->module_portal}/partials/action_ajax_search",
			'action_ajax_live_search' => "{$this->module_portal}/partials/action_ajax_live_search",
			'action_ajax_favourite' => "{$this->module_portal}/partials/action_ajax_favourite",
			'action_ajax_tender' => "{$this->module_portal}/partials/action_ajax_tender",
			'action_ajax_inbox'         => "{$this->module_portal}/partials/action_ajax_inbox",
			'partials_message'        => "{$this->module_portal}/partials/message/message",
			'partials_message_widget'        => "{$this->module_portal}/partials/message/message_widget",
			'partials_message_widget_chat'        => "{$this->module_portal}/partials/message/message_widget_chat",
			'partials_message_widget_chat_mobile'        => "{$this->module_portal}/partials/message/message_widget_chat_mobile",
			'page_content'                => $tpl_content,
            'partials_footer_script_page' => $tpl_footer,
            'partials_global'             => "{$this->module_global_view}/{$this->module_portal}",
            'partials_view'               => "{$this->module_portal}/{$this->module_base}",
            'partials_module_name'        => $this->module_base
        ];
        $data['template']              = $page_partials;

		//query
		$data['business_claim']	= $this->business_claim();
        $this->load->view('users/themes', $data);
    }
	
	protected function business_claim(){
		$business_username =  $this->uri->segment(3);
        $this->session->set_userdata('business_username',$business_username);
        $business          = $this->db->get_where('pbd_business',array('data_username'=>$business_username))->row();
		if(!empty($business)){
			$users_id =  !empty($_SESSION['user_id']);
			$CI = &get_instance();
			$CI->db->select('*');
			$CI->db->where('users_id',$users_id);
			$CI->db->where('business_id',$business->id);
			$CI->db->from('pbd_business_claims');
			$query = $CI->db->get();
			$data = $query->num_rows();
			return $data;
		}
	}

    protected function action_edit_process_cover(
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();

            $apps_title_action  = 'Edit';
            $apps_output_action = false;

            /** TRANSACT SQL for better Query Validation */
            $this->db->trans_start();

            $var_edit    = array();
            $var_edit_id = array();

            if (empty($parameter_id)) {
                $parameter_id = $this->input->post($this->module_table_id);
            }

                /**
                 * ----------------------------------------------------------------------------------------------------
                 * 2. VALIDATE DATA POST IF NOT EMPTY to SET VARIABLE ARRAY
                 * ----------------------------------------------------------------------------------------------------
                 */

                    /** add field for PRIMARY KEY ID */
                    $var_edit_id[$this->module_table_id] = $parameter_id;

                    /** Action process Add */

            $user_data = $this->db->get_where('users', array('id'=>$parameter_id))->row();
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                    $this->action_image_process_cover(
                        '__cover_files',
                        $this->module_table,
                        array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                        array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                        $this->module_upload_path_cover,
                        $this->module_upload_size
                    );

                    $this->apps_output_message = array(
                        'status'  => 'success',
                        'title'   => lang_text('message_edit_title_success'),
                        'message' => "{$this->apps_title_module} " . lang_text('message_edit_success')
                    );

            } else {
                $this->db->trans_rollback();
                $this->apps_output_message = array(
                    'status'  => 'error',
                    'title'   => lang_text('message_edit_title_failed'),
                    'message' => "{$this->apps_title_module} " . lang_text('message_edit_failed')
                );
            }

            if ($this->apps_output_message['status'] == 'error') {
                $this->module_url_default = $parameter_url_source;
            }

            if($this->input->post('name_first') == false){
                $this->set_output_action($this->module_url_default.'/'.$user_data->username);
            }
        }
    }

    protected function action_edit_process_photo(
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();

            $apps_title_action  = 'Edit';
            $apps_output_action = false;

            /** TRANSACT SQL for better Query Validation */
            $this->db->trans_start();

            $var_edit    = array();
            $var_edit_id = array();

            if (empty($parameter_id)) {
                $parameter_id = $this->input->post($this->module_table_id);
            }

			/**
			 * ----------------------------------------------------------------------------------------------------
			 * 2. VALIDATE DATA POST IF NOT EMPTY to SET VARIABLE ARRAY
			 * ----------------------------------------------------------------------------------------------------
			 */

			/** add field for PRIMARY KEY ID */
			$var_edit_id[$this->module_table_id] = $parameter_id;

			/** Action process Add */

            $user_data = $this->db->get_where('users', array('id'=>$parameter_id))->row();
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();

                    $this->action_image_process_photo(
                        '__photo_files',
                        $this->module_table,
                        array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                        array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                        $this->module_upload_path_photo,
                        $this->module_upload_size
                    );

                    $this->apps_output_message = array(
                        'status'  => 'success',
                        'title'   => lang_text('message_edit_title_success'),
                        'message' => "{$this->apps_title_module} " . lang_text('message_edit_success')
                    );

            } else {
                $this->db->trans_rollback();
                $this->apps_output_message = array(
                    'status'  => 'error',
                    'title'   => lang_text('message_edit_title_failed'),
                    'message' => "{$this->apps_title_module} " . lang_text('message_edit_failed')
                );
            }

            if ($this->apps_output_message['status'] == 'error') {
                $this->module_url_default = $parameter_url_source;
            }
            if($this->input->post('name_first') == false){
            $this->set_output_action($this->module_url_default.'/'.$user_data->username);
            }
        }
    }

    protected function action_edit_process_album(
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();

            $apps_title_action  = 'Edit';
            $apps_output_action = false;

            /** TRANSACT SQL for better Query Validation */
            $this->db->trans_start();

            $var_edit    = array();
            $var_edit_id = array();

            if (empty($parameter_id)) {
                $parameter_id = $this->input->post($this->module_table_id);
            }

                /**
                 * ----------------------------------------------------------------------------------------------------
                 * 2. VALIDATE DATA POST IF NOT EMPTY to SET VARIABLE ARRAY
                 * ----------------------------------------------------------------------------------------------------
                 */

                    /** add field for PRIMARY KEY ID */
                    $var_edit_id[$this->module_table_id] = $parameter_id;

                    /** Action process Add */
            $user_data = $this->db->get_where('users', array('id'=>$parameter_id))->row();
            $status = $this->input->post('status_form_albums');
            if(!empty($status)){
                $this->db->trans_complete();
                if ($this->db->trans_status() === TRUE) {
                    $this->db->trans_commit();

                        $this->action_image_process_album(
                            '__album_files',
                            $this->module_table,
                            array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                            array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                            $this->module_upload_path_album,
                            $this->module_upload_size
                        );

                        $this->apps_output_message = array(
                            'status'  => 'success',
                            'title'   => lang_text('message_edit_title_success'),
                            'message' => "{$this->apps_title_module} " . lang_text('message_edit_success')
                        );

                } else {
                    $this->db->trans_rollback();
                    $this->apps_output_message = array(
                        'status'  => 'error',
                        'title'   => lang_text('message_edit_title_failed'),
                        'message' => "{$this->apps_title_module} " . lang_text('message_edit_failed')
                    );
                }

                if ($this->apps_output_message['status'] == 'error') {
                    $this->module_url_default_photo = $parameter_url_source;
                }
                if($this->input->post('name_first') == false){
                $this->set_output_action($this->module_url_default_photo.'/'.$user_data->username);
                }
            }else{
                $this->set_output_action($this->module_url_default_photo.'/'.$user_data->username);
            }
        }
    }

    protected function action_edit_process_photo_album(
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();

            $apps_title_action  = 'Edit';
            $apps_output_action = false;

            /** TRANSACT SQL for better Query Validation */
            $this->db->trans_start();

            $var_edit    = array();
            $var_edit_id = array();

            if (empty($parameter_id)) {
                $parameter_id = $this->input->post($this->module_table_id);
            }

                /**
                 * ----------------------------------------------------------------------------------------------------
                 * 2. VALIDATE DATA POST IF NOT EMPTY to SET VARIABLE ARRAY
                 * ----------------------------------------------------------------------------------------------------
                 */

                    /** add field for PRIMARY KEY ID */
                    $var_edit_id[$this->module_table_id] = $parameter_id;

                    /** Action process Add */

            $user_data = $this->db->get_where('users', array('id'=>$parameter_id))->row();
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();

                    $this->action_image_process_photo_album(
                        '__photo_album_files',
                        $this->module_table,
                        array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                        array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                        $this->module_upload_path_album,
                        $this->module_upload_size
                    );

                    $this->apps_output_message = array(
                        'status'  => 'success',
                        'title'   => lang_text('message_edit_title_success'),
                        'message' => "{$this->apps_title_module} " . lang_text('message_edit_success')
                    );

            } else {
                $this->db->trans_rollback();
                $this->apps_output_message = array(
                    'status'  => 'error',
                    'title'   => lang_text('message_edit_title_failed'),
                    'message' => "{$this->apps_title_module} " . lang_text('message_edit_failed')
                );
            }

            if ($this->apps_output_message['status'] == 'error') {
                $this->module_url_default_photo = $parameter_url_source;
            }
            if($this->input->post('name_first') == false){
            $this->set_output_action($this->module_url_default_photo.'/'.$user_data->username);
            }
        }
    }

    protected function action_photo_post(
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();

            $apps_title_action  = 'Edit';
            $apps_output_action = false;

            /** TRANSACT SQL for better Query Validation */
            $this->db->trans_start();

            $var_edit    = array();
            $var_edit_id = array();

            $url = $this->input->post('form');

            if (empty($parameter_id)) {
                $parameter_id = $this->input->post($this->module_table_id);
            }

                /**
                 * ----------------------------------------------------------------------------------------------------
                 * 2. VALIDATE DATA POST IF NOT EMPTY to SET VARIABLE ARRAY
                 * ----------------------------------------------------------------------------------------------------
                 */

                    /** add field for PRIMARY KEY ID */
                    $var_edit_id[$this->module_table_id] = $parameter_id;

                    /** Action process Add */


            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                    $this->action_image_process_photo_post(
                        '__photo_post_files',
                        $this->module_table,
                        array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                        array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                        $this->module_upload_path_photo_post,
                        $this->module_upload_size
                    );

                    $this->apps_output_message = array(
                        'status'  => 'success',
                        'title'   => lang_text('message_edit_title_success'),
                        'message' => "{$this->apps_title_module} " . lang_text('message_edit_success')
                    );

            } else {
                $this->db->trans_rollback();
                $this->apps_output_message = array(
                    'status'  => 'error',
                    'title'   => lang_text('message_edit_title_failed'),
                    'message' => "{$this->apps_title_module} " . lang_text('message_edit_failed')
                );
            }
            $business_username = $this->input->post('business_username');
            $username     = $this->input->post('username');
            $user_id      = $this->input->post('id');
            $user = $this->db->get_where('users',array('id'=>$user_id))->row();
            if($business_username == 'undefined'){
                $username = $user->username;
            }else{
                $username = $business_username;
            }
            switch ($url) {
                case 'dashboard':
                    $this->set_output_action('user/'.$url);
                  break;
                case 'user/profile':
                    $this->set_output_action('post/'.$username);
                  break;
                default:
                $this->set_output_action($url.'/'.'post/'.$username);
            }

        }
    }

    protected function action_article_post(
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();

            $apps_title_action  = 'Edit';
            $apps_output_action = false;

            /** TRANSACT SQL for better Query Validation */
            $this->db->trans_start();

            $var_edit    = array();
            $var_edit_id = array();

            $url = $this->input->post('form');

            if (empty($parameter_id)) {
                $parameter_id = $this->input->post($this->module_table_id);
            }

                /**
                 * ----------------------------------------------------------------------------------------------------
                 * 2. VALIDATE DATA POST IF NOT EMPTY to SET VARIABLE ARRAY
                 * ----------------------------------------------------------------------------------------------------
                 */

                    /** add field for PRIMARY KEY ID */
                    $var_edit_id[$this->module_table_id] = $parameter_id;

                    /** Action process Add */


            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                    $this->action_image_process_artcile_post(
                        '__files',
                        $this->module_table,
                        array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                        array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                        $this->module_upload_path_article_post,
                        $this->module_upload_size
                    );

                    $this->apps_output_message = array(
                        'status'  => 'success',
                        'title'   => lang_text('message_edit_title_success'),
                        'message' => "{$this->apps_title_module} " . lang_text('message_edit_success')
                    );

            } else {
                $this->db->trans_rollback();
                $this->apps_output_message = array(
                    'status'  => 'error',
                    'title'   => lang_text('message_edit_title_failed'),
                    'message' => "{$this->apps_title_module} " . lang_text('message_edit_failed')
                );
            }

            if ($url == 'profile'){
                if ($this->apps_output_message['status'] == 'error') {
                    $this->module_url_default_photo_post_profile = $parameter_url_source;
                }

                if($this->input->post('name_first') == false){
                    $this->set_output_action($this->module_url_default_article);
                }
            }else{
                if ($this->apps_output_message['status'] == 'error') {
                    $this->module_url_default_article = $parameter_url_source;
                }

                if($this->input->post('name_first') == false){
                    $this->set_output_action($this->module_url_default_photo_post);
                }
            }
        }
    }

    protected function action_video_post(
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();

            $apps_title_action  = 'Edit';
            $apps_output_action = false;

            /** TRANSACT SQL for better Query Validation */
            $this->db->trans_start();

            $var_edit    = array();
            $var_edit_id = array();

            $url = $this->input->post('form');

            if (empty($parameter_id)) {
                $parameter_id = $this->input->post($this->module_table_id);
            }

                /**
                 * ----------------------------------------------------------------------------------------------------
                 * 2. VALIDATE DATA POST IF NOT EMPTY to SET VARIABLE ARRAY
                 * ----------------------------------------------------------------------------------------------------
                 */

                    /** add field for PRIMARY KEY ID */
                    $var_edit_id[$this->module_table_id] = $parameter_id;

                    /** Action process Add */


            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                    $this->action_image_process_video_post(
                        '__video_post_files',
                        $this->module_table,
                        array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                        array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                        $this->module_upload_path_photo_post,
                        $this->module_upload_size
                    );

                    $this->apps_output_message = array(
                        'status'  => 'success',
                        'title'   => lang_text('message_edit_title_success'),
                        'message' => "{$this->apps_title_module} " . lang_text('message_edit_success')
                    );

            } else {
                $this->db->trans_rollback();
                $this->apps_output_message = array(
                    'status'  => 'error',
                    'title'   => lang_text('message_edit_title_failed'),
                    'message' => "{$this->apps_title_module} " . lang_text('message_edit_failed')
                );
            }

            $business_username = $this->input->post('business_username');
            $username     = $this->input->post('username');
            $user_id      = $this->input->post('id');
            $user = $this->db->get_where('users',array('id'=>$user_id))->row();
            if($business_username == 'undefined'){
                $username = $user->username;
            }else{
                $username = $business_username;
            }
            switch ($url) {
                case 'dashboard':
                    $this->set_output_action('user/'.$url);
                  break;
                case 'user/profile':
                    $this->set_output_action('post/'.$username);
                  break;
                default:
                $this->set_output_action($url.'/'.'post/'.$username);
            }

        }
    }

    protected function action_work_experience(
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();

            $apps_title_action  = 'Edit';
            $apps_output_action = false;

            /** TRANSACT SQL for better Query Validation */
            $this->db->trans_start();

            $var_edit    = array();
            $var_edit_id = array();
            if (empty($parameter_id)) {
                $parameter_id = $this->input->post($this->module_table_id);
            }

                /**
                 * ----------------------------------------------------------------------------------------------------
                 * 2. VALIDATE DATA POST IF NOT EMPTY to SET VARIABLE ARRAY
                 * ----------------------------------------------------------------------------------------------------
                 */

                    /** add field for PRIMARY KEY ID */
                    $var_edit_id[$this->module_table_id] = $parameter_id;

                    /** Action process Add */


            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();

                    $this->action_image_process_work(
                        '__files',
                        $this->module_table,
                        array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                        array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                        $this->module_upload_path_work,
                        $this->module_upload_size
                    );

                    $this->apps_output_message = array(
                        'status'  => 'success',
                        'title'   => lang_text('message_edit_title_success'),
                        'message' => "{$this->apps_title_module} " . lang_text('message_edit_success')
                    );

            } else {
                $this->db->trans_rollback();
                $this->apps_output_message = array(
                    'status'  => 'error',
                    'title'   => lang_text('message_edit_title_failed'),
                    'message' => "{$this->apps_title_module} " . lang_text('message_edit_failed')
                );
            }

            if ($this->apps_output_message['status'] == 'error') {
                $this->module_url_default = $parameter_url_source;
            }
            // echo $parameter_url_source;
            // exit;
            $this->set_output_action($parameter_url_source);
        }
    }

    protected function action_image_process_cover(
        $parameter_upload_column_name = 'images',
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         * 1. Validate input file (multiple or not)
         * 2. Check file type for upload image
         * 3. Check process is new / update data image
         * 4. Process upload image and generate thumbnail
         * 5. Create record for succes image upload on server to database
         */

        $upload_column_name = '__cover_files';

        if (!empty($parameter_upload_column_name)) {
            $upload_column_name = $parameter_upload_column_name;

        }
        $this->load->helper(array('form', 'url'));

        if (!empty($_FILES[$upload_column_name]['name'])) {

            $var_upload_image = $this->action_image_process_upload_cover
            (
                $parameter_upload_column_name,
                $parameter_upload_table,
                $parameter_upload_table_key,
                $parameter_upload_table_related_key,
                $parameter_upload_destination,
                $parameter_upload_size_maximum
            );

            if (!empty($var_upload_image)) {

                if (!empty($var_upload_image['data']['add'])) {
                    if ($this->module_table == $parameter_upload_table) {

                        /** IF TABLE FILE UPLOAD IMAGE SAME AS MODULE TABLE , JUST UPDATE IT */
                        foreach ($var_upload_image['data']['add'] as $index => $row) {
                            $var_upload_image_id[$parameter_upload_table_key['id']] = $parameter_upload_table_key['value'];
                            unset($var_upload_image['data']['add'][$index][$parameter_upload_table_key['id']]);

                            $this->{$this->apps_model}->update_data($parameter_upload_table, $parameter_upload_table_key['id'], $var_upload_image_id, $var_upload_image['data']['add'][$index]);
                        }

                    } else {
                        $this->{$this->apps_model}->add_data_batch($parameter_upload_table, $var_upload_image['data']['add']);
                    }
                }

                if (!empty($var_upload_image['data']['edit'])) {
                    $this->{$this->apps_model}->update_data_batch($parameter_upload_table, $var_upload_image['data']['edit'], $parameter_upload_table_key);
                }

            }
        }
    }

    protected function action_image_process_photo(
        $parameter_upload_column_name = 'images',
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         * 1. Validate input file (multiple or not)
         * 2. Check file type for upload image
         * 3. Check process is new / update data image
         * 4. Process upload image and generate thumbnail
         * 5. Create record for succes image upload on server to database
         */

        $upload_column_name = '__photo_files';

        if (!empty($parameter_upload_column_name)) {
            $upload_column_name = $parameter_upload_column_name;

        }
        $this->load->helper(array('form', 'url'));

        if (!empty($_FILES[$upload_column_name]['name'])) {

            $var_upload_image = $this->action_image_process_upload_photo
            (
                $parameter_upload_column_name,
                $parameter_upload_table,
                $parameter_upload_table_key,
                $parameter_upload_table_related_key,
                $parameter_upload_destination,
                $parameter_upload_size_maximum
            );

            if (!empty($var_upload_image)) {

                if (!empty($var_upload_image['data']['add'])) {
                    if ($this->module_table == $parameter_upload_table) {

                        /** IF TABLE FILE UPLOAD IMAGE SAME AS MODULE TABLE , JUST UPDATE IT */
                        foreach ($var_upload_image['data']['add'] as $index => $row) {
                            $var_upload_image_id[$parameter_upload_table_key['id']] = $parameter_upload_table_key['value'];
                            unset($var_upload_image['data']['add'][$index][$parameter_upload_table_key['id']]);

                            $this->{$this->apps_model}->update_data($parameter_upload_table, $parameter_upload_table_key['id'], $var_upload_image_id, $var_upload_image['data']['add'][$index]);

                        }

                    } else {
                        $this->{$this->apps_model}->add_data_batch($parameter_upload_table, $var_upload_image['data']['add']);
                    }
                }

                if (!empty($var_upload_image['data']['edit'])) {
                    $this->{$this->apps_model}->update_data_batch($parameter_upload_table, $var_upload_image['data']['edit'], $parameter_upload_table_key);
                }

            }
        }
    }

    protected function action_image_process_album(
        $parameter_upload_column_name = 'images',
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         * 1. Validate input file (multiple or not)
         * 2. Check file type for upload image
         * 3. Check process is new / update data image
         * 4. Process upload image and generate thumbnail
         * 5. Create record for succes image upload on server to database
         */

        $upload_column_name = '__album_files';

        if (!empty($parameter_upload_column_name)) {
            $upload_column_name = $parameter_upload_column_name;

        }
        $this->load->helper(array('form', 'url'));

        if (!empty($_FILES[$upload_column_name]['name'])) {

            $var_upload_image = $this->action_image_process_upload_album
            (
                $parameter_upload_column_name,
                $parameter_upload_table,
                $parameter_upload_table_key,
                $parameter_upload_table_related_key,
                $parameter_upload_destination,
                $parameter_upload_size_maximum
            );

        }
    }

    protected function action_image_process_photo_album(
        $parameter_upload_column_name = 'images',
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         * 1. Validate input file (multiple or not)
         * 2. Check file type for upload image
         * 3. Check process is new / update data image
         * 4. Process upload image and generate thumbnail
         * 5. Create record for succes image upload on server to database
         */

        $upload_column_name = '__photo_album_files';

        if (!empty($parameter_upload_column_name)) {
            $upload_column_name = $parameter_upload_column_name;

        }
        $this->load->helper(array('form', 'url'));

        if (!empty($_FILES[$upload_column_name]['name'])) {

            $var_upload_image = $this->action_image_process_upload_photo_album
            (
                $parameter_upload_column_name,
                $parameter_upload_table,
                $parameter_upload_table_key,
                $parameter_upload_table_related_key,
                $parameter_upload_destination,
                $parameter_upload_size_maximum
            );

            if (!empty($var_upload_image)) {

                if (!empty($var_upload_image['data']['add'])) {
                    if ($this->module_table == $parameter_upload_table) {

                        /** IF TABLE FILE UPLOAD IMAGE SAME AS MODULE TABLE , JUST UPDATE IT */

                            $this->db->insert('users_albums', $var_upload_image);



                    } else {
                        $this->{$this->apps_model}->add_data_batch($parameter_upload_table, $var_upload_image['data']['add']);
                    }
                }

                if (!empty($var_upload_image['data']['edit'])) {
                    $this->{$this->apps_model}->update_data_batch($parameter_upload_table, $var_upload_image['data']['edit'], $parameter_upload_table_key);
                }

            }
        }
    }

    protected function action_image_process_work(
        $parameter_upload_column_name = 'images',
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         * 1. Validate input file (multiple or not)
         * 2. Check file type for upload image
         * 3. Check process is new / update data image
         * 4. Process upload image and generate thumbnail
         * 5. Create record for succes image upload on server to database
         */

        $upload_column_name = '__files';

        if (!empty($parameter_upload_column_name)) {
            $upload_column_name = $parameter_upload_column_name;

        }
        $this->load->helper(array('form', 'url'));

        if (!empty($_FILES[$upload_column_name]['name'])) {

            $var_upload_image = $this->action_image_process_upload_work
            (
                $parameter_upload_column_name,
                $parameter_upload_table,
                $parameter_upload_table_key,
                $parameter_upload_table_related_key,
                $parameter_upload_destination,
                $parameter_upload_size_maximum
            );

            $var_upload_image_code = json_encode($var_upload_image);
            $dados1 = json_encode(array('data'=>'1'));
            $dados2 = json_encode(array('data2'=>'2'));
            $parameter_id = $this->input->post('id');
            if (!empty($var_upload_image)) {

                if (!empty($var_upload_image['data']['add'])) {
                    if ($this->module_table == $parameter_upload_table) {
                        $this->db->where('users.id', $parameter_id);
                        $work['data_exp_work'] = json_encode(array_merge(json_decode($var_upload_image_code, true),json_decode($dados2, true)));
                        $this->db->update($parameter_upload_table, $work);
                    } else {
                        $this->db->where('users.id', $parameter_id);
                        $work['data_exp_work'] = json_encode(array_merge(json_decode($var_upload_image_code, true),json_decode($var_upload_image_code, true)));
                        $this->db->update($parameter_upload_table, $work);
                    }
                }

                if (!empty($var_upload_image['data']['edit'])) {
                    $this->db->where('users.id', $parameter_id);
                    $work['data_exp_work'] = json_encode(array_merge(json_decode($var_upload_image_code, true),json_decode($var_upload_image_code, true)));
                    $this->db->update($parameter_upload_table, $work);
                }

            }
        }
    }

    protected function action_image_process_photo_post(
        $parameter_upload_column_name = 'images',
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         * 1. Validate input file (multiple or not)
         * 2. Check file type for upload image
         * 3. Check process is new / update data image
         * 4. Process upload image and generate thumbnail
         * 5. Create record for succes image upload on server to database
         */

        $upload_column_name = '__photo_post_files';

        if (!empty($parameter_upload_column_name)) {
            $upload_column_name = $parameter_upload_column_name;

        }
        $this->load->helper(array('form', 'url'));
        $form_action = $this->input->post('form_action');
        if (!empty($_FILES[$upload_column_name]['name'])) {
            if ($form_action == 'edit'){
                $var_upload_image = $this->action_image_process_upload_photo_post_edit
                (
                    $parameter_upload_column_name,
                    $parameter_upload_table,
                    $parameter_upload_table_key,
                    $parameter_upload_table_related_key,
                    $parameter_upload_destination,
                    $parameter_upload_size_maximum
                );
            }else{
                $var_upload_image = $this->action_image_process_upload_photo_post
                (
                    $parameter_upload_column_name,
                    $parameter_upload_table,
                    $parameter_upload_table_key,
                    $parameter_upload_table_related_key,
                    $parameter_upload_destination,
                    $parameter_upload_size_maximum
                );
            }
        }
    }

    protected function action_image_process_artcile_post(
        $parameter_upload_column_name = 'images',
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         * 1. Validate input file (multiple or not)
         * 2. Check file type for upload image
         * 3. Check process is new / update data image
         * 4. Process upload image and generate thumbnail
         * 5. Create record for succes image upload on server to database
         */

        $upload_column_name = '__files';
        if (!empty($parameter_upload_column_name)) {
            $upload_column_name = $parameter_upload_column_name;

        }
        $this->load->helper(array('form', 'url'));
        $form_action = $this->input->post('form_action');
        if (!empty($_FILES[$upload_column_name]['name'])) {
                $var_upload_image = $this->action_image_process_upload_article_post
                (
                    $parameter_upload_column_name,
                    $parameter_upload_table,
                    $parameter_upload_table_key,
                    $parameter_upload_table_related_key,
                    $parameter_upload_destination,
                    $parameter_upload_size_maximum
                );

        }
    }

    protected function action_image_process_video_post(
        $parameter_upload_column_name = 'images',
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         * 1. Validate input file (multiple or not)
         * 2. Check file type for upload image
         * 3. Check process is new / update data image
         * 4. Process upload image and generate thumbnail
         * 5. Create record for succes image upload on server to database
         */
        $upload_column_name = '__video_post_files';

        if (!empty($parameter_upload_column_name)) {
            $upload_column_name = $parameter_upload_column_name;

        }
        $this->load->helper(array('form', 'url'));
        $form_action = $this->input->post('form_action');
            if ($form_action == 'edit'){
                $var_upload_image = $this->action_process_upload_video_post_edit();
            }else{
                $var_upload_image = $this->action_process_upload_video_post();
            }
    }

    private function action_image_process_upload_cover(
        $parameter_upload_column_name = null,
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         *  1. Process upload image to server
         *  2. validate file type and size
         *  3. create multiple file for other dimension proportional
         */

        $path_original  = $parameter_upload_destination;
        $path_thumbnail = $parameter_upload_destination . '/thumb';


        $this->load->library('image_upload_resize');
        $user_id = $this->input->post('id');

        $config["generate_image_file"]          = true;
        $config["generate_thumbnails"]          = true;
        $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
        $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
        $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
        $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["quality"]                      = 90;                                                            // JPEG QUALITY
        $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
        $config["upload_url"]                   = base_url($path_original) . '/';
        $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

        $config["file_data"]    = $_FILES[$parameter_upload_column_name];
        $upload_image_responses = $this->image_upload_resize->resize($config);

        try {
            $variable['add']  = null;
            $variable['edit'] = null;


            if (!empty($upload_image_responses['images'])) {
                foreach ($upload_image_responses["images"] as $index => $response) {
                    $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                    if ($response != '') {
                        if (!isset($output_editable[$index])) {
                            $variable['add'][$index] = [
                                $parameter_upload_table_related_key['id'] => $parameter_upload_table_related_key['value'],
                                $parameter_upload_table_key['id']         => $this->generate_new_id_string() . get_random_alphanumeric(5),
                                'cover_file_name_thumbnail'               => 'thumb_' . $response,
                                'cover_file_name_original'                => $response,
                                'cover_file_path'                         => $config["destination_folder"],
                                'cover_file_json'                         => func_encrypt(json_encode($_FILES)),
                                'created_by'                              => $user_id,
                                'created_at'                              => date('Y-m-d H:i:s'),
                                'updated_by'                              => $user_id,
                                'updated_at'                              => date('Y-m-d H:i:s')
                            ];
                        } else {
                            $variable['edit'][] = array(
                                $parameter_upload_table_related_key['id'] => $parameter_upload_table_related_key['value'],
                                $parameter_upload_table_key['id']         => $output_editable[$index],
                                'cover_file_name_thumbnail'               => 'thumb_' . $response,
                                'cover_file_name_original'                => $response,
                                'cover_file_path'                         => $config["destination_folder"],
                                'cover_file_json'                         => func_encrypt(json_encode($_FILES)),
                                'updated_by'                              => 1,
                                'updated_at'                              => date('Y-m-d H:i:s')
                            );
                        }
                    }
                }

            }

            $users_albums_id = $this->db->get_where('users_albums',["data_name" => 'Cover Photo',"users_id" => $_SESSION['user_id']])->row();
            $variable2 = [
                'id'                                => $this->generate_new_id_string() . get_random_alphanumeric(5),
                'users_id'                           => $_SESSION['user_id'],
                'users_albums_id'                   => $users_albums_id->id,
                'file_name_thumbnail'               => 'thumb_' . $response,
                'file_name_original'                => $response,
                'file_path'                         => $config["destination_folder"],
                'status'                            => 1,
                'published'                         => date('Y-m-d H:i:s'),
                'created_by'                        => $_SESSION['user_id'],
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_by'                        => $_SESSION['user_id'],
                'updated_at'                        => date('Y-m-d H:i:s')
            ];

            $this->db->insert('users_albums_photo', $variable2);
            $output['data']    = $variable;
            $output['status']  = true;
            $output['message'] = '';
        } catch (Exception $e) {
            $output['data']    = null;
            $output['status']  = false;
            $output['message'] = $e->getMessage();
        }

        return $output;
    }

    private function action_image_process_upload_photo(
        $parameter_upload_column_name = null,
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         *  1. Process upload image to server
         *  2. validate file type and size
         *  3. create multiple file for other dimension proportional
         */

        $path_original  = $parameter_upload_destination;
        $path_thumbnail = $parameter_upload_destination . '/thumb';


        $this->load->library('image_upload_resize');
        $user_id = $this->input->post('id');

        $config["generate_image_file"]          = true;
        $config["generate_thumbnails"]          = true;
        $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
        $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
        $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
        $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["quality"]                      = 90;                                                            // JPEG QUALITY
        $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
        $config["upload_url"]                   = base_url($path_original) . '/';
        $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

        $config["file_data"]    = $_FILES[$parameter_upload_column_name];
        $upload_image_responses = $this->image_upload_resize->resize($config);

        $parameter_id = $this->input->post('id');
        try {
            $variable['add']  = null;
            $variable['edit'] = null;


            if (!empty($upload_image_responses['images'])) {
                foreach ($upload_image_responses["images"] as $index => $response) {
                    $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                    if ($response != '') {
                        if (!isset($output_editable[$index])) {
                            $variable['add'][$index] = [
                                $parameter_upload_table_related_key['id'] => $parameter_upload_table_related_key['value'],
                                $parameter_upload_table_key['id']         => $this->generate_new_id_string() . get_random_alphanumeric(5),
                                'file_name_thumbnail'               => 'thumb_' . $response,
                                'file_name_original'                => $response,
                                'file_path'                         => $config["destination_folder"],
                                'file_json'                         => func_encrypt(json_encode($_FILES)),
                                'created_by'                        => $user_id,
                                'created_at'                        => date('Y-m-d H:i:s'),
                                'updated_by'                        => $user_id,
                                'updated_at'                        => date('Y-m-d H:i:s')
                            ];
                        } else {
                            $variable['edit'][] = array(
                                $parameter_upload_table_related_key['id'] => $parameter_upload_table_related_key['value'],
                                $parameter_upload_table_key['id']         => $output_editable[$index],
                                'file_name_thumbnail'               => 'thumb_' . $response,
                                'file_name_original'                => $response,
                                'file_path'                         => $config["destination_folder"],
                                'file_json'                         => func_encrypt(json_encode($_FILES)),
                                'updated_by'                        => 1,
                                'updated_at'                        => date('Y-m-d H:i:s')
                            );
                        }
                    }
                }

            }

            $users_albums_id = $this->db->get_where('users_albums',["data_name" => 'Profile Photo',"users_id" => $_SESSION['user_id']])->row();
            $variable2 = [
                'id'                                => $this->generate_new_id_string() . get_random_alphanumeric(5),
                'users_id'                           => $_SESSION['user_id'],
                'users_albums_id'                   => $users_albums_id->id,
                'file_name_thumbnail'               => 'thumb_' . $response,
                'file_name_original'                => $response,
                'file_path'                         => $config["destination_folder"],
                'status'                            => 1,
                'published'                         => date('Y-m-d H:i:s'),
                'created_by'                        => $_SESSION['user_id'],
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_by'                        => $_SESSION['user_id'],
                'updated_at'                        => date('Y-m-d H:i:s')
            ];

            $this->db->insert('users_albums_photo', $variable2);
            $output['data']    = $variable;
            $output['status']  = true;
            $output['message'] = '';
        } catch (Exception $e) {
            $output['data']    = null;
            $output['status']  = false;
            $output['message'] = $e->getMessage();
        }

        return $output;
    }

    private function action_image_process_upload_album(
        $parameter_upload_column_name = null,
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         *  1. Process upload image to server
         *  2. validate file type and size
         *  3. create multiple file for other dimension proportional
         */
        $path_original  = $parameter_upload_destination;
        $path_thumbnail = $parameter_upload_destination . '/thumb';


        $this->load->library('image_upload_resize');
        $user_id = $this->input->post('id');

        $config["generate_image_file"]          = true;
        $config["generate_thumbnails"]          = true;
        $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
        $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
        $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
        $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["quality"]                      = 90;                                                            // JPEG QUALITY
        $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
        $config["upload_url"]                   = base_url($path_original) . '/';
        $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

        $config["file_data"]    = $_FILES[$parameter_upload_column_name];
        $upload_image_responses = $this->image_upload_resize->resize($config);

        $parameter_id = $this->input->post('id');
        $name_album = $this->input->post('name');
        try {
            $variable['add']  = null;
            $variable['edit'] = null;


            if (!empty($upload_image_responses['images'])) {
                foreach ($upload_image_responses["images"] as $index => $response) {
                    $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                    if ($response != '') {
                        if (!isset($output_editable[$index])) {
                            $variable_albums= [
                                $parameter_upload_table_key['id']   => $this->generate_new_id_string() . get_random_alphanumeric(5),
                                'users_id'                          => $parameter_id,
                                'data_name'                         => $name_album,
                                'users_albums_categories_id'        => 2,
                                'file_name_thumbnail'               => 'thumb_' . $response,
                                'file_name_original'                => $response,
                                'file_path'                         => $config["destination_folder"],
                                'file_json'                         => func_encrypt(json_encode($_FILES)),
                                'created_by'                        => $user_id,
                                'created_at'                        => date('Y-m-d H:i:s'),
                                'updated_by'                        => $user_id,
                                'updated_at'                        => date('Y-m-d H:i:s')
                            ];
                        } else {
                            $variable_albums = array(
                                $parameter_upload_table_key['id']   => $output_editable[$index],
                                'users_id'                          => $parameter_id,
                                'users_albums_categories_id'        => 2,
                                'data_name'                         => $name_album,
                                'file_name_thumbnail'               => 'thumb_' . $response,
                                'file_name_original'                => $response,
                                'file_path'                         => $config["destination_folder"],
                                'file_json'                         => func_encrypt(json_encode($_FILES)),
                                'updated_by'                        => 1,
                                'updated_at'                        => date('Y-m-d H:i:s')
                            );
                        }
                    }
                }

            }
            $this->db->insert('users_albums',  $variable_albums );
            $output['data']    = $variable;
            $output['status']  = true;
            $output['message'] = '';
        } catch (Exception $e) {
            $output['data']    = null;
            $output['status']  = false;
            $output['message'] = $e->getMessage();
        }

        return $output;
    }

    private function action_image_process_upload_photo_album(
        $parameter_upload_column_name = null,
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {
        /**
         *  1. Process upload image to server
         *  2. validate file type and size
         *  3. create multiple file for other dimension proportional
         */
        $path_original  = $parameter_upload_destination;
        $path_thumbnail = $parameter_upload_destination . '/thumb';


        $this->load->library('image_upload_resize');
        $user_id = $this->input->post('id');

        $config["generate_image_file"]          = true;
        $config["generate_thumbnails"]          = true;
        $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
        $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
        $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
        $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["quality"]                      = 90;                                                            // JPEG QUALITY
        $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
        $config["upload_url"]                   = base_url($path_original) . '/';
        $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

        $config["file_data"]    = $_FILES[$parameter_upload_column_name];
        $upload_image_responses = $this->image_upload_resize->resize($config);

        $parameter_id = $this->input->post('id');
        $album = $this->input->post('album');
        $caption = $this->input->post('caption');
        try {
            $variable['add']  = null;
            $variable['edit'] = null;


            if (!empty($upload_image_responses['images'])) {
                foreach ($upload_image_responses["images"] as $index => $response) {
                    $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                    if ($response != '') {
                        $countfiles = count($_FILES['__photo_album_files']['name']);
                        for($i=0;$i<$countfiles;$i++){
                            $variable_albums_photo= [
                                $parameter_upload_table_key['id']   => $this->generate_new_id_string() . get_random_alphanumeric(5),
                                'users_id'                          => $parameter_id,
                                'users_albums_id'                   => $album,
                                'file_caption'                      => $caption,
                                'file_name_thumbnail'               => 'thumb_' . $response,
                                'file_name_original'                => $response,
                                'file_path'                         => $config["destination_folder"],
                                'created_by'                        => $user_id,
                                'created_at'                        => date('Y-m-d H:i:s'),
                                'updated_by'                        => $user_id,
                                'updated_at'                        => date('Y-m-d H:i:s')
                            ];

                        }

                        $this->db->insert('users_albums_photo',  $variable_albums_photo );
                    }
                }

            }
            $output['data']    = $variable;
            $output['status']  = true;
            $output['message'] = '';
        } catch (Exception $e) {
            $output['data']    = null;
            $output['status']  = false;
            $output['message'] = $e->getMessage();
        }

        return $output;
    }


    private function action_image_process_upload_work(
        $parameter_upload_column_name = null,
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         *  1. Process upload image to server
         *  2. validate file type and size
         *  3. create multiple file for other dimension proportional
         */

        $path_original  = $parameter_upload_destination;
        $path_thumbnail = $parameter_upload_destination . '/thumb';

        $pecialization  = $this->input->post('specialization');
        $company        = $this->input->post('company');
        $start_year     = $this->input->post('start_year');
        $start_month    = $this->input->post('start_month');
        $end_year       = $this->input->post('end_year');
        $end_month      = $this->input->post('end_month');

        $user_id = $this->input->post('id');

        $this->load->library('image_upload_resize');

        $config["generate_image_file"]          = true;
        $config["generate_thumbnails"]          = true;
        $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
        $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
        $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
        $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["quality"]                      = 90;                                                            // JPEG QUALITY
        $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
        $config["upload_url"]                   = base_url($path_original) . '/';
        $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

        $config["file_data"]    = $_FILES[$parameter_upload_column_name];
        $upload_image_responses = $this->image_upload_resize->resize($config);


        try {
            $variable['add']  = null;
            $variable['edit'] = null;


            if (!empty($upload_image_responses['images'])) {
                foreach ($upload_image_responses["images"] as $index => $response) {
                    $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                    if ($response != '') {
                        if (!isset($output_editable[$index])) {
                            $variable['add'][$index] = [
                                $parameter_upload_table_related_key['id'] => $parameter_upload_table_related_key['value'],
                                $parameter_upload_table_key['id']         => $this->generate_new_id_string() . get_random_alphanumeric(5),
                                'file_name_thumbnail'               => 'thumb_' . $response,
                                'file_name_original'                => $response,
                                'file_path'                         => $config["destination_folder"],
                                'specialization'                    => $pecialization,
                                'company'                           => $company,
                                'start_year'                        => $start_year,
                                'start_month'                       => $start_month,
                                'end_year'                          => $end_year,
                                'end_month'                         => $end_month,
                                'file_json'                         => func_encrypt(json_encode($_FILES)),
                                'created_by'                        => $user_id,
                                'created_at'                        => date('Y-m-d H:i:s'),
                                'updated_by'                        => $user_id,
                                'updated_at'                        => date('Y-m-d H:i:s')
                            ];
                        } else {
                            $variable['edit'][] = array(
                                $parameter_upload_table_related_key['id'] => $parameter_upload_table_related_key['value'],
                                $parameter_upload_table_key['id']         => $output_editable[$index],
                                'file_name_thumbnail'               => 'thumb_' . $response,
                                'file_name_original'                => $response,
                                'file_path'                         => $config["destination_folder"],
                                'file_json'                         => func_encrypt(json_encode($_FILES)),
                                'updated_by'                        => $user_id,
                                'updated_at'                        => date('Y-m-d H:i:s')
                            );
                        }
                    }
                }

            }

            $output['data']    = $variable;
            $output['status']  = true;
            $output['message'] = '';
        } catch (Exception $e) {
            $output['data']    = null;
            $output['status']  = false;
            $output['message'] = $e->getMessage();
        }

        return $output;
    }

    private function action_image_process_upload_photo_post(
        $parameter_upload_column_name = null,
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         *  1. Process upload image to server
         *  2. validate file type and size
         *  3. create multiple file for other dimension proportional
         */
        $path_original  = $parameter_upload_destination;
        $path_thumbnail = $parameter_upload_destination . '/thumb';

        $user_id  = $this->input->post('id');
        $business_id  = $this->input->post('business_id');
        $data_description   = $this->input->post('data_description');
        $image_url    = $this->input->post('image-url');
        $url = $this->input->post('form');
        $business_username = $this->input->post('business_username');
        $username     = $this->input->post('username');
        $user = $this->db->get_where('users',array('id'=>$user_id))->row();
        $this->load->library('image_upload_resize');

        $config["generate_image_file"]          = true;
        $config["generate_thumbnails"]          = true;
        $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
        $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
        $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
        $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["quality"]                      = 90;                                                            // JPEG QUALITY
        $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
        $config["upload_url"]                   = base_url($path_original) . '/';
        $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

        $config["file_data"]    = $_FILES[$parameter_upload_column_name];
        $upload_image_responses = $this->image_upload_resize->resize($config);

        foreach ($upload_image_responses["images"] as $index => $response) {
            if(empty($image_url) && empty($response)){
                if($business_username == 'undefined'){
                    $username = $user->username;
                }else{
                    $username = $business_username;
                }
                switch ($url) {
                    case 'dashboard':
                        $this->set_output_action('user/'.$url);
                    break;
                    case 'user/profile':
                        $this->set_output_action('post/'.$username);
                    break;
                    default:
                    $this->set_output_action($url.'/'.'post/'.$username);
                }
            }
        }
        if(empty($image_url)){
        try {
            $variable['add']  = null;
            $variable['edit'] = null;


            if (!empty($upload_image_responses['images'])) {
                foreach ($upload_image_responses["images"] as $index => $response) {
                    $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                    if ($response != '') {
                        if (!isset($output_editable[$index])) {
                            $variable= [
                                'id'                                      => $this->generate_new_id_string() . get_random_alphanumeric(5),
                                'parent'                                  => 0,
                                'users_id'                                => $user_id,
                                'pbd_business_id'                         => $business_id,
                                'data_description'                        => $data_description,
                                'file_image_name_thumbnail'               => 'thumb_' . $response,
                                'file_image_name_original'                => $response,
                                'file_image_path'                         => $config["destination_folder"],
                                'published'                               => date('Y-m-d H:i:s'),
                                'created_by'                              => $user_id,
                                'created_at'                              => date('Y-m-d H:i:s'),
                                'updated_by'                              => $user_id,
                                'updated_at'                              => date('Y-m-d H:i:s')
                            ];
                        } else {
                            $variable = array(
                                'parent'                                  => 0,
                                'user_id'                                 => $user_id,
                                'pbd_business_id'                         => $business_id,
                                'data_description'                        => $data_description,
                                'file_image_name_thumbnail'               => 'thumb_' . $response,
                                'file_image_name_original'                => $response,
                                'file_image_path'                         => $config["destination_folder"],
                                'published'                               => date('Y-m-d H:i:s'),
                                'created_by'                              => $user_id,
                                'created_at'                              => date('Y-m-d H:i:s'),
                                'updated_by'                              => $user_id,
                                'updated_at'                              => date('Y-m-d H:i:s')
                            );
                        }
                    }
                }

            }
            $this->db->insert('pfe_posts',  $variable );
            $output['data']    = $variable;
            $output['status']  = true;
            $output['message'] = '';
            } catch (Exception $e) {
                $output['data']    = null;
                $output['status']  = false;
                $output['message'] = $e->getMessage();
            }
            return $output;
        }else{
            $variable= [
                'id'                                      => $this->generate_new_id_string() . get_random_alphanumeric(5),
                'parent'                                  => 0,
                'users_id'                                => $user_id,
                'pbd_business_id'                         => $business_id,
                'data_description'                        => $data_description,
                'file_image_url'                          => $image_url,
                'published'                               => date('Y-m-d H:i:s'),
                'created_by'                              => $user_id,
                'created_at'                              => date('Y-m-d H:i:s'),
                'updated_by'                              => $user_id,
                'updated_at'                              => date('Y-m-d H:i:s')
                ];

                $this->db->insert('pfe_posts',  $variable );
                if($business_username == 'undefined'){
                    $username = $user->username;
                }else{
                    $username = $business_username;
                }
                switch ($url) {
                    case 'dashboard':
                        $this->set_output_action('user/'.$url);
                      break;
                    case 'user/profile':
                        $this->set_output_action('post/'.$username);
                      break;
                    default:
                    $this->set_output_action($url.'/'.'post/'.$username);
                }

        }
    }

    private function action_image_process_upload_article_post(
        $parameter_upload_column_name = null,
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         *  1. Process upload image to server
         *  2. validate file type and size
         *  3. create multiple file for other dimension proportional
         */
        $path_original  = $parameter_upload_destination;
        $path_thumbnail = $parameter_upload_destination . '/thumb';


        $article_id = $this->input->post('article_id');
        $user_id  = $this->input->post('id');
        $business_id = $this->input->post('select_business_id');
        $title  = $this->input->post('title');
        $category  = $this->input->post('category');
        $description  = $this->input->post('contents');
        $action = $this->input->post('action');
        $this->load->library('image_upload_resize');
        $config["generate_image_file"]          = true;
        $config["generate_thumbnails"]          = true;
        $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
        $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
        $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
        $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["quality"]                      = 90;                                                            // JPEG QUALITY
        $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
        $config["upload_url"]                   = base_url($path_original) . '/';
        $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

        $config["file_data"]    = $_FILES[$parameter_upload_column_name];
        $upload_image_responses = $this->image_upload_resize->resize($config);

        $check_category = $this->db->get_where('pfe_articles_categories', array('id'=>$category));

        if($check_category->num_rows() < 1){
            $post['id']          = random_string('alnum',20);
            $post['data_name']   = $category;
            $post['published']   = date('Y-m-d H:i:s');
            $post['status']      = 1;
            $post['created_by']  = $_SESSION['user_id'];
            $post['created_at']  = date('Y-m-d H:i:s');
            $post['updated_by']  = $_SESSION['user_id'];
            $post['updated_at']  = date('Y-m-d H:i:s');
            $this->db->insert('pfe_articles_categories', $post);
        }
        if($check_category->num_rows() < 1){
            $category_id = $post['id'];
        }else{
            $category_id = $category;
        }
        try {


            if (!empty($upload_image_responses['images'])) {
                foreach ($upload_image_responses["images"] as $index => $response) {
                    if (!empty($response)) {
                    $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                    if($action == 'edit'){
                        if (!isset($output_editable[$index])) {
                            $variable = [
                                'users_id'                                => $user_id,
                                'pbd_business_id'                         => $business_id,
                                'data_name'                               => $title,
                                'data_categories'                         => $category_id,
                                'data_description'                        => $description,
                                'file_name_thumbnail'                     => 'thumb_' . $response,
                                'file_name_original'                      => $response,
                                'file_path'                               => $config["destination_folder"],
                                'published'                               => date('Y-m-d H:i:s'),
                                'status'                                  => 1,
                                'created_by'                              => $user_id,
                                'created_at'                              => date('Y-m-d H:i:s'),
                                'updated_by'                              => $user_id,
                                'updated_at'                              => date('Y-m-d H:i:s')
                            ];
                            $this->db->where('pfe_articles.id', $article_id);
                            $this->db->update('pfe_articles', $variable);
                        }
                    }else{
                        if (!isset($output_editable[$index])) {
                            $variable= [
                                'id'                                      => $this->generate_new_id_string() . get_random_alphanumeric(5),
                                'users_id'                                => $user_id,
                                'pbd_business_id'                         => $business_id,
                                'data_name'                               => $title,
                                'data_categories'                         => $category_id,
                                'data_description'                        => $description,
                                'file_name_thumbnail'                     => 'thumb_' . $response,
                                'file_name_original'                      => $response,
                                'file_path'                               => $config["destination_folder"],
                                'published'                               => date('Y-m-d H:i:s'),
                                'status'                                  => 1,
                                'created_by'                              => $user_id,
                                'created_at'                              => date('Y-m-d H:i:s'),
                                'updated_by'                              => $user_id,
                                'updated_at'                              => date('Y-m-d H:i:s')
                            ];
                            $this->db->insert('pfe_articles',  $variable );
                        }
                    }
                }else{
                    if($action == 'edit'){
                        $variable= [
                            'users_id'                                => $user_id,
                            'pbd_business_id'                         => $business_id,
                            'data_name'                               => $title,
                            'data_categories'                         => $category_id,
                            'data_description'                        => $description,
                            'published'                               => date('Y-m-d H:i:s'),
                            'created_by'                              => $user_id,
                            'created_at'                              => date('Y-m-d H:i:s'),
                            'updated_by'                              => $user_id,
                            'updated_at'                              => date('Y-m-d H:i:s')
                        ];
                        $this->db->where('pfe_articles.id', $article_id);
                        $this->db->update('pfe_articles', $variable);
                    }else{
                        $variable= [
                            'id'                                      => $this->generate_new_id_string() . get_random_alphanumeric(5),
                            'users_id'                                => $user_id,
                            'pbd_business_id'                         => $business_id,
                            'data_name'                               => $title,
                            'data_categories'                         => $category_id,
                            'data_description'                        => $description,
                            'published'                               => date('Y-m-d H:i:s'),
                            'created_by'                              => $user_id,
                            'created_at'                              => date('Y-m-d H:i:s'),
                            'updated_by'                              => $user_id,
                            'updated_at'                              => date('Y-m-d H:i:s')
                        ];
                        $this->db->insert('pfe_articles',  $variable );
                    }
                }
            }
            }
            $output['data']    = $variable;
            $output['status']  = true;
            $output['message'] = '';
        } catch (Exception $e) {
            $output['data']    = null;
            $output['status']  = false;
            $output['message'] = $e->getMessage();
        }

        return $output;
    }

    private function action_image_process_upload_photo_post_edit(
        $parameter_upload_column_name = null,
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         *  1. Process upload image to server
         *  2. validate file type and size
         *  3. create multiple file for other dimension proportional
         */
        $path_original  = $parameter_upload_destination;
        $path_thumbnail = $parameter_upload_destination . '/thumb';

        $user_id  = $this->input->post('id');
        $post_photo_id = $this->input->post('post_photo_id');
        $data_description = $this->input->post('data_description');
        $image_url    = $this->input->post('image-url');
        $url = $this->input->post('form');
        $business_username = $this->input->post('business_username');
        $username     = $this->input->post('username');
        $user = $this->db->get_where('users',array('id'=>$user_id))->row();
        $this->load->library('image_upload_resize');

        $config["generate_image_file"]          = true;
        $config["generate_thumbnails"]          = true;
        $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
        $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
        $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
        $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["quality"]                      = 90;                                                            // JPEG QUALITY
        $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
        $config["upload_url"]                   = base_url($path_original) . '/';
        $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

        $config["file_data"]    = $_FILES[$parameter_upload_column_name];
        $upload_image_responses = $this->image_upload_resize->resize($config);
        foreach ($upload_image_responses["images"] as $index => $response) {
            if(empty($image_url) && empty($response)){
                if($business_username == 'undefined'){
                    $username = $user->username;
                }else{
                    $username = $business_username;
                }
                switch ($url) {
                    case 'dashboard':
                        $this->set_output_action('user/'.$url);
                    break;
                    case 'user/profile':
                        $this->set_output_action('post/'.$username);
                    break;
                    default:
                    $this->set_output_action($url.'/'.'post/'.$username);
                }
            }
        }
        if(empty($image_url)){
        try {
            $variable['add']  = null;
            $variable['edit'] = null;


            if (!empty($upload_image_responses['images'])) {
                foreach ($upload_image_responses["images"] as $index => $response) {
                    $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                    if ($response != '') {
                        if (!isset($output_editable[$index])) {
                            $variable= [
                                'parent'                                  => 0,
                                'users_id'                                => $user_id,
                                'data_description'                        => $data_description,
                                'file_image_name_thumbnail'               => 'thumb_' . $response,
                                'file_image_name_original'                => $response,
                                'file_image_path'                         => $config["destination_folder"],
                                'file_image_url'                          => null,
                                'published'                               => date('Y-m-d H:i:s'),
                                'created_by'                              => $user_id,
                                'created_at'                              => date('Y-m-d H:i:s'),
                                'updated_by'                              => $user_id,
                                'updated_at'                              => date('Y-m-d H:i:s')
                            ];
                        } else {
                            $variable = array(
                                'parent'                                  => 0,
                                'users_id'                                 => $user_id,
                                'data_description'                        => $data_description,
                                'file_image_name_thumbnail'               => 'thumb_' . $response,
                                'file_image_name_original'                => $response,
                                'file_image_url'                          => null,
                                'file_image_path'                         => $config["destination_folder"],
                                'published'                               => date('Y-m-d H:i:s'),
                                'created_by'                              => $user_id,
                                'created_at'                              => date('Y-m-d H:i:s'),
                                'updated_by'                              => $user_id,
                                'updated_at'                              => date('Y-m-d H:i:s')
                            );
                        }
                    }
                }

            }
            $this->db->where('pfe_posts.id',$post_photo_id);
            $this->db->update('pfe_posts', $variable);
            $output['data']    = $variable;
            $output['status']  = true;
            $output['message'] = '';
            } catch (Exception $e) {
                $output['data']    = null;
                $output['status']  = false;
                $output['message'] = $e->getMessage();
            }
            return $output;
        }else{
            $variable = array(
                'parent'                                  => 0,
                'users_id'                                 => $user_id,
                'data_description'                        => $data_description,
                'file_image_name_thumbnail'               => null,
                'file_image_name_original'                => null,
                'file_image_path'                         => null,
                'file_image_url'                         => $image_url,
                'published'                               => date('Y-m-d H:i:s'),
                'created_by'                              => $user_id,
                'created_at'                              => date('Y-m-d H:i:s'),
                'updated_by'                              => $user_id,
                'updated_at'                              => date('Y-m-d H:i:s')
            );
            $this->db->where('pfe_posts.id',$post_photo_id);
            $this->db->update('pfe_posts', $variable);
            if($business_username == 'undefined'){
                $username = $user->username;
            }else{
                $username = $business_username;
            }
            switch ($url) {
                case 'dashboard':
                    $this->set_output_action('user/'.$url);
                  break;
                case 'user/profile':
                    $this->set_output_action('post/'.$username);
                  break;
                default:
                $this->set_output_action($url.'/'.'post/'.$username);
            }
        }
    }

    private function action_process_upload_video_post(
        $parameter_upload_column_name = null,
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         *  1. Process upload image to server
         *  2. validate file type and size
         *  3. create multiple file for other dimension proportional
         */
        $path_original  = $parameter_upload_destination;
        $data_description = $this->input->post('data_description');
        $video_url      = $this->input->post('video-url');
        if(empty($video_url)){
            if (isset($_FILES['__video_post_files']['name']) && $_FILES['__video_post_files']['name'] != '') {
                $user_id  = $this->input->post('id');
                $business_id = $this->input->post('business_id');
                unset($config);
                $date = date("ymd");
                $configVideo['upload_path'] = 'public/uploads/profile/post/video';
                $configVideo['max_size'] = '60000';
                $configVideo['allowed_types'] = 'avi|flv|wmv|mp3|mp4';
                $configVideo['overwrite'] = FALSE;
                $configVideo['remove_spaces'] = TRUE;
                $video_name = $date.$_FILES['__video_post_files']['name'];
                $configVideo['file_name'] = $video_name;

                $this->load->library('upload', $configVideo);
                $this->upload->initialize($configVideo);
                    $variable = array();

                    if($this->upload->do_upload('__video_post_files')) {
                        $variable= [
                            'id'                                      => $this->generate_new_id_string() . get_random_alphanumeric(5),
                            'parent'                                  => 0,
                            'users_id'                                => $user_id,
                            'pbd_business_id'                         => $business_id,
                            'data_description'                        => $data_description,
                            'file_video_name'                         => $configVideo['file_name'],
                            'file_video_path'                         => $configVideo['upload_path'],
                            'published'                               => date('Y-m-d H:i:s'),
                            'created_by'                              => $user_id,
                            'created_at'                              => date('Y-m-d H:i:s'),
                            'updated_by'                              => $user_id,
                            'updated_at'                              => date('Y-m-d H:i:s')
                        ];

                    }
                    $this->db->insert('pfe_posts',  $variable );
                    $output['data']    = $variable;
                    $output['status']  = true;
                    $output['message'] = '';

            }

            return $output;
        }else{
            $user_id  = $this->input->post('id');
            $business_id = $this->input->post('business_id');
            unset($config);
            $variable= [
                'id'                                      => $this->generate_new_id_string() . get_random_alphanumeric(5),
                'parent'                                  => 0,
                'users_id'                                => $user_id,
                'pbd_business_id'                         => $business_id,
                'data_description'                        => $data_description,
                'file_video_url'                          => $video_url,
                'published'                               => date('Y-m-d H:i:s'),
                'created_by'                              => $user_id,
                'created_at'                              => date('Y-m-d H:i:s'),
                'updated_by'                              => $user_id,
                'updated_at'                              => date('Y-m-d H:i:s')
            ];
            $this->db->insert('pfe_posts',  $variable );
        }

    }

    private function action_process_upload_video_post_edit(
        $parameter_upload_column_name = null,
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         *  1. Process upload image to server
         *  2. validate file type and size
         *  3. create multiple file for other dimension proportional
         */
        $path_original  = $parameter_upload_destination;
        $data_description = $this->input->post('data_description');
        $video_url      = $this->input->post('video-url');
        $url = $this->input->post('form');
        if(empty($video_url)){
            if (isset($_FILES['__video_post_files']['name']) && $_FILES['__video_post_files']['name'] != '') {
                $user_id  = $this->input->post('id');
                $post_video_id = $this->input->post('post_video_id');
                unset($config);
                $date = date("ymd");
                $configVideo['upload_path'] = 'public/uploads/profile/post/video';
                $configVideo['max_size'] = '60000';
                $configVideo['allowed_types'] = 'avi|flv|wmv|mp3|mp4';
                $configVideo['overwrite'] = FALSE;
                $configVideo['remove_spaces'] = TRUE;
                $video_name = $date.$_FILES['__video_post_files']['name'];
                $configVideo['file_name'] = $video_name;

                $this->load->library('upload', $configVideo);
                $this->upload->initialize($configVideo);
                    $variable = array();

                    if($this->upload->do_upload('__video_post_files')) {
                        $variable= [
                            'parent'                                  => 0,
                            'users_id'                                => $user_id,
                            'data_description'                        => $data_description,
                            'file_video_name'                         => $configVideo['file_name'],
                            'file_video_path'                         => $configVideo['upload_path'],
                            'published'                               => date('Y-m-d H:i:s'),
                            'created_by'                              => $user_id,
                            'created_at'                              => date('Y-m-d H:i:s'),
                            'updated_by'                              => $user_id,
                            'updated_at'                              => date('Y-m-d H:i:s')
                        ];

                    }
                    $this->db->where('pfe_posts.id', $post_video_id);
                    $this->db->update('pfe_posts',  $variable );
                    $output['data']    = $variable;
                    $output['status']  = true;
                    $output['message'] = '';

            }

            return $output;
        }else{
            $user_id  = $this->input->post('id');
            $post_video_id = $this->input->post('post_video_id');
            $variable= [
                'parent'                                  => 0,
                'users_id'                                => $user_id,
                'data_description'                        => $data_description,
                'file_video_name'                         => null,
                'file_video_path'                         => null,
                'file_video_url'                          => $video_url,
                'published'                               => date('Y-m-d H:i:s'),
                'created_by'                              => $user_id,
                'created_at'                              => date('Y-m-d H:i:s'),
                'updated_by'                              => $user_id,
                'updated_at'                              => date('Y-m-d H:i:s')
            ];

            $this->db->where('pfe_posts.id', $post_video_id);
            $this->db->update('pfe_posts',  $variable );
            $business_username = $this->input->post('business_username');
            $username     = $this->input->post('username');
            $user_id      = $this->input->post('id');
            $user = $this->db->get_where('users',array('id'=>$user_id))->row();
            if($business_username == 'undefined'){
                $username = $user->username;
            }else{
                $username = $business_username;
            }
            switch ($url) {
                case 'dashboard':
                    $this->set_output_action('user/'.$url);
                  break;
                case 'user/profile':
                    $this->set_output_action('post/'.$username);
                  break;
                default:
                $this->set_output_action($url.'/'.'post/'.$username);
            }
        }

    }

    protected function set_output_action(
        $parameter_redirect_url = null
    )
    {
        if ($this->input->is_ajax_request()) {
            return $this->output->set_output(json_encode($this->apps_output_message));
        } else {
            if ($this->apps_output_message['status'] == 'success') {
                /** Set flash error message and title */
                $this->session->set_flashdata('output_success_title', $this->apps_output_message['title']);
                $this->session->set_flashdata('output_success', $this->apps_output_message['message']);
            }

            if ($this->apps_output_message['status'] == 'error') {
                /** Set flash error message and title */
                $this->session->set_flashdata('output_error_title', $this->apps_output_message['title']);
                $this->session->set_flashdata('output_error', $this->apps_output_message['message']);
            }

            redirect($parameter_redirect_url);
        }
    }

    protected function action_edit_process_photo_business(
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/business/photo';
            $path_thumbnail = 'public/uploads/business/photo'. '/thumb';
            $parameter_upload_column_name = '__photo_files';
            $this->load->library('image_upload_resize');
            $user_id = $this->input->post('id');
            $business_id = $this->input->post('business_id');

                $configcover["generate_image_file"]          = true;
                $configcover["generate_thumbnails"]          = true;
                $configcover["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
                $configcover["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
                $configcover["thumbnail_prefix"]             = "thumb_";
                $configcover["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
                $configcover["thumbnail_destination_folder"] = "{$path_thumbnail_cover}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
                $configcover["quality"]                      = 90;                                                            // JPEG QUALITY
                $configcover["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
                $configcover["upload_url"]                   = base_url($path_original) . '/';
                $configcover["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

                $configcover["file_data"]    = $_FILES[$parameter_upload_column_name];
                $upload_image_responses = $this->image_upload_resize->resize($configcover);

                    if (!empty($upload_image_responses['images'])) {
                        foreach ($upload_image_responses["images"] as $index => $response) {
                            $configcover["destination_folder"] = str_replace('//', '/', $configcover["destination_folder"]);
                                    $name_thumbnail_cover = 'thumb_'.$response;
                                    $name_original_cover  = $response;
                                    $file_path_cover      = $path_original.'/';
                                    $file_json_cover      = func_encrypt(json_encode($_FILES));
                        }

                    }

                        $post['file_name_thumbnail'] = $name_thumbnail_cover;
                        $post['file_name_original']  = $name_original_cover;
                        $post['file_path']           = $file_path_cover;
                        $post['file_json']           = $file_json_cover;
                        $post['updated_by']                = $user_id;
                        $post['updated_at']                = date('Y-m-d H:i:s');
                    }
                $this->db->where('pbd_business.id',$business_id);
                $this->db->update('pbd_business', $post);
                $business  = $this->db->get_where('pbd_business',array('id'=>$business_id))->row();
                redirect('business/post/'.$business->data_username);

        }
    }


    protected function action_edit_process_cover_business(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */


            $path_original_cover  = 'public/uploads/business/cover';
            $path_thumbnail_cover = 'public/uploads/business/cover'. '/thumb';
            $parameter_upload_column_name_cover = '__cover_files';
            $this->load->library('image_upload_resize');
            $user_id = $this->input->post('id');
            $business_id = $this->input->post('business_id');

                $configcover["generate_image_file"]          = true;
                $configcover["generate_thumbnails"]          = true;
                $configcover["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
                $configcover["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
                $configcover["thumbnail_prefix"]             = "thumb_";
                $configcover["destination_folder"]           = "{$path_original_cover}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
                $configcover["thumbnail_destination_folder"] = "{$path_thumbnail_cover}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
                $configcover["quality"]                      = 90;                                                            // JPEG QUALITY
                $configcover["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
                $configcover["upload_url"]                   = base_url($path_original_cover) . '/';
                $configcover["upload_url_thumbs"]            = base_url($path_thumbnail_cover) . '/';

                $configcover["file_data"]    = $_FILES[$parameter_upload_column_name_cover];
                $upload_image_responses_cover = $this->image_upload_resize->resize($configcover);

                    if (!empty($upload_image_responses_cover['images'])) {
                        foreach ($upload_image_responses_cover["images"] as $index => $response) {
                            $configcover["destination_folder"] = str_replace('//', '/', $configcover["destination_folder"]);
                                    $name_thumbnail_cover = 'thumb_'.$response;
                                    $name_original_cover  = $response;
                                    $file_path_cover      = $path_original_cover.'/';
                                    $file_json_cover      = func_encrypt(json_encode($_FILES));
                        }

                    }

                        $post['cover_file_name_thumbnail'] = $name_thumbnail_cover;
                        $post['cover_file_name_original']  = $name_original_cover;
                        $post['cover_file_path']           = $file_path_cover;
                        $post['cover_file_json']           = $file_json_cover;
                        $post['updated_by']                = $user_id;
                        $post['updated_at']                = date('Y-m-d H:i:s');
                    }
                $this->db->where('pbd_business.id',$business_id);
                $this->db->update('pbd_business', $post);
                $business  = $this->db->get_where('pbd_business',array('id'=>$business_id))->row();
                redirect('business/post/'.$business->data_username);

        }
    }



    protected function action_store_business(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/business/photo';
            $path_thumbnail = 'public/uploads/business/photo'. '/thumb';
            $path_original_cover  = 'public/uploads/business/cover';
            $path_thumbnail_cover = 'public/uploads/business/cover'. '/thumb';
            $parameter_upload_column_name = '__logo_files';
            $parameter_upload_column_name_cover = '__cover_files';
            $this->load->library('image_upload_resize');
            $user_id = $this->input->post('id');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

                if (!empty($upload_image_responses['images'])) {
                    foreach ($upload_image_responses["images"] as $index => $response) {
                        $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                $name_thumbnail_photo = 'thumb_'.$response;
                                $name_original_photo  = $response;
                                $file_path_photo      = $config["destination_folder"];
                                $file_json_photo            = func_encrypt(json_encode($_FILES));
                    }

                }

                $configcover["generate_image_file"]          = true;
                $configcover["generate_thumbnails"]          = true;
                $configcover["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
                $configcover["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
                $configcover["thumbnail_prefix"]             = "thumb_";
                $configcover["destination_folder"]           = "{$path_original_cover}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
                $configcover["thumbnail_destination_folder"] = "{$path_thumbnail_cover}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
                $configcover["quality"]                      = 90;                                                            // JPEG QUALITY
                $configcover["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
                $configcover["upload_url"]                   = base_url($path_original) . '/';
                $configcover["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

                $configcover["file_data"]    = $_FILES[$parameter_upload_column_name_cover];
                $upload_image_responses_cover = $this->image_upload_resize->resize($configcover);

                    if (!empty($upload_image_responses_cover['images'])) {
                        foreach ($upload_image_responses_cover["images"] as $index => $response) {
                            $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                    $name_thumbnail_cover = 'thumb_'.$response;
                                    $name_original_cover  = $response;
                                    $file_path_cover      = $path_original_cover.'/';
                                    $file_json_cover            = func_encrypt(json_encode($_FILES));
                        }

                    }

                    $data_name        = $this->input->post('business-name');
                    $username        = $this->input->post('username');
                    $data_description = $this->input->post('business-description');
                    $bd_email         = $this->input->post('business-email');
                    $bd_address       = $this->input->post('business-address');
                    $country          = $this->input->post('business-country');
                    $state            = $this->input->post('business-state');
                    $city             = $this->input->post('business-city');
                    $maps             = $this->input->post('maps');
					$status_page	  = $this->input->post('status_page');

                    $result_locations = array();
                        $rows = $this->db->get_where('loc_countries', array('id'=>$country))->row();
                        $rows_state = $this->db->get_where('loc_states', array('id'=>$state))->row();
                        $rows_city = $this->db->get_where('loc_cities', array('id'=>$city))->row();
                        $result_locations[] = array(
                            'country_id' => $country,
                            'country_name' => $rows->name,
                            'state_id' => $state,
                            'state_name' => $rows_state->name,
                            'city_id' => $city,
                            'city_name' => $rows_city->name,
                        );
                    $data_locations = json_encode($result_locations);
                    $types                    = $this->input->post('business-types');
                    $result_type = array();
                    foreach($types AS $key => $val){
                        $result_type[] = $types[$key];
                        }
                    $data_types = json_encode($result_type);
                    $categories  = $this->input->post('business-categories');
                    $result_category = array();
                        foreach($categories AS $key => $val){
                            $result_category[] = $categories[$key];
                        }

                    $data_categories = json_encode($result_category);
                    $website           = $this->input->post('website');
                        $result_web = array();
                        foreach($website AS $key => $val){
                            $result_web[] = array(
                               'website'   => $website[$key],
                            );
                        }
                    $data_website = json_encode($result_web);
                    $facebook           = $this->input->post('facebook');
                    $linkedin           = $this->input->post('linkedin');
                    $instagram          = $this->input->post('instagram');
                            $result_socmed = array();
                            $result_socmed[] = array(
                               'facebook'    => $facebook,
                               'linkedin'    => $linkedin,
                               'instagram'   => $instagram
                            );
                    $data_socmed = json_encode($result_socmed);
                    $variable = [
                        'id'                                => $this->generate_new_id_string() . get_random_alphanumeric(5),
                        'users_id'                          => $_SESSION['user_id'],
                        'data_username'                     => $username,
						'data_url_name'						=> $username,
                        'data_name'                         => $data_name,
                        'data_description'                  => $data_description,
                        'bd_email'                          => $bd_email,
                        'bd_address'                        => $bd_address,
                        'data_locations'                    => $data_locations,
                        'bd_maps'                           => $maps,
                        'data_types'                        => $data_types,
                        'data_categories'                   => $data_categories,
                        'data_social_links'                 => $data_socmed,
                        'data_contact_website'              => $data_website,
                        'bd_hours_work'                     => '[]',
                        'file_name_thumbnail'               => $name_thumbnail_photo,
                        'file_name_original'                => $name_original_photo,
                        'file_path'                         => $file_path_photo,
                        'file_json'                         => $file_json_photo,
                        'cover_file_name_thumbnail'         => $name_thumbnail_cover,
                        'cover_file_name_original'          => $name_original_cover,
                        'cover_file_path'                   => $file_path_cover,
                        'cover_file_json'                   => $file_json_cover,
                        'status'                            => 1,
						'status_page'						=> $status_page,
                        'created_by'                        => $_SESSION['user_id'],
                        'created_at'                        => date('Y-m-d H:i:s'),
                        'updated_by'                        => $user_id,
                        'updated_at'                        => date('Y-m-d H:i:s')
                    ];

            $this->db->insert('pbd_business', $variable);
            redirect(base_url('business/list'));
            }
        }

    }

    protected function action_update_business(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/business/photo';
            $path_thumbnail = 'public/uploads/business/photo'. '/thumb';
            $path_original_cover  = 'public/uploads/business/cover';
            $path_thumbnail_cover = 'public/uploads/business/cover'. '/thumb';
            $parameter_upload_column_name = '__logo_files';
            $parameter_upload_column_name_cover = '__cover_files';
            $this->load->library('image_upload_resize');
            $user_id = $this->input->post('id');

            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

                if (!empty($upload_image_responses['images'])) {
                    foreach ($upload_image_responses["images"] as $index => $response) {
                        $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                $name_thumbnail_photo = 'thumb_'.$response;
                                $name_original_photo  = $response;
                                $file_path_photo      = $config["destination_folder"];
                                $file_json_photo            = func_encrypt(json_encode($_FILES));
                    }

                }
                $configcover["generate_image_file"]          = true;
                $configcover["generate_thumbnails"]          = true;
                $configcover["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
                $configcover["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
                $configcover["thumbnail_prefix"]             = "thumb_";
                $configcover["destination_folder"]           = "{$path_original_cover}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
                $configcover["thumbnail_destination_folder"] = "{$path_thumbnail_cover}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
                $configcover["quality"]                      = 90;                                                            // JPEG QUALITY
                $configcover["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
                $configcover["upload_url"]                   = base_url($path_original) . '/';
                $configcover["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

                $configcover["file_data"]    = $_FILES[$parameter_upload_column_name_cover];
                $upload_image_responses_cover = $this->image_upload_resize->resize($configcover);

                    if (!empty($upload_image_responses_cover['images'])) {
                        foreach ($upload_image_responses_cover["images"] as $index => $response) {
                            $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                    $name_thumbnail_cover = 'thumb_'.$response;
                                    $name_original_cover  = $response;
                                    $file_path_cover      = $path_original_cover.'/';
                                    $file_json_cover      = func_encrypt(json_encode($_FILES));
                        }

                    }
                    $business_id      = $this->input->post('business-id');
                    $data_username    = $this->input->post('business-username');
                    $data_name        = $this->input->post('business-name');
                    $data_description = $this->input->post('business-description');
                    $bd_email         = $this->input->post('business-email');
                    $bd_phone         = $this->input->post('business-phone');
                    $bd_address       = $this->input->post('business-address');
                    $bd_paymentmethod = $this->input->post('business-payment');
                    $country          = $this->input->post('business-country');
                    $city             = $this->input->post('business-city');
                    $state            = $this->input->post('business-state');
                    $bd_team_number   = $this->input->post('business-team');
                    $zip_code         = $this->input->post('zip-code');
                    $maps             = $this->input->post('maps');
                    $result_locations = array();
                    $rows = $this->db->get_where('loc_countries', array('id'=>$country))->row();
                    $rows_state = $this->db->get_where('loc_states', array('id'=>$state))->row();
                    $rows_city = $this->db->get_where('loc_cities', array('id'=>$city))->row();
                        $result_locations[] = array(
                            'country_id' => $country,
                            'country_name' => $rows->name,
                            'state_id' => $state,
                            'state_name' => $rows_state->name,
                            'city_id' => $city,
                            'city_name' => $rows_city->name,
                        );
                    $data_locations = json_encode($result_locations);
                    $types                    = $this->input->post('business-types');
                    $result_type = array();
                    foreach($types AS $key => $val){
                        $result_type[] =
                            $types[$key];
                        }
                    $data_types = json_encode($result_type);
                    $categories  = $this->input->post('business-categories');
                    $result_category = array();
                        foreach($categories AS $key => $val){
                            $result_category[] = $categories[$key];
                        }
                    $data_categories = json_encode($result_category);
                    $facilities  = $this->input->post('business-facility');
                    $result_facility = array();
                        foreach($facilities AS $key => $val){
                            $result_facility[] = $facilities[$key];
                        }
                    $data_facilities = json_encode($result_facility);
                    $day_const  = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
                    $day = $this->input->post('day');
                    $start = $this->input->post('start');
                    $end = $this->input->post('end');
                    $result_day = array();
                        foreach($day AS $key => $val){
                            foreach($start AS $key1 => $val1){
                                foreach($end AS $key2 => $val2){
                                    $result_day[$day[$key]] = array(
                                        'start' => $start[$key],
                                        'end' => $end[$key],

                                    );
                                }
                            }
                        }

                        $bd_hours_work              = json_encode([$result_day]);

                        $post['users_id']           = $_SESSION['user_id'];
                        $post['data_username']      = $data_username;
						$post['data_url_name']      = $data_username;
                        $post['data_name']          = $data_name;
                        $post['data_description']   = $data_description;
                        $post['bd_email']           = $bd_email;
                        $post['bd_address']         = $bd_address;
                        $post['bd_phone']           = $bd_phone;
                        $post['bd_team_number']     = $bd_team_number;
                        $post['bd_paymentmethod']   = $bd_paymentmethod;
                        $post['bd_hours_work']      = $bd_hours_work;
                        $post['data_locations']     = $data_locations;
                        $post['bd_maps']            = $maps;
                        $post['bd_address_zipcode'] = $zip_code;
                        $post['data_types']         = $data_types;
                        $post['data_facilities']    = $data_facilities;
                        $post['data_categories']    = $data_categories;
                        if (!empty($name_original_photo)) {
                            $post['file_name_thumbnail']= $name_thumbnail_photo;
                            $post['file_name_original'] = $name_original_photo;
                            $post['file_path']          = $file_path_photo;
                            $post['file_json']          = $file_json_photo;
                        } elseif (!empty($name_original_cover)) {
                            $post['cover_file_name_thumbnail'] = $name_thumbnail_cover;
                            $post['cover_file_name_original']  = $name_original_cover;
                            $post['cover_file_path']           = $file_path_cover;
                            $post['cover_file_json']           = $file_json_cover;
                        }
                        $post['status']                    = 1;
                        $post['created_by']                = $_SESSION['user_id'];
                        $post['created_at']                = date('Y-m-d H:i:s');
                        $post['updated_by']                = $user_id;
                        $post['updated_at']                = date('Y-m-d H:i:s');
                    }
                $this->db->where('pbd_business.id',$business_id);
                $this->db->update('pbd_business', $post);

                redirect(base_url('business/list'));
        }

    }

	protected function action_suggest_business(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/business/photo';
            $path_thumbnail = 'public/uploads/business/photo'. '/thumb';
            $path_original_cover  = 'public/uploads/business/cover';
            $path_thumbnail_cover = 'public/uploads/business/cover'. '/thumb';
            $parameter_upload_column_name = '__logo_files';
            $parameter_upload_column_name_cover = '__cover_files';
            $this->load->library('image_upload_resize');
            $user_id = $this->input->post('id');

            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

                if (!empty($upload_image_responses['images'])) {
                    foreach ($upload_image_responses["images"] as $index => $response) {
                        $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                $name_thumbnail_photo = 'thumb_'.$response;
                                $name_original_photo  = $response;
                                $file_path_photo      = $config["destination_folder"];
                                $file_json_photo            = func_encrypt(json_encode($_FILES));
                    }

                }
                $configcover["generate_image_file"]          = true;
                $configcover["generate_thumbnails"]          = true;
                $configcover["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
                $configcover["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
                $configcover["thumbnail_prefix"]             = "thumb_";
                $configcover["destination_folder"]           = "{$path_original_cover}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
                $configcover["thumbnail_destination_folder"] = "{$path_thumbnail_cover}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
                $configcover["quality"]                      = 90;                                                            // JPEG QUALITY
                $configcover["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
                $configcover["upload_url"]                   = base_url($path_original) . '/';
                $configcover["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

                $configcover["file_data"]    = $_FILES[$parameter_upload_column_name_cover];
                $upload_image_responses_cover = $this->image_upload_resize->resize($configcover);

                    if (!empty($upload_image_responses_cover['images'])) {
                        foreach ($upload_image_responses_cover["images"] as $index => $response) {
                            $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                    $name_thumbnail_cover = 'thumb_'.$response;
                                    $name_original_cover  = $response;
                                    $file_path_cover      = $path_original_cover.'/';
                                    $file_json_cover      = func_encrypt(json_encode($_FILES));
                        }

                    }
                    $business_id      = $this->input->post('business-id');
                    $data_username    = $this->input->post('business-username');
                    $data_name        = $this->input->post('business-name');
                    $data_description = $this->input->post('business-description');
                    $bd_email         = $this->input->post('business-email');
                    $bd_phone         = $this->input->post('business-phone');
                    $bd_address       = $this->input->post('business-address');
                    $bd_paymentmethod = $this->input->post('business-payment');
                    $country          = $this->input->post('business-country');
                    $city             = $this->input->post('business-city');
                    $state            = $this->input->post('business-state');
                    $bd_team_number   = $this->input->post('business-team');
                    $zip_code         = $this->input->post('zip-code');
                    $maps             = $this->input->post('maps');
					$status_page	  = $this->input->post('status_page');
                    $result_locations = array();
                    $rows = $this->db->get_where('loc_countries', array('id'=>$country))->row();
                    $rows_state = $this->db->get_where('loc_states', array('id'=>$state))->row();
                    $rows_city = $this->db->get_where('loc_cities', array('id'=>$city))->row();
                        $result_locations[] = array(
                            'country_id' => $country,
                            'country_name' => $rows->name,
                            'state_id' => $state,
                            'state_name' => $rows_state->name,
                            'city_id' => $city,
                            'city_name' => $rows_city->name,
                        );
                    $data_locations = json_encode($result_locations);
                    $types                    = $this->input->post('business-types');
                    $result_type = array();
                    foreach($types AS $key => $val){
                        $result_type[] =
                            $types[$key];
                        }
                    $data_types = json_encode($result_type);
                    $categories  = $this->input->post('business-categories');
                    $result_category = array();
                        foreach($categories AS $key => $val){
                            $result_category[] = $categories[$key];
                        }
                    $data_categories = json_encode($result_category);
                    $facilities  = $this->input->post('business-facility');
                    $result_facility = array();
						if(!empty($facilities)){
							foreach($facilities AS $key => $val){
								$result_facility[] = $facilities[$key];
							}
						}
                    $data_facilities = json_encode($result_facility);
                    $day_const  = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
                    $day = $this->input->post('day');
                    $start = $this->input->post('start');
                    $end = $this->input->post('end');
                    $result_day = array();
						if(!empty($day)){
                        foreach($day AS $key => $val){
                            foreach($start AS $key1 => $val1){
                                foreach($end AS $key2 => $val2){
                                    $result_day[$day[$key]] = array(
                                        'start' => $start[$key],
                                        'end' => $end[$key],

                                    );
                                }
                            }
                        }
						}

                        $bd_hours_work              = json_encode([$result_day]);

                        $post['users_id']           = $_SESSION['user_id'];
                        $post['data_username']      = $data_username;
                        $post['data_name']          = $data_name;
                        $post['data_description']   = $data_description;
                        $post['bd_email']           = $bd_email;
                        $post['bd_address']         = $bd_address;
                        $post['bd_phone']           = $bd_phone;
                        $post['bd_team_number']     = $bd_team_number;
                        $post['bd_paymentmethod']   = $bd_paymentmethod;
                        $post['bd_hours_work']      = $bd_hours_work;
                        $post['data_locations']     = $data_locations;
                        $post['bd_maps']            = $maps;
                        $post['bd_address_zipcode'] = $zip_code;
                        $post['data_types']         = $data_types;
                        $post['data_facilities']    = $data_facilities;
                        $post['data_categories']    = $data_categories;
                        if (!empty($name_original_photo) && !empty($name_original_cover)) {
                        $post['file_name_thumbnail']= $name_thumbnail_photo;
                        $post['file_name_original'] = $name_original_photo;
                        $post['file_path']          = $file_path_photo;
                        $post['file_json']          = $file_json_photo;
                        $post['cover_file_name_thumbnail'] = $name_thumbnail_cover;
                        $post['cover_file_name_original']  = $name_original_cover;
                        $post['cover_file_path']           = $file_path_cover;
                        $post['cover_file_json']           = $file_json_cover;
                        }elseif(empty($name_original_photo)){
                            $post['cover_file_name_thumbnail'] = $name_thumbnail_cover;
                            $post['cover_file_name_original']  = $name_original_cover;
                            $post['cover_file_path']           = $file_path_cover;
                            $post['cover_file_json']           = $file_json_cover;
                        }elseif(empty($name_original_cover)){
                            $post['file_name_thumbnail']= $name_thumbnail_photo;
                            $post['file_name_original'] = $name_original_photo;
                            $post['file_path']          = $file_path_photo;
                            $post['file_json']          = $file_json_photo;
                        }else{
                            $post['cover_file_name_thumbnail'] = $name_thumbnail_cover;
                            $post['cover_file_name_original']  = $name_original_cover;
                            $post['cover_file_path']           = $file_path_cover;
                            $post['cover_file_json']           = $file_json_cover;
                        }
                        $post['status']                    = 0;
						$post['status_page']			   = $status_page;
                        $post['created_by']                = $_SESSION['user_id'];
                        $post['created_at']                = date('Y-m-d H:i:s');
                        $post['updated_by']                = $user_id;
                        $post['updated_at']                = date('Y-m-d H:i:s');
                    }

				$this->db->insert('pbd_business_suggestions', $post);

                redirect(base_url('business/about/'.$data_username));
        }

    }

	protected function action_claim_business(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {
                if (isset($_FILES['__business_files']['name']) && $_FILES['__business_files']['name'] != '') {
                    $user_id           = $_SESSION['user_id'];
                    $business_id       = $this->input->post('business-id');
					$relationship	   = $this->input->post('relationship');
					$business_username = $this->input->post('business-username');
					$business_email = $this->input->post('business-email');
                    unset($config);
                    $date = date("ymd");
                    $configPdf['upload_path'] = 'public/uploads/pbd_business/document/';
                    $configPdf['max_size'] = '60000';
                    $configPdf['allowed_types'] = 'pdf';
                    $configPdf['overwrite'] = FALSE;
                    $configPdf['remove_spaces'] = TRUE;
                    $business_name = $date.$business_id;
                    $configPdf['file_name'] = $business_name;

                    $this->load->library('upload', $configPdf);
                    $this->upload->initialize($configPdf);
                        $variable = array();

                        if($this->upload->do_upload('__business_files')) {
                            $variable= [
								'business_id'						=> $business_id,
                                'users_id'                          => $user_id,
                                'file_name'                   		=> $configPdf['file_name'],
                                'file_path'                   		=> $configPdf['upload_path'],
								'relationship'				  		=> $relationship,
								'status'							=> 0,
                                'created_at'                        => date('Y-m-d H:i:s'),
                                'updated_at'                        => date('Y-m-d H:i:s')
                            ];

                        }
                        $this->db->insert('pbd_business_claims', $variable);
                        redirect(base_url('business/list'));
                }
		}
		}
	}

    protected function action_edit_process_album_business(
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();

            $apps_title_action  = 'Edit';
            $apps_output_action = false;

            /** TRANSACT SQL for better Query Validation */
            $this->db->trans_start();

            $var_edit    = array();
            $var_edit_id = array();
            $username = $this->input->post('username');
            if (empty($parameter_id)) {
                $parameter_id = $this->input->post($this->module_table_id);
            }

                /**
                 * ----------------------------------------------------------------------------------------------------
                 * 2. VALIDATE DATA POST IF NOT EMPTY to SET VARIABLE ARRAY
                 * ----------------------------------------------------------------------------------------------------
                 */

                    /** add field for PRIMARY KEY ID */
                    $var_edit_id[$this->module_table_id] = $parameter_id;

                    /** Action process Add */

                $this->db->trans_complete();
                if ($this->db->trans_status() === TRUE) {
                    $this->db->trans_commit();
                        $this->action_image_process_album_business(
                            '__album_files',
                            $this->module_table,
                            array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                            array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                            $this->module_upload_path_album_business,
                            $this->module_upload_size
                        );

                        $this->apps_output_message = array(
                            'status'  => 'success',
                            'title'   => lang_text('message_edit_title_success'),
                            'message' => "{$this->apps_title_module} " . lang_text('message_edit_success')
                        );

                } else {
                    $this->db->trans_rollback();
                    $this->apps_output_message = array(
                        'status'  => 'error',
                        'title'   => lang_text('message_edit_title_failed'),
                        'message' => "{$this->apps_title_module} " . lang_text('message_edit_failed')
                    );
                }

                if ($this->apps_output_message['status'] == 'error') {
                    $this->module_url_default_photo_business = $parameter_url_source;
                }
                if($this->input->post('name_first') == false){
                $this->set_output_action($this->module_url_default_photo_business.'/'.urlencode($username));
                }
        }
    }

    protected function action_image_process_album_business(
        $parameter_upload_column_name = 'images',
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         * 1. Validate input file (multiple or not)
         * 2. Check file type for upload image
         * 3. Check process is new / update data image
         * 4. Process upload image and generate thumbnail
         * 5. Create record for succes image upload on server to database
         */

        $upload_column_name = '__album_files';

        if (!empty($parameter_upload_column_name)) {
            $upload_column_name = $parameter_upload_column_name;

        }
        $this->load->helper(array('form', 'url'));

        if (!empty($_FILES[$upload_column_name]['name'])) {

            $var_upload_image = $this->action_image_process_upload_album_business
            (
                $parameter_upload_column_name,
                $parameter_upload_table,
                $parameter_upload_table_key,
                $parameter_upload_table_related_key,
                $parameter_upload_destination,
                $parameter_upload_size_maximum
            );

        }
    }

    private function action_image_process_upload_album_business(
        $parameter_upload_column_name = null,
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         *  1. Process upload image to server
         *  2. validate file type and size
         *  3. create multiple file for other dimension proportional
         */
        $path_original  = $parameter_upload_destination;
        $path_thumbnail = $parameter_upload_destination . '/thumb';


        $this->load->library('image_upload_resize');
        $user_id = $this->input->post('id');

        $config["generate_image_file"]          = true;
        $config["generate_thumbnails"]          = true;
        $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
        $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
        $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
        $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["quality"]                      = 90;                                                            // JPEG QUALITY
        $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
        $config["upload_url"]                   = base_url($path_original) . '/';
        $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

        $config["file_data"]    = $_FILES[$parameter_upload_column_name];
        $upload_image_responses = $this->image_upload_resize->resize($config);

        $parameter_id = $this->input->post('id');
        $category_album = $this->input->post('category_album');
        $name_album = $this->input->post('name');
        try {
            $variable['add']  = null;
            $variable['edit'] = null;


            if (!empty($upload_image_responses['images'])) {
                foreach ($upload_image_responses["images"] as $index => $response) {
                    $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                    if ($response != '') {
                        if (!isset($output_editable[$index])) {
                            $variable_albums= [
                                $parameter_upload_table_key['id']   => $this->generate_new_id_string() . get_random_alphanumeric(5),
                                'pbd_business_id'                   => $parameter_id,
                                'data_name'                         => $name_album,
                                'file_name_thumbnail'               => 'thumb_' . $response,
                                'file_name_original'                => $response,
                                'file_path'                         => $config["destination_folder"],
                                'file_json'                         => func_encrypt(json_encode($_FILES)),
                                'created_by'                        => $user_id,
                                'created_at'                        => date('Y-m-d H:i:s'),
                                'updated_by'                        => $user_id,
                                'updated_at'                        => date('Y-m-d H:i:s')
                            ];
                        } else {
                            $variable_albums = array(
                                $parameter_upload_table_key['id']   => $output_editable[$index],
                                'pbd_business_id'                   => $parameter_id,
                                'data_name'                         => $name_album,
                                'file_name_thumbnail'               => 'thumb_' . $response,
                                'file_name_original'                => $response,
                                'file_path'                         => $config["destination_folder"],
                                'file_json'                         => func_encrypt(json_encode($_FILES)),
                                'updated_by'                        => 1,
                                'updated_at'                        => date('Y-m-d H:i:s')
                            );
                        }
                    }
                }

            }
            $this->db->insert('pbd_business_photo_categories',  $variable_albums );
            $output['data']    = $variable;
            $output['status']  = true;
            $output['message'] = '';
        } catch (Exception $e) {
            $output['data']    = null;
            $output['status']  = false;
            $output['message'] = $e->getMessage();
        }

        return $output;
    }

    protected function action_edit_process_photo_album_business(
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();

            $apps_title_action  = 'Edit';
            $apps_output_action = false;

            /** TRANSACT SQL for better Query Validation */
            $this->db->trans_start();

            $var_edit    = array();
            $var_edit_id = array();
            $username    = $this->input->post('username');
            if (empty($parameter_id)) {
                $parameter_id = $this->input->post($this->module_table_id);
            }

                /**
                 * ----------------------------------------------------------------------------------------------------
                 * 2. VALIDATE DATA POST IF NOT EMPTY to SET VARIABLE ARRAY
                 * ----------------------------------------------------------------------------------------------------
                 */

                    /** add field for PRIMARY KEY ID */
                    $var_edit_id[$this->module_table_id] = $parameter_id;

                    /** Action process Add */

                $this->db->trans_complete();
                if ($this->db->trans_status() === TRUE) {
                    $this->db->trans_commit();
                        $this->action_image_process_photo_album_business(
                            '__photo_album_files',
                            $this->module_table,
                            array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                            array('id' => $this->module_table_id, 'value' => $var_edit_id[$this->module_table_id]),
                            $this->module_upload_path_photo_album_business,
                            $this->module_upload_size
                        );

                        $this->apps_output_message = array(
                            'status'  => 'success',
                            'title'   => lang_text('message_edit_title_success'),
                            'message' => "{$this->apps_title_module} " . lang_text('message_edit_success')
                        );

                } else {
                    $this->db->trans_rollback();
                    $this->apps_output_message = array(
                        'status'  => 'error',
                        'title'   => lang_text('message_edit_title_failed'),
                        'message' => "{$this->apps_title_module} " . lang_text('message_edit_failed')
                    );
                }

                if ($this->apps_output_message['status'] == 'error') {
                    $this->module_url_default_photo_business = $parameter_url_source;
                }
                if($this->input->post('name_first') == false){
                $this->set_output_action($this->module_url_default_photo_business.'/'.$username);
                }
        }
    }

    protected function action_image_process_photo_album_business(
        $parameter_upload_column_name = 'images',
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         * 1. Validate input file (multiple or not)
         * 2. Check file type for upload image
         * 3. Check process is new / update data image
         * 4. Process upload image and generate thumbnail
         * 5. Create record for succes image upload on server to database
         */
        $upload_column_name = '__photo_album_files';

        if (!empty($parameter_upload_column_name)) {
            $upload_column_name = $parameter_upload_column_name;

        }
        $this->load->helper(array('form', 'url'));

        if (!empty($_FILES[$upload_column_name]['name'])) {
            $var_upload_image = $this->action_image_process_upload_photo_album_business
            (
                $parameter_upload_column_name,
                $parameter_upload_table,
                $parameter_upload_table_key,
                $parameter_upload_table_related_key,
                $parameter_upload_destination,
                $parameter_upload_size_maximum
            );

        }
    }

    private function action_image_process_upload_photo_album_business(
        $parameter_upload_column_name = null,
        $parameter_upload_table = null,
        $parameter_upload_table_key = array('id' => null, 'value' => null),
        $parameter_upload_table_related_key = null,
        $parameter_upload_destination = null,
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        )
    )
    {

        /**
         *  1. Process upload image to server
         *  2. validate file type and size
         *  3. create multiple file for other dimension proportional
         */
        $path_original  = $parameter_upload_destination;
        $path_thumbnail = $parameter_upload_destination . '/thumb';


        $this->load->library('image_upload_resize');
        $user_id = $this->input->post('id');

        $config["generate_image_file"]          = true;
        $config["generate_thumbnails"]          = true;
        $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
        $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
        $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
        $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["quality"]                      = 90;                                                            // JPEG QUALITY
        $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
        $config["upload_url"]                   = base_url($path_original) . '/';
        $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

        $config["file_data"]    = $_FILES[$parameter_upload_column_name];
        $upload_image_responses = $this->image_upload_resize->resize($config);

        $parameter_id = $this->input->post('id');
        $album = $this->input->post('album');
        $caption = $this->input->post('caption');
        try {
            $variable['add']  = null;
            $variable['edit'] = null;


            if (!empty($upload_image_responses['images'])) {
                foreach ($upload_image_responses["images"] as $index => $response) {
                    $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                    if ($response != '') {
                        if (!isset($output_editable[$index])) {
                            $variable_albums= [
                                $parameter_upload_table_key['id']   => $this->generate_new_id_string() . get_random_alphanumeric(5),
                                'pbd_business_id'                   => $parameter_id,
                                'pbd_business_categories_id'        => $album,
                                'file_caption'                      => $caption,
                                'file_name_thumbnail'               => 'thumb_' . $response,
                                'file_name_original'                => $response,
                                'file_path'                         => $config["destination_folder"],
                                'created_by'                        => $user_id,
                                'created_at'                        => date('Y-m-d H:i:s'),
                                'updated_by'                        => $user_id,
                                'updated_at'                        => date('Y-m-d H:i:s')
                            ];
                        } else {
                            $variable_albums = array(
                                $parameter_upload_table_key['id']   => $output_editable[$index],
                                'pbd_business_id'                   => $parameter_id,
                                'data_name'                         => $name_album,
                                'file_name_thumbnail'               => 'thumb_' . $response,
                                'file_name_original'                => $response,
                                'file_path'                         => $config["destination_folder"],
                                'updated_by'                        => 1,
                                'updated_at'                        => date('Y-m-d H:i:s')
                            );
                        }
                    }
                }

            }
            $this->db->insert('pbd_business_photo',  $variable_albums );
            $output['data']    = $variable;
            $output['status']  = true;
            $output['message'] = '';
        } catch (Exception $e) {
            $output['data']    = null;
            $output['status']  = false;
            $output['message'] = $e->getMessage();
        }

        return $output;
    }

    protected function action_store_market(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/products/photo';
            $path_thumbnail = 'public/uploads/products/photo'. '/thumb';
            $parameter_upload_column_name = '__logo_files';
            $this->load->library('image_upload_resize');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

            if (!empty($upload_image_responses['images'])) {
                foreach ($upload_image_responses["images"] as $index => $response) {
                    $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                        $name_thumbnail_photo = 'thumb_'.$response;
                        $name_original_photo  = $response;
                        $file_path_photo      = $config["destination_folder"];
                        $file_json_photo            = func_encrypt(json_encode($_FILES));
                }
            }

            $product_type        = $this->input->post('product-type');
            $product_category    = $this->input->post('product-category');
            $product_name        = $this->input->post('product-name');
            $product_type_price  = $this->input->post('product-type-price');
            $product_price       = $this->input->post('product-price');
            $product_currency    = $this->input->post('product-currency');
            $price               = $this->input->post('price');
            $product_label       = $this->input->post('product-label');
            $product_description = $this->input->post('product-description');
            $sku                 = $this->input->post('sku');
            $publish              = $this->input->post('publish');
            $select_business    = $this->input->post('select_business_id');
            $variant_qty  = $this->input->post('product-count-variant[]');
            $variant_price  = $this->input->post('product-price-variant[]');
			$product_email		 = $this->input->post('product-email');
			$product_phone		 = $this->input->post('product-phone');
            $result_cat = [];
            foreach($product_category AS $key => $val){
                $result_cat[] =
                    $product_category[$key];

            }
            $result = [];
            foreach($variant_qty AS $key => $val){
                    $result[] = array(
                    'qty'   => $variant_qty[$key],
                    'price'   => $variant_price[$key],
                    );

            }
            if(empty($publish)){
                $published = 0;
            }else{
                $published = $publish;
            }
            if(empty($select_business)){
                $select_business = null;
            }else{
                $select_business = $select_business;
            }
            $post['id']                = $this->generate_new_id_string() . get_random_alphanumeric(5);
            $post['users_id']          = $_SESSION['user_id'];
            $post['pbd_business_id']   = $select_business;
            $post['data_categories']   = json_encode($result_cat);
            $post['data_type']         = $product_type;
            $post['data_name']         = $product_name;
            $post['price_type']         = $product_type_price;
            $post['price_currency']     = $product_currency;
            if($product_type_price == 2){
                $post['price_low']          = $price;
                $post['price_high']        = $price;
            }elseif($product_type_price == 3){
                $post['price_low']          = $price;
                $post['price_high']        = 0;
            }elseif($product_type_price == 5){
                $post['price_variant']          = json_encode($result);
            }else{
                $post['price_low']          = 0;
                $post['price_high']        = 0;
            }
        }
        $post['data_label']         = $product_label;
        $post['data_description']   = $product_description;
        $post['data_sku']           = $sku;
        $post['file_name_thumbnail']= $name_thumbnail_photo;
        $post['file_name_original'] = $name_original_photo;
        $post['file_path']          = $file_path_photo;
        $post['file_json']          = $file_json_photo;
        $post['status']             = $published;
        $post['published']          = date('Y-m-d H:i:s');
        $post['created_by']         = $_SESSION['user_id'];
        $post['created_at']         = date('Y-m-d H:i:s');
        $post['updated_by']         = $_SESSION['user_id'];
        $post['updated_at']         = date('Y-m-d H:i:s');
		$post['data_email']   	 	= $product_email;
		$post['data_phone']   	 	= $product_phone;
        $this->db->insert('pbd_items', $post);

		$token =  $this->session->userdata('token_photo');
		$photo['module_id'] = $post['id'];
		$this->db->where('token',$token);
        $this->db->update('gallery_photo', $photo);

        redirect(base_url('market/list'));
        }
    }

    protected function action_update_market(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/products/photo';
            $path_thumbnail = 'public/uploads/products/photo'. '/thumb';
            $parameter_upload_column_name = '__logo_files';
            $this->load->library('image_upload_resize');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

            if (!empty($upload_image_responses['images'])) {
                foreach ($upload_image_responses["images"] as $index => $response) {
                    $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                        $name_thumbnail_photo = 'thumb_'.$response;
                        $name_original_photo  = $response;
                        $file_path_photo      = $config["destination_folder"];
                        $file_json_photo            = func_encrypt(json_encode($_FILES));
                }
            }
            $product_id          = $this->input->post('product-id');
            $product_type    = $this->input->post('product-type');
            $product_category    = $this->input->post('product-category');
            $product_name        = $this->input->post('product-name');
            $product_currency  = $this->input->post('product-currency');
            $product_type_price  = $this->input->post('product-type-price');
            $price               = $this->input->post('price');
            $product_description = $this->input->post('product-description');
            $product_sku = $this->input->post('sku');
            $product_label = $this->input->post('product-label');
            $product_email = $this->input->post('product-email');
            $product_phone = $this->input->post('product-phone');
            $select_business    = $this->input->post('select_business_id');
            $variant_qty  = $this->input->post('product-count-variant[]');
            $variant_price  = $this->input->post('product-price-variant[]');
            $result_cat = [];
            foreach($product_category AS $key => $val){
                $result_cat[] =
                    $product_category[$key];

            }
            $result = [];
            foreach($variant_qty AS $key => $val){
                    $result[] = array(
                    'qty'   => $variant_qty[$key],
                    'price'   => $variant_price[$key],
                    );

            }

            if(empty($select_business)){
                $select_business = 1;
            }else{
                $select_business = $select_business;
            }

            $post['users_id']          = $_SESSION['user_id'];
            $post['pbd_business_id']   = $select_business;
            $post['data_categories']   = json_encode($result_cat);
            $post['data_name']         = $product_name;
            $post['price_type']         = $product_type_price;
            $post['price_currency']         = $product_currency;
            if ($price) {
                if($product_type_price == 3){
                    $post['price_low']          = $price;
                    $post['price_high']        = $price;
                }elseif($product_type_price == 2){
                    $post['price_low']          = $price;
                    $post['price_high']        = 0;
                }elseif($product_type_price == 5){
                    $post['price_variant']          = json_encode($result);
                }else{
                    $post['price_low']          = 0;
                    $post['price_high']        = 0;
                }
            }
        }
        
        $post['data_type']   = $product_type;
        $post['data_description']   = $product_description;
        $post['data_sku'] = $product_sku;
        $post['data_label'] = $product_label;
        $post['data_email'] = $product_email;
        $post['data_phone'] = $product_phone;
        if (! empty($name_original_photo)) {
            $post['file_name_thumbnail']= $name_thumbnail_photo;
            $post['file_name_original'] = $name_original_photo;
        }
        $post['file_path']          = $file_path_photo;
        $post['file_json']          = $file_json_photo;
        $post['published']          = date('Y-m-d H:i:s');
        $post['updated_by']         = $_SESSION['user_id'];
        $post['updated_at']         = date('Y-m-d H:i:s');

        $this->db->where('pbd_items.id',$product_id);
        $this->db->update('pbd_items', $post);

		$token =  $this->session->userdata('token_photo');
		$photo['module_id'] = $product_id;
		$this->db->where('token',$token);
        $this->db->update('gallery_photo', $photo);

        redirect(base_url('market/manage'));
        }
    }

    protected function action_store_jobs(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/jobs/photo';
            $path_thumbnail = 'public/uploads/jobs/photo'. '/thumb';
            $path_original_cover  = 'public/uploads/jobs/cover';
            $path_thumbnail_cover = 'public/uploads/jobs/cover'. '/thumb';
            $parameter_upload_column_name = '__logo_files';
            $parameter_upload_column_name_cover = '__cover_files';
            $this->load->library('image_upload_resize');
            $user_id = $this->input->post('id');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

                if (!empty($upload_image_responses['images'])) {
                    foreach ($upload_image_responses["images"] as $index => $response) {
                        $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                $name_thumbnail_photo = 'thumb_'.$response;
                                $name_original_photo  = $response;
                                $file_path_photo      = $config["destination_folder"];
                                $file_json_photo            = func_encrypt(json_encode($_FILES));
                    }

                }

                $configcover["generate_image_file"]          = true;
                $configcover["generate_thumbnails"]          = true;
                $configcover["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
                $configcover["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
                $configcover["thumbnail_prefix"]             = "thumb_";
                $configcover["destination_folder"]           = "{$path_original_cover}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
                $configcover["thumbnail_destination_folder"] = "{$path_thumbnail_cover}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
                $configcover["quality"]                      = 90;                                                            // JPEG QUALITY
                $configcover["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
                $configcover["upload_url"]                   = base_url($path_original) . '/';
                $configcover["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

                $configcover["file_data"]    = $_FILES[$parameter_upload_column_name_cover];
                $upload_image_responses_cover = $this->image_upload_resize->resize($configcover);

                    if (!empty($upload_image_responses_cover['images'])) {
                        foreach ($upload_image_responses_cover["images"] as $index => $response) {
                            $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                    $name_thumbnail_cover = 'thumb_'.$response;
                                    $name_original_cover  = $response;
                                    $file_path_cover      = $path_original_cover.'/';
                                    $file_json_cover            = func_encrypt(json_encode($_FILES));
                        }

                    }

                    $data_name        = $this->input->post('job-name');
                    $data_type        = $this->input->post('job-types');
                    $data_categories  = $this->input->post('job-categories');
                    $data_description = $this->input->post('job-description');
                    $data_address     = $this->input->post('job-address');
                    $jobs_salary_period_id  = $this->input->post('job-period');
                    $jb_salary_currency = $this->input->post('currency');
                    $jb_salary_min    = $this->input->post('job-min-salary');
                    $jb_salary_max    = $this->input->post('job-max-salary');
                    $jb_contact_email = $this->input->post('job-email');
                    $jb_contact_number = $this->input->post('job-number');
                    $country          = $this->input->post('job-country');
                    $state            = $this->input->post('job-state');
                    $city             = $this->input->post('job-city');
                    $select_business_jb  = $this->input->post('select_business_id');

                    $result_locations = array();
                        $rows = $this->db->get_where('loc_countries', array('id'=>$country))->row();
                        $rows_state = $this->db->get_where('loc_states', array('id'=>$state))->row();
                        $rows_city = $this->db->get_where('loc_cities', array('id'=>$city))->row();
                        $result_locations[] = array(
                            'country_id' => $country,
                            'country_name' => $rows->name,
                            'state_id' => $state,
                            'state_name' => $rows_state->name,
                            'city_id' => $city,
                            'city_name' => $rows_city->name,
                        );
                    $data_locations = json_encode($result_locations);
                    $result_cat = [];
                    foreach($data_categories  AS $key => $val){
                        $result_cat[] =
                            $data_categories[$key];

                    }
                    $categories  = json_encode($result_cat);
                    if(empty($select_business_jb)){
                        $select_business_jobs = null;
                    }else{
                        $select_business_jobs = $select_business_jb;
                    }

                    $variable = [
                        'id'                                => $this->generate_new_id_string() . get_random_alphanumeric(5),
                        'users_id'                          => $_SESSION['user_id'],
                        'pbd_business_id'                   => $select_business_jobs,
                        'data_name'                         => $data_name,
                        'jobs_types_id'                         => $data_type,
                        'data_categories'                   => $categories,
                        'data_description'                  => $data_description,
                        'jb_address'                        => $data_address,
                        'jobs_salary_period_id'             => $jobs_salary_period_id,
                        'jb_salary_currency'                => $jb_salary_currency,
                        'jb_salary_min'                     => $jb_salary_min,
                        'jb_salary_max'                     => $jb_salary_max,
                        'jb_contact_number'                 => $jb_contact_number,
                        'jb_contact_email'                  => $jb_contact_email,
                        'data_location'                     => $data_locations,
                        'file_name_thumbnail'               => $name_thumbnail_photo,
                        'file_name_original'                => $name_original_photo,
                        'file_path'                         => $file_path_photo,
                        'file_json'                         => $file_json_photo,
                        'cover_file_name_thumbnail'         => $name_thumbnail_cover,
                        'cover_file_name_original'          => $name_original_cover,
                        'cover_file_path'                   => $file_path_cover,
                        'cover_file_json'                   => $file_json_cover,
                        'status'                            => 1,
                        'created_by'                        => $_SESSION['user_id'],
                        'created_at'                        => date('Y-m-d H:i:s'),
                        'updated_by'                        => $user_id,
                        'updated_at'                        => date('Y-m-d H:i:s')
                    ];

            $this->db->insert('pcj_jobs', $variable);
            redirect(base_url('jobs/list'));
            }
        }

    }

    protected function action_update_jobs(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/jobs/photo';
            $path_thumbnail = 'public/uploads/jobs/photo'. '/thumb';
            $path_original_cover  = 'public/uploads/jobs/cover';
            $path_thumbnail_cover = 'public/uploads/jobs/cover'. '/thumb';
            $parameter_upload_column_name = '__logo_files';
            $parameter_upload_column_name_cover = '__cover_files';
            $this->load->library('image_upload_resize');
            $user_id = $this->input->post('id');

            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

                if (!empty($upload_image_responses['images'])) {
                    foreach ($upload_image_responses["images"] as $index => $response) {
                        $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                $name_thumbnail_photo = 'thumb_'.$response;
                                $name_original_photo  = $response;
                                $file_path_photo      = $config["destination_folder"];
                                $file_json_photo            = func_encrypt(json_encode($_FILES));
                    }

                }
                $configcover["generate_image_file"]          = true;
                $configcover["generate_thumbnails"]          = true;
                $configcover["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
                $configcover["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
                $configcover["thumbnail_prefix"]             = "thumb_";
                $configcover["destination_folder"]           = "{$path_original_cover}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
                $configcover["thumbnail_destination_folder"] = "{$path_thumbnail_cover}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
                $configcover["quality"]                      = 90;                                                            // JPEG QUALITY
                $configcover["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
                $configcover["upload_url"]                   = base_url($path_original) . '/';
                $configcover["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

                $configcover["file_data"]    = $_FILES[$parameter_upload_column_name_cover];
                $upload_image_responses_cover = $this->image_upload_resize->resize($configcover);

                    if (!empty($upload_image_responses_cover['images'])) {
                        foreach ($upload_image_responses_cover["images"] as $index => $response) {
                            $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                    $name_thumbnail_cover = 'thumb_'.$response;
                                    $name_original_cover  = $response;
                                    $file_path_cover      = $path_original_cover.'/';
                                    $file_json_cover      = func_encrypt(json_encode($_FILES));
                        }

                    }
                        $id               = $this->input->post('job-id');
                        $data_name        = $this->input->post('job-name');
                        $data_type        = $this->input->post('job-types');
                        $data_categories  = $this->input->post('job-categories');
                        $data_description = $this->input->post('job-description');
                        $data_address     = $this->input->post('job-address');
                        $jobs_salary_period_id  = $this->input->post('job-period');
						$jb_salary_currency = $this->input->post('currency');
                        $jb_salary_min    = $this->input->post('job-min-salary');
                        $jb_salary_max    = $this->input->post('job-max-salary');
                        $jb_contact_email = $this->input->post('job-email');
                        $jb_contact_number = $this->input->post('job-number');
                        $result_cat = [];
                        foreach($data_categories  AS $key => $val){
                            $result_cat[] =
                                $data_categories[$key];

                        }
                        $categories  = json_encode($result_cat);
                        $post['users_id']           = $_SESSION['user_id'];
                        $post['data_name']          = $data_name;
                        $post['jobs_types_id']      = $data_type;
                        $post['data_categories']    = $categories;
                        $post['data_description']   = $data_description;
                        $post['jb_address']         = $data_address;
                        $post['jobs_salary_period_id'] = $jobs_salary_period_id;
						$post['jb_salary_currency']    = $jb_salary_currency;
                        $post['jb_salary_min']         = $jb_salary_min;
                        $post['jb_salary_max']         = $jb_salary_max;
                        if (! empty($name_original_photo)) {
                            $post['file_name_thumbnail']= $name_thumbnail_photo;
                            $post['file_name_original'] = $name_original_photo;
                            $post['file_path']          = $file_path_photo;
                            $post['file_json']          = $file_json_photo;
                        } elseif (! empty($name_original_cover)) {
                            $post['cover_file_name_thumbnail'] = $name_thumbnail_cover;
                            $post['cover_file_name_original']  = $name_original_cover;
                            $post['cover_file_path']           = $file_path_cover;
                            $post['cover_file_json']           = $file_json_cover;
                        }
                        $post['status']                    = 1;
                        $post['created_by']                = $_SESSION['user_id'];
                        $post['created_at']                = date('Y-m-d H:i:s');
                        $post['updated_by']                = $user_id;
                        $post['updated_at']                = date('Y-m-d H:i:s');
                    }
                $this->db->where('pcj_jobs.id',$id);
                $this->db->update('pcj_jobs', $post);

                redirect(base_url('jobs/manage'));
        }

    }

    protected function action_store_apply(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */
            $job_id        = $this->input->post('job-id');
            $job_user      = $this->input->post('job-user');
            $data_description = $this->input->post('description');
            $form = $this->input->post('form');
            $file_url      = $this->input->post('__files');
            $check_cv      = $this->db->get_where('users_jobs',array('users_id'=>$_SESSION['user_id']))->row();
                if(empty($file_url)){

                    if (isset($_FILES['__files']['name']) && $_FILES['__files']['name'] != '') {
                        unset($config);
                        $date = date("ymd");
                        $user_id = $_SESSION['user_id'];
                        $configFile['upload_path'] = 'public/uploads/jobs/files/';
                        $configFile['max_size'] = '60000';
                        $configFile['allowed_types'] = 'pdf';
                        $configFile['overwrite'] = FALSE;
                        $configFile['remove_spaces'] = TRUE;
                        $file_name = $date.$user_id.random_string('alnum',20).'.pdf';
                        $configFile['file_name'] = $file_name;

                        $this->load->library('upload', $configFile);
                        $this->upload->initialize($configFile);

                        if($this->upload->do_upload('__files')) {
                            $variable = [
                                'users_id'                          => $_SESSION['user_id'],
                                'jobs_id'                           => $job_id,
                                'data_description'                  => $data_description,
                                'upload_file_name'                  => $file_name,
                                'upload_file_path'                  => $configFile['upload_path'],
                                'status'                            => 1,
                                'created_at'                        => date('Y-m-d H:i:s'),
                                'updated_at'                        => date('Y-m-d H:i:s')
                            ];
                            $this->db->insert('pcj_jobs_applicants', $variable);
                        }
                        $variable_users = [
                            'data_description'                  => $data_description,
                            'upload_file_name'                  => $file_name,
                            'upload_file_path'                  => $configFile['upload_path'],
                            'status'                            => 1,
                            'created_at'                        => date('Y-m-d H:i:s'),
                            'updated_at'                        => date('Y-m-d H:i:s')
                        ];
                        $this->db->where('users_jobs.users_id',$_SESSION['user_id']);
                        $this->db->update('users_jobs', $variable_users);
                }else{
                    $variable = [
                        'users_id'                          => $_SESSION['user_id'],
                        'jobs_id'                           => $job_id,
                        'data_description'                  => $data_description,
                        'upload_file_path'                  => $check_cv->upload_file_path,
                        'upload_file_name'                  => $check_cv->upload_file_name,
                        'status'                            => 1,
                        'created_at'                        => date('Y-m-d H:i:s'),
                        'updated_at'                        => date('Y-m-d H:i:s')
                    ];

            $this->db->insert('pcj_jobs_applicants', $variable);
                }

            }
            }
            if($form == 'form-detail'){
                redirect(base_url('jobs/detail/'.$job_id));
            }
            redirect(base_url('job/'.$job_user));
        }

    }

    protected function action_update_preference_jobs(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
            $jobs_id          = $this->input->post('job-id');
            $data_name        = $this->input->post('job-name');
            $data_type        = $this->input->post('job-types');
            $data_categories  = $this->input->post('job-categories');
            $data_description = $this->input->post('job-description');
            $jobs_salary_period_id  = $this->input->post('job-period');
			$jb_currency   	  = $this->input->post('job-currency');
            $jb_salary_min    = $this->input->post('job-min-salary');
            $jb_salary_max    = $this->input->post('job-max-salary');
            $current          = $this->input->post('current');
            $result_cat = [];
            foreach($data_categories  AS $key => $val){
                $result_cat[] =
                    $data_categories[$key];

            }
            $country          = $this->input->post('job-country');
            $state            = $this->input->post('job-state');
            $city             = $this->input->post('job-city');
            $file_url      = $this->input->post('__files');
            $maps             = $this->input->post('maps');
            $result_locations = array();
                $rows = $this->db->get_where('loc_countries', array('id'=>$country))->row();
                $rows_state = $this->db->get_where('loc_states', array('id'=>$state))->row();
                $rows_city = $this->db->get_where('loc_cities', array('id'=>$city))->row();
                $result_locations[] = array(
                    'country_id' => $country,
                    'country_name' => $rows->name,
                    'state_id' => $state,
                    'state_name' => $rows_state->name,
                    'city_id' => $city,
                    'city_name' => $rows_city->name,
                );
            $locations  = json_encode($result_locations);
            $categories  = json_encode($result_cat);
            if (isset($_FILES['__files']['name']) && $_FILES['__files']['name'] != '') {
                unset($config);
                $date = date("ymd");
                $user_id = $_SESSION['user_id'];
                $configFile['upload_path'] = 'public/uploads/jobs/files/';
                $configFile['max_size'] = '60000';
                $configFile['allowed_types'] = 'pdf';
                $configFile['overwrite'] = FALSE;
                $configFile['remove_spaces'] = TRUE;
                $file_name = $date.$user_id.random_string('alnum',20).'.pdf';
                $configFile['file_name'] = $file_name;

                $this->load->library('upload', $configFile);
                $this->upload->initialize($configFile);
                $variable = array();
                    if($this->upload->do_upload('__files')) {
                        $variable= [
                            'users_id'                          => $_SESSION['user_id'],
                            'data_name'                         => $data_name,
                            'jobs_types_id'                         => $data_type,
                            'data_categories'                   => $categories,
                            'data_description'                  => $data_description,
                            'data_location'                     => $locations,
                            'jobs_salary_period_id'             => $jobs_salary_period_id,
							'jb_currency'	                    => $jb_currency,
                            'jb_salary_min'                     => $jb_salary_min,
                            'jb_salary_max'                     => $jb_salary_max,
                            'upload_file_name'                   => $configFile['file_name'],
                            'upload_file_path'                   => $configFile['upload_path'],
                            'status'                            => 1,
                            'status_current_open_work'          => $current,
                            'created_at'                        => date('Y-m-d H:i:s'),
                            'updated_at'                        => date('Y-m-d H:i:s')
                        ];

                    }

                    $this->db->where('users_jobs.users_id',$_SESSION['user_id']);
                    $this->db->update('users_jobs',$variable);
                    redirect(base_url('jobs/preference'));


            }else{
                $variable= [
                    'users_id'                          => $_SESSION['user_id'],
                    'data_name'                         => $data_name,
                    'jobs_types_id'                     => $data_type,
                    'data_categories'                   => $categories,
                    'data_description'                  => $data_description,
                    'data_location'                     => $locations,
                    'jobs_salary_period_id'             => $jobs_salary_period_id,
					'jb_currency'	                    => $jb_currency,
                    'jb_salary_min'                     => $jb_salary_min,
                    'jb_salary_max'                     => $jb_salary_max,
                    'status'                            => 1,
                    'status_current_open_work'          => $current,
                    'created_at'                        => date('Y-m-d H:i:s'),
                    'updated_at'                        => date('Y-m-d H:i:s')
                ];

                $this->db->where('users_jobs.users_id',$_SESSION['user_id']);
                $this->db->update('users_jobs',$variable );
                redirect(base_url('jobs/preference'));

            }
    }

    protected function action_store_community(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/community/photo';
            $path_thumbnail = 'public/uploads/community/photo'. '/thumb';
            $path_original_cover  = 'public/uploads/community/cover';
            $path_thumbnail_cover = 'public/uploads/community/cover'. '/thumb';
            $parameter_upload_column_name = '__logo_files';
            $parameter_upload_column_name_cover = '__cover_files';
            $this->load->library('image_upload_resize');
            $user_id = $this->input->post('id');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

                if (!empty($upload_image_responses['images'])) {
                    foreach ($upload_image_responses["images"] as $index => $response) {
                        $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                $name_thumbnail_photo = 'thumb_'.$response;
                                $name_original_photo  = $response;
                                $file_path_photo      = $config["destination_folder"];
                                $file_json_photo            = func_encrypt(json_encode($_FILES));
                    }

                }

                $configcover["generate_image_file"]          = true;
                $configcover["generate_thumbnails"]          = true;
                $configcover["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
                $configcover["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
                $configcover["thumbnail_prefix"]             = "thumb_";
                $configcover["destination_folder"]           = "{$path_original_cover}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
                $configcover["thumbnail_destination_folder"] = "{$path_thumbnail_cover}/";                                          // UPLOAD DIRECTORY ENDS WITH / (SLASH)
                $configcover["quality"]                      = 90;                                                            // JPEG QUALITY
                $configcover["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
                $configcover["upload_url"]                   = base_url($path_original) . '/';
                $configcover["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

                $configcover["file_data"]    = $_FILES[$parameter_upload_column_name_cover];
                $upload_image_responses_cover = $this->image_upload_resize->resize($configcover);

                    if (!empty($upload_image_responses_cover['images'])) {
                        foreach ($upload_image_responses_cover["images"] as $index => $response) {
                            $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                    $name_thumbnail_cover = 'thumb_'.$response;
                                    $name_original_cover  = $response;
                                    $file_path_cover      = $path_original_cover.'/';
                                    $file_json_cover            = func_encrypt(json_encode($_FILES));
                        }

                    }

                    $data_name          = $this->input->post('com-name');
                    $username           = $this->input->post('username');
                    $data_description   = $this->input->post('com-description');
                    $status_privacy     = $this->input->post('com-privacy');
                    $data_categories    = $this->input->post('com-category');
                    $email_contact     = $this->input->post('email');
                    $phone_contact     = $this->input->post('phone');
                    $result_contact = [];
                    $data_set_post = 'data_community_contact';
                    if (isset($email_contact) ||  isset($phone_contact)) {

                        if (isset($email_contact)) {
                            $_POST[$data_set_post]['email'] = array_filter($email_contact);
                            sort($_POST[$data_set_post]['email']);
                        }

                        if (isset($phone_contact)) {
                            $_POST[$data_set_post]['phone'] = array_filter($phone_contact);
                            sort($_POST[$data_set_post]['phone']);
                        }

                        $result_contact = json_encode($_POST[$data_set_post]);
                        unset($_POST[$data_set_post]);
                    }
                    // $result_contact = array();
                    //     $result_contact[] = array(
                    //       'email'   => $email_contact,
                    //       'phone'   => $phone_contact,
                    //     );

                    $website           = $this->input->post('website');
                        $result_web = array();
                        foreach($website AS $key => $val){
                            $result_web[] = array(
                               'website'   => $website[$key],
                            );
                        }
                    $facebook           = $this->input->post('facebook');
                    $linkedin           = $this->input->post('linkedin');
                    $instagram          = $this->input->post('instagram');
                            $result_socmed = array();
                            $result_socmed[] = array(
                               'facebook'    => $facebook,
                               'linkedin'    => $linkedin,
                               'instagram'   => $instagram
                            );

                    $check_category = $this->db->get_where('pcs_communities_categories', array('id'=>$data_categories));

                    if($check_category->num_rows() < 1){
                        $post['id']          = random_string('alnum',20);
                        $post['data_name']   = $data_categories;
                        $post['published']   = date('Y-m-d H:i:s');
                        $post['status']      = 1;
                        $post['created_by']  = $_SESSION['user_id'];
                        $post['created_at']  = date('Y-m-d H:i:s');
                        $post['updated_by']  = $_SESSION['user_id'];
                        $post['updated_at']  = date('Y-m-d H:i:s');
                        $this->db->insert('pcs_communities_categories', $post);
                    }
                    if($check_category->num_rows() < 1){
                        $category_id = $post['id'];
                    }else{
                        $category_id = $data_categories;
                    }
                    if(empty($status_privacy)){
                        $privacy = 0;
                    }else{
                        $privacy = 1;
                    }
                    $variable = [
                        'id'                                => $this->generate_new_id_string() . get_random_alphanumeric(5),
                        'users_id'                          => $_SESSION['user_id'],
                        'data_name'                         => $data_name,
                        'data_description'                  => $data_description,
                        'data_categories'                   => $category_id,
                        'status_privacy'                    => $privacy,
                        'data_contact_info'                 => $result_contact,
                        'data_contact_website'              => json_encode($result_web),
                        'data_social_links'                 => json_encode($result_socmed),
                        'file_name_thumbnail'               => $name_thumbnail_photo,
                        'file_name_original'                => $name_original_photo,
                        'file_path'                         => $file_path_photo,
                        'file_json'                         => $file_json_photo,
                        'cover_file_name_thumbnail'         => $name_thumbnail_cover,
                        'cover_file_name_original'          => $name_original_cover,
                        'cover_file_path'                   => $file_path_cover,
                        'cover_file_json'                   => $file_json_cover,
                        'status'                            => 1,
                        'created_by'                        => $_SESSION['user_id'],
                        'created_at'                        => date('Y-m-d H:i:s'),
                        'updated_by'                        => $user_id,
                        'updated_at'                        => date('Y-m-d H:i:s')
                    ];

            $this->db->insert('pcs_communities', $variable);
            redirect(base_url('community/list'));
            }
        }

    }

    protected function action_update_community(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

                    $id                 = $this->input->post('com-id');
                    $data_name          = $this->input->post('com-name');
                    $username           = $this->input->post('username');
                    $data_description   = $this->input->post('com-description');
                    $status_privacy     = $this->input->post('com-privacy');
                    $data_categories    = $this->input->post('com-category');
                    $check_category = $this->db->get_where('pcs_communities_categories', array('id'=>$data_categories));

                    if($check_category->num_rows() < 1){
                        $post['id']          = random_string('alnum',20);
                        $post['data_name']   = $data_categories;
                        $post['published']   = date('Y-m-d H:i:s');
                        $post['status']      = 1;
                        $post['created_by']  = $_SESSION['user_id'];
                        $post['created_at']  = date('Y-m-d H:i:s');
                        $post['updated_by']  = $_SESSION['user_id'];
                        $post['updated_at']  = date('Y-m-d H:i:s');
                        $this->db->insert('pcs_communities_categories', $post);
                    }
                    if($check_category->num_rows() < 1){
                        $category_id = $post['id'];
                    }else{
                        $category_id = $data_categories;
                    }
                    if(empty($status_privacy)){
                        $privacy = 0;
                    }else{
                        $privacy = 1;
                    }
                    $variable = [
                        'users_id'                          => $_SESSION['user_id'],
                        'data_name'                         => $data_name,
                        'data_description'                  => $data_description,
                        'data_categories'                   => $category_id,
                        'status_privacy'                    => $privacy,
                        'status'                            => 1,
                        'updated_by'                        => $_SESSION['user_id'],
                        'updated_at'                        => date('Y-m-d H:i:s')
                    ];

            $this->db->where('pcs_communities.id',$id);
            $this->db->update('pcs_communities', $variable);
            redirect(base_url('community/manage'));
            }
        }

    }

    protected function action_photo_post_community(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/community/post';
            $path_thumbnail = 'public/uploads/community/post'. '/thumb';
            $parameter_upload_column_name = '__photo_post_files';
            $this->load->library('image_upload_resize');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

                if (!empty($upload_image_responses['images'])) {
                    foreach ($upload_image_responses["images"] as $index => $response) {
                        $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                $name_thumbnail_photo = 'thumb_'.$response;
                                $name_original_photo  = $response;
                                $file_path_photo      = $config["destination_folder"];
                                $file_json_photo            = func_encrypt(json_encode($_FILES));
                    }

                }

                    $community_id       = $this->input->post('community_id');
                    $users_id           = $_SESSION['user_id'];

                    $variable = [
                        'id'                                => $this->generate_new_id_string() . get_random_alphanumeric(5),
                        'users_id'                          => $users_id,
                        'pcs_communities_id'                => $community_id,
                        'file_image_name_thumbnail'         => $name_thumbnail_photo,
                        'file_image_name_original'          => $name_original_photo,
                        'file_image_path'                   => $file_path_photo,
                        'published'                         => date('Y-m-d H:i:s'),
                        'created_by'                        => 1,
                        'created_at'                        => date('Y-m-d H:i:s'),
                        'updated_by'                        => 1,
                        'updated_at'                        => date('Y-m-d H:i:s'),
                    ];

                    $this->db->insert('pcs_posts', $variable);
                    redirect(base_url('community/post/'.$community_id));
            }
        }

    }

    protected function action_photo_post_community_edit(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/community/post';
            $path_thumbnail = 'public/uploads/community/post'. '/thumb';
            $parameter_upload_column_name = '__photo_post_files';
            $this->load->library('image_upload_resize');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

                if (!empty($upload_image_responses['images'])) {
                    foreach ($upload_image_responses["images"] as $index => $response) {
                        $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                $name_thumbnail_photo = 'thumb_'.$response;
                                $name_original_photo  = $response;
                                $file_path_photo      = $config["destination_folder"];
                                $file_json_photo            = func_encrypt(json_encode($_FILES));
                    }

                }

                    $community_id       = $this->input->post('community_id');
                    $users_id           = $_SESSION['user_id'];
                    $photo_post_id            = $this->input->post('post_photo_id');

                    $variable = [
                        'users_id'                          => $users_id,
                        'pcs_communities_id'                => $community_id,
                        'file_image_name_thumbnail'         => $name_thumbnail_photo,
                        'file_image_name_original'          => $name_original_photo,
                        'file_image_path'                   => $file_path_photo,
                        'published'                         => date('Y-m-d H:i:s'),
                        'created_by'                        => 1,
                        'created_at'                        => date('Y-m-d H:i:s'),
                        'updated_by'                        => 1,
                        'updated_at'                        => date('Y-m-d H:i:s'),
                    ];

                    $this->db->where('pcs_posts.id',$photo_post_id);
                    $this->db->update('pcs_posts', $variable);
                    redirect(base_url('community/post/'.$community_id));
            }
        }

    }

    protected function action_video_post_community(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $data_description = $this->input->post('data_description');
            $video_url      = $this->input->post('video-url');
            $url = $this->input->post('form');
            if(empty($video_url)){
                if (isset($_FILES['__video_post_files']['name']) && $_FILES['__video_post_files']['name'] != '') {
                    $user_id           = $_SESSION['user_id'];
                    $community_id       = $this->input->post('community_id');
                    unset($config);
                    $date = date("ymd");
                    $configVideo['upload_path'] = 'public/uploads/profile/post/video';
                    $configVideo['max_size'] = '60000';
                    $configVideo['allowed_types'] = 'avi|flv|wmv|mp3|mp4';
                    $configVideo['overwrite'] = FALSE;
                    $configVideo['remove_spaces'] = TRUE;
                    $video_name = $date.$_FILES['__video_post_files']['name'];
                    $configVideo['file_name'] = $video_name;

                    $this->load->library('upload', $configVideo);
                    $this->upload->initialize($configVideo);
                        $variable = array();

                        if($this->upload->do_upload('__video_post_files')) {
                            $variable= [
                                'id'                                => $this->generate_new_id_string() . get_random_alphanumeric(5),
                                'parent'                                  => 0,
                                'pcs_communities_id'                      => $community_id,
                                'users_id'                                => $user_id,
                                'data_description'                        => $data_description,
                                'file_video_name'                         => $configVideo['file_name'],
                                'file_video_path'                         => $configVideo['upload_path'],
                                'published'                               => date('Y-m-d H:i:s'),
                                'created_by'                              => $user_id,
                                'created_at'                              => date('Y-m-d H:i:s'),
                                'updated_by'                              => $user_id,
                                'updated_at'                              => date('Y-m-d H:i:s')
                            ];

                        }
                        $this->db->insert('pcs_posts', $variable);
                        redirect(base_url('community/post/'.$community_id));
                }
            }else{
                $user_id  = $this->input->post('id');
                $community_id       = $this->input->post('community_id');
                $variable= [
                    'id'                                      => $this->generate_new_id_string() . get_random_alphanumeric(5),
                    'parent'                                  => 0,
                    'pcs_communities_id'                      => $community_id,
                    'users_id'                                => $user_id,
                    'data_description'                        => $data_description,
                    'file_video_name'                         => null,
                    'file_video_path'                         => null,
                    'file_video_url'                          => $video_url,
                    'published'                               => date('Y-m-d H:i:s'),
                    'created_by'                              => $user_id,
                    'created_at'                              => date('Y-m-d H:i:s'),
                    'updated_by'                              => $user_id,
                    'updated_at'                              => date('Y-m-d H:i:s')
                ];

                $this->db->insert('pcs_posts', $variable);
                redirect(base_url('community/post/'.$community_id));
            }
            }
        }
    }

    protected function action_video_post_community_edit(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $data_description = $this->input->post('data_description');
            $video_url      = $this->input->post('video-url');
            $url = $this->input->post('form');
            if(empty($video_url)){
                if (isset($_FILES['__video_post_files']['name']) && $_FILES['__video_post_files']['name'] != '') {
                    $$user_id           = $_SESSION['user_id'];
                    $community_id       = $this->input->post('community_id');
                    $post_video_id      = $this->input->post('post_video_id');
                    unset($config);
                    $date = date("ymd");
                    $configVideo['upload_path'] = 'public/uploads/profile/post/video';
                    $configVideo['max_size'] = '60000';
                    $configVideo['allowed_types'] = 'avi|flv|wmv|mp3|mp4';
                    $configVideo['overwrite'] = FALSE;
                    $configVideo['remove_spaces'] = TRUE;
                    $video_name = $date.$_FILES['__video_post_files']['name'];
                    $configVideo['file_name'] = $video_name;

                    $this->load->library('upload', $configVideo);
                    $this->upload->initialize($configVideo);
                        $variable = array();

                        if($this->upload->do_upload('__video_post_files')) {
                            $variable= [
                                'parent'                                  => 0,
                                'pcs_communities_id'                      => $community_id,
                                'users_id'                                => $user_id,
                                'data_description'                        => $data_description,
                                'file_video_name'                         => $configVideo['file_name'],
                                'file_video_path'                         => $configVideo['upload_path'],
                                'published'                               => date('Y-m-d H:i:s'),
                                'created_by'                              => $user_id,
                                'created_at'                              => date('Y-m-d H:i:s'),
                                'updated_by'                              => $user_id,
                                'updated_at'                              => date('Y-m-d H:i:s')
                            ];

                        }
                        $this->db->where('pcs_posts.id',$post_video_id);
                        $this->db->update('pcs_posts', $variable);
                        redirect(base_url('community/post/'.$community_id));
                }
            }else{
                $user_id  = $this->input->post('id');
                $community_id       = $this->input->post('community_id');
                $post_video_id      = $this->input->post('post_video_id');
                $variable= [
                    'parent'                                  => 0,
                    'users_id'                                => $user_id,
                    'pcs_communities_id'                      => $community_id,
                    'data_description'                        => $data_description,
                    'file_video_name'                         => null,
                    'file_video_path'                         => null,
                    'file_video_url'                          => $video_url,
                    'published'                               => date('Y-m-d H:i:s'),
                    'created_by'                              => $user_id,
                    'created_at'                              => date('Y-m-d H:i:s'),
                    'updated_by'                              => $user_id,
                    'updated_at'                              => date('Y-m-d H:i:s')
                ];

                $this->db->where('pcs_posts.id',$post_video_id);
                $this->db->update('pcs_posts', $variable);
                redirect(base_url('community/post/'.$community_id));
            }
            }
        }
    }

    protected function action_cover_profile_community(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {
            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/community/cover';
            $path_thumbnail = 'public/uploads/community/cover'. '/thumb';
            $parameter_upload_column_name = '__cover_files';
            $this->load->library('image_upload_resize');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

                if (!empty($upload_image_responses['images'])) {
                    foreach ($upload_image_responses["images"] as $index => $response) {
                        $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                $name_thumbnail_photo = 'thumb_'.$response;
                                $name_original_photo  = $response;
                                $file_path_photo      = $config["destination_folder"];
                                $file_json_photo            = func_encrypt(json_encode($_FILES));
                    }

                }

                    $community_id       = $this->input->post('community_id');
                    $users_id           = $this->input->post('id');

                    $variable = [
                        'cover_file_name_thumbnail'               => $name_thumbnail_photo,
                        'cover_file_name_original'                => $name_original_photo,
                        'cover_file_path'                         => $file_path_photo,
                    ];

                    $this->db->where('pcs_communities.id',$community_id);
                    $this->db->update('pcs_communities', $variable);
                    redirect(base_url('community/post/'.$community_id));
            }
        }

    }

    protected function action_photo_profile_community(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {
            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/community/photo';
            $path_thumbnail = 'public/uploads/community/photo'. '/thumb';
            $parameter_upload_column_name = '__photo_files';
            $this->load->library('image_upload_resize');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

                if (!empty($upload_image_responses['images'])) {
                    foreach ($upload_image_responses["images"] as $index => $response) {
                        $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                $name_thumbnail_photo = 'thumb_'.$response;
                                $name_original_photo  = $response;
                                $file_path_photo      = $config["destination_folder"];
                                $file_json_photo            = func_encrypt(json_encode($_FILES));
                    }

                }

                    $community_id       = $this->input->post('community_id');
                    $users_id           = $this->input->post('id');

                    $variable = [
                        'file_name_thumbnail'               => $name_thumbnail_photo,
                        'file_name_original'                => $name_original_photo,
                        'file_path'                         => $file_path_photo,
                    ];

                    $this->db->where('pcs_communities.id',$community_id);
                    $this->db->update('pcs_communities', $variable);
                    redirect(base_url('community/post/'.$community_id));
            }
        }

    }

    protected function action_albums_community(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/community/photo';
            $path_thumbnail = 'public/uploads/community/photo'. '/thumb';
            $parameter_upload_column_name = '__album_files';
            $this->load->library('image_upload_resize');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

                if (!empty($upload_image_responses['images'])) {
                    foreach ($upload_image_responses["images"] as $index => $response) {
                        $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                $name_thumbnail_photo = 'thumb_'.$response;
                                $name_original_photo  = $response;
                                $file_path_photo      = $config["destination_folder"];
                                $file_json_photo            = func_encrypt(json_encode($_FILES));
                    }

                }

                    $community_id       = $this->input->post('id');
                    $name               = $this->input->post('name');
                    $variable = [
                        'id'                                => $this->generate_new_id_string() . get_random_alphanumeric(5),
                        'user_id'                          => $_SESSION['user_id'],
                        'pcs_communities_id'                => $community_id,
                        'data_name'                         => $name,
                        'file_name_thumbnail'               => $name_thumbnail_photo,
                        'file_name_original'                 => $name_original_photo,
                        'file_path'                         => $file_path_photo,
                        'published'                         => date('Y-m-d H:i:s'),
                        'created_by'                        => 1,
                        'created_at'                        => date('Y-m-d H:i:s'),
                        'updated_by'                        => 1,
                        'updated_at'                        => date('Y-m-d H:i:s'),
                    ];

                    $this->db->insert('pcs_communities_albums', $variable);
                    redirect(base_url('community/photo/'.$community_id));
            }
        }

    }

    protected function action_albums_photo_community(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/community/photo';
            $path_thumbnail = 'public/uploads/community/photo'. '/thumb';
            $parameter_upload_column_name = '__photo_album_files';
            $this->load->library('image_upload_resize');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

                if (!empty($upload_image_responses['images'])) {
                    foreach ($upload_image_responses["images"] as $index => $response) {
                        $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                $name_thumbnail_photo = 'thumb_'.$response;
                                $name_original_photo  = $response;
                                $file_path_photo      = $config["destination_folder"];
                                $file_json_photo            = func_encrypt(json_encode($_FILES));
                    }

                }

                    $community_id       = $this->input->post('id');
                    $albums             = $this->input->post('album');
                    $caption            = $this->input->post('caption');
                    $variable = [
                        'id'                                => $this->generate_new_id_string() . get_random_alphanumeric(5),
                        'users_id'                           => $_SESSION['user_id'],
                        'pcs_communities_id'                => $community_id,
                        'pcs_communities_albums_id'         => $albums,
                        'file_caption'                      => $caption,
                        'file_name_thumbnail'               => $name_thumbnail_photo,
                        'file_name_original'                => $name_original_photo,
                        'file_path'                         => $file_path_photo,
                        'published'                         => date('Y-m-d H:i:s'),
                        'created_by'                        => 1,
                        'created_at'                        => date('Y-m-d H:i:s'),
                        'updated_by'                        => 1,
                        'updated_at'                        => date('Y-m-d H:i:s'),
                    ];

                    $this->db->insert('pcs_communities_albums_photo', $variable);
                    redirect(base_url('community/photo/'.$community_id));
            }
        }

    }

    protected function action_photo_profile_job(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {
            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/jobs/photo';
            $path_thumbnail = 'public/uploads/jobs/photo'. '/thumb';
            $parameter_upload_column_name = '__photo_files';
            $this->load->library('image_upload_resize');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

                if (!empty($upload_image_responses['images'])) {
                    foreach ($upload_image_responses["images"] as $index => $response) {
                        $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                $name_thumbnail_photo = 'thumb_'.$response;
                                $name_original_photo  = $response;
                                $file_path_photo      = $config["destination_folder"];
                                $file_json_photo            = func_encrypt(json_encode($_FILES));
                    }

                }

                    $job_id       = $this->input->post('job-id');
                    $users_id           = $this->input->post('id');

                    $variable = [
                        'file_name_thumbnail'               => $name_thumbnail_photo,
                        'file_name_original'                => $name_original_photo,
                        'file_path'                         => $file_path_photo,
                    ];

                    $this->db->where('pcj_jobs.id',$job_id);
                    $this->db->update('pcj_jobs', $variable);
                    redirect(base_url('jobs/detail/'.$job_id));
            }
        }

    }

    protected function action_cover_profile_job(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {
            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/jobs/cover';
            $path_thumbnail = 'public/uploads/jobs/cover'. '/thumb';
            $parameter_upload_column_name = '__cover_files';
            $this->load->library('image_upload_resize');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

                if (!empty($upload_image_responses['images'])) {
                    foreach ($upload_image_responses["images"] as $index => $response) {
                        $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                                $name_thumbnail_photo = 'thumb_'.$response;
                                $name_original_photo  = $response;
                                $file_path_photo      = $config["destination_folder"];
                                $file_json_photo            = func_encrypt(json_encode($_FILES));
                    }

                }

                    $job_id       = $this->input->post('job-id');
                    $users_id           = $this->input->post('id');

                    $variable = [
                        'cover_file_name_thumbnail'               => $name_thumbnail_photo,
                        'cover_file_name_original'                => $name_original_photo,
                        'cover_file_path'                         => $file_path_photo,
                    ];

                    $this->db->where('pcj_jobs.id',$job_id);
                    $this->db->update('pcj_jobs', $variable);
                    redirect(base_url('jobs/detail/'.$job_id));
            }
        }

    }

	protected function action_store_tender(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/tender/photo';
            $path_thumbnail = 'public/uploads/tender/photo'. '/thumb';
            $parameter_upload_column_name = '__logo_files';
            $this->load->library('image_upload_resize');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

            if (!empty($upload_image_responses['images'])) {
                foreach ($upload_image_responses["images"] as $index => $response) {
                    $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                        $name_thumbnail_photo = 'thumb_'.$response;
                        $name_original_photo  = $response;
                        $file_path_photo      = $config["destination_folder"];
                        $file_json_photo            = func_encrypt(json_encode($_FILES));
                }
            }

            $tender_type        = $this->input->post('tender-type');
            $tender_category    = $this->input->post('tender-category');
            $tender_name        = $this->input->post('tender-name');
            $tender_description = $this->input->post('tender-description');
            $tender_open                 = $this->input->post('tender-open');
            $select_business    = $this->input->post('select_business_id');
			$country          = $this->input->post('tender-country');
			$state            = $this->input->post('tender-state');
			$city             = $this->input->post('tender-city');
			$maps             = $this->input->post('maps');
			$result_locations = array();
				$rows = $this->db->get_where('loc_countries', array('id'=>$country))->row();
				$rows_state = $this->db->get_where('loc_states', array('id'=>$state))->row();
				$rows_city = $this->db->get_where('loc_cities', array('id'=>$city))->row();
				$result_locations[] = array(
					'country_id' => $country,
					'country_name' => $rows->name,
					'state_id' => $state,
					'state_name' => $rows_state->name,
					'city_id' => $city,
					'city_name' => $rows_city->name,
				);
			$data_locations = json_encode($result_locations);
            if(empty($select_business)){
                $select_business = null;
            }else{
                $select_business = $select_business;
            }
            $post['id']                = $this->generate_new_id_string() . get_random_alphanumeric(5);
            $post['users_id']          = $_SESSION['user_id'];
            $post['pbd_business_id']   = $select_business;
            $post['data_categories']   = $tender_category;
            $post['data_types']        = $tender_type;
            $post['data_name']         = $tender_name;
			$post['data_description']   = $tender_description;
			$post['file_name_thumbnail']= $name_thumbnail_photo;
			$post['file_name_original'] = $name_original_photo;
			$post['file_path']          = $file_path_photo;
			$post['file_json']          = $file_json_photo;
			$post['date_open']			= $tender_open;
			$post['data_locations']		= $data_locations;
			$post['status']             = 1;
			$post['published']          = date('Y-m-d H:i:s');
			$post['created_by']         = $_SESSION['user_id'];
			$post['created_at']         = date('Y-m-d H:i:s');
			$post['updated_by']         = $_SESSION['user_id'];
			$post['updated_at']         = date('Y-m-d H:i:s');

        $this->db->insert('pbt_tender', $post);
        redirect(base_url('tender/list'));
        }
    }
	}

	protected function action_update_tender(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/tender/photo';
            $path_thumbnail = 'public/uploads/tender/photo'. '/thumb';
            $parameter_upload_column_name = '__logo_files';
            $this->load->library('image_upload_resize');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

            if (!empty($upload_image_responses['images'])) {
                foreach ($upload_image_responses["images"] as $index => $response) {
                    $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                        $name_thumbnail_photo = 'thumb_'.$response;
                        $name_original_photo  = $response;
                        $file_path_photo      = $config["destination_folder"];
                        $file_json_photo            = func_encrypt(json_encode($_FILES));
                }
            }
			$tender_id 	        = $this->input->post('tender-id');
            $tender_type        = $this->input->post('tender-type');
            $tender_category    = $this->input->post('tender-category');
            $tender_name        = $this->input->post('tender-name');
            $tender_description = $this->input->post('tender-description');
            $tender_open                 = $this->input->post('tender-open');
            $select_business    = $this->input->post('select_business_id');
			$country          = $this->input->post('tender-country');
			$state            = $this->input->post('tender-state');
			$city             = $this->input->post('tender-city');
			$maps             = $this->input->post('maps');
			$result_locations = array();
				$rows = $this->db->get_where('loc_countries', array('id'=>$country))->row();
				$rows_state = $this->db->get_where('loc_states', array('id'=>$state))->row();
				$rows_city = $this->db->get_where('loc_cities', array('id'=>$city))->row();
				$result_locations[] = array(
					'country_id' => $country,
					'country_name' => $rows->name,
					'state_id' => $state,
					'state_name' => $rows_state->name,
					'city_id' => $city,
					'city_name' => $rows_city->name,
				);
			$data_locations = json_encode($result_locations);
            if(empty($select_business)){
                $select_business = null;
            }else{
                $select_business = $select_business;
            }
            $post['id']                = $this->generate_new_id_string() . get_random_alphanumeric(5);
            $post['users_id']          = $_SESSION['user_id'];
            $post['pbd_business_id']   = $select_business;
            $post['data_categories']   = $tender_category;
            $post['data_types']        = $tender_type;
            $post['data_name']         = $tender_name;
			$post['data_description']   = $tender_description;
			if (!empty($name_original_photo)) {
				$post['file_name_thumbnail']= $name_thumbnail_photo;
				$post['file_name_original'] = $name_original_photo;
				$post['file_path']          = $file_path_photo;
				$post['file_json']          = $file_json_photo;
			}
			$post['date_open']			= $tender_open;
			$post['data_locations']		= $data_locations;
			$post['status']             = 1;
			$post['published']          = date('Y-m-d H:i:s');
			$post['created_by']         = $_SESSION['user_id'];
			$post['created_at']         = date('Y-m-d H:i:s');
			$post['updated_by']         = $_SESSION['user_id'];
			$post['updated_at']         = date('Y-m-d H:i:s');

			$this->db->where('pbt_tender.id',$tender_id);
			$this->db->update('pbt_tender', $post);
       	 redirect(base_url('tender/manage'));
        }
    }
	}

	protected function action_store_buy(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */
            $path_original  = 'public/uploads/products/photo';
            $path_thumbnail = 'public/uploads/products/photo'. '/thumb';
            $parameter_upload_column_name = '__logo_files';
            $this->load->library('image_upload_resize');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

            if (!empty($upload_image_responses['images'])) {
                foreach ($upload_image_responses["images"] as $index => $response) {
                    $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                        $name_thumbnail_photo = 'thumb_'.$response;
                        $name_original_photo  = $response;
                        $file_path_photo      = $config["destination_folder"];
                        $file_json_photo            = func_encrypt(json_encode($_FILES));
                }
            }

            $product_type        = $this->input->post('product-type');
            $product_category    = $this->input->post('product-category');
			$product_sub_category = $this->input->post('product-sub-category');
			$product_part_category = $this->input->post('part-category');
            $product_name        = $this->input->post('product-name');
			$product_condition	 = $this->input->post('product-condition');		
			$product_status		 = $this->input->post('product-status');
            $product_type_price  = $this->input->post('product-type-price');
            $product_price       = $this->input->post('product-price');
            $product_currency    = $this->input->post('product-currency');
            $price               = $this->input->post('price');
            $product_label       = $this->input->post('product-label');
            $product_description = $this->input->post('product-description');
            $sku                 = $this->input->post('sku');
            $publish              = $this->input->post('publish');
            $select_business    = $this->input->post('select_business_id');
            $variant_qty  = $this->input->post('product-count-variant[]');
            $variant_price  	= $this->input->post('product-price-variant[]');
			$vehicle_years 		= $this->input->post('vehicle-years');
			$vehicle_brand		= $this->input->post('vehicle-brand');
			$vehicle_model		= $this->input->post('vehicle-model');
			$property_bathroom 	= $this->input->post('property-bathroom');
			$property_bedroom	= $this->input->post('property-bedroom');
			$property_size 		= $this->input->post('property-size');
			$product_email		 = $this->input->post('product-email');
			$product_phone		 = $this->input->post('product-phone');
			$country          = $this->input->post('product-country');
			$state            = $this->input->post('product-state');
			$city             = $this->input->post('product-city');
			$result_locations = array();
				$rows = $this->db->get_where('loc_countries', array('id'=>$country))->row();
				$rows_state = $this->db->get_where('loc_states', array('id'=>$state))->row();
				$rows_city = $this->db->get_where('loc_cities', array('id'=>$city))->row();
				$result_locations[] = array(
					'country_id' => $country,
					'country_name' => $rows->name,
					'state_id' => $state,
					'state_name' => $rows_state->name,
					'city_id' => $city,
					'city_name' => $rows_city->name,
				);
			$data_locations = json_encode($result_locations);
            $result_cat = [];
            foreach($product_category AS $key => $val){
                $result_cat[] =
                    $product_category[$key];

            }
            $result = [];
			$result_sub_cat = [];
            foreach($product_sub_category AS $key => $val){
                $result_sub_cat[] =
                    $product_sub_category[$key];

            }

			$result = [];
			$result_part_cat = [];
            foreach($product_part_category AS $key => $val){
                $result_part_cat[] =
                    $product_part_category[$key];

            }
            $result = [];
            foreach($variant_qty AS $key => $val){
                    $result[] = array(
                    'qty'   => $variant_qty[$key],
                    'price'   => $variant_price[$key],
                    );

            }
            if(empty($publish)){
                $published = 0;
            }else{
                $published = $publish;
            }
            if(empty($select_business)){
                $select_business = null;
            }else{
                $select_business = $select_business;
            }
            $post['id']                = $this->generate_new_id_string() . get_random_alphanumeric(5);
            $post['users_id']          = $_SESSION['user_id'];
            $post['pbd_business_id']   = $select_business;
            $post['data_categories']   = json_encode($result_cat);
			$post['data_sub_categories']   = json_encode($result_sub_cat);
			$post['data_part_categories']   = json_encode($result_part_cat);
            $post['data_type']         = $product_type;
            $post['data_name']         = $product_name;
            $post['price_type']         = $product_type_price;
            $post['price_currency']     = $product_currency;
			$post['data_locations']		= $data_locations;
            if($product_type_price == 2){
                $post['price_low']          = $price;
                $post['price_high']        = $price;
            }elseif($product_type_price == 3){
                $post['price_low']          = $price;
                $post['price_high']        = 0;
            }elseif($product_type_price == 5){
                $post['price_variant']          = json_encode($result);
            }else{
                $post['price_low']          = 0;
                $post['price_high']        = 0;
            }
        }
        $post['data_label']         = $product_label;
        $post['data_description']   = $product_description;
        $post['data_sku']           = $sku;
        $post['file_name_thumbnail']= $name_thumbnail_photo;
        $post['file_name_original'] = $name_original_photo;
        $post['file_path']          = $file_path_photo;
        $post['file_json']          = $file_json_photo;
        $post['status']             = 1;
		$post['status_buy_sells']	= 1;
        $post['published']          = date('Y-m-d H:i:s');
        $post['created_by']         = $_SESSION['user_id'];
        $post['created_at']         = date('Y-m-d H:i:s');
        $post['updated_by']         = $_SESSION['user_id'];
        $post['updated_at']         = date('Y-m-d H:i:s');
		$post['data_email']   	 	= $product_email;
		$post['data_phone']   	 	= $product_phone;
		$post['data_locations']		= $data_locations;
        $this->db->insert('pbd_items', $post);
		$sells['id']                = $this->generate_new_id_string() . get_random_alphanumeric(5);
		$sells['pbd_items_id']		= $post['id'];
		$sells['users_id']          = $_SESSION['user_id'];
		$sells['pbd_business_id']   = $select_business;
		$sells['data_type_sub']     = $product_type;
		$sells['data_condition']	= $product_condition;
		$sells['data_detail_year']	= $vehicle_years;
		$sells['data_detail_brand']	= $vehicle_brand;
		$sells['data_detail_model']	= $vehicle_model;
		$sells['data_detail_bedroom']	= $property_bedroom;
		$sells['data_detail_bathroom']	= $property_bathroom;
		$sells['data_detail_size']	= $property_size;
		$sells['data_status']		= $product_status;
		$sells['data_description']	= $product_description;
		$sells['data_email']   	 	 = $product_email;
		$sells['data_phone']   	 	 = $product_phone;
        $sells['created_by']         = $_SESSION['user_id'];
        $sells['created_at']         = date('Y-m-d H:i:s');
        $sells['updated_by']         = $_SESSION['user_id'];
        $sells['updated_at']         = date('Y-m-d H:i:s');
		$photo['module_id'] = $post['id'];
		$token =  $this->session->userdata('token_photo');
		$this->db->where('token',$token);
        $this->db->update('gallery_photo', $photo);
		$this->db->insert('pbd_items_sells', $sells);
        redirect(base_url('buysells/list'));
        }
    }

	protected function action_update_buy(
        $parameter_upload_column_name = null,
        $parameter_url_source = null,
        $parameter_id = null
    )
    {
        if ($this->is_request_post()) {
            $this->set_form_validation();


            $parameter_upload_destination = null;
            $parameter_upload_size_maximum = array(
                'original'  => 1136,
                'thumbnail' => 160
            );
        {

            /**
             *  1. Process upload image to server
             *  2. validate file type and size
             *  3. create multiple file for other dimension proportional
             */

            $path_original  = 'public/uploads/products/photo';
            $path_thumbnail = 'public/uploads/products/photo'. '/thumb';
            $parameter_upload_column_name = '__logo_files';
            $this->load->library('image_upload_resize');
            $config["generate_image_file"]          = true;
            $config["generate_thumbnails"]          = true;
            $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)
            $config["thumbnail_size"]               = $parameter_upload_size_maximum['thumbnail'];                   // THUMBNAILS WILL BE CROPPED TO 200X200 PIXELS
            $config["thumbnail_prefix"]             = "thumb_";                                                      // NORMAL THUMB PREFIX
            $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["thumbnail_destination_folder"] = "{$path_thumbnail}/";                                         // UPLOAD DIRECTORY ENDS WITH / (SLASH)
            $config["quality"]                      = 90;                                                            // JPEG QUALITY
            $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
            $config["upload_url"]                   = base_url($path_original) . '/';
            $config["upload_url_thumbs"]            = base_url($path_thumbnail) . '/';

            $config["file_data"]    = $_FILES[$parameter_upload_column_name];
            $upload_image_responses = $this->image_upload_resize->resize($config);

            if (!empty($upload_image_responses['images'])) {
                foreach ($upload_image_responses["images"] as $index => $response) {
                    $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                        $name_thumbnail_photo = 'thumb_'.$response;
                        $name_original_photo  = $response;
                        $file_path_photo      = $config["destination_folder"];
                        $file_json_photo            = func_encrypt(json_encode($_FILES));
                }
            }
            $product_id          = $this->input->post('product-id');
            $product_category    = $this->input->post('product-category');
			$product_type		 = $this->input->post('product-type');
			$product_condition	 = $this->input->post('product-condition');
			$product_status		 = $this->input->post('product-status');
            $product_name        = $this->input->post('product-name');
            $product_type_price  = $this->input->post('product-type-price');
            $product_label       = $this->input->post('product-label');
            $price               = $this->input->post('price');
            $product_description = $this->input->post('product-description');
            $product_sku = $this->input->post('sku');
            $select_business    = $this->input->post('select_business_id');
            $variant_qty  = $this->input->post('product-count-variant[]');
            $variant_price  = $this->input->post('product-price-variant[]');
			$product_email		 = $this->input->post('product-email');
			$product_phone		 = $this->input->post('product-phone');
			$country          = $this->input->post('product-country');
			$state            = $this->input->post('product-state');
			$city             = $this->input->post('product-city');
			$result_locations = array();
				$rows = $this->db->get_where('loc_countries', array('id'=>$country))->row();
				$rows_state = $this->db->get_where('loc_states', array('id'=>$state))->row();
				$rows_city = $this->db->get_where('loc_cities', array('id'=>$city))->row();
				$result_locations[] = array(
					'country_id' => $country,
					'country_name' => $rows->name,
					'state_id' => $state,
					'state_name' => $rows_state->name,
					'city_id' => $city,
					'city_name' => $rows_city->name,
				);
			$data_locations = json_encode($result_locations);
            $result_cat = [];
            foreach($product_category AS $key => $val){
                $result_cat[] =
                    $product_category[$key];

            }
            $result = [];
            foreach($variant_qty AS $key => $val){
                    $result[] = array(
                    'qty'   => $variant_qty[$key],
                    'price'   => $variant_price[$key],
                    );

            }

            if(empty($select_business)){
                $select_business = null;
            }else{
                $select_business = $select_business;
            }

            $post['users_id']          = $_SESSION['user_id'];
            $post['pbd_business_id']   = $select_business;
            $post['data_categories']   = json_encode($result_cat);
            $post['data_name']         = $product_name;
            $post['price_type']         = $product_type_price;
            if($product_type_price == 2){
                $post['price_low']          = $price;
                $post['price_high']        = $price;
            }elseif($product_type_price == 3){
                $post['price_low']          = $price;
                $post['price_high']        = 0;
            }elseif($product_type_price == 5){
                $post['price_variant']          = json_encode($result);
            }else{
                $post['price_low']          = 0;
                $post['price_high']        = 0;
            }
        }
        $post['data_description']   = $product_description;
        $post['data_sku'] = $product_sku;
        $post['data_label'] = $product_label;
		if (!empty($name_original_photo)) {
        $post['file_name_thumbnail']= $name_thumbnail_photo;
        $post['file_name_original'] = $name_original_photo;
		}
        $post['file_path']          = $file_path_photo;
        $post['file_json']          = $file_json_photo;
        $post['published']          = date('Y-m-d H:i:s');
        $post['updated_by']         = $_SESSION['user_id'];
        $post['updated_at']         = date('Y-m-d H:i:s');
		$post['data_email']   	 	= $product_email;
		$post['data_phone']   	 	= $product_phone;
		$post['data_locations']		= $data_locations;
        $this->db->where('pbd_items.id',$product_id);
        $this->db->update('pbd_items', $post);

		$postSells['data_type_sub'] 	 = $product_type;
		$postSells['data_description']   = $product_description;
		$postSells['data_condition']   	 = $product_condition;
		$postSells['data_status']   	 = $product_status;
		$postSells['data_email']   	 	 = $product_email;
		$postSells['data_phone']   	 	 = $product_phone;
		$this->db->where('pbd_items_sells.pbd_items_id',$product_id);
        $this->db->update('pbd_items_sells', $postSells);
		$token =  $this->session->userdata('token_photo');
		$photo['module_id'] = $product_id;
		$this->db->where('token',$token);
        $this->db->update('gallery_photo', $photo);
        redirect(base_url('buysells/manage'));
        }
    }

}
