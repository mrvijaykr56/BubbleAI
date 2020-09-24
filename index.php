<?php

//index.php

//Include Configuration File
include('config.php');

$login_button = '';


if(isset($_GET["code"]))
{

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


 if(!isset($token['error']))
 {
 
  $google_client->setAccessToken($token['access_token']);

 
  $_SESSION['access_token'] = $token['access_token'];


  $google_service = new Google_Service_Oauth2($google_client);

 
  $data = $google_service->userinfo->get();

 
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}


if(!isset($_SESSION['access_token']))
{

 $login_button = '<a href="'.$google_client->createAuthUrl().'">Login With Google</a>';
}

if(!isset($_SESSION['access_token']))
{

 $login_button_fb = '<a href="'.$google_client->createAuthUrl().'">Login With Facebook</a>';
}



?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Bobble.AI</title>

  <link rel="stylesheet" href="style.css">

  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

  <header>
    <div class="brand">
      <h2>Bobble<span>AI</span></h2>
    </div>
  </header>
    <div class="wrap">
    <h3>SIGN UP</h3>
    <h2> Create your account</h2>
    <p>Lorem ipsum dolor sit amet consectetur.</p>
    <div class="social-media">
      
   <button><a href="#"><i class="fa fa-google" aria-hidden="true"></i> <?php
   if($login_button == '')
   {
    echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
    echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
    echo '<h3><a href="logout.php">Logout</h3></div>';
   }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
   }
   ?></a></button>


    <button><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i><?php
   if($login_button_fb == '')
   {
    echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
    echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
    echo '<h3><a href="logout.php">Logout</h3></div>';
   }
   else
   {
    echo '<div align="center">'.$login_button_fb . '</div>';
   }
   ?></a></button>
    </div>
    <p>or</p>
    <div>
      <form>
        <input type="text" id="fname" name="fname" placeholder="First Name"><br>
        <input type="text" id="lname" name="lname" placeholder="Last Name"><br>
        <input type="email" id="email" name="email" placeholder="Email Address"><br>
        <input type="password" id="password" name="password" placeholder="Password"><br>
        <p>By clicking Sign Up, you agree to our <span>Terms of Use</span> and our <span>Privacy Policy</span></p>
        <input type="submit" value="SIGN UP">
      </form>
    </div>
  </div>
   
   </div>
  </div>
 </body>
</html>
