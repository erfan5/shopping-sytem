<?php
class view_customer extends CI_Controller {
    
    
    function index(){
         $this->load->helper('url');
         $this->load->library(['encryption','session']);
        if(!$this->session->userdata('user_id'))
            return redirect(base_url('admin/login'));
          $this->load->model('admin/CRUD_model','custom');
            $customer =  $this->custom->view_customers();
    $this->load->view('admin/view_customer',['customer'=>$customer]);
   
}}
    ?>