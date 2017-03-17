<div>


    <h2 align="center" style="padding:2px;">Pay now with Paypal:</h2>

    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" >


        <!-- Identify your business so that you can collect the payments. -->
        <input type="hidden" name="business" value="sriniv_1293527277_biz@inbox.com">

        <!-- Specify a Buy Now button. -->
        <!-- Specify a PayPal Shopping Cart Add to Cart button. -->
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="upload" value="1">
        <?php
        if ($cart_setting == 'db') {
            if (count($total_price)):
               $i = 0;
                foreach ($total_price as $total):
                    $i++;
                    $price = $total->product_price;

                    $title = $total->product_title;
                    $product_id = $total->product_id;
                    $qty = $total->qty;
                    ?>
                    <!-- Specify details about the item that buyers will purchase. -->
                    <input type="hidden" name="item_name_<?php echo $i; ?>" value="<?php echo $title; ?>">
                    <input type="hidden" name="item_number_<?php echo $i; ?>" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="amount_<?php echo $i; ?>" value="<?php echo $price ?>  ">
                    <input type="hidden" name="quantity_<?php echo $i; ?>" value="<?php echo $qty; ?>">

                    <?php
                endforeach;
            endif;
        }else {
            $i = 0;
            foreach ($pro_detail as $products):
                foreach ($cart_detail as $index => $detail):

                    
                    $qty[$index] = $detail['qty'];
                    endforeach;
                $i++;
                
                 $price = $products->product_price;

                    $title = $products->product_title;
                    $product_id = $products->product_id;
                
                
                
                ?>

                <!-- Specify details about the item that buyers will purchase. -->
                <input type="hidden" name="item_name_<?php echo $i; ?>" value="<?php echo $title; ?>">
                <input type="hidden" name="item_number_<?php echo $i; ?>" value="<?php echo $product_id; ?>">
                <input type="hidden" name="amount_<?php echo $i; ?>" value="<?php echo $price ?>  ">
                <input type="hidden" name="quantity_<?php echo $i; ?>" value="<?php echo $qty[$product_id]; ?>">

    <?php endforeach;
} ?>





        <input type="hidden" name="currency_code" value="USD">  
        <input type="hidden" name="return" value="http://[::1]/shoping/customer/paypal_success">
        <input type="hidden" name="notify_url" value="http://shoping/notify.php"> 

        <input type="hidden" name="cancel_return" value="http://[::1]/shoping/customer/paypal_cancel">

        <!-- Display the payment button. -->
        <input type="image" name="submit" border="0"
               src="paypal_button.png"
               alt="PayPal - The safer, easier way to pay online">
        <img alt="" border="0" width="1" height="1"
             src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

    </form>

</div>



<div>
  