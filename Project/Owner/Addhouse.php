<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST['btn_submit']))
{
  $type=$_POST['sel_type'];
  $housetype=$_POST['sel_housetype'];
  $description=$_POST['txt_description'];
  $place=$_POST['sel_place'];
  $amount=$_POST['txt_amount'];
  
  $photo=$_FILES['file_photo']['name'];
  $path=$_FILES['file_photo']['tmp_name'];
  move_uploaded_file($path,"../Assets/Files/Owner/House/".$photo);
  
  $insQry="insert into tbl_house(type_id,housetype_id,house_description,place_id,house_amount,house_photo,house_postdate,owner_id)values('".$type."','".$housetype."','".$description."','".$place."','".$amount."','".$photo."',curdate(),'".$_SESSION['oid']."')";
  
  if($Con->query($insQry))
  {
    ?>
        <script>
    alert("Inserted");
    window.location="Addhouse.php";
    </script>
    <?php
  }

}
if(isset($_GET['Did']))
{
    $delQry="delete from tbl_house where house_id='".$_GET['Did']."' ";
    if($Con->query($delQry))
    {
        ?>
        <script>
        alert("Deleted");
        window.location="Addhouse.php";
        </script>
        <?php
    }
}

if(isset($_GET['Sid'])) {
    $soldQry = "update tbl_house set house_status=1 where house_id='".$_GET['Sid']."'";
    if($Con->query($soldQry)) {
        ?>
        <script>
        alert("House marked as Sold");
        window.location="Addhouse.php";
        </script>
        <?php
    }
}
?>
<!VDOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="200" border="1">
    <tr>
      <td width="80">Type</td>
      <td width="104"><label for="sel_type"></label>
        <select name="sel_type" id="sel_type">
        <option value="">--select type--</option>
         <?php
    $selQry="select * from tbl_type";
    $row=$Con->query($selQry);
    while($data=$row->fetch_assoc())
    {
      ?>
          <option
            value="<?php echo $data['type_id'] ?>"><?php echo $data['type_name']?></option>
          <?php
    }
    ?>
      </select></td>
    </tr>
    <tr>
      <td>House Type</td>
      <td><label for="sel_housetype"></label>
        <select name="sel_housetype" id="sel_housetype">
         <option value="">--select housetype--</option>
         <?php
    $selQry="select * from tbl_housetype";
    $row=$Con->query($selQry);
    while($data=$row->fetch_assoc())
    {
      ?>
            <option
            value="<?php echo $data['housetype_id'] ?>"><?php echo $data['housetype_name']?></option>
            <?php
    }
    ?>
      </select></td>
    </tr>
    <tr>
      <td>Description</td>
      <td><label for="txt_description"></label>
      <textarea name="txt_description" id="txt_description " cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>District</td>
      <td><label for="sel_district"></label>
        <select name="sel_district" id="sel_district" onChange="getPlace(this.value)">
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
      </select></td>
    </tr>
    <tr>
      <td>Place</td>
      <td><label for="sel_place"></label>
        <select name="sel_place" id="sel_place">
        <option value="">--select place--</option>
      </select></td>
    </tr>
    <tr>
      <td>Amount</td>
      <td><label for="txt_amount"></label>
      <input type="text" name="txt_amount" id="txt_amount" /></td>
    </tr>
    <tr>
      <td>Photo</td>
      <td><label for="file_photo"></label>
      <input type="file" name="file_photo" id="file_photo" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="200" border="1">
    <tr>
      <td>Sl No</td>
      <td>Type</td>
      <td>House Type</td>
      <td>Post Date</td>
      <td>Description</td>
      <td>Photo</td>
      <td>Amount</td>
      <td>District</td>
      <td>Place</td>
      <td>Action</td>
    </tr>
    <?php
  $i=0;
  $selQry="select * from tbl_house h inner join tbl_place p on h.place_id = p.place_id inner join tbl_district d on p.district_id=d.district_id inner join tbl_housetype ht on h.housetype_id = ht.housetype_id inner join tbl_type t on h.type_id = t.type_id  WHERE owner_id='".$_SESSION['oid']."' ";
  $row=$Con->query($selQry);
  while($data=$row->fetch_assoc())
  {
    $i++;
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['type_id']?></td>
      <td><?php echo $data['housetype_name']?></td>
      <td><?php echo $data['house_postdate']?></td>
      <td><?php echo $data['house_description']?></td>
      <td><img src="../Assets/Files/Owner/House/<?php echo $data['house_photo'] ?>" width="150" height="150" /></td>
      <td><?php echo $data['house_amount'] ?></td>
      <td><?php echo $data['district_name']?></td>
      <td><?php echo $data['place_name']?></td>
      <td>
        <a href="Addhouse.php?Did=<?php echo $data['house_id'] ?>">Delete</a>
        <a href="Gallery.php?Gid=<?php echo $data['house_id'] ?>">Gallery</a>
        <?php if($data['house_status'] != 1) { ?>
        <a href="Addhouse.php?Sid=<?php echo $data['house_id'] ?>">Set Sold</a>
        <?php } else { echo "<span style='color:red;'>Sold</span>"; } ?>
      </td>
    </tr>
    <?php
  }
  ?>
  </table>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>


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