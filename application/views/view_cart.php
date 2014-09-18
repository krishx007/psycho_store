 <body>
	<div class="container top-bottom-space">
		<div class="row">
			<div class="col-md-12">
				<h1>Total : <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->final_price());?> </i> 
					<?php if($this->cart->total_items()): ?>						
						<span class="col-md-5 pull-right play">
							<form class="navbar-form" method = "post" action=<?php echo site_url('cart/applyDiscount')?>>
					        	<div class="input-group">
					          		<input type="text" name="coupon" class="form-control input" placeholder="Discount Coupon">
					          		<span class="input-group-btn"><button class="btn btn-primary btn" type="submit">Apply Discount</button></span>
					        	</div>
					      	</form>
						</span>
					<?php endif; ?>	
				</h1>
			</div>
		</div>
		<hr class="">
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
			        	<div class="pull-right">
							<h4><a href= <?php echo site_url("cart/remove/{$items['rowid']}")?>> <i class="fa fa-times"></i></a></h4>
						</div>
			        	<div class="col-md-2 col-lg-2 ">
							<?php echo anchor("/product/$url", img($image_properties));?>
						</div>
						<div class="col-md-10">
							<nav>				
								<ul class='nav nav-pills navbar-left'>
									<li>
										<h4 class="navbar-text ">
											<?php echo $items['name']; ?>
											<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
											<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
											<small><?php echo $option_name; ?>: </small><?php echo $option_value; ?>
											<?php endforeach; ?>
											<?php endif; ?>
										</h4>								           
									</li>
									<div class="col-md-3 navbar-btn">
										<li>
										<form class="form" method="post" action=<?php echo site_url('cart/update/')?> >
						                    <div class="input-group">
						                      <input type="number" min ='0' name=<?php echo $items['rowid']?> class="form-control input-sm" value=<?php echo $items['qty']?> >
						                      <span class="input-group-btn"><button class="btn btn-default btn-sm" type="submit">Update</button></span>
						                    </div>
				                  		</form>
				                  	</li>
									</div>
									<li>
										<h3 class="navbar-text play"><small><i class="fa fa-times"> <i class="fa fa-rupee"><?php echo $this->cart->format_number($items['price']); ?></i> </i> = </small><i class="fa fa-rupee"><strong><?php echo $this->cart->format_number($items['subtotal']); ?></i></strong></h3>                                    
									</li>
								</ul>
							<h4 class="text-right text-primary"><?php echo $products[$items['rowid'].'stock_state'];?></h4>
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
				<div class="col-md-12">
					<h1>Sub Total <span class="pull-right play"> 
						<h4>Actual Price : <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->total()) ?> </i></h4>
						<h4>Discount : <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->discount()) ?> </i></h4>
						<h4>Shipping : Always Free </h4>
						<h4>Final Price : <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->final_price()) ?> </i></h4>
					</span> </h1>
					
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php echo anchor('', 'Continue Shopping','class="btn btn-default"'); ?>						
						<?php if($this->cart->total_items()): ?>
							<a class="btn btn-primary pull-right" href=<?php echo site_url('checkout/')?> > Checkout | <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->final_price());?> </i> <i class="fa fa-arrow-right"></i> </a>
						<?php endif; ?>
				</span> </h1>
			</div>
		</div>
	</div>	
</body>
