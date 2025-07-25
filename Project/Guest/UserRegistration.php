<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_signup']))
{
	$name=$_POST['txt_name'];
	$email=$_POST['txt_email'];
	$contact=$_POST['txt_contact'];
	$address=$_POST['txt_address'];
	$gender=$_POST['rd_gender'];
	$dob=$_POST['txt_dob'];
	
	$photo=$_FILES['file_photo']['name'];
	$path=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($path,"../Assets/Files/User/Photo/".$photo);
	
	$password=$_POST['txt_password'];
	$place=$_POST['sel_place'];
	$insQry="insert into tbl_user(user_name,user_email,user_contact,user_address,user_gender,user_dob,user_photo,user_password,place_id)values('".$name."','".$email."','".$contact."','".$address."','".$gender."','".$dob."','".$photo."','".$password."','".$place."')";
	if($Con->query($insQry))
	{
		?>
        <script>
		alert("Inserted");
		window.location="UserRegistration.php";
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
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="200" border="1">
    <tr>
      <td width="83">Name</td>
      <td width="101"><label for="txt_name"></label>
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
      <td><label for="txt_address"></label>
      <textarea name="txt_address" id="txt_address" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td><input type="radio" name="rd_gender" id="rd_gender" value="Male" />Male
      <label for="rd_gender">
        <input type="radio" name="rd_gender" id="rd_gender" value="female" />female
      </label></td>
    </tr>
    <tr>
      <td>DOB</td>
    <td><label for="txt_dob"></label>
      <input type="date" name="txt_dob" id="txt_dob" /></td> 
    </tr>
    <tr>
          <td>District</td>
      <td><label for="sel_district "></label>
        <select name="sel_district " id="sel_district" onChange="getPlace(this.value)">
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
      <td><input type="file" name="file_photo" id="file_photo" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="password" name="txt_password" id="txt_password" /></td>
    </tr>
    <tr>
      <td>Re-Password</td>
      <td><label for="txt_repassword"></label>
      <input type="password" name="txt_repassword" id="txt_repassword" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_signup" id="btn_signup" value="Sign Up" />
      <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
</body>
</html>
<script src="../Assets/JQ/jQuery.js"></script> 


<script>
    function getPlace(did) 
    {

        $.ajax({
        url:"../Assets/AjaxPages/AjaxPlace.php?did="+did,
        success: function(html){
            $("#sel_place").html(html);
        }
        });
    }
</script>