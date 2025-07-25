<?php
include("../Connection/Connection.php");
session_start();
if(isset($_GET['Bid']))
{
	$insQry="insert into tbl_booking (house_id,user_id,booking_date)values('".$_GET['Bid']."','".$_SESSION['uid']."',curdate())";
	if($Con->query($insQry))
	{
		?>
        <script>
		alert("Booked");
		window.location="Viewhouse.php";
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
 <table width="200" border="1">
    <tr>
      <td>SI NO</td>
      <td>Type</td>
      <td>House Type</td>
      <td>Description</td>
      <td>Photo</td>
      <td>Amount</td>
      <td>District</td>
      <td>Place</td>
      <td>Action</td>
    </tr>
     <?php
	$i=0;
	$selQry="select * from tbl_house h inner join tbl_place p on h.place_id = p.place_id inner join tbl_district d on p.district_id=d.district_id inner join tbl_housetype ht on h.housetype_id = ht.housetype_id inner join tbl_type t on h.type_id = t.type_id  WHERE h.place_id='".$_GET['did']."' and h.type_id=1";
	$row=$Con->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
		?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['type_name'] ?></td>
      <td><?php echo $data['housetype_name'] ?></td>
      <td><?php echo $data['house_description'] ?></td>
      <td><img src="../Assets/Files/Owner/House/<?php echo $data['house_photo'] ?>" width="150" height="150" /></td>
      <td><?php echo $data['house_amount'] ?></td>
      <td><?php echo $data['district_name'] ?></td>
      <td><?php echo $data['place_name'] ?></td>
      <td><a href="Gallery.php">Gallery</a>
       <a href="Viewhouse.php?Bid=<?php echo $data['house_id']?>">BOOK</a></td>
    </tr>
    <?php
	}
	?>
  </table>
</body>
</html>