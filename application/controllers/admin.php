<?php

class admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['form', 'url', 'security']);
        $this->load->library(['form_validation', 'encryption', 'session']);
        if (!$this->session->userdata('user_id'))
            return redirect(base_url('admin/login'));
        $this->load->helper('url');
        $this->load->helper('date');
    }

    function index($param = 0) {
        $var = array();
        $cat = array();
        $brand = array();
        $pro = array();

        //INSERT NEW PRODUCT

        if ($param == 'insert_product') {
            
            $this->load->model('admin/CRUD_model', 'cats');
            $cat = $this->cats->view_cats();
            $this->load->model('admin/CRUD_model', 'brands');
            $brand = $this->brands->view_brands();
            if ($this->input->post()) {
                $config['upload_path'] = 'admin/product_images/';
                $config['allowed_types'] = 'gif|jpg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $imagedata['product_image'] = str_replace(" ", "_", $_FILES['product_image']['name']);
                if ($this->upload->do_upload('product_image')) {
                    $file = $_FILES['product_image']['name'];
                    $post = $this->input->post();
                    $post['product_image'] = $file;
                    unset($post['insert_post']);
                    $this->load->model('admin/CRUD_model', 'addPro');
                    $pro = $this->addPro->add_pro($post);
                    return redirect(base_url('admin/index/view_products'));
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    echo '<pre>';
                    print_r($error);
                    echo '</pre>';
                }
            }
        }

        //View All products

        if ($param == 'view_products') {
            $this->load->model('admin/CRUD_model', 'products');
            $var = $this->products->view_products();
        }

        //EDIT PRODUCTS (GET CATEEGORY AND BRAND)

        if ($param == 'edit_pro') {
            $pro_id = $this->input->get('pro_id');
            $this->load->model('admin/CRUD_model', 'products');
            $pro = $this->products->edit_pro($pro_id);
            $this->load->model('admin/CRUD_model', 'cats');
            $cat = $this->cats->view_cats();
            $this->load->model('admin/CRUD_model', 'brands');
            $brand = $this->brands->view_brands();
        }

        //Insert New Category

        if ($param == 'insert_cat') {
            if ($this->form_validation->run('add_cat')) {
                $post = $this->input->post();
                unset($post['add_cat']);
                $this->load->model('admin/CRUD_model', 'addCat');
                $var = $this->addCat->add_cat($post);
                if ($var) {
                    $this->session->set_flashdata('feedback', "category added successfully");
                } else {
                    $this->session->set_flashdata('feedback', "category did not added");
                }
            }
        }

        //View All Categories

        if ($param == 'view_cats') {
            $this->load->model('admin/CRUD_model', 'cats');
            $var = $cats = $this->cats->view_cats();
        }

        //Insert New Brand


        if ($param == 'insert_brand') {
            if ($this->form_validation->run('add_brand')) {
                $post = $this->input->post();
                unset($post['add_brand']);
                $this->load->model('admin/CRUD_model', 'addBrand');
                $var = $this->addBrand->add_brand($post);
                if ($var) {
                    $this->session->set_flashdata('feedback', "brand added successfully");
                } else {
                    $this->session->set_flashdata('feedback', "brand did not added");
                }
            }
        }


        //View All Brands

        if ($param == 'view_brands') {
            $this->load->model('admin/CRUD_model', 'brands');
            $var = $this->brands->view_brands();
        }
        //EDIT BRAND
        if ($param == 'edit_brand') {
            $brand_id = $this->input->get('brand_id');
            $this->load->model('admin/CRUD_model', 'editbrands');
            $brand = $this->editbrands->edit_brand($brand_id);
        }
        //EDIT CATEGORY
        if ($param == 'edit_cat') {
            $cat_id = $this->input->get('cat_id');
            $this->load->model('admin/CRUD_model', 'editcat');
            $var = $this->editcat->edit_category($cat_id);
        }


        //View All Customers

        if ($param == 'view_customer') {
            $this->load->model('admin/CRUD_model', 'custom');
            $var = $this->custom->view_customers();
        }

        //View All Orders
        if ($param == 'view_orders') {
            $this->load->model('admin/CRUD_model', 'order');
            $var = $this->order->view_orders();
        }


        //View All Payment
        if ($param == 'view_payments') {
            $this->load->model('admin/CRUD_model', 'payment');
            $var = $this->payment->view_payments();
        }
         //View All Payment
        if ($param == 'view_slider') {
            $this->load->model('admin/CRUD_model', 'slider');
            $var = $this->slider->view_slider();
        }
        
           //Insert Slider Images
    
    

    if ($param == 'insert_slider_image') {
       if ($this->input->post()) {
              
              $config['upload_path'] = 'admin/slider_images/';
                $config['allowed_types'] = 'gif|jpg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $imagedata['image'] = str_replace(" ", "_", $_FILES['image']['name']);
                
                if ($this->upload->do_upload('image')) {
                    $file = $_FILES['image']['name'];
                    $post = $this->input->post();
                    $post['image'] = $file;
                    unset($post['insert_image']);
                    $this->load->model('admin/CRUD_model', 'addimage');
                    $slider = $this->addimage->add_slider_image($post);
                    return redirect(base_url('admin/index/view_slider'));
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    echo '<pre>';
                    print_r($error);
                    echo '</pre>';
                }
            }
        }
        
        //edit Slider image
         if ($param == 'edit_image') {
            $image_id = $this->input->get('image_id');
            $this->load->model('admin/CRUD_model', 'image');
            $var = $this->image->view_image($image_id);
            
            
        }

        $this->load->view('admin/index', compact('var', 'cat', 'brand', 'pro'));
    }

    //DELETE PRODUCTS 
    function delete_pro() {
        $pro_id = $this->input->get('pro_id');
        $this->load->model('admin/CRUD_model', 'delete');
        $del = $this->delete->delete_pro($pro_id);
        if ($del) {
            $this->session->set_flashdata('feedback', "product Delete successfully");
            redirect(base_url('admin/index/view_products'));
        } else {
            $this->session->set_flashdata('feedback', "Error in Your SCript");
        }
    }

    //DELETE CATEGORIES

    function delete_cat() {
        $cate_id = $this->input->get('cate_id');
        $this->load->model('admin/CRUD_model', 'delete');
        $del = $this->delete->delete_cat($cate_id);
        if ($del) {
            $this->session->set_flashdata('feedback', "category Delete successfully");
            redirect(base_url('admin/index/view_cats'));
        } else {
            $this->session->set_flashdata('feedback', "Error in Your SCript");
        }
    }

    //DELETE Brands
    function delete_brand() {
        $brand_id = $this->input->get('brand_id');
        $this->load->model('admin/CRUD_model', 'delete');
        $del = $this->delete->delete_brand($brand_id);
        if ($del) {
            $this->session->set_flashdata('feedback', "Brand Delete successfully");
            redirect(base_url('admin/index/view_brands'));
        } else {
            $this->session->set_flashdata('feedback', "Error in Your SCript");
        }
    }

    //DELETE CUSTOMERS
    function delete_Customer() {
        $custom_id = $this->input->get('custom_id');
        $this->load->model('admin/CRUD_model', 'delete');
        $del = $this->delete->delete_custom($custom_id);
        if ($del) {
            $this->session->set_flashdata('feedback', "Customer Delete successfully");
            redirect(base_url('admin/index/view_customer'));
        } else {
            $this->session->set_flashdata('feedback', "Error in Your SCript");
        }
    }

    // UPDATE PRODUCT AFTER EDIT
    function update_product() {
        if ($this->input->post()) {
            $pro_id = $this->input->get('pro_id');
            $config['upload_path'] = 'admin/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $imagedata['product_image'] = str_replace(" ", "_", $_FILES['product_image']['name']);
            $imagedata['product_image'] = date('Y-m-d H:i:s');
            if ($this->upload->do_upload('product_image')) {
                $file = $_FILES['product_image']['name'];
                $post = $this->input->post();
                $post['product_image'] = $file;
                unset($post['update_product']);
                $this->load->model('admin/CRUD_model', 'updatePro');
                $pro = $this->updatePro->update_pro($pro_id, $post);
                return redirect(base_url('admin/index/view_products'));
            } else {
                $error = array('error' => $this->upload->display_errors());
                echo '<pre>';
                print_r($error);
                echo '</pre>';
            }
        }
    }
    //Update brand After Edit
    function update_brand() {

        if ($this->input->post()) {
            $brand_id = $this->input->get('brand_id');
            $post = $this->input->post();
            unset($post['update_brand']);
            $this->load->model('admin/CRUD_model', 'updatebrand');
            $brand = $this->updatebrand->update_brand($brand_id, $post);
            if ($brand) {
                return redirect(base_url('admin/index/view_brands'));
            }
        }
    }
    
 
    
    
    //Update category after Edit
    function update_cat() {

        if ($this->input->post()) {
            $cat_id = $this->input->get('cat_id');
            $post = $this->input->post();
            unset($post['update_cat']);
            $this->load->model('admin/CRUD_model', 'updateCat');
            $cat = $this->updateCat->update_category($cat_id, $post);
            if ($cat) {
                return redirect(base_url('admin/index/view_cats'));
            }
        }
    }

    //Confirm order For make it Complete
    function confirm_order() {
        $order_id = $this->input->get('confirm_order');
        $this->load->model('admin/CRUD_model', 'updateorder');
        $complete_order = $this->updateorder->update_order($order_id);
        if ($complete_order) {
            return redirect(base_url('admin/index/view_orders'));
        }
    }
    
    function delete_image(){
          $image_id = $this->input->get('image_id');
        $this->load->model('admin/CRUD_model', 'delete');
        $del = $this->delete->delete_slider_image($image_id);
        if ($del) {
            $this->session->set_flashdata('feedback', "image Delete successfully");
            redirect(base_url('admin/index/view_slider'));
        } else {
            $this->session->set_flashdata('feedback', "Error in Your SCript");
        }
        
    }
    function update_slider_image(){
          if ($this->input->post()) {
            $image_id = $this->input->get('image_id');
            $config['upload_path'] = 'admin/slider_images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $imagedata['image'] = str_replace(" ", "_", $_FILES['image']['name']);
            $imagedata['image'] = date('Y-m-d H:i:s');
            if ($this->upload->do_upload('image')) {
                $file = $_FILES['image']['name'];
                $post = $this->input->post();
                $post['image'] = $file;
                unset($post['update_image']);
                $this->load->model('admin/CRUD_model', 'updateImage');
                $image = $this->updateImage->update_image($image_id, $post);
                return redirect(base_url('admin/index/view_slider'));
            } else {
                $error = array('error' => $this->upload->display_errors());
                echo '<pre>';
                print_r($error);
                echo '</pre>';
            }
        }
    }
    

     
            
    

}

?>