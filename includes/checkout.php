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
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
    } 
	    $userOrder=$session->get_user_order();


$row=$database->query("select * from guestOrder where orderNumber='$userOrder'");
while ($guest_row = $row->fetch_assoc()) {
    $firstName=$guest_row["firstName"];
$order_num=$guest_row["orderNumber"];

$lastName=$guest_row["lastName"];
$typeRoom=$guest_row["typeRoom"];
$checkInDate=$guest_row["checkInDate"];
$checkOutDate=$guest_row["checkOutDate"];
$userId=$guest_row["id"];

}


if (json_decode(stripslashes(file_get_contents("php://input")))) {
// build a PHP variable from JSON sent using POST method
$paymentInf = json_decode(stripslashes(file_get_contents("php://input")));

// encode the PHP variable to JSON and send it back on client-side
$row = get_object_vars($paymentInf);
$fname= $row['first_name'];
$lname= $row['last_name'];
$total= $row['total_payment'];
$email= $row['email'];

$type="paypal";
$sql=$database->query("INSERT INTO guestPayments (guestId,firstName, lastName, email, totalPay,purchaseDate,type) VALUES ('$userOrder','$fname','$lname','$email','$total','$today','$type')");
if($sql){
    
            $update_archive="insert into archiveGuest (orderNumber,id,firstName,lastName,typeRoom,checkInDate,checkOutDate)
            values ('$order_num','$userId','$firstName','$lastName','$typeRoom','$checkInDate','$checkOutDate')";
    
             $move_to_archive_rest =   "INSERT INTO restOrdersArchive( SELECT * FROM restOrders WHERE '$order_num'=guestOrderNum)";
            $remove_from_rest="DELETE FROM restOrders
            WHERE user='$userOrder'";

          $move_to_archive_maintance=   "INSERT INTO MaintanceArchive( SELECT * FROM Maintance WHERE '$order_num'=user)";
            $remove_from_maintance="DELETE FROM Maintance
            WHERE user='$userOrder'";
            
            $move_to_archive_houseKepping= "INSERT INTO houseKeepingArchive( SELECT * FROM houseKeeping WHERE '$order_num'=user)";
            $remove_from_houseKeeping="DELETE FROM houseKeeping
            WHERE user='$userOrder'";


            $remove_from_meals="DELETE FROM meals
            WHERE user='$userOrder'";
            
             $move_to_archive_tuktukOrders =   "INSERT INTO tuktukArchive( SELECT * FROM tuktukOrders WHERE '$order_num'=orderNum)";
            $remove_from_tuktukOrders="DELETE FROM tuktukOrders
            WHERE user='$userOrder'";
            
            
            $remove_from_guestRooms="DELETE FROM guestRooms
            WHERE currentGuest='$userOrder'";


            $remove_from_guest_order="DELETE FROM guestOrder
            WHERE orderNumber='$userOrder'";
            
            
            $remove_from_guest="DELETE FROM Guests
            WHERE orderNumber='$userOrder'";

     $database->query($move_to_archive_rest);
              $database->query($move_to_archive_maintance);
               $database->query($move_to_archive_houseKepping);
                $database->query($move_to_archive_tuktukOrders);
                
            $database->query($remove_from_houseKeeping);

            $database->query($remove_from_rest);
            $database->query($remove_from_tuktukOrders);
            $database->query($remove_from_maintance);
            $database->query($remove_from_meals);
            $database->query($remove_from_guestRooms);
            $database->query($remove_from_houseKeeping);

            $database->query($remove_from_guest);
            $database->query($remove_from_guest_order);
            $database->query($update_archive);

            echo "success";
}
		else
		     echo "query failed";

}

if(isset($_POST["total"]))
	{

$total=$_POST["total"];
	    $order_num=$session->get_user_order();

		$name = $_POST['orderName'];
		$date = $_POST['date'];
		$type="credit card";
        $totalsql="INSERT INTO guestPayments (guestId,firstName, lastName, email, totalPay,purchaseDate,type) VALUES ('$userId','$fname','$lname','$email','$total','$today','$type')";

if($database->query($totalsql)){
$update_archive="insert into archiveGuest (orderNumber,id,firstName,lastName,typeRoom,checkInDate,checkOutDate)
            values ('$order_num','$userId','$firstName','$lastName','$typeRoom','$checkInDate','$checkOutDate')";
    
             $move_to_archive_rest =   "INSERT INTO restOrdersArchive( SELECT * FROM restOrders WHERE '$order_num'=guestOrderNum)";
            $remove_from_rest="DELETE FROM restOrders
            WHERE user='$userOrder'";

          $move_to_archive_maintance=   "INSERT INTO MaintanceArchive( SELECT * FROM Maintance WHERE '$order_num'=user)";
            $remove_from_maintance="DELETE FROM Maintance
            WHERE user='$userOrder'";
            
            $move_to_archive_houseKepping= "INSERT INTO houseKeepingArchive( SELECT * FROM houseKeeping WHERE '$order_num'=user)";
            $remove_from_houseKeeping="DELETE FROM houseKeeping
            WHERE user='$userOrder'";


            $remove_from_meals="DELETE FROM meals
            WHERE user='$userOrder'";
            
             $move_to_archive_tuktukOrders =   "INSERT INTO tuktukArchive( SELECT * FROM tuktukOrders WHERE '$order_num'=orderNum)";
            $remove_from_tuktukOrders="DELETE FROM tuktukOrders
            WHERE user='$userOrder'";
            
            
            $remove_from_guestRooms="DELETE FROM guestRooms
            WHERE currentGuest='$userOrder'";


            $remove_from_guest_order="DELETE FROM guestOrder
            WHERE orderNumber='$userOrder'";
            
            
            $remove_from_guest="DELETE FROM Guests
            WHERE orderNumber='$userOrder'";

     $database->query($move_to_archive_rest);
              $database->query($move_to_archive_maintance);
               $database->query($move_to_archive_houseKepping);
                $database->query($move_to_archive_tuktukOrders);
                
            $database->query($remove_from_houseKeeping);

            $database->query($remove_from_rest);
            $database->query($remove_from_tuktukOrders);
            $database->query($remove_from_maintance);
            $database->query($remove_from_meals);
            $database->query($remove_from_guestRooms);
            $database->query($remove_from_houseKeeping);

            $database->query($remove_from_guest);
            $database->query($update_archive);
            if($database->query($remove_from_guest_order))
                $status="success";
            else
                 $status="failed";

}	
		else
		     $status="failed";
echo $status;
}



if(isset($_POST["checkout"])){
    $userId=$session->get_user_order();
    $check_out_sql="select checkOutDate from guestOrder where '$userId'=orderNumber";
    $check_out_sql_ans=$database->query($check_out_sql);
    $check_out=$check_out_sql_ans->fetch_assoc()["checkOutDate"];
    echo $check_out;
}



?>


<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <script src="https://www.paypalobjects.com/api/checkout.js"></script>
 <script src='jquery-1.12.0.min.js' type='text/javascript'></script>
 <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet'/>
      <link rel="stylesheet" href="../css/payment.css">
      <link rel="stylesheet" href="../css/Checkout.css">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

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


<?php

$unitMessage="";
$itemsMessage="";
$userName=$session->get_user_order();


$room_price="SELECT hotelRooms.price,hotelRooms.name
FROM hotelRooms
INNER JOIN guestRooms ON hotelRooms.Room_Number=guestRooms.Room 
where guestRooms.currentGuest='$userName';
";

$roomPriceResult = $database->query($room_price);

if ($roomPriceResult->num_rows > 0) {
    
    $sum="SELECT SUM(prodCount) AS Count FROM restOrders";

if($database->query($sum)){
    $sumResult = $database->query($sum);
    $totalCount=$sumResult->fetch_assoc()["Count"];
}    

    
$sql = "SELECT * FROM restOrdersArchive where user=$userName";
$result = $database->query($sql);


$itemsMessage="Tottal for item";


$roomRow = $roomPriceResult->fetch_assoc();

$guest = "SELECT * FROM guestOrder where orderNumber=$userName";
$guestResult = $database->query($guest);
$guestRowDays = $guestResult->fetch_assoc()['daysNumber'];

$totalForRoom=$roomRow["price"]*$guestRowDays;

echo " 
<div class='cart'>  
    <div class='cart-top'>
      <h2 class='cart-top-title'>Checkout</h2>
      <div class='cart-top-info'>$itemsMessage</div>
    </div>
";    

echo "
    <ul>
      <li class='cart-item lodg'>
        <span class='cart-item-pic'>Lodging
        </span>
        <span class='cart-item-name'>".$roomRow["name"]."</span>
        <span class='cart-item-desc'>".$roomRow["price"]."$ $guestRowDays Days  </span>
        <span class='cart-item-price'>$totalForRoom$</span>
      </li>

";

    // output data of each row
    while($row = $result->fetch_assoc()) {
$row["prodCount"]>1 ? $unitMessage="Units" : $unitMessage="Unit";


echo "
      <li class='cart-item'>
        <span class='cart-item-pic'>Room <br> service
        </span>
        <span class='cart-item-name'>".$row["prodName"]."</span>
        <span class='cart-item-desc'>".$row["prodPrice"]."$ ".$row["prodCount"]." $unitMessage  </span>
        <span class='cart-item-price'>".$row["prodTottal"]."$</span>
      </li>


";

}

$meals = "SELECT * FROM meals where user=$userName";
$meals_result = $database->query($meals);
while($row = $meals_result->fetch_assoc()) {
    $row["numberOfPersons"]>1 ? $person_num="Persons" : $person_num="Person";

echo "
      <li class='cart-item'>
        <span class='cart-item-pic'>Meals
        </span>
        <span class='cart-item-name'>".$row["mealsType"]."</span>
        <span class='cart-item-desc'>".$row["price"]."$ ".$row["numberOfPersons"]." $person_num</span>
        <span class='cart-item-price'>".$row["tottal"]."$</span>
      </li>
";
}
   echo  "</ul>";

$meals_sum="SELECT SUM(price) AS price,tottal FROM meals where user=$userName";

$sum="SELECT SUM(prodTottal) AS total FROM restOrdersArchive where user=$userName";
if($database->query($sum)){
    $sumResult = $database->query($sum);
    $total=$sumResult->fetch_assoc()["total"]+$totalForRoom;
    if($database->query($meals_sum)){
        $meals_sum_result = $database->query($meals_sum);
        $total=$meals_sum_result->fetch_assoc()["tottal"]+$total;
    }
}


echo " 
<div class='cart-bottom'>
      <h3 class='cart-top-title'>Total: $total$</h3>
      <button href='#' onclick=\"showPayment()\" class='cart-button'>Continue</button>
    </div>
  </div> 
";

}
  ?>
     

<!--transfer total bil to js-->
<div id="dom-target" style="display: none;">
    <?php 
         //Again, do some operation, get the output.
        echo htmlspecialchars($total); /* You have to escape because the result
                                           will not be valid HTML otherwise. */
    ?>
</div>
<div class="container">
    <button id="back" onClick="checkOut()">Back</button>
  <div class='checkout'>
  <div class='info'>
    <h1 class="Available" style="font-size:20px; color:white; ">Payment Method</h1>
  </div>
  <form class='modal'>

    <header class='header'>
     <h1><?php echo "Total bill is: $total$"; ?></h1><br>
      <div class='card-type'>
                  <a class='card1 active' href='#'>
          <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/Discover.png'>
        </a>
        <a class='card1' href='#'>
          <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/Visa.png'>
        </a>
        <a class='card1' href='#'>
          <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/MC.png'>
        </a>
        <a class='card2' href='#'>
          <img src='https://www.paypalobjects.com/webstatic/mktg/logo-center/PP_Acceptance_Marks_for_LogoCenter_76x48.png' height="37">
        </a>

      </div>
    </header>
        <div class='content1'>
            <br><br>
        <div id="paypal-button-container"></div>

</div>
    <div class='content'>
      <div class='form'>
        <div class='form-row'>
          <div class='input-group'>
            <label for=''>Name on card</label>
            <input id="name" name="name" placeholder='' type='text'>
          </div>

          
        </div>
        <div class='form-row'>
          <div class='input-group'>
            <label for=''>Card Number</label>
            <input name="number" maxlength='16' placeholder='' type='number'>
          </div>
        </div>
        <div class='form-row'>
          <div class='input-group'>
            <label for=''>Expiry Date</label>
            <input class="expire" name="date" placeholder='' type='month'>
          </div>
          <div class='input-group'>
            <label for=''>CVV</label>
            <input class="cvv" maxlenght='4' placeholder='' type='number'>
          </div>
          
        </div>
      </div>
    </div>
    <footer class='footer'>
      <button name="button" class='button'>Complete Payment</button>
    </footer>
</div>
</form>
  

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    </div></div>

</body>
<script>

function showPayment() {
var xhr = new XMLHttpRequest();
xhr.open("POST", "checkout.php", true);
//Send the proper header information along with the request
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

xhr.onreadystatechange = function() {//Call a function when the state changes.
    if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
        var index=this.responseText.indexOf("!DOC");    
        var newResponse=this.responseText.substr(1, index)
        var dateObj = new Date().toISOString().split('T')[0];
        if(newResponse.includes(dateObj)){
        document.getElementsByClassName('cart')[0].style.display = 'none';
        document.getElementsByClassName('container')[0].style.display = 'inline';
        }
        else{
            setTimeout(function () { swal("Something went wrong","You can checkout just on your checkout date","error");
            }, 1000);
        }
    }

}
 

xhr.send("checkout=true"); 


}
function checkOut() {
  document.getElementsByClassName('cart')[0].style.display = 'block';
    document.getElementsByClassName('container')[0].style.display = 'none';

}
</script>


<script>
    var div = document.getElementById("dom-target");
    var totalPay = parseInt(div.textContent);

        paypal.Button.render({
            env: 'sandbox', // sandbox | production

            locale: 'en_US',
            style: {
                    label: 'pay',
                    size:  'responsive', // small | medium | large | responsive
                    shape: 'pill',   // pill | rect
                    color: 'blue'   // gold | blue | silver | black

                },

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            
            
            client: {
                sandbox:    'AXDhDQWJLdh48vODos0N_DMXOobUUTtRlNIc8-nHgX18ZgKiJQUE36IBDKFdCyo0wR5zSH0gWUvR2gAR',
                production: '<insert production client id>'
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: totalPay, currency: 'USD' }
                            }
                        ]
                    }
                });
            },

            onCancel: function(data, actions) {
                    /*
                     *Buyer cancelled the payment
                     */

                },

                onError: function(err) {
                    /*
                     * An error occurred during the transaction
                     */

                },
            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function(payment) {
                var payerData = payment.payer.payer_info;
                    //From here till End its sending payerData data to the php DB
                var data = {
                        email: payerData.email,
                        first_name: payerData.first_name,
                        last_name: payerData.last_name,
                        total_payment: totalPay
                    };
                    
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "checkout.php", true);
                    //Send the proper header information along with the request
                    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                    
                    xhr.onreadystatechange = function() {//Call a function when the state changes.
                    if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                        var index=this.responseText.indexOf("!DOC");    
                        var newResponse=this.responseText.substr(1, index);
                    if(newResponse.includes("success")){
setTimeout(function() { swal({ title: "You checked out successfully", text: "Good Bye!", type: "success" }, function() { window.location = "init/logout.php"; }); }, 1000);                    }
        else{
                        swal("Error with checkout!", "Please try again", "error");
            
    }
    }
}
 

xhr.send(JSON.stringify(data)); 

                });
            }

        }, '#paypal-button-container');


    </script>
    
    
    <script>

                
        $('.button').click(function(e) {

var div = document.getElementById("dom-target");
    var totalPay = parseInt(div.textContent);
    var name = document.getElementById("name").value;
            $.ajax({
                type: "POST",
                url: 'checkout.php',
                data: {total: totalPay,orderName:name},
                success: function(result) {
 
                },
                 error: function() {
                    swal("Error deleting!", "Please try again", "error");
                },
                complete: function(result) {

                var index=result.responseText.indexOf("!DOC");    
                var newResponse=result.responseText.substr(1, index)
                    if(newResponse.includes("success")){

      setTimeout(function() { swal({ title: "You checked out successfully", text: "Good Bye!", type: "success" }, function() { window.location = "init/logout.php"; }); }, 1000);
                        
                    }
              
                    else{
            swal("Error with checkout!", "Please try again", "error");
}
                }

            });
        e.preventDefault();
      });
        
        
        
        
    </script>
        <script src="../js/checkout.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="../js/newMenu.js"></script>

</html>