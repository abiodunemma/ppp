<?php 
include_once 'config/session.php';
include_once 'config/connect.php';
include_once 'config/utilities.php';

if(isset($_POST['loginBtn'])) {

  $form_errors = array();

  $required_fields = array('username', 'password');

  $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
  
  if(empty($form_errors)){

    //collect from database
    $user = $_POST['username'];
    $password = $_POST['password'];

  isset($_POST['remember']) ? $remember = $_POST['remember'] : $remember = "";



    //check if user exist in the datta base
    $sqlQuery = "SELECT * FROM users WHERE username = :username";
    $statement = $db->prepare($sqlQuery);
    $statement->execute(array(':username' => $user));


    while($row = $statement->fetch()){
      $id = $row['id'];
      $hashed_password = $row['password'];
      $username = $row['username'];

      if(password_verify($password, $hashed_password)){
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;

  $fingerprint = md5($_SESSION['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
  $_SESSION['last_active'] = time();
  $_SESSION['fingerprint'] = $fingerprint;
  
        if($remember == "yes"){
          rememberMe($id);
        }

        redirecTo('index');
      }else{
        $result ="<p style ='color: red;'>The pasword or the username is wrong
        </p>";
      }
      }

  }else{
    if(count($form_errors) == 1){
      $result =   $result ="<p style ='color: red; There was one error in the form </p>";
    }else{
      $result ="<p style ='color: red;'> There were" .count($form_errors).  "error in the form </p>";
    }
  }

 
    
 

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
<?php if(isset($result)) echo $result; ?>
<?php if(!empty($form_erorrs)) echo show_errors($form_errors); ?>

 <form class="box" action="" method="POST">
     <h1>Login</h1>
     <input type="text" name="username" placeholder="Username"  value=""required>
     <input type="password" name="password" placeholder="password"  value="" required>
     <input type="submit" name="loginBtn" value="Signin">
      <input name="remember"  value="yes" type="checkbox"> remember Me
    </form>

</body>

</html>