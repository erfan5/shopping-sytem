<?php

Class CRUD_model extends CI_Model {

    //check the user cart either this already exist
    function select_cart($pro_id, $ip) {
        $data = array(
            'ip_add' => $ip,
            'p_id' => $pro_id,
        );
        $result = $this->db->get_where('cart', $data);
        //   echo   $this->db->last_query();
        if ($result->num_rows() > 0) {
            $row = $result->result();
            return $row;
        }
    }

// if user didn't add this product then insert into cart
    function insert_cart($pro_id, $ip) {

        $data = array(
            'ip_add' => $ip,
            'p_id' => $pro_id,
        );

        return $name = $this->db->insert('cart', $data);
    }

    function total_items($ip) {

        $result = $this->db->get_where('cart', ['ip_add' => $ip,]);
        $row = $result->num_rows();
        return $row;
    }

    function total_price($ip) {
        $this->db->select('c.*, p.*')
                ->from('cart c')
                ->join('products p', 'p.product_id = c.p_id', 'left')
                ->where('c.ip_add = "' . $ip . '"');
        $result = $this->db->get()->result();
        // echo   $this->db->last_query();
        return (isset($result)) ? $result : '';
    }

    function update_cart($qty) {
        if (!empty($qty)) {
            foreach ($qty as $p_id => $values):
                $this->db
                        ->where('p_id', $p_id)
                        ->set('qty', $values)
                        ->update('cart');

            endforeach;
        } return $this->db->affected_rows();
    }

    function remove_cart($remove_item) {
        if (!empty($remove_item)) {
            foreach ($remove_item as $value):
                $this->db->delete('cart', ['p_id' => $value]);

            endforeach;
        } return $this->db->affected_rows();
    }

    function custom_detail($customer_id) {
        $this->db->select('*')
                ->from('customers')
                ->where('customer_id=' . $customer_id);

        $result = $this->db->get()->result();
        return (isset($result)) ? $result : '';
    }

    function total_bill($ip) {
        $this->db->select('SUM(c.qty * p.product_price) as total', false)
                ->from('cart c')
                ->join('products p', 'p.product_id = c.p_id', 'left')
                ->where('c.ip_add = "' . $ip . '"');
        $result = $this->db->get()->result();
        //echo   $this->db->last_query();
        return (isset($result)) ? $result : '';
    }

    //show all categories in  menu
    function all_cats() {
        $this->db->select('*');
        $result = $this->db->get('categories')->result_array();
        return (isset($result)) ? $result : '';
    }

    function view_brands() {
        $this->db->select('*');
        $result = $this->db->get('brands')->result_array();
        return (isset($result)) ? $result : '';
    }

    function cat_pro($cat_id) {
        $this->db->select('*')
                ->from('products')
                ->where('product_cat = "' . $cat_id . '"');
        $result = $this->db->get()->result();
        return (isset($result)) ? $result : '';
    }

    function brand_pro($brand_id) {
        $this->db->select('*')
                ->from('products')
                ->where('product_brand = "' . $brand_id . '"');
        $result = $this->db->get()->result();
        return (isset($result)) ? $result : '';
    }

    function add_payment($data) {
        return $name = $this->db->insert('payments', $data);
       
    }

    function add_order($data) {
        $this->db->insert('orders', $data);
         $insert_id = $this->db->insert_id();
        return  $insert_id;
        //    echo   $this->db->last_query();
    }
    function add_order_items($data) {
        $this->db->insert('order_items', $data);
         $insert_id = $this->db->insert_id();
        return  $insert_id;
        //    echo   $this->db->last_query();
    }
    

    function dell_cart($ip) {
        $this->db->delete('cart', ['ip_add' => $ip]);
        return $this->db->affected_rows();
    }

    //Show Search result
    function view_result($search_query) {
        $this->db->start_cache();
        $this->db->select('*')->from('products')
                ->where("product_title  LIKE '%$search_query%'")->get();
        $result = $this->db->get()->result();
        return (isset($result)) ? $result : '';
    }
     //Select ALL PRODUCTS FOR update stock
    function products_stock($p_id) {
        
        $this->db->select('*')
                ->from('products')
                ->where('product_id', $p_id);
 
        $result = $this->db->get()->result();
        return (isset($result)) ? $result : '';
    }

    //delete  Stock after paypal success
    function dell_stock($set_stock, $p_id) {
        $this->db
                ->where('product_id', $p_id)
                ->set('stock', $set_stock)
                ->update('products');
      //  echo $this->db->last_query();
        return $this->db->affected_rows();
    }
    
    function single_product($pro_id){
           $this->db->select('*')
                ->from('products')
                ->where('product_id=' . $pro_id);

        $result = $this->db->get()->result();
        return (isset($result)) ? $result : '';
    }
    
    
    
    function selected_products($pro_id){
         
          if(!empty($pro_id)){
               $this->db->select('*')
                ->where_in('product_id' , $pro_id)  
                ->from('products');

        $result = $this->db->get()->result();
      // echo $this->db->last_query();

      return (isset($result)) ? $result : '';
        
    }}
    //Fetch Slider Images 
       function view_slider() {
        $this->db->select('*');
        $result = $this->db->get('slider')->result_array();
        return (isset($result)) ? $result : '';
    }

}
?>


