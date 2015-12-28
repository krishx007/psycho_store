<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<div class="container">	
	<div class="row">
		<div class="col-md-12 text-center top-bottom-space-s">
		<img src=<?php echo site_url("images/logo.png") ?>>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<h4 class="molot" >Shop&nbsp;<small>By</small> <a class = <?php echo $latest_link_state ?> href="latest">Latest</a><small>&nbsp;/&nbsp;</small><a class = <?php echo $popular_link_state ?> href="popular">Popularity</a>
		</div>
		<div class="col-md-6">
		<h4>
			<span class="pull-right">
				<a class="molot" data-toggle="tooltip" title="win free stuff" data-placement="top" href= <?php echo site_url('giveaways')?> > Giveaways </a> 
	            	<small>/</small>
	            	<a class="molot" data-toggle="tooltip" title="see what people are saying" data-placement="top" href= <?php echo site_url('feedback')?> > Feedback </a>
	            	<small>/</small>
	            	<a class="molot" data-toggle="tooltip" title="gaming in india" data-placement="right" href= <?php echo site_url('insights')?> > Statistics </a>
            </span>
        </h4>
		</div>
	</div>
	<div class="row well">
		<div class="col-md-12">
			<?php $data['products'] = $products; $this->load->view('catalog',$data);?>
		</div>
	</div>
	<div class="row top-bottom-space">
		<div class="col-md-12">
		<h2 class="molot">Any Comments?</h2>
		<h5>We would love to hear what you think about us or drop us some <a href= <?php echo site_url('auth/saysomething')?> >feedback</a>.</h5>
		<hr>
			<?php $this->load->view('disqus_script')?>
		</div>
	</div>	
</div>