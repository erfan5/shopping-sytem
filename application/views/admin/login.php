<!DOCTYPE>
<html>
	<head>
		<title>Admin Login</title>
<link rel="stylesheet" href="<?php echo base_url('admin/styles/login_style.css'); ?>" media="all" /> 

	</head>
<body>
<div class="login">
<h1>Admin Login</h1>
         <?php echo form_open('adminz/login'); ?>
    
        <input type="text" name="email" value="<?php echo set_value('email'); ?>" placeholder="Eamil" required="required" />
            <?php echo form_error('email'); ?>
        <input type="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password" required="required" />
        <?php echo form_error('password'); ?>
        <button type="submit" class="btn btn-primary btn-block btn-large" name="login">Login</button>
    </form>
</div>


</body>
</html>


