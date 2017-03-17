<div class="product-agile">
					<div class="container">
						<h3 class="tittle1"> Your Searched result</h3>
						<div class="slider">
							<div class="callbacks_container">
<div class="caption">	  
<?php
if (count($result)):                             
  foreach ($result as $product):
                                //   print_r($product);
                               
                               ?>
<div class='col-md-3 cap-left simpleCart_shelfItem'>
                            <div class='grid-arr'>
                             
                                <h3><?php echo $product->product_title ?></h3>
                                    <div  class='grid-arrival'>
                            <figure>		
                                    <a href='single.html'>
                                     <div class='grid-img'>
                                         <img  src="<?php echo base_url('admin/product_images/').$product->product_image ?>" width='200' height='300'>
			</div>
                                    <div class='grid-img'>
                                    <img  src='' class='img-responsive'  alt=''>
                                    </div>			
						</a>		
                                </figure>	
				</div>
                                <div class='ribben2'>
				<p>Stock: <?php echo $product->stock ?></p>
						</div>
                                    <div class='block'>
				<div class='starbox small ghosting'> </div>
			</div>
														
				<p ><em class='item_price'>Price: Rs <?php echo $product->product_price ?></em></p>
                                <a href='<?php echo base_url('customer/add_cart'); ?>?pro_id=<?php echo $product->product_id ?>' data-text='Add To Cart' class='my-cart-b item_add'>Add To Cart</a>
		</div>
    
  
	</div>
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

</div>
                                                        </div>
                                                </div></div></div>