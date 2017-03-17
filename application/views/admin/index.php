<!DOCTYPE> 

<html>
	<head>
		<title>This is Admin Panel</title> 
		
                <link rel="stylesheet" href="<?php echo base_url('admin/styles/style.css'); ?>" media="all" /> 
	</head>


<body> 

	<div class="main_wrapper">
	
	
		<div id="header"></div>
		
		<div id="right">
		<h2 style="text-align:center;">Manage Content</h2>
			
                <a href="<?php echo base_url('admin/index/insert_product'); ?>">Insert New Product</a>
			<a href="<?php echo base_url('admin/index/view_products'); ?>">View All Products</a>
			<a href="<?php echo base_url('admin/index/insert_cat'); ?>">Insert New Category</a>
			<a href="<?php echo base_url('admin/index/view_cats'); ?>">View All Categories</a>
			<a href="<?php echo base_url('admin/index/insert_brand'); ?>">Insert New Brand</a>
			<a href="<?php echo base_url('admin/index/view_brands'); ?>">View All Brands</a>
			<a href="<?php echo base_url('admin/index/view_customer'); ?>">View Customers</a>
			<a href="<?php echo base_url('admin/index/view_orders'); ?>">View Orders</a>
			<a href="<?php echo base_url('admin/index/view_payments'); ?>">View Payments</a>
                        <a href="<?php echo base_url('admin/index/view_slider'); ?>">View Slider</a>
                        <a href="<?php echo base_url('adminz/login/logout'); ?>">Admin Logout</a>
		
		</div>
		
		<div id="left">
		<h2 style="color:red; text-align:center;"><?php echo @$_GET['logged_in']; ?></h2>
                
                
                
		<?php 
                 if($this->uri->segment(3) == 'insert_product') {
                 include("insert_product.php"); 
                 }
                 
                 if($this->uri->segment(3) == 'view_products') {
                     include("view_products.php"); 
                 }
                  if($this->uri->segment(3) == 'insert_cat') {
                     include("insert_cat.php"); 
                 }
                  if($this->uri->segment(3) == 'view_cats') {
                     include("view_cats.php"); 
                 }
                  if($this->uri->segment(3) == 'insert_brand') {
                     include("insert_brand.php"); 
                 }
                 if($this->uri->segment(3) == 'view_brands') {
                     include("view_brands.php"); 
                 }
                 if($this->uri->segment(3) == 'view_customer') {
                 include("view_customer.php"); 
                 }
                 if($this->uri->segment(3) == 'view_orders') {
                 include("view_orders.php"); 
                 }
                 if($this->uri->segment(3) == 'view_payments') {
                 include("view_payments.php"); 
                 }
                 if($this->uri->segment(3) == 'edit_pro') {
                 include("edit_pro.php"); 
                 }
                  if($this->uri->segment(3) == 'edit_brand') {
                 include("edit_brand.php"); 
                 }
                 if($this->uri->segment(3) == 'edit_cat') {
                 include("edit_cat.php"); 
                 }
                  if($this->uri->segment(3) == 'insert_slider_image') {
                 include("insert_slider_image.php"); 
                 }
                  if($this->uri->segment(3) == 'view_slider') {
                 include("view_slider.php"); 
                 }
                   if($this->uri->segment(3) == 'edit_image') {
                 include("edit_image.php"); 
                 }
                ?>
		</div>






	</div>


</body>
</html>
