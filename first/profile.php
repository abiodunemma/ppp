<?php 
include_once 'config/connect.php';
include_once 'config/session.php';
include_once 'config/utilities.php';
include_once 'parseprofile.php';


error_reporting();





?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> user profile</title>
</head>
<style>
*{
    margin:0;
    padding:0;
    font-family: 'Poppins', sans-serif;
    box-sizing: border-box;
}



.profile{
    width: 100%;
    max-width: 100%;
    background: gray;
    text-align: center;
    padding: 30px 20px;
    box-shadow: 0 10px 40px rbga(0, 0, 0.2);
    border-radius: 5px;
}
.top-icons{
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}
.user-img{
    width: 100;
    
}

.profile h2{
    font-weight: 500;
    font-size: 22px;
    margin-top: 0;
    color: white;

}
.profile p{
    font-size: 12px;
    color: white;
}

.btn{
    text-decoration: none;
    color: #fff;
    border-radius: 100px 400px;
    border-radius: 2px;
    background: linear-gradient(to right, #8d68c5, #e34494);
    display: inline-block;
    margin: 40px 0;
    font-size: 50px;

}
.social-media{
    display: flex;
    justify-content: space-around;

}
.social-media img{
    width:60px;
    border-radius: 50%;

}
.social-media h3{
    font-weight: 500;
    font-size: 16px;

}
.social-media div{
    margin: 10px 0 30px;
}
    </style>
<body>
    <div class="container">
        <div class="profile">
            <div class="top-icons">
                <div>
                <i class=" ">    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></i>
</div>


<i class=" ">   <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg></i>
</div>   
<img src="<?php if(isset($profile_picture)) echo $profile_picture; ?>" class="user-img">
<h2>
      
<?php if(!isset($_SESSION['username'])): ?>
                    <p> you are not authorized to view this page <a href="login.php">login</a>
                 not yet a member? <a href="signup.php"> signup</a></p>
                 <?php else: ?>
</h2>


<p>

<section class="col col-lg-7">

 <table class="table table-bordered table-condensed">
    <tr><th style="width: 20%;">Username:</th><td><?php if(isset($username)) echo $username; ?></td></tr>
    <tr><th>Email:</th><td><?php if(isset($email)) echo $email; ?></td></tr>
    <tr><th> time:</th><td><?php if(isset($email)) echo $join_data; ?></td></tr>
<tr><th></th><td><a class="pull-right" href="rest.php?user_identity=<?php if(isset($encode_id)) echo $encode_id; ?>"></a></td>
<a href="reset.php?user_identity=<?php if(isset($encode_id)) echo $encode_id; ?>">reset</a>


</table>






</section>

                <?php endif ?>


</div>
<div class="social-media">
    <div>
        <img src="img/b1.jpg">
        <h3>20.4k</h3>
        <p>Amonunt</p>
</div>
<div>
        <img src="img/b1.jpg" >
        <h3>20.4k</h3>
        <p>Amonunt</p>
</div>
<div>
        <img src="img/b1.jpg">
        <h3>20.4k</h3>
        <p>Amonunt</p>

</div>
</div>
</div>
</body>
</html>
