<?php
  include_once "config/connect.php";
  include_once "config/session.php";
  include_once "config/utilities.php";


?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/font-awesome.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

/* Add a gray background color with some padding */
body {
  font-family: Arial;
  padding: 20px;
  background: #000000;
}

/* Header/Blog Title */
.header {
    background: linear-gradient(125deg,#778beb,#f8a5c2);
    width: 100%;
    padding: 6px;
    text-align: center;
    box-shadow: 0 0 20px #00000060;
    float: left;
    
}
.header li {
    display: inline;
    
    margin-left: 1px;
}
.top-icons{
    display: flex;
    justify-content: space-around;
}
.top-icons img{
    width:60px;
    border-radius: 50%;

}
h4{
    font-family: Arial, Helvetica, sans-serif;
}

/* Create two unequal columns that floats next to each other */
/* Left column */
.leftcolumn {
  float: left;
  width: 75%;
}

/* Right column */
.rightcolumn {
  float: left;
  width: 25%;
  padding-left: 20px;
}

/* Fake image */
.fakeimg {

  width: 100%;
   padding:20px;
   border: 0;
   border-radius:10px;
}
.a{
    border:1px so;
    border-radius:10px;
}

/* Add a card effect for articles */
.card {
   background-color: fuchsia;
   padding: 20px;
   margin-top: 20px;
   border:1px solid;
   border-radius:10px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Footer */
.footer {
  padding: 20px;
  text-align: center;
  background: #EE82EE;
  margin-top: 20px;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
  .leftcolumn, .rightcolumn {
    width: 100%;
    padding: 0;
  }
}
.icon{
    font-weight: 500;
    font-size: 16px;
    margin: 10px 0 30px;
}

* {box-sizing: border-box}
.mySlides1, .mySlides2 {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a grey background color */
.prev:hover, .next:hover {
  background-color: #f1f1f1;
  color: black;
}
</style>
</head>
<body>



<div class="header">
    
    <div class="top-icons">
                    <div>
                    <img src=" img/b1.jpg"  class="user-img">
    </div>
    </div>
        <ul id ="list">
        <li><a href="index.php" class="scroll">home</a></li>
  
    <?php  if(isset($_SESSION['username']) || isCookieValid($db)): ?>
      <li><a href="Profile.php" class="scroll">Profile</a></li>
      <li><a href="#feed.php" class="scroll">Feed</a></li>
        <li><a href="#pre.php" class="scroll">Pricing</a></li>
        <li><a href="now.php" class="scroll">Notification</a></li>
        <li><a href="logout.php" class="scroll">logout</a></li>
        <?php  if(isset($_SESSION['username'])) echo $_SESSION['username'];?>
     <?php else: ?>
      <li><a href="signup.php" class="scroll">Signup</a></li>
        <li><a href="login.php" class="scroll">Login</a></li>
        <li><a href="#feed.php" class="scroll">Feed</a></li>
        <li><a href="#pre.php" class="scroll">Pricing</a></li>
        <li><a href="now.php" class="scroll">Notification</a></li>
      <?php endif ?>




    <div>
  

</div>

</div>
</div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
  
<h2 style="text-align:center">Multiple Slideshows</h2>

<p>Slideshow 1:</p>
<div class="slideshow-container">
  <div class="mySlides1">
    <img src=" img/b1.jpg" style="width:100%">
  </div>

  <div class="mySlides1">
    <img src="img/lol.png" style="width:100%">
  </div>

  <div class="mySlides1">
    <img src="img/b1.jpg" style="width:100%">
  </div>

  <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
  <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
</div>

<p>Slideshow 2:</p>
<div class="slideshow-container">
  <div class="mySlides2">
    <img src="img/b1.jpg" style="width:100%">
  </div>

  <div class="mySlides2">
    <img src="img/lol.png" style="width:100%">
  </div>

  <div class="mySlides2">
    <img src="img/lol.png" style="width:100%">
  </div>

  <a class="prev" onclick="plusSlides(-1, 1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1, 1)">&#10095;</a>
</div>

<script>
let slideIndex = [1,1];
let slideId = ["mySlides1", "mySlides2"]
showSlides(1, 0);
showSlides(1, 1);

function plusSlides(n, no) {
  showSlides(slideIndex[no] += n, no);
}

function showSlides(n, no) {
  let i;
  let x = document.getElementsByClassName(slideId[no]);
  if (n > x.length) {slideIndex[no] = 1}    
  if (n < 1) {slideIndex[no] = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex[no]-1].style.display = "block";  
}
</script>
    </div>

  </div>
  <div class="rightcolumn">
    <div class="card">
      <h2>About Me</h2>
      <div class="fakeimg" style="height:100px;">Image</div>
      <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
    </div>
    <div class="card">
      <h3>Popular Post</h3>
      <div class="fakeimg">Image</div><br>
      <div class="fakeimg">Image</div><br>
      <div class="fakeimg">Image</div>
    </div>
    <div class="card">
      <h3>Follow Me</h3>
      <p>Some text..</p>
    </div>
  </div>
</div>

<div class="footer">
  <h2>PRO-XL</h2>
  <h5>
    copyright, 2022.adeyemi-abiodun
  </h5>
  
</div>
</body>
</html>