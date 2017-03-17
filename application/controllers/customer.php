<?php

class customer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['form', 'url', 'security']);
        $this->load->library(array('form_validation', 'encryption', 'session'));
//        if (!$this->session->userdata('customer_id'))
//            return redirect(base_url('public/login'));
        $this->load->helper('url');
        $this->load->helper('date');
    }

    //ADD To CART
    function add_cart() {
        // get cart settigns
        $this->load->model('settings');
        $cart_setting = $this->settings->getCartCettings();
        $pro_id = $this->input->get('pro_id');
        $ip = $this->input->ip_address();
        if ($cart_setting == 'db') {
         $this->load->model('public/CRUD_model', 'selectcart');
            $cart = $this->selectcart->select_cart($pro_id, $ip);
           
            if ($cart > 0) {
                return redirect(base_url());
            } else {
                $this->load->model('public/CRUD_model', 'products');
                $products = $this->products->products_stock($pro_id);
                $total_stock = $products[0]->stock;
                if ($total_stock > 0) {
                    $this->load->model('public/CRUD_model', 'insertcart');
                    $cart = $this->insertcart->insert_cart($pro_id, $ip);

                    return redirect(base_url());
                } else {
                    echo "<script>alert('Sorry this is out of Stock')</script>";
                    return redirect(base_url());
                }
            }
        }

        // if save cart in cookie
        else {
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

    //  Update Cart AND Detail 
    function Cart() {

        //Check cart Setting
        $this->load->model('settings');
        $cart_setting = $this->settings->getCartCettings();

        $ip = $this->input->ip_address();

        if ($this->input->post()) {
            $remove_item = $this->input->post('remove');
            //load model to get products detail
            $this->load->model('public/CRUD_model', 'products');
            $qty = $this->input->post('qty');

            //Change the Quantity Of Cart Product

            if (is_array($qty)) {
                $outsotck = '';
                if ($cart_setting == 'db') {
                foreach ($qty as $key => $value) {
                    $pro_id = $key;
                    $product_qty = $value;
                    $update_value = array($key => $value);
                    $product_detil = $this->products->products_stock($pro_id);

                    $product_avail_stock = $product_detil[0]->stock;

                    if ($product_qty <= 0 || $product_qty > $product_avail_stock) {

                        $outsotck .= "Quantity For " . $product_detil[0]->product_title . " is out of Stock.<br>";
                        
                    } else {
                        //update Quantity
                            $this->load->model('public/CRUD_model', 'updateCart');
                            $cart = $this->updateCart->update_cart($update_value);
                    }
                     if (!empty($outsotck)) {
                    $this->session->set_flashdata('feedback', $outsotck);
                }
                }
                }
                
                if($cart_setting == 'cookie') {
                            $current_cart = $this->input->cookie('cart');
                            $current_cart = json_decode($current_cart, true);
//                            print_r($current_cart);
//                            exit;
                            $updated_cart = $current_cart;
                            
                            

                            foreach ($current_cart as $index => $values) {
                                $product_id = $values['product_id'];
                                
                                $product_detil = $this->products->products_stock($product_id);
                         
                                if (array_key_exists($product_id, $qty )){
                                   
                                    
                                    if($qty[$product_id] <= 0 || $qty[$product_id] > $product_detil[0]->stock )
                                    {
                                        $outsotck .= "Quantity For " . $product_detil[0]->product_title . " is out of Stock.<br>";
                                    }
                                    else{
                                    $updated_cart[$index]['qty'] = $qty[$product_id];
                                    $updated_cart[$index]['product_price'] = $product_detil[0]->product_price * $qty[$product_id] ;
                                    }
                                    
                                } 
                            }
                            
                            
                            
                           //Remove Selected Product from Cart
                            
                          foreach ($current_cart as $index => $value) {
                        $pro_id = $value['product_id'];
                        if (in_array($pro_id, $remove_item)) {
                            unset($updated_cart[$index]);
                        }
                    }
                            
                            
                           $cookie = array(
                                        'name' => 'cart',
                                        'value' => json_encode($updated_cart),
                                        'expire' => '86500',
                                        'path' => '/'
                                            //'secure' => TRUE
                                    );
                                    
                                    if (!empty($outsotck)) {
                                   $this->session->set_flashdata('feedback', $outsotck);
                                    }
                                    $this->input->set_cookie($cookie);
                                    redirect('customer/cart');

                    }
                
                
               //Remove Selected Cart if Setting id DB
                if ($cart_setting == 'db') {
                    $this->load->model('public/CRUD_model', 'removeCart');
                    $remove = $this->removeCart->remove_cart($remove_item);
                } 

            }
        }




        if ($cart_setting == 'db') {
            $this->load->model('public/CRUD_model', 'totalitems');
            $items = $this->totalitems->total_items($ip);
            $this->load->model('public/CRUD_model', 'getPrice');
          $total_price   = $this->getPrice->total_price($ip);
            
            $this->load->model('public/CRUD_model', 'billDetail');
            $total_bill = $this->billDetail->total_bill($ip);
          //  $total_bill = false;
            if (isset($total_bill[0]->total)) {
            $total_bill = $total_bill[0]->total;
            
         } else {
            $this->load->helper('cart_values');
            $cart_detail = cart_values();
            $items = count($cart_detail);
            $total_bill = total_price();
            if (isset($cart_detail)):
                $pro_id = array_column($cart_detail, 'product_id');
                   

                $this->load->model('public/CRUD_model', 'proDetail');
                $pro_detail = $this->proDetail->selected_products($pro_id);
             
            endif;
        }
        $this->load->model('public/CRUD_model', 'cats');
        $cats = $this->cats->all_cats();
        $this->load->model('public/CRUD_model', 'brands');
        $brand = $this->brands->view_brands();
        $this->load->view('public/header', compact('total_bill', 'items', 'brand', 'cats'));
        $this->load->view('public/cart', compact('total_price', 'pro_detail', 'cart_detail', 'items', 'total_bill', 'cart_setting'));
        $this->load->view('public/footer');
    }}

    //Pass values to Paypal form for chekout
    function checkout() {
        $ip = $this->input->ip_address();
        $this->load->model('settings');
        $cart_setting = $this->settings->getCartCettings();
         if ($cart_setting == 'db') {
        $this->load->model('public/CRUD_model', 'getPrice');
        $total_price = $this->getPrice->total_price($ip);
        $this->load->model('public/CRUD_model', 'totalitems');
        $items = $this->totalitems->total_items($ip);
        $this->load->model('public/CRUD_model', 'billDetail');
        $total_bill = $this->billDetail->total_bill($ip);
       
            if (isset($total_bill[0]->total)) {
            $total_bill = $total_bill[0]->total;
            
         } else {
            $this->load->helper('cart_values');
            $cart_detail = cart_values();
            $items = count($cart_detail);
            $total_bill = total_price();
            if (isset($cart_detail)):
                $pro_id = array_column($cart_detail, 'product_id');
                   

                $this->load->model('public/CRUD_model', 'proDetail');
                $pro_detail = $this->proDetail->selected_products($pro_id);
             
            endif;
        }
             
             
         }
        $this->load->model('public/CRUD_model', 'cats');
        $cats = $this->cats->all_cats();
        $this->load->model('public/CRUD_model', 'brands');
        $brand = $this->brands->view_brands();
        $this->load->view('public/header', compact('total_bill', 'items', 'cats', 'brand'));
        $this->load->view('public/checkout', compact('total_bill', 'items', 'cart_setting'));
        if (!$this->session->has_userdata('customer_id')) {
            $this->load->view('public/login');
        } else {
             $this->load->view('public/paypal_direct_checkout');
            $this->load->view('public/payment', compact('total_price', 'items', 'cart_setting','pro_detail','cart_detail'));
        }
        $this->load->view('public/footer');
    }

    //Return to This page after paypal Success
    function Paypal_success() {
        $this->load->helper('cart_values');
        $customer_id = $this->session->userdata('customer_id');
        $ip = $this->input->ip_address();
        
        $amount = $this->input->get('amt');

        $currency = $this->input->get('cc');

        $trx_id = $this->input->get('tx');

        $invoice = mt_rand();
       

        $date = date('Y-m-d H:i:s');
        
         // $total_bill = total_price();
          
        //Get cart Settings
        $this->load->model('settings');
        $cart_setting = $this->settings->getCartCettings();
         //If Cart setting is cookie
         if ($cart_setting == 'cookie') {
        $current_cart = $this->input->cookie('cart');
        $current_cart = json_decode($current_cart, true);
         foreach ($current_cart as $index => $values) {
             
           $p_id = $values['product_id'];   
           $qty = $values['qty'];  
           $paid_amount =$values['product_price'];
             
         }}
        //Check cart Setting
         if ($cart_setting == 'db') {
        
        
        // Get Final price of Customer Cart
        $this->load->model('public/CRUD_model', 'billDetail');
        $total_bill = $this->billDetail->total_bill($ip);
        $paid_amount =  $total_bill[0]->total;

        
         
         //Get Customer Detail
        $this->load->model('public/CRUD_model', 'customerDetail');
        $c_detail = $this->customerDetail->custom_detail($customer_id);
        $c_name = $c_detail[0]->customer_name;
        $c_email = $c_detail[0]->customer_email;
        
        
        //Load model to insert data into  DB table 
        $this->load->model('public/CRUD_model', 'payment');
        $this->load->model('public/CRUD_model', 'order');
       
        // inserting the order into DB table
        $dataa = ['c_id' => $customer_id,'c_name' => $c_name,'c_email' => $c_email,'invoice_no' => $invoice, 'order_date' => $date, 'status' => 'in Progress'];
        $add_order = $this->order->add_order($dataa);
        
         // add payment 
         $data = ['amount' => $paid_amount, 'customer_id' => $customer_id, 'order_id' => $add_order, 'currency' => $currency, 'trx_id' => $trx_id, 'payment_date' => $date];
         $add_payment = $this->payment->add_payment($data);
      
        //Get All Products store in Cart 
        $this->load->model('public/CRUD_model', 'getPrice');
        $cart_product = $this->getPrice->total_price($ip);
        foreach ($cart_product as $total):
          
            $p_id = $total->p_id;
            $qty = $total->qty;
           $pro_name = $total->product_title;
          $pro_price = $total->product_price;
          $final_price = $pro_price * $qty;
            
       //Insert into ordr items table     
       $dataaa = ['order_id' => $add_order, 'item_id' => $p_id, 'qty' => $qty, 'pro_name' => $pro_name, 'each_price' => $pro_price,'total_price' => $final_price];
             $this->load->model('public/CRUD_model', 'items');  
             $add_payment = $this->items->add_order_items($dataaa);
          
             
             
        $this->load->model('public/CRUD_model', 'products');
        $products = $this->products->products_stock($p_id);
        foreach ($products as $product):

            $stock = $product->stock;

       
        $set_stock = $stock - $qty;


        //Minimize stock IN DB After Checkout (paypal success)

        $this->load->model('public/CRUD_model', 'stock');
        $dell_stock = $this->stock->dell_stock($set_stock, $p_id);
       
         endforeach;
         endforeach;
          }
         
        $this->load->view('public/paypal_success', compact('cart_product', 'total_bill', 'c_detail', 'amount', 'currency', 'trx_id', 'invoice','cart_setting'));
        

        //Unset Cookie after paypal success
        if ($cart_setting == 'cookie') {
      
           delete_cookie('cart');
            
        }else{
        //Delete Cart After Checkout
         
        $this->load->model('public/CRUD_model', 'cart');
        $delete_cart = $this->cart->dell_cart($ip);
}}

    function paypal_cancel() {

        $this->load->view('public/paypal_cancel');
    }

    function total_bill() {
        $ip = $this->input->ip_address();
        $this->load->model('public/CRUD_model', 'billDetail');
        $total_bill = $this->billDetail->total_bill($ip);
    }

    //Get Products from DB According to Selected category
    function cat_pro() {
        $ip = $this->input->ip_address();
        $cat_id = $this->input->get('cat_id');
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
        $this->load->model('public/CRUD_model', 'products');
        $all_pro = $this->products->cat_pro($cat_id);

        $this->load->view('public/header', compact('total_bill', 'items', 'brand', 'cats'));
        $this->load->view('public/cat_pro', compact('all_pro'));
        $this->load->view('public/footer');
    }
    }
    //Get Products from DB According to Selected brand
    function brand_pro() {
        $ip = $this->input->ip_address();
        $brand_id = $this->input->get('brand_id');
        $ip = $this->input->ip_address();
     //   $cat_id = $this->input->get('cat_id');
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
        $this->load->model('public/CRUD_model', 'products');
        $all_pro = $this->products->brand_pro($brand_id);

        $this->load->view('public/header', compact('total_bill', 'items', 'brand', 'cats'));
        $this->load->view('public/brand_pro', compact('all_pro'));
        $this->load->view('public/footer');
    }}

    function Single_product() {
        
        $ip = $this->input->ip_address();
        $pro_id = $this->input->get('pro_id');
        $this->load->model('settings');
        $cart_setting = $this->settings->getCartCettings();
         if ($cart_setting == 'db') {
        $this->load->model('public/CRUD_model', 'totalitems');
        $items = $this->totalitems->total_items($ip);
        $this->load->model('public/CRUD_model', 'billDetail');
        $total_bill = $this->billDetail->total_bill($ip);
         $total_bill=  $total_bill[0]->total;
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
        //load model to get required product detail
        $this->load->model('public/CRUD_model', 'proDetail');
        $pro_detail = $this->proDetail->single_product($pro_id);

        $this->load->view('public/header', compact('total_bill', 'items', 'brand', 'cats'));
        $this->load->view('public/single.php', compact('pro_detail'));
        $this->load->view('public/footer');
    }

}

?>