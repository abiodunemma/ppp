<?php
include_once "config/connect.php";
include_once "config/utilities.php";

error_reporting(0);

if(isset($_POST['submit'])) {

  $form_errors = array();

  $required_fields = array('email', 'username', 'password');

  $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

  $required_fields = array('username', 'password');

  $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

 $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

 $form_errors = array_merge($form_errors, check_email($_POST));
  
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];


if(checkDuplicateEntries("users", "email", $email, $db)){
$result = flashMessage("Email is already taken, plase try");
  
}
else if(checkDuplicateEntries("users", "username", $username, $db)){
 $result = flashMessage("username is already taken");

}

else if(empty($form_errors)){
$hashed_password = password_hash($password, PASSWORD_DEFAULT);


try{
 $sqlInsert = "INSERT INTO users (username,email, password)
              VALUES (:username, :email, :password)";

  $statement = $db->prepare($sqlInsert);
  $statement->execute(array(':username' => $username, ':email' => $email, ':password' => $hashed_password));
  
  if($statement->rowCount() == 1){
    $result = "<p style='padding: 20px; color: green;'> succ</p>";
  }
  


}catch (PDOException $ex){
  $result = "<p style='padding: 20px; color: red;'>An error occurred:".$ex->getMessage()."</p>";
}
  }

else{
  if(count($form_errors) == 1){
    $result = "<p> Therewas 1 error in the form</p> ";

    $result .= "<ul style='color: red;'>";
    //loop through error array and display all items
    foreach($form_errors as $error){
      $result .= "<li> {$error} </li>";
    }
  $result .= "</ul></p>";
  }else{
    $result = "<p style='color: red;'> There were " .count($form_errors). "errors in the form <br>";
 
   $result.= "<ul style='color: red;'>";
   foreach($form_errors as $error){
    $result .= "<li {$error}</li>";
   }
 $result .= "<ul></p>";
  }
}
}
?>







<!DOCTYPE HTML>
<html>
<head>
  <title>Regrister</title>
  <style>
body{
      margin: 0;
      padding: 0;
      background: bisque;
  }
.signup-form{
  width: 300px;
  padding: 20px;
  text-align: center;
  background: url(19.png);
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  overflow: hiden;
}
.signup-form h1{
  margin-top: 100px;
  font-family: 'permanant Marker', cursive;
  color: #fff;
  font-size: 40px;
}
.signup-form input{
    display: block;
    width: 100%;
    padding: 0 16px;
    height: 44px;
    text-align: center;
    box-sizing: border-box;
    outline: none;
    border: none;
    font-family: "montserrat",sans-serif;
}
.txtb{
    margin: 20px 0;
    background: rgba(255,255,255,.5);
     border-radius: 6px;
}
.signup-btn{
    margin-top: 60px;
    margin-bottom: 20px;
    background: #487eb0;
    color: #fff;
    border-radius: 44px;
    cursor: pointer;
    transition: 0.8s;
}
.signup-btn:hover{
    transform: scale(0.96);
}
.signup-form a{
   text-decoration: none;
   color: ffff;
   font-family: "montserrat",sans-serif;
   font-size: 14px;
   padding: 10px;
   transition: 0.8s;
   display: block;
}
.signup-form a:hover{
     background: rgba(0,0,0,.3);
 }

</style>
</head>

<body>
 <?php  if(isset($result)) echo $result; ?>
  <div class="signup-form">
    <form clas="" action="" method="POST">
    <h1>Register</h1>
    <input type="email" placeholder=" Email" name="email" value=" " class="txtb" required>
    <input type="text" placeholder="Username"  name="username" value="" class="txtb"  required>
    <input type="password" placeholder="Password" name="password" value="" class="txtb" required >

    <input type="submit" name="submit"  class="sigup-btn">
    <a href="login.php">Already Have one ?.Login</a>
    </form>
 </div>
</body>

</html>