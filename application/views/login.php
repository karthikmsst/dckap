<!DOCTYPE html>
<html>
<head>
<title>DCKAP Admin login</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"></link>	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<body>

<form method="post" name="login_form" id="login_form" enctype="multipart/form-data" onsubmit="return validate_form();">
<br><br>
<table cellpadding="3" cellspacing="3" width="70%" class="table table-bordered" align="center" style="width:50% !important;">
<tr><td colspan=2"><h3>Admin Login</h3></td></tr>
<?php if($msg){ ?>
<tr>
    <td align="center" colspan="2" style="color:red;"><?php echo $msg; ?></td>        
</tr>
<?php } ?>
<tr>
    <td>
        Username
    </td>
    <td>
        <input type="text" name="username" id="username" required> &nbsp; admin
    </td>
</tr>
<tr>
    <td>
        Password
    </td>
    <td>
        <input type="password" name="password" id="password" required> &nbsp; admin
    </td>
</tr>
<tr>
    <td align="center" colspan="2">
        <input type="submit" id="submit" name="submit" value="Login" class="btn btn-primary">
    </td>    
</tr>
</table>
</form>
<script>
function validate_form(){
    if($('#username').val() == ''){
        $('#username').focus();
        alert('Enter the username');
        return false;
    }
    else if($('#password').val() == ''){
        $('#password').focus();
        alert('Enter the password');
        return false;
    }
   
    return true;
}
</script></td>


</body>
</html>