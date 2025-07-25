<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
	$name=$_POST['txt_name'];
	$email=$_POST['txt_email'];
	$contact=$_POST['txt_contact'];
	$address=$_POST['txtarea_address'];
	$district=$_POST['sel_disrict'];
	
	$photo=$_FILES['file_photo']['name'];
	$path=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($path,"../Assets/Files/User/Photo/".$photo);
	
	$proof=$_FILES['file_proof']['name'];
	$path=$_FILES['file_proof']['tmp_name'];
	move_uploaded_file($path,"../Assets/Files/User/Photo/".$proof);
	
	$password=$_POST['txt_password'];
	$place=$_POST['sel_place'];
	
	$insQry="insert into tbl_owner(owner_name,owner_email,owner_password,owner_contact,owner_address,owner_photo,owner_proof,owner_status,place_id)values('".$name."','".$email."','".$password."','".$contact."','".$address."','".$photo."','".$proof."','".$status."','".$place."')";
	if($Con->query($insQry))
	{
		?>
        <script>
		alert("Inserted");
		window.location="Owner.php";
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
      <td width="113">Name</td>
      <td width="71"><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" /></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txt_contact"></label>
      <input type="text" name="txt_contact" id="txt_contact" /></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><label for="txtarea_address"></label>
      <textarea name="txtarea_address" id="txtarea_address" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>District</td>
      <td><label for="sel_district"></label>
        <select name="sel_district" id="sel_district" onchange="getplace(this.value)">
         <option value="">--Select District--</option>
        <?php
		$selQry="select * from tbl_district";
		$row=$Con->query($selQry);
		while($data=$row->fetch_assoc())
		{
			?>
            <option
            value="<?php echo $data['district_id'] ?>"><?php echo $data['district_name']?></option>
            <?php
		}
		?>
      </select></td>
    </tr>
    <tr>
      <td>Place</td>
      <td><label for="sel_place"></label>
        <select name="sel_place" id="sel_place">
        <option value="">--select--</option>
      </select></td>
    </tr>
    <tr>
      <td>Photo</td>
      <td><label for="file_photo"></label>
      <input type="file" name="file_photo" id="file_photo" /></td>
    </tr>
    <tr>
      <td>Proof</td>
      <td><label for="file_proof"></label>
      <input type="file" name="file_proof" id="file_proof" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="text" name="txt_password" id="txt_password" /></td>
    </tr>
    <tr>
      <td>Re-type Password</td>
      <td><label for="txt_retypepassword"></label>
      <input type="text" name="txt_repassword" id="txt_repassword" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>
<script src="../Assets/JQ/jQuery.js"></script> 


<script>
    function getplace(did) 
    {

        $.ajax({
        url:"../Assets/AjaxPages/AjaxPlace.php?did="+did,
        success: function(html){
            $("#sel_place").html(html);
        }
        });
    }
</script>
