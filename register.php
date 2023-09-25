<?php
  session_start();

  include('connect-db.php');

  if (isset($_POST['register'])) {
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $query = $db->prepare("SELECT * FROM UVA_User WHERE user_id=:user_id");
    $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0) {
      echo '<p class="error">The computing ID is already registered!</p>';
    }
    if ($query->rowCount() == 0) {
      $query = $db->prepare("INSERT INTO UVA_User(user_id,user_name,password) VALUES (:user_id,:user_name,:password_hash)");
      $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
      $query->bindParam("user_name", $user_name, PDO::PARAM_STR);
      $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
      $result = $query->execute();
      if ($result) {
        echo '<p class="success">Your registration was successful!</p>';
        // echo '<div class="row mb-3 mx-3">  
        // <a href="index.php">
        // <input type="submit" class="btn btn-outline-dark" name="actionBtn" value="Go to Our Home Page" title="click to go back to home page" />
        // </a>
        // </div>';
        header("Location: index.php");
        exit();
      } else {
        echo '<p class="error">Something went wrong!</p>';
      }
    }
  }

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
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  
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
</div>
  
<form method="post" action="" name="signup-form">
  <div class="form-element">
    <label>Computing ID</label>
    <input type="text" name="user_id" pattern="[a-zA-Z0-9]+" required />
  </div>
  <div class="form-element">
    <label>Name</label>
    <input type="text" name="user_name" required />
  </div>
  <div class="form-element">
    <label>Password</label>
    <input type="password" name="password" required />
  </div>
  <button type="submit" name="register" value="register">Register</button>
</form>
   
</body>
</html>


