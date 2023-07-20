<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Cron extends Base_users
{
    private   $module_page         = array(
        'index'        => 'index',
    );
    protected $module_base                  = 'cron';
    protected $apps_output_message = array(
        'status'  => '',
        'title'   => '',
        'message' => ''
    );

    public function __construct()
    {
      parent::__construct();
    //   if (!$this->input->is_cli_request()) {
    //   show_error('Direct access is not allowed');
    //   }
    }
   
    public function run()
    {
       $this->load->library('CronRunner');
       $cron = new CronRunner();
       $cron->run();
    }
   }