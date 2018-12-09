<?php 
require_once('init/init.php');
global $session;
global $database; 
if(!$session->get_user_order())
{
    header("Location: 404.html");
}
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Home page</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../css/main.css" />
	</head>
	<body class="loading">
		<div id="wrapper">
			<div id="bg"></div>
			<div id="overlay"></div>
			<div id="main">

				<!-- Header -->
					<header id="header">
						<h1>EasyGuest</h1>
						<p><a href="howItWorks.php">How it works</a> &nbsp;&bull;&nbsp;<a href="checkout.php">Check-out</a>&nbsp;&bull;&nbsp;<a href="init/logout.php">Logout</a></p>
						<nav>
							<ul>
								<li><a href="breakfast.php" class="fa fa-cutlery"><span class="label">Breakfast</span></a></li>
								<li><a href="newRest.php" class="fa fa-glass"><span class="label">Roomservice</span></a></li>
								<li><a href="googleApi.php" class="fa fa-map-marker"><span class="label">Concierge</span></a></li>
								<li><a href="Services.php" class="fa fa-wrench"><span class="label">Maintenance</span></a></li>
								<li><a href="tuktukOrder.php" class="fa fa-taxi"><span class="label">Transportaion</span></a></li>
							</ul>
						</nav>
					</header>

				<!-- Footer -->
					<footer id="footer">
						<span class="copyright">Powered by Tomer, Eyal and Roi.</span>
					</footer>

			</div>
		</div>
		<script>
			window.onload = function() { document.body.className = ''; }
			window.ontouchmove = function() { return false; }
			window.onorientationchange = function() { document.body.scrollTop = 0; }
		</script>
	</body>
</html>