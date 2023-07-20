<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_front.php';

class Home extends Base_front
{
	protected $module_base                  = 'dahboard';
	protected $apps_title_module            = 'Dashboard';
	private   $_table                       = "users";
	protected $apps_output_message = array(
		'status'  => '',
		'title'   => '',
		'message' => ''
	);
	public function __construct()
	{

		parent::__construct();
		$this->load->database();
		$this->lang->load('output_message');
		$this->load->helper(array('form', 'url','string'));
		$this->load->library('session');
		$this->load->model('Main_model');
		$this->load->library(array('form_validation','session','user_agent','swiftmailer'));
	}

	/** Home Public */
	public function index()
	{
		if ($this->input->post()) {

		} else {

			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
			if(!empty($this->session->userdata('is_login'))){
				$id = $this->session->userdata('user_id');
				$data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
			}
			$data['business_categories'] = $this->db->get_where('pbd_business_categories',array('status'=>1,'parent'=>0))->result();
			$data['search_place'] = 'Search';
			$data['jobs_categories'] = $this->db->get_where('pcj_jobs_categories',array('status'=>1))->result();
			$data['work']			=  $this->db->get_where('pub_works',array('status'=>1))->result();
			$data["partners"] 		= $this->db->get_where('pub_partners',array('status'=>1))->result();
			$data["supports"] 		= $this->db->get_where('pub_supports',array('status'=>1))->result();
			$data['widget']			= $this->db->get_where('pub_widgets',array('status'=>1,'parent'=>0))->result();
			$data['widget_page']	= $this->db->get_where('pub_widgets',array('status'=>1))->result();
			$data['banner']			= $this->db->get_where('pub_page_banners',array('data_position'=>1))->row();
			$data['banner_title']	= "Welcome to IndoConnex";
			$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
			$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
			$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();
			$this->display('index', $data);
		}
	}

	/** Contact Us Public -> Contact_proses */
	public function contact_us()
	{
		$data = [];
		if(!empty($this->session->userdata('is_login'))){
	
			if ($this->input->post()) {
				$this->contact_process();
			} else {
	
				$id = $this->session->userdata('user_id');
				$data         = array(
					'apps_title_module' => $this->apps_title_module,
					'meta_position' => 1,
					'meta_type' => 'home'
				);
				$data['CSRF'] = [
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash(),
				];
				$data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
			}
		}else{
			if ($this->input->post()) {
				$this->contact_process();
			} else {
	
				$data         = array(
					'apps_title_module' => $this->apps_title_module,
					'meta_position'	=> 1,
					'meta_type' => 'home'
				);
				$data['CSRF'] = [
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash(),
				];
			}
		}
		$data['search_place'] = 'Search';
		$data['banner']			= $this->db->get_where('pub_page_banners',array('data_position'=>1))->row();
		$data['banner_title']	= "Website Development";
		$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
		$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
		$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();

		config('title', 'Contact Us');

		$this->display('contact-us', $data);
	}

	private function contact_process()
    {
				$recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
				$recaptchaResponse = trim($this->input->post('g-recaptcha-response'));

				$userIp=$this->input->ip_address();
		
				$secret='6LcDKpIcAAAAACrOqG7PfoGbwu1u7mXw7zPJT9hS';
		
				$credential = array(
					'secret' => $secret,
					'response' => $this->input->post('g-recaptcha-response')
				);
		
				$verify = curl_init();
				curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
				curl_setopt($verify, CURLOPT_POST, true);
				curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
				curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($verify);
				$status= json_decode($response, true);
				if ($status['success']) {
					$email = $this->input->post('contact-email');
					$name = $this->input->post('contact-name');
					$business_name = $this->input->post('contact-business-name');
					$phone = $this->input->post('contact-phone');
					$subject = $this->input->post('contact-subject');
					$message = $this->input->post('contact-message');
					if(!empty($email)){
						//generate simple random code
						$template =  '<!DOCTYPE html>
						<html>
						<head>
							<meta charset="utf-8" />
							<meta http-equiv="x-ua-compatible" content="ie=edge" />
							<title>Password Reset</title>
							<meta name="viewport" content="width=device-width, initial-scale=1" />
							<style type="text/css">
							/**
						 * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
						 */
							@media screen {
								@font-face {
								font-family: "Arial";
								font-style: normal;
								font-weight: 400;
								src: local("Arial Regular"), local("Arial-Regular"),
									url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff)
									format("woff");
								}

								@font-face {
								font-family: "Arial";
								font-style: normal;
								font-weight: 700;
								src: local("Arial Bold"), local("Arial-Bold"),
									url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff)
									format("woff");
								}
							}

							/**
						 * Avoid browser level font resizing.
						 * 1. Windows Mobile
						 * 2. iOS / OSX
						 */
							body,
							table,
							td,
							a {
								-ms-text-size-adjust: 100%; /* 1 */
								-webkit-text-size-adjust: 100%; /* 2 */
							}

							/**
						 * Remove extra space added to tables and cells in Outlook.
						 */
							table,
							td {
								mso-table-rspace: 0pt;
								mso-table-lspace: 0pt;
							}

							/**
						 * Better fluid images in Internet Explorer.
						 */
							img {
								-ms-interpolation-mode: bicubic;
							}

							/**
						 * Remove blue links for iOS devices.
						 */
							a[x-apple-data-detectors] {
								font-family: inherit !important;
								font-size: inherit !important;
								font-weight: inherit !important;
								line-height: inherit !important;
								color: inherit !important;
								text-decoration: none !important;
							}

							/**
						 * Fix centering issues in Android 4.4.
						 */
							div[style*=\'margin: 16px 0;\'] {
								margin: 0 !important;
							}

							body {
								width: 100% !important;
								height: 100% !important;
								padding: 0 !important;
								margin: 0 !important;
							}

							/**
						 * Collapse table borders to avoid space between cells.
						 */
							table {
								border-collapse: collapse !important;
							}

							a {
								color: #1a82e2;
							}

							img {
								height: auto;
								line-height: 100%;
								text-decoration: none;
								border: 0;
								outline: none;
							}
							</style>
						</head>
						<body>

							<!-- start body -->
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<!-- start logo -->
							<tr>
								<td align="left" bgcolor="#e9ecef" colspan="2">
								<b>Name</b>
								</td>
							</tr>
							<tr>
								<td align="left" bgcolor="" colspan="2">
								<b>'.$name.'</b>
								</td>
							</tr>
							<tr>
							<td align="left" bgcolor="#e9ecef" colspan="2">
								<b>Email</b>
							</td>
							</tr>
							<tr>
							<td align="left" bgcolor="" colspan="2">
								<b>'.$email.'</b>
							</td>
							</tr>
							<tr>
							<td align="left" bgcolor="#e9ecef" colspan="2">
								<b>Business Name</b>
							</td>
							</tr>
							<tr>
							<td align="left" bgcolor="" colspan="2">
								<b>'.$business_name.'</b>
							</td>
							</tr>
							<tr>
							<td align="left" bgcolor="#e9ecef" colspan="2">
								<b>Phone Number</b>
							</td>
							</tr>
							<tr>
							<td align="left" bgcolor="" colspan="2">
								<b>'.$phone.'</b>
							</td>
							</tr>
							<tr>
							<td align="left" bgcolor="#e9ecef" colspan="2">
								<b>Subject</b>
							</td>
							</tr>
							<tr>
							<td align="left" bgcolor="" colspan="2">
								<b>'.$subject.'</b>
							</td>
							</tr>
							<tr>
							<td align="left" bgcolor="#e9ecef" colspan="2">
								<b>Message</b>
							</td>
							</tr>
							<tr>
							<td align="left" bgcolor="" colspan="2">
								<b>'.$message.'</b>
							</td>
							</tr>
							<!-- end footer -->
							</table>
							<!-- end body -->
						</body>
						</html>
						';
	;	
						$email_contact =  $this->db->get_where('csg_config',array('data_name'=>'contactus_email'))->row();
						$send_email_to  = array($email_contact->data_value);
						$send_email_cc  = 'webmaster@murni.co.id';
						$send_email_bcc = '';

						$data_email['email_body_message'] = $template;
						$date_request                     = date('d/m/Y H:i:s');
						$message_subject                  = "New submission from contact us";
						$message_body                     = $data_email['email_body_message'];
						// dd($this->swiftmailer->send_email($send_email_to, $message_subject, $message_body, $send_email_cc, $send_email_bcc));
						if (!empty($send_email_to)) {
							$result = $this->swiftmailer->send_email($send_email_to, $message_subject, $message_body, $send_email_cc, $send_email_bcc);
							$this->session->set_flashdata('success', 'Check your email');
							redirect(base_url('email-success'));
						}else{
							$this->apps_output_message = array(
								'status'  => 'error',
								'title'   => lang_text('message_reset_title_error'),
								'message' => lang_text('message_reset_error')
							);
							$parameter_redirect_url =  base_url('contact-us');
						}
					}else{
						$this->apps_output_message = array(
							'status'  => 'error',
							'title'   => lang_text('message_reset_title_error'),
							'message' => lang_text('message_reset_error')
						);
						$parameter_redirect_url =  base_url('contact-us');
					}
				}
		$this->session->set_flashdata('failed', 'Captcha Verification Failed');
        $this->set_output_action($parameter_redirect_url);
    }



	protected function set_output_action($parameter_redirect_url = null)
	{
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

	protected function set_form_validation_contact($ID = FALSE)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br/>');
        /* SET FORM VALIDATION RULES FOR COLUMN */
        $this->form_validation->set_rules("contact-email", "Email {$this->apps_title_module_setting}", 'required');
    }

	public function business_directory()
	{
		$data         = array(
			'apps_title_module' => $this->apps_title_module,
			'meta_position' => 1,
			'meta_type' => 'home'
		);
		$data['CSRF'] = [
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash(),
		];
		if(!empty($this->session->userdata('is_login'))){
			$id = $this->session->userdata('user_id');
			$data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
		}else{
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
		}

		$data['cards'] = [
			[
				'title' => 'Consumer Goods',
				'image' => theme_user_locations() . 'images/pages/business3.png',
				'route' => '#'
			],[
				'title' => 'Automotive',
				'image' => theme_user_locations() . 'images/pages/business4.png',
				'route' => '#'
			],[
				'title' => 'Health & Medical',
				'image' => theme_user_locations() . 'images/pages/business5.png',
				'route' => '#'
			],[
				'title' => 'Construction',
				'image' => theme_user_locations() . 'images/pages/business2.png',
				'route' => '#'
			],[
				'title' => 'Property',
				'image' => theme_user_locations() . 'images/pages/market/2.png',
				'route' => '#'
			],[
				'title' => 'Finance Institution',
				'image' => theme_user_locations() . 'images/pages/finance1.png',
				'route' => '#'
			],[
				'title' => 'Agribusiness',
				'image' => theme_user_locations() . 'images/pages/agri1.png',
				'route' => '#'
			],[
				'title' => 'Consulting',
				'image' => theme_user_locations() . 'images/pages/business9.png',
				'route' => '#'
			],[
				'title' => 'Restaurant',
				'image' => theme_user_locations() . 'images/pages/restaurant.png',
				'route' => '#'
			],[
				'title' => 'Home Services',
				'image' => theme_user_locations() . 'images/pages/home-service.png',
				'route' => '#'
			],[
				'title' => 'Electronics',
				'image' => theme_user_locations() . 'images/pages/electronic.png',
				'route' => '#'
			],[
				'title' => 'Fashion',
				'image' => theme_user_locations() . 'images/pages/fashion.png',
				'route' => '#'
			]
		];
		$data['search_place'] = 'Search';
		$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
		$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
		$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();
		$this->display('business/directory', $data);
	}

	public function trade()
	{
		$data = [];
		$data['search_place'] = 'try find Barbershop';
		if(!empty($this->session->userdata('is_login'))){
			$id = $this->session->userdata('user_id');
			$data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
		}else{
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
		}
		$data['search_place'] = 'Search';
		$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
		$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
		$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();
		$this->display('business/trade', $data);
	}

	public function investment()
	{
		$data = [];
		if(!empty($this->session->userdata('is_login'))){
			$id = $this->session->userdata('user_id');
			$data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
		}else{
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
		}
		$data['search_place'] = 'Search';
		$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
		$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
		$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();
		$this->display('business/investment', $data);
	}

	/** Profile Public */
	public function profile()
	{

		$data = [];
		if(!empty($this->session->userdata('is_login'))){
			$id = $this->session->userdata('user_id');
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
			$data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
		}else{
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
		}
		$data['search_place'] 	= 'Search';
		$data['banner']			= $this->db->get_where('pub_page_banners',array('data_position'=>1))->row();
		$data['banner_title']	= "Website Development";
		$data['about_us']		=  $this->db->get_where('pub_profile',array('data_section'=>'section_about'))->row();
		$data['vision']			=  $this->db->get_where('pub_profile',array('data_section'=>'section_vision'))->row();
		$data['mission']		=  $this->Main_model->mission()->result();
		$data['quote']			=  $this->db->get_where('pub_profile',array('data_section'=>'section_quote'))->row();
		$data['work']			=  $this->db->get_where('pub_works',array('status'=>1))->result();
		$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
		$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
		$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();

		config('title', 'About Us');

		$this->display('company-profile', $data);
	}

	/** Partners Public */
	public function partners()
	{
		$data = [];
		if(!empty($this->session->userdata('is_login'))){
			$id = $this->session->userdata('user_id');
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
			$data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
		}else{
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
		}
		$data['search_place'] = 'Search';
		$data['banner']			= $this->db->get_where('pub_page_banners',array('data_position'=>1))->row();
		$data['banner_title']	= "Website Development";
		$data["partners"] = $this->db->get_where('pub_partners',array('status'=>1))->result();
		$data["supports"] = $this->db->get_where('pub_supports',array('status'=>1))->result();
		$data['about_us']		=  $this->db->get_where('pub_profile',array('data_section'=>'section_about'))->row();
		$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
		$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
		$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();

		config('title', 'Partners');

		$this->display('partners', $data);
	}

	public function terms()
	{
		$data = [];
		if(!empty($this->session->userdata('is_login'))){
			$id = $this->session->userdata('user_id');
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
			$data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
		}else{
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
		}
		$data['search_place'] = 'Search';
		$data['banner']			= $this->db->get_where('pub_page_banners',array('data_position'=>1))->row();
		$data['banner_title']	= "Website Development";
		$data["partners"] = $this->db->get_where('pub_partners',array('status'=>1))->result();
		$data["supports"] = $this->db->get_where('pub_supports',array('status'=>1))->result();
		$data['about_us']		= $this->db->get_where('pub_profile',array('data_section'=>'section_about'))->row();
		$data['terms']			= $this->db->get_where('pub_pages',array('data_position'=>1))->result(); 
		$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
		$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
		$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();

		config('title', 'Terms of Use');

		$this->display('terms', $data);
	}

	public function privacy()
	{
		$data = [];
		if(!empty($this->session->userdata('is_login'))){
			$id = $this->session->userdata('user_id');
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
			$data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
		}else{
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
		}
		$data['search_place'] = 'Search';
		$data['banner']			= $this->db->get_where('pub_page_banners',array('data_position'=>1))->row();
		$data['banner_title']	= "Website Development";
		$data["partners"] = $this->db->get_where('pub_partners',array('status'=>1))->result();
		$data["supports"] = $this->db->get_where('pub_supports',array('status'=>1))->result();
		$data['privacy']		= $this->db->get_where('pub_pages',array('data_position'=>2))->result();
		$data['about_us']		=  $this->db->get_where('pub_profile',array('data_section'=>'section_about'))->row();
		$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
		$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
		$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();

		config('title', 'Privacy & Policy');

		$this->display('privacy', $data);
	}

	public function infocenter()
	{
		$data = [];
		if(!empty($this->session->userdata('is_login'))){
			$id = $this->session->userdata('user_id');
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
			$data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
		}else{
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
		}
		$data['search_place'] = 'Search';
		$data['banner']			= $this->db->get_where('pub_page_banners',array('data_position'=>1))->row();
		$data['banner_title']	= "Website Development";
		$data["partners"] = $this->db->get_where('pub_partners',array('status'=>1))->result();
		$data["supports"] = $this->db->get_where('pub_supports',array('status'=>1))->result();
		$data['info']			= $this->db->get_where('pub_pages',array('data_position'=>3))->result();
		$data['about_us']		=  $this->db->get_where('pub_profile',array('data_section'=>'section_about'))->row();
		$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
		$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
		$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();

		config('title', 'Info Center');

		$this->display('infocenter', $data);
	}

	public function email_success()
	{
		$data = [];
		if(!empty($this->session->userdata('is_login'))){
			$id = $this->session->userdata('user_id');
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
			$data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
		}else{
			$data         = array(
				'apps_title_module' => $this->apps_title_module,
				'meta_position' => 1,
				'meta_type' => 'home'
			);
			$data['CSRF'] = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
		}
		$data['search_place'] = 'Search';
		$data['banner']			= $this->db->get_where('pub_page_banners',array('data_position'=>1))->row();
		$data['banner_title']	= "Website Development";
		$data["partners"] = $this->db->get_where('pub_partners',array('status'=>1))->result();
		$data["supports"] = $this->db->get_where('pub_supports',array('status'=>1))->result();
		$data['info']			= $this->db->get_where('pub_pages',array('data_position'=>3))->result();
		$data['about_us']		=  $this->db->get_where('pub_profile',array('data_section'=>'section_about'))->row();
		$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
		$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
		$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();
		$this->display('email-success', $data);
	}

	public function search()
	{
		$id = $this->session->userdata('user_id');
		if (!empty($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];
		}
		$data = [
			'title_web' => 'Dashboard',
			'users'     => $this->db->get_where('users',array('id'=>$id))->row(),
			'meta_position' => 1,
			'meta_type' => 'home'
		];
		$data['query'] = $search['query']  = $this->input->get('query');
		$data['country'] = $search['country']  = $this->input->get('country');
		$data['state'] = $search['state']  = $this->input->get('state');
		$data['city'] = $search['city']  = $this->input->get('city');

		$business_categories = $this->input->get('categories');
		$data['business'] = $this->Main_model->search_business($search);
		$data['business_categories']  = $this->Main_model->business_category();
		$data['business_types'] = $this->db->get('pbd_business_types')->result();

		$data['connections'] = $this->Main_model->search_connections($search);
		$data['product_categories']  = $this->Main_model->product_category();
		$data['products'] = $this->Main_model->search_products($search);
		$data['jobs'] = $this->Main_model->search_jobs($search);
		$data['jobs_categories']  =$this->db->get_where('pcj_jobs_categories',array('status'=>1))->result();
		$data['jobs_type']  = $this->db->get_where('pcj_jobs_types',array('status'=>1))->result();
		$data['communities']  = $this->Main_model->search_communities($search);
		$data['communities_categories']  = $this->db->get_where('pcs_communities')->result();
		$data['articles']  = $this->Main_model->search_articles($search);
		$data['articles_categories']  = $this->db->get_where('pfe_articles_categories')->result();
		$data['search_place'] = 'Search';
		// dd($data['articles']);
		$data['banner']			= $this->db->get_where('pub_page_banners',array('data_position'=>1))->row();
		$data['banner_title']	= "Website Development";
		$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
		$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
		$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();
		$this->display('search', $data);
	}

	public function country()
	{
		$searchTerm = $this->input->post('searchTerm');
		$data_id = $this->Main_model->getCountry_rows($searchTerm);
		$data['response'] = $this->Main_model->getCountry($searchTerm);
		$data['CSRF'] = [
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash(),
		];
		$data['token'] = $this->security->get_csrf_hash();
		$data['country_id'] = $data_id->id;
		echo json_encode($data);
	}

	public function country_update($id)
	{
		$searchTerm = $this->input->post('searchTerm');
		$data_id = $this->Main_model->getCountry_rows($searchTerm);
		$data['response'] = $this->Main_model->getCountry($searchTerm);
		$data['CSRF'] = [
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash(),
		];
		$data['token'] = $this->security->get_csrf_hash();
		$data['country_id'] = $data_id->id;
		echo json_encode($data);
	}

	public function state($country_id)
	{
		$searchTerm = $this->input->post('searchTerm');
		$data['response'] = $this->Main_model->getState($country_id, $searchTerm);
		$data['CSRF'] = [
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash(),
		];
		$data['token'] = $this->security->get_csrf_hash();
		$data['token2'] = $this->security->get_csrf_hash();
		echo json_encode($data);
	}

	public function city($state_id)
	{
		$searchTerm = $this->input->post('searchTerm');
		$data['response'] = $this->Main_model->getCity($state_id, $searchTerm);
		$data['CSRF'] = [
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash(),
		];
		$data['token'] = $this->security->get_csrf_hash();
		$data['token2'] = $this->security->get_csrf_hash();
		echo json_encode($data);
	}

	public function e404()
	{
		$previous = "javascript:history.go(-1)";
		if(isset($_SERVER['HTTP_REFERER'])) {
			$previous = $_SERVER['HTTP_REFERER'];
		}
		$data = [
			'title_web' => 'Dashboard',
			'users'     => $this->db->get('users')->row(),
			'meta_position' => 1,
			'meta_type' => 'home'
		];
		$data['back']			=  $previous;
		$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
		$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
		$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();
		$this->display('e404',$data);
	}

}
