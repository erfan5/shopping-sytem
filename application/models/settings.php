<?php
Class Settings extends CI_Model
{
 function getCartCettings ()
 {
	 $value = $this->db->get_where('settings', array('setting_key =' => 'cart'))->row();
	 return $value->setting_value;
 }
  
 }
?>

