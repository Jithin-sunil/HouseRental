<?php
include("../Assets/Connection/Connection.php");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WELCOME OWNER</title>
</head>

<body>
<h1>WELCOME <?php echo $_SESSION['oname'] ?></h1>
<a href="Myprofile.php">My Profile</a><br />
<a href="Addhouse.php">Addhouse</a><br />
<a href="ViewRentbooking.php">View Rent Booking</a><br />
<a href="ViewSellbooking.php">View Sell Booking</a><br />
</body>
</html>