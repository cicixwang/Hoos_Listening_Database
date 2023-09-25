<?php
require("connect-db.php");
require("spotify-db.php");

session_start();
$user_id = $_SESSION['user_id'];

if ($user_id === NULL){
  echo "<p>You are currently logged out with limited functionality</p>";
}else{
  echo "<p>You are currently logged in as $user_id</p>";
}


function getRandomStringRand($length = 22)
{
    $stringSpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $stringLength = strlen($stringSpace);
    $randomString = '';
    for ($i = 0; $i < $length; $i ++) {
        $randomString = $randomString . $stringSpace[rand(0, $stringLength - 1)];
    }
    return $randomString;
}

if ($_SERVER['REQUEST_METHOD']=='POST')
{
    if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Add Track"))
    {
    $song_id = getRandomStringRand();
    $album_id = getRandomStringRand();
    $artist_id = getRandomStringRand();

    addTrack_Song($song_id, $_POST['title'], $_POST['duration'], $artist_id);

    addTrack_Album($album_id, $_POST['album_name'], $_POST['album_type'], $_POST['num_of_tracks'], $_POST['release_year'], $artist_id);

    addTrack_AlbumName_ArtistID($artist_id,$_POST['album_name'],$album_id);

    addTrack_Artist($artist_id, $_POST['name'], $_POST['country']);

    addTrack_SongTitle_AlbumID($_POST['title'],$album_id,$song_id);
   
    addTrack_SongTitle_ArtistID($_POST['title'],$artist_id,$album_id);

    addTrack_Song_Genre($song_id, $_POST['genre']);

    addTrack_Song_Language($song_id, $_POST['language']);
    
    echo "<br>song_id added successfully! song_id = " . $song_id;
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
  <h1>Hoo's Listening</h1>  

  <form name="mainForm" action="add.php" method="post">   
    <div class="row mb-3 mx-3">
      Track Title:      
      <input type="text" class="form-control" name="title" 
        value="<?php echo $track_to_update[0]['title']; ?>" 
      />
    </div> 
    <div class="row mb-3 mx-3">
      Release Year:
      <input type="text" class="form-control" name="release_year" 
      value="<?php if ($track_to_update!=NULL) echo $track_to_update[0]['release_year']; ?>" 
      />        
    </div>  
    <div class="row mb-3 mx-3">
      Duration:
      <input type="text" class="form-control" name="duration" 
      value="<?php if ($track_to_update!=NULL) echo $track_to_update[0]['duration']; ?>" 
      />        
    </div> 
    <div class="row mb-3 mx-3">
      Album Name:
      <input type="text" class="form-control" name="album_name" 
      value="<?php if ($track_to_update!=NULL) echo $track_to_update[0]['album_name']; ?>" 
      />       
    </div> 
    <div class="row mb-3 mx-3">
      Album Type:
      <input type="text" class="form-control" name="album_type" 
      value="<?php if ($track_to_update!=NULL) echo $track_to_update[0]['album_type']; ?>" 
      />          
    </div> 
    <div class="row mb-3 mx-3">
      Number of Tracks in Album:    
      <input type="text" class="form-control" name="num_of_tracks" 
      value="<?php if ($track_to_update!=NULL) echo $track_to_update[0]['num_of_tracks']; ?>" 
      />             
    </div> 
    <div class="row mb-3 mx-3">
      Language:
      <input type="text" class="form-control" name="language" 
      value="<?php if ($track_to_update!=NULL) echo $track_to_update[0]['language']; ?>" 
      />        
    </div> 
    <div class="row mb-3 mx-3">
      Genre:
      <input type="text" class="form-control" name="genre" 
      value="<?php if ($track_to_update!=NULL) echo $track_to_update[0]['genre']; ?>" 
      />        
    </div> 
    <div class="row mb-3 mx-3">
      Artist Name:
      <input type="text" class="form-control" name="name" 
      value="<?php if ($track_to_update!=NULL) echo $track_to_update[0]['name']; ?>" 
      />        
    </div> 
    <div class="row mb-3 mx-3">
      Artist Country:
      <input type="text" class="form-control" name="country" 
      value="<?php if ($track_to_update!=NULL) echo $track_to_update[0]['country']; ?>" 
      />          
    </div> 

    <div class="row mb-3 mx-3">  
    <input type="submit" class="btn btn-primary" name="actionBtn" value="Add Track" title="click to insert song" />
    </div>
</form>
<div class="row mb-3 mx-3">  
      <a href="index.php">
      <input type="submit" class="btn btn-primary" name="actionBtn" value="Go to Home Page" title="go back to home page" />
    </a>
    </div>
</div>    
</body>
</html>