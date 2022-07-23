<?php
require_once("config.php");
$driverID = $_POST["userID"];
$query = $con->prepare("SELECT * FROM location WHERE userID=:userID");
$query->bindParam(":userID", $driverID);
$query->execute();
$sqldata = $query->fetch(PDO::FETCH_ASSOC);
$latitude = $sqldata["latitude"];
$longitude = $sqldata["longitude"];
echo '{"lat":"'.$latitude.'", "lng":"'.$longitude.'"}';
?>