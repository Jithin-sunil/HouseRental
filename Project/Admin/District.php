<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
	$district=$_POST['txt_districtname'];
	$hid=$_POST['txt_id'];
	if($hid=="")
	{
		$insQry="insert into tbl_district(district_name)values('".$district."')";
		if($Con->query($insQry))
		{
			?>
			<script>
			alert("Inserted");
			window.location="District.php";
			</script>
			<?php
		}
	else
	{
			?>
			<script>
			alert("error");
			window.location="District.php";
			</script>
			<?php
		}
	}
	else
	{
		$upQry="update tbl_district set district_name='".$district."' where district_id='".$hid."'";
		if($Con->query($upQry))
		{
			?>
			<script>
			alert("Updated");
			window.location="District.php";
			</script>
			<?php
		}
	}
}
if(isset($_GET['Did']))
{
	$delQry="delete from tbl_district where district_id='".$_GET['Did']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted");
		window.location="District.php";
		</script>
        <?php
	}
}
$districtid="";
$districtname="";
if(isset($_GET['Eid']))
{
	$selQry="select * from tbl_district where district_id='".$_GET['Eid']."'";
	$row=$Con->query($selQry);
	$data=$row->fetch_assoc();
	$disid=$data['district_id'];
	$disname=$data['district_name'];
}
?>
<strong><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td width="104">District Name</td>
      <td width="80"><label for="txt_districtname"></label>
      <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $districtid ?>"/>
      <input type="text" name="txt_districtname" id="txt_districtname" value="<?php echo $districtname ?>"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
  <table width="200" border="1">
    <tr>
      <td>Sl NO</td>
      <td>District Name</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_district";
	$row=$Con->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['district_name']?></td>
      <td><a href="District.php?Did=<?php echo $data['district_id']?>">Delete</a>
      <a href="District.php?Eid=<?php echo $data['district_id']?>">Edit</a></td>
    </tr>
    <?php
	}
	?>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>
