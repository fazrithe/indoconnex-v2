<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CronRunner
{
 private $CI;

 public function __construct()
 {
    $this->CI =& get_instance();
 }

 private function calculateNextRun($obj)
 {
    return (time() + $obj->interval_sec);
 }

 public function run()
 {
    $now =  date('Y-m-d H:i:s');
    $array = array('updated_at <' => $now);
    $this->CI->db->where($array);
    $this->CI->db->delete('users_devices_sess');
  }
}