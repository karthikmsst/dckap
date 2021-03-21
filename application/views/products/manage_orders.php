<table cellpadding="3" cellspacing="3" width="100%">
<tr>
    <td align="left" colspan="3"><h3>Manage Orders</h3></td>
</tr>
<tr>
    <th>S.no</th>
    <th align="left">Customer Name</th>
    <th align="left">Phone No</th>
    <th align="left">Email</th>
    <th align="left">Total ( INR )</th>
    <th>Action</th>
</tr>
<tbody>
    <?php
    if(count($result_customer_orders) > 0){
        $i = 1;
        foreach($result_customer_orders as $key_result_customer_orders => $val_result_customer_orders){
    ?>
    <tr>
        <td align="center"><?php echo $i; ?></td>
        <td align="left"><?php echo $val_result_customer_orders['name']; ?></td>
        <td align="left"><?php echo $val_result_customer_orders['email']; ?></td>
        <td align="left"><?php echo $val_result_customer_orders['phone_no']; ?></td>
        <td align="left">Rs <?php echo $val_result_customer_orders['main_total']; ?></td>
        <td align="center">
            <a href="<?php echo base_url('products/view_orders/'.$val_result_customer_orders['id']); ?>">View</a>
        </td>
    </tr>
    <?php
        $i++;
        }
    } else {
    ?>
    <tr>
        <td align="center" colspan="4" style="color:red;">No record found</td>        
    </tr>
    <?php
    }
    ?>
</tbody>
</table>

<script>
function confirm_delete(id){
    if(id){
        var r = confirm("Are want delete this products?");
        if (r == true) {
            window.location.href = '<?php echo base_url();?>products/delete_products/'+id;
            return true;
        } else {
            return false;
        }
    }
}
</script>