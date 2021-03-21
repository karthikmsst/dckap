<!DOCTYPE html>
<html>
<head>
<title>DCKAP Admin Side</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"></link>	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<body>

<table cellpadding="3" cellspacing="3" width="100%" class="table table-bordered">
<tr><td colspan=2"><h1>DCKAP Header</h1></td></tr>
<tr>
    <td width="25%" valign="top" align="left">
        <table cellpadding="3" cellspacing="3" width="100%" class="table">
            <tr>
                <td>
                    <a href="<?php echo base_url('categories/manage_categories'); ?>">Manage Categories</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="<?php echo base_url('products/manage_products'); ?>">Manage Products</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="<?php echo base_url('products/manage_orders'); ?>">Manage Orders</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="<?php echo base_url('admin/logout'); ?>">Logout</a>
                </td>
            </tr>
        </table>
    </td>
    <td width="75%" valign="top" align="left">