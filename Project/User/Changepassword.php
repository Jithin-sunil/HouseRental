<?php
include("../Assets/Connection/Connection.php");
session_start();
$selQry="select * from tbl_user where user_id='".$_SESSION['uid']."'";
$row=$Con->query($selQry);
$data=$row->fetch_assoc();
if(isset($_POST['btn_submit']))
{
	$oldpassword=$_POST['txt_oldpassword'];
	$newpassword=$_POST['txt_newpassword'];
	$retypepassword=$_POST['txt_retypepassword'];
	if($data['user_password']==$oldpassword)
	{
		if($newpassword==$retypepassword)
		{
			$upQry="update tbl_user set user_password='".$newpassword."' where user_id='".$_SESSION['uid']."'";
			if($Con->query($upQry))
			{
				?>
            	<script>
				alert("password changed");
				window.location="Myprofile.php";
				</script>
				<?php
			}
			else
			{
				?>
            	<script>
				alert("invalid password");
				window.location="Changepassword.php";
				</script>
				<?php
			}
		}
		else
		{
			?>
            	<script>
				alert("password is not matching");
				window.location="Changepassword.php";
				</script>
				<?php
		}
	}
	else
	{
		?>
            	<script>
				alert("wrong password ");
				window.location="Changepassword.php";
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
  <table width="200" border="1">
    <tr>
      <td width="122">Old Password</td>
      <td width="62"><label for="txt_oldpassword"></label>
      <input type="text" name="txt_oldpassword" id="txt_oldpassword" /></td>
    </tr>
    <tr>
      <td>New Password</td>
      <td><label for="txt_newpassword"></label>
      <input type="text" name="txt_newpassword" id="txt_newpassword" /></td>
    </tr>
    <tr>
      <td>Re-Type Password</td>
      <td><label for="txt_retypepassword"></label>
      <input type="text" name="txt_retypepassword" id="txt_retypepassword" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Change Password" />
        <input type="submit" name="btn_cancel" id="btn_cancel" value="cancel" />
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>