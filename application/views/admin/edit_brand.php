
        <?php 

       if (count($brand)):
       foreach ($brand as $brands):
          // print_r($brands);   
        
	?>
<form action="<?php echo base_url('admin/update_brand') ?>?brand_id=<?php echo $brands->brand_id;?>" method="post" style="padding:80px;">

<b>Update Brand</b>
<input type="text" name="brand_title" value="<?php echo $brands->brand_title;?>"/> 
<input type="submit" name="update_brand" value="Update Brand" /> 

</form>
 <?php
        endforeach;
    endif;
        ?>

