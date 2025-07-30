<?php
include("../Assets/Connection/Connection.php");
session_start();

$house_id = $_GET['hid'];
$selQry = "SELECT * FROM tbl_house h 
           INNER JOIN tbl_place p ON h.place_id = p.place_id 
           INNER JOIN tbl_district d ON p.district_id = d.district_id 
           INNER JOIN tbl_housetype ht ON h.housetype_id = ht.housetype_id 
           INNER JOIN tbl_type t ON h.type_id = t.type_id 
           INNER JOIN tbl_owner o ON h.owner_id = o.owner_id 
           WHERE h.house_id = '$house_id'";
$resultS = $Con->query($selQry);
$house = $resultS->fetch_assoc();

$selGallery = "SELECT * FROM tbl_gallery WHERE house_id = '$house_id'";
$galleryResult = $Con->query($selGallery);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>View More</title>
</head>
<body>
    <table cellpadding="10" border="1">
        <tr>
            <th colspan="2">House Details</th>
        </tr>
        <tr>
            <td>Type</td>
            <td><?php echo $house['type_name']; ?></td>
        </tr>
        <tr>
            <td>House Type</td>
            <td><?php echo $house['housetype_name']; ?></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><?php echo $house['house_description']; ?></td>
        </tr>
        <tr>
            <td>Amount</td>
            <td><?php echo $house['house_amount']; ?></td>
        </tr>
        <tr>
            <td>District</td>
            <td><?php echo $house['district_name']; ?></td>
        </tr>
        <tr>
            <td>Place</td>
            <td><?php echo $house['place_name']; ?></td>
        </tr>
        <tr>
            <td>House Photo</td>
            <td>
                <img src="../Assets/Files/Owner/House/<?php echo $house['house_photo']; ?>" width="150" height="150" 
                     onclick="window.open('../Assets/Files/Owner/House/<?php echo $house['house_photo']; ?>', '_blank')" 
                     style="cursor: pointer;" />
            </td>
        </tr>
        <tr>
            <td>Action</td>
            <td>
                <?php
                if ($house['type_name'] == 'Rent') {
                ?>
                <a href="Rent.php?Bid=<?php echo $house['house_id']; ?>">Book For Rent</a>
                <?php
                } else {
                ?>
                <a href="Viewhouse.php?Bid=<?php echo $house['house_id']; ?>">Book</a>
                <?php
                }
                ?>
            </td>
        </tr>
    </table>

    <table cellpadding="10" border="1">
        <tr>
            <th colspan="2">Owner Details</th>
        </tr>
        <tr>
            <td>Name</td>
            <td><?php echo $house['owner_name']; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo $house['owner_email']; ?></td>
        </tr>
        <tr>
            <td>Contact</td>
            <td><?php echo $house['owner_contact']; ?></td>
        </tr>
        <tr>
            <td>Address Sodaleski
            <td><?php echo $house['owner_address']; ?></td>
        </tr>
        <tr>
            <td>Photo</td>
            <td>
                <img src="../Assets/Files/Owner/<?php echo $house['owner_photo']; ?>" width="150" height="150" 
                     onclick="window.open('../Assets/Files/Owner/<?php echo $house['owner_photo']; ?>', '_blank')" 
                     style="cursor: pointer;" />
            </td>
        </tr>
        <tr>
           <td colspan="2">
    <?php
    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $query = "SELECT * FROM tbl_rating WHERE owner_id = '" . $house["owner_id"] . "' ORDER BY rating_id DESC";
    $result = $Con->query($query);
    while ($row = $result->fetch_assoc()) {
        if ($row["rating_value"] == '5') {
            $five_star_review++;
        }
        if ($row["rating_value"] == '4') {
            $four_star_review++;
        }
        if ($row["rating_value"] == '3') {
            $three_star_review++;
        }
        if ($row["rating_value"] == '2') {
            $two_star_review++;
        }
        if ($row["rating_value"] == '1') {
            $one_star_review++;
        }
        $total_review++;
        $total_user_rating = $total_user_rating + $row["rating_value"];
    }
    if ($total_review == 0 || $total_user_rating == 0) {
        $average_rating = 0;
    } else {
        $average_rating = $total_user_rating / $total_review;
    }
    $average_rating = round($average_rating * 4) / 4;
    ?>
    <p align="center" style="color:#F96;font-size:20px">
        <?php
        $full_stars = floor($average_rating);
        $fraction = $average_rating - $full_stars;
        $half_star = ($fraction >= 0.25 && $fraction < 0.75) ? 1 : ($fraction >= 0.75 ? 1 : 0);
        $empty_stars = 5 - $full_stars - $half_star;

        for ($i = 0; $i < $full_stars; $i++) {
        ?>
            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
        <?php
        }
        if ($half_star && $fraction < 0.75) {
        ?>
            <i class="fas fa-star-half-alt star-light mr-1 main_star" style="color:#FC3"></i>
        <?php
        }
        elseif ($half_star && $fraction >= 0.75) {
        ?>
            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
        <?php
        }
        for ($i = 0; $i < $empty_stars; $i++) {
        ?>
            <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
        <?php
        }
        ?>
    </p>
</td>
        </tr>
    </table>

    <table cellpadding="10" border="1">
        <tr>
            <th>House Gallery</th>
        </tr>
        <?php
        if ($galleryResult->num_rows > 0) {
            while ($gallery = $galleryResult->fetch_assoc()) {
                if (!empty($gallery['gallery_photo'])) {
        ?>
        <tr>
            <td>
                <img src="../Assets/Files/Owner/House/<?php echo $gallery['gallery_photo']; ?>" width="150" height="150" 
                     onclick="window.open('../Assets/Files/Owner/House/<?php echo $gallery['gallery_photo']; ?>', '_blank')" 
                     style="cursor: pointer;" />
            </td>
        </tr>
        <?php
                }
            }
        } else {
        ?>
        <tr>
            <td>No images available in the gallery</td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>