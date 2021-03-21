<?php $CI =& get_instance(); ?>
<div class="col-md-12"><h2>Checkout</h2></div>
<div>
    <!-- <div class="heading"><p>Shopping Cart</p></div> -->
    <div class="cart_item">
        <table cellpadding="3" cellspacing="3" width="100%" class="table">
            <thead>
                <tr style="border-bottom: 1px solid;">
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sub Total ( INR )</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(count($cart_data) > 0){
                    foreach($cart_data as $key_cart_data => $val_cart_data){
                ?>
                <tr>
                    <td align="left"><?php echo $val_cart_data['name']; ?></td>
                    <td align="left"><?php echo number_format($val_cart_data['price']); ?></td>
                    <td align="left"><input type="text" name="quantity" id="quantity" class="update_quantity" data-pro_id="<?php echo $key_cart_data; ?>" value="<?php echo $val_cart_data['qty']; ?>"></td>
                    <td align="left">Rs <?php echo number_format($val_cart_data['subtotal']); ?></td>
                    <td align="left"><button type="button" id="<?php echo $key_cart_data; ?>" class="remove_cart btn btn-danger btn-sm">Delete</button></td>
                </tr>
                <?php
                    }
                ?>
                <tr>
                    <td colspan="2">&nbsp;</td>
                    <td align="left"><strong>Total ( INR ) :</strong></td>
                    <td align="left">Rs <?php echo $CI->cart->format_number($CI->cart->total()); ?></td>
                    <td>&nbsp;</td>
                </tr>
                
                <tr>                    
                    <td colspan="5">
                        <div id="btn_proceed_checkout" class="float-right"><button id="checkout" class="btn btn-primary">Proceed Checkout</button>
                        <div style="clear:both;height:15px; ">&nbsp;</div>                        
                    </td>
                </tr>
                <?php
                } else {
                ?>
                <tr><td colspan="5">No card data available </td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>    
</div>
<?php if($this->session->userdata('page') == 2){ ?>
<script>
$(document).ready(function(){
    $('#btn_proceed_checkout').hide();
});
</script>
<?php } ?>