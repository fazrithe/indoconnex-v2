<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_admin.php';

class mod_imagify extends Base_admin
{
    public function __construct()
    {
        parent::__construct();
        $this->apps_title_module = 'Imagify';
        $this->apps_breadcrumb[] = [
            'title' => $this->apps_title_module,
            'link'  => base_url($this->module_url_default),
        ];
    }


    public function index()
    {
		$this->load->library('imagify');
        $path = FCPATH.'public/uploads/pbd_business/';
        $options = array('keep_exif' => true, 'resize'=>array("width"=>1));
        $handle = $this->imagify->optimize($path.'61a9849641d8f.png', $options);
        if (true === $handle->success)
        {
            $image_data = file_get_contents($handle->image);
            file_put_contents($path.'aaaaaaaa.png', $image_data);
            echo '<h1>Imagen optimizada!</h1>';
        } else
        {
            echo '<h1>Error: ' . $handle->message . '</h1>';
        }
    }
}
