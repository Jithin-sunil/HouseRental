<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
	$category= $_POST['txt_category'];
	$hid=$_POST['txt_id'];
	if($hid=="")
	{
		$insQry="insert into tbl_category(category_name)values('".$category."')";
		if($Con->query($insQry))
	{
		?>
        <script>
		alert("inserted");
		window.location="category.php";
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert("error");
		window.location="category.php";
		</script>
        <?php
	}
	}
	else
	{
		$upQry="update tbl_category set category_name='".$category."' where category_id='".$hid."'";
		if($Con->query($upQry))
		{
			?>
			<script>
			alert("Updated");
			window.location="Category.php";
			</script>
			<?php
		}
	}
}
if(isset($_GET['Did']))
{
	$delQry="delete from tbl_category where category_id='".$_GET['Did']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted");
		window.location="Category.php";
		</script>
        <?php
	}
}
$categoryid="";
$categorydata="";
if(isset($_GET['Eid']))
{
	$selQry="select * from tbl_category where category_id='".$_GET['Eid']."'";
	$row=$Con->query($selQry);
	$data=$row->fetch_assoc();
	$disid=$data['category_id'];
	$disname=$data['category_name'];
}
?>
<form id="form1" name="form1" method="post" action="">
<table width="200" border="1">
  <tr>
    <td width="115">Category Name</td>
    <td width="69">
      <label for="txt_categoryname"></label>
      <input type="text" name="txt_categoryname" id="txt_categoryname" />
   </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
  </td>
  </tr>
</table>

  <table width="200" border="1">
    <tr>
      <td>SL NO</td>
      <td>Category name</td>
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
      <td><a href="Category.php?Did=<?php echo $data['district_id']?>">Delete</a>
      <a href="Category.php?Eid=<?php echo $data['district_id']?>">Edit</a></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
