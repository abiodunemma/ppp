<?php
include_once 'config/connect.php';
include_once 'config/utilities.php';
error_reporting();

if((isset($_SESSION['id']) || isset($_GET['user_identity'])) && !isset($_POST['updateProfileBtn'])){
    if(isset($_GET['user_identity'])){
        $url_encoded_id = $_GET['user_identity'];
        $decode_id = base64_decode($url_encoded_id);
        $user_id_array = explode("encodeuserid", $decode_id);
        $id = $user_id_array[1];
    }else{
        $id = $_SESSION['id'];

    }
   


    $sqlQuery = "SELECT * FROM users WHERE id = :id";
    $statement = $db->prepare($sqlQuery);
    $statement->execute(array(':id' => $id));

    while($rs = $statement->fetch()){
        $username= $rs['username'];
        $email = $rs['email'];
        $join_data = strftime("%b %d, %Y", strtotime($rs["join_data"]));

    }
    $encode_id = base64_encode("encodeuserid{$id}");

 $user_pic = "img/".$username. ".jpg";

 $default = "img/ja2.jpeg";
 

 if(file_exists($user_pic)){
    $profile_picture = $user_pic;
 }else{
    $profile_picture = $default;
 }



}else if(isset($_POST['updateProfileBtn'])){
    $form_errors = array();

    
  $required_fields = array('email', 'username');

  $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

  $fields_to_check_length = array('username' => 4);

  $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));
  
  $form_errors = array_merge($form_errors, check_email($_POST));

isset($_FILES['avatar']['name']) ? $avatar = $_FILES['avatar']['name'] : $avatar = null;

 if($avatar !=null){
    $form_errors = array_merge($form_errors, isValidImage($avatar));
 }



  $email = $_POST['email'];
  $username = $_POST['username'];
  $hidden_id = $_POST['hidden_id'];

if(empty($form_errors)){
    try{
        $sqlUpdate = "UPDATE users SET username =:username, email =:email WHERE id =:id";

        $statement = $db->prepare($sqlUpdate);

        $statement->execute(array(':username' => $username, ':email' => $email, ':id' => $hidden_id));

        if($statement->rowCount() == 1 || uploadAvatar($username)){
      $result =    "<script>alert('profile updated successfully')</script>";
    
        }else{
            $result = "<script>alert(' You have made no changes')</script>";
        }

    }catch (PDOException $ex){
        $result = flashMessage("An error occurred in : " .$ex->getMessage());

    }

    }
    else{
        if(count($form_errors) == 1){
            $result = flashMessage("There was 1 error in the form<br>");
        }else{
                $result = flashMessage("There were ".count($form_errors). "errors in the form <br>");
            }
        }
    }






































