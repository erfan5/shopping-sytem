
<table width="795" align="center" bgcolor="pink"> 

	
	<tr align="center">
		<td colspan="6"><h2>View All Customers Here</h2></td>
	</tr>
	
	<tr align="center" bgcolor="skyblue">
		<th>S.N</th>
		<th>Name</th>
		<th>Email</th>
		<th>Image</th>
		<th>Delete</th>
	</tr>
	<?php 
        if (count($var)):
        $i = 0;
        foreach ($var as $customers):
        $i++;
        ?>
	<tr align="center">
		<td><?php echo $i;?></td>
		<td><?php echo $customers['customer_name'];?></td>
		<td><?php echo $customers['customer_email'];?></td>
                <?php if($customers['customer_image']): ?>
               <td><img src="<?php echo base_url('customer/customer_images/'); ?><?php echo $customers['customer_image'];?>" width="50" height="50"/></td>
                <?php
                    else:
                    ?>
               <td><p>No Image</p></td>
                   <?php endif; ?>
		<td><a href="<?php echo base_url('admin/delete_customer') ?>?custom_id=<?php echo $customers['customer_id'];?>"onClick="return confirm('Are you sure to delete?')">Delete</a></td>
	
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
    <?php endif; ?>




</table>