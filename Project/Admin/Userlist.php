<?php
include("../Assets/Connection/Connection.php")
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>

  <table width="628" border="1">
   <tr>
      <td width="29">Sl No</td>
      <td width="45">photo</td>
      <td width="57">Name</td>
      <td width="56">Email</td>
      <td width="76">Contact</td>
      <td width="78">Address</td>
      <td width="71">Gender</td>
      <td width="50">DOB</td>
      <td width="71">District</td>
      <td width="53">Place</td>
      <td width="23">Action</td>
    </tr>
    <?php
	$i=0;
    $selQry="select * from tbl_user u inner join tbl_place p on u.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id ";
	$row=$Con->query($selQry);
while($data=$row->fetch_assoc())
{
	$i++;
?>
  <tr>
      <td><?php echo $i ?></td>
      <td><img src="../Assets/Files/User/Photo/<?php echo $data['user_photo']?>" width="40" height="50"/></td>
      <td><?php echo $data['user_name']?> </td>
      <td><?php echo $data['user_email']?> </td>
      <td><?php echo $data['user_contact']?> </td>
      <td><?php echo $data['user_address']?> </td>
      <td><?php echo $data['user_gender']?> </td>
      <td><?php echo $data['user_dob']?> </td>
      <td><?php echo $data['district_name']?> </td>
      <td><?php echo $data['place_name']?> </td>
      <td><a href="Userlist.php? Did= <?php echo $data['user_id'] ?>">Delete </a></td>
    </tr>
    <?php
}
?>
  </table>

</body>
</html>