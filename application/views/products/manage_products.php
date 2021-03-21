<table cellpadding="3" cellspacing="3" width="100%">
<tr>
    <td align="left" colspan="3"><h3>Manage Products</h3></td>
    <td align="right"><a href="<?php echo base_url('products/add_products'); ?>">Add Products</a></td>
</tr>
<tr>
    <th>S.no</th>    
    <th align="left">Product Name</th>
    <th align="left">Category Name</th>
    <th>Action</th>
</tr>
<tbody>
    <?php
    if(count($result_products) > 0){
        $i = 1;
        foreach($result_products as $key_result_products => $val_result_products){
    ?>
    <tr>
        <td align="center"><?php echo $i; ?></td>        
        <td align="left"><?php echo $val_result_products['product_name']; ?></td>
        <td align="left"><?php echo $val_result_products['category_name']; ?></td>
        <td align="center">
            <!-- <a href="<?php //echo base_url('categories/edit_categories'); ?>">Edit</a> -->
            <a href="javascript:void(0);"><?php if($val_result_products['status'] == '1'){ ?> Active <?php } else { ?> Deactive <?php } ?></a>
            &nbsp;&nbsp;
            <a href="<?php echo base_url('products/view_products/'.$val_result_products['id']); ?>">View</a>
            &nbsp;&nbsp;
            <a href="javascript:void(0);" onclick="confirm_delete('<?php echo $val_result_products['id']; ?>');">Delete</a>
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