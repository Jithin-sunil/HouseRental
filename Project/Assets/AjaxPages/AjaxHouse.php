<?php
include("../Connection/Connection.php");
session_start();

$selQry = "SELECT * FROM tbl_house h 
    INNER JOIN tbl_place p ON h.place_id = p.place_id
    INNER JOIN tbl_district d ON p.district_id = d.district_id
    INNER JOIN tbl_housetype ht ON h.housetype_id = ht.housetype_id
    INNER JOIN tbl_type t ON h.type_id = t.type_id
    WHERE house_status = 0";

if (!empty($_GET['did'])) {
    $selQry .= " AND d.district_id = '" . $_GET['did'] . "'";
}
if (!empty($_GET['pid'])) {
    $selQry .= " AND p.place_id = '" . $_GET['pid'] . "'";
}
if (!empty($_GET['tid'])) {
    $selQry .= " AND t.type_id = '" . $_GET['tid'] . "'";
}
if (!empty($_GET['htid'])) {
    $selQry .= " AND ht.housetype_id = '" . $_GET['htid'] . "'";
}

if($_GET['did']!="")
{
  $selQry.=" and d.district_id='".$_GET['did']."' ";

}
if($_GET['pid']!="")
{
  $selQry.=" and p.place_id='".$_GET['pid']."' ";
}

if($_GET['tid']!="")
{
  $selQry.=" and t.type_id='".$_GET['tid']."' ";
}

if($_GET['htid']!="")
{
  $selQry.=" and ht.housetype_id='".$_GET['htid']."' ";
}
if($_GET['did']!=""  && $_GET['pid']!="" && $_GET['tid']!="")
{
  $selQry.=" and p.place_id = '".$_GET['pid']."' and t.type_id='".$_GET['tid']."'   ";
}
if($_GET['did']!=""  && $_GET['pid']!=""  && $_GET['htid']!="")
{
  $selQry.=" and p.place_id = '".$_GET['pid']."'  and ht.housetype_id='".$_GET['htid']."'  ";
}


if($_GET['did']!=""  && $_GET['pid']!="" && $_GET['tid']!="" && $_GET['htid']!="")
{
  $selQry.=" and p.place_id = '".$_GET['pid']."' and t.type_id='".$_GET['tid']."' and ht.housetype_id='".$_GET['htid']."'  ";
}





$row=$Con->query($selQry);

if ($row->num_rows > 0) {
  ?>

<table cellpadding="10" border="1" >
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
	
	while($data=$row->fetch_assoc())
	{
		$i++;
		?>
      <tr>
        <td>
          <?php echo $i ?>
        </td>
        <td>
          <?php echo $data['type_name'] ?>
        </td>
        <td>
          <?php echo $data['housetype_name'] ?>
        </td>
        <td>
          <?php echo $data['house_description'] ?>
        </td>
        <td><img src="../Assets/Files/Owner/House/<?php echo $data['house_photo'] ?>" width="150" height="150" /></td>
        <td>
          <?php echo $data['house_amount'] ?>
        </td>
        <td>
          <?php echo $data['district_name'] ?>
        </td>
        <td>
          <?php echo $data['place_name'] ?>
        </td>
        <td>
          <a href="ViewMore.php?hid=<?php echo $data['house_id'] ?>">View More</a>/
            <?php
            if($data['type_name'] == 'Rent')
            {
              ?>
               <a href="Rent.php?Bid=<?php echo $data['house_id']?>">Book For Rent</a>
              <?php
            }
            else
            {
              ?>
          <a href="" onclick="bookhouse(<?php echo $data['house_id']?>)">Book</a>

              <?php
            }
            ?>
        </td>
      </tr>
      <?php
	}
	?>
    </table>
  <?php
}
else
{
  ?>
  <span style="color:red">No Data Found</span>
  <?php
}