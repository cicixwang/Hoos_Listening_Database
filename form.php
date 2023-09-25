<?php
require("connect-db.php");
require("spotify-db.php");

session_start();
$user_id = $_SESSION['user_id'];
$output_tracks = NULL;
$song_retrieved_by_title = NULL;
$song_retrieved_by_artist = NULL;
$track_to_update = NULL;

if ($user_id === NULL){
  echo "<p>You are currently logged out with limited functionality</p>";
}else{
  echo "<p>You are currently logged in as $user_id</p>";
}

// function getRandomStringRand($length = 22)
// {
//     $stringSpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $stringLength = strlen($stringSpace);
//     $randomString = '';
//     for ($i = 0; $i < $length; $i ++) {
//         $randomString = $randomString . $stringSpace[rand(0, $stringLength - 1)];
//     }
//     return $randomString;
// }

if ($_SERVER['REQUEST_METHOD']=='POST')
{
  if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Retrieve Song By Title"))
  {
    try{
      $song_retrieved_by_title = retrieveSongByTitle($_POST['title']);
    }
    catch (Exception $e){
      echo $e->getMessage();
    }
    //var_dump($song_retrieved_by_title);
    $output_tracks = $song_retrieved_by_title;
  }
  else if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Retrieve Song By Artist"))
  {
    try{
      $song_retrieved_by_artist = retrieveSongByArtist($_POST['name']);
  }
    catch (Exception $e){
      echo $e->getMessage();
    }
    //var_dump($song_retrieved_by_artist);
    $output_tracks = $song_retrieved_by_artist;
  }
  // else if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Add Track"))
  // {
  //   $song_id = getRandomStringRand();
  //   $album_id = getRandomStringRand();
  //   $artist_id = getRandomStringRand();

  //   addTrack_Song($song_id, $_POST['title'], $_POST['duration'], $artist_id);

  //   addTrack_Album($album_id, $_POST['album_name'], $_POST['album_type'], $_POST['num_of_tracks'], $_POST['release_year'], $artist_id);

  //   addTrack_AlbumName_ArtistID($artist_id,$_POST['album_name'],$album_id);

  //   addTrack_Artist($artist_id, $_POST['name'], $_POST['country']);

  //   addTrack_SongTitle_AlbumID($_POST['title'],$album_id,$song_id);
   
  //   addTrack_SongTitle_ArtistID($_POST['title'],$artist_id,$album_id);

  //   addTrack_Song_Genre($song_id, $_POST['genre']);

  //   addTrack_Song_Language($song_id, $_POST['language']);
    
  //   echo "<br>song_id added successfully! song_id = " . $song_id;
  // }
  else if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Like"))
  {
    $track_to_like = retrieveSongByTitle($_POST['track_to_like']); // ======= editing =======
    $song_id = $track_to_like[0]['song_id'];
    $title = $track_to_like[0]['title'];

    add_User_Like($user_id, $song_id);
    echo "<br>added track to your liked successfully!";
    //echo "<br>song_id: " . $song_id, "\n";
    // echo "<br>song_id type: " . gettype($song_id), "\n";
    //echo "<br>user_id: " . $user_id, "\n";
    // echo "<br>user_id type: " . gettype($user_id), "\n";
    echo "<br>title: " . $title, "\n";
  }
  else if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Delete"))
  {
    $track_to_delete = retrieveSongByTitle($_POST['track_to_delete']);
    $song_id = $track_to_delete[0]['song_id'];
    $album_id = $track_to_delete[0]['album_id'];
    $artist_id = $track_to_delete[0]['artist_id'];
    $title = $track_to_delete[0]['title'];

    deleteTrack_Song($song_id);
    deleteTrack_SongTitle_ArtistID($title,$artist_id);
    deleteTrack_SongTitle_AlbumID($song_id);
    deleteTrack_Song_Language($song_id);
    deleteTrack_Song_Genre($song_id);
    deleteTrack_Contain ($song_id);
    deleteTrack_User_Like ($song_id);

    echo "<br>track deleted successfully!";
    echo "<br>song_id: " . $track_to_delete[0]['song_id'];
    echo "<br>title: " . $track_to_delete[0]['title'];
  }
  else if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Update"))
  {
    $track_to_update = retrieveSongByTitle($_POST['track_to_update']);
  }

  if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Confirm Update"))
  {
    $updated = retrieveSongByTitle($_POST['title']);
    $song_id = $updated[0]['song_id'];
    $title = $updated[0]['title'];
    $album_id = $updated[0]['album_id'];
    $album_name = $updated[0]['album_name'];
    $artist_id = $updated[0]['artist_id'];

    $duration = $_POST['duration'];
    $album_type =  $_POST['album_type'];
    $num_of_tracks = $_POST['num_of_tracks'];
    $release_year = $_POST['release_year'];
    $name = $_POST['name'];
    $country = $_POST['country'];

    // echo "<br>duration type:" . gettype($duration), "\n";
    // echo "<br>album_type type:" . gettype($album_type), "\n";
    // echo "<br>num_of_tracks type:" . gettype($num_of_tracks), "\n";
    // echo "<br>release_year type:" . gettype($release_year), "\n";
    // echo "<br>name type:" . gettype($name), "\n";
    // echo "<br>country type:" . gettype($country), "\n";

    updateTrack_Song($song_id, $duration);
    updateTrack_Album($album_id, $album_type, $num_of_tracks, $release_year);
    updateTrack_Artist($artist_id, $name, $country);

    echo "<br>track updated successfully!";
    //echo "<br>song_id: " . $song_id;
    echo "<br>updated song: " . $title;
    // echo "<br>album_id: " . $album_id;
    // echo "<br>num_of_tracks: " . $_POST['num_of_tracks'];
    // echo "<br>release_year: " . $_POST['release_year'];
    // echo "<br>name: " . $_POST['name'];
    // echo "<br>country: " . $_POST['country'];
    // echo "<br>num_of_tracks type:" . gettype($num_of_tracks), "\n";

   // var_dump(retrieveSongByTitle($_POST['title']));
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
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">  
    
  <title>Hoo's Listening</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  
       
</head>

<body>
<div class="container">
  <h1>Hoo's Listening</h1>  

  <form name="mainForm" action="form.php" method="post">   
    <div class="row mb-3 mx-3">
      Track Title:      
      <input type="text" class="form-control" name="title" 
        value="<?php if ($track_to_update!=NULL) echo $track_to_update[0]['title']; ?>" 
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

    <!-- <div class="row mb-3 mx-3">  
    <input type="submit" class="btn btn-primary" name="actionBtn" value="Add Track" title="click to insert song" />
    </div> -->
    <div class="row mb-3 mx-3">  
    <input type="submit" class="btn btn-primary" name="actionBtn" value="Retrieve Song By Title" title="click to retrieve by title" />
    </div>
    <div class="row mb-3 mx-3">  
    <input type="submit" class="btn btn-primary" name="actionBtn" value="Retrieve Song By Artist" title="click to retrieve by title" />
    </div>
    <div class="row mb-3 mx-3">  
    <input type="submit" class="btn btn-primary" name="actionBtn" value="Confirm Update" title="click to update a track" />
    </div>
  </form>   

  <div class="row mb-3 mx-3">  
      <a href="index.php">
      <input type="submit" class="btn btn-outline-dark" name="actionBtn" value="Go to Home Page" title="click to go back to home page" />
      </a>
  </div>


  <hr/>
  <h2>List of Tracks</h2>
  <div class="row justify-content-center">  
    <table class="w3-table w3-bordered w3-card-4 center" style="width:100%">
      <thead>
        <tr style="background-color:#B0B0B0; font-size:14px;">
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
          <th>Update</th>
          <th>Delete</th>
          <th>Like</th>
        </tr>
      </thead>
    <?php foreach ($output_tracks as $item): ?>
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
        <td>
          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="submit" name="actionBtn" value="Like" class="btn btn-outline-success" title="Like the track" />      
            <input type="hidden" name="track_to_like" value="<?php echo $item['title']; ?>" />
          </form>
        </td>
        <td>
          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="submit" name="actionBtn" value="Update" class="btn btn-outline-info" title="Update the track" />             
            <input type="hidden" name="track_to_update" value="<?php echo $item['title']; ?>" />
          </form> 
        </td>
        <td>
          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="submit" name="actionBtn" value="Delete" class="btn btn-outline-danger" title="Permanently delete the track" />      
            <input type="hidden" name="track_to_delete" value="<?php echo $item['title']; ?>" />
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
    </table>
  </div>

</div>    
</body>
</html>