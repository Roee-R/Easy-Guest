<?php


require_once('init/init.php');
global $session;
global $database; 
if(!$session->get_user_order())
{
    header("Location: 404.html");
}
	if(isset($_POST["order"]))
	{
		$numOfPersons = $_POST['persons'];
		$date = $_POST['date'];
		$meals = $_POST['meals'];
        $userName=$session->get_user_order();
	    $check_valid_date="select checkInDate, checkOutDate from guestOrder where orderNumber=$userName";
        $check_valid_date_result=$database->query($check_valid_date);
        while($row=$check_valid_date_result->fetch_assoc()){
        $user_check_out=$row["checkOutDate"];}
        $today_date=date("Y-m-d");

        if($today_date<=$date and $user_check_out>=$date){
            if($meals=="Breakfast")
            $price=100;
        elseif($meals=="lunch")
            $price=200;
        else
            $price=150;
        $total=$price*$numOfPersons;  
        
       $sql="INSERT INTO meals (numberOfPersons,date, mealsType,user,price,tottal) VALUES ('".$numOfPersons."','".$date."','".$meals."','".$userName."','".$price."','".$total."');";
       

        if($database->query($sql))
        {
echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Your reservation has been confirmed","Enjoy your meal","success");';
  echo '}, 1000);</script>';
	}
		else{
		   echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Your reservation has not been confirmed","try again","error");';
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
	<title>Registration for meals</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by GetTemplates.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="GetTemplates.co" />

<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet'/>

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
	  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.css'>
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'>

	<link rel="stylesheet" href="../css/animate.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/breakfast.css">
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


					<div class="row row-mt-10em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<span class="intro-text-small">Breakfast: 8:00-12:00 Lunch: 14:00-17:00 Dinner: 19:00-21:00 <a href="http://gettemplates.co" target="_blank"></a></span>
							<h1 class="cursive-font">Registration for meals!</h1>	
						</div>
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Table Reservation</h3><br>
											<form action="breakfast.php" method="POST">
												<div class="row form-group">
													<div class="col-md-12">
														<label for="activities">Persons</label>
														<select name="persons" id="activities" class="form-control">
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
														</select>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<label for="date">Date</label>
														<input name="date" value="<?php echo date("Y-m-d");?>" type="date" class="form-control" required>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
                                                        <label for="activities">Types of meals</label>
														<select name="meals" id="activities" class="form-control">
															<option value="Breakfast">Breakfast</option>
															<option value="lunch">lunch</option>
															<option value="dinner">dinner</option>
														</select>													</div>
												</div>

												<div class="row form-group">
													<div class="col-md-12">
														<input type="submit" name="order" class="btn btn-primary btn-block" value="Reserve Now">
													</div>
												</div>
											</form>	
										</div>
									</div>
								</div>
							</div>
					</div>
				</div>
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

