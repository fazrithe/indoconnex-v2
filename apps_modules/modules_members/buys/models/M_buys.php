<?php

use phpDocumentor\Reflection\Type;

class M_buys extends CI_Model{	

	function search_product($name,$type,$category,$status){		
	  $this->db->select('pbd_items.*');
	  $this->db->where('pbd_items.status',1);
	  $this->db->where('pbd_items.status_buy_sells',1);  	
	  if ($name) $this->db->like('pbd_items.data_name', $name);
	  if ($type) $this->db->like('pbd_items_sells.data_type_sub', $type);
	  if ($status) $this->db->like('pbd_items_sells.data_status', $status);
	  if ($category) $this->db->where("JSON_CONTAINS(data_categories, '[\"$category\"]')");
	  $this->db->from('pbd_items');
	  $this->db->join('pbd_items_sells','pbd_items.id = pbd_items_sells.pbd_items_id');
	  $query = $this->db->get();
      return $query;
	}

	function search_category_type($name){
		$this->db->like('data_name', $name);
		$this->db->from('pbd_items_categories_buys');
		$query = $this->db->get();
		return $query;
	}
    
    function count_data(){
		$this->db->where('status',1);
		$this->db->where('status_buy_sells',1);
		$query = $this->db->get('pbd_items')->num_rows();
		return $query;
	}

	function count_data_user($id){
		$this->db->where('status',1);
		$this->db->where('status_buy_sells',1);
		$this->db->where('users_id',$id);
		$query = $this->db->get('pbd_items')->num_rows();
		return $query;
	}

	function count_data_filter($id){
		$this->db->where('status',1);
		$this->db->where('pbd_business_id',$id);
		$this->db->where('status_buy_sells',1);
		$query = $this->db->get('pbd_items')->num_rows();
		return $query;
	}


    function data($user_id,$number,$offset){
		$this->db->where('users_id',$user_id);
		$this->db->where('status_buy_sells',1);
		return $query = $this->db->get('pbd_items',$number,$offset)->result();		
	}

	function data_filter($id,$number,$offset){
		$this->db->where('pbd_business_id',$id);
		$this->db->where('status_buy_sells',1);
		return $query = $this->db->get('pbd_items',$number,$offset)->result();		
	}


	function show_all($number,$offset){
		$this->db->where('status',1);
		$this->db->where('status_buy_sells',1);
		return $query = $this->db->get('pbd_items',$number,$offset)->result();		
	}

	function data_product($user_id,$number,$offset){
		$this->db->where('users_id',$user_id);
		$this->db->where('status_buy_sells',1);
		return $query = $this->db->get('pbd_items',$number,$offset)->result();		
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
	function data_join($id){
	$this->db->select('*');
	$this->db->from('pbd_items');
	$this->db->where('pbd_items.id',$id);
	$this->db->join('pbd_items_sells','pbd_items.id = pbd_items_sells.pbd_items_id');
	$query = $this->db->get();
	return $query;
	}

	function get_subcategory($name){
		$this->db->from('pbd_items_categories_buys');
        $this->db->like('data_name',$name);
		$query = $this->db->get();
        return $query->row();
    }

	function get_subcategory_child($id){
		$this->db->from('pbd_items_categories_buys');
        $this->db->like('id',$id);
		$query = $this->db->get();
        return $query->row();
    }

}
