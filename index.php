<?php
session_start();
$user_id = $_SESSION['user_id'];
echo "you are logged in as: " . $user_id, "\n";
?>
<!-- 1. create HTML5 doctype -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  
  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 
  Bootstrap is designed to be responsive to mobile.
  Mobile-first styles are part of the core framework.
   
  width=device-width sets the width of the page to follow the screen-width
  initial-scale=1 sets the initial zoom level when the page is first loaded   
  -->
  
  <meta name="author" content="Jianing Cai, Hao Liu, Xi Wang">
  <meta name="description" content="include some description about your page">  
    
  <title>Hoo's Listening</title>
  
  <!-- 3. link bootstrap -->
  <!-- if you choose to use CDN for CSS bootstrap -->  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
  <!-- you may also use W3's formats -->
  <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
  
  <!-- 
  Use a link tag to link an external resource.
  A rel (relationship) specifies relationship between the current document and the linked resource. 
  -->
  
  <!-- If you choose to use a favicon, specify the destination of the resource in href -->
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  
  <!-- if you choose to download bootstrap and host it locally -->
  <!-- <link rel="stylesheet" href="path-to-your-file/bootstrap.min.css" /> --> 
  
  <!-- include your CSS -->
  <!-- <link rel="stylesheet" href="custom.css" />  -->
       
</head>

<body>
<div class="container">
  <h1>Hoo's Listening</h1>  




  <!-- CDN for JS bootstrap -->
  <!-- you may also use JS bootstrap to make the page dynamic -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
  
  <!-- for local -->
  <!-- <script src="your-js-file.js"></script> -->  
  
</div>
<div class="row mb-3 mx-3">  
  <a href="profile.php">
  <input type="submit" class="btn btn-primary" name="actionBtn" value="My Profile" title="view my profile" />
 </a>
</div>
<div class="row mb-3 mx-3">  
  <a href="add.php">
  <input type="submit" class="btn btn-primary" name="actionBtn" value="Add Track" title="click to insert song" />
 </a>
</div>
<div class="row mb-3 mx-3">  
  <a href="form.php">
  <input type="submit" class="btn btn-primary" name="actionBtn" value="Retrieve & Update Song" title="click to retrieve by title" />
  </a>  
</div>
<div class="row mb-3 mx-3"> 
  <a href="filter.php">
  <input type="submit" class="btn btn-primary" name="actionBtn" value="Filter" title="click to filter tracks" />
  </a>  
</div> 
<div class="row mb-3 mx-3"> 
  <a href="home.php">
  <input type="submit" class="btn btn-primary" name="actionBtn" value="Log Out" title="click to log out current account" />
  </a>  
</div>    
</body>
</html>