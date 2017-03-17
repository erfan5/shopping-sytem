<?php
$config = array(
        'signup' => array(
                array(
                        'field' => 'c_name',
                        'label' => 'c_name',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'c_email',
                        'label' => 'c_email',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'c_password',
                        'label' => 'c_password',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'c_city',
                        'label' => 'c_city',
                        'rules' => 'required'
                ),
      
                array(
                        'field' => 'c_contact',
                        'label' => 'c_contact',
                        'rules' => 'required|valid_email'
                ),
                array(
                        'field' => 'c_address',
                        'label' => 'c_address',
                        'rules' => 'required|alpha'
                ),
                array(
                        'field' => 'title',
                        'label' => 'Title',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'message',
                        'label' => 'MessageBody',
                        'rules' => 'required'
                ),
        ),
    
    
     'add_cat' => array(
                array(
                        'field' => 'cat_title',
                        'label' => 'cat_title',
                        'rules' => 'required'
                )
          
         ),
     'add_brand' => array(
                array(
                        'field' => 'brand_title',
                        'label' => 'brand_title',
                        'rules' => 'required'
                )
          
         ),
    
);
?>

