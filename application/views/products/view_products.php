<?php $CI =& get_instance(); ?>
<table cellpadding="3" cellspacing="3" width="100%">
<tr>
    <td align="left"><h3>View Products</h3></td>
    <td align="right"><a href="<?php echo base_url();?>products/manage_products">Back</a></td>
</tr>

<tr>
    <td width="30%">
        <strong>Category Name</strong>
    </td>
    <td>
        <?php echo $result_products[0]['category_name']; ?>
    </td>
</tr>
<tr>
    <td>
        <strong>Product Name</strong>
    </td>
    <td>
        <?php echo $result_products[0]['product_name']; ?>
    </td>
</tr>
<tr>
    <td>
        <strong>Product Price</strong>
    </td>
    <td>
        <?php echo $result_products[0]['price']; ?>
    </td>
</tr>
<tr>
    <td valign="top">
        <strong>Short Description</strong>
    </td>
    <td valign="top">
        <?php echo $result_products[0]['short_description']; ?>
    </td>
</tr>
<tr>
    <td valign="top">
        <strong>Description</strong>
    </td>
    <td valign="top">
        <?php echo $result_products[0]['description']; ?>
    </td>
</tr>
<tr>
    <td valign="top">
        <strong>Product Images</strong>
    </td>
    <td valign="top" >
        <table cellpadding="3" cellspacing="3" width="100%">
        <tr>
        <?php
        $condition 					= array();
        $condition['products_id'] 	= $result_products[0]['id'];
        $condition['status']		= '1';
        $result_product_images		= $CI->products_model->get_product_images($condition);
        if(count($result_product_images) > 0){
            $i = 1;
            foreach($result_product_images as $key_result_product_images => $val_result_product_images){
        ?>
        <td align="left">
            <img src="<?php echo base_url(); ?><?php echo $val_result_product_images['image_path'].''.$val_result_product_images['image_name']; ?>" width="150">
        </td>
        <?php
        if(($i % 3) == 0){
            echo '</tr><tr>';
        }
        ?>
        <?php
            $i++;
            }
        }
        ?>
        </tr>
        </table>
    </td>
</tr>
</table>