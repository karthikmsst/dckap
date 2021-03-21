<table cellpadding="3" cellspacing="3" width="100%">
<tr>
    <td align="left" colspan="2"><h3>Manage Categories</h3></td>
    <td align="right"><a href="<?php echo base_url('categories/add_categories'); ?>">Add Categories</a></td>
</tr>
<tr>
    <th>S.no</th>
    <th align="left">Categories</th>
    <th>Action</th>
</tr>
<tbody>
    <?php
    if(count($result_categories) > 0){
        $i = 1;
        foreach($result_categories as $key_result_categories => $val_result_categories){
    ?>
    <tr>
        <td align="center"><?php echo $i; ?></td>
        <td align="left"><?php echo $val_result_categories['name']; ?></td>
        <td align="center">
            <!-- <a href="<?php //echo base_url('categories/edit_categories'); ?>">Edit</a> -->
            <a href="javascript:void(0);" onclick="confirm_delete('<?php echo $val_result_categories['id']; ?>');">Delete</a>
        </td>
    </tr>
    <?php
        $i++;
        }
    } else {
    ?>
    <tr>
        <td align="center" colspan="3" style="color:red;">No record found</td>        
    </tr>
    <?php
    }
    ?>
</tbody>
</table>

<script>
function confirm_delete(id){
    if(id){
        var r = confirm("Are want delete this categories?");
        if (r == true) {
            window.location.href = '<?php echo base_url();?>categories/delete_categories/'+id;
            return true;
        } else {
            return false;
        }
    }
}
</script>