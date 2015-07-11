<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-toggle='modal'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Grettings Creature</h4>
      </div>
      <div class="modal-body">
        <p><?php echo $domain ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>

<!DOCTYPE html>
<html>
<head>
	<?php echo $header?>
	<?php if($show_discount_popup): ?>		
			<script type="text/javascript">
				$(function () {
				  $('[data-toggle="modal"]').modal('show');
				})
			</script>		
	<?php endif; ?>
</head>
<body>
	<?php echo $body?>
	<?php echo $footer?>
</body>

</html>