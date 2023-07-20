<?php 
 
class m_business extends CI_Model{	

	function search_business($name,$number,$offset){		
	  $this->db->select('*');
      $this->db->like('data_name',$name);
      $query = $this->db->get('pbd_business',$number,$offset)->result();
      return $query;
	}
    
    function count_data(){
		return $this->db->get('pbd_business')->num_rows();
	}

    function data($number,$offset){
		return $query = $this->db->get('pbd_business',$number,$offset)->result();		
	}
}