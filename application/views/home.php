<div class="container">
	<div>
		<div class="row">
  			<div class="col-md-12 text-center top-bottom-space-s">
  				<h1>Psycho Store</h1>
            	<h4 class="molot"><small>We make stuff for Gamers and Geeks</small></h4> 
  			</div>
		</div>
	</div>
	<div class="row">
	  <div class="col-md-12">
	            <h4 class="molot">Shop&nbsp;<small>By</small> <a class = <?php echo $latest_link_state ?> href="latest">Latest</a><small>&nbsp;/&nbsp;</small><a class = <?php echo $popular_link_state ?> href="popular">Popularity</a></h4> 
	  </div>
	</div>
	<div class="row well">
		<div class="col-md-12">
			<?php $data['products'] = $products; $this->load->view('catalog',$data);?>
		</div>
	</div>
</div>