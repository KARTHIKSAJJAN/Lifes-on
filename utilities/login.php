<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<?php
require_once("config.php");
session_start();
$userID = $_POST["ID"];
$password = $_POST["pwd"];
$query = $con->prepare("SELECT * FROM users WHERE userID=:userID AND pwd=:pwd");
$query->bindParam(":userID", $userID);
$query->bindParam(":pwd", $password);
$query->execute();
if($query->rowCount()==0)
{?>
    <script>
        $('.alert-success', window.parent.document).hide();
        $('.alert-danger', window.parent.document).text("Not a valid login credential!");
        $('.alert-danger', window.parent.document).show();
    </script>
<?php
}
else if($userID[0] == "T")
{
    $_SESSION["userID"] = $userID;
    $_SESSION["password"] = $password;
?>
    <script>
        $('.alert-danger', window.parent.document).hide();
        $('.alert-success', window.parent.document).text("Signing in!");
        $('.alert-success', window.parent.document).show();
        window.parent.location = "../homePageTraffic.php";
    </script>
<?php
}
else if($userID[0] == "D")
{
    $_SESSION["userID"] = $userID;
    $_SESSION["password"] = $password;
?>
    <script>
        $('.alert-danger', window.parent.document).hide();
        $('.alert-success', window.parent.document).text("Signing in!");
        $('.alert-success', window.parent.document).show();
        window.parent.location = "../homePageDriver.php";
        </script>
<?php
}
else if($userID[0] == "A")
{
    $_SESSION["userID"] = $userID;
    $_SESSION["password"] = $password;
?>
    <script>
        $('.alert-danger', window.parent.document).hide();
        $('.alert-success', window.parent.document).text("Signing in!");
        $('.alert-success', window.parent.document).show();
        window.parent.location = "../admin.php";
    </script>
<?php
}
?>