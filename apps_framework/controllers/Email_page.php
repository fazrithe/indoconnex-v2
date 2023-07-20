<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Email_page extends CI_Controller
{
	protected $base_config = [];

	public function __construct()
	{
		parent::__construct();
		$this->db->query("SET SESSION sql_mode = ''");
	}


	public function index()
	{
		$this->load->library('swiftmailer');
		$send_email_to  = 'sigitprasetyokarismautomo@gmail.com';
		$send_email_cc  = '';
		$send_email_bcc = '';

		$data_email['email_body_message'] = 'Hello everbody';
		$date_request                     = date('d/m/Y H:i:s');
		$message_subject                  = "ACCOUNT REGISTRATION | {$date_request}";
		$message_body                     = $data_email['email_body_message'];
		if (!empty($send_email_to)) {
			$this->swiftmailer->send_email($send_email_to, $message_subject, $message_body, $send_email_cc, $send_email_bcc);
		}
	}


}