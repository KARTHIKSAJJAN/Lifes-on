<?php
require_once("config.php");
session_start();
$userID = $_SESSION["userID"];
$status = "Inactive";
$query = $con->prepare("UPDATE location SET liveStatus='inactive' WHERE userID=:userID");
$query->bindParam(":userID", $userID);
$query->execute();
session_destroy();
?>
<script>
    window.parent.location = "../loginPage.php";
</script>