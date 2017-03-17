 <?php
    if (count($pro)):
    foreach ($pro as $product):
    endforeach;
    endif;
 ?>
            



    
<html>
	<head>
		<title>Update Product</title> 
		
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
	</head>
	
<body bgcolor="skyblue">


	<form action="<?php echo base_url('admin/update_product') ?>?pro_id=<?php echo $product->product_id;?>" method="post" enctype="multipart/form-data"> 
		
		<table align="center" width="795" border="2" bgcolor="#187eae">
			
			<tr align="center">
				<td colspan="7"><h2>Edit & Update Product</h2></td>
			</tr>
			
			<tr>
				<td align="right"><b>Product Title:</b></td>
				<td><input type="text" name="product_title" size="60" value="<?php echo $product->product_title;?>"/></td>
			</tr>
			
			<tr>
				<td align="right"><b>Product Category:</b></td>
				<td>
				<select name="product_cat" >
                                    <option><?php echo $product->cat_title; ?></option>
		<?php 
                if (count($cat)):
                foreach ($cat as $cats):
                $cat_id =$cats['cat_id'];
                $cat_title = $cats['cat_title'];
                echo "<option value='$cat_id'>$cat_title</option>";
                 endforeach;
                endif;
                ?>
				</select>
				
				
				</td>
			</tr>
			
			<tr>
				<td align="right"><b>Product Brand:</b></td>
				<td>
				<select name="product_brand" >
			        <option><?php echo $product->brand_title; ?></option>
                                <?php 
                                if (count($brand)):
                                foreach ($brand as $brands):
                                $brand_id = $brands['brand_id']; 
                                $brand_title = $brands['brand_title'];
                                echo "<option value='$brand_id'>$brand_title</option>";
                                endforeach;
                                endif;
                                ?>
				</select>
				
				
				</td>
			</tr>
			
			<tr>
				<td align="right"><b>Product Image:</b></td>
                                    
                               
                                <td><input type="file" name="product_image"/><img src="<?php echo  base_url('admin/product_images/'); ?><?php echo $product->product_image;; ?>" width="60" height="60"/></td>
			</tr>
			
			<tr>
				<td align="right"><b>Product Price:</b></td>
				<td><input type="text" name="product_price" value="<?php echo $product->product_price;?>"/></td>
			</tr>
			
			<tr>
				<td align="right"><b>Product Description:</b></td>
				<td><textarea name="product_desc" cols="20" rows="10"><?php echo $product->product_desc; ;?></textarea></td>
			</tr>
			
			<tr>
				<td align="right"><b>Product Keywords:</b></td>
				<td><input type="text" name="product_keywords" size="50" value="<?php echo $product->product_keywords; ;?>"/></td>
			</tr>
			
			<tr align="center">
                            <td colspan="7"><input type="submit" name="update_product" value="Update Product"/></td>
			</tr>
		
		</table>
	
	
	</form>


</body> 
</html>














