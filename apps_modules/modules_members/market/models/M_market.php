<?php

class M_market extends CI_Model{

	function search_product($name,$type,$label){
	  $this->db->select('pbd_items.*');
	  $this->db->where('pbd_items.status',1);
	  $this->db->where('pbd_items.status_buy_sells',0);
      $this->db->like('pbd_items.data_name',$name, 'both');
	  $query = $this->db->get('pbd_items');
      return $query;
	}

    function count_data(){
		$this->db->where('status',1);
		$this->db->where('pbd_items.status_buy_sells',0);
		$query = $this->db->get('pbd_items')->num_rows();
		return $query;
	}

	function count_data_user($id){
		$this->db->where('status',1);
		$this->db->where('pbd_items.status_buy_sells',0);
		$this->db->where('users_id',$id);
		$query = $this->db->get('pbd_items')->num_rows();
		return $query;
	}

    function data($user_id,$number,$offset){
		$this->db->where('users_id',$user_id);
		$this->db->where('pbd_items.status_buy_sells',0);
		return $query = $this->db->get('pbd_items',$number,$offset)->result();
	}

	function data_filter($id,$number,$offset){
		$this->db->where('pbd_business_id',$id);
		$this->db->where('pbd_items.status_buy_sells',0);
		return $query = $this->db->get('pbd_items',$number,$offset)->result();
	}


	function show_all($number,$offset){
		$this->db->where('status',1);
		$this->db->where('pbd_items.status_buy_sells',0);
		return $query = $this->db->get('pbd_items',$number,$offset)->result();
	}

	function data_product($user_id,$number,$offset){
		$this->db->where('data_type','product');
		$this->db->where('users_id',$user_id);
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

	function filter($name,$type,$category,$label,$price,$currency,$location,$limit,$offset)
	{
		$this->db->where('status', 1);
		if ($name) $this->db->like('data_name', $name);
		if ($type) $this->db->where('data_type', $type);
		if ($label) $this->db->where('data_label', $label);
		if ($price) $this->db->where('price_type', $price);
		if ($currency) $this->db->where('price_currency', $currency);
		if ($category) $this->db->where("JSON_CONTAINS(data_categories, '[\"$category\"]')");
		if ($location) $this->db->where("JSON_CONTAINS(data_locations, '[{\"country_id\":\"$location\"}]')");
		return $this->db->get('pbd_items', $limit, $offset)->result();
		
	}

	function count_data_filter($name,$type,$category,$label,$price,$currency,$location)
	{
		$this->db->where('status', 1);
		if ($name) $this->db->like('data_name', $name);
		if ($type) $this->db->where('data_type', $type);
		if ($label) $this->db->where('data_label', $label);
		if ($price) $this->db->where('price_type', $price);
		if ($currency) $this->db->where('price_currency', $currency);
		if ($category) $this->db->where("JSON_CONTAINS(data_categories, '[\"$category\"]')");
		if ($location) $this->db->where("JSON_CONTAINS(data_locations, '[{\"country_id\":\"$location\"}]')");
		return $this->db->get('pbd_items')->num_rows();
		
	}


	function getItemById($id) {
		$this->db->select('*');
		$this->db->from('pbd_items');
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}
}
