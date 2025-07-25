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
      <td>SI NO</td>
      <td>House Photos</td>
    </tr>
     <?php
	$i=0;
	$selQry="select * from tbl_gallery WHERE house_id='".$_GET['Gid']."'";
	$row=$Con->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
		?>
    <tr>
      <td><?php echo $i ?></td>
      <td><img src="../Assets/Files/Owner/House/<?php echo $data['gallery_photo'] ?>" width="170" height="200"/></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>
</html>