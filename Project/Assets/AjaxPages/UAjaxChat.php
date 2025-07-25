<?php
include("../Connection/Connection.php");
session_start();

if (!isset($_SESSION["uid"])) {
    echo "Unauthorized access";
    exit;
}

$uid =  $_SESSION["uid"];

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $chatId =  $_GET['chat_id'];
    $delQry = "DELETE FROM tbl_chat WHERE chat_id = '$chatId' AND from_uid = '$uid'";
    echo $Con->query($delQry) ? "Message deleted" : "Deletion failed";
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    $ownerId =  $_GET['ownerId'];
    $delQry = "DELETE FROM tbl_chat 
               WHERE (from_uid = '$uid' AND to_oid = '$ownerId') 
               OR (from_uid = '$ownerId' AND to_uid = '$uid')";
    echo $Con->query($delQry) ? "Chat cleared" : "Clear failed";
    exit;
}

if (!isset($_POST['msg']) || !isset($_POST['ownerId'])) {
    echo "Invalid request";
    exit;
}

$msg =  trim($_POST['msg']);
$ownerId =  $_POST['ownerId'];
$filePath = '';

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = [
        'image/jpeg', 'image/png', 'image/gif', 'image/jpg',
        'application/pdf', 'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/x-zip-compressed', 'application/zip'
    ];
    $fileType = $_FILES['file']['type'];
    $fileSize = $_FILES['file']['size'];
    $maxFileSize = 5 * 1024 * 1024; 

    if (in_array($fileType, $allowedTypes) && $fileSize <= $maxFileSize) {
        $targetDir = "../Files/Chat/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $fileName = time() . "_" . basename($_FILES["file"]["name"]);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            $filePath = $fileName;
        } else {
            echo "File upload failed";
            exit;
        }
    } else {
        echo "Invalid file type or size";
        exit;
    }
}

// Check for duplicate message
$checkQry = "SELECT * FROM tbl_chat 
             WHERE from_uid = '$uid' 
             AND to_oid = '$ownerId' 
             AND chat_content = '$msg' 
             AND chat_file = '$filePath' 
             AND chat_datetime > NOW() - INTERVAL 1 MINUTE";
$checkResult = $Con->query($checkQry);

if ($checkResult->num_rows == 0 && ($msg !== '' || $filePath !== '')) {
    $insQry = "INSERT INTO tbl_chat (from_uid, to_oid, chat_content, chat_file, chat_datetime) 
               VALUES ('$uid', '$ownerId', '$msg', '$filePath', NOW())";

    if ($Con->query($insQry)) {
        echo "Message sent";
    } else {
        echo "Failed to send message";
    }
} else {
    echo "Duplicate message ignored";
}
?>
