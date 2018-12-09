<?php

require_once('init/init.php');
global $session;
global $database; 
if(!$session->get_user_order())
{
    header("Location: 404.html");
}
	if(isset($_POST["tuk"]))
	{
		$location = $_POST['loc'];
		$destination = $_POST['dest'];
		$numOfPass = $_POST['number'];
        $userName=$session->get_user_order();
		$timeDate= $_POST['TimeDate'];
		
        $newTimeDate=substr($timeDate, 0, 10);
		$timeDate = str_replace('T', ' ', $timeDate);
        $taxi = $_POST['switcheroo'];
        
        $newTimeDate=substr($timeDate, 0, 10);
        $check_valid_date="select checkInDate, checkOutDate from guestOrder where orderNumber=$userName";
        $check_valid_date_result=$database->query($check_valid_date);
        while($row=$check_valid_date_result->fetch_assoc()){
        $today_date=date("Y-m-d");
        $user_check_out=$row["checkOutDate"];}
        
        if($today_date<=$newTimeDate and $user_check_out>=$newTimeDate){
                if($location!=$destination){     
                $tuktuksql ="select licenseNum, numberOfRides from tuktuks
                 WHERE licenseNum IN (SELECT licenseNum FROM tuktuks WHERE licenseNum NOT IN (select distinct tuktuk FROM tuktukOrders WHERE DateTime='$timeDate'))  order by numberOfRides;";
            
            
               $tuktuk = $database->query($tuktuksql);
        
                
               $myTuktuk=mysqli_fetch_assoc($tuktuk)["licenseNum"];
               $sql="INSERT INTO tuktukOrders (user,DateTime, location, destination, numOfPass,tuktuk,needTaxi) VALUES ('".$userName."','".$timeDate."','".$location."','".$destination."','".$numOfPass."','".$myTuktuk."','".$taxi."');";
               
                $updateRides="UPDATE tuktuks
                SET numberOfRides = numberOfRides+1
                WHERE licenseNum=$myTuktuk;";
                $database->query($updateRides);
                    
                        if($database->query($sql))
                        {
                	          echo '<script type="text/javascript">';
                  echo 'setTimeout(function () { swal("Your tuktuk has been oredered","Thank you for your patience","success");';
                  echo '}, 1000);</script>';
                       }
                		else{
                	        echo '<script type="text/javascript">';
                  echo 'setTimeout(function () { swal("Something went wrong","Your request has not confirmed","error");';
                  echo '}, 1000);</script>';
                
                        }
        
               }

            else{
                  	        echo '<script type="text/javascript">';
          echo 'setTimeout(function () { swal("Something went wrong","Your request has not confirmed","error");';
          echo '}, 1000);</script>';
            }
        
}
else{
                		   echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("You must select a valid dates","Try again","error");';
                echo '}, 1000);</script>';

}
       

	}
	
?>	


<!DOCTYPE HTML>

<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tuktuk order</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by GetTemplates.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="GetTemplates.co" />


	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
	  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.css'>
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'>

	<link rel="stylesheet" href="../css/animate.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/tuktukOrder.css">

<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet'/>
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

	
	<header id="gtco-header"  role="banner" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">

<form action="tuktukOrder.php" method="POST">

					<div class="row row-mt-10em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<span class="intro-text-small">The reservation is only possible every fifteen minutes<a href="http://gettemplates.co" target="_blank"></a></span>
							<h1 class="cursive-font">Get a tuktuk now!</h1>	
						</div>
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Tuktuk Reservation</h3><br>
											<form action="breakfast.php" method="POST">
												<div class="row form-group">
													<div class="col-md-12">
														<select name="loc" id="activities" class="form-control">
														  <option value="">Choose your location</option>
															<option value="M1">M1</option>
															<option value="M2">M2</option>
															<option value="M3">M3</option>
															<option value="L">L</option>
														</select>
													</div>
												</div>
																								<div class="row form-group">
													<div class="col-md-12">
														<select name="dest" id="activities" class="form-control">
														     <option value="">Choose your destination</option>
															<option value="M1">M1</option>
															<option value="M2">M2</option>
															<option value="M3">M3</option>
															<option value="L">L</option>
														</select>
													</div>
												</div>
													<div class="row form-group">
													<div class="col-md-12">
														<select name="number" id="activities" class="form-control">
														   <option value="">Number of people</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
														</select>													</div>
												</div>
														<div class="row form-group">
													<div class="col-md-12">
														<select name="switcheroo" id="activities" class="form-control">
														   <option value="">Do you need a taxi outside the hotel?</option>
															<option value="1">Yes</option>
															<option value="0">No</option>
										
														</select>													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<input name="TimeDate" type="text" class="form-control" placeholder="Date and time" onfocus="(this.type='datetime-local')" step="900" required>
													</div>
												</div>
											

												<div class="row form-group">
													<div class="col-md-12">
														<input type="submit" name="tuk" class="btn btn-primary btn-block" value="Reserve Now">
													</div>
												</div>
											</form>	
										</div>
									</div>
								</div>
							</div>
					</div>
				</div>
				</form>
			</div>
		</div>
	</header>

	</body>
		
	<script src="../js/breakfast/jquery.min.js"></script>
	<script src="../js/breakfast/bootstrap.min.js"></script>
	<script src="../js/breakfast/jquery.waypoints.min.js"></script>


<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script>
	<script src="../js/breakfast/main.js"></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="../js/newMenu.js"></script>
</html>

