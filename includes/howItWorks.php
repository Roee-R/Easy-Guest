<?php
require_once('init/init.php');
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
  <title>How it works</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>

      <link rel="stylesheet" href="../css/howItWorks.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.css">
  
</head>

<body>
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
<div class="container con-main">
  <div class="col-md-6 move-layout">
    <div>
      <h1>
      Registration for meals
    </h1>
    <p>
        In this process you can reserve a seat for you and for the other guests you came with.
        First of all, you have to choose how many persons you are planning to come, than
        you have to select the date of the meal at the end choose the type of the meal you want and wait for the approvement. 
    </p>  
    </div>
  </div>
  
  <div class="col-md-6 ">
 <img src="../images/meals.png" height="520px" width="220px">

  </div>
</div>

<!--second container !-->
<div class="container con-second">

  <div class="col-md-6 move-layout">
    <div>
      <h1>
     Room service
    </h1>
    <p>
In this process you have the option to order room service, you are welcome to view our varied menu, add to your order the items requested and send the request. After the request is approved a hotel employee will arrive at the door of your room with food and drinks.    </p>
    </div>
    
  </div>
     <div class="col-md-6 ">
    
 <img src="../images/roomService.png" height="520px" width="220px">
  </div>

 
</div>

<!--third container!-->
<div class="container con-main">
  <div class="col-md-6 move-layout">
    <div>
      <h1>
Concierge    </h1>
    <p>
Looking for a bar near our hotel? or maybe a good restaurant? now you have the opportunity to choose the place by yourself, with our concierge system that will provide you rates and direction to the place you want to go to. Just click your location and our system will show you all the nearby places.    </p>  
    </div>
    
  </div>
  <div class="col-md-6">
    
 <img src="../images/maps.png" height="520px" width="220px">

    
  </div>
</div>
<div class="container con-main">
  <div class="col-md-6 move-layout">
    <div>
      <h1>Services</h1>
    <p>
Choose one of the options offered: laundry, housekeeping, or maintenance service.<br>
<b>Laundry or cleaning services:</b> choose the time you want to order the cleaning or laundry service and submit the request.<br>
<b>Housekeeping:</b> Mark the products you wish to order to your room and submit your request.<br>
<b>Maintenance Services</b>: Mark the technical problem that you have in the room and send the request and a technician will come to you as soon as possible.
*For all processes you can add comments.    </p>  
    </div>
    
  </div>
  <div class="col-md-6">
    
 <img src="../images/service.png" height="520px" width="220px">

    
  </div>
</div>
<div class="container con-main">
  <div class="col-md-6 move-layout">
    <div>
      <h1>
Tuktuk order    </h1>
    <p>
You can use the hotel's shuttle service by filling in your location information and the pick-up time. You can order tuktuk every fifteen minutes and only between the dates you stay at the hotel.    </p>  
    </div>
  </div>
  <div class="col-md-6">
 <img src="../images/tuktuk.png" height="520px" width="220px">
  </div>
</div>
<div class="container con-main">
  <div class="col-md-6 move-layout">
    <div>
      <h1>
Check-out    </h1>
    <p>
At the end of the vacation you can check-out through the system. You'll first see all of your charges, then proceed to the payment area. Within the payment area you have the option to pay using 3 types of credit cards Visa, Master Card or Discovery and the possibility to pay with PayPal.    </p>  
    </div>
    
  </div>
  <div class="col-md-6">
    
 <img src="../images/checkout.png" height="520px" width="220px">

    
  </div>
</div>
  
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="../js/newMenu.js"></script>

</body>
</html>
