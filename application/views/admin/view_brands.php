
<table width="795" align="center" bgcolor="pink"> 

	
	<tr align="center">
		<td colspan="6"><h2>View All Brands Here</h2></td>
	</tr>
	
	<tr align="center" bgcolor="skyblue">
		<th>Brand ID</th>
		<th>Brand Title</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php 

        if (count($var)):
        $i = 0;
        foreach ($var as $brand):
        $i++;
	?>
	<tr align="center">
		<td><?php echo $i;?></td>
		<td><?php echo $brand['brand_title']?></td>
		<td><a href="<?php echo base_url('admin/index/edit_brand') ?>?brand_id=<?php echo $brand['brand_id'] ?>">Edit</a></td>
		<td><a href="<?php echo base_url('admin/delete_brand') ?>?brand_id=<?php echo $brand['brand_id']?>"onClick="return confirm('Are you sure to delete?')">Delete</a></td>
	
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