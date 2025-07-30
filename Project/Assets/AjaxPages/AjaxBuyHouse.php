<?php
include("../Connection/Connection.php");
session_start();

if (isset($_GET['bid'])) {
    $house_id = $_GET['bid'];
    $user_id = $_SESSION['uid'];
    $checkQry = "SELECT * FROM tbl_booking WHERE house_id = '$house_id' AND user_id = '$user_id' AND booking_status = 0";
    $checkResult = $Con->query($checkQry);
    
    if ($checkResult->num_rows > 0) {
        echo "Already booked, check your booking";
    } else {
        $insQry = "INSERT INTO tbl_booking (house_id, user_id, booking_date) VALUES ('$house_id', '$user_id', CURDATE())";
        if ($Con->query($insQry)) {
            echo "House Booked Successfully";
        } else {
            echo "Error in Booking House";
        }
    }
}
?>