<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST['btn_submit']))
{
	$content=$_POST['txt_content'];
	
	$insQry="insert into tbl_feedback(feedback_content,user_id)values('".$content."','".$_SESSION['uid']."')";
	
	if($Con->query($insQry))
	{
?>
        <script>
		alert("Data Inserted");
		window.location="FeedBack.php";
		</script>
      
       <?php
	}
}
if(isset($_GET['Did']))
{
	$delQry="delete from tbl_feedback where feedback_id='".$_GET['Did']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted");
		window.location="FeedBack.php";
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
      <td>Content</td>
      <td><label for="txt_content"></label>
      <textarea name="txt_content" id="txt_content" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </div></td>
    </tr>
  </table>
  <table width="200" border="1">
    <tr>
      <td>SI NO</td>
      <td>Content</td>
      <td>Action</td>
    </tr>
     <?php
	$i=0;
	$selQry="select * from tbl_feedback WHERE user_id='".$_SESSION['uid']."'";
	$row=$Con->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
		?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['feedback_content']?></td>
      <td><a href="FeedBack.php?Did=<?php echo $data['feedback_id'] ?>">Delete</a></td>
    </tr>
    <?php
	}
    ?>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>