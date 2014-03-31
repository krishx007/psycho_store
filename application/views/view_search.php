<div class="container">  
    <div class="row">
      <div class="col-md-12">
        <h2 class=""><?php echo $search_result ?>&nbsp;<small>product(s) found for</small> <?php echo $search_text;?> </h2>
      </div>
    </div>  
    <div class="row well">
    	<div class="col-md-12">
    		<?php $data['products'] = $products; $this->load->view('catalog',$data);?>
		</div>
	</div>
</div>


