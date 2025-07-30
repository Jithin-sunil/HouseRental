<?php
include("../Assets/Connection/Connection.php");

?>

<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Untitled Document</title>
</head>

<body>
  <form id="form1" name="form1" method="post" action="">
    <table cellpadding="10" border="1">
      <tr>

        <td>
          <label for="sel_district">District</label>
          <select name="sel_district" id="sel_district" onChange="getPlace(this.value),searchHouse()">
            <option value="">--Select District--</option>
            <?php
		$selQry="select * from tbl_district ";
		$row=$Con->query($selQry);
		while($data=$row->fetch_assoc())
		{
			?>
            <option value="<?php echo $data['district_id'] ?>">
              <?php echo $data['district_name']?>
            </option>
            <?php
		}
		?>

          </select>
        </td>
        <td>

          <label for="sel_place">Place</label>
          <select name="sel_place" id="sel_place" onChange="searchHouse()">
            <option value="">--select place--</option>
          </select>



        <td>
          <label for="sel_type">Type</label>
          <select name="sel_type" id="sel_type" onChange="searchHouse()">
            <option value="">--Select Type--</option>
            <?php
            	$selQry="select * from tbl_type  ";
		$row=$Con->query($selQry);
		while($data=$row->fetch_assoc())
		{
			?>
            <option value="<?php echo $data['type_id'] ?>">
              <?php echo $data['type_name']?>
            </option>
            <?php
		}
    ?>
          </select>
        </td>
        <td>
          <label for="sel_housetype">House Type</label>
          <select name="sel_housetype" id="sel_housetype" onChange="searchHouse()">
            <option value="">--Select House Type--</option>
            <?php
            	$selQry="select * from tbl_housetype  ";
		$row=$Con->query($selQry);
		while($data=$row->fetch_assoc())
		{
			?>
            <option value="<?php echo $data['housetype_id'] ?>">
              <?php echo $data['housetype_name']?>
            </option>
            <?php
		}
    ?>
          </select>
        </td>
      </tr>


    </table>
    <p>&nbsp;</p>
    <div id="result">
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
	$selQry="select * from tbl_house h inner join tbl_place p on h.place_id = p.place_id inner join tbl_district d on p.district_id=d.district_id inner join tbl_housetype ht on h.housetype_id = ht.housetype_id inner join tbl_type t on h.type_id = t.type_id where  house_status=0 ";
	$row=$Con->query($selQry);
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
    </div>
    <p>&nbsp;</p>
  </form>
</body>

</html>


<script src="../Assets/JQ/jQuery.js"></script>


<script>
  function getPlace(did) {

    $.ajax({
      url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
      success: function (html) {
        $("#sel_place").html(html);
      }
    });
  }

  function searchHouse() {
    var did = document.getElementById("sel_district").value;
    var pid = document.getElementById("sel_place").value;
    var tid = document.getElementById("sel_type").value;
    var htid = document.getElementById("sel_housetype").value;
    $.ajax({
      url: "../Assets/AjaxPages/AjaxHouse.php?did=" + did + "&pid=" + pid + "&tid=" + tid + "&htid=" + htid,
      success: function (html) {
        $("#result").html(html);
      }
    });
  }

  function bookhouse(bid) {

    $.ajax({
      url: "../Assets/AjaxPages/AjaxBuyHouse.php?bid=" + bid,
      success: function (html) {
        alert(html);
        window.location = "Viewhouse.php";
      }
    });
  }
</script>