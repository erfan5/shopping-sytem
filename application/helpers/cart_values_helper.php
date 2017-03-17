<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('cart_values'))
{
    function cart_values()
    {
         $ci =& get_instance();
         
         $ci->load->helper('cookie');
         $current_cart = $ci->input->cookie('cart');
        
         $current_cart = json_decode($current_cart , true);
        
                 return $current_cart;
    }   
    
      function total_price()
    {
         $ci =& get_instance();
         
         $ci->load->helper('cookie');
         $current_cart = $ci->input->cookie('cart');
        
         $current_cart = json_decode($current_cart , true);
         $total = 0;
         if(isset($current_cart)){
          foreach ($current_cart as $items)
                 {
                     $total = $total + (int)$items['product_price'];
              
         }}
                 return $total;
    }   
    
}
