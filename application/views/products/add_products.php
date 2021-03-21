<form method="post" name="products_form" id="products_form" enctype="multipart/form-data" onsubmit="return validate_form();">
<table cellpadding="3" cellspacing="3" width="100%">
<tr><td align="left"><h3>Add Products</h3></td></tr>
<?php if($msg){ ?>
<tr>
    <td align="center" colspan="2" style="color:red;"><?php echo $msg; ?></td>        
</tr>
<?php } ?>
<tr>
    <td>
        Category Name
    </td>
    <td>
        <select name="category_id" id="category_id" required>
        <option value="">Select</option>
        <?php
        if(count($result_categories) > 0){
            foreach($result_categories as $key_result_categories => $val_result_categories){
        ?>
        <option value="<?php echo $val_result_categories['id']; ?>"><?php echo $val_result_categories['name']; ?></option>
        <?php
            }
        }
        ?>
        </select>
    </td>
</tr>
<tr>
    <td>
        Product Name
    </td>
    <td>
        <input type="text" name="product_name" id="product_name" required>
    </td>
</tr>
<tr>
    <td>
        Product Price
    </td>
    <td>
        <input type="text" name="product_price" id="product_price" required>
    </td>
</tr>
<tr>
    <td valign="top">
        Short Description
    </td>
    <td valign="top">
        <textarea name="short_description" id="short_description" style="margin: 0px; width: 100%;" required></textarea>
    </td>
</tr>
<tr>
    <td valign="top">
        Description
    </td>
    <td valign="top">
        <textarea name="description" id="description" style="margin: 0px; width: 100%;"></textarea>
    </td>
</tr>
<tr>
    <td valign="top">
        Images
    </td>
    <td valign="top">
        <input type="file" id="multiFiles" name="files[]" multiple="multiple"/>
    </td>
</tr>
<tr>
    <td align="right">
        <input type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary">
    </td>
    <td align="left">
        <button type="button" class="btn btn-secondary" onclick="location.href='<?php echo base_url();?>products/manage_products'">Cancel</button>
    </td>
</tr>
</table>
</form>
<script>
function validate_form(){
    if($('#category_id').val() == ''){
        $('#category_id').focus();
        alert('Select the category');
        return false;
    }
    else if($('#product_name').val() == ''){
        $('#product_name').focus();
        alert('Enter the product name');
        return false;
    }
    else if($('#product_price').val() == ''){
        $('#product_price').focus();
        alert('Enter the product price');
        return false;
    }
    else if($('#short_description').val() == ''){
        $('#short_description').focus();
        alert('Enter the short description');
        return false;
    }
   
   return true;
}
</script>