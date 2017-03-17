	<!--banner-->
		<div class="banner-w3">
			<div class="demo-1">            
				<div id="example1" class="core-slider core-slider__carousel example_1">
					<div class="core-slider_viewport">
						<div class="core-slider_list">
                                                    <?php
                                                    if (count($slider)):
                                                        
                                                    
                                                    foreach ($slider as $images):     
                                                    
                                                    
                                                    ?>
							<div class="core-slider_item">
								<img src="<?php echo base_url('admin/slider_images/') . $images['image'] ?>" class="img-responsive" alt="">
							</div>
                                                    <?php endforeach;  endif; ?>

						 </div>
					</div>
					<div class="core-slider_nav">
						<div class="core-slider_arrow core-slider_arrow__right"></div>
						<div class="core-slider_arrow core-slider_arrow__left"></div>
					</div>
					<div class="core-slider_control-nav"></div>
				</div>
			</div>
			<link href="<?php echo base_url('assets/css/coreSlider.css'); ?>" rel="stylesheet" type="text/css">
			<script src="<?php echo base_url('assets/js/coreSlider.js'); ?>"></script>
			<script>
			$('#example1').coreSlider({
			  pauseOnHover: false,
			  interval: 3000,
			  controlNavEnabled: true
			});

			</script>

		</div>	
		<!--banner-->

