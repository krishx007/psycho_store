<div class="container top-bottom-space">  
    <h1>Orders
    	<span class="pull-right navbar-text"> <small><?php echo $num_shipped_orders?> shipped</small></span>
    </h1>
    <hr>
    <div class="well">
        <div class="row">
            <div class="col-md-12">
                <a class="navbar-btn btn btn-primary" href= <?php echo site_url('admin/shipments') ?> >Pending Shipments</a>
                <h3 class="play text-danger navbar-text pull-right"><?php echo $num_orders?> pending shipment(s)</h3>
            </div>
        </div>
    </div>
    <hr>
    <div class="well">        
    	<div class="row ">
	    	<div class="col-md-12">
	    		<?php echo $orders_table; ?>
			</div>
		</div>
	</div>
</div>
