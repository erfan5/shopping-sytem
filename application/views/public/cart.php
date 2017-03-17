<!DOCTYPE HTML>
<html>

    <body>

        <!--banner-->
        <div class="banner1">
            <div class="container">
                <h3><a href="<?php echo base_url(); ?>">Home</a> / <span>Cart</span></h3>
            </div>
        </div>
        <!--banner-->

        <!--content-->
        <div class="content">
            <div class="cart-items">
                <div class="container">
                    <?php
                    
                    //if cart setting is database
                    if(isset($cart_setting)):
                    if (isset($total_price)):
                        $price = 0;
                        foreach ($total_price as $total):
                           // print_r($total_price); exit;
                            $price += $total->product_price;
                        endforeach;
                    
                    ?> 




                    <!--<h1>My Shopping Bag (<span><?php// if (isset($price)) echo $total_bill[0]->total; ?></span> (<span><?php //echo $items; ?></span> items))</h1><br><br>-->

                    <form action="" method="post" enctype="multipart/form-data">
                        <p style="color: red;">
                                                <?php if ($feedback = $this->session->flashdata('feedback')): 
                                                    echo $feedback;
                                                endif;
                                                ?></p>

                        <table align="center" width="1000" class="table table-inverse">
                            <thead>
                                <tr align="center">
                                    <th><h1>Remove</h1></th>
                                    <th><h1>Product(S)</h1></th>
                                    <th><h1>Quantity</h1></th>
                                    <th><h1>Total Price</h1></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                foreach ($total_price as $total):
                                    $qty = $total->qty;
                                    $single_price = $total->product_price;
                                    $single_final = $single_price * $qty
                                    ?>
                                    <tr align="center">
                                        <td><label class="btn btn-primary">


                                                <input type="checkbox" name="remove[]" value="<?php echo $total->p_id; ?>" autocomplete="off"> Remove
                                            </label></td>
                                        <td><h3><?php echo $total->product_title; ?></h3><br>
                                            <img src="<?php echo base_url('admin/product_images/') ?><?php echo $total->product_image; ?>" width="200" height="300"/>
                                        </td>
                                        <td><input type="text" size="4" name="qty[<?php echo $total->p_id; ?>]"  value="<?php echo $qty; ?>">
                                       </td>
                                        <td><h1><?php echo "Rs " . $single_final; ?></h1></td>
                                       
                                    </tr><?php endforeach; endif; endif; ?>
                                    
                                    <!-- if cart setting is Cookies-->
                                     




                    <h1>My Shopping Bag (<span><?php if (isset($total_bill)) echo $total_bill; ?></span> (<span><?php echo $items; ?></span> items))</h1><br><br>

                  

                        <table align="center" width="1000" class="table table-inverse">
                        
                            <tbody>
                                <?php
                                if(isset($pro_detail)):
                                foreach ($pro_detail as $products):
                                    $price= array();
                                $qty= array();
                                foreach ($cart_detail as $index => $detail):
                                   
                                 $price[$index] =  $detail['product_price'];
                                $qty[$index] = $detail['qty'];
                               
                                 endforeach;

                                
                                    ?>
                                    <tr align="center">
                                        <td><label class="btn btn-primary">


                                                <input type="checkbox" name="remove[]" value="<?php echo $products->product_id; ?>" autocomplete="off"> Remove
                                            </label></td>
                                        <td><h3><?php echo $products->product_title; ?></h3><br>
                                            <img src="<?php echo base_url('admin/product_images/') ?><?php echo $products->product_image; ?>" width="200" height="300"/>
                                        </td>
                                        <td><input type="text" size="4" name="qty[<?php  echo $products->product_id; ?>]"  value="<?php echo $qty[$products->product_id]; ?>">
                                       </td>
                                        <td><h1><?php echo "Rs " .  $price[$products->product_id]; ?></h1></td>
                                       
                                    </tr><?php endforeach; endif;?>
                                    
                                    
                                    
                                    
                                
                            </tbody>	
                            <tbody>
                                <tr>
                                    <td colspan="4" align="right"><h1><b>Sub Total:</b></h1></td>
                                    <td><h1><?php if (isset($total_bill)) echo "Rs " . $total_bill; ?></h1></td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr align="center">
                                    <td><a href="<?php echo base_url('customer/cart'); ?>"><button type="submit" name="update_cart" class="btn btn-info">Update Cart</button></a></td>
                                    <td><a href="<?php echo base_url(); ?>"><button type="submit" name="continue" class="btn btn-info">Continue Shopping</a></button></td>
                                    <td><button type="submit" class="btn btn-info"><a href="<?php echo base_url('customer/checkout'); ?>" style="text-decoration:none; color:black;">Checkout</a></button></td>
                                </tr>
                            </tbody>
                        </table> 

                    </form>

                </div>
            </div>
            <!-- checkout -->	
        </div>
        <!---footer--->


    </body>
</html>