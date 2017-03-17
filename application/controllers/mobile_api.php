<?php

class mobile_api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['form', 'url', 'security']);
        $this->load->library(array('form_validation', 'encryption', 'session'));
        $this->load->helper('url');
        $this->load->helper('date');
    }
    
    function all_products(){
        
        $this->load->model('public/main_model', 'products');
        $products = $this->products->show_products();
        if(isset($products) && !empty($products)){
        echo json_encode($products);
        }else{
            echo "There are no products in DB";
        }
    }
    
    function all_categories(){
        
        $this->load->model('public/CRUD_model', 'cats');
        $cats = $this->cats->all_cats();
        if(isset($cats) && !empty($cats)){
        echo json_encode($cats);
        }else{
            echo "There is no Categories in DB";
        }
    }
    
    function all_brands(){
        
        $this->load->model('public/CRUD_model', 'brands');
        $brand = $this->brands->view_brands();
        if(isset($brand) && !empty($brand)){
        echo json_encode($brand);
        }else{
            echo "There is NO data found in DB";
        }
    }
    
    function single_prodcut(){
      $pro_id = $this->input->get('pro_id');
      $this->load->model('public/CRUD_model', 'proDetail');
      $pro_detail = $this->proDetail->single_product($pro_id);
      if(isset($pro_detail) && !empty($pro_detail)){
          
          echo json_encode($pro_detail);
      }else{
          echo "There is some error to find this product";
      }

            
        }
        
          function add_cart() {
        $this->load->model('settings');
        $cart_setting = $this->settings->getCartCettings();
        if($cart_setting == 'cookie')
            {
            $this->load->helper('cookie');
            $this->load->model('public/CRUD_model', 'products');
            $products = $this->products->products_stock($pro_id);
            $price = $products[0]->product_price;
            $total_stock = $products[0]->stock;

            /** get current cart * */
            $current_cart = $this->input->cookie('cart');
            if (!empty($current_cart)) {
                $skip = false;
                // cart is not empty so run update
                $current_cart = json_decode($current_cart, true);

                $total = 0;
                foreach ($current_cart as $items) {
                    $total = $total + (int) $items['product_price'];
                  
                }

                if (is_array($current_cart)) {
                    foreach ($current_cart as $items) {
                        if ($items['product_id'] == $pro_id) {
                            $skip = true;
                        }
                    }
                }
                  if($total_stock != 0)
                if (!$skip) {
                    // add values in cookie.

                    $current_cart[$pro_id] = array(
                        'product_id' => $pro_id,
                        'qty' => 1,
                        'product_price' => $price
                    );


                    $cookie = array(
                        'name' => 'cart',
                        'value' => json_encode($current_cart),
                        'expire' => '86500',
                        'path' => '/'
                            //'secure' => TRUE
                    );

                    $this->input->set_cookie($cookie);
                }
            } else {
                // cart is empty so simply insert.
                $cookie_value = json_encode(array($pro_id=>
                    array(
                        'product_id' => $pro_id,
                        'qty' => 1,
                        'product_price' => $price
                )));


                $cookie = array(
                    'name' => 'cart',
                    'value' => $cookie_value,
                    'expire' => '86500',
                    'path' => '/'
                        //'secure' => TRUE
                );

                $this->input->set_cookie($cookie);
               
            }


            return redirect(base_url());
        }
             
             
         }
        
    }
    
    
    ?>

