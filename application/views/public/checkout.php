<!--banner-->
<?php 
 if($this->session->has_userdata('customer_id')){
?>
		<div class="banner1">
			<div class="container">
                            <h3><a href="index.php">Home</a> / <span>Checkout</span></h3>
			</div>
		</div>
 <?php } ?>
	<!--banner-->

	<!--content-->
		<div class="content">
			<div class="cart-items">
				<div class="container">
                                     <?php if ($cart_setting == 'db') { ?>
                                    <h1>My Shopping Bag (<span><?php if(isset($total_bill)) echo $total_bill; ?></span> (<span><?php echo $items;?></span> item's))</h1></br><br>
					<?php }else{?>	
                             <h1>My Shopping Bag (<span><?php if(isset($total_bill)) echo $total_bill ?></span> (<span><?php echo $items;?></span> items))</h1></br><br>
                                        <?php } ?>
				
					
					
					 
					
				</div>
			</div>
	<!-- checkout -->	
		</div>

