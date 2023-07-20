<?php
class M_sitemap extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get()
    {
        $this->db->select('slug_url, last_update');
        return $this->db->get('sitemaps')->result();
    }

    public function getBusinessUsername()
    {
        $this->db->select('data_username');
        return $this->db->get('pbd_business')->result();
    }

	public function getUsername()
    {
        $this->db->select('username');
        return $this->db->get('users')->result();
    }

	public function getNews()
    {
        $this->db->select('data_slug');
        return $this->db->get('pnu_news')->result();
    }
}
?>
