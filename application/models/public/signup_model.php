<?php
Class signup_model extends CI_Model
{
function register_user($data)
 {
 $this->db->insert('customers', $data);
 $insert_id = $this->db->insert_id();

   return  $insert_id;
    }



    }
?>



