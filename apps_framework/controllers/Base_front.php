<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base.php';

class Base_front extends Base
{
    protected $module_base        = '';
    protected $module_portal      = 'public';
    protected $module_global_view = 'apps/views/';

    protected $apps_title        = 'Home';
    protected $apps_title_module = 'General';
    protected $apps_breadcrumb   = array();
    protected $apps_setting      = array();

    public function __construct()
    {
        parent::__construct();
        $this->apps_breadcrumb[] = array(
            'title' => 'Dashboard',
            'link'  => base_url('mod_dashboard')
        );
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
        $page_partials                 = [
            'partials_meta_css'           => "{$this->module_portal}/partials/meta_css",
            'partials_header'             => "{$this->module_portal}/partials/header",
            'partials_sidebar'            => "{$this->module_portal}/partials/sidebar",
            'partials_navbar'             => "{$this->module_portal}/partials/navbar",
            'partials_footer'             => "{$this->module_portal}/partials/footer",
            'partials_footer_script'      => "{$this->module_portal}/partials/script",
            'partial_filter'              => "{$this->module_portal}/partials/filter_main",
            'partial_how_works'           => "{$this->module_portal}/partials/how_works",
            'partial_about_join'           => "{$this->module_portal}/partials/about_join",
            'partial_vision_mission'           => "{$this->module_portal}/partials/vision_mission",
            'partial_partners'           => "{$this->module_portal}/partials/partners",
            'partial_ajax_public'        => "{$this->module_portal}/partials/ajax_public",
			'partial_banner'				 => "{$this->module_portal}/partials/banner",
			'action_ajax_search' => "{$this->module_portal}/partials/action_ajax_search",
            'page_content'                => $tpl_content,
            'partials_footer_script_page' => $tpl_footer,
            'partials_global'             => "{$this->module_global_view}/{$this->module_portal}",
            'partials_view'               => "{$this->module_portal}/{$this->module_base}",
        ];
        $data['template']              = $page_partials;
        $this->load->view('public/themes', $data);
    }

}
