<div class="container top-bottom-space">  
    <h1> They get special discount
    	<span class="pull-right navbar-text"> <small><?php echo $num_domains?> domain(s) </small></span>
    </h1>
    <hr>
    <div class="well">
        <div class="row ">
            <div class="col-md-12">
                <form class='form-inline' method="post" action= <?php echo site_url('admin/add_discount_domains') ?> >
                    <div class="form-group">
                        <input type='text' name="domain" class="form-control" placeholder="Domain name">
                        <input type='number' name="discount_percentage" class="form-control" placeholder="Discount %">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="well">
    	<div class="row ">
	    	<div class="col-md-12">
	    		<?php echo $discount_domains_table; ?>
			</div>
		</div>
	</div>
</div>
