<?php
class view_brands extends CI_Controller {
     
    function index(){
        $this->load->helper('url');
         $this->load->library(['encryption','session']);
        if(!$this->session->userdata('user_id'))
            return redirect(base_url('admin/login'));
          $this->load->model('admin/CRUD_model','brands');
            $brands =  $this->brands->view_brands();
        $this->load->view('admin/view_brands',['brands'=>$brands]);
   
}}
    ?>