<?php

require_once('init/init.php');
global $session;
global $database; 
if(!$session->get_user_order())
{
    header("Location: 404.html");
}

if (json_decode(stripslashes(file_get_contents("php://input")))) {
$cart = json_decode(stripslashes(file_get_contents("php://input")));
$isSend=true;
foreach ($cart as $rows)
{
    $row = get_object_vars($rows);
    $name= $row['name'];
    $price= $row['price'];
    $count= $row['count'];
    $total= $row['total'];
    $userOrder=$session->get_user_order();

    $sql="INSERT INTO restOrders (prodName,prodCount, prodPrice, prodTottal,user) VALUES ('".$name."','".$count."','".$price."','".$total."','".$userOrder."');";

if(!$database->query($sql))
{
    echo 'failed';
}
else
    echo 'ok';



}
}

?>


<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Room service</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Barrio' rel='stylesheet'>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'>
  
      <link rel="stylesheet" href="../css/newRest.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

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



<p id="data"></p>
  <!-- Nav -->
<div class="navbar navbar-inverse ">
    <div class="row">
        <div class="col">
          <button type="button" class="btn btn-primary cartbut" data-toggle="modal" data-target="#cart">Cart (<span class="total-count"></span>)</button><button class="clear-cart btn btn-danger cartbut">Clear Cart</button></div>

    </div>

</div>

<h1>Room service menu</h1><br><br>

<div class="container">
    <div class="row">
      <div class="col">
        <div class="card">
  <img class="card-img-top" src="http://cdn-image.foodandwine.com/sites/default/files/1492718391/chilled-tomato-soup-with-parsley-olive-salsa-XL-RECIPE0517.jpg" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">Soup</h4>
    <p class="card-text">Price: $7.5</p>
    <a href="#" data-name="Soup" data-price="7.5" class="add-to-cart btn btn-primary">Add to cart</a>
  </div>
</div>
      </div>
      
      <div class="col">
        <div class="card" >
  <img class="card-img-top" src="https://www.goya.com/media/3958/hummus1.jpg?quality=80" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">Hummus</h4>
    <p class="card-text">Price: $5.5</p>
    <a href="#" data-name="Hummus" data-price="5.5" class="add-to-cart btn btn-primary">Add to cart</a>
  </div>
</div>
      </div>
      <div class="col">
        <div class="card">
  <img class="card-img-top" src="https://static01.nyt.com/images/2016/02/09/dining/09COOKING_CHICKENWINGS2/09COOKING_CHICKENWINGS2-superJumbo.jpg" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">Chicken wings</h4>
    <p class="card-text">Price: $5</p>
    <a href="#" data-name="Chicken-wings" data-price="5" class="add-to-cart btn btn-primary">Add to cart</a>
  </div>
</div>
      </div>
	        <div class="col">
        <div class="card">
  <img class="card-img-top" src="https://www.recipetineats.com/wp-content/uploads/2016/02/Beef-Burger4_landscape-680x469.jpg" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">Cheeseburger</h4>
    <p class="card-text">Price: $10.5</p>
    <a href="#" data-name="Cheeseburger" data-price="10.5" class="add-to-cart btn btn-primary">Add to cart</a>
  </div>
</div>
      </div>
	  	        <div class="col">
        <div class="card">
  <img class="card-img-top" src="https://recipethis.com/wp-content/uploads/Slimming-World-Chicken-Doner-Kebab-Fakeaway.jpg" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">Kabab</h4>
    <p class="card-text">Price: $14</p>
    <a href="#" data-name="Kabab" data-price="14" class="add-to-cart btn btn-primary">Add to cart</a>
  </div>
</div>
      </div>
	  	        <div class="col">
        <div class="card">
  <img class="card-img-top" src="https://www.homewetbar.com/blog/wp-content/uploads/2014/04/how-to-grill-steak.jpg" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">Steak</h4>
    <p class="card-text">Price: $17</p>
    <a href="#" data-name="Steak" data-price="17" class="add-to-cart btn btn-primary">Add to cart</a>
  </div>
</div>
      </div>
      	  	        <div class="col">
        <div class="card">
  <img class="card-img-top" src="https://i1.wp.com/cake-lab.org/wp-content/uploads/2018/02/Malabi-19-1.jpg?fit=1024%2C769&ssl=1" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">Malabi</h4>
    <p class="card-text">Price: $9</p>
    <a href="#" data-name="Malabi" data-price="9" class="add-to-cart btn btn-primary">Add to cart</a>
  </div>
</div>
      </div>
      	  	        <div class="col">
        <div class="card">
  <img class="card-img-top" src="https://www.krusteaz.com/sites/krusteaz.com/files/styles/product_hero/public/images/products/heroes/krusteaz-belgian-waffles.png?itok=WeTofqEi" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">Waffles</h4>
    <p class="card-text">Price: $5</p>
    <a href="#" data-name="Waffles" data-price="5" class="add-to-cart btn btn-primary">Add to cart</a>
  </div>
</div>
      </div>
      	  	        <div class="col">
        <div class="card">
  <img class="card-img-top" src="https://food.fnr.sndimg.com/content/dam/images/food/fullset/2009/11/4/0/FNM_120109-Try-This-At-Home-040_s4x3.jpg.rend.hgtvcom.616.462.suffix/1371589456425.jpeg" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">Creme brulee</h4>
    <p class="card-text">Price: $9</p>
    <a href="#" data-name="Creme-brulee" data-price="9" class="add-to-cart btn btn-primary">Add to cart</a>
  </div>
</div>
      </div>
            	  	        <div class="col">
        <div class="card">
  <img class="card-img-top" src="https://kusher.world/uploads/3139405df7.jpg" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">Beer</h4>
    <p class="card-text">Price: $2.5</p>
    <a href="#" data-name="Beer" data-price="10" class="add-to-cart btn btn-primary">Add to cart</a>
  </div>
</div>
      </div>
      	  	        <div class="col">
        <div class="card">
  <img class="card-img-top" src="https://www.ocado.com/productImages/954/95403011_1_640x640.jpg?identifier=fe64629d8a4b3e179a02c16346619855" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">Jack daniels</h4>
    <p class="card-text">Price: $5</p>
    <a href="#" data-name="Jack-daniels" data-price="5" class="add-to-cart btn btn-primary">Add to cart</a>
  </div>
</div>
      </div>
      	  	        <div class="col">
        <div class="card">
  <img class="card-img-top" src="https://www.drinksupermarket.com/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/h/e/hennessy-fine-de-cognac-miniature-5cl-40-abv_temp.jpg" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">Cognac</h4>
    <p class="card-text">Price: $20</p>
    <a href="#" data-name="Cognac" data-price="20" class="add-to-cart btn btn-primary">Add to cart</a>
  </div>
</div>
      </div>
      
                  	  	        <div class="col">
        <div class="card">
  <img class="card-img-top" src="https://www.santacecilia.es/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/s/a/santa-cecilia-coca-cola-botellin-20cl_4.jpg" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">Coca cola</h4>
    <p class="card-text">Price: $2.5</p>
    <a href="#" data-name="Coca-cola" data-price="2.5" class="add-to-cart btn btn-primary">Add to cart</a>
  </div>
</div>
      </div>
      	  	        <div class="col">
        <div class="card">
  <img class="card-img-top" src="http://valsegura.com/wp-content/uploads/2016/02/sprite-20cl.jpg" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">Sprite</h4>
    <p class="card-text">Price: $2</p>
    <a href="#" data-name="Sprite" data-price="2" class="add-to-cart btn btn-primary">Add to cart</a>
  </div>
</div>
      </div>
            	  	        <div class="col">
        <div class="card">
  <img class="card-img-top" src="https://www.verduragroceries.co.ke/wp-content/uploads/2017/10/j12-apple.jpg" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">Apple juice</h4>
    <p class="card-text">Price: $2</p>
    <a href="#" data-name="Apple-juice" data-price="2" class="add-to-cart btn btn-primary">Add to cart</a>
  </div>
</div>
      </div>

	        </div>


  
 <!-- Modal -->
<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:black;">Cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="show-cart table table-responsive">
          
        </table>
        <div style="color:black;">Total price: $<span class="total-cart"></span></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="save();" name="order" class="btn btn-primary but">Order now</button>
      </div>
    </div>
  </div>
</div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>

  

    <script  src="../js/newRest.js"></script>


</body>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="../js/newMenu.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</html>
