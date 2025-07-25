<?php
include("../Connection/Connection.php");
session_start();


$uid = $_SESSION["uid"];
$ownerId = isset($_GET["ownerId"]) ? $_GET["ownerId"] : "";

$selQry = "SELECT * FROM tbl_chat 
           WHERE (from_uid = '$uid' AND to_oid = '$ownerId') 
           OR (from_oid = '$ownerId' AND to_uid = '$uid') 
           ORDER BY chat_datetime";
$result = $Con->query($selQry);
$currentDate = '';

while ($data = $result->fetch_assoc()) {
    $messageDate = date('Y-m-d', strtotime($data["chat_datetime"]));
    if ($messageDate != $currentDate) {
        $currentDate = $messageDate;
        echo "<div class='date-divider'>" . date('M d, Y', strtotime($currentDate)) . "</div>";
    }

    $isSent = $data["from_uid"] == $uid;
    $messageClass = $isSent ? "sent" : "received";
?>
    <div class="message <?php echo $messageClass ?>" data-chat-id="<?php echo $data['chat_id'] ?>">
        <?php if (!empty($data["chat_file"])) { ?>
            <div class="file-preview">
                <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $data["chat_file"])) { ?>
                    <img src="../Assets/Files/Chat/<?php echo $data["chat_file"] ?>" alt="Attachment">
                <?php } else { ?>
                    <a href="../Assets/Files/Chat/<?php echo $data["chat_file"] ?>" target="_blank">Download File</a>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="message-content"><?php echo $data["chat_content"] ?></div>
        <div class="message-time"><?php echo date('h:i A', strtotime($data["chat_datetime"])) ?></div>
        <?php if ($isSent) { ?>
            <span class="delete-btn" onclick="deleteMessage(<?php echo $data['chat_id'] ?>)">
                <i class="fas fa-trash"></i>
            </span>
        <?php } ?>
    </div>
<?php
}
?>
