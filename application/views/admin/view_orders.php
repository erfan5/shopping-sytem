<table width="795" align="center" bgcolor="pink"> 

	
	<tr align="center">
		<td colspan="6"><h2>View all orders and order Items here</h2></td>
	</tr>
	
	<tr align="center" bgcolor="skyblue">
		<th>S.N</th>
                <th>Customer Email</th>
		<th>Product (S)</th>
		<th>Quantity</th>
                <th>Order ID</th>
		<th>Invoice No</th>
		<th>Order Date</th>
		<th>Action</th>
	</tr>
	<?php 
        if (count($var)):
       $i = 0;
       foreach ($var as $order):
       $i ++;
       ?>
	<tr align="center">
		<td><?php echo $i;?></td>
		<td><?php echo $order->c_email; ?></td>
		<td>
		<?php echo $order->product_title;?><br>
                  <?php if($order->product_image): ?>
                <img src="<?php echo base_url('admin/product_images/'); ?><?php echo $order->product_image;?>" width="50" height="50" />
                <?php
                   endif;
                    ?>
		</td>
		<td><?php echo $order->qty ?></td>
                <td><?php echo $order->order_id ?></td>
		<td><?php echo $order->invoice_no ?></td>
		<td><?php echo $order->order_date ?></td>
                <td><a href="<?php echo base_url('admin/confirm_order'); ?>?confirm_order=<?php echo $order->order_id ; ?>">Complete Order</a></td>
	
	</tr>
	  <?php
        endforeach;
       else:
        ?>
       <table>
       <tr>
            <td colspan="3">
            No record found
            </td>
       </tr>
      </table>
    <?php  endif; ?>
</table>