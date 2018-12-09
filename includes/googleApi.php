<?php
require_once('init/init.php');
 
$today = date("y.m.d");
$today = str_replace('.', '-', $today);

global $session;
global $database; 
if(!$session->get_user_order())
{
    header("Location: 404.html");
}
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Concierge</title>
  
  
  
      <link rel="stylesheet" href="../css/googleApi.css">

  
</head>

<body>

  <head>
          <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnzFDdFG0QXSxS5iuYzvGzUFIKq3Ov6YU&libraries=places"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw=="
  crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

</head>
<header>
  <nav>
<a id="resp-menu" class="responsive-menu" href="#"><i class="fa fa-reorder"></i> Menu</a>    
   <ul class="menu">
   <li><a href="homePage.php"><i class="fa fa-home"></i> HOME</a>

   </li>
  <li><a  href="howItWorks.php"><i class="fa fa-info-circle"></i> HOW IT WORKS</a></li>
  <li><a  href="#"><i class="fa fa-cutlery"></i> RESTAURANT</a>
  <ul class="sub-menu">
   <li><a href="newRest.php">Room service</a></li>
   <li><a href="breakfast.php">Reservation for meals</a>
   </li>
   </ul>
  </li>
    <li><a  href="#"><i class="fa fa-wrench"></i> SERVICES</a>
  <ul class="sub-menu">
   <li><a href="Services.php">Housekeeping & maintenance</a></li>
   <li><a href="tuktukOrder.php">Tuktuk order</a> </li>
     <li><a href="googleApi.php">Concierge</a></li>
   </ul>
  </li>
  <li><a  href="checkout.php"><i class="fa fa-credit-card"></i> CHECK OUT</a></li>
  <li><a  href="init/logout.php"><i class="fa fa-sign-out"></i> LOGOUT</a></li>
  </ul>
  </nav>
</header>
<body style="width:100vw; height:100vh; background-color:white;display: inline-block; color:lightgrey; overflow:hidden">
      <a id="nav-toggle" href="#" class="active" style="z-index:1000; margin:10px;"><img id="magnif" src="https://vignette.wikia.nocookie.net/deusex/images/9/9b/Magnifying_glass_icon.png/revision/latest?cb=20141205155051&path-prefix=en"></a>

  <div id="searchDD">
    <h1 style="left:25%; color:white;margin: auto;width: 60%; font-family:Kanit;" class="hidable">Search nearby places</h1>
    <div id="type-container" class="form-group hidable" style="height:35px;  margin:30px 30px 0 30px;">
      <i class="fa fa-chevron-left hidable carousel-nav"  href="#typecarousel" role="button" data-slide="prev"></i>
      <div style="width:90%;float:left; margin:0;" id="typecarousel" class="carousel slide" data-ride="carousel" data-interval="false">
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <div class="types" type="travel_agency">Travel agency</div>
            <div class="types activeType" type="restaurant">Restaurants</div>
            <div class="types" type="night_club">Night club</div>
            <div class="types" type="taxi_stand">Taxi station</div>
          </div>
          <div class="item">
            <div class="types" type="bank">Bank</div>
            <div class="types" type="bar">Bar</div>
            <div class="types" type="car_rental">Car Rental</div>
            <div class="types" type="convenience_store">Mini Mart</div>
          </div>
          <div class="item ">
            <div class="types" type="gas_station">Gas Station</div>
            <div class="types" type="gym">Gym</div>
            <div class="types" type="hospital">Hospital</div>
            <div class="types" type="shopping_mall">Mall</div>
          </div>
          <div class="item ">
            <div class="types" type="university">University</div>
            <div class="types" type="pharmacy">pharmacy</div>
            <div class="types" type="doctor">Doctor</div>
            <div class="types" type="church">Church</div>
          </div>
          <div class="item ">
            <div class="types" type="parking">Parking</div>
            <div class="types" type="clothing_store">Clothing</div>
            <div class="types" type="movie_theater">Theater</div>
            <div class="types" type="synagogue">synagogue</div>
          </div>
        </div>
      </div>
        <i class="fa fa-chevron-right hidable carousel-nav"  href="#typecarousel" role="button" data-slide="next" ></i>
      </div>
      <div class="form-group hidable" style="margin:0 30px;">
        <div class="input-group">
          <span class="input-group-btn">
            <button class="btn thePerfectTeal" id="submit" onclick="get_loc();" type="button" id="submit">Search</button>
          </span>
          <input type="text" class="form-control" id="user_loc"  placeholder="Please enter your location">
        </div>
      </div>
      <!--Form Group-->
      <div class="divider hidable"></div>
      <div id="links" class="hidable">

      </div>
    </div>
    <!-- SearchDD-->
    <div id="mapPanel">
      <div id="map"></div>
    </div>
    <!-- mapPanel -->

  

    <script  src="../js/googleApi.js"></script>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="../js/newMenu.js"></script>


</body>

</html>

 