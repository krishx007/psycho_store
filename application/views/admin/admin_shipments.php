<div class="container top-bottom-space">  
    <h1> processing Shipments
    	<span class="pull-right navbar-text play"> <small><?php echo $num_pkg_shipments?> shipment(s) pending for pickup on <?php echo $date ?></small></span>
    </h1>
    <hr>
    <div class="well">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary navbar-btn" <?php echo $pickup_btn_state?> href= <?php echo site_url('admin/request_pickup') ?> >Request Pickup (<?php echo $num_pkg_shipments?>)</a>
                <?php if($pickup_requested): ?>
                <h3 class="navbar-text text-primary pull-right play"> Pickup Requested for <?php echo $num_pcikup_shipments ?> shipments. Make sure they are ready.</h3>
                <?php else: ?>
                <h3 class="navbar-text text-danger pull-right play"> No Pickup has been requested. </h3>
                <?php endif; ?>
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
