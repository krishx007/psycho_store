 <body>
	<div class="container top-bottom-space">
		<div class="row">
			<div class="col-md-12">
				<h1>Confirm Order
					<span class="col-md-5 pull-right play">
					<a class="btn btn-primary pull-right" href=<?php echo site_url('checkout/')?> > <strong>Checkout</strong> | <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->final_price());?> </i> <i class="fa fa-arrow-right"></i> </a>
					</span>
				</h1>
			</div>
		</div>
		<hr>
		<div class="well">
			<div class="row">
				<?php $num_plus = 0;
				foreach ($this->cart->contents() as $items):
				$product = $products["{$items['id']}"];
				$path = "/".$product['product_image_path'];
				$url = url_title($product['product_url'],'_');
				$image_properties = array(
			          'src' => "$path",          
			          'class' => 'img-responsive',);?>
			        <div class="col-md-12">			        	
			        	<div class="col-md-2 col-lg-2 ">
							<?php echo anchor("/product/$url", img($image_properties));?>
						</div>
						<div class="col-md-10">
							<nav>				
								<ul class='nav nav-pills navbar-left'>
									<li>
										<h4 class="navbar-text "> <strong><?php echo $items['name']; ?>
											<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
											<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
											<small><?php echo $option_name; ?>: </small><?php echo $option_value; ?>
											<?php endforeach; ?>
											<?php endif; ?></strong>
										</h4>								           
									</li>									
										<li>										
						                    <div class="nav-button">
						                      <?php echo $items['qty']?>
						                    </div>				                  		
				                  	</li>
									</div>
									<li>
										<h3 class="navbar-text play"><small><i class="fa fa-times"> <i class="fa fa-rupee"><?php echo $this->cart->format_number($items['price']); ?></i> </i> = </small><i class="fa fa-rupee"><strong><?php echo $this->cart->format_number($items['subtotal']); ?></i></strong></h3>                                    
									</li>
								</ul>
							
							</nav>
						</div>
			        </div>
			    <?php if(count($this->cart->contents()) - $num_plus > 1): ?>			    
			    	<div class="col-md-12"> <h1 class="text-center"><strong>+</strong></h1></div>			    	
				<?php $num_plus++; endif;?>
			<?php endforeach; 
			if($this->cart->total_items() == 0)
				echo heading('Empty Cart',3, 'class="text-center"');
			?>			
			</div>
			<br><br>
			<hr>
			<div class="row">
				<div class="col-md-6 centered">
					<h1>Shipping To</h1>
					<?php $complete_add = $address['first_name'].' '.$address['last_name'].'<br>'.$address['address_1'] .',<br>';
				if($address['address_2'] != NULL)
				 	$complete_add = $complete_add.$address['address_2'].', ';
				 $complete_add = $complete_add.$address['city'].'<br>'.$address['state'].' '.$address['pincode'].', '.$address['country'].'<br>'. $address['phone_number'];
				 ?>
					<h4> <?php echo $complete_add;?> </h4>
				</div>
				<div class="col-md-6 centered">
					<h1>Sub Total 
						<h4>Actual Price : <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->total()) ?> </i></h4>
						<h4>Discount : <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->discount()) ?> </i></h4>
						<h4>Shipping : Always Free </h4>
						<h4>Final Price : <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->final_price()) ?> </i></h4>
					</h1>
				</div>>
			</div>
			<hr>
			<!-- <div class="row">
				<div class="col-md-12">
					<h1>Sub Total <span class="pull-right play"> 
						<h4>Actual Price : <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->total()) ?> </i></h4>
						<h4>Discount : <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->discount()) ?> </i></h4>
						<h4>Shipping : Always Free </h4>
						<h4>Final Price : <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->final_price()) ?> </i></h4>
					</span> </h1>
					
				</div>
			</div> -->
		</div>		
	</div>	
</body>
