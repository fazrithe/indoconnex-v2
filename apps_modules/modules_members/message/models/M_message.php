<?php
class M_message extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function getCompany($str)
    {
        $this->db->select('id, data_name as text');
        $this->db->like('data_name', $str);
        $query = $this->db->get('mst_works_experiences');
        return $query->result();
    }

	function show_followers($id){
        $this->db->select('users.*');
        $this->db->where('users_follows.user_follow_id',$id);
        $this->db->where('users.status_privacy',0);
        $this->db->from('users_follows');
        $this->db->join('users','users.id = users_follows.user_id');
        $query = $this->db->get();
        return $query;
    }

	function show_users($id){
		$this->db->select('users.*');
		$this->db->where('users.id',$id);
		$this->db->where('users.status_privacy',0);
		$this->db->from('chat_request');
		$this->db->join('users','users.id = chat_request.sender_id');
		$query = $this->db->get();
        return $query;
	}
	
	function insert_chat_request($data){
		$this->db->insert('chat_request', $data);
	}

	function update_chat_request($data, $id){
		$this->db->where('receiver_id',$id);
		$this->db->update('chat_request', $data);
	}

	function update_chat_message_status($user_id)
	{
	 $data = array(
	  'chat_messages_status'  => 'yes'
	 );
	 $this->db->where('receiver_id', $user_id);
	 $this->db->where('chat_messages_status', 'no');
	 $this->db->update('chat_messages', $data);
	}
   
	function fetch_chat_data($sender_id, $receiver_id)
	{
	 $this->db->where('(sender_id = "'.$sender_id.'" OR sender_id = "'.$receiver_id.'")');
	 $this->db->where('(receiver_id = "'.$receiver_id.'" OR receiver_id = "'.$sender_id.'")');
	 $this->db->order_by('chat_messages_id', 'ASC');
	 return $this->db->get('chat_messages');
	}
}
?>
