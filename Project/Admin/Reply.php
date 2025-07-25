<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
	$reply=$_POST['txt_reply'];
	
	$insQry="insert into tbl_complaint(complaint_reply,user_id,complaint_date)values('".$reply."','".$_SESSION['uid']."',curdate())";
	
	if($Con->query($insQry))
	{
?>
        <script>
		alert("Data Inserted");
		window.location="Reply.php";
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
      <td>Reply</td>
      <td><label for="txt_reply"></label>
      <textarea name="txt_reply" id="txt_reply" cols="45" rows="5"></textarea></td>
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