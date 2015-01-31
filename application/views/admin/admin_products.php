<div class="container top-bottom-space">  
    <h1> Available Products
    	<span class='pull-right'>
			<a class="btn btn-primary play" href= <?php echo site_url('admin/add_product') ?> >Add New Product</a>			
    	</span>
     </h1>
    <hr>
    <div class="well">
    	<div class="row ">
	    	<div class="col-md-12">
	    		<?php echo $products_table; ?>
			</div>
		</div>
	</div>
</div>
