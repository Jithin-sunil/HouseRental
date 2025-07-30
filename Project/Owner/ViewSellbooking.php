<?php
include("../Assets/Connection/Connection.php");
if(isset($_GET['aid']))
{
    $upQry="update tbl_booking set booking_status=1, booking_amount='".$_GET['amt']."' where booking_id='".$_GET['aid']."'";
    if($Con->query($upQry))
    {
        ?>
        <script>
        alert("Accepted");
        window.location="ViewSellbooking.php";
        </script>
        <?php
    }
}
if(isset($_GET['rid']))
{
    $upQry="update tbl_booking set booking_status=2 where booking_id='".$_GET['rid']."'";
    if($Con->query($upQry))
    {
        ?>
        <script>
        alert("Rejected");
        window.location="ViewSellbooking.php";
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
      <td>SL No</td>
      <td>User Details</td>
      <td>House Details</td>
      <td>Booking Date</td>
      <td>Action</td>
    </tr>
    <?php
    $i=0;
    $selQry="select * from tbl_booking b inner join tbl_user u on b.user_id=u.user_id inner join tbl_house h on b.house_id=h.house_id";
    $row=$Con->query($selQry);
    while($data=$row->fetch_assoc())
    {
        $i++;
        ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['user_name'] ?>
      <br /><?php echo $data['user_email'] ?>
      <br /><?php echo $data['user_contact'] ?>
      </td>
      <td><?php echo $data['house_amount'] ?>
      <br /><?php echo $data['house_description'] ?></td>
      <td><?php echo $data['booking_date'] ?></td>
      <td>
      <?php
      if($data['booking_status']==0)
      {
      ?>
      <a href = "Chat.php?userId=<?php echo $data['user_id'] ?>"> Chat </a>
      <a href="#" onclick="
        var amt = prompt('Enter accepted amount:');
        if(amt !== null && amt !== '') {
          if(isNaN(amt) || amt <= 100000) {
            alert('Please enter an amount greater than 100,000.');
            return false;
          } else {
            window.location = 'ViewSellbooking.php?aid=<?php echo $data['booking_id'] ?>&amt=' + encodeURIComponent(amt);
          }
        }
        return false;"> Accepted </a>
      <a href = "ViewSellbooking.php?rid=<?php echo $data['booking_id'] ?>"> Rejected </a>
      <?php
      }
      else if($data['booking_status']==1)
      {
          echo "Accepted.";
          ?>
          <a href = "Chat.php?userId=<?php echo $data['user_id'] ?>"> Chat </a>
          <?php
      }
      else if($data['booking_status']==2)
      {
          echo "Rejected.";
      }
      else if($data['booking_status'] == 3)
      {
          ?>
          <a href = "Chat.php?userId=<?php echo $data['user_id'] ?>"> Chat </a>
          <?php
          echo "Paid Advance Amount of " . ($data['booking_amount'] * 0.05);
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