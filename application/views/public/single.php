<?php //print_r($pro_detail);  ?> 
<div class="product-agile">
    <div class="container">
        <h3 class="tittle1"> <?php echo $pro_detail[0]->product_title ?></h3>
        <div class="slider">
            <div class="callbacks_container">
                <div class='col-md-12 cap-left simpleCart_shelfItem'>
                    <div class='grid-arr'>

                        <h3><?php echo $pro_detail[0]->product_title ?></h3>
                        <div  class='grid-arrival'>
                            <figure>		
                                <a href='<?php echo base_url('customer/single_product'); ?>?pro_id=<?php echo $pro_detail[0]->product_id ?>'>
                                    <div class='grid-img single'>
                                        <img  src="<?php echo base_url('admin/product_images/') . $pro_detail[0]->product_image ?>" width='200' height='300'>
                                    </div>
                                    <div class='grid-img'>
                                        <img  src='' class='img-responsive'  alt=''>
                                    </div>			
                                </a>		
                            </figure>	
                        </div>
                        <div class='ribben2'>
                            <p>Stock: <?php echo $pro_detail[0]->stock ?></p>
                        </div>
                        <div class="discption" >
                        
                           <b>Discription: </b><?= $pro_detail[0]->product_desc; ?>
                        </div>
                            <div class='block'>
                            <div class='starbox small ghosting'> </div>
                        </div>
                        
                        <p ><em class='item_price'>Price: Rs <?php echo $pro_detail[0]->product_price ?></em></p>
                        <a href='<?php echo base_url('customer/add_cart'); ?>?pro_id=<?php echo $pro_detail[0]->product_id ?>' data-text='Add To Cart' class='my-cart-b item_add'>Add To Cart</a>
                    </div>
                    <div class="clearfix"></div>	

                </div>
            </div></div></div></div>
