<?php
class insert_brand extends CI_Controller {
     
  public function index(){
   $this->load->helper('url');
  $this->load->library(['form_validation','session']);
    if(!$this->session->userdata('user_id'))
            return redirect(base_url('admin/login'));
     if ($this->form_validation->run('add_brand')){
         $post=  $this->input->post();
         unset($post['add_brand']);
         $this->load->model('admin/CRUD_model','addBrand');
        if ($this->addBrand->add_brand($post)){
            $this->session->set_flashdata('feedback',"brand added successfully");
     }else{
         $this->session->set_flashdata('feedback',"brand did not added");
     }
     
  }else{
      $this->load->view('admin/insert_brand');
     
  }
   
}
   
}
    ?>