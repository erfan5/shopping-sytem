<html>
    <head>
        <title>Slider</title> 

        <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
        <script>
            tinymce.init({selector: 'textarea'});
        </script>
    </head>

    <body bgcolor="skyblue">


        <form action="<?php //echo base_url('admin/index/insert_slider_image'); ?>" method="post" enctype="multipart/form-data"> 

            <table align="center" width="795" border="2" bgcolor="#187eae">

                <tr align="center">
                    <td colspan="7"><h2>Insert New Image For slider</h2></td>
                </tr>

                <tr>
                    <td align="right"><b>Image Title:</b></td>
                    <td><input type="text" name="image_title" size="60" required/></td>
                </tr>

        

                <tr>
                    <?php if(isset($upload_error)) echo $upload_error; ?>
                    <td align="right"><b>Slider Image:</b></td>
                    <td><input type="file" name="image" /></td>
                </tr>

            
                <tr align="center">
                    <td colspan="7"><input type="submit" name="insert_image" value="Insert Image Now"/></td>
                </tr>

            </table>


        </form>


    </body> 
</html>






