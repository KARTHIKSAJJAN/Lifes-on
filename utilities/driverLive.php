<?php
require_once("config.php");
session_start();
$userID = $_SESSION["userID"];
$status = "Active";
$query = $con->prepare("SELECT * FROM location WHERE userID=:userID");
$query->bindParam(":userID", $userID);
$query->execute();
if($query->rowCount()==0)
{
    $query1 = $con->prepare("INSERT INTO location (userID, latitude, longitude, liveStatus) VALUES (:userID, :lat, :lng, 'active')");
    $query1->bindParam(":userID", $userID);
    $query1->bindParam(":lat", $_POST["latitude"]);
    $query1->bindParam(":lng", $_POST["longitude"]);
    $query1->execute();
}
else
{
    $query2 = $con->prepare("UPDATE location SET latitude=:lat, longitude=:lng, liveStatus='active' WHERE userID=:userID");
    $query2->bindParam(":userID", $userID);
    $query2->bindParam(":lat", $_POST["latitude"]);
    $query2->bindParam(":lng", $_POST["longitude"]);
    $query2->execute();
}
?>