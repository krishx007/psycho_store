<?php echo form_open('cart/update/'); ?>

<table cellpadding="6" cellspacing="1" style="width:100%" border="0">

<tr>
  <th>QTY</th>
  <th>Item Description</th>
  <th style="text-align:right">Item Price</th>
  <th style="text-align:right">Sub-Total</th>
</tr>

<?php $i = 1; ?>

<?php foreach ($this->cart->contents() as $items): ?>

	<?php echo form_hidden('row_id', $items['rowid']); ?>

	<tr>
	  <td><?php echo 1; echo nbs(1); $var_name = 'max'.$items['rowid']; $max = $$var_name; echo form_input(array('type'=> 'range', 'name' => $i.$items['rowid'], 'value' => $items['qty'], 'min' => '1', 'max' => $max  )); echo nbs(1);echo $max; ?></td>
	  <td>
		<?php echo $items['name']; ?>

			<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

				<p>
					<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

						<strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

					<?php endforeach; ?>
				</p>

			<?php endif; ?>

	  </td>
	  <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
	  <td style="text-align:right"><?php echo $this->cart->format_number($items['subtotal']); ?></td>
	  <td style="text-align:right"><?php echo anchor("cart/remove/{$items['rowid']}", 'Remove') ?></td>
	</tr>

<?php $i++; ?>

<?php endforeach; ?>

<tr>
  <td colspan="2"> </td>
  <td class="right"><strong>Total</strong></td>
  <td class="right">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
</tr>

</table>

<p><?php echo form_submit('', 'Update your Cart'); ?></p>
<p><?php echo anchor('', 'Continue Shopping'); ?></p>
<p><?php 
	if($this->cart->total_items())
		echo anchor('checkout/', 'Checkout'); 
?></p>
