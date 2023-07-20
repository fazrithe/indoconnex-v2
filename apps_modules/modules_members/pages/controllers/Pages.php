<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Pages extends Base_users
{
	protected $module_base                  = 'business/list';
	protected $apps_title_module            = 'profile';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation','pagination');
		$this->load->model('M_business');
		if(!empty($this->session->userdata('is_login') == FALSE)){
			// alert peringatan bahwa harus login
			$this->session->set_flashdata('failed','You are not logged in, please login first!');
			redirect(base_url('user/login'));
		}
	}

	/** List Business Page */
	public function index()
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

		$data['business_list'] = $this->db->get_where('pbd_business',array('users_id'=>$user_id,'status'=>1))->result();
		$data['business_claims'] = $this->M_business->business_claim($user_id)->result();
		// echo json_encode($data['business_claim']);
		// exit();
		config('title', 'My Business Page');
		$this->display('index', $data);
	}

}
