<?php 
function check_empty_fields($required_fields_array) {
    $form_errors = array();
    //loop through the required fields arry and popular the arror array

    foreach($required_fields_array as $name_of_field) {
        if(!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL){
            $form_errors[] = $name_of_field . "is a required field";
        }
        }
return $form_errors;
    }

/**
 * @param $field_to check_length, an array containing the name of fields
 * for which we want tocheck min required length e.g array('usernmae' =>6, 'email => 6)
 * @return array, containing all errors
 */

function username_text($field_to_check_username_text){
 $form_errors = array();
 foreach($field_to_check_username_text as $username){
     
 }

}


function check_min_length($fields_to_check_length) {

    $form_errors = array();

    foreach($fields_to_check_length as $name_of_field => $minimum_length_required){
    if(strlen(trim($_POST[$name_of_field])) < $minimum_length_required) {
        $form_errors[] = $name_of_field. "is too short, must be {$minimum_length_required} charaters long";

}
}
return $form_errors;
}
 
function check_email($data) {
    $form_errors = array();
    $key ='email';
    if(array_key_exists($key, $data)){

        if($_POST[$key] != null){

            $key = filter_var($key, FILTER_SANITIZE_EMAIL);
            if(filter_var($_POST[$key], FILTER_VALIDATE_EMAIL) === false) {
                $form_errors[] = $key . "is not a valid email address";
            }
        }
        }
        return $form_errors;
    }

function show_errors($form_errors_array) {
    $errors = "<p><ul style ='color: red;'>";
    foreach($form_errors_array as $the_error){
        $errors .= "<li>{$the_error} </li>";
    }
    $errors .= "</ul></p>";
    return $errors;

}

function flashMessage($message, $passOrFail = "Fail"){
    if($passOrFail === "Pass"){
        $data ="<p style ='padding:20px; border:1px solid gray; color:green;'>{$message};'> </p>";
    }else{
        $data =  "<p style='padding:20px; border: 1px solid gray; color:red;'>{$message}</p>"; 

    }
return $data;

}

function redirecTo($page) {
    header("location: {$page}.php");
}


function checkDuplicateEntries($table, $column_name, $value, $db){
    try{
$sqlQuery = "SELECT * FROM " .$table. "WHERE ".$column_name."=:$column_name";
$statement = $db->prepare($sqlQuery);
$statement->execute(array(':$column_name' => $value));

if($row = $statement->fetch()){

    return true;
}

return false;

    }catch (PDOException $ex){


    }
}

function rememberMe($user_id){
    $encryptCookieData = base64_encode("LOOOOOOOOOOL{$user_id}");
    setcookie("rememberUserCookie", $encryptCookieData, time()+60*60*24*100, "/");
}

function isCookieValid($db){
    $isValid = false;

    if (isset($_COOKIE['rememberUserCookie'])){

     $encryptCookieData = base64_decode($_COOKIE['rememberUserCookie']);
     $user_id = explode("LOOOOOOOOOOL", $encryptCookieData);
     $userID = $user_id[1];

     $sqlQuery = "SELECT * FROM users WHERE id = :id";
     $statement = $db->prepare($sqlQuery);
     $statement->execute(array(':id' => $userID));

     if($row = $statement->fetch()){
        $id = $row['id'];
        $username = $row['username'];

        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $isValid = true;
     }else{
        $isValid = false;
        signout();

     }

    }
    return $isValid;
}
function signout(){
    unset($_SESSION['username']);
    unset($_SESSION['id']);

    if(isset($_COOKIE['rememberUserCookie'])) {
        unset($_COOKIE['rememberUserCookie']);
        setcookie('rememberUserCookie', null, -1, '/');
    }
    session_destroy();
    session_regenerate_id(true);
    redirecTo(('index'));
}


function guard(){

    $isValid = true;

    $inactive = 60 * 2; //2 mins

    $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

    if((isset($_SESSION['fingerprint']) && $_SESSION['fingerprint'] != $fingerprint)){
        $isValid = false;

        signout();

    }else if((isset($_SESSION['last_active']) && (time() - $_SESSION['last_active']) > $inactive) && $_SESSION['username']){
        $isValid = false;

        signout();

    }else{
        $_SESSION['last_active'] = time();

    }
    return $isValid;


}

function isValidImage($file){
    $form_errors = array();

    $part = explode(".", $file);

    $extension = end($part);

    switch(strtolower($extension)){
        case 'jpg':
        case'gif':
        case 'bmp':
        case 'png':
            return $form_errors;
    }
    $form_errors[] = $extension . "is not a valid image extension";
    return $form_errors;
}

function uploadAvatar($username){
    $isImageMoved= false;

    if($_FILES['avatar']['tmp_name']){

        //file in temp location
        $temp_file = $_FILES['avatar']['tmp_name'];

        $ds = DIRECTORY_SEPARATOR; //uploads//
        $avatar_name = $username.".jpg";

        $path = "img.".$ds.$avatar_name; //uploads/demo.jpg

        if(move_uploaded_file($temp_file, $path)){
            $isImageMoved = true;
        }
    }
    return $isImageMoved;
}

















?>