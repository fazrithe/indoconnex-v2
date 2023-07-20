<?php

class M_tender extends CI_Model{

	function search_tender($name,$type,$category){
	  $this->db->select('pbt_tender.*');
	  $this->db->where('pbt_tender.status',1);
      $this->db->like('pbt_tender.data_name',$name, 'both');
	  $this->db->like('pbt_tender.data_types',$type);
	  $this->db->like('pbt_tender.data_categories',$category);
	  $query = $this->db->get('pbt_tender');
      return $query;
	}

    function count_data(){
		$this->db->where('status',1);
		$query = $this->db->get('pbt_tender')->num_rows();
		return $query;
	}

	function count_data_user($id){
		$this->db->where('status',1);
		$this->db->where('users_id',$id);
		$query = $this->db->get('pbd_items')->num_rows();
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
		return $query = $this->db->get('pbt_tender',$number,$offset)->result();
	}

	function data_filter($id,$number,$offset){
		$this->db->where('pbd_business_id',$id);
		return $query = $this->db->get('pbt_tender',$number,$offset)->result();
	}


	function show_all($number,$offset){
		$this->db->where('status',1);
		return $query = $this->db->get('pbt_tender',$number,$offset)->result();
	}

	function show_filter($name,$number,$offset){
		$this->db->where('data_name',$name);
		return $query = $this->db->get('pbt_tender',$number,$offset)->result();
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

	function getTenderTypeName($id)
	{
		$this->db->select('data_name');
      	$this->db->where('id', $id);
     	return $this->db->get('pbt_tender_types')->row()->data_name;
	}

	function getTenderCategoryName($id)
	{
		$this->db->select('data_name');
      	$this->db->where('id', $id);
     	return $this->db->get('pbt_tender_categories')->row()->data_name;
	}

	function getTenderLocationName($id)
	{
		$this->db->select('name');
      	$this->db->where('id', $id);
     	return $this->db->get('loc_countries')->row()->name;
	}

	function getTenderById($id) {
		$this->db->select('*');
		$this->db->from('pbt_tender');
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}
}
