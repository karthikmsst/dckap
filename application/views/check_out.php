<?php $CI =& get_instance(); ?>

<div class="col-md-5">
	<h2>Checkout Form</h2>
	<div>		
        <form method="post" name="checkout_form" id="checkout_form" enctype="multipart/form-data" onsubmit="return validate_form();">
        <table cellpadding="3" cellspacing="3" width="100%" class="table table-bordered">       
        <tr>
            <td>
                Name
            </td>
            <td>
                <input type="text" name="name" id="name" required>
            </td>
        </tr>
        <tr>
            <td>
                Email
            </td>
            <td>
                <input type="email" name="email" id="email" required>
            </td>
        </tr>
        <tr>
            <td>
                Phone No
            </td>
            <td>
                <input type="text" name="phone_no" id="phone_no" required>
            </td>
        </tr>
        <tr>
            <td>
                Address
            </td>
            <td>
                <textarea name="address" id="address" style="margin: 0px; width: 100%;" required></textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
                &nbsp;
            </td>
            <td align="right">
                <button type="button" class="btn btn-secondary" onclick="location.href='<?php echo base_url();?>welcome/index'">Cancel</button>
                <input type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary">
            </td>
        </tr>
        </table>
        </form>
    </div>
</div>
<div class="col-md-7">
    <div class="shopping-cart"></div>
</div>

<script>
function validate_form(){
    if($('#name').val() == ''){
        $('#name').focus();
        alert('Enter the name');
        return false;
    }
    else if($('#email').val() == ''){
        $('#email').focus();
        alert('Enter the email');
        return false;
    }
    else if($('#phone_no').val() == ''){
        $('#phone_no').focus();
        alert('Enter the phone no');
        return false;
    }
    else if($('#address').val() == ''){
        $('#address').focus();
        alert('Enter the address');
        return false;
    }
   
   return true;
}
</script>

<script>
$(document).ready(function(){	
	<?php if($cart_count > 0){ ?>
	$('.shopping-cart').load("<?php echo site_url('welcome/load_cart');?>");
	<?php } ?>
	
	$(document).on('click','.remove_cart',function(){
		var row_id = $(this).attr("id"); 
		$.ajax({
			url : "<?php echo site_url('welcome/delete_cart');?>",
			method : "POST",
			data : {row_id : row_id},
			success :function(data){
				$('.shopping-cart').html(data);
			}
		});
	});
	
	
	$(document).on('blur','.update_quantity',function(){
		var row_id		= $(this).data('pro_id');		
		var qty			= $(this).val(); 
		
		$.ajax({
			url : "<?php echo site_url('welcome/update_cart');?>",
			method : "POST",
			data : {row_id : row_id, qty:qty},
			success :function(data){
				$('.shopping-cart').html(data);
			}
		});
	});   
	
});
</script>