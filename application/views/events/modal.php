<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="molot modal-title text-center" id="modal_title">  </h4>
      </div>
      <div class="modal-body">
        <p id="modal_body">  </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default text-center" data-dismiss="modal"><?php echo $button_text?></button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  window.onload= function()
  {
    var title = document.getElementById('modal_title');
    title.innerHTML= '<?php echo $modal_title ?>';
    
    var body =  document.getElementById('modal_body');
    body.innerHTML= '<?php echo $modal_body ?>';
    
    setTimeout(function(){ $('#modal').modal('show'); }, <?php echo $timeout; ?>);
  }
</script>
