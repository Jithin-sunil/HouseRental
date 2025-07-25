<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
	$category=$_POST['sel_category'];
	$subcategory=$_POST['txt_subcategory'];
	$hid=$_POST['txt_id'];
	if($hid=="")
	{
		$insQry="insert into tbl_subcategory(subcategory_name,category_id)values('".$subcategory."','".$category."')";
		if($Con->query($insQry))
		{
			?>
			<script>
			alert("Inserted");
			window.location="Subcategory.php";
			</script>
			<?php
		}
	}
	else
	{
		$upQry="update tbl_subcategory set subcategory_name='".$subcategory."',category_id='".$category."' where subcategory_id='".$hid."'";
		if($Con->query($upQry))
		{
			?>
			<script>
			alert("Updated");
			window.location="Subcategory.php";
			</script>
			<?php
		}
	}
}
if(isset($_GET['Did']))
{
	$delQry="delete from tbl_subcategory where subcategory_id='".$_GET['Did']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted");
		window.location="Subcategory.php";
		</script>
        <?php
	}
}
$subcategoryid="";
$subcategoryname="";
$categoryid="";
if(isset($_GET['Eid']))
{
	$selQry="select * from tbl_subcategory where subcategory_id='".$_GET['Eid']."'";
	$row=$Con->query($editsel);
	$editdata=$row->fetch_assoc();
	$subcategoryname=$data['subcategory_id'];
	$categoryid=$data['category_name'];
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
      <td width="88">Category</td>
      <td width="96"><label for="sel_category"></label>
        <select name="sel_category" id="sel_category">
        <option value="">--select--</option>
        <?php
		$selQry="select * from tbl_category";
	$row=$Con->query($selQry);
	while($data=$row->fetch_assoc())
	{
	?>
    <option
    <?php
	if($data['category_id']==$categoryid)
	{
		echo "selected";
	}
	?>
    value="<?php echo $data['category_id'] ?>"><?php echo $data['category_name']?></option>
    <?php
	}
	?>
      </select></td>
    </tr>
    <tr>
      <td>Subcategory</td>
      <td><label for="txt_subcategory"></label>
      <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $subcategoryid ?>" /> 
       <input type="text" name="txt_subcategory" id="txt_subcategory"  value="<?php echo $subcategoryname ?>"/>
       </td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="227" border="1">
    <tr>
      <td width="38">SINO</td>
      <td width="56">Category</td>
      <td width="73">subcategory</td>
      <td width="32">Action</td>
    </tr>
      <?php
	$i=0;
	$selQry="select * from tbl_subcategory s inner join tbl_category c on s.category_id=c.category_id";
	$row=$Con->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['category_name']?></td>
      <td><?php echo $data['subcategory_name']?></td>
      <td>
      <a href="subcategory.php?Did=<?php echo $data['subcategory_id'] ?>">delete</a>
      <a href="subcategory.php?Eid=<?php echo $data['subcategory_id'] ?>">edit</a></td>
    </tr>
    <?php
	}
	?>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>