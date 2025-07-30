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
      <td>District</td>
      <td>
        <label for="sel_district"></label>
        <select name="sel_district" id="sel_district" onChange="getPlace(this.value)" >
     <option value="">--Select District--</option>
        <?php
		$selQry="select * from tbl_district ";
		$row=$Con->query($selQry);
		while($data=$row->fetch_assoc())
		{
			?>
          <option
            value="<?php echo $data['district_id'] ?>"><?php echo $data['district_name']?></option>
          <?php
		}
		?>
     
      </select>
      </td>
      <td>Place</td>
        <label for="sel_place"></label>
       <td> <select name="sel_place" id="sel_place" onChange="gethouse(this.value)"> 
        <option value="">--select place--</option>
      </select></td>
      
    </tr>
   
  </table>
  <p>&nbsp;</p>
  <table width="200" border="1" id="result">
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
	$selQry="select * from tbl_house h inner join tbl_place p on h.place_id = p.place_id inner join tbl_district d on p.district_id=d.district_id inner join tbl_housetype ht on h.housetype_id = ht.housetype_id inner join tbl_type t on h.type_id = t.type_id WHERE h.type_id=2 and house_status=0";
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
      <td><a href="Gallery.php?Gid=<?php echo $data['house_id'] ?>">Gallery</a>
      
      <a href="Rent.php?Bid=<?php echo $data['house_id']?>">BOOK</a></td>
    </tr>
    <?php
	}
	?>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>


<script src="../Assets/JQ/jQuery.js"></script> 


<script>
    function getPlace(did) 
    {

        $.ajax({
        url:"../Assets/AjaxPages/AjaxPlace.php?did="+did,
        success: function(html){
            $("#sel_place").html(html);
        }
        });
    }
</script>
<script>
    function gethouse(did) 
    {

        $.ajax({
        url:"../Assets/AjaxPages/AjaxRent.php?did="+did,
        success: function(html){
            $("#result").html(html);
        }
        });
    }
</script>


 