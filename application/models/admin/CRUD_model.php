<?php

Class CRUD_model extends CI_Model {

    function add_pro($data) {
    return $name = $this->db->insert('products', $data);
    }

    function add_cat($cat_title) {

        return $name = $this->db->insert('categories', $cat_title);
    }

    function add_brand($brand_title) {

        return $name = $this->db->insert('brands', $brand_title);
    }

    function view_products() {
        $this->db->select('*');
        $result = $this->db->get('products')->result_array();
        return (isset($result)) ? $result : '';
    }

    function view_cats() {
        $this->db->select('*');
        $result = $this->db->get('categories')->result_array();
        return (isset($result)) ? $result : '';
    }

    function view_brands() {
        $this->db->select('*');
        $result = $this->db->get('brands')->result_array();
        return (isset($result)) ? $result : '';
    }

    function view_customers() {
        $this->db->select('*');
        $result = $this->db->get('customers')->result_array();
        return (isset($result)) ? $result : '';
    }

    function view_orders() {
        $this->db->select('o.*,i.item_id,i.qty, p.product_title, p.product_image')
                ->from('orders o')
                ->join('order_items i', 'i.order_id = o.order_id')
                ->join('products p', 'p.product_id = i.item_id', 'left');
               

        $result = $this->db->get()->result();
        //echo   $this->db->last_query();
        return (isset($result)) ? $result : '';
    }

    function view_payments() {
        $this->db->select('p.*,i.*,o.*, pr.product_title, pr.product_image')
                ->from('payments p')
                 ->join('order_items i', 'i.order_id = p.order_id')
                ->join('orders o', 'i.order_id = o.order_id')
               ->join('products pr', 'pr.product_id = i.item_id', 'left');
                

        $result = $this->db->get()->result();
     //   echo   $this->db->last_query();
        return (isset($result)) ? $result : '';
    }

    //DELETE PRODUCT
    function delete_pro($pro_id) {
        return $this->db->delete('products', ['product_id' => $pro_id]);
    }

    //DELETE Category
    function delete_cat($cate_id) {
        return $this->db->delete('categories', ['cat_id' => $cate_id]);
    }

    //DELETE BRAND
    function delete_brand($brand_id) {
        return $this->db->delete('brands', ['brand_id' => $brand_id]);
    }

    //DELETE CUSTOMER
    function delete_custom($custom_id) {
        return $this->db->delete('customers', ['customer_id' => $custom_id]);
    }

    //SELECT SPECIFiC PRODUCT FOR EDIT
    function edit_pro($pro_id) {

        $this->db->select('p.*, c.*,b.*')
                ->from('products p')
                ->join('categories c', 'c.cat_id = p.product_cat', 'left')
                ->join('brands b', 'b.brand_id = p.product_brand')
                ->where('p.product_id=' . $pro_id);

        $result = $this->db->get()->result();
        return (isset($result)) ? $result : '';
    }

    //UPDATE PRODUCT AFTER EDIT
    function update_pro($pro_id, $post) {
        $this->db->where("product_id", $pro_id);
        $this->db->update("products", $post);
      //  echo $this->db->last_query();
        return $this->db->affected_rows();

    }

    //SELECT SPECIFIC BRAND FOR EDIT
    function edit_brand($brand_id) {
        $result = $this->db->where('brand_id', $brand_id)
                ->get('brands');
        return $result->result();
    }

    function update_brand($brand_id, $post) {
        $this->db->where("brand_id", $brand_id);
        $this->db->update("brands", $post);

        return $this->db->affected_rows();
    }

    //SELECT SPECIFIC BRAND FOR EDIT
    function edit_category($cat_id) {
        $result = $this->db->where('cat_id', $cat_id)
                ->get('categories');
        //echo   $this->db->last_query();
        return $result->result();
    }

    function update_category($cat_id, $post) {
        $this->db->where("cat_id", $cat_id);
        $this->db->update("categories", $post);
        return $this->db->affected_rows();
    }
    //Complete the order by admin
    function update_order($order_id){
        $date = date('Y-m-d H:i:s'); 
        $data =['status'=>'completed','order_date'=>$date];
        $this->db->where("order_id", $order_id);
        $this->db->update("orders",$data);
       // echo   $this->db->last_query();
        return $this->db->affected_rows();
    }
    
     function view_slider() {
        $this->db->select('*');
        $result = $this->db->get('slider')->result_array();
        return (isset($result)) ? $result : '';
    }
    
    
    function add_slider_image($data) {
    return $name = $this->db->insert('slider', $data);
    
    }
    
    function delete_slider_image($image_id){
        return $this->db->delete('slider', ['id' => $image_id]);
        
    }
    
     function view_image($image_id) {
        $result = $this->db->where('id', $image_id)
                ->get('slider');
        return $result->result();
    }
    function update_image($image_id, $post){
          $this->db->where("id", $image_id);
        $this->db->update("slider", $post);
        return $this->db->affected_rows();
        
    }

}

?>
