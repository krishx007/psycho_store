 <body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Total : <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->total());?> </i> 
					<span class="pull-right play">
						<?php echo anchor('', 'Continue Shopping','class="btn btn-default"'); ?>						
						<?php if($this->cart->total_items()): ?>
							<a class="btn btn-primary" href=<?php echo site_url('checkout/')?> > <strong>Checkout</strong> | <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->total());?> </i> <i class="fa fa-arrow-right"></i> </a>
						<?php endif; ?>	
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
				$image_properties = array(
			          'src' => "$path",          
			          'class' => 'img-responsive',);?>
			        <div class="col-md-12">
			        	<div class="pull-right">
							<h4><a href= <?php echo site_url("cart/remove/{$items['rowid']}")?>> <i class="fa fa-times"></i></a></h4>
						</div>
			        	<div class="col-md-2 col-lg-2 ">
							<?php echo anchor("/product/{$items['id']}", img($image_properties));?>
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
		</div>
	</div>
</body>
