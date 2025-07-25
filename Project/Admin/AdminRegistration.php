<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
	$name= $_POST['txt_name'];
	$email= $_POST['txt_email'];
	$password= $_POST['txt_password'];
	$hid=$_POST['txt_id'];
	if($hid=="")
	{
	$insQry="insert into tbl_admin(admin_name,admin_email,admin_password)values('".$name."','".$email."','".$password."')";
	if($Con->query($insQry))
	{
		?>
        <script>
		alert("Data Inserted");
		window.location="AdminRegistration.php";
		</script>
        <?php
	}
else
{
		?>
        <script>
		alert("Inserted");
		window.location="AdminRegistration.php";
		</script>
        <?php
	}
}
else
	{
		$upQry="update tbl_admin set admin_name='".$name."' where admin_id='".$hid."'";
		if($Con->query($upQry))
		{
			?>
			<script>
			alert("Updated");
			window.location="AdminRegistration.php";
			</script>
			<?php
		}
	}
}
if(isset($_GET['Did']))
{
	$delQry="delete from tbl_admin where admin_id='".$_GET['Did']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted");
		window.location="AdminRegistration.php";
		</script>
        <?php
	}
}
$adminid="";
$admindata="";
$adminemail="";
$adminpassword="";
if(isset($_GET['Eid']))
{
	$selQry="select * from tbl_admin where admin_id='".$_GET['Eid']."'";
	$row=$Con->query($eidtsel);
	$editdata=$row->fetch_assoc();
	$adminid=$editdata['admin_id'];
	$disname=$editdata['admin_name'];
	$disemail=$editdata['admin_email'];
	$dispassword=$editdata['admin_password'];
	}
?>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td width="78">Name</td>
      <td width="106"><label for="txt_adminname"></label>
      <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $adminid ?>" />
     <input type="text" name="txt_name" id="txt_name" value="<?php echo $admindata ?>" /> </td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_adminemail"></label>
      <input type="text" name="txt_email" id="txt_email" value="<?php echo $adminemail ?>" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="text" name="txt_password" id="txt_password" value="<?php echo $adminpassword ?>" />/></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
  <table width="278" height="84" border="1">
    <tr>
      <td width="45">SL NO</td>
      <td width="44">Name</td>
      <td width="40">Email</td>
      <td width="67">Password</td>
      <td width="48"><p>Action</p></td>
    </tr>
     <?php
	$i=0;
	$selQry="select * from tbl_admin";
	$row=$Con->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['admin_name'] ?></td>
      <td><?php echo $data['admin_email'] ?></td>
      <td><?php echo $data['admin_password'] ?></td>
      <td><a href="AdminRegistration.php?Did=<?php echo $data['admin_id']?>">Delete</a>
      <a href="AdminRegistration.php?Eid=<?php echo $data['admin_id']?>">Edit</a></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>