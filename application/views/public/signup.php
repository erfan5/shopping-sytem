<!--banner-->
<div class="banner1">
    <div class="container">
        <h3><a href="index.php">Home</a> / <span>Registered</span></h3>
    </div>
</div>
<!--banner-->	
<div class="content">
    <!--login-->
    <div class="login">
        <div class="main-agileits">
            <div class="form-w3agile form1">
                <h3>Register</h3>
                <?php echo form_open_multipart('signup'); ?>
                <div class="key">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input  type="text" value="<?php echo set_value('customer_name'); ?>" placeholder="Name" name="customer_name" onFocus="this.value = '';" onBlur="if (this.value == '') {
                                                                    this.value = 'Username';
                                                                }" required="">
                    <?php echo form_error('customer_name'); ?>
                    <div class="clearfix"></div>
                </div>
                <div class="key">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <input  type="text" value="<?php echo set_value('customer_email'); ?>" placeholder="Email Id" name="customer_email" onFocus="this.value = '';" onBlur="if (this.value == '') {
                                                                    this.value = 'Email';
                                                                }" required="">
                    <?php echo form_error('customer_email'); ?>
                    <div class="clearfix"></div>
                </div>
                <div class="key">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input  type="password" value="<?php echo set_value('customer_pass'); ?>" name="customer_pass" onFocus="this.value = '';" onBlur="if (this.value == '') {
                                                                    this.value = 'Password';
                                                                }" required="">
                    <?php echo form_error('customer_pass'); ?>
                    <div class="clearfix"></div>
                </div>


                <div class="key">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                    <span class="btn btn-default btn-file">
                        Uplad Image <input type="file" value="<?php echo set_value('customer_image'); ?>" name="customer_image" required="">
                    </span>
                    <?php echo form_error('customer_image'); ?>
                    <div class="clearfix"></div>
                </div>
                <div class="key">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <input  type="text" value="<?php echo set_value('customer_address'); ?>" placeholder="Address" name="customer_address" onFocus="this.value = '';" onBlur="if (this.value == '') {
                                                                    this.value = '';}" required="">
                    <?php echo form_error('customer_address'); ?>
                    <div class="clearfix"></div>
                </div>


                <div class="key">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <input  type="text" value="<?php echo set_value('customer_city'); ?>" placeholder="City" name="customer_city" onFocus="this.value = '';" onBlur="if (this.value == '') {
                                                                    this.value = '';
                                                                }" required="">
                    <?php echo form_error('customer_city'); ?>
                    <div class="clearfix"></div>
                </div>
                <div class="key">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <input  type="text" value="<?php echo set_value('customer_contact'); ?>" placeholder="Contact Number" name="customer_contact" onFocus="this.value = '';" onBlur="if (this.value == '') {
                                                                    this.value = '';
                                                                }" required="">
                    <?php echo form_error('customer_contact'); ?>
                    <div class="clearfix"></div>
                </div>
                <div class="key">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <input  type="text" value="<?php echo set_value('customer_country'); ?>" placeholder="country" name="customer_country" onFocus="this.value = '';" onBlur="if (this.value == '') {
                                                                    this.value = '';}" required="">
                    <?php echo form_error('customer_country'); ?>
                    <div class="clearfix"></div>
                </div>
                <input type="submit" name="register" value="Submit">
                </form>


            </div>

        </div>
    </div>
    <!--login-->
</div>
<!--content-->

