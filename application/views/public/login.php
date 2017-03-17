<!--banner-->

<div class="banner1">
    <div class="container">
        <h3><a href="index.php">Home</a> / <span>Login</span></h3>
    </div>
</div>

<!--banner-->

<!--content-->
<div class="content">
    <!--login-->
    <div class="login">
        <div class="main-agileits">
            <div class="form-w3agile">
                <h3>Login To New Shop</h3>
                <?php echo form_open('login'); ?>
                    <div class="key">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input  type="text" value="<?php echo set_value('email'); ?>" name="email" onFocus="this.value = '';" onBlur="if (this.value == '') {
                                                                            this.value = 'Email';
                                                                        }" required="">
                         <?php echo form_error('email'); ?>
                        <div class="clearfix"></div>
                    </div>
                    <div class="key">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input  type="password" value="<?php echo set_value('password'); ?>" name="password" onFocus="this.value = '';" onBlur="if (this.value == '') {
                                                                            this.value = 'Password';}" required="">
                        <?php echo form_error('password'); ?>
                        <div class="clearfix"></div>
                    </div>
                    <input type="submit" name="login" value="Login">

                    <div class="forg">
<!--                        <a href="checkout.php?forgot_pass" class="forg-left">Forgot Password</a>-->
                        <a href="<?php echo base_url('signup'); ?>" class="forg-right">Register</a>
                        <div class="clearfix"></div>
                    </div>
                </form>
      
            </div>

        </div>
    </div>
    <!--login-->
</div>
<!--content-->

