<?php
Class login_model extends CI_Model
{
 function login_valid($email, $password)
 {
   $data = array(
            'email_id' => $email,
            'password' => $password,
        );
        $result = $this->db->get_where('admins', $data);
        if ($result->num_rows() > 0) {
            $row = $result->result();
           return $row;
 }else{
    // echo "something wrong in query";
 }
      
    }
}
?>

