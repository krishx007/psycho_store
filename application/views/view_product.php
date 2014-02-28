<div class="container">
      <div class="section">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-left"><?php echo $product['product_name'] ?> <small>Rs <?php echo $product['product_price']?></small></h1>            
            <hr>
          </div>
          <ul class="pager">
            <li class="previous">
  				<?php 	$id = $product['product_id'] - 1; if($id < 1 ) $id = $total_products; echo anchor("product/$id", "Previous");?>
            </li>
            <li class="next">
              <?php 	$id = $product['product_id'] + 1; if($id > $total_products ) $id = 1; echo anchor("product/$id", "Next");?>
            </li>
          </ul>
          <div class="col-md-6">
            <img class="img-responsive" src = <?php echo site_url("{$product['product_image_path']}") ?> >
          </div>
          <div class="col-md-4">
            <div class="row">
              <div class="col-md-12">
                <p> <?php echo $product['product_desc']; ?> </p>
                <p>Product description here</p>
                <p>Product description here</p>
                <hr>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <a class="inline" href="#"><p><small>Whats my </small><strong> size</strong> ?</p></a>
              </div>              
              <div class="col-xs-12 col-md-4">
              	<form  method = "post" action = <?php echo site_url("cart/add/{$product['product_id']}")?> role="form">
	                <select class="form-control" name="size">
                  		<option value ="small">Small</option>
                  		<option value ="Medium">Medium</option>
                  		<option value ="large">Large</option>
                  		<option value ="x-large">X-Large</option>
                	</select>
                </div>	
	              <div class="col-md-8">
	                <button type="submit" name = "add_to_cart" class="btn btn-primary btn-block">Add To Cart</button>
	              </div>
          		</form>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h3 class="text-left">Other Products</h3>
            <hr>
          </div>
          <div class="row">
            <div class="col-md-2">
              <img class="img-responsive" src="http://www.redwolf.in/image/cache/data/coshish-band-firdous-t-shirt-maroon-500x500.png">
            </div>
            <div class="col-md-2">
              <img class="img-responsive" src="http://www.redwolf.in/image/cache/data/game-of-thrones-crows-hoes-nights-watch-t-shirts-india-500x500.png">
            </div>
            <div class="col-md-2">
              <img class="img-responsive" src="http://www.redwolf.in/image/cache/data/the-walking-dead-fight-dead-fear-living-t-shirt-india-500x500.png">
            </div>
            <div class="col-md-2">
              <img class="img-responsive" src="http://www.redwolf.in/image/cache/data/breaking-bad-golden-moth-chemical-t-shirt-india-500x500.png">
            </div>
            <div class="col-md-2">
              <img class="img-responsive" src="http://www.redwolf.in/image/cache/data/the-walking-dead-fight-dead-fear-living-t-shirt-india-500x500.png">
            </div>
            <div class="col-md-2">
              <img class="img-responsive" src="http://www.redwolf.in/image/cache/data/breaking-bad-i-am-the-danger-t-shirt-india-500x500.png">
            </div>
          </div>
        </div>
      </div>
    </div>
