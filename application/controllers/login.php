<?php

class login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['form', 'url', 'security']);
        $this->load->library(['form_validation', 'encryption', 'session']);


        $this->form_validation->set_rules('email', 'email id', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_error_delimiters("<p class='text-danger'>", "</p>");
        if ($this->form_validation->run()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->load->model('public/login_model');
            $result = $this->login_model->login_valid($email, $password);
            if(count($result))
            {
            foreach ($result as $custmoer)
            {
             $customer_id=$custmoer->customer_id;   
             $customer_name=$custmoer->customer_name;  
            }
            
            $this->session->set_userdata('customer_id', $customer_id);
            $this->session->set_userdata('customer_name', $customer_name);
            }
            if ($result) {

                return redirect(base_url());
            } else {
                echo "<script>alert('email id or password is incorrect ');</script>";
            }
        }
    }

    function index() {
        $items = array();
        $ip = $this->input->ip_address();
        
          $this->load->model('settings');
         $cart_setting = $this->settings->getCartCettings();
        if ($cart_setting == 'db') {
        $this->load->model('public/CRUD_model', 'totalitems');
        $items = $this->totalitems->total_items($ip);
        $this->load->model('public/CRUD_model', 'billDetail');
         $this->load->model('public/CRUD_model', 'cats');
        $cats = $this->cats->all_cats();
        $this->load->model('public/CRUD_model', 'brands');
        $brand = $this->brands->view_brands();
        $total_bill = $this->billDetail->total_bill($ip);
        if(isset($total_bill[0]->total))
        {
        $total_bill = $total_bill[0]->total;
        
        }else{
        $this->load->helper('cart_values');
        $details =  cart_values();
        $items   =    count($details);
        $total_bill = total_price();
        }
        $this->load->view('public/header', compact('total_bill', 'items','cats','brand'));
        $this->load->view('public/login');
        $this->load->view('public/footer');
    }}

    public function logout() {
        $this->session->unset_userdata('customer_id');
        $this->session->unset_userdata('customer_name');
        return redirect(base_url());
    }

}
?>
       
