<div class="container top-bottom-space">  
    <h1>Checkouts
    	<span class="pull-right navbar-text"> <small><?php echo $num_checkouts?> checkouts</small> / <small><i class="fa fa-rupee"></i> <?php echo 
        $checkout_amount ?></small></span>
    </h1>
    <hr>
    <div class="well">
    	<div class="row ">
	    	<div class="col-md-12">
	    		<?php echo $checkout_table; ?>
			</div>
		</div>
	</div>
</div>
