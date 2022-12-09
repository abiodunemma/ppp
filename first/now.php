<?php 
include_once 'config/connect.php';
include_once 'config/utilities.php';
include_once 'config/session.php';


?>
















<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
  <title></title>
</head>

<style>

body{
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    background: linear-gradient(125deg,#778beb,#f8a5c2);

}
 .box{
     width: 300px;
     padding: 40px;
     position: absolute;
     top: 50%;
     left: 50%;
     transform: translate(-50%,-50%);
     background: linear-gradient(125deg,#778beb,#f8a5c2);
     text-align: center;
     border:1px solid white;
     border-radius:20px;
 }
 .box h1{
     color: white;
     text-transform: uppercase;
     font-weight: 500;
        }

        box input[type = "email"],.box input[type = "email"]
{
    border:0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #3498db;
    padding: 14px 10px;
    width: 200px;
    outline: none;
    color: white;
    border-radius: 100px;
    transition: 0.25s;
 }

.box input[type = "text"],.box input[type = "password"]
{
    border:0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #3498db;
    padding: 14px 10px;
    width: 200px;
    outline: none;
    color: white;
    border-radius: 100px;
    transition: 0.25s;
 }
  .box input[type = "text"]:focus,.box input[type = "password"]:focus{
   width: 280px;
   border-color: #2ecc71;
 }
 .box input[type = "email"]:focus,.box input[type = "email"]:focus{
   width: 280px;
   border-color: #2ecc71;
 }

.box input[type =  "submit"]{
    border:0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #2ecc71;
    padding: 14px 40px;
    outline: none;
    color: white;
    border-radius: 24px;
    transition: 0.25s;
    cursor: pointer;
}
.box input[type = "submit"]:hover{
  background: #2ecc71;
}

</style>
<body>





 <form class="box" action="Reset.php" method="POST">
     <h1>Password Reset</h1>
     <p> An email will be sent to you so as to confirm the reset.</p>
     <input type="hidden" name="selector"   value="<?php  echo $selector ?>"required>
     <input type="hidden" name="validator"   value="<?php  echo $validator ?>"required>
     <input type="password" name="pwd" placeholder="New password"  value=""required>    
     <input type="password" name="pwd-repeat" placeholder="confirm password"  value=""required>    
    
     <button type="submit" name="passwordResetBtn" value="Reset password">
 </form>
</body>

</html>

 
 