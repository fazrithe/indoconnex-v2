<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Message extends Base_users
{
	protected $module_base                  = 'message/inbox';
    protected $apps_title_module            = 'profile';

    public function __construct()
    {
		parent::__construct();
        $this->load->database();
        $this->lang->load('output_message');
        $this->load->helper(array('form', 'url','string'));
        $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model('M_message');
        if(!empty($this->session->userdata('is_login') == FALSE)){
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }
    }

    public function message_send()
    {	
		$user_id = $_SESSION['user_id'];
		$post['sender_id']          = $user_id;
		$post['receiver_id']		= $this->input->post('receiver_id');
		$post['chat_messages_text']	= $this->input->post('message');
		$post['chat_messages_status'] = 'yes';
        $post['chat_messages_datetime']     = date('Y-m-d H:i:s');
		$this->db->insert('chat_messages', $post);
		// $data['data'] = $this->db->get_where('chat_messages', array('sender_id'=>$user_id))->result();
		// $chat_data = $this->M_message->fetch_chat_data($post['sender_id'], $post['receiver_id']);
		// if($chat_data->num_rows() > 0)
		// {
		//  foreach($chat_data->result() as $row)
		//  {
		//   $message_direction = '';
		//   if($row->sender_id == $post['sender_id'])
		//   {
		//    $message_direction = 'right';
		//   }
		//   else
		//   {
		//    $message_direction = 'left';
		//   }
		//   $date = date('D M Y H:i', strtotime($row->chat_messages_datetime));
		//   $user_sender = $this->db->get_where('users', array('id'=> $row->sender_id))->row();
		//   $output[] = array(
		// 	'user_photo_profile' => meta_profile_user_image($user_sender->id),
		// 	'user_sender' => $user_sender->username,
		//    'chat_messages_text' => $row->chat_messages_text,
		//    'chat_messages_datetime'=> $date,
		//    'message_direction'  => $message_direction
		//   );
		//  }
		// }
		// $data['user_id'] = $user_id;
		// echo json_encode($output);

		echo json_encode([
			'message' => 'message has been send succeccfully',
		]);

		require_once 'vendor/autoload.php';

		$options = array(
			'cluster' => 'ap1',
			'useTLS' => true
		  );
		  $pusher = new Pusher\Pusher(
			PUSHER_KEY,
			PUSHER_SECRET,
			PUSHER_APP_ID,
			$options
		  );
		
		  $data['message'] = 'success';
		  $pusher->trigger('my-channel', 'my-event', $data);
    }
	
	function request_send(){
	 if($this->input->post('receiver_id'))
	 {
		$check_user = $this->db->get_where('chat_request', array('receiver_id'=>$this->input->post('receiver_id')));
		if($check_user->num_rows() > 0){
			$user_receiver = $this->db->get_where('users', array('id'=> $this->input->post('receiver_id')))->row();
			$data = array(
			'sender_id'  =>  $_SESSION['user_id'],
			'receiver_id' => $this->input->post('receiver_id')
			);
			$this->M_message->update_chat_request($data,$this->input->post('receiver_id'));
		}else{
			$user_receiver = $this->db->get_where('users', array('id'=> $this->input->post('receiver_id')))->row();
			$data = array(
			'sender_id'  =>  $_SESSION['user_id'],
			'receiver_id' => $this->input->post('receiver_id')
			);
			$this->M_message->insert_chat_request($data);
		}
			$output[] = array(
				"user_receiver_photo_profile" => meta_profile_user_image($user_receiver->id),
				"user_receiver_live" => $user_receiver->username,
				"user_receiver_live_id" => $user_receiver->id
			);
			echo json_encode($output);
			}
	}

	function load_chat_data()
	{
	 if($this->input->post('receiver_id'))
	 {
	  $receiver_id = $this->input->post('receiver_id');
	  $sender_id = $_SESSION['user_id'];
	  if($this->input->post('update_data') == 'yes')
	  {
	   $this->M_message->update_chat_message_status($sender_id);
	  }
	  $chat_data = $this->M_message->fetch_chat_data($sender_id, $receiver_id);
	  $html = '';
	  if($chat_data->num_rows() > 0)
	  {
	   foreach($chat_data->result() as $row)
	   {
		$date = date('D M Y H:i', strtotime($row->chat_messages_datetime));
		$user_sender = $this->db->get_where('users', array('id'=> $row->sender_id))->row();
		$user_receiver = $this->db->get_where('users', array('id'=> $row->receiver_id))->row();
		if($row->sender_id == $sender_id)
		{
			$html .= '<div class="row" style="margin-left:0; margin-right:0">';
			$html .= '<div class="p-3">';
			$html .= '<div class="d-flex flex-row justify-content-end">';
			$html .=	'<img src="'. meta_profile_user_image($user_sender->id) .'" class="rounded-circle border feed-user-img mb-1">';
			$html .=	 '<div class="chat-date text-sm ml-2 p-2">'. $user_sender->username .'</div>';
			$html .=	 '<div class="chat-date text-sm ml-2 p-2">'. $date .'</div>';	
			$html .=	'</div>';
			$html .=	'<div class="chat-right ml-2 p-3">'. $row->chat_messages_text .'</div>';
			$html .=	'</div>';
		}
		else
		{
			$html .= '<div class="p-3">';
			$html .= '<div class="d-flex flex-row justify-content-start">';
			$html .= '<img src="'. meta_profile_user_image($user_sender->id) .'" class="rounded-circle border feed-user-img mb-1">';
			$html .= '<div class="chat-date text-sm ml-2 p-2">'. $user_sender->username .'</div>';
			$html .= '<div class="chat-date text-sm ml-2 p-2">'. $date .'</div>';
			$html .= '</div>';
			$html .= '<div class="justify-content-start chat-left ml-2 p-3">'. $row->chat_messages_text .'</div>';
			$html .= '</div>';
		}
		$html .= '</div>';
		echo $html;
		}
		// $date = date('D M Y H:i', strtotime($row->chat_messages_datetime));
		// $user_sender = $this->db->get_where('users', array('id'=> $row->sender_id))->row();
		// $user_receiver = $this->db->get_where('users', array('id'=> $row->receiver_id))->row();
		// $output[] = array(
		//  'user_photo_profile' => meta_profile_user_image($user_sender->id),
		//  'user_sender' => $user_sender->username,
		//  'user_sender' => $user_sender->username,
		//  'chat_messages_text' => $row->chat_messages_text,
		//  'chat_messages_datetime'=> $date,
		//  'message_direction'  => $message_direction
		// );
	}
}
	}

	public function dashboard_chat() {
		
		$user_id = $_SESSION['user_id'];
		$data = [
			'title_web' => 'Dashboard',
			'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			// 'users_message'	=> $this->db->get_where('chat_request', array('sender_id'=>$user_id))->result(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
		];
		// dd($data['users_message']);
		$data['CSRF'] = [
			'id' => $user_id,
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash(),
		];
		$this->display('list',$data);
	}

	public function histories_dashboard_chat()
	{
		$userId = json_encode($this->session->user_id);
		$sql = "SELECT users.id AS user_id, 
					users.username, 
					chat_messages.chat_messages_text, 
					chat_messages.chat_messages_datetime 
				FROM chat_messages 
					INNER JOIN users ON chat_messages.sender_id = users.id and 
					chat_messages.chat_messages_id IN 
					(SELECT max(chat_messages.chat_messages_id) 
							FROM chat_messages
							WHERE chat_messages.sender_id = users.id AND 
									chat_messages.receiver_id = $userId OR 
									chat_messages.sender_id = $userId AND 
									chat_messages.receiver_id = users.id) 

					OR chat_messages.receiver_id = users.id and chat_messages.chat_messages_id IN 
					(SELECT max(chat_messages.chat_messages_id) 
							FROM chat_messages 
							WHERE chat_messages.sender_id = users.id AND 
									chat_messages.receiver_id = $userId OR 
									chat_messages.sender_id = $userId AND 
									chat_messages.receiver_id = users.id)

				WHERE chat_messages.sender_id = users.id AND 
					chat_messages.receiver_id = $userId OR 
					chat_messages.sender_id = $userId AND 
					chat_messages.receiver_id = users.id

				GROUP BY chat_messages.sender_id, chat_messages.receiver_id 
				ORDER BY chat_messages.chat_messages_id DESC
				LIMIT 6;";

		$chats = $this->db->query($sql)->result();
		
		$html = '';

		foreach ($chats as $chat) {
			$textMessage = $chat->chat_messages_text;

			if (strlen($textMessage) <= 25) {
				$textMessage = $chat->chat_messages_text;
			} else {
				$textMessage = substr($chat->chat_messages_text , 0, 25) . '...';
			}

			$html .= '<div class="row mt-4" id="user_child">';
			$html .= '<div class="col" id="user_get">';
			$html .= '<div class="d-flex align-items-center">';
			$html .= '<div class="flex-shrink-0">';
			$html .= '<div class="d-flex justify-content-center h-100">
			<div class="image_outer_container">
				<div class="green_icon" style="'.user_online($chat->user_id).'"></div>
					<div class="image_inner_container">
					<img src="'.meta_profile_user_image($chat->user_id) . '" class="rounded-circle border feed-user-img" alt="photo user">
					</div>
				</div>
			</div>';
			$html .= '</div>';
			$html .= '<div class="flex-grow-1 ms-2 flex-column d-flex">';
			$html .= '<a href="#" class="" onclick="user_chat_db(' . sprintf("'%s'", $chat->user_id) . ')""><span class="text-prussianblue fw-bold">' . $chat->username . '</span> <span class="text-ms" style="padding: 10px;"><small style="font-size: 9px;">' . date('j M', strtotime($chat->chat_messages_datetime)) . '</small></span></a>';
			$html .= '<span class="fs-14 text-black text-truncate">' . $textMessage . '</span>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
		}

		echo $html;
	}

	public function histories()
	{
		$keyword = $this->input->get('search');
		if ($keyword) {
			$search = "INNER JOIN chat_messages c ON users.username LIKE '%$keyword%'";
		} else {
			$search = '';
		}

		$userId = json_encode($this->session->user_id);
		
		$sql = "SELECT users.id AS user_id, 
					users.username, 
					chat_messages.chat_messages_text, 
					chat_messages.chat_messages_datetime 
				FROM users
				$search 
					INNER JOIN chat_messages ON chat_messages.sender_id = users.id and 
					chat_messages.chat_messages_id IN 
					(SELECT max(chat_messages.chat_messages_id) 
							FROM chat_messages
							WHERE chat_messages.sender_id = users.id AND 
									chat_messages.receiver_id = $userId OR 
									chat_messages.sender_id = $userId AND 
									chat_messages.receiver_id = users.id) 

					OR chat_messages.receiver_id = users.id and chat_messages.chat_messages_id IN 
					(SELECT max(chat_messages.chat_messages_id) 
							FROM chat_messages 
							WHERE chat_messages.sender_id = users.id AND 
									chat_messages.receiver_id = $userId OR 
									chat_messages.sender_id = $userId AND 
									chat_messages.receiver_id = users.id)
				WHERE chat_messages.sender_id = users.id AND 
					chat_messages.receiver_id = $userId OR 
					chat_messages.sender_id = $userId AND 
					chat_messages.receiver_id = users.id

				GROUP BY chat_messages.sender_id, chat_messages.receiver_id 
				ORDER BY chat_messages.chat_messages_id DESC
				LIMIT 6;";

		$chats = $this->db->query($sql)->result();
		
		$html = '';

		if (count($chats)) {
			foreach ($chats as $chat) {
				$textMessage = $chat->chat_messages_text;

				if (strlen($textMessage) <= 25) {
					$textMessage = $chat->chat_messages_text;
				} else {
					$textMessage = substr($chat->chat_messages_text , 0, 25) . '...';
				}

				$html .= '<div class="d-flex singleChat" id="singleChat" onclick="user_chat(' . sprintf("'%s'", $chat->user_id) . ')">';
				$html .= '<div class="flex-shrink-0 single-chat-photo">';
				$html .= '<img src=" ' .meta_profile_user_image($chat->user_id) . '" class="rounded-circle border feed-user-img">';
				$html .= '</div>';
				$html .= '<div class="ms-2 flex-shrink-1" id="singleChatDetail">';
				$html .= '<div class="text-md-start fw-bold usernameUser fs-12" id="usernameUser">' . $chat->username . '</div>';
				$html .= '<div class="text-sm-start fs-10">' . $textMessage . '</div>';
				$html .= '</div>';
				$html .= '<div class="ms-auto fs-8">' . date('j M', strtotime($chat->chat_messages_datetime)) . '</div>';
				$html .= '</div>';
			}
		} else {
			$html .= '<p>User not found.</p>';
		}

		echo $html;
	}
}
