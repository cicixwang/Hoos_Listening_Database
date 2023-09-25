<?php
  session_start();
  include('connect-db.php');

  if (isset($_POST['login'])) {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    $query = $db -> prepare("SELECT * FROM UVA_User WHERE user_id=:user_id");
    $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
      echo '<p class="error">UserID password combination is wrong!</p>';
    } else {
        if (password_verify($password, $result['password'])) {
          $_SESSION['user_id'] = $result['user_id'];
          echo '<p class="success">Congratulations, you are logged in!</p>';
        //   echo '<div class="row mb-3 mx-3">  
        //   <a href="index.php">
        //   <input type="submit" class="btn btn-outline-dark" name="actionBtn" value="Go to Our Web Page" title="click to go back to home page" />
        //   </a>
        // </div>';
        header("Location: index.php");
        exit();
        } else {
          echo '<p class="error">Username password combination is wrong!</p>';
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
  
  
  <!-- include your CSS -->
  <!-- <link rel="stylesheet" href="custom.css" />  -->
       
</head>

<body>
<div class="container">
  <h1>Hoo's Listening</h1>    
</div>

<form method="post" action="" name="signin-form">
  <div class="form-element">
    <label>Computing ID</label>
    <input type="text" name="user_id" pattern="[a-zA-Z0-9]+" required />
  </div>
  <div class="form-element">
    <label>Password</label>
    <input type="password" name="password" required />
  </div>
  <button type="submit" name="login" value="login">Log In</button>
</form>
    
</body>
</html>

