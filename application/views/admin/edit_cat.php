<?php
 if (count($var)):
    // print_r($var);
    foreach ($var as $cats):
     ?>
   
<form action="<?php echo base_url('admin/update_cat') ?>?cat_id=<?php echo $cats->cat_id;?>" method="post" style="padding:80px;">

<b>Update Category:</b>
<input type="text" name="cat_title" value="<?php echo $cats->cat_title;?>"/> 
<input type="submit" name="update_cat" value="Update Category" /> 
<?php
 endforeach;
    endif;
?>
</form>

