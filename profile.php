<?php
require("connect-db.php");
require("spotify-db.php");

session_start();
$user_id = $_SESSION['user_id'];
// $user_name = $_SESSION['user_name'];
// $user_id = "5901po";
// $user_name = "Peter Roberts";
$output_songid = NULL;
$output_tracks = NULL;

$output_songid = retrieveSongidByUserid($user_id);
//var_dump($output_songid);

if ($_SERVER['REQUEST_METHOD']=='POST')
{
  if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Unlike this song"))
  {
    try{
      //$song_retrieved_by_title = retrieveSongByTitle($_POST['title']);
    }
    catch (Exception $e){
      echo $e->getMessage();
    }
    //var_dump($song_retrieved_by_title);
    //$output_tracks = $song_retrieved_by_title;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  
  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">  
    
  <title>Hoo's Listening</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  
       
</head>
<body>
<div class="container">
  <h1>My Profile</h1>  

  <form name="mainForm" action="profile.php" method="post">   
    <!-- <div class="row mb-3 mx-3">
      User name:      
      <?php echo $user_name; ?>
    </div>  -->
    <div class="row mb-3 mx-3">
      User ID:
      <?php echo $user_id; ?>    
    </div>  
</form>
    <div class="row mb-3 mx-3">  
      <a href="index.php">
      <input type="submit" class="btn btn-primary" name="actionBtn" value="Go to Home Page" title="click to insert song" />
      </a>
    </div>

    <hr/>
  <h2>Liked Tracks</h2>
  <div class="row justify-content-center">  
    <table class="w3-table w3-bordered w3-card-4 center" style="width:100%">
      <thead>
        <tr style="background-color:#B0B0B0">
          <th>Song Title</th>        
          <th>Release Year</th>        
          <th>Duration</th> 
          <th>Album Name</th>        
          <th>Album Type</th>        
          <th>Number of Tracks</th> 
          <th>Language</th>        
          <th>Genre</th>        
          <th>Artist Name</th> 
          <th>Artist Country</th>
        </tr>
      </thead>
      <?php foreach ($output_songid as $item): ?>
        <tr>
        <!-- <td><?php $output_tracks = retrieveSongByID($item[0]);?></td> -->
        <td><?php echo $output_tracks[0]['title']; ?></td>
        <td><?php echo $output_tracks[0]['release_year']; ?></td>        
        <td><?php echo $output_tracks[0]['duration']; ?></td>
        <td><?php echo $output_tracks[0]['album_name']; ?></td>
        <td><?php echo $output_tracks[0]['album_type']; ?></td>
        <td><?php echo $output_tracks[0]['num_of_tracks']; ?></td>
        <td><?php echo $output_tracks[0]['language']; ?></td>
        <td><?php echo $output_tracks[0]['genre']; ?></td>
        <td><?php echo $output_tracks[0]['name']; ?></td>
        <td><?php echo $output_tracks[0]['country']; ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
  </div>

</div>    
</body>
</html>