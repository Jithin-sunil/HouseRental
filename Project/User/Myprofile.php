<?php
include("../Assets/Connection/Connection.php");
session_start();

$selQry="select * from tbl_user u inner join tbl_place p on u.place_id inner join tbl_district d on p.district_id=d.district_id where user_id='".$_SESSION['uid']."' ";
$row=$Con->query($selQry);
$data=$row->fetch_assoc();
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
      <td colspan="2"><img src="../Assets/Files/User/Photo/<?php echo $data['user_photo']?>" width="150" height="150"/></td>
    </tr>
    <tr>
      <td width="51">Name</td>
      <td width="133"><?php echo $data['user_name']?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?php echo $data['user_email']?></td>
    <tr>
      <td>Contact</td>
      <td><?php echo $data['user_contact']?></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><?php echo $data['user_address']?></td>
    </tr>
    <tr>
      <td>District</td>
      <td><?php echo $data['district_name']?></td>
    </tr>
    <tr>
      <td>Place</td>
      <td><?php echo $data['place_name']?></td>
    </tr>
    <tr>
      <td colspan="2">  <a href="Editprofile.php">Edit Profile </a>
      <a href="Changepassword.php">Change Password</a></td>
    </tr>
  </table>

</form>
</body>
</html>