<?php
class M_setting extends CI_Model
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

    function getEducation($str)
    {
        $this->db->select('id, data_name as text');
        $this->db->like('data_name', $str);
        $query = $this->db->get('mst_educations');
        return $query->result();
    }

    function getLicense($str)
    {
        $this->db->select('id, data_name as text');
        $this->db->like('data_name', $str);
        $query = $this->db->get('mst_licenses');
        return $query->result();
    }

    function getCourse($str)
    {
        $this->db->select('id, data_name as text');
        $this->db->like('data_name', $str);
        $query = $this->db->get('mst_courses_privates');
        return $query->result();
    }

    function getSkill($str)
    {
        $user_skill_ids = [];
        foreach (json_decode($this->getUserData()->data_pro_skills, true) as $user_skill) {
            array_push($user_skill_ids, $user_skill['skill_id']);
        }
        $user_skill_ids_str = "'" . implode ( "', '", $user_skill_ids ) . "'";
        // $sql = "SELECT id, data_name as text FROM mst_skills WHERE status = 1 AND data_name LIKE '%$str%' AND id NOT IN ($user_skill_ids_str)";
        // return $this->db->query($sql)->result();
        $this->db->select('id, data_name as text');
        $this->db->from('mst_skills');
        $this->db->like('data_name', $str);
        $where = "id NOT IN ($user_skill_ids_str)";
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function getHobby($str)
    {
        $user_hobby_ids = [];
        foreach (json_decode($this->getUserData()->data_pro_hobby, true) as $user_hobby) {
            array_push($user_hobby_ids, $user_hobby['hobby_id']);
        }
        $user_hobby_ids_str = "'" . implode ( "', '", $user_hobby_ids ) . "'";
        // $sql = "SELECT id, data_name as text FROM mst_hobbies WHERE status = 1 AND data_name LIKE '%$str%' AND id NOT IN ($user_hobby_ids_str)";
        // return $this->db->query($sql)->result();
        $this->db->select('id, data_name as text');
        $this->db->from('mst_hobbies');
        $this->db->like('data_name', $str);
        $where = "id NOT IN ($user_hobby_ids_str)";
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function getUserData()
    {
        return $this->db->get_where('users', array('username' => $_SESSION['username']))->row();
    }
}
?>