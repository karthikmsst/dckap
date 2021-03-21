<form method="post" name="category_form" id="category_form" enctype="multipart/form-data" onsubmit="return validate_form();">
<table cellpadding="3" cellspacing="3" width="100%">
<tr><td align="left" colspan="2"><h3>Add Categories</h3></td></tr>
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
        <input type="text" name="category_name" id="category_name" required>
    </td>
</tr>
<tr>
    <td align="right">
        <input type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary">
    </td>
    <td align="left">
        <button type="button" onclick="location.href='<?php echo base_url();?>categories/manage_categories'" class="btn btn-secondary">Cancel</button>
    </td>
</tr>
</table>
</form>
<script>
function validate_form(){
   if($('#category_name').val() == ''){
        $('#category_name').focus();
        alert('Enter the category name');
        return false;
   }
   
   return true;
}
</script>