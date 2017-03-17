<?php
class view_cats extends CI_Controller {
     
    function index(){
       $this->load->library(['form_validation', 'encryption','session']);
        if(!$this->session->userdata('user_id'))
            return redirect(base_url('admin/login'));
         $this->load->model('admin/CRUD_model','cats');
            $cats =  $this->cats->view_cats();
   $this->load->view('admin/view_cats',['cats'=>$cats]);
   
}}
    ?>