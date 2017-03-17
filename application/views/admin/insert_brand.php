
<form action="" method="post" style="padding:80px;">

<b>Insert New Brand:</b>
<input type="text" name="brand_title" required/> 
<input type="submit" name="add_brand" value="Add Brand" /> 
<?php if($feedback =$this->session->flashdata('feedback')): ?>
<?php echo $feedback ;
        endif;?>

</form>
