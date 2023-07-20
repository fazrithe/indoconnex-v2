<?php

use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Offset;

class M_business extends CI_Model{	

	function search_business($name){
	  $this->db->where('status',1);
	  $this->db->where('status_page','place');
      $this->db->like('data_name',$name);
      $query = $this->db->get('pbd_business')->result();
      return $query;
	}

	function search_countdata($name){
		$this->db->where('status',1);
		$this->db->where('status_page','place');
		$this->db->like('data_name',$name);
		$query = $this->db->get('pbd_business')->num_rows();
		return $query;
	  }
    
    function count_data(){
		$this->db->where('status',1);
		$this->db->where('status_page','place');
		$query = $this->db->get('pbd_business')->num_rows();
		return $query;
	}

    function data($number,$offset){
		$this->db->where('status',1);
		$this->db->where('status_page','place');
		$this->db->order_by('id','desc');
		return $query = $this->db->get('pbd_business',$number,$offset)->result();		
	}

	function filter($sub_category,$category, $type, $location, $name, $limit, $offset)
	{
		$this->db->where('status', 1);
		$this->db->where('status_page','place');
		if ($name) $this->db->like('data_name', $name);
		if ($category) $this->db->where("JSON_CONTAINS(data_categories, '[\"$category\"]')");
		if ($sub_category) $this->db->where("JSON_CONTAINS(data_categories, '[\"$sub_category\"]')");
		if ($location) $this->db->where("JSON_CONTAINS(data_locations, '[{\"country_id\":\"$location\"}]')");
		if ($type) $this->db->where("JSON_CONTAINS(data_types, '[\"$type\"]')");
		return $this->db->get('pbd_business', $limit, $offset)->result();
		
	}

	function count_data_filter($sub_category,$category, $type, $location, $name)
	{
		$this->db->where('status', 1);
		$this->db->where('status_page','place');
		if ($name) $this->db->like('data_name', $name);
		if ($category) $this->db->where("JSON_CONTAINS(data_categories, '[\"$category\"]')");
		if ($category) $this->db->where("JSON_CONTAINS(data_categories, '[\"$sub_category\"]')");
		if ($location) $this->db->where("JSON_CONTAINS(data_locations, '[{\"country_id\":\"$location\"}]')");
		if ($type) $this->db->where("JSON_CONTAINS(data_types, '[\"$type\"]')");
		return $this->db->get('pbd_business')->num_rows();
		
	}
	
	function getBusinessTypeName($id)
	{
		$this->db->select('data_name');
      	$this->db->where('id', $id);
     	return $this->db->get('pbd_business_types')->row()->data_name;
	}

	function getBusinessCategoryName($id)
	{
		$this->db->select('data_name');
      	$this->db->where('id', $id);
     	return $this->db->get('pbd_business_categories')->row()->data_name;
	}

	function getBusinessLocationName($id)
	{
		$this->db->select('name');
      	$this->db->where('id', $id);
     	return $this->db->get('loc_countries')->row()->name;
	}

	function get_subcategory($id){
		$this->db->from('pbd_business_categories');
        $this->db->where('id',$id);
		$query = $this->db->get();
        return $query->row();
    }

	function business_claim($id){
		$this->db->select('*');
		$this->db->where('status_page','place');
		$this->db->where('pbd_business_claims.users_id', $id);
		$this->db->where('pbd_business_claims.status', 0);
		$this->db->from('pbd_business');
		$this->db->join('pbd_business_claims','pbd_business_claims.business_id = pbd_business.id');
		$query = $this->db->get();
		return $query;
	}
}
