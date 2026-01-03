<?php
class Siteconfig extends CI_Model {

 public function __construct()
 {
  parent::__construct();
 }
 public function get_all()
 {
  return $this->db->get('sg_settings');
 }
 public function update_config($data)
 {
  $success = true;
  foreach($data as $key=>$value)
  {
   if(!$this->save($key,$value))
   {
    $success=false;
    break;  
   }
  }
  return $success;
 }
 public function save($key,$value)
 {
  $config_data=array(
    'key'=>$key,
    'value'=>$value
    );
  $this->db->where('key', $key);
  return $this->db->update('sg_settings',$config_data); 
 }
}