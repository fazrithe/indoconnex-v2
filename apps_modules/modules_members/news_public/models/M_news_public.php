<?php

class M_news_public extends CI_Model
{
   function count_data_search_filter($name, $category)
   {
      $this->db->where('status', 1);
      $this->db->where("JSON_CONTAINS(data_categories, '[\"$category\"]')");
      $this->db->like('data_name', $name);
      return $this->db->get('pnu_news')->num_rows();
   }

   function count_data_search($name)
   {
      $this->db->where('status', 1);
      $this->db->like('data_name', $name);
      return $this->db->get('pnu_news')->num_rows();
   }

   function count_data_search_category($category)
   {
      $this->db->where('status', 1);
      $this->db->where("JSON_CONTAINS(data_categories, '[\"$category\"]')");
      return $this->db->get('pnu_news')->num_rows();
   }

   function filter($name, $category, $number, $offset)
   {
      $this->db->select('id');
      $this->db->select('file_path');
      $this->db->select('file_name_original');
      $this->db->select('data_name');
      $this->db->select('data_slug');
      $this->db->select('published');
      $this->db->where('status', 1);
      if ($category) {
         $this->db->where("JSON_CONTAINS(data_categories, '[\"$category\"]')");
      }
      if ($name) {
         $this->db->like('data_name', $name);
      }
      $this->db->order_by('created_at', 'desc');

      return $this->db->get('pnu_news', $number, $offset)->result();
   }

   function getCategoryName($id)
   {
      $this->db->select('data_name');
      $this->db->where('id', $id);
      $this->db->where('status', 1);
      $query = $this->db->get('pnu_news_categories');
      return $query->row()->data_name;
   }

   function getCategories()
   {
      $this->db->select('id, data_name');
      $this->db->where('status', 1);
      $this->db->order_by('data_name', 'asc');
      return $this->db->get('pnu_news_categories')->result();
   }

   function count_data()
   {
      return $this->db->get_where('pnu_news', array('status' => 1))->num_rows();
   }

   function data_all($number, $offset)
   {
      $this->db->select('id');
      $this->db->select('file_path');
      $this->db->select('file_name_original');
      $this->db->select('data_name');
      $this->db->select('data_slug');
      $this->db->select('published');
      $this->db->where('status', 1);
      $this->db->order_by('created_at', 'desc');
      return $this->db->get('pnu_news', $number, $offset)->result();
   }
}
