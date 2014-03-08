<div class="container">
  <div class="well">
    <div class="row">
<?php 
foreach($products as $product_item): 
	$id = $product_item['product_id'];
	$path = "/".$product_item['product_image_path'];
	$image_properties = array(
          'src' => "$path",          
          'class' => 'img-responsive',
);
?>
	<div class="col-md-4">
    <div class="product-link">
      <a href = <?php "/product/$id" ?> >
    	<?php echo anchor("/product/$id", img($image_properties));?>
    	<div class="row">
	    	<div class="col-md-12">
	    		<h4 class="text-center"> <?php echo $product_item['product_name'] ?> <br>Rs <?php echo $product_item['product_price'] ?></h4>
	    	</div>
    	</div>
    </a>
    </div>
</div>
<?php endforeach ?>
    </div>
  </div>
</div>