<div class="row">
  <?php 
  foreach($products as $product_item): 
  	$id = $product_item['product_id'];
    $url = url_title($product_item['product_url'],'_');
  	$path = "/".$product_item['product_image_path'];
  	$image_properties = array(
            'src' => "$path",          
            'class' => 'img-responsive',
  );
  ?>
  	<div class="col-md-4">
      <div class="product-link">      
      	<?php echo anchor("/product/$url", img($image_properties));?>
      	<div class="row">
  	    	<div class="col-md-12 catalog-desc">
  	    		<p class="text-center"> <?php echo $product_item['product_name'] ?> 
             <h4 class="text-center"> <i class="fa fa-rupee"></i> <?php echo $product_item['product_price'] ?></h4></p>
  	    	</div>
      	</div>    
      </div>
  </div>
  <?php endforeach ?>
</div>