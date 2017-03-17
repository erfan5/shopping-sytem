<?php
Class main_model extends CI_Model
{
 function show_products ()
 {
  $this->db->select('*');
      //$result = $this->db->get_where('products', '*');
       $result = $this->db->get('products')->result_array();
        return (isset($result)) ? $result : '';

}}
?>

