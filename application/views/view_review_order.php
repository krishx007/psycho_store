 <body>
	<div class="container top-bottom-space">
		<div class="row">
			<div class="col-md-12">
				<h1>Confirm Order
					<small><i class="fa fa-rupee"></i> <?php echo $this->cart->format_number($this->cart->final_price()) ?>
					</small>
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
					<h1>Sub Total 
						<h4>Actual Price : <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->total()) ?> </i></h4>
						<h4>Discount : <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->discount()) ?> </i></h4>
						<h4>Shipping : Always Free </h4>
						<h4>Final Price : <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->final_price()) ?> </i></h4>
					</h1>
				</div>
				<div class="col-md-4">
					<h1>Payment Mode</h1>
					<form  method = "post" action = <?php echo site_url('checkout/payment')?> role="form">
						<select class="form-control" name="payment_mode">
							<option value="cod">Cash On delivery (Free) </option>
							<option value="online" disabled>Pay Online</option>
						</select>					
				</div>
			</div>			
		</div>
		<button class="btn btn-primary pull-right" type="submit"> Place Order | <i class="fa fa-rupee"> <?php echo $this->cart->format_number($this->cart->final_price());?> </i> <i class="fa fa-arrow-right"></i> </button>
		</form>
	</div>	
</body>
