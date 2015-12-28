<table>
	<th>ID</th>
	<th>Address</th>	
	<th>Mode</th>
	<th>Amount</th>
	<th>Date</th>
	<th>Waybill</th>
	<?php foreach ($requested_shipments as $key => $shipment): ?>
	<tr>
		<td>
			<?php echo $shipment['txn_id'] ?>
		</td>
		<td>
			<?php echo format_address($shipment['address']) ?>
		</td>
		<td>
			<?php echo $shipment['payment_mode'] ?>
		</td>
		<td>
			<?php echo $shipment['order_amount'] ?>
		</td>
		<td>
			<?php echo $shipment['date_created'] ?>
		</td>
		<td>
			<?php echo $shipment['waybill'] ?>
		</td>		
	</tr>
	<?php endforeach; ?>
</table>