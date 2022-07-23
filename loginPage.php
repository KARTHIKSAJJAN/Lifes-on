<?php
session_start();
if(isset($_SESSION["userID"]))
{
    $userID = $_SESSION["userID"];
    if($userID[0] == "T")
    {
?>
        <script>
            window.location = "homePageTraffic.php";
        </script>
<?php
    }
    else if($userID[0] == "D")
    {
?>
        <script>
            window.location = "homePageDriver.php";
        </script>
<?php
    }
    else if($userID[0] == "A")
    {
?>
        <script>
            window.parent.location = "admin.php";
        </script>
<?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Life's On - Login</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="loginPage.css">
    <link type = 'image/icon type' href='assets/ambulance.jpg' rel='icon'>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="utilities/login.php" method="POST" target="DummyFrame" id="loginForm">
                <h1>Sign in</h1>
                <input type="text" placeholder="ID" name="ID" required/>
                <input type="password" placeholder="Password" name="pwd" required/>
                <div class="alert alert-danger" role="alert" style="display:none;"></div>
                <div class="alert alert-success" role="alert" style="display:none;"></div>
                <button form = "loginForm" type="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <img alt="rate monitor" title="Life's on" src="assets/rateMonitor.gif">
                </div>
            </div>
        </div>
    </div>
    <iframe name="DummyFrame" style="display: none;"></iframe>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>