<?php
include("../Connection/Connection.php");
session_start();


$from_oid = $_SESSION["oid"];

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $chatId =  $_GET['chat_id'];
    $delQry = "DELETE FROM tbl_chat WHERE chat_id = '$chatId' AND from_oid = '$from_oid'";
    echo $Con->query($delQry) ? "Message deleted" : "Deletion failed";
    
}

if (isset($_GET['action']) && $_GET['action'] === 'clear') {
    $to_uid =  $_GET["userId"];
    $delQry = "DELETE FROM tbl_chat 
               WHERE (from_oid = '$from_oid' AND to_uid = '$to_uid') 
                  OR (from_oid = '$to_uid' AND to_uid = '$from_oid')";
    echo $Con->query($delQry) ? "Chat cleared" : "Clear failed";
    
}

if (!isset($_POST['msg']) || !isset($_POST['userId'])) {
    echo "Invalid request";
    
}

$msg = trim($_POST['msg']);
$to_uid = $_POST['userId'];
$filePath = '';

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $targetDir = "../Files/Chat/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }
    $fileName = time() . "_" . basename($_FILES['file']['name']);
    $targetPath = $targetDir . $fileName;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
        $filePath = $fileName;
    } else {
        echo "File upload failed";
        
    }
}

if ($msg !== '' || $filePath !== '') {
    $insQry = "INSERT INTO tbl_chat (from_oid, to_uid, chat_content, chat_file, chat_datetime) 
               VALUES ('$from_oid', '$to_uid', '$msg', '$filePath', NOW())";
    echo $Con->query($insQry) ? "Message sent" : "Failed to send message";
} else {
    echo "Empty message";
}
?>
