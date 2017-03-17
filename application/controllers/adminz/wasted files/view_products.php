<?php
class view_products extends CI_Controller {
     
    function index(){
         $this->load->helper('url');
         $this->load->library(['form_validation', 'encryption','session']);
        if(!$this->session->userdata('user_id'))
            return redirect(base_url('admin/login'));
          $this->load->model('admin/CRUD_model','products');
            $products =  $this->products->view_products();
   $this->load->view('admin/view_products',['products'=>$products]);
   
}}
    ?>