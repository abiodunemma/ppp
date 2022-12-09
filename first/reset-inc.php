<?php 
  if (isset($_POST["submit"])) {

  $selector = $_POST["selector"];
  $validator = $_POST["validator"];
  $password = $_POST["pwd"];
  $passwordRepeat = $_POST["pwd_repeat"];


  if (empty($password) || empty($passwordRepeat)) {
     header("location: now.php");
     exit();

  } else if($password != $passwordRepeat) {
    header("location: home.php?newpwd=pwdnotsame");
    exit();
  }


  }else {
    header("location: home.php");
  }











?>