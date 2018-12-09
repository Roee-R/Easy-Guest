<?php

require_once('init/init.php');
global $session;
global $database; 
$user=$session->get_user_order();
if(!$user)
{
    header("Location: 404.html");
}
$isSend=true;
$error_name=array();
if(isset($_POST["Bath"])){
    
if($_POST["Towels"]){
    $Towels = $_POST["Towels"];
    $prodName="Towels";
    $sql="INSERT INTO houseKeeping (name,unitsNum, user) VALUES ('".$prodName."','".$Towels."','".$user."');";
    if(!$database->query($sql)){
       $isSend=false; 
    array_push($error_name,"Towels");
    }

    
}
if($_POST["shaving"]){
        $shaving = $_POST["shaving"];
        $prodName="shaving";
        $sql="INSERT INTO houseKeeping (name,unitsNum, user) VALUES ('".$prodName."','".$shaving."','".$user."');";
        if(!$database->query($sql)){
    array_push($error_name,"shaving");
           $isSend=false; 
}}

if($_POST["shampoo"]){
        $shampoo = $_POST["shampoo"];
        $prodName="shampoo";
        $sql="INSERT INTO houseKeeping (name,unitsNum, user) VALUES ('".$prodName."','".$shampoo."','".$user."');";
        if(!$database->query($sql)){
           $isSend=false; 
        array_push($error_name,"shampoo");
}
    
}
if($_POST["Soap"]){
        $Soap = $_POST["Soap"];
        $prodName="Soap";
        $sql="INSERT INTO houseKeeping (name,unitsNum, user) VALUES ('".$prodName."','".$Soap."','".$user."');";
        if(!$database->query($sql)){
           $isSend=false;
        array_push($error_name,"Soap");
           
}
}
if($isSend==true)
    {
    echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Your order has been sent","Thank you for your patience","success");';
  echo '}, 1000);</script>';
    }
    else
        {
        $arrlength = count($error_name);
$error_message="";
for($x = 0; $x < $arrlength; $x++) {
    $error_message=$error_message . $error_name[$x];
    $x+1==$arrlength ? $error_message=$error_message." " :$error_message=$error_message. ", ";
}
$error_message=$error_message. " has not Received.";
    echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Something went wrong","'.$error_message.'","error");';
  echo '}, 1000);</script>';
    } 

}
else if(isset($_POST["Bedroom"])){
$isSend=true;
$error_name=array();

if($_POST["Pillow"]){
        $Pillow = $_POST["Pillow"];
        $prodName="Pillow";
        $sql="INSERT INTO houseKeeping (name,unitsNum, user) VALUES ('".$prodName."','".$Pillow."','".$user."');";
        if(!$database->query($sql)){
           $isSend=false; 
            array_push($error_name,"Pillow");
}}
if($_POST["blanket"]){
        $blanket = $_POST["blanket"];
        $prodName="blanket";
        $sql="INSERT INTO houseKeeping (name,unitsNum, user) VALUES ('".$prodName."','".$blanket."','".$user."');";
        if(!$database->query($sql)){
           $isSend=false; 
        array_push($error_name,"blanket");
}}
if($_POST["sheets"]){
        $sheets = $_POST["sheets"];
        $prodName="sheets";
        $sql="INSERT INTO houseKeeping (name,unitsNum, user) VALUES ('".$prodName."','".$sheets."','".$user."');";
        if(!$database->query($sql)){
           $isSend=false; 
           array_push($error_name,"sheets");

}}
    if($isSend==true)
    {
    echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Your order has been sent","Thank you for your patience","success");';
  echo '}, 1000);</script>';
    }
    else
    {
        $arrlength = count($error_name);
$error_message="";
for($x = 0; $x < $arrlength; $x++) {
    $error_message=$error_message . $error_name[$x];
    $x+1==$arrlength ? $error_message=$error_message." " :$error_message=$error_message. ", ";
}
$error_message=$error_message. " has not Received.";
    echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Something went wrong","'.$error_message.'","error");';
  echo '}, 1000);</script>';
    } 
}

else if(isset($_POST["service"])){
    if($_POST["time"] and $_POST["type"]!="not-option"){
        $Time = $_POST["time"];
        $note = $_POST["note"];
        $type=$_POST["type"];
        $newTimeDate=substr($Time, 0, 10);
        $check_valid_date="select checkInDate, checkOutDate from guestOrder where orderNumber=$user";
        $check_valid_date_result=$database->query($check_valid_date);
        while($row=$check_valid_date_result->fetch_assoc()){
            $today_date=date("Y-m-d");
            $user_check_out=$row["checkOutDate"];}
        if($today_date<=$newTimeDate and $user_check_out>=$newTimeDate){

        $sql="INSERT INTO Maintance (date,user, notes,Type) VALUES ('".$Time."','".$user."','".$note."','".$type."');";
            if(!$database->query($sql)){
            echo '<script type="text/javascript">';
      echo 'setTimeout(function () { swal("Something went wrong","Your request has not confirmed","error");';
      echo '}, 1000);</script>';
            }
            else{
                  echo '<script type="text/javascript">';
      echo 'setTimeout(function () { swal("Your order has been sent","Thank you for your patience","success");';
      echo '}, 1000);</script>';
                
                
            }
        }
        else{
                        echo '<script type="text/javascript">';
      echo 'setTimeout(function () { swal("Something went wrong","Please choose another date","error");';
      echo '}, 1000);</script>';

        }
    }
else{
            echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Something went wrong","You did not fill in all the details","error");';
  echo '}, 1000);</script>';

}
    
}



else if(isset($_POST["maintenance"])){
$user=$session->get_user_order();
$maintenances = $_POST['malfunction'];
$texts = $_POST['text'];
$type="maintenance";
$isSend=false;
$date=date("Y-m-d");
foreach (array_combine($maintenances, $texts) as $maintenance => $text){ 

    $sql="INSERT INTO Maintance (date,user, notes,Type) VALUES ('".$date."','".$user."','".$text."','".$maintenance."');";
        if($database->query($sql)){
           $isSend=true;
        }

}


if($isSend==true)
{
    echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Your order has been sent","Thank you for your patience","success");';
  echo '}, 1000);</script>';
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
  <title>Services</title>
  
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet'/>
    
<link rel="stylesheet" href="../css/services.css">

 <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'>

<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel='stylesheet prefetch' href='https://flatlogic.github.io/awesome-bootstrap-checkbox/bower_components/Font-Awesome/css/font-awesome.css'>
<style>
    html ,body {margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline};
</style>
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

<h1 style="color:white;"><b>Services</b></h1>
<div class="content">
    <!--modal 1-->
     <form method="post" action="Services.php">

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bath products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <h4><label>Towels (max 3):</label></h4>
        <div class="input-group">
  <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                  <span class="glyphicon glyphicon-minus"></span>
  </button>
  </span>
  <input  type="text" name="Towels" class="form-control input-number" value="0" min="0" max="3">
  <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="Towels">
                  <span class="glyphicon glyphicon-plus"></span>
  </button>
  </span>
</div>
        <h4><label>Shaving kit (max 3):</label></h4>

        <div class="input-group">
  <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[2]">
                  <span class="glyphicon glyphicon-minus"></span>
  </button>
  </span>
  <input  type="text" name="shaving" class="form-control input-number" value="0" min="0" max="3">
  <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="shaving">
                  <span class="glyphicon glyphicon-plus"></span>
  </button>
  </span>
</div>
          <h4><label>Shampoo (max 3):</label></h4>
        <div class="input-group">
  <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[3]">
                  <span class="glyphicon glyphicon-minus"></span>
  </button>
  </span>
  <input type="text" name="shampoo" class="form-control input-number" value="0" min="0" max="3">
  <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="shampoo">
                  <span class="glyphicon glyphicon-plus"></span>
  </button>
  </span>
</div>
          <h4><label>Soap (max 3):</label></h4>
        <div class="input-group">
  <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[4]">
                  <span class="glyphicon glyphicon-minus"></span>
  </button>
  </span>
  <input type="text" name="Soap" class="form-control input-number" value="0" min="0" max="3">
  <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="Soap">
                  <span class="glyphicon glyphicon-plus"></span>
  </button>
  </span>
</div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button name="Bath" type="submit" class="btn btn-warning" >Send <span class="glyphicon glyphicon-send"></span></button>      </div>
    </div>
  </div>
</div>
</form>


        <!--modal 2-->
     <form method="post" action="Services.php">

        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bed sheets</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <h4><label>Pillow (max 3):</label></h4>
        <div class="input-group">
  <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[5]">
                  <span class="glyphicon glyphicon-minus"></span>
  </button>
  </span>
  <input type="text" name="Pillow" class="form-control input-number" value="0" min="0" max="3">
  <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="Pillow">
                  <span class="glyphicon glyphicon-plus"></span>
  </button>
  </span>
</div>
          <h4><label>Blanket (max 3):</label></h4>
        <div class="input-group">
  <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[6]">
                  <span class="glyphicon glyphicon-minus"></span>
  </button>
  </span>
  <input type="text" name="blanket" class="form-control input-number" value="0" min="0" max="3">
  <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="blanket">
                  <span class="glyphicon glyphicon-plus"></span>
  </button>
  </span>
</div>
          <h4><label>Bed sheets (max 3):</label></h4>
        <div class="input-group">
  <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[7]">
                  <span class="glyphicon glyphicon-minus"></span>
  </button>
  </span>
  <input type="text" name="sheets" class="form-control input-number" value="0" min="0" max="3">
  <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="sheets">
                  <span class="glyphicon glyphicon-plus"></span>
  </button>
  </span>
</div>          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button name="Bedroom" type="submit" class="btn btn-warning" >Send <span class="glyphicon glyphicon-send"></span></button>      </div>
    </div>
  </div>
</div>
</form>
    <!--modal 3-->

         <form method="post" action="Services.php">

        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cleaning &amp; laundry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">
              <select name="type" class="form-control">
            <option value="not-option" selected>Service type</option>
                  <option value="Cleaning">Cleaning</option>
                  <option value="Laundry">Laundry</option> 
                </select>
           
      </div> 
  <label>Date and time</label>
  <div class="col-4">
    <input name="time" class="form-control" type="datetime-local" value="<?php echo date("Y-m-d");?>T13:45:00" id="example-datetime-local-input">
  </div>
           <label for="exampleTextarea">Notes</label>
    <textarea name="note" class="form-control" id="exampleTextarea" rows="3"></textarea>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button name="service" type="submit" class="btn btn-warning" >Send <span class="glyphicon glyphicon-send"></span></button>
      </div>
    </div>
  </div>
</div>
    </form>
        <!--modal 4-->
     <form method="post" action="Services.php">

     <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Maintenance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <input id="text1" type="text" class="form-control" disabled placeholder="Notes" name="text[]">

               <div class="checkbox checkbox-success">
            <input value="TV" id="check1" type="checkbox" name="malfunction[]">
            <label for="check1">TV</label>
          </div>
          

  <input id="text2" type="text" class="form-control" disabled placeholder="Notes" name="text[]">

            <div class="checkbox checkbox-success">
            <input value="Safe" id="check2" type="checkbox" name="malfunction[]">
            <label for="check2">Safe</label>
          </div>
  <input id="text3" type="text" class="form-control" disabled placeholder="Notes" name="text[]">

                         <div class="checkbox checkbox-success">
            <input value="Door" id="check3" type="checkbox" name="malfunction[]">
            <label for="check3">Door</label>
          </div>
  <input id="text4" type="text" class="form-control" disabled placeholder="Notes" name="text[]">

            <div class="checkbox checkbox-success">
            <input value="Windows" id="check4" type="checkbox" name="malfunction[]">
            <label for="check4">Windows</label>
          </div>
          
  <input id="text5" type="text" class="form-control" disabled placeholder="Notes" name="text[]">

            <div class="checkbox checkbox-success">
            <input value="Air-Conditioner" id="check5" type="checkbox" name="malfunction[]" >
            <label for="check5">Air-Conditioner</label>
          </div>
          
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button name="maintenance" type="submit" class="btn btn-warning" >Send <span class="glyphicon glyphicon-send"></span></button>
      </div>
    </div>
  </div>
</div>
</form>
				<div class="grid">
					<figure class="effect-goliath">
						<img src="../images/toothbrush.png" style="width:100%" alt="img23"/>
						<figcaption>
							<h2>Bath <span>Products</span></h2>
							<p>Order</p>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">View more</a>
						</figcaption>			
					</figure>
					<figure class="effect-goliath">
						<img src="../images/sheets.png" style="width:100%" alt="img24"/>
						<figcaption>
							<h2>Bed <span>Sheets</span></h2>
							<p>Order</p>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">View more</a>
						</figcaption>			
					</figure>
                    <figure class="effect-goliath">
						<img src="../images/make up room.png" style="width:100%" alt="img24"/>
						<figcaption>
							<h2>Cleaning <span>&amp;laundry</span></h2>
							<p>Order</p>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3">View more</a>
						</figcaption>			
					</figure>
                    <figure class="effect-goliath">
						<img src="../images/wrench.png"  style="width:100%" alt="img24"/>
						<figcaption>
							<h2><span>Maintenance</span></h2>
							<p>Order</p>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal4">View more</a>
						</figcaption>			
					</figure>
				</div>
    </div>
</body>
<script>
    $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
    </script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="../js/services.js"></script>
        <script src="../js/newMenu.js"></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

</html>
