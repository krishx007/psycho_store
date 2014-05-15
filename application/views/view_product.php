<div class="container">
      <div class="section">
        <div class="top-bottom-space">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-left"><?php echo $product['product_name'] ?> <small>Rs <?php echo $product['product_price']?></small></h1>            
            <hr>
          </div>
          <ul class="pager">
            <li class="previous">
  				<?php echo anchor("product/$prev_id", "Previous");?>
            </li>
            <li class="next">
              <?php echo anchor("product/$next_id", "Next");?>
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
                <p><a class="inline" href="#"><small>Whats my </small><strong> size</strong> ?</a> </p>
              </div>              
              <div class="col-md-4">
              	<form  method = "post" action = <?php echo site_url("cart/add/{$product['product_id']}")?> role="form">
	                <select class="form-control" name="size">
                  		<option <?php echo $small_stock; ?> value ="Small">Small <?php if($small_stock == 'disabled') echo '(Out Of Stock)';?> </option>
                  		<option <?php echo $medium_stock; ?> value ="Medium">Medium <?php if($medium_stock == 'disabled') echo '(Out Of Stock)';?> </option>
                  		<option <?php echo $large_stock; ?> value ="Large">Large <?php if($large_stock == 'disabled') echo '(Out Of Stock)';?> </option>
                  		<option <?php echo $xl_stock; ?> value ="XL">XL <?php if($xl_stock == 'disabled') echo '(Out Of Stock)';?> </option>
                	</select>
                </div>	
	              <div class="col-md-8">                  
	                <button type="submit" name = "add_to_cart" class="btn btn-primary btn-block">Add To Cart</button>
	              </div>
          		</form> 
              <div class="col-md-12">
                 <h5 class=""><a class="" href= <?php echo site_url('policies')?> ><strong>Free shipping + 365 days return</strong></a></h5>
              </div>                       
            </div>
            <hr>
            <div class="row ">
              <div class="col-md-12">
                <h5>Inspired by&nbsp;<span class="h4 molot"><a href=<?php $game = url_title($product['product_game'],'_'); echo site_url("search/$game")?>> <?php echo $product['product_game']?></a> </span></h5>
              </div>              
            </div>            
          </div>
        </div>
      </div>
        <div class="row">
          <div class="col-md-12">
            <h3 class="text-left">Other Products</h3>
            <hr>
          </div>
          <div class="row">
<?php 
foreach($suggested_products as $product_item): 
  $url = url_title($product_item['product_url'],'_');
  $path = "/".$product_item['product_image_path'];
  $image_properties = array(
          'src' => "$path",          
          'class' => 'img-responsive',
);
?>
  <div class="product-link-sm col-md-2">
      <?php echo anchor("/product/$url", img($image_properties));?>      
  </div>

<?php endforeach ?>            
          </div>
        </div>
      </div>
    </div>