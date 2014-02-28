<div class="container">
  <div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <h2 class="text-primary"><?php echo $search_result ?>&nbsp;<small>product(s) found for</small> <?php echo $search_text?></h2>
      </div>
    </div>
  </div>
</div>


<div class="container">
  <div class="well">
    <div class="row">
<?php 
if($search_result)
foreach($products as $product_item): 
	$id = $product_item['product_id'];
	$path = "/".$product_item['product_image_path'];
	$image_properties = array(
          'src' => "$path",          
          'class' => 'img-responsive',
);
?>
	<div class="col-md-4">
    	<?php echo anchor("/product/$id", img($image_properties));?>
    	<div class="row">
	    	<div class="col-md-12">
	    		<h4 class="text-center"> <?php echo anchor("product/$id", $product_item['product_name']) ?> <br>Rs <?php echo $product_item['product_price'] ?></h4>
	    	</div>
    	</div>
    </div>

<?php endforeach ?>


      
    </div>
  </div>
</div>
