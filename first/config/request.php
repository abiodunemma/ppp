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
 mysqli_close($mysqli);

 

 $to = $userEmail;

$subject = 'Reset your password ';

$message = '<p> We recieved a  password reset request. The link to rest your password make this request, you cane ignore this email</p>';
$message .= '<p>Here is your password reset link: </br>';
$message .= '<a href= "' .$url. '">' . $url . '</a></p>';


$headers = "From: http://localhost/first@gmail.com\r\n";
$headers = "Reply-To: http://localhost/first@gmail.com\r\n";

mail($to, $subject, $message, $headers);


header("location: reset.php?reset=success");


}else{
    header('location: home.php');






}


?>



