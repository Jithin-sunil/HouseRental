<?php
include("../Assets/Connection/Connection.php");
session_start();
$selQry="select * from tbl_owner where owner_id='".$_SESSION['oid']."'";
$row=$Con->query($selQry);
$data=$row->fetch_assoc();

if(isset($_POST['btn_submit']))
{
	$name = $_POST['txt_name'];
	$email = $_POST['txt_email'];
	$contact = $_POST['txt_contact'];
	$address = $_POST['txt_address'];
	$upQry="update tbl_owner set owner_name='".$name."',owner_email='".$email."',owner_contact='".$contact."',owner_address='".$address."' where owner_id='".$_SESSION['oid']."' ";
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
<h1>EDIT PROFILE</h1>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td width="57">Name</td>
      <td width="127"><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" value=<?php echo $data['owner_name'] ?> /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" value=<?php echo $data['owner_email'] ?>/></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txt_contact"></label>
      <input type="text" name="txt_contact" id="txt_contact" value=<?php echo $data['owner_contact'] ?> /></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><label for="txt_address"></label>
      <input type="text" name="txt_address" id="txt_address" cols="45" rows="5" value=<?php echo $data['owner_address'] ?>/></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="submit" />
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>