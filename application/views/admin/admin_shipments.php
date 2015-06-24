<div class="container top-bottom-space">  
    <h1> processing Shipments
    	<span class="pull-right navbar-text"> <small><?php echo $num_shipments?> shipment(s) for <?php echo $date ?></small></span>
    </h1>
    <hr>
    <div class="well">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary" href= <?php echo site_url('admin/request_pickup') ?> >Request Pickup</a>
                <a class="pull-right btn btn-danger" href="">Shipped</a>
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
