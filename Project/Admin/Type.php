<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
	$type=$_POST['txt_type'];
	
	$insQry="insert into tbl_type(type_name) values ('".$type."')";
	if($Con->query($insQry))
	{
		?>
        <script>
		alert("Data Inserted");
		window.location="Type.php";
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert("Wrong");
		window.location="Type.php";
		</script>
        <?php
	}
}
if(isset($_GET['Did']))
{
	$delQry="delete from tbl_type where type_id='".$_GET['Did']."' ";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted");
		window.location="Type.php";
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
      <td>Type</td>
      <td><label for="txt_type"></label>
      <input type="text" name="txt_type" id="txt_type" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="200" border="1">
    <tr>
      <td>Sl No</td>
      <td>Type</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_type";
	$row=$Con->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
		?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['type_name'] ?></td>
      <td><a href="Type.php? Did= <?php echo $data['type_id'] ?>">Delete </a></td>
    </tr>
    <?php
	}
	?>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>