<?php 
include_once 'config/connect.php';
include_once 'config/session.php';
//process the form if the password is clicked


if(isset($_POST['passwordResetBtn'])) {

$selector = bin2hex(random_bytes(8));
$token = random_bytes(32);
$url = "http://localhost/first/now.php?selector=". $selector . "$validator=" . bin2hex($token);

$expires = date("U") + 1800;

require 'config/connect.php';

$userEmail = $_POST["email"]; 

$sql = "DELETE FROM pwdReset WHERE pwdResetEmail=? ";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    "<script>alert('There was an Error.') </script>"; 
  exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);
}

$sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES(?, ?, ?, ?);";


$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    "<script>alert('There was an Error.') </script>"; 
  exit();
} else {
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
    mysqli_stmt_execute($stmt);
}
 mysqli_stmt_close($stmt);

 

 $to = $userEmail;

$subject = 'Reset your password ';

$message = '<p> We recieved a  password reset request. The link to rest your password make this request, you cane ignore this email</p>';
$message .= '<p>Here is your password reset link: </br>';
$message .= '<a href= "' .$url. '">' . $url . '</a></p>';


$headers = "From: http://localhost/first@gmail.com\r\n";
$headers = "Reply-To: http://localhost/first@gmail.com\r\n";

mail($to, $subject, $message, $headers);


header('location: signup.php');



 




}else{
    header('location: php');






}


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
  <title>login</title>
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

 <form class="box" action="" method="POST">
     <h1>Password Reset</h1>
     <p> An email will be sent to you so as to confirm the reset.</p>
     <input type="email" name="email" placeholder="Email"  value=""required>    
     <input type="submit" name="passwordResetBtn" value="Reset password">
 </form>
 <?php 
  if (isset($_GET['reset'])) {
    if ($_GET["reset"] == "success"){
        echo  "<script>alert('Signupsuccessfull. check your')</script>"; 
    }
  }
 
 
 
 
 
 
 
 ?>
</body>

</html>