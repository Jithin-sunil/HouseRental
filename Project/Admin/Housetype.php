<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
	$housetype= $_POST['txt_housetype'];

		$insQry="insert into tbl_housetype(housetype_name)values('".$housetype."')";
		if($Con->query($insQry))
	{
		?>
        <script>
	alert("inserted");
		window.location="Housetype.php";
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert("error");
		window.location="Housetype.php";
		</script>
        <?php
	}
	
}
if(isset($_GET['Did']))
{
	$delQry="delete from tbl_housetype where housetype_id='".$_GET['Did']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted");
		window.location="Housetype.php";
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
      <td width="76">House Type</td>
      <td width="108"><label for="txt_housetype"></label>
      <input type="text" name="txt_housetype" id="txt_housetype" /></td>
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
      <td>SI No</td>
      <td>House Type</td>
      <td>Action</td>
    </tr>
     <?php
	$i=0;
	$selQry="select * from tbl_housetype";
	$row=$Con->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++; 
	?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['housetype_name']?></td>
      <td><a href="Housetype.php?Did=<?php echo $data['housetype_id']?>">Delete</a></td>
    </tr>
      <?php
	}
	?>
  </table>
</form>
</body>
</html>