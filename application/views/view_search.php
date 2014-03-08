<div class="container">
  <div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <h2 class=""><?php echo $search_result ?>&nbsp;<small>product(s) found for</small> <?php echo $search_text;?> </h2>
      </div>
    </div>
  </div>
</div>

<?php $data['products'] = $products; $this->load->view('catalog',$data);?>
