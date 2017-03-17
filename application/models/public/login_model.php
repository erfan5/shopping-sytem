<?php
Class login_model extends CI_Model
{
 function login_valid($email, $password)
 {
   $data = array(
            'customer_email' => $email,
            'customer_pass' => $password,
        );
        $result = $this->db->get_where('customers', $data);
        if ($result->num_rows() > 0) {
           $row = $result->result();
           return $row;
 }else{
    // echo "something wrong in query";
 }
      
    }
}
?>

