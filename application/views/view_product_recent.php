<div class="row">
  <div class="col-md-12">
    <h3 class="text-left">Recently Viewed</h3>
    <hr>
  </div>

<?php
if(is_array($recently_viewed) > 0):

  foreach($recently_viewed as $key => $product_item): 
  $url = product_url($product_item);
  $path = "/".$product_item['product_image_path'];
  $image_properties = array(
                            'src' => "$path",          
                            'class' => 'img-responsive',
                            );
?>
  <div class="product-link-sm col-md-2 col-sm-4 col-xs-4">
      <?php echo anchor($url, img($image_properties));?>      
  </div>
  <?php endforeach ?>
  <?php endif ?>
  </div>