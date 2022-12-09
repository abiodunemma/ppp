<?php
  include_once "config/connect.php";
  include_once "config/session.php";
  include_once "config/utilities.php";


?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/font-awesome.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

/* Add a gray background color with some padding */
body {
  font-family: Arial;
  padding: 20px;
  background: #000000;
}

/* Header/Blog Title */
.header {
    background: linear-gradient(125deg,#778beb,#f8a5c2);
    width: 100%;
    padding: 6px;
    text-align: center;
    box-shadow: 0 0 20px #00000060;
    float: left;
    
}
.header li {
    display: inline;
    
    margin-left: 1px;
}
.top-icons{
    display: flex;
    justify-content: space-around;
}
.top-icons img{
    width:60px;
    border-radius: 50%;
}
    </style>
    <body>

    


<div class="header">
    
    <div class="top-icons">
                    <div>
                    <img src=" img/b1.jpg"  class="user-img">
    </div>
    </div>
        <ul id ="list">
      
    
    
    <?php  if(!isset($_SESSION['username'])): ?>
      <li><a href="Profile.php" class="scroll">Profile</a></li>
      <li><a href="#feed.php" class="scroll">Feed</a></li>
        <li><a href="#pre.php" class="scroll">Pricing</a></li>
        <li><a href="now.php" class="scroll">Notification</a></li>
        <li><a href="#logout.php" class="scroll">logout</a></li>
        <?php  if(isset($_SESSION['username'])) echo $_SESSION['username'];?>
     <?php else: ?>
      <li><a href="signup.php" class="scroll">Signup</a></li>
        <li><a href="login.php" class="scroll">Login</a></li>
        <li><a href="#feed.php" class="scroll">Feed</a></li>
        <li><a href="#pre.php" class="scroll">Pricing</a></li>
        <li><a href="now.php" class="scroll">Notification</a></li>
      <?php endif ?>

    
    
    
    </ul>
                         
        <div>
    </body>