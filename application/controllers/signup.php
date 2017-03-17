<?php

class signup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['form', 'url', 'security']);
        $this->load->library(['form_validation', 'encryption', 'session']);

        if ($this->input->post()) {

            $this->form_validation->set_rules('customer_name', 'customer_name ', 'required');
            $this->form_validation->set_rules('customer_email', 'email', 'required|is_unique[customers.customer_email]');
            $this->form_validation->set_rules('customer_pass', 'customer_pass', 'required');
            $this->form_validation->set_rules('customer_country', 'customer_country', 'required');
//      $this->form_validation->set_rules('customer_image', 'customer_image', 'required');
            $this->form_validation->set_rules('customer_city', 'customer_city', 'required');
            $this->form_validation->set_rules('customer_contact', 'customer_contact', 'required');
            $this->form_validation->set_rules('customer_address', 'customer_address', 'required');

            if ($this->form_validation->run()) {
                $config['upload_path'] = 'customer/customer_images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $imagedata['customer_image'] = str_replace(" ", "_", $_FILES['customer_image']['name']);
                $this->upload->do_upload('customer_image');
                $file = $_FILES['customer_image']['name'];
                $post = $this->input->post();
                $post['customer_image'] = $file;
                unset($post['register']);
                $username = $this->input->post('customer_name');
                $ip = $this->input->ip_address();

                $post['customer_ip'] = $ip;

                //Insert The User Detail in DB
                $this->load->model('public/signup_model', 'register');
                $result = $this->register->register_user($post);
                //Start the Session of USerData
                $this->session->set_userdata('customer_name', $username);
                $this->session->set_userdata('customer_id', $result);
                return redirect(base_url());
            } else {
                echo "<script>alert('Email ID already Exist');</script>";
            }
        }
    }
    //Load Header And Footer On Register Page
    function index() {
        $items = array();
        $ip = $this->input->ip_address();
        
         $this->load->model('settings');
         $cart_setting = $this->settings->getCartCettings();
        if ($cart_setting == 'db') {
        $this->load->model('public/CRUD_model', 'totalitems');
        $items = $this->totalitems->total_items($ip);
        $this->load->model('public/CRUD_model', 'billDetail');
        $total_bill = $this->billDetail->total_bill($ip);
        // $total_bill = false;
        if(isset($total_bill[0]->total))
        {
        $total_bill = $total_bill[0]->total;
        
        }else{
        $this->load->helper('cart_values');
        $details =  cart_values();
        $items   =    count($details);
        $total_bill = total_price();
        }
        
        
         $this->load->model('public/CRUD_model', 'cats');
        $cats = $this->cats->all_cats();
        $this->load->model('public/CRUD_model', 'brands');
        $brand = $this->brands->view_brands();
        $this->load->view('public/header', compact('total_bill', 'items','cats','brand'));
        $this->load->view('public/signup');
        $this->load->view('public/footer');
    }
    }
}
?>
       
