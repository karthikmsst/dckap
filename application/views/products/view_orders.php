<?php $CI =& get_instance(); ?>
<table cellpadding="3" cellspacing="3" width="100%" border="1">
<tr>
    <td align="left" >
        <h3>View Orders</h3>
    </td>
    <td align="center"><a href="<?php echo base_url('products/manage_orders'); ?>">Back</a></td>
</tr>
<tr>
    <td valign="top" valign="top" align="left" width="80%">
        <table cellpadding="3" cellspacing="3" width="100%">
        <tr>
            <td align="left" width="20%"><strong>Name</strong></td>
            <td align="left" width="80%"><?php echo $result_customer_orders[0]['name']; ?></td> 
        </tr>
        <tr>
            <td align="left"><strong>Email</strong></td>
            <td align="left"><?php echo $result_customer_orders[0]['email']; ?></td> 
        </tr>
        <tr>
            <td align="left"><strong>Phone No</strong></td>
            <td align="left"><?php echo $result_customer_orders[0]['phone_no']; ?></td> 
        </tr>
        <tr>
            <td align="left" valign="top"><strong>Address</strong></td>
            <td align="left"><?php echo $result_customer_orders[0]['address']; ?></td> 
        </tr>
        </table>
    </td>
    <td valign="top" valign="top" align="left" width="20%">
        <table cellpadding="3" cellspacing="3" width="100%">
        <tr>
            <td align="left"><strong>Date</strong></td>
            <td align="left"><?php echo date('d-m-Y', strtotime($result_customer_orders[0]['created_date'])); ?></td> 
        </tr>
        </table>
    </td>
</tr>
<tr>
    <td valign="top" colspan="2">
        <table cellpadding="3" cellspacing="3" width="100%">
        <tr>
            <td align="center" width="5%"><strong>S.no</strong></th>
            <td align="left" width="25%"><strong>Item Name</strong></td>
            <td align="left" width="20%"><strong>Item Qty</strong></td>
            <td align="left" width="20%"><strong>Item Price</strong></td>
            <td align="left" width="20%"><strong>Total ( INR )</strong></td>
        </tr>
        <?php
        $condition 					        = array();
        $condition['customer_orders_id'] 	= $result_customer_orders[0]['id'];
        $condition['status']		        = '1';
        $result_customer_order_items		= $CI->customer_orders_model->get_customer_order_items($condition);
        if(count($result_customer_order_items) > 0){
            $i = 1;
            foreach($result_customer_order_items as $key_result_customer_order_items => $val_result_customer_order_items){
        ?>
        <tr>
            <td align="center"><?php echo $i; ?></th>
            <td align="left">
                <img src="<?php echo base_url().'assets/products/'.$val_result_customer_order_items['item_img']; ?>" width="25%">
                <?php echo $val_result_customer_order_items['item_name']; ?>
            </td>
            <td align="left"><?php echo $val_result_customer_order_items['item_qty']; ?></td>
            <td align="left"><?php echo $val_result_customer_order_items['item_price']; ?></td>
            <td align="left"><?php echo $val_result_customer_order_items['item_total']; ?></td>
        </tr>
        <?php
            $i++;
            }
        ?>
        <tr>
            <td colspan="3">&nbsp;</td>
            <td align="left"><strong>Total ( INR ) :</strong></td>
            <td align="left"><?php echo number_format($result_customer_orders[0]['main_total']); ?></td>
            <td>&nbsp;</td>
        </tr>                
        <?php
        }
        ?>
        </table>
    </td>
</tr>
</table>