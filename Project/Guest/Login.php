<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST['btn_submit']))
{
	$email=$_POST['txt_email'];
	$password=$_POST['txt_password'];
	
	$selQry="select * from tbl_admin where admin_email='".$email."' and admin_password='".$password."'";
	$row=$Con->query($selQry);
	
	
	$seleQry="select * from tbl_user where user_email='".$email."' and user_password='".$password."'";
	$col=$Con->query($seleQry);
	
	$selecQry="select * from tbl_owner where owner_email='".$email."' and owner_password='".$password."'";
	$rows=$Con->query($selecQry);
	
	if($data=$row->fetch_assoc())
	{
		$_SESSION['aid']=$data['admin_id'];
		$_SESSION['aname']=$data['admin_name'];
		header("location:../Admin/Homepage.php");
	}
	else if($userdata=$col->fetch_assoc())
	{
		$_SESSION['uid']=$userdata['user_id'];
		$_SESSION['uname']=$userdata['user_name'];
		header("location:../User/Homepage.php");
	}
	else if($ownerdata=$rows->fetch_assoc())
	{
		$_SESSION['oid']=$ownerdata['owner_id'];
		$_SESSION['oname']=$ownerdata['owner_name'];
		header("location:../Owner/Homepage.php");
	}
	else
	{
		?>
		<script>
		alert("Invalid Data");
		window.location="Login.php";
		</script>
		<?php
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1" align="center">
    <tr>
      <td width="69">Email</td>
      <td width="115"><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="text" name="txt_password" id="txt_password" /></td>
    </tr>
    <tr>
      <td height="28" colspan="2" align="center">
            <input type="submit" name="btn_submit" id="btn_submit" value="Login" />
    </td>
    </tr>
  </table>
</form>
</body>
</html>