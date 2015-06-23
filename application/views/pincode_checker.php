<form class="form-inline" method = "post" action = <?php echo site_url("product/$product_id")?> >
  <div class="form-group">
      <input type="text" name="pincode" class="form-control input-sm" placeholder="pincode">
   </div>
   <button class="btn btn-default btn-sm" type="submit">Check Pincode</button>
</form>
<p><?php echo $pincode_text ?></p>