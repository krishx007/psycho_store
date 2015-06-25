<div class="container top-bottom-space">  
    <h1> Process Orders 
    	<span class="pull-right navbar-text"> <small><?php echo $num_orders?> order(s) </small></span>
    </h1>
    <hr>
    <div class="well">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary" href= <?php echo site_url('admin/shipments') ?> >Process Shipments</a>
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
