<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-toggle='modal' >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> <?php echo $modal_title ?> </h4>
      </div>
      <div class="modal-body">
        <p> <?php echo $modal_body ?> </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	window.onload= function()
	{
		<?php if($show_modal): ?>
			$('[data-toggle="modal"]').modal('show');
		<?php endif; ?>
	}
</script>
