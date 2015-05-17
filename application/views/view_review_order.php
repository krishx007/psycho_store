<body>
<div class="container top-bottom-space">
	<div class="row">
		<div class="col-md-12">
			<h1>Confirm Order
			<span class="pull-right"> <i class="fa fa-rupee"></i> <span id='price'> <?php echo $this->cart->final_price()?></span></span> 
			</h1>
		</div>
	</div>
	<hr>
	<div class="well">
		<div class="row">
			<div class="col-md-4">
				<h1>Shipping To</h1>
				<?php $complete_add = $address['first_name'].' '.$address['last_name'].'<br><br>'.$address['address_1'] .',<br>';
			if($address['address_2'] != NULL)
			 	$complete_add = $complete_add.$address['address_2'].', ';
			 $complete_add = $complete_add.$address['city'].'<br>'.$address['state'].' '.$address['pincode'].', '.$address['country'].'<br>'. $address['phone_number'];
			 ?>
				<h4> <?php echo $complete_add;?> </h4>
			</div>
			<div class="col-md-4">
				<h1>Pricing
					<h4>Actual Price : <i class="fa fa-rupee"></i> <?php echo $this->cart->total() ?></h4>
					<h4>Discount : <i class="fa fa-rupee"></i> <?php echo $this->cart->discount() ?> </h4>
					<h4>Shipping : Always Free </h4>
					<h4>Final Price : <i class="fa fa-rupee"></i> <?php echo $this->cart->final_price() ?> </h4>
				</h1>
			</div>
			<div class="col-md-4">
				<h1>Payment Mode</h1>
				<form  method = "post" action = <?php echo site_url('checkout/payment')?> role="form" onchange="update_price()">
					<select class="form-control" name="payment_mode">
						<option value="online" >Pay Online</option>
						<?php if($cod_available == true): ?>
						<option value="cod">Cash On delivery</option>
						<?php endif; ?>
					</select>
				<?php if($cod_available == false): ?>
						<p> Note : Cash On Delivery Service not available for your address</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
	Note : Placing the order implies you agree to our <a href = <?php echo site_url('shipping_returns') ?> > Shipping and Returns policy </a>
	<button class="btn btn-primary pull-right" type="submit"> Place Order | <i class="fa fa-rupee"></i>  <?php echo $this->cart->final_price();?> <i class="fa fa-arrow-right"></i></button>
	</form>
</div>
</body>
