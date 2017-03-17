<table width="795" align="center" bgcolor="pink"> 


    <tr align="center">
        <td colspan="6"><h2>View Slider Images</h2><button><a href="<?php echo base_url('admin/index/insert_slider_image'); ?>">ADD New Image</a></button></td>
    </tr>

    <tr align="center" bgcolor="skyblue">
        <th>S.N</th>
        <th>Image Title</th>
        <th>Image</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
    if (count($var)):
        $i = 0;
        foreach ($var as $slider):
            $i ++;
            ?>


            <tr align="center">
                <td><?php echo $i; ?></td>
                <td><?php echo $slider['image_title'] ?></td>
                <td><img src="<?php echo base_url('admin/slider_images/') . $slider['image'] ?>" width="60" height="60"/></td>
                <td><a href="<?php echo base_url('admin/index/edit_image') ?>?image_id=<?php echo $slider['id']; ?>">Edit</a></td>
                <td><a href="<?php echo base_url('admin/delete_image') ?>?image_id=<?php echo $slider['id'] ?>"onClick="return confirm('Are you sure to delete?')">Delete</a></td>
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

    
   
            



