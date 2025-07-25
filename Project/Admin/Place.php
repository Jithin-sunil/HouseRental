<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
	$district=$_POST['sel_district'];
	$place=$_POST['txt_place'];
	$hid=$_POST['txt_id'];
	if($hid=="")
	{
		$insQry="insert into tbl_place(place_name,district_id) values('".$place."','".$district."')";
		if($Con->query($insQry))
		{
			?>
			<script>
			alert ("Data Inserted")
			window.location="Place.php";
			</script>
			<?php
		}
		else
		{
			?>
			<script>
			alert ("Error")
			window.location="Place.php";
			</script>
			<?php
		}
	}
	else
	{
		$upQry="update tbl_place set place_name='".$place."',district_id='".$district."' where place_id='".$hid."' ";
		if($Con->query($upQry))
		{
			?>
            <script>
			alert('Updated')
			window.location="Place.php";
			</script>
            <?php
		}
	}
}
if(isset($_GET['Did']))
{
	$delQry="delete from tbl_place where place_id='".$_GET['Did']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted")
		window.location="Place.php";
		</script>
        <?php
	}
}
$placeid="";
$placename="";
$districtid="";
if(isset($_GET['Eid']))
{
	$editsel="select * from tbl_place where place_id='".$_GET['Eid']."'";
	$row=$Con->query($editsel);
	$editdata=$row->fetch_assoc();
	$placeid=$editdata['place_id'];
	$placename=$editdata['place_name'];
	$districtid=$editdata['district_id'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Place</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<h1>Place</h1>
  <table width="281" border="1">
    <tr>
      <td width="101">District</td>
      <td width="168"><label for="sel_district"></label>
        <label for="sel_district"></label>
        <select name="sel_district" id="sel_district">
        <option value="">Select District</option>
        <?php
		$selQry="select * from tbl_district";
		$row=$Con->query($selQry);
		while($data=$row->fetch_assoc())
		{
		?>
        <option
        <?php
		if($data['district_id']==$districtid)
		{
			echo "Selected";
		}
		?>
        value="<?php echo $data['district_id'] ?>"><?php echo $data['district_name']?></option>
        <?php
		}
		?>
        </select>
      </tr>
    <tr>
      <td>Place</td>
      <td><label for="txt_place"></label>
      <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $placeid ?>"/>
      <input type="text" name="txt_place" id="txt_place" value="<?php echo $placename ?>"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="submit" name="btn_reset" id="btn_reset" value="Clear" /></td>
    </tr>
  </table>
  <h1>Place List</h1>
  <table width="355" border="1">
    <tr>
      <td width="86">SI No</td>
      <td width="73">District</td>
      <td width="78">Place</td>
      <td width="90">Actions</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_place p inner join tbl_district d on p.district_id=d.district_id";
	$row=$Con->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
	
	?>
    <tr>
      <td><?php echo $i ?> </td>
      <td><?php echo $data['district_name'] ?></td>
      <td><?php echo $data['place_name'] ?></td>
      <td>
      <a href ="Place.php?Did=<?php echo $data['place_id'] ?>">Delete</a>
      <a href="Place.php?Eid=<?php echo $data['place_id'] ?>">Edit</a>
      </td>
    </tr>
   <?php
	}
   ?>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>