<table border="1" cellpadding="5px" cellspacing="0">
<tr>
    <td align="left">
        <img width='50px' src="<?php echo $company_logo ?>">
    </td>
    <td align='center' >
        <img width='100px' src="<?php echo $courier_logo ?>">
    </td>
</tr>
<tr>
    <td >
        <img width='200px' src="<?php echo $wb_barcode ?>">
    </td>
    <td align="right">
        <p><?php echo $pin ?></p>
        <h4><?php echo $coc_code ?></h4>
    </td>
</tr>
<tr>
    <td>
        <p>Shipping address: <?php echo $address ?></p>
        <p><?php echo $city."<br>".$dispatch_center."<br>".$pin ?></p>
    </td>
    <td align="center">
        <h1><?php echo $payment_mode ?></h1>
    </td>
</tr>
<tr>
    <td align="center" colspan="2" cellpadding="0px">
        <?php echo $prod_desc_table ?>
    </td>
</tr>
<tr>
    <td colspan="2" border="0">
        <img  src="<?php echo $oid_barcode ?>">
    </td>
</tr>
<tr>
    <td colspan="2" border="0">
        <small><small> Return address: <?php echo $return_address ?></small></small>
    </td>
</tr>
</table>
