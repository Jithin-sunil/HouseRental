<?php
include("../Assets/Connection/Connection.php");
session_start();
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
      <td>Sl No</td>
      <td>House Details</td>
      <td>Rent Description</td>
      <td>Owner Details</td>
      <td>Rent Date</td>
      <td>From Date</td>
      <td>To Date</td>
      <td>Action</td>
    </tr>
         <?php
	$i=0;
    $selQry="select * from tbl_rent b inner join tbl_house h on b.house_id=h.house_id 
    inner join tbl_owner o on h.owner_id=o.owner_id where b.user_id = '" . $_SESSION['uid'] . "' order by b.rent_date desc
    ";
		$row=$Con->query($selQry);
while($data=$row->fetch_assoc())
{
	$i++;
?>

    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['house_description'] ?>
      <br /><img src="../Assets/Files/Owner/House/<?php echo $data['house_photo'] ?>" width="150" height="150" />
      <br /><?php echo $data['house_amount'] ?>
      </td>
      <td><?php echo $data['rent_description'] ?></td>
      <td>
      <?php echo $data['owner_name'] ?>
      <br /><?php echo $data['owner_email'] ?>
      <br /><?php echo $data['owner_contact'] ?>
      </td>
      <td><?php echo $data['rent_date'] ?></td>
      <td><?php echo $data['rent_fromdate'] ?></td>
      <td><?php echo $data['rent_todate'] ?></td>
       <td>
          <?php
    if($data['rent_status']==0)
    {
      echo "Pending..";
    ?>
          <a href="Chat.php?ownerId=<?php echo $data['owner_id'] ?>"> Chat </a>

          <?php
    }
    else  if($data['rent_status']==1)
    {
      echo "Accepeted.";
      ?>
          <a href="Chat.php?ownerId=<?php echo $data['owner_id'] ?>"> Chat </a>
          <a href="Payment.php?rid=<?php echo $data['rent_id'] ?>"> Payment </a>
          <?php
      
    }
     else  if($data['rent_status']==2)
    {
      echo "Rejected..";
      
    }
    else if($data['rent_status'] == 3)
    {
      ?>
          <a href="Chat.php?ownerId=<?php echo $data['owner_id'] ?>"> Chat </a>/
          <a href="Rating.php?oid=<?php echo $data['owner_id'] ?>"> Rating </a>
          <?php
              echo "Payed Advance Amount of " . ($data['rent_tokenamount'] );
    }
    ?>
        </td>
    </tr>
    <?php
}
?>
  </table>
</form>
</body>
</html>