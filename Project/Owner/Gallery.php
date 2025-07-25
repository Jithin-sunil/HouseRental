<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
	$housephoto=$_FILES['file_photo']['name'];
	$path=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($path,"../Assets/Files/Owner/House/".$housephoto);
	
	$insQry="insert into tbl_gallery(gallery_photo,house_id)values('".$housephoto."','".$_GET['Gid']."')";
		if($Con->query($insQry))
	{
		?>
        <script>
		alert("Data Inserted");
		window.location="Gallery.php?Gid=<?php echo $_GET['Gid']?>";
		</script>
        <?php
	}
}
if(isset($_GET['Did']))
{
	$delQry="delete from tbl_gallery where gallery_id='".$_GET['Did']."' ";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted");
		window.location="Gallery.php?Gid=<?php echo $_GET['Gid']?>";
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
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="200" border="1">
    <tr>
      <td>House photo</td>
      <td><label for="file_photo"></label>
      <input type="file" name="file_photo" id="file_photo" /></td>
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
      <td>SI NO</td>
      <td>House Photo</td>
      <td>Action</td>
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
      <td><a href="Gallery.php?Did=<?php echo $data['gallery_id'] ?>&&Gid=<?php echo $_GET['Gid']?>">Delete </a></td>
    </tr>
      <?php
	}
	?>
    </table>
  <p>&nbsp;</p>
</form>
</body>
</html>