<?php
include("../Assets/Connection/Connection.php");
	if(isset($_GET['aid']))
	{
		$upQry="update tbl_owner set owner_status=1 where owner_id='".$_GET['aid']."'";
		if($Con->query($upQry))
		{
			?>
            <script>
			alert("Accepted");
			window.location="OwnerList.php";
			</script>
            <?php
		}
	}
		if(isset($_GET['rid']))
	{
		$upQry="update tbl_owner set owner_status=2 where owner_id='".$_GET['rid']."'";
		if($Con->query($upQry))
		{
			?>
            <script>
			alert("Rejected");
			window.location="OwnerList.php";
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
<h1>OwnerList</h1>
  <table width="200" border="1">
    <tr>
      <td>Sl No</td>
      <td>Name</td>
      <td>Email</td>
      <td>Address</td>
      <td>Contact</td>
      <td>Photo</td>
      <td>District</td>
      <td>Place</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_owner u inner join tbl_place p on u.place_id = p.place_id inner join tbl_district d on p.district_id=d.district_id where owner_status=0";
	$row=$Con->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td> <?php echo $i ?></td>
      <td> <?php  echo $data['owner_name'] ?></td>
      <td> <?php echo $data['owner_email']?></td>
      <td> <?php echo $data['owner_address']?></td>
      <td> <?php echo $data['owner_contact']?></td>
      <td><img src="../Assets/Files/User/Photo/<?php echo $data['owner_photo'] ?>" width="40" height="50" /></td>
      <td> <?php echo $data['district_name']?></td>
      <td> <?php echo $data['place_name']?></td>
      <td> <a href = "OwnerList.php? aid=<?php echo $data['owner_id'] ?>"> Accepted </a>
      <a href = "OwnerList.php? rid=<?php echo $data['owner_id'] ?>"> Rejected </a></td>
    </tr>
    <?php
	}
	?>
  </table>
</body>
</html>





<h1>Accept List</h1>
  <table width="200" border="1">
    <tr>
      <td>Sl No</td>
      <td>Name</td>
      <td>Email</td>
      <td>Address</td>
      <td>Contact</td>
      <td>Photo</td>
      <td>District</td>
      <td>Place</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_owner u inner join tbl_place p on u.place_id = p.place_id inner join tbl_district d on p.district_id=d.district_id where owner_status=1";
	$row=$Con->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td> <?php echo $i ?></td>
      <td> <?php  echo $data['owner_name'] ?></td>
      <td> <?php echo $data['owner_email']?></td>
      <td> <?php echo $data['owner_address']?></td>
      <td> <?php echo $data['owner_contact']?></td>
      <td><img src="../Assets/Files/User/Photo/<?php echo $data['owner_photo'] ?>" width="40" height="50" /></td>
      <td> <?php echo $data['district_name']?></td>
      <td> <?php echo $data['place_name']?></td>
      <td> <a href = "OwnerList.php? rid=<?php echo $data['owner_id'] ?>"> Rejected </a></td>
    </tr>
    <?php
	}
	?>
  </table>
<h1>Reject List</h1>
  <table width="200" border="1">
    <tr>
      <td>Sl No</td>
      <td>Name</td>
      <td>Email</td>
      <td>Address</td>
      <td>Contact</td>
      <td>Photo</td>
      <td>District</td>
      <td>Place</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_owner u inner join tbl_place p on u.place_id = p.place_id inner join tbl_district d on p.district_id=d.district_id where owner_status=2";
	$row=$Con->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td> <?php echo $i ?></td>
      <td> <?php  echo $data['owner_name'] ?></td>
      <td> <?php echo $data['owner_email']?></td>
      <td> <?php echo $data['owner_address']?></td>
      <td> <?php echo $data['owner_contact']?></td>
      <td><img src="../Assets/Files/User/Photo/<?php echo $data['owner_photo'] ?>" width="40" height="50" /></td>
      <td> <?php echo $data['district_name']?></td>
      <td> <?php echo $data['place_name']?></td>
      <td> <a href = "OwnerList.php? aid=<?php echo $data['owner_id'] ?>"> Accepted </a>
     </td>
    </tr>
    <?php
	}
	?>
  </table>