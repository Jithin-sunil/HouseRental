<?php
include("../Assets/Connection/Connection.php");
session_start();
$selQry="select * from tbl_user where user_id='".$_SESSION['uid']."'";
$row=$Con->query($selQry);
$data=$row->fetch_assoc();

if(isset($_POST['btn_update']))
{
	$name = $_POST['txt_name'];
	$email = $_POST['txt_email'];
	$contact = $_POST['txt_contact'];
	$address = $_POST['txt_address'];
	$upQry="update tbl_user set user_name='".$name."',user_email='".$email."',user_contact='".$contact."',user_address='".$address."' where user_id='".$_SESSION['uid']."' ";
	if($Con->query($upQry))
	{
		?>
        <script>
		alert("updated");
		window.location="Myprofile.php";
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
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" value=<?php echo $data['user_name'] ?> /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" value=" <?php echo $data['user_email'] ?>" /></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txt_contact"></label>
      <input type="text" name="txt_contact" id="txt_contact" value=" <?php echo $data['user_contact'] ?>" /></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><label for="txt_address"></label>
      <textarea name="txt_address" id="txt_address" cols="20" rows="3" ><?php echo $data['user_address'] ?> </textarea> </td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_update" id="btn_update" value="update" />
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>