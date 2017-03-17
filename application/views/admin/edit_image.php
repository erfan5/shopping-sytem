 <?php
    if (count($var)):
    foreach ($var as $slider):
    endforeach;
    endif;
 ?>
<html>
    <head>
        <title>Slider</title> 

        <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
        <script>
            tinymce.init({selector: 'textarea'});
        </script>
    </head>

    <body bgcolor="skyblue">


        <form action="<?php echo base_url('admin/update_slider_image') ?>?image_id=<?php echo $slider->id;?>" method="post" enctype="multipart/form-data"> 

            <table align="center" width="795" border="2" bgcolor="#187eae">

                <tr align="center">
                    <td colspan="7"><h2>Edit Image Here</h2></td>
                </tr>

                <tr>
                    <td align="right"><b>Image Title:</b></td>
                    <td><input type="text" name="image_title" value="<?php echo $slider->image_title;?>" size="60" required/></td>
                </tr>

        

                <tr>
                    <?php if(isset($upload_error)) echo $upload_error; ?>
                    <td align="right"><b>Slider Image:</b></td>
                    <td><input type="file" name="image" /><img src="<?php echo  base_url('admin/slider_images/'); ?><?php echo $slider->image;; ?>" width="60" height="60"/></td>
                </tr>

            
                <tr align="center">
                    <td colspan="7"><input type="submit" name="update_image"  value="Update Image"/></td>
                </tr>

            </table>


        </form>


    </body> 
</html>






