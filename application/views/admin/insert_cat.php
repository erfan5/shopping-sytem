
<form action="<?php //echo base_url('admin/store_cat'); ?>" method="post" style="padding:80px;">

<b>Insert New Category:</b>
<input type="text" name="cat_title" value="" required/> 

<input type="submit" name="add_cat" value="Add Category" /> 
<?php if($feedback =$this->session->flashdata('feedback')): ?>
<?php echo $feedback ;
        endif;?>

</form>



