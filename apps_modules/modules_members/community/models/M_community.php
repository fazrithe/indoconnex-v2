 <?php
class M_community extends CI_Model{	

	function search_product($name,$type,$label,$number,$offset){		
	  $this->db->select('pbd_items.*');
	  $this->db->select('users.data_locations');
	  $this->db->where('pbd_items.status',1);
      $this->db->like('pbd_items.data_name',$name);
	  $this->db->like('pbd_items.data_type',$type);
	  $this->db->like('pbd_items.data_label',$label);
	  $this->db->from('pbd_items');
	  $this->db->join('users','users.id = pbd_items.users_id');		
	  $query = $this->db->get();
      return $query;
	}
    
    function count_data(){
		$this->db->where('status',1);
		$query = $this->db->get('pcs_communities')->num_rows();
		return $query;
	}

	function count_data_user($id){
		$this->db->where('status',1);
		$this->db->where('users_id',$id);
		$query = $this->db->get('pcs_communities')->num_rows();
		return $query;
	}

	function count_data_filter($id){
		$this->db->where('status',1);
		$this->db->where('pbd_business_id',$id);
		$query = $this->db->get('pbd_items')->num_rows();
		return $query;
	}


    function data($user_id,$number,$offset){
		$this->db->where('users_id',$user_id);
		$this->db->order_by('created_at','desc');
		return $query = $this->db->get('pcs_communities',$number,$offset)->result();		
	}

	function data_filter($id,$number,$offset){
		$this->db->where('pbd_business_id',$id);
		return $query = $this->db->get('pbd_items',$number,$offset)->result();		
	}


	function show_all($number,$offset){
		return $query = $this->db->get('pcs_communities',$number,$offset)->result();		
	}

	function show_search($name,$category,$privacy,$number,$offset){
		$this->db->like('data_name',$name);
		$this->db->like('data_categories',$category);
		$this->db->like('status_privacy',$privacy);
		return $query = $this->db->get('pcs_communities',$number,$offset)->result();		
	}

	function data_community($user_id,$number,$offset){
		$this->db->where('users_id',$user_id);
		return $query = $this->db->get('pcs_communities',$number,$offset)->result();		
	}

	function data_service($user_id,$number,$offset){
		$this->db->where('data_type','service');
		$this->db->where('users_id',$user_id);
		return $query = $this->db->get('pbd_items',$number,$offset)->result();		
	}

	function data_product_filter($id,$number,$offset){
		$this->db->where('data_type','product');
		$this->db->where('pbd_business_id',$id);
		return $query = $this->db->get('pbd_items',$number,$offset)->result();		
	}

	function data_service_filter($id,$number,$offset){
		$this->db->where('data_type','service');
		$this->db->where('pbd_business_id',$id);
		return $query = $this->db->get('pbd_items',$number,$offset)->result();		
	}

	function count_data_user_filter($id){
		$this->db->where('status',1);
		$this->db->where('pbd_business_id',$id);
		$query = $this->db->get('pbd_items')->num_rows();
		return $query;
	}

	function getCategory($str)
  {
      $this->db->select('id, data_name as text');
      $this->db->like('data_name', $str);
      $query = $this->db->get('pcs_communities_categories');
      return $query->result();
  }

  public function count_member($id)
  {
	  $this->db->where('pcs_communities_follows.pcs_communities_id',$id);
	  $this->db->from('pcs_communities_follows');
	  $all_follows = $this->db->get();
	  return $all_follows->num_rows();
  }

  	function getCommunityCategoryName($id)
	{
		$this->db->select('data_name');
      	$this->db->where('id', $id);
     	return $this->db->get('pcs_communities_categories')->row()->data_name;
	}
}