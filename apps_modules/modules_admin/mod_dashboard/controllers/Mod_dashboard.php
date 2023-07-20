<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_admin.php';

class Mod_dashboard extends Base_admin
{
    private $module_page = array(
        'index'        => 'index',
        'index_footer' => 'footer_index',
    );

    public function index()
    {
        $data = array();
        $this->display($this->module_page['index'], $data, $this->module_page['index_footer']);
    }
}
