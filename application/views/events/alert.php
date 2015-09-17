<script type="text/javascript">
  window.onload= function()
  {
    setTimeout(show_alert, '<?php echo $timeout; ?>');
  }

  function show_alert()
  {
	var div = document.getElementById('alert');
    if(div)
    {
    	// div.innerHTML= ' class="alert alert-warning alert-dismissible fade in" role="alert"
		   //    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
		   //    Alert';
		div.setAttribute('class', 'alert alert-warning alert-dismissible fade in');		
		div.setAttribute('role', 'alert');
		var btn = document.createElement("BUTTON");		
		btn.setAttribute('type', 'button');
		btn.setAttribute('class', 'close');
		btn.setAttribute('data-dismiss', 'alert');
		btn.setAttribute('aria-label', 'Close');
		var span = document.createElement("SPAN");
		span.setAttribute('aria-hidden', 'true');
		span.innerHTML = "x";
		btn.appendChild(span);
		div.appendChild(btn);
		div.innerHTML += '<?php echo $alert_text?>';
    }
  }
</script>