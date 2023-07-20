<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';
require_once 'vendor/autoload.php';
include_once APPPATH . "../vendor/autoload.php";

class Users_auth extends Base_users
{
    private   $module_page         = array(
        'index'        => 'index',
        'user_setting' => 'user_setting',
        'index_footer' => 'footer_index',
    );
    protected $module_base                  = 'user/register';
    protected $module_base_reset            = 'user/reset';
    protected $apps_title_module            = 'Register';
    protected $apps_title_module_setting    = 'Setting';
    protected $apps_title_module_login      = 'Login';
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
        $this->load->model('m_login');
        $this->load->library(array('form_validation','session','user_agent','swiftmailer'));

    }

    public function register()
    {
        if(!empty($this->session->userdata('is_login'))){
            redirect(base_url('user/dashboard'));
        }

        if ($this->input->post()) {
            $this->set_form_validation();
            $this->register_process();
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
						$data['meta_position'] = 'login';
        if(!empty($this->session->userdata('is_login') == TRUE)){
            // $data['users']     = $this->db->get_where('users',array('id'=>$user_id))->row();
        }

        config('title', 'Register');

        $this->display('register', $data);
        }
    }

    public function confirm_user()
    {
        $user_id =  $this->uri->segment(3);
        $code    = $this->uri->segment(4);
        if(!empty($this->session->userdata('is_login'))){
            redirect(base_url('user/dashboard'));
        }

        if ($this->input->post()) {
            $this->set_form_validation();
            $this->register_process();
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
            $data['users_id'] = $user_id;
            $data['code']    = $code;
            exit;
        if(!empty($this->session->userdata('is_login') == TRUE)){
            $data['users']     = $this->db->get_where('users',array('id'=>$user_id))->row();
        }

        $this->display('confirm_user', $data);
        }
    }


		/** Register Process */
    private function register_process()
    {

        $parameter_redirect_url = base_url('user/register');
        $this->apps_output_message = array(
            'status'  => 'error',
            'title'   => lang_text('message_register_title_failed'),
            'message' => lang_text('message_register_failed')
        );

        if (valdate_csrf_nonce($this->module_base, $this->input->post()) == FALSE) {
            $this->apps_output_message = array(
                'status'  => 'error',
                'title'   => FORM_VALIDATION_CSRF_TITLE,
                'message' => FORM_VALIDATION_CSRF_MESSAGE
            );
        } else {
            if ($this->form_validation->run() === false) {
                /** Scenario State Error from Form Validation */
                $this->apps_output_message = array(
                    'status'  => 'error',
                    'title'   => lang_text('message_register_title_failed'),
                    'message' => validation_errors()
                );
            }else{

                // $name_full = $this->input->post('name_full');
                $email = $this->input->post('email');
                $country   = $this->input->post('country');
				$result_locations = [];
				if (!empty($country)) {
					$rows = $this->db->get_where('loc_countries', array('id'=>$country))->row();
					$result_locations[] = [
						'country_id' => $country,
						'country_name' => $rows->name,
					];
				}
                $check      =  $this->db->get_where('users',["email" => $email])->row();
                if(empty($check->email)){
                    //generate simple random code
                    $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $code = substr(str_shuffle($set), 0, 12);

                    //insert user to users table and get id
                    $user['id'] = random_string('alnum',20);
                    // $user['name_full'] = $name_full;
                    // $PecahStr = explode(" ", $name_full);
                    // for ( $i = 0; $i < count( $PecahStr ); $i++ ) {

                    // }
                    // $user['name_first']  = $PecahStr[0];
                    // if(!empty($PecahStr[1])){
                    // $user['name_middle'] = $PecahStr[1];
                    // }
                    // if(!empty($PecahStr[2])){
                    // $user['name_last'] = $PecahStr[2];
                    // }
                    $user['email'] = $email;
                    $user['data_locations'] = json_encode($result_locations);
                    $user['code_registration'] = $code;
                    $user['status'] = 0;
                    $user['data_pro_hobby'] = '[]';
                    $user['data_pro_skills'] = '[]';
                    $user['data_social_links'] = '[]';
                    $user['data_community'] = '[]';
                    $user['data_education'] = '[]';
                    $user['data_license'] = '[]';
                    $user['data_crs_private'] = '[]';
                    $user['data_exp_work'] = '[]';
                    $user['data_exp_volunteer'] = '[]';
                    $user['data_contact_info'] = '[]';
                    $user['users_access'] = '[]';
                    $this->db->insert('users', $user);
                    $id = $this->db->insert_id();

                    $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $code = substr(str_shuffle($set), 0, 12);
                    $albums_name = ['Profile Photo','Cover Photo'];
                        foreach($albums_name as $value){
                            $albums['id'] = random_string('alnum',20);
                            $albums['users_id']  = $user['id'];
                            $albums['users_albums_categories_id'] = 1;
                            $albums['data_name'] = $value;
                            $this->db->insert('users_albums', $albums);
                        }
                            $jobs['id'] = random_string('alnum',20);
                            $jobs['users_id']  = $user['id'];
                            $jobs['data_name'] = 'Your Jobs';
                            $this->db->insert('users_jobs', $jobs);

                    $template = '<!DOCTYPE html>
                    <html>
                      <head>
                        <meta charset="utf-8" />
                        <meta http-equiv="x-ua-compatible" content="ie=edge" />
                        <title>IndoConnex Account Activation</title>
                        <meta name="viewport" content="width=device-width, initial-scale=1" />
                        <style type="text/css">
                          /**
                       * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
                       */
                          @media screen {
                            @font-face {
                              font-family: "Source Sans Pro";
                              font-style: normal;
                              font-weight: 400;
                              src: local("Source Sans Pro Regular"), local("SourceSansPro-Regular"),
                                url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff)
                                  format("woff");
                            }

                            @font-face {
                              font-family: "Source Sans Pro";
                              font-style: normal;
                              font-weight: 700;
                              src: local("Source Sans Pro Bold"), local("SourceSansPro-Bold"),
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
                      <body style="background-color: #e9ecef">

                        <!-- start body -->
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <!-- start logo -->
                          <tr>
                            <td align="center" bgcolor="#e9ecef">
                              <!--[if (gte mso 9)|(IE)]>
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                            <tr>
                            <td align="center" valign="top" width="600">
                            <![endif]-->
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                width="100%"
                                style="max-width: 600px"
                              >
                                <tr>
                                  <td align="center" valign="top" style="padding: 36px 24px">
                                    <a
                                      href="'.base_url().'"
                                      target="_blank"
                                      style="display: inline-block"
                                    >
                                      <img
                                        src="https://dev.indoconnex.com/public/themes/user/images/logo/indoconnex-logo.png"
                                        alt="Logo"
                                        border="0"
                                        width="100"
                                        style="
                                          display: block;
                                          width: 100px;
                                          max-width: 100px;
                                          min-width: 100px;
                                        "
                                      />
                                    </a>
                                  </td>
                                </tr>
                              </table>
                              <!--[if (gte mso 9)|(IE)]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                            </td>
                          </tr>
                          <!-- end logo -->

                          <!-- start hero -->
                          <tr>
                            <td align="center" bgcolor="#e9ecef">
                              <!--[if (gte mso 9)|(IE)]>
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                            <tr>
                            <td align="center" valign="top" width="600">
                            <![endif]-->
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                width="100%"
                                style="max-width: 600px"
                              >
                                <tr>
                                  <td
                                    align="left"
                                    bgcolor="#ffffff"
                                    style="
                                      padding: 36px 24px 0;
                                      font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;
                                      border-top: 3px solid #d4dadf;
                                    "
                                  >
                                    <h1
                                      style="
                                        margin: 0;
                                        font-size: 32px;
                                        font-weight: 700;
                                        letter-spacing: -1px;
                                        line-height: 48px;
                                      "
                                    >
                                      Confirm Your Email Address
                                    </h1>
                                  </td>
                                </tr>
                              </table>
                              <!--[if (gte mso 9)|(IE)]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                            </td>
                          </tr>
                          <!-- end hero -->

                          <!-- start copy block -->
                          <tr>
                            <td align="center" bgcolor="#e9ecef">
                              <!--[if (gte mso 9)|(IE)]>
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                            <tr>
                            <td align="center" valign="top" width="600">
                            <![endif]-->
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                width="100%"
                                style="max-width: 600px"
                              >
                                <!-- start copy -->
                                <tr>
                                  <td
                                    align="left"
                                    bgcolor="#ffffff"
                                    style="
                                      padding: 24px;
                                      font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;
                                      font-size: 16px;
                                      line-height: 24px;
                                    "
                                  >
                                    <p style="margin: 0">
                                      Tap the button below to confirm your email address. If you
                                      didn\'t create an account with
                                      <a href="'.base_url().'">IndoConnex</a>, you can
                                      safely delete this email.
                                    </p>
                                  </td>
                                </tr>
                                <!-- end copy -->

                                <!-- start button -->
                                <tr>
                                  <td align="left" bgcolor="#ffffff">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                      <tr>
                                        <td align="center" bgcolor="#ffffff" style="padding: 12px">
                                          <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td
                                                align="center"
                                                bgcolor="#1a82e2"
                                                style="border-radius: 6px"
                                              >
                                                <a
                                                  href="'.base_url()."user/activate/".$user['id']."/".$code.'"
                                                  target="_blank"
                                                  style="
                                                    display: inline-block;
                                                    padding: 16px 36px;
                                                    font-family: \'Source Sans Pro\', Helvetica, Arial,
                                                      sans-serif;
                                                    border: 1px solid #1a82e2;
                                                    font-size: 16px;
                                                    color: #ffffff;
                                                    text-decoration: none;
                                                    border-radius: 6px;
                                                  "
                                                  >Activate My Account</a
                                                >
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                                <!-- end button -->

                                <!-- start copy -->
                                <tr>
                                  <td
                                    align="left"
                                    bgcolor="#ffffff"
                                    style="
                                      padding: 24px;
                                      font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;
                                      font-size: 16px;
                                      line-height: 24px;
                                    "
                                  >
                                    <p style="margin: 0">
                                      If that doesn\'t work, copy and paste the following link in
                                      your browser:
                                    </p>
                                    <p style="margin: 0">
                                      <a href="'.base_url()."user/activate/".$user['id']."/".$code.'" target="_blank"
                                        >'.base_url()."user/activate/".$user['id']."/".$code.'</a
                                      >
                                    </p>
                                  </td>
                                </tr>
                                <!-- end copy -->

                                <!-- start copy -->
                                <tr>
                                  <td
                                    align="left"
                                    bgcolor="#ffffff"
                                    style="
                                      padding: 24px;
                                      font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;
                                      font-size: 16px;
                                      line-height: 24px;
                                      border-bottom: 3px solid #d4dadf;
                                    "
                                  >
                                    <p style="margin: 0">
                                      Cheers,<br />
                                      IndoConnex Team
                                    </p>
                                  </td>
                                </tr>
                                <!-- end copy -->
                              </table>
                              <!--[if (gte mso 9)|(IE)]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                            </td>
                          </tr>
                          <!-- end copy block -->

                          <!-- start footer -->
                          <tr>
                            <td align="center" bgcolor="#e9ecef" style="padding: 24px">
                              <!--[if (gte mso 9)|(IE)]>
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                            <tr>
                            <td align="center" valign="top" width="600">
                            <![endif]-->
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                width="100%"
                                style="max-width: 600px"
                              >
                                <!-- start permission -->
                                <tr>
                                  <td
                                    align="center"
                                    bgcolor="#e9ecef"
                                    style="
                                      padding: 12px 24px;
                                      font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;
                                      font-size: 14px;
                                      line-height: 20px;
                                      color: #666;
                                    "
                                  >
                                    <p style="margin: 0">
                                      You received this email because we received a request for
                                      Account Registration for your account. If you didn\'t request
                                      Account Registration you can safely delete this email.
                                    </p>
                                  </td>
                                </tr>
                                <!-- end permission -->

                                <!-- start unsubscribe -->
                                <tr>
                                  <td
                                    align="center"
                                    bgcolor="#e9ecef"
                                    style="
                                      padding: 12px 24px;
                                      font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;
                                      font-size: 14px;
                                      line-height: 20px;
                                      color: #666;
                                    "
                                  >
                                    <p style="margin: 0">
                                      To stop receiving these emails, you can
                                      <a href="'.base_url().'" target="_blank">unsubscribe</a>
                                      at any time.
                                    </p>
                                    <p style="margin: 0"></p>
                                  </td>
                                </tr>
                                <!-- end unsubscribe -->
                              </table>
                              <!--[if (gte mso 9)|(IE)]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                            </td>
                          </tr>
                          <!-- end footer -->
                        </table>
                        <!-- end body -->
                      </body>
                    </html>
                    ';

                    $send_email_to  = $email;
                    $send_email_cc  = '';
                    $send_email_bcc = '';

                    $data_email['email_body_message'] = $template;
                    $date_request                     = date('d/m/Y H:i:s');
                    $message_subject                  = "Welcome to IndoConnex";
                    $message_body                     = $data_email['email_body_message'];
                    if (!empty($send_email_to)) {
                        $this->swiftmailer->send_email($send_email_to, $message_subject, $message_body, $send_email_cc, $send_email_bcc);
                        $this->apps_output_message = array(
                            'status'  => 'success',
                            'title'   => lang_text('message_register_title_success'),
                            'message' => lang_text('message_register_success')
                        );
                        $parameter_redirect_url =  base_url('user/register');
                    }
                    }else{
                        $this->apps_output_message = array(
                            'status'  => 'success',
                            'title'   => lang_text('message_register_title_error'),
                            'message' => lang_text('message_register_error')
                        );
                        $parameter_redirect_url =  base_url('user/register');
                    }
            }
        }
        $this->set_output_action($parameter_redirect_url);
    }

    public function activate(){

        $id =  $this->uri->segment(3);
        $code = $this->uri->segment(4);

        //fetch user details
        $user = $this->db->get_where('users',array('id'=>$id))->row_array();
        //if code matches
        if($user['code_registration'] == $code){
         //update user active status
         // membuat session
         $this->session->set_userdata('user_id', $id);
         $this->session->set_userdata('is_login', TRUE);
         $data['status'] = 1;
         $data['password'] = '';
         $this->db->where('users.id', $id);
         $query = $this->db->update('users', $data);
         $this->session->set_userdata('user_id',$id);
         if($query){
          $this->session->set_flashdata('message', 'User activated successfully');
         }
         else{
          $this->session->set_flashdata('message', 'Something went wrong in activating account');
         }
        }
        else{
         $this->session->set_flashdata('message', 'Cannot activate account. Code didnt match');
        }

        $id =  $this->uri->segment(3);
        if ($this->input->post()) {
            $this->set_form_validation();
            $this->update_setting_general();
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module_setting
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
            $data["code"]       = $code;
            $data["users"]      = $this->db->get_where('users',["id" => $id])->row();
            $data["user_session"]    = $this->db->get_where('users_devices_sess',["user_id" => $id])->result();
        //    exit;
            $this->display('confirm_user', $data);
        }
       }

       public function update_security()
       {
           $user_id    = $this->input->post('user_id');
           $username    = $this->input->post('username');
           $new_pass       = $this->input->post('new_pass');
           $confirm_pass   = $this->input->post('confirm_pass');
           $this->session->set_userdata('username', $username);
           $check      =  $this->db->get_where('users',["id" => $user_id])->row();
           if(!strcmp($new_pass, $confirm_pass)){
                   $this->session->set_userdata('username', $username);
                   $user['username'] = $username;
                   $user['password'] = password_hash($new_pass,PASSWORD_DEFAULT);
                   $this->db->where('users.id', $user_id);
                   $update = $this->db->update('users', $user);
                   $this->session->set_flashdata('success', 'Password has been Updated');
           }else{
               $update = 'Error';
               $data['error'] =  $check->password ;
           }
           if($update){
               $data         = array(
                   'apps_title_module' => $this->apps_title_module_setting
               );
               $data['CSRF'] = [
                   'name' => $this->security->get_csrf_token_name(),
                   'hash' => $this->security->get_csrf_hash(),
               ];

           $data['token'] = $this->security->get_csrf_hash();
           $data["users"]      = $this->db->get_where('users',["id" => $user_id])->row();
           $data["user_session"]    = $this->db->get_where('users_devices_sess',["user_id" => $user_id])->result();
           $this->display('user_setting_security', $data);
           }

       }

       public function security_confirm()
       {
            $code        = $this->input->post('code');
            $user_id     = $this->input->post('user_id');
            $username    = $this->input->post('username');
            $name_full   = $this->input->post('fullname');
            $new_pass       = $this->input->post('new_pass');
            $confirm_pass = $this->input->post('confirm_pass');
            $old_pass   = $this->input->post('old_pass');
            $check = $this->db->get_where('users',['id' => $user_id])->row();
            if(!strcmp($new_pass, $confirm_pass)){
                    $user['name_full'] = $name_full;
                    $PecahStr = explode(" ", $name_full);
                    for ( $i = 0; $i < count( $PecahStr ); $i++ ) {

                    }
                    $user['name_first']  = $PecahStr[0];
                    if(!empty($PecahStr[1])){
                    $user['name_middle'] = $PecahStr[1];
                    }
                    if(!empty($PecahStr[2])){
                    $user['name_last'] = $PecahStr[2];
                    }
                    $user['username'] = $username;
                    $user['password'] = password_hash($new_pass,PASSWORD_DEFAULT);
                    $this->db->where('users.id', $user_id);
                    $update = $this->db->update('users', $user);

                    $this->session->set_flashdata('success', 'Please your login');
                     // membuat session
                     $this->session->set_userdata('user_id', $user_id);
                     $this->session->set_userdata('username', $username);
                     $this->session->set_userdata('is_login', TRUE);

                     redirect(base_url('user/login'));
            }else{
                $this->session->set_flashdata('error', 'Passsword not match');
                redirect(base_url('user/activate/'.$user_id.'/'.$code));
            }
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

    protected function set_form_validation($ID = FALSE)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br/>');
        /* SET FORM VALIDATION RULES FOR COLUMN */
        // $this->form_validation->set_rules("name_full", "Full Name {$this->apps_title_module_setting}", 'required');
        $this->form_validation->set_rules("email", "Email {$this->apps_title_module_setting}", 'required');
    }


    private function update_setting_general()
    {
        if ($this->input->post('phone') == false){
            $id =  $this->uri->segment(3);
            if ($this->form_validation->run() === false) {
                    /** Scenario State Error from Form Validation */
                    $this->session->set_flashdata('Error', 'Account not saved');
            }else{
                $ids       = $this->input->post('id');
                $name_full = $this->input->post('name_full');
                $username  = $this->input->post('username');
                $email     = $this->input->post('email');

                $user['name_full'] = $name_full;
                $user['username'] = $username;
                $user['email'] = $email;
                $this->db->where('users.id', $ids);
                $update = $this->db->update('users', $user);
                if($update == true){
                $this->session->set_flashdata('success', 'Account has been saved');
                }
            }
        }else{
            $id                = $this->input->post('id');
            $email_contact     = $this->input->post('email');
            $phone_contact     = $this->input->post('phone');

            $result = array();
            foreach($email_contact AS $key => $val){
                 $result[] = array(
                  'email_contact'   => $email_contact[$key],
                  'phone_contact'   => $phone_contact[$key]
                 );
            }
            $this->db->where('users.id', $id);
            $contact['data_contact_info'] = json_encode($result);
            $update = $this->db->update('users', $contact);
            if($update == true){
                $this->session->set_flashdata('success', 'Account has been saved');
            }
        }
        $data['CSRF'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];

        $data["users"] = $this->db->get_where('users',["id" => $id])->row();
        $this->display('user_setting', $data);

    }


		/** Login Process */
    public function login()
    {
        $check_loggedin = $this->session->userdata(SESSION_LOGAPPS);
        if (!empty($check_loggedin['app_user_username'])) {
            redirect('mod_dashboard');
        }

        if(!empty($this->session->userdata('is_login'))){
            redirect(base_url('user/dashboard'));
        }

        if ($this->input->post()) {
            $this->set_form_validation_login();
            $this->login_process();
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module,
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
						$data['meta_position'] = 'login';
            if(!empty($this->session->userdata('is_login') == TRUE)){
                $data['users']     = $this->db->get_where('users',array('id'=>$user_id))->row();
            }

            config('title', 'Login');

						$login_button = '';
						if(!$this->session->userdata('access_token'))
						{
						 $login_button = '<a href="'.site_url('user/google/login').'"><img src="'.base_url('public/themes/user/images/global/button_google.png').'" width="60%" /></a>';
						 $data['login_button'] = $login_button;
						}
						
            $this->display('login', $data);
        }
    }

		public function login_google()
    {
        # cek sudah login belum
        if (!empty($this->session->userdata('login'))) {
            redirect('auth/hai');
        }
  
        # redirect ke auth url google
        $client = $this->get_google_client();
        $auth_url = $client->createAuthUrl();
        redirect($auth_url);
    }

		public function google()
    {
        # kalo sudah login atau tidak ada get code, redirect
        // if (!empty($this->session->userdata('login')) OR empty($_GET['code'])) {
        //     redirect('auth/hai');
        // }
				if(isset($_GET["code"])){
					$client = $this->get_google_client();
					$client->authenticate($_GET['code']);
					$google_service = new Google_Service_Oauth2($client);
					$data = $google_service->userinfo->get();
					$current_datetime = date('Y-m-d H:i:s');
					$user_data = array(
						'first_name' => $data['given_name'],
						'last_name'  => $data['family_name'],
						'email_address' => $data['email'],
						'profile_picture'=> $data['picture'],
						'updated_at' => $current_datetime
					);
					$check  = $this->db->get_where('users',['email' => $data['email']]);
                // cek username
            if($check->num_rows() > 0){
							   // get record
								 $rows = $check->row();
								 $this->session->set_userdata('user_id',$rows->id);
								 $users_device = $this->db->get_where('users_devices_sess',array('user_id'=>$rows->id))->row_array();
								 //if ip matches
								 $this->session->set_userdata('ip_address',$this->input->ip_address());
								 if($users_device['ip_address'] == $this->input->ip_address()){
										 $device['user_id']         = $rows->id;
										 $device['browser_name']    = $this->agent->browser();
										 $device['devices_name']    = $this->agent->platform();
										 $device['ip_address']      = $this->input->ip_address();
										 $device['status']          = 1;
										 $this->db->where('users_devices_sess.user_id', $rows->id);
										 $this->db->update('users_devices_sess', $device);
								 }else{
										 $device['id']              = random_string('alnum',20);
										 $device['user_id']         = $rows->id;
										 $device['browser_name']    = $this->agent->browser();
										 $device['devices_name']    = $this->agent->platform();
										 $device['ip_address']      = $this->input->ip_address();
										 $device['status']          = 1;
										 $this->db->insert('users_devices_sess', $device);
								 }

								 $check_albums  = $this->db->get_where('users_albums',['users_id' => $rows->id]);

								 if(empty($check_albums->num_rows())){
										 $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
										 $code = substr(str_shuffle($set), 0, 12);
										 $albums_name = ['Profile Photo','Cover Photo'];
										 foreach($albums_name as $value){
												 $albums['id'] = random_string('alnum',20);
												 $albums['users_id']  = $rows->id;
												 $albums['users_albums_categories_id'] = 1;
												 $albums['data_name'] = $value;
												 $this->db->insert('users_albums', $albums);
										 }
								 }

								 $check_jobs  = $this->db->get_where('users_jobs',['users_id' => $rows->id]);

								 if(empty($check_jobs->num_rows())){
										 $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
										 $code = substr(str_shuffle($set), 0, 12);
												 $jobs['id'] = random_string('alnum',20);
												 $jobs['users_id']  = $rows->id;
												 $jobs['data_name'] = 'Your Jobs';
												 $this->db->insert('users_jobs', $jobs);

								 }
								  // membuat session
									$this->session->set_userdata('user_id', $rows->id);
									$this->session->set_userdata('username', $rows->username);
									$this->session->set_userdata('is_login', TRUE);
									// redirect ke user dashboard
									redirect(base_url('user/dashboard'));
						}else{
							$result_locations = [];
							$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							$code = substr(str_shuffle($set), 0, 12);
							$user['id'] = random_string('alnum',20);
							$user['email'] = $data['email'];
							$user['data_locations'] = json_encode($result_locations);
							$user['code_registration'] = $code;
							$user['status'] = 0;
							$user['data_pro_hobby'] = '[]';
							$user['data_pro_skills'] = '[]';
							$user['data_social_links'] = '[]';
							$user['data_community'] = '[]';
							$user['data_education'] = '[]';
							$user['data_license'] = '[]';
							$user['data_crs_private'] = '[]';
							$user['data_exp_work'] = '[]';
							$user['data_exp_volunteer'] = '[]';
							$user['data_contact_info'] = '[]';
							$user['users_access'] = '[]';
							$this->db->insert('users', $user);
							$id = $this->db->insert_id();

							$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							$code = substr(str_shuffle($set), 0, 12);
							$albums_name = ['Profile Photo','Cover Photo'];
									foreach($albums_name as $value){
											$albums['id'] = random_string('alnum',20);
											$albums['users_id']  = $user['id'];
											$albums['users_albums_categories_id'] = 1;
											$albums['data_name'] = $value;
											$this->db->insert('users_albums', $albums);
									}
											$jobs['id'] = random_string('alnum',20);
											$jobs['users_id']  = $user['id'];
											$jobs['data_name'] = 'Your Jobs';
											$this->db->insert('users_jobs', $jobs);
											
							$this->session->set_userdata('user_data', $data);
							
							redirect("user/activate/".$user['id']."/".$code);
						}
				}
    }

		private function get_google_client()
    {
        $client = new Google_Client();
        $client->setAuthConfigFile(APPPATH . "../client_secret.json"); //rename file ini supaya lebih aman nanti
        $client->setRedirectUri(site_url("user/google/auth"));
				$client->addScope('email');
				$client->addScope('profile');
  
        return $client;
    }

    protected function set_form_validation_login($ID = FALSE)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br/>');
        /* SET FORM VALIDATION RULES FOR COLUMN */
        $this->form_validation->set_rules("email", "Email {$this->apps_title_module_login}", 'required');
        $this->form_validation->set_rules("password", "Password {$this->apps_title_module_login}", 'required');
    }


    public function login_process()
    {
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
            if ($this->form_validation->run() === false) {
                    /** Scenario State Error from Form Validation */
                    $this->session->set_flashdata('failed','Email or Password Wrong!');
                    redirect(base_url('user/login'));
            }else{
                $email = $this->input->post('email', TRUE);
                $password = $this->input->post('password', TRUE);

                // select * from login where user = ?
                $check  = $this->db->get_where('users',['email' => $email]);
                // cek username
                if($check->num_rows() > 0)
                {
									$penality = $this->session->tempdata('penalty');
									if($penality){

										$this->session->set_flashdata('failed','You have failed to login for 5 attempts, please wait for 1 minute');
										redirect(base_url('user/login'));
									}else{
                    // get record
                    $rows = $check->row();
                    $this->session->set_userdata('user_id',$rows->id);
                    $users_device = $this->db->get_where('users_devices_sess',array('user_id'=>$rows->id))->row_array();
                    //if ip matches
                    $this->session->set_userdata('ip_address',$this->input->ip_address());
                    if($users_device['ip_address'] == $this->input->ip_address()){
                        $device['user_id']         = $rows->id;
                        $device['browser_name']    = $this->agent->browser();
                        $device['devices_name']    = $this->agent->platform();
                        $device['ip_address']      = $this->input->ip_address();
                        $device['status']          = 1;
                        $this->db->where('users_devices_sess.user_id', $rows->id);
                        $this->db->update('users_devices_sess', $device);
                    }else{
                        $device['id']              = random_string('alnum',20);
                        $device['user_id']         = $rows->id;
                        $device['browser_name']    = $this->agent->browser();
                        $device['devices_name']    = $this->agent->platform();
                        $device['ip_address']      = $this->input->ip_address();
                        $device['status']          = 1;
                        $this->db->insert('users_devices_sess', $device);
                    }

                    $check_albums  = $this->db->get_where('users_albums',['users_id' => $rows->id]);

                    if(empty($check_albums->num_rows())){
                        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $code = substr(str_shuffle($set), 0, 12);
                        $albums_name = ['Profile Photo','Cover Photo'];
                        foreach($albums_name as $value){
                            $albums['id'] = random_string('alnum',20);
                            $albums['users_id']  = $rows->id;
                            $albums['users_albums_categories_id'] = 1;
                            $albums['data_name'] = $value;
                            $this->db->insert('users_albums', $albums);
                        }
                    }

                    $check_jobs  = $this->db->get_where('users_jobs',['users_id' => $rows->id]);

                    if(empty($check_jobs->num_rows())){
                        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $code = substr(str_shuffle($set), 0, 12);
                            $jobs['id'] = random_string('alnum',20);
                            $jobs['users_id']  = $rows->id;
                            $jobs['data_name'] = 'Your Jobs';
                            $this->db->insert('users_jobs', $jobs);

                    }

                    if(password_verify($password, $rows->password))
                    {
                        // membuat session
                        $this->session->set_userdata('user_id', $rows->id);
                        $this->session->set_userdata('username', $rows->username);
                        $this->session->set_userdata('is_login', TRUE);

                        // redirect ke user dashboard
                        redirect(base_url('user/dashboard'));
                    }else{

                        // jika password salah
												$attempt = $this->session->userdata('attempt');
												$attempt++;
												$this->session->set_userdata('attempt', $attempt);
												if ($attempt == 5) {
													$this->db->set('attempts', 'attempts+120', FALSE);
													$this->db->where('email', $email);
													$this->db->update('users'); // gives UPDATE mytable SET field = field+1 WHERE id = 2
													$attempt = 0;
	
													//code for setting tempdata when reached maximun tries
													$this->session->set_tempdata('penalty', true, 60); //set the name of the sess var to 'penalty, the value will be true and will expire within 5 minutes (expressed in sec.)
													$this->session->set_flashdata('failed','Your account is locked');
                        	redirect(base_url('user/login'));
												} else {
                        	$this->session->set_flashdata('failed','Incorrect email address and / or password.');
                        	redirect(base_url('user/login'));
												}
                    }
									}

                }else{

                    // jika username salah
                    $this->session->set_flashdata('failed','Incorrect email address and / or password.');
                    redirect(base_url('user/login'));
                }
            }
        }
					$this->session->set_flashdata('failed', 'Captcha Verification Failed');
					redirect(base_url('user/login'));
    }

    public function logout()
    {
				$this->session->unset_userdata('penality');
				$this->session->unset_userdata('attempt');
        $ip_address = $this->session->userdata('ip_address');
        $device['status']  = 0;
        $this->db->where('users_devices_sess.ip_address', $ip_address);
      	$this->db->where('users_devices_sess.user_id', $_SESSION['user_id']);
        $this->db->update('users_devices_sess', $device);
        $this->session->sess_destroy();
        redirect(base_url('/'));
    }

    public function reset()
    {
        if(!empty($this->session->userdata('is_login'))){
            redirect(base_url('user/dashboard'));
        }

        if ($this->input->post()) {
            $this->set_form_validation_reset();
            $this->reset_process();
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
        if(!empty($this->session->userdata('is_login') == TRUE)){
            // $data['users']     = $this->db->get_where('users',array('id'=>$user_id))->row();
        }

        config('title', 'Reset Password');

        $this->display('reset_password', $data);
        }
    }

    protected function set_form_validation_reset($ID = FALSE)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br/>');
        /* SET FORM VALIDATION RULES FOR COLUMN */
        $this->form_validation->set_rules("email", "Email {$this->apps_title_module_setting}", 'required');
    }

		/** Reset process (forgot password) */
    private function reset_process()
    {
        $parameter_redirect_url = base_url('user/reset');
        $this->apps_output_message = array(
            'status'  => 'error',
            'title'   => lang_text('message_register_title_failed'),
            'message' => lang_text('message_register_failed')
        );

        if (valdate_csrf_nonce($this->module_base_reset, $this->input->post()) == FALSE) {
            $this->apps_output_message = array(
                'status'  => 'error',
                'title'   => FORM_VALIDATION_CSRF_TITLE,
                'message' => FORM_VALIDATION_CSRF_MESSAGE
            );
        } else {
            if ($this->form_validation->run() === false) {
                /** Scenario State Error from Form Validation */
                $this->apps_output_message = array(
                    'status'  => 'error',
                    'title'   => lang_text('message_register_title_failed'),
                    'message' => validation_errors()
                );
            }else{
                $email = $this->input->post('email');
                $check      =  $this->db->get_where('users',["email" => $email])->row();
                if(!empty($check->email)){
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
                              font-family: "Source Sans Pro";
                              font-style: normal;
                              font-weight: 400;
                              src: local("Source Sans Pro Regular"), local("SourceSansPro-Regular"),
                                url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff)
                                  format("woff");
                            }

                            @font-face {
                              font-family: "Source Sans Pro";
                              font-style: normal;
                              font-weight: 700;
                              src: local("Source Sans Pro Bold"), local("SourceSansPro-Bold"),
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
                      <body style="background-color: #e9ecef">

                        <!-- start body -->
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <!-- start logo -->
                          <tr>
                            <td align="center" bgcolor="#e9ecef" colspan="2">
                              <!--[if (gte mso 9)|(IE)]>
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                            <tr>
                            <td align="center" valign="top" width="600">
                            <![endif]-->
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                width="100%"
                                style="max-width: 600px"
                              >
                                <tr>
                                  <td align="center" valign="top" style="padding: 36px 24px">
                                    <a
                                      href="'.base_url().'"
                                      target="_blank"
                                      style="display: inline-block"
                                    >
                                      <img
                                        src="https://dev.indoconnex.com/public/themes/user/images/logo/indoconnex-logo.png"
                                        alt="Logo"
                                        border="0"
                                        width="100"
                                        style="
                                          display: block;
                                          width: 100px;
                                          max-width: 100px;
                                          min-width: 100px;
                                        "
                                      />
                                    </a>
                                  </td>
                                </tr>
                              </table>
                              <!--[if (gte mso 9)|(IE)]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                            </td>
                          </tr>
                          <!-- end logo -->

                          <!-- start hero -->
                          <tr>
                            <td align="center" bgcolor="#e9ecef" colspan="2">
                              <!--[if (gte mso 9)|(IE)]>
                              <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                                <tr>
                                  <td align="center" valign="top" width="600">
                                  <![endif]-->
                                    <table
                                      border="0"
                                      cellpadding="0"
                                      cellspacing="0"
                                      width="100%"
                                      style="max-width: 600px"
                                    >
                                      <tr>
                                        <td
                                          align="left"
                                          bgcolor="#ffffff"
                                          style="
                                            padding: 36px 24px 0;
                                            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;
                                            border-top: 3px solid #d4dadf;
                                          "
                                        >
                                          <h1
                                            style="
                                              margin: 0;
                                              font-size: 32px;
                                              font-weight: 700;
                                              letter-spacing: -1px;
                                              line-height: 48px;
                                            "
                                          >
                                            Reset Your IndoConnex Password
                                          </h1>
                                        </td>
                                      </tr>
                                    </table>
                                    <!--[if (gte mso 9)|(IE)]>
                                  </td>
                                </tr>
                              </table>
                              <![endif]-->
                            </td>
                          </tr>
                          <!-- end hero -->

                          <!-- start copy block -->
                          <tr>
                            <td align="center" bgcolor="#e9ecef" colspan="2">
                              <!--[if (gte mso 9)|(IE)]>
                              <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                                <tr>
                                  <td align="center" valign="top" width="600">
                                  <![endif]-->
                                    <table
                                      border="0"
                                      cellpadding="0"
                                      cellspacing="0"
                                      width="100%"
                                      style="max-width: 600px"
                                    >
                                      <!-- start copy -->
                                      <tr>
                                        <td
                                          align="left"
                                          bgcolor="#ffffff"
                                          style="
                                            padding: 24px;
                                            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;
                                            font-size: 16px;
                                            line-height: 24px;
                                          "
                                        >
                                          <p style="margin: 0">
                                            We\'ve received a request to reset your password. Click button
                                            below to reset your password
                                          </p>
                                        </td>
                                      </tr>
                                      <!-- end copy -->

                                      <!-- start button -->
                                      <tr>
                                        <td align="left" bgcolor="#ffffff">
                                          <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                              <td align="center" bgcolor="#ffffff" style="padding: 12px">
                                                <table border="0" cellpadding="0" cellspacing="0">
                                                  <tr>
                                                    <td
                                                      align="center"
                                                      bgcolor="#1a82e2"
                                                      style="border-radius: 6px"
                                                    >
                                                      <a
                                                        href="'.base_url().'user/activate/'.$check->id.'/'.$check->code_registration.'"
                                                        target="_blank"
                                                        style="
                                                          display: inline-block;
                                                          padding: 16px 36px;
                                                          font-family: \'Source Sans Pro\', Helvetica, Arial,
                                                            sans-serif;
                                                          border: 1px solid #1a82e2;
                                                          font-size: 16px;
                                                          color: #ffffff;
                                                          text-decoration: none;
                                                          border-radius: 6px;
                                                        "
                                                        >Reset my Password</a
                                                      >
                                                    </td>
                                                  </tr>
                                                </table>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <!-- end button -->

                                      <!-- start copy -->
                                      <tr>
                                        <td
                                          align="left"
                                          bgcolor="#ffffff"
                                          style="
                                            padding: 24px;
                                            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;
                                            font-size: 16px;
                                            line-height: 24px;
                                          "
                                        >
                                          <p style="margin: 0">
                                            If that doesn\'t work, copy and paste the following link in
                                            your browser:
                                          </p>
                                          <p style="margin: 0;">
                                            <a href="'.base_url().'" target="_blank"
                                              >'.base_url().'user/activate/'.$check->id.'/'.$check->code_registration.'</a
                                            >
                                          </p>
                                        </td>
                                      </tr>
                                      <!-- end copy -->

                                      <!-- start copy -->
                                      <tr>
                                        <td
                                          align="left"
                                          bgcolor="#ffffff"
                                          style="
                                            padding: 24px;
                                            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;
                                            font-size: 16px;
                                            line-height: 24px;
                                            border-bottom: 3px solid #d4dadf;
                                          "
                                        >
                                          <p style="margin: 0">
                                            Cheers,<br />
                                            IndoConnex Team
                                          </p>
                                        </td>
                                      </tr>
                                      <!-- end copy -->
                                    </table>
                                    <!--[if (gte mso 9)|(IE)]>
                                  </td>
                                </tr>
                              </table>
                              <![endif]-->
                            </td>
                          </tr>
                          <!-- end copy block -->

                          <!-- start footer -->
                          <tr>
                            <td align="center" bgcolor="#e9ecef" style="padding: 24px">
                              <!--[if (gte mso 9)|(IE)]>
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                            <tr>
                            <td align="center" valign="top" width="600">
                            <![endif]-->
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                width="100%"
                                style="max-width: 600px"
                              >
                                <!-- start permission -->
                                <tr>
                                  <td
                                    align="center"
                                    bgcolor="#e9ecef"
                                    style="
                                      padding: 12px 24px;
                                      font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;
                                      font-size: 14px;
                                      line-height: 20px;
                                      color: #666;
                                    "
                                  >
                                    <p style="margin: 0">
                                      You received this email because we received a request for
                                      [Password Reset] for your account. If you didn\'t request
                                      [Password Reset] you can safely delete this email.
                                    </p>
                                  </td>
                                </tr>
                                <!-- end permission -->

                                <!-- start unsubscribe -->
                                <tr>
                                  <td
                                    align="center"
                                    bgcolor="#e9ecef"
                                    style="
                                      padding: 12px 24px;
                                      font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;
                                      font-size: 14px;
                                      line-height: 20px;
                                      color: #666;
                                    "
                                  >
                                    <p style="margin: 0">
                                      To stop receiving these emails, you can
                                      <a href="" target="_blank">unsubscribe</a>
                                      at any time.
                                    </p>
                                    <p style="margin: 0">

                                    </p>
                                  </td>
                                </tr>
                                <!-- end unsubscribe -->
                              </table>
                              <!--[if (gte mso 9)|(IE)]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                            </td>
                          </tr>
                          <!-- end footer -->
                        </table>
                        <!-- end body -->
                      </body>
                    </html>
                    ';
;
                    $send_email_to  = $email;
                    $send_email_cc  = '';
                    $send_email_bcc = '';

                    $data_email['email_body_message'] = $template;
                    $date_request                     = date('d/m/Y H:i:s');
                    $message_subject                  = "Reset Password Notification - IndoConnex";
                    $message_body                     = $data_email['email_body_message'];
                    if (!empty($send_email_to)) {
                        $result = $this->swiftmailer->send_email($send_email_to, $message_subject, $message_body, $send_email_cc, $send_email_bcc);
                        $this->session->set_flashdata('success', 'Check your email');
                    }
                        $parameter_redirect_url =  base_url('user/reset');
                    }else{
                        $this->apps_output_message = array(
                            'status'  => 'error',
                            'title'   => lang_text('message_reset_title_error'),
                            'message' => lang_text('message_reset_error')
                        );
                        $parameter_redirect_url =  base_url('user/reset');
                    }
            }
        }
        $this->set_output_action($parameter_redirect_url);
    }

		public function session_online(){
      $device['status'] = 1;
			$this->db->where('users_devices_sess.ip_address', $this->input->ip_address());
      $this->db->where('users_devices_sess.user_id', $_SESSION['user_id']);
      $this->db->update('users_devices_sess', $device);
		}

		public function session_offline(){
      $device['status'] = 0;
			$this->db->where('users_devices_sess.ip_address', $this->input->ip_address());
      $this->db->where('users_devices_sess.user_id', $_SESSION['user_id']);
      $this->db->update('users_devices_sess', $device);
		}
}
