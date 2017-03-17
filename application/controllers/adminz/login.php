<?php
//session_start();
if (!defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['form', 'url', 'security']);
        $this->load->library(['form_validation', 'encryption','session']);

       // Load database
       
        $this->form_validation->set_rules('email', 'email id', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_error_delimiters("<p class='text-danger'>", "</p>");
        if ($this->form_validation->run()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->load->model('admin/login_model');
            $result = $this->login_model->login_valid($email, $password);
            if($result){
            $this->session->set_userdata('user_id', $result);
            return redirect(base_url('admin/index?logged_in=You have successfully Logged in!'));
        
            } else {
                echo "<script>alert('email id or password is incorrect ');</script>";
                
           // $this->load->view('admin/login');
            }
        } else {

            $this->load->view('admin/login');
        }

    }

    function index() {

        $this->load->view('admin/login');
    }
    public function logout(){
        $this->session->unset_userdata('user_id');
        return redirect('admin/login');
        
    }

}
?>

