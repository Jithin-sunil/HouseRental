<?php
include("../Assets/Connection/Connection.php");
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
      <td>Sl No</td>
      <td>User Details</td>
      <td>Title</td>
      <td>Content</td>
      <td>Date</td>
      <td>Reply</td>
    </tr>
     <?php
	$i=0;
	$selQry="select * from tbl_complaint c inner join tbl_user u on c.user_id=u.user_id ";
	$row=$Con->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
		?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['user_name'] ?>
      <br /><?php echo $data['user_email'] ?>
     <br /> <?php echo $data['user_contact'] ?></td>
      <td><?php echo $data['complaint_titile'] ?></td>
      <td><?php echo $data['complaint_content'] ?></td>
      <td><?php echo $data['complaint_date'] ?></td>
      <td><?php echo $data['complaint_reply'] ?></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>
</html>