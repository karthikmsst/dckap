<?php $CI =& get_instance(); ?>
<?php if($this->session->flashdata('order_msg')){ ?>
<div class="col-md-12" style="color:green;" align="center"><strong><?php echo $this->session->flashdata('order_msg'); ?></strong></div>
<?php } ?>

<div class="col-md-12"><div class="shopping-cart"></div></div>
<div class="col-md-12"><h2>List Products</h2></div>
<?php if(count($result_products) > 0){ ?>
	<?php foreach($result_products as $val_result_products){ ?>
	<div class="col-md-4">
		<div class="card mb-4 box-shadow">
			<?php
			$condition 					= array();
			$condition['products_id'] 	= $val_result_products['id'];
			$condition['status']		= '1';
			$result_product_images		= $CI->products_model->get_product_images($condition);
			if(count($result_product_images) > 0){
				foreach($result_product_images as $key_result_product_images => $val_result_product_images){
					if($key_result_product_images == 0){
			?>
			<img class="card-img-top" style="height: 225px; width: 100%;" src="<?php echo base_url(); ?><?php echo $val_result_product_images['image_path'].''.$val_result_product_images['image_name']; ?>" data-holder-rendered="true">
			<?php
					} else {
			?>
			<img class="card-img-top" style="height: 50px; width: 50px; position: absolute; top: 176px; right: 14px; border-radius: 5px; border: 1px solid #c3c3c3; padding: 4px;" src="<?php echo base_url(); ?><?php echo $val_result_product_images['image_path'].''.$val_result_product_images['image_name']; ?>" data-holder-rendered="true">
			<?php
					}
				}
			}
			?>
			<div class="card-body">
				<h5 class="card-title"><?php echo $val_result_products['product_name']; ?></h5>
				<h6 class="card-title"><?php echo $val_result_products['category_name']; ?></h6>
				<p class="card-text"><strong>Price : </strong>Rs <?php echo $val_result_products['price']; ?></p>
				<p class="card-text"><?php echo $val_result_products['short_description']; ?></p>
				<p class="card-text"><?php echo $val_result_products['description']; ?></p>
				<div class="d-flex justify-content-between align-items-center">
					<div class="btn-group">
						<button class="add_cart btn btn-primary float-right" data-pro_id="<?php echo $val_result_products['id']; ?>">Add to Cart</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
<?php } else { ?>
<div class="col-md-12" style="color:red;">No products available</div>
<?php } ?>

<script>
$(document).ready(function(){
	$('.add_cart').on('click', function(){
		var pro_id		= $(this).data('pro_id');		
		var quantity	= 1;
		$.ajax({
			url: "<?php echo base_url('welcome/add_to_cart'); ?>",
			method: "POST",
			data: {product_id: pro_id, quantity: quantity},
			success: function(data){
				$('.shopping-cart').show();
				$('.shopping-cart').html(data);
			}
		});
	});
	
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
	
	$(document).on('click', '#checkout', function(){
		window.location.href='<?php echo base_url('welcome/checkout'); ?>';
	});
});
</script>
