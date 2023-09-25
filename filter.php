<?php
require("connect-db.php");
require("spotify-db.php");
//test

session_start();
$user_id = $_SESSION['user_id'];

if ($user_id === NULL){
  echo "<p>You are currently logged out with limited functionality</p>";
}else{
  echo "<p>You are currently logged in as $user_id</p>";
}

$filter_result = NULL;
$song_filter_by_genre = NULL;
$song_filter_by_region = NULL;
$song_filter_by_year = NULL;

if ($_SERVER['REQUEST_METHOD']=='POST')
{
  if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "By Genre!"))
  {
    try{
      $song_filter_by_genre = filterTrackByGenre($_POST['genre']);
    }
    catch (Exception $e){
      echo $e->getMessage();
    }
    $filter_result = $song_filter_by_genre;
    
  }
  else if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "By Region!"))
  {
    try{
      $song_filter_by_region = filterTrackByRegion($_POST['region']);
  }
    catch (Exception $e){
      echo $e->getMessage();
    }
    $filter_result = $song_filter_by_region;
  }
  else if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "By Year!"))
  {
    try{
      $song_filter_by_year = filterTrackByYear($_POST['year']);
  }
    catch (Exception $e){
      echo $e->getMessage();
    }
    $filter_result = $song_filter_by_year;
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
    
  <title>Filter by ... ?</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  
       
</head>

<body>
<div class="container">
  <h1>Filter by ... ?</h1>  
  <form name="mainForm" action="filter.php" method="post">   
    <div class="row mb-3 mx-3">
      Genre:      
      <input type="text" class="form-control" name="genre" 
      />
    </div> 
    <div class="row mb-3 mx-3">  
    <input type="submit" class="btn btn-primary" name="actionBtn" value="By Genre!" title="filter by genre" />
    </div>
    <div class="row mb-3 mx-3">
      Region:
      <input type="text" class="form-control" name="region" 
      />        
    </div> 
    <div class="row mb-3 mx-3">  
    <input type="submit" class="btn btn-primary" name="actionBtn" value="By Region!" title="filter by region" />
    </div> 
    <div class="row mb-3 mx-3">
      Year:
      <input type="text" class="form-control" name="year" 
      />        
    </div> 
    <div class="row mb-3 mx-3">  
    <input type="submit" class="btn btn-primary" name="actionBtn" value="By Year!" title="filter by year" />
    </div>
</form>
<div class="row mb-3 mx-3">  
      <a href="index.php">
      <input type="submit" class="btn btn-primary" name="actionBtn" value="Go to Home Page" title="go back to home page" />
      </a>
    </div>

<hr/>
  <h2>List of Tracks</h2>
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
    <?php foreach ($filter_result as $item): ?>
      <tr>
        <td><?php echo $item['title']; ?></td>
        <td><?php echo $item['release_year']; ?></td>        
        <td><?php echo $item['duration']; ?></td>
        <td><?php echo $item['album_name']; ?></td>
        <td><?php echo $item['album_type']; ?></td>
        <td><?php echo $item['num_of_tracks']; ?></td>
        <td><?php echo $item['language']; ?></td>
        <td><?php echo $item['genre']; ?></td>
        <td><?php echo $item['name']; ?></td>
        <td><?php echo $item['country']; ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
  </div>

</div>    
</body>
</html>