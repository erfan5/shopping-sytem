<div class="content">
			<!--banner-bottom-->
				
			<!--banner-bottom-->
			<!--new-arrivals-->
					<div class="product-agile">
					<div class="container">
						<h3 class="tittle1"> Your Selected Products</h3>
						<div class="slider">
							<div class="callbacks_container">
						
													
			     <div class="caption">		
				<?php 
                                if (count($all_pro)):
                                foreach ($all_pro as $product):
//                                    print_r($product);
//                                    exit();
                                ?>
                            <div class='col-md-3 cap-left simpleCart_shelfItem'>
                            <div class='grid-arr'>
                               
                                <h3><?php echo $product->product_title; ?></h3>
                                    <div  class='grid-arrival'>
                            <figure>		
                                    <a href='single.html'>
                                     <div class='grid-img'>
                                         <img  src="<?php echo base_url('admin/product_images/').$product->product_image;?>" width='200' height='300'>
			</div>
                                    <div class='grid-img'>
                                    <img  src='' class='img-responsive'  alt=''>
                                    </div>			
						</a>		
                                </figure>	
				</div>
                                <div class='ribben2'>
				<p>Stock: <?php  echo $product->stock; ?></p>
						</div>
                                    <div class='block'>
				<div class='starbox small ghosting'> </div>
			</div>
														
				<p ><em class='item_price'>Price: Rs <?php echo $product->product_price; ?></em></p>
                                <a href='<?php echo base_url('customer/add_cart'); ?>?pro_id=<?php echo $product->product_id; ?>' data-text='Add To Cart' class='my-cart-b item_add'>Add To Cart</a>
		</div>
  
	</div>
        <?php
        endforeach;
        else:
        ?>
       <table>
       <tr>
            <td colspan="3">
            No record were found
            </td>
       </tr>
      </table>
    <?php endif; ?>
</div>
		
                            <?php //getCatPro(); ?>
                                                            
                                                            
                                                            <div class="clearfix"></div>		
                                                                        </div>	
                                            
									  
										
						</div>
					</div>
				</div>
                                        </div>
			<!--new-arrivals-->
				<!--accessories-->
			<div class="accessories-w3l">
				<div class="container">
					<h3 class="tittle">20% Discount on</h3>
					<span>TRENDING DESIGNS</span>
				</div>
			</div>
			<!--accessories-->
			<div class="latest-w3">
				<div class="container">
					<h3 class="tittle1">Latest Fashion Trends</h3>
					<div class="latest-grids">
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img  src="<?php echo base_url('assets/images/l1.jpg'); ?>" class="img-responsive"  alt="">
								<div class="latest-text">
									<h4>Men</h4>
								</div>
								<div class="latest-text2 hvr-sweep-to-top">
									<h4>-50%</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img  src="<?php echo base_url('assets/images/l2.jpg'); ?>" class="img-responsive"  alt="">
								<div class="latest-text">
									<h4>Shoes</h4>
								</div>
								<div class="latest-text2 hvr-sweep-to-top">
									<h4>-20%</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img  src="<?php echo base_url('assets/images/l3.jpg'); ?>" class="img-responsive"  alt="">
								<div class="latest-text">
									<h4>Women</h4>
								</div>
								<div class="latest-text2 hvr-sweep-to-top">
									<h4>-50%</h4>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="latest-grids">
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img  src="<?php echo base_url('assets/images/l4.jpg'); ?>" class="img-responsive"  alt="">
								<div class="latest-text">
									<h4>Watch</h4>
								</div>
								<div class="latest-text2 hvr-sweep-to-top">
									<h4>-45%</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img  src="<?php echo base_url('assets/images/l5.jpg'); ?>" class="img-responsive"  alt="">
								<div class="latest-text">
									<h4>Bag</h4>
								</div>
								<div class="latest-text2 hvr-sweep-to-top">
									<h4>-10%</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img  src="<?php echo base_url('assets/images/l6.jpg'); ?>" class="img-responsive"  alt="">
								<div class="latest-text">
									<h4>Cameras</h4>
								</div>
								<div class="latest-text2 hvr-sweep-to-top">
									<h4>-30%</h4>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<!--new-arrivals-->
		</div>
		<!--content-->


