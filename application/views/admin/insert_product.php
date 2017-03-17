<html>
    <head>
        <title>Inserting Product</title> 

        <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
        <script>
            tinymce.init({selector: 'textarea'});
        </script>
    </head>

    <body bgcolor="skyblue">


        <form action="" method="post" enctype="multipart/form-data"> 

            <table align="center" width="795" border="2" bgcolor="#187eae">

                <tr align="center">
                    <td colspan="7"><h2>Insert New Product Here</h2></td>
                </tr>

                <tr>
                    <td align="right"><b>Product Title:</b></td>
                    <td><input type="text" name="product_title" size="60" required/></td>
                </tr>

                <tr>
                    <td align="right"><b>Product Category:</b></td>
                    <td>
                        <select name="product_cat" >
                            <option>Select a Category</option>
                            <?php  
                           if (count($cat)):
                                foreach ($cat as $cats):
                                    $cat_id = $cats['cat_id'];
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
                            <option>Select a Brand</option>
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
                    <?php if(isset($upload_error)) echo $upload_error; ?>
                    <td align="right"><b>Product Image:</b></td>
                    <td><input type="file" name="product_image" /></td>
                </tr>

                <tr>
                    <td align="right"><b>Product Price:</b></td>
                    <td><input type="text" name="product_price" required/></td>
                </tr>
                <tr>
                <td align="right"><b>Stock:</b></td>
                <td><input type="text" name="stock" required/></td>
                </tr>

                <tr>
                    <td align="right"><b>Product Description:</b></td>
                    <td><textarea name="product_desc" cols="20" rows="10"></textarea></td>
                </tr>

                <tr>
                    <td align="right"><b>Product Keywords:</b></td>
                    <td><input type="text" name="product_keywords" size="50" required/></td>
                </tr>

                <tr align="center">
                    <td colspan="7"><input type="submit" name="insert_post" value="Insert Product Now"/></td>
                </tr>

            </table>


        </form>


    </body> 
</html>




