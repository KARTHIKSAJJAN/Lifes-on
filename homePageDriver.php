<?php
require_once("utilities/config.php");
session_start();
if(isset($_SESSION["userID"]))
{
    if($_SESSION["userID"][0]!="D")
    {
        exit;
    }
}
else
{
    exit;
}
$page = new Page($con);
echo $page->renderPage();
class Page
{
    private $con;
    public function __construct($con)
    {
        $this->con = $con;
    }
    public function renderPage()
    {
        $query1 = $this->con->prepare("SELECT * FROM users WHERE userID=:userID");
        $query1->bindParam(":userID", $_SESSION["userID"]);
        $query1->execute();
        $sqldata1 = $query1->fetch(PDO::FETCH_ASSOC);
        $userName = $sqldata1["name"];
        $ambulance_no = $sqldata1["amb_no"];
        return "
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Life's On</title>
  <link rel='stylesheet' type='text/css' href='homePage.css'>
  <link type = 'image/icon type' href='assets/ambulance.jpg' rel='icon'>
</head>
<body>
  <div class='wrapper'>
    <div class='main-container'>
      <div class='header'>
        <div class='logo'>
          <p>LIFE'S ON</p><img src='assets/ambulance.gif' alt='ambulance' />
        </div>
        <div class='user-info'>
          <a href='mailto:karthiksajjan1@gmail.com' title='Send Feedback'><svg viewBox='0 0 512 512' fill='currentColor'><path d='M467 76H45a45 45 0 00-45 45v270a45 45 0 0045 45h422a45 45 0 0045-45V121a45 45 0 00-45-45zm-6.3 30L287.8 278a44.7 44.7 0 01-63.6 0L51.3 106h409.4zM30 384.9V127l129.6 129L30 384.9zM51.3 406L181 277.2l22 22c14.2 14.1 33 22 53.1 22 20 0 38.9-7.9 53-22l22-22L460.8 406H51.3zM482 384.9L352.4 256 482 127V385z' /></svg></a>
          <a href='utilities/signout.php' target='DummyFrame' title='Sign out'><svg viewBox='0 0 512 512' fill='currentColor'><path d='M255.2 468.6H63.8a21.3 21.3 0 01-21.3-21.2V64.6c0-11.7 9.6-21.2 21.3-21.2h191.4a21.2 21.2 0 100-42.5H63.8A63.9 63.9 0 000 64.6v382.8A63.9 63.9 0 0063.8 511H255a21.2 21.2 0 100-42.5z' /><path d='M505.7 240.9L376.4 113.3a21.3 21.3 0 10-29.9 30.3l92.4 91.1H191.4a21.2 21.2 0 100 42.6h247.5l-92.4 91.1a21.3 21.3 0 1029.9 30.3l129.3-127.6a21.3 21.3 0 000-30.2z' /></svg></a>
        </div>
      </div>
      <div class='user-box first-box'>
        <div class='activity card' style='--delay: .2s'>
          <div class='title'>Your Current Location</div>
          <div id='map-canvas'></div>
          <div class='button offer-button' id='offerButton' onclick='togglelive();'>Share Live Location to the Authorities</div>
        </div>
        <div class='account-wrapper' style='--delay: .8s'>
          <div class='account card'>
            <div class='account-cash'>$userName</div>
            <div class='account-income'>$ambulance_no</div>
          </div>
        </div>
      </div>
    </div>
    <iframe name='DummyFrame' style='display: none;'></iframe>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://maps.googleapis.com/maps/api/js?key=<API_KEY>&callback=initialize&libraries=&v=weekly' async></script>
    <script src='homePageDriver.js'></script>
</body>
</html>";
    }
}
?>
