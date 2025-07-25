<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST['btn_submit']))
{
$description=$_POST['txt_description'];
$fromdate=$_POST['txt_date'];
$todate=$_POST['txt_todate'];

$insQry="insert into tbl_rent(rent_description,rent_fromdate,rent_todate,user_id,house_id,rent_date)values('".$description."','".$fromdate."','".$todate."','".$_SESSION['uid']."','".$_GET['Bid']."',curdate())";

	if($Con->query($insQry))
	{
		?>
        <script>
		alert("Inserted");
		window.location="Rent.php?Bid=<?php echo $_GET['Bid']?>";
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
      <td width="98">Description</td>
      <td width="86"><label for="txt_description "></label>
      <textarea name="txt_description" id="txt_description" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>From Date</td>
      <td><label for="txt_date"></label>
      <input type="date" name="txt_date" id="txt_date" /></td>
    </tr>
    <tr>
      <td>To Date</td>
      <td><label for="txt_todate"></label>
      <input type="date" name="txt_todate" id="txt_todate" /></td>
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