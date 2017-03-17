
<table width="795" align="center" bgcolor="pink"> 

	
	<tr align="center">
		<td colspan="6"><h2>View All Categories Here</h2></td>
	</tr>
	
	<tr align="center" bgcolor="skyblue">
		<th>Category ID</th>
		<th>Category Title</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php 

          if (count($var)):
             $i = 0;
             foreach ($var as $cat):
           $i++;
	?>
	<tr align="center">
		<td><?php echo $i;?></td>
		<td><?php echo $cat['cat_title'];?></td>
                <td><a href="<?php echo base_url('admin/index/edit_cat')?>?cat_id=<?php echo $cat['cat_id']; ?>">Edit</a></td>
		<td><a href="<?php echo base_url('admin/delete_cat') ?>?cate_id=<?php echo $cat['cat_id'];?>"onClick="return confirm('Are you sure to delete?')">Delete</a></td>
	  <?php if($feedback =$this->session->flashdata('feedback')): ?>
            <?php //echo $feedback ;
             endif;?>
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