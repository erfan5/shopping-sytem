<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class insert_cat extends CI_Controller {
    
 public function index(){
   $this->load->helper('url');
  $this->load->library(['form_validation','session']);
    if(!$this->session->userdata('user_id'))
            return redirect(base_url('admin/login'));
     if ($this->form_validation->run('add_cat')){
         $post=  $this->input->post();
         unset($post['add_cat']);
         $this->load->model('admin/CRUD_model','addCat');
        if ($this->addCat->add_cat($post)){
            $this->session->set_flashdata('feedback',"category added successfully");
     }else{
         $this->session->set_flashdata('feedback',"category did not added");
     }
     
  }else{
      $this->load->view('admin/insert_cat');
     
  }
   
}



   
}
    ?>
      
        
              
             
        
      

     
   
  
   