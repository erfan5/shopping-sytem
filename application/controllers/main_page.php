<?php

class main_page extends CI_Controller {

    function index() {

    
        $this->load->helper('url');
        $this->load->helper('cookie');
        //Get cart  setting
        $this->load->model('settings');
        $cart_setting = $this->settings->getCartCettings();
        if ($cart_setting == 'db') {
        $ip = $this->input->ip_address();
        
        $this->load->model('public/CRUD_model', 'totalitems');
        $items = $this->totalitems->total_items($ip);
        $this->load->model('public/CRUD_model', 'billDetail');
        $total_bill = $this->billDetail->total_bill($ip);
      //  $total_bill = false;
        if (isset($total_bill[0]->total)) {
            $total_bill = $total_bill[0]->total;
            
         }
        else{
        $this->load->helper('cart_values');
        $details =  cart_values();
        $items   =    count($details);
        $total_bill = total_price();

        }
        $this->load->model('public/CRUD_model', 'cats');
        $cats = $this->cats->all_cats();
        $this->load->model('public/CRUD_model', 'brands');
        $brand = $this->brands->view_brands();
       $this->load->view('public/header', compact('total_bill', 'items', 'cats', 'brand'));

        //Load SLIDER AND CONTENT (PRODUCTS) ANF Footer
         $this->load->model('public/main_model', 'products');
        $products = $this->products->show_products();
         $slider =array();
         $this->load->model('customer/CRUD_model', 'slider');
            $slider = $this->slider->view_slider();
            
        $this->load->view('public/slider',compact('slider'));
        $this->load->view('public/content', ['products' => $products]);
        $this->load->view('public/footer');
    }}
    //Disply the result of Searched Query
    function search_result(){
          $this->load->helper(['form', 'url', 'security']);
          $this->load->library(array('form_validation', 'encryption', 'session'));
          $search_query = $this->input->get('user_query');
          
           $ip = $this->input->ip_address();
            $this->load->model('settings');
         $cart_setting = $this->settings->getCartCettings();
        if ($cart_setting == 'db') {
        $this->load->model('public/CRUD_model', 'totalitems');
        $items = $this->totalitems->total_items($ip);
        $this->load->model('public/CRUD_model', 'billDetail');
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
        $this->load->model('public/CRUD_model', 'cats');
        $cats = $this->cats->all_cats();
        $this->load->model('public/CRUD_model', 'brands');
        $brand = $this->brands->view_brands();
    
        
        
        $this->load->view('public/header', compact('total_bill', 'items', 'cats','brand'));
          
          
          
         $this->load->model('public/CRUD_model', 'result');
         $result = $this->result->view_result($search_query);
           
         $this->load->view('public/result',  compact('result'));
         $this->load->view('public/footer');
           
    }}

}
?>