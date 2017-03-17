<table width="795" align="center" bgcolor="pink"> 


    <tr align="center">
        <td colspan="6"><h2>View All Products Here</h2></td>
    </tr>

    <tr align="center" bgcolor="skyblue">
        <th>S.N</th>
        <th>Title</th>
        <th>Image</th>
        <th>Price</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
    if (count($var)):
        $i = 0;
        foreach ($var as $product):
            $i ++;
            ?>


            <tr align="center">
                <td><?php echo $i; ?></td>
                <td><?php echo $product['product_title'] ?></td>
                <td><img src="<?php echo base_url('admin/product_images/') . $product['product_image'] ?>" width="60" height="60"/></td>
                <td><?php echo $product['product_price'] ?></td>
                <td><a href="<?php echo base_url('admin/index/edit_pro') ?>?pro_id=<?php echo $product['product_id']; ?>">Edit</a></td>
                <td><a href="<?php echo base_url('admin/delete_pro') ?>?pro_id=<?php echo $product['product_id'] ?>"onClick="return confirm('Are you sure to delete?')">Delete</a></td>
           <?php if($feedback =$this->session->flashdata('feedback')): 
             //echo $feedback ;
             endif;?>
            </tr>
            
        <?php
        endforeach;


    else:
        ?>
            </table>
        <table>
            <tr>
                <td colspan="3">
                    No record found
                </td>
            </tr>
        </table>
<?php endif; ?>

    
   
            



