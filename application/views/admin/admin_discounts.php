<div class="container top-bottom-space">  
    <h1> They get special discount
    	<span class="pull-right navbar-text"> <small><?php echo $num_domains?> domain(s) / <?php echo $num_coupons?> coupons(s)</small></span>
    </h1>
    <hr>
    <div class="well">
        <div class="row ">
            <div class="col-md-12">
                <form class='form-inline' method="post" action= <?php echo site_url('admin/add_discount') ?> >
                    <div class="form-group">
                        <input type='text' name="discount_name" class="form-control" placeholder="Domain name">
                        <input type='number' name="discount_percentage" class="form-control" placeholder="Discount %">
                        <input type='hidden' name="discount_type" value="domain"> 
                        <button type="submit" class="btn btn-primary">Add Domain</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="well">
        <div class="row">
            <div class="col-md-12">
                <form class='form-inline' method="post" action= <?php echo site_url('admin/add_discount') ?> >
                    <div class="form-group">
                        <input type='text' name="discount_name" class="form-control" placeholder="Coupon name">
                        <input type='number' name="discount_percentage" class="form-control" placeholder="Discount %">
                        <input type='date' name="expiry_date" class="form-control">
                        <input type='hidden' name="discount_type" value="coupon">
                        <button type="submit" class="btn btn-primary">Add Coupon</button>
                        <p>No spaces in the coupon name</p>
                    </div>
                </form>
            </div>            
        </div>
    </div>
    <hr>
    <div class="well">
    	<div class="row ">
	    	<div class="col-md-12">
	    		<?php echo $discount_table; ?>
			</div>
		</div>
	</div>
</div>
