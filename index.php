<?php

require_once("includes/init/init.php");
global $session;
    if(isset($_POST["signIn"]))
    {
    if(!empty($_POST["userName"])&&!empty($_POST["password"]))
      {
        $userName=$_POST["userName"];
        
        $user=new user();
        if(preg_match('/^[1-9][0-9]*$/',$userName)){
            $password=md5($_POST["password"]);
            $found_user=$user->user_login($userName,$password);


        if($found_user!=null)
        {
            global $database;
            $check_in_out=$database->query("SELECT checkInDate, checkOutDate FROM guestOrder where '$userName'=orderNumber;");
            while($row=$check_in_out->fetch_assoc()){
                $check_in_date=$row["checkInDate"];
                $check_out_date=$row["checkOutDate"];}
            $date=date("Y-m-d");
            if($date>=$check_in_date and $date<=$check_out_date)
            {
                $session->login($found_user);
                header("Location: includes/homePage.php");
            }
            else
            {

                if($date>$check_out_date)  {
                   $message ="Your account has been expired!"  ;
                                echo '<script type="text/javascript">';
                      echo 'setTimeout(function () { swal("Failed","'.$message.'","error");';
                      echo '}, 1000);</script>'; 
                }
                else{
                          $message ="Your account will be activate on the ".$check_in_date  ;
                                echo '<script type="text/javascript">';
                      echo 'setTimeout(function () { swal("Failed","'.$message.'","error");';
                      echo '}, 1000);</script>';
    
                }
      
                
            }
        }
            else
        {
             $message ="Your password or username is incorrect";
                echo '<script type="text/javascript">';
                  echo 'setTimeout(function () { swal("Failed","Your password or username is incorrect","error");';
                  echo '}, 1000);</script>';

            
            
        }
      }
      else{
                      $password=($_POST["password"]);
            $found_user=$user->admin_login($userName,$password);
            if($found_user!=null){
                          $session->login($found_user);
                header("Location: includes/adminHome.php");}
            else
            {
              
            $message ="Your account will be activate on the ".$myDate  ;
                            echo '<script type="text/javascript">';
                  echo 'setTimeout(function () { swal("Failed","Wrong password","error");';
                  echo '}, 1000);</script>';

                
            }
      }

  } 
        else
        {
             $message ="Please type username and password";
                             	          echo '<script type="text/javascript">';
                  echo 'setTimeout(function () { swal("Failed","Please type username and password","error");';
                  echo '}, 1000);</script>';

        }

    }

           

?>



<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.8">

  <title>Login</title>
  
  
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css'>
 <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'>

      <link rel="stylesheet" href="css/login.css">

  
</head>

<body>

  
<div class="wrapper animated bounce">
  <h1>EasyGuest</h1>
  <hr>
  <h1 style="position:relative; right:450px; font-size:25px;"><pre>
  guest User Name: 11111111       Employee User Name: admin
  guest Password: 123123123       Employee Password: admin </pre></h1>

  <form method="post" action="index.php">
    <label id="icon" for="username"><i class="fa fa-user"></i></label>
    <input type="text" placeholder="Order Number" id="username" name="userName">
    <label id="icon" for="password"><i class="fa fa-key"></i></label>
    <input type="password" placeholder="Password" id="password" name="password">
    <input type="submit" value="Sign In" name="signIn">
    <hr>
    <div class="crtacc"><a href="includes/checkin.php">New guest? Check-in</a></div>
  </form>
</div>
  
  

    <script  src="js/login.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>




</body>

</html>
