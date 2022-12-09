<?php 
include_once 'config/connect.php';
include_once 'config/session.php';
include_once 'config/utilities.php';
include_once 'parseprofile.php';

error_reporting(0);
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
<?php if(!empty($form_errors)) echo show_errors($form_errors); ?>



<?php if(!isset($_SESSION['username'])): ?>
  <p> you are not authorized to view this page <a href="login.php">login</a>
                 not yet a member? <a href="signup.php"> signup</a></p>
                 <?php else: ?>

 <form class="box" action="" method="post" enctype="multipart/form-data">
     <h1>profile edit</h1>
     <label for="fileField">avatar</label>
     <input type="file" name="avatar" id="fileField"  required>

     <input type="text" name="email" placeholder="Email" id="emailField" value="<?php if(isset($email)) echo $email;?>"  required>    
     <input type="text" name="username" id="usernameField" value="<?php if(isset($username)) echo $username;?>" required>
         <input type="text" name="username" id="usernameField" value="<?php if(isset($username)) echo $username;?>" required>

     <input type="hidden" name="hidden_id"   value="<?php if(isset($id)) echo $id; ?>" required>
     <input type="submit" name="updateProfileBtn" value="Update Profile ">
 </form>
<?php endif ?>
<p> <a href="index.php">Back</a></p>
</body>

</html>





















