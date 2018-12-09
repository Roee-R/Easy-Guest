<?php
require_once("init/init.php");
global $session;
global $database;
if(isset($_POST["signup"]))
{

$resNum=$_POST["order"];
$email=$_POST["email"];
$password=md5($_POST["password"]);
$repassword=md5($_POST["passcon"]);

$id=$_POST["id"];
$fname=$_POST["first"];
$lname=$_POST["last"];

$phone=$_POST["phone"];
$address=$_POST["address"]; 

$type=$_POST["type"];
$holder=$_POST["holder"];

$cardNum=$_POST["cardNum"]; 
$expireMonth=$_POST["month"];
$expireYear=$_POST["year"];
$cvv=$_POST["cvv"];
$pass=$_FILES["pass"];
$visa=$_FILES["visa"];


$passName=$_FILES['pass']['name'];
$pass=addslashes(file_get_contents($_FILES['pass']['tmp_name']));

$visaName=$_FILES['visa']['name'];
if($visaName){
$visa=addslashes(file_get_contents($_FILES['visa']['tmp_name']));}

$user=new User($resNum,$id);

$is_new_user=$user->add_user($resNum,$id,$fname,$lname,$password,$repassword,$email,$phone,$address,$type,$holder,$cardNum,$expireMonth,$expireYear,$cvv,$passName,$pass,$visaName,$visa); 

if($is_new_user!=null) 

{ 
$guest_room="select typeRoom,checkInDate,checkOutDate from guestOrder where orderNumber=$resNum";
$guest_room_ans=$database->query($guest_room);

while ($row = $guest_room_ans->fetch_assoc()) {
        $guest_room_type=$row["typeRoom"];
        $guest_room_check_in=$row["checkInDate"];
        $guest_room_check_out=$row["checkOutDate"];
    }


$free_room="select Room_Number from hotelRooms where name='$guest_room_type' and Room_Number NOT IN (select Room from guestRooms INNER JOIN guestOrder on guestRooms.currentGuest=guestOrder.id where (checkInDate<='$guest_room_check_in' and checkOutDate>='$guest_room_check_in') or (checkInDate>'$guest_room_check_in' and checkInDate<'$guest_room_check_out'))";

$result=$database->query($free_room);
if(mysqli_num_rows($result)){
    $free_room_ans=$result->fetch_assoc()["Room_Number"];


    $update_room="INSERT INTO guestRooms (Room, currentGuest)
    VALUES ($free_room_ans, $resNum)";
    
    $database->query($update_room);
    $found_user=$user->user_login($resNum,$password);
    $session->login($found_user); 
    
    echo '<script> setTimeout(function() { swal({ title: "You checked in successfully", text: "Welcome to our hotel", type: "success" }, function() { window.location = "homePage.php"; }); }, 1000); </script>';

}
else{
    echo '<script> setTimeout(function() { swal({ title: "You Failed to check in", text: "There is no room available in this category, try letter or contact with us", type: "error" }, function() { window.location = "home.php"; }); }, 1000); </script>';
}

}

else
{
  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Something went wrong","Your request has not confirmed","error");';
  echo '}, 1000);</script>';
}

}

       

?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Check - in</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.css'>
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'>
  <link href='https://fonts.googleapis.com/css?family=Pacifico|Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
      <link rel="stylesheet" href="../css/checkin.css">

  
</head>

<body>

  

<div class="wrapper">
<nav>Check-in </nav>
  <h2 id="account">Create your Account</h2>
  <p id="required"><span class="ast"> *</span> Required information</p><br>



 <form name="signup" action="checkin.php" method="post" onsubmit='return formValidation()' onreset="resetHandler();" enctype="multipart/form-data">
<div class="info">

    <h3>Basic Information</h3>
 <label for="order">Order number<span class="ast"> *</span></label>
<input type="text" name="order" id="order" autofocus required/><span class="bar"></span><br>
    
    <label for="email">Email <span class="ast"> *</span></label>
    <input type="email" name="email" id="email" autofocus required/><span class="bar"></span><br>


    <label for="password">Password <span class="ast"> *</span></label>
    <input type="password" name="password" id="password" required/><span class="bar"></span><br>
    <div class="errors" id="password_error"></div>

    <label for="passcon">Confirm Password <span class="ast"> *</span></label>
    <input type="password" name="passcon" id="passcon" required/><span class="bar"></span><br>
    <div class="errors" id="passcon_error"></div>
    
     <label for="id">Id<span class="ast"> *</span></label>
    <input type="text" name="id" id="id" autofocus required/><span class="bar"></span><br>
    
    <label for="first">First Name<span class="ast"> *</span></label>
    <input type="text" name="first" id="first" required/><span class="bar"></span><br>
    <div class="errors" id="first_error"></div>

    <label for="last">Last Name<span class="ast"> *</span></label>
    <input type="text" name="last" id="last" required/><span class="bar"></span><br>
    <div class="errors" id="last_error"></div>

    <label for="phone">Phone Number<span class="ast"> *</span></label>
    <input type="tel" name="phone" id="phone" placeholder="999-999-9999" required/><span class="bar"></span><br>
    <div class="errors" id="phone_error"></div>

    <label for="address">Full address<span class="ast"> *</span></label>
    <input type="text" name="address" id="address" required/><span class="bar"></span><br>



  </div>
  <div class="education">

    <h3>Deposit</h3>

    <label for="type">Card type<span class="ast"> *</span></label>
    <select name="type" id="type" required >
      <option value="" >-select-</option>
      <option value="visa">Visa</option>
      <option value="master card">Master card</option>
      <option value="american express">American express</option>
      <option value="diners">Diners</option>
    </select><br><br>
    <label for="holder">Cardholder name<span class="ast"> *</span></label>
    <input type="text" name="holder" id="holder" required/><span class="bar"></span><br>
    <div class="errors" id="school_error"></div>

    <label for="cardNum">Card number<span class="ast"> *</span></label>
    <input type="text" name="cardNum" id="cardNum" maxlength="16"  required/><span class="bar"></span><br>
    <div class="errors" id="program_error"></div>

    <div class="errors" id="education_error"></div>

    <label>Expire date<span class="ast"> *</span></label>
    <select name="month" id="month" required >
      <option value="" >Month</option>
      <option value="01 - January">01 - January</option>
      <option value="02 - February">02 - February</option>
      <option value="03 - March">03 - March</option>
      <option value="04 - April">04 - April</option>
      <option value="05 - May">05 - May</option>
      <option value="06 - June">06 - June</option>
      <option value="'07 - July">07 - July</option>
      <option value="08 - August">08 - August</option>
      <option value="09 - September">09 - September</option>
      <option value="10 - October">10 - October</option>
      <option value="11 - November">11 - November</option>
      <option value="12 - December">12 - December</option>
    </select>
    <label>&nbsp; </label>

      <select name="year" id="year" required >
      <option value="" >Year</option>
      <option value="2018">2018</option>
      <option value="2019">2019</option>
      <option value="2020">2020</option>
      <option value="2021">2021</option>
      <option value="2022">2022</option>
      <option value="2023">2023</option>
      <option value="2024">2024</option>
      <option value="2025">2025</option>
      <option value="2026">2026</option>
      <option value="2027">2027</option>
      <option value="2028">2028</option>
      <option value="2029">2029</option>
      <option value="2030">2030</option>
      <option value="2031">2031</option>
      <option value="2032">2032</option>
      <option value="2033">2033</option>
      <option value="2034">2034</option>
    </select><br><br>

<label for="cvv">CVV<span class="ast"> *</span></label>
    <input type="text" name="cvv" id="cvv" maxlength="3" required />
<span class="bar"></span>  
  </div>

  <div class="attachments">
    <h3>Attachments</h3>
    <label for="pass">Passport/Id</label>
    <input name="pass" id="pass" type="file" style="border:none;" required>
    <label for="visa">Visa entrance</label>
    <input name="visa" id="visa" type="file" style="border:none;">
    <div class="buttons">
        
        
  <input type="reset" value="Reset"/>
  <input name="signup" type="submit"  value="Apply"/>
  </div>
  </div>




  </form>
</div>
  
  

    <script  src="../js/checkin.js"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>



</body>
<script>

</script>
</html>
