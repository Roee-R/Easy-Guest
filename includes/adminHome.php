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
  <title>Admin home page</title>
  
  
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
<link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.min.css'>
<link rel='stylesheet prefetch' href='http://rawgit.com/vitalets/x-editable/master/dist/bootstrap3-editable/css/bootstrap-editable.css'>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="jquery-3.3.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Montserrat:300,400'>
<link rel='stylesheet prefetch' href='http://use.fontawesome.com/releases/v5.0.10/css/all.css'>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.5.2/metisMenu.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/3.3.7/css/sb-admin-2.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css'>
<link rel='stylesheet prefetch' href='https://s3-us-west-2.amazonaws.com/s.cdpn.io/416491/timeline.css'>
        <link rel="stylesheet" href="../css/newTuk.css">
<style>
    .heading {
  font-family: "Montserrat", sans-serif;
  font-weight: 300;
  font-size: 14px;
  color: #222;
  -webkit-font-smoothing: antialiased;
  margin: 0;
}
.container {
  margin: 0 auto;
  width: 60% !important;
  float: none;
  min-height: 1px;
  height: 100%;
}
.heading {
  text-align: center;
  margin: 0 auto;
  font-size: 3.5em;
}
.counter{
  display: flex;
  margin-top: 3%;
  flex-direction: row;
  flex-wrap: wrap;
}
.counter .item{
  vertical-align: middle;
  width: 25%;
  height: 100%;
  text-align: center;
  padding: 0;
  margin: 0;
}
.counter .item i{
  color: rgba(25, 25, 25, 0.9);
  font-size: 4em;
  text-shadow: 1px 1px 1px #ccc;
}
.counter .item p.number{
  color: rgba(21, 21, 21, 1.0);
  font-size: 3em;
  text-shadow: 1px 1px 1px #ccc;
}
.counter .item p.label{
  color: rgba(25, 25, 25, 0.9);
  font-size: 1.1em;
  text-shadow: 1px 1px 1px #ccc;
  text-transform: lowercase;
}
.counter .item:hover i, 
.counter .item:hover p{
  color: rgba(10, 10, 10, 1.0);
}

@media (max-width: 1050px){
  .counter .item {
     flex: 0 0 50%;
     padding-top:50px;
  }
}
</style>
</head>

<body>

  <div id="wrapper">

  <!-- Navigation -->
   <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
      <a class="navbar-brand" href="adminHome.php">Admin panel EasyGuest</a>
    </div>


    <div class="navbar-default sidebar" role="navigation">
      <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

          <li>
            <a href="adminHome.php"><i class="fa fa-dashboard fa-fw"></i> Home</a>
          </li>

          <li>
            <a href="#"><i class="fa fa-table fa-fw"></i> Tables<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a href="tableTuktuk.php">Tuktuk</a>
              </li>
              <li>
                <a href="restOrderTable.php">Restaurant</a>
              </li>
              <li>
                <a href="houseKeepingTable.php">HouseKeeping</a>
              </li>
              <li>
                <a href="MaintanceTable.php">Maintenance</a>
              </li>
               <li>
                <a href="guestTable.php">Guests</a>
              </li>
                 <li>
                <a href="mealsTable.php">Meals</a>
              </li>
                <li>
                <a href="paymentTable.php">Payment</a>
              </li>
            </ul>
          </li>
   
          <li>
            <a href="#"><i class="fa fa-archive"></i> Archive<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a href="tukArchive.php">Tuktuk</a>
              </li>
              <li>
                <a href="restOrderArchive.php">Restaurant</a>
              </li>
              <li>
                <a href="houseKeepingArchive.php">HouseKeeping</a>
              </li>
              <li>
                <a href="MaintanceArchive.php">Maintenance</a>
              </li>
                   <li>
                <a href="guestArchive.php">Guests</a>
              </li>
            </ul>
            <!-- /.nav-second-level -->
          </li>
           <li>
            <a href="init/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
          </li>
        </ul>
      </div>
      <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
  </nav>

  <div id="page-wrapper" style="margin-top: -20px"><br>
  <h1 class="heading">EasyGuest admin system</h1><br><br>
  <div class="counter ">
    <div class="item">
      <i class="fa fa-group"></i>
      <p id="number1" class="number">0</p>
      <p class="label">Check-in</p>
    </div>
    <div class="item">
      <i class="fa fa-suitcase"></i>
      <p id="number2" class="number">0</p>
      <p class="label">Check-out</p>
    </div>
    <div class="item">
      <i class="fa fa-cutlery"></i>
      <p id="number3" class="number">0</p>
      <p class="label">Breakfast reservations</p>
    </div>
 
    <div class="item">
      <i class="fa fa-bed"></i>
      <p id="number4" class="number">0</p>
      <p class="label">Number of current guests</p>
    </div>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js'></script>

  
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.5.2/metisMenu.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.1/raphael.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/3.3.7/js/sb-admin-2.js'></script>
<script src='https://cdn.knightlab.com/libs/timeline3/latest/js/timeline.js'></script>

  


    <script  src="../js/newTuk.js"></script>
<script>
    $.fn.jQuerySimpleCounter = function( options ) {
  var settings = $.extend({
    start:  0,
    end:    100,
    easing: 'swing',
    complete: ''
  }, options );

  var thisElement = $(this);

  $({count: settings.start}).animate({count: settings.end}, {
    duration: settings.duration,
    easing: settings.easing,
    step: function() {
      var mathCount = Math.ceil(this.count);
      thisElement.text(mathCount);
    },
    complete: settings.complete
  });
};

$('#number1').jQuerySimpleCounter({end: "<?php 
$date= date("Y-m-d");
 $sql = "SELECT * FROM guestOrder WHERE checkInDate='$date'";
$result = $database->query($sql);
echo $result->num_rows;?>",duration: 1000});

$('#number2').jQuerySimpleCounter({end:"<?php 
$date= date("Y-m-d");
 $sql = "SELECT * FROM guestOrder WHERE checkOutDate='$date'";
$result = $database->query($sql);
echo $result->num_rows;?>"
,duration: 1000});

$('#number3').jQuerySimpleCounter({end:"<?php 
$date= date("Y-m-d");
 $sql = "SELECT * FROM meals WHERE date='$date' and mealsType='Breakfast';";
$result = $database->query($sql);
echo $result->num_rows;?>"
,duration: 1000});


$('#number4').jQuerySimpleCounter({end:"<?php 
$date= date("Y-m-d");
 $sql = "SELECT *  FROM guestOrder WHERE checkInDate<='$date' and checkOutDate>='$date';";
$result = $database->query($sql);
$qty= 0;
while ($num = $result->fetch_assoc())
{
   $qty+=$num['numOfPeople'];
}
echo $qty;
?>"
,duration: 1000});

</script>
</body>

</html>
