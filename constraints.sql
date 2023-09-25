/** Advanced SQL Commands **/
ALTER TABLE Song 
ADD CONSTRAINT checkReleaseYear
CHECK (release_year <= 2023); 


DELIMITER $$
CREATE TRIGGER popularityTrigger
BEFORE UPDATE ON Song
FOR EACH ROW
BEGIN
        IF new.popularity > 100 THEN
                SET new.popularity = 100;
        ELSEIF new.popularity < 0 THEN
                SET new.popularity = 0;
        END IF;
END
$$
DELIMITER ; 


CREATE ASSERTION maxPlaylist
CHECK (25 >= ALL
(SELECT COUNT(*)
 FROM Playlist
 GROUP BY user_id))




/** Database Level Security **/


/* Check, Assertion, and Trigger */
ALTER TABLE Song 
ADD CONSTRAINT checkReleaseYear
CHECK (release_year <= 2023); 


DELIMITER $$
CREATE TRIGGER popularityTrigger
BEFORE UPDATE ON Song
FOR EACH ROW
BEGIN
        IF new.popularity > 100 THEN
                SET new.popularity = 100;
        ELSEIF new.popularity < 0 THEN
                SET new.popularity = 0;
        END IF;
END
$$
DELIMITER ; 


CREATE ASSERTION maxPlaylist
CHECK (25 >= ALL
(SELECT COUNT(*)
 FROM Playlist
 GROUP BY user_id))


/* Grant Statements */


GRANT ALL PRIVILEGES
ON UVA_User
TO Owner;


GRANT INSERT
ON UVA_User
TO PUBLIC;




/** Application Level Security **/


-- Try-Exception method in multiple files
/* connect to the database */
try 
{
//  $db = new PDO("mysql:host=$hostname;dbname=db-demo", $username, $password);
   $db = new PDO($dsn, $username, $password);
   
   // dispaly a message to let us know that we are connected to the database 
   echo "<p>You are connected to the database: $dsn</p>";
}
catch (PDOException $e)     // handle a PDO exception (errors thrown by the PDO library)
{
   // Call a method from any object, use the object's name followed by -> and then method's name
   // All exception objects provide a getMessage() method that returns the error message 
   $error_message = $e->getMessage();        
   echo "<p>An error occurred while connecting to the database: $error_message </p>";
}
catch (Exception $e)       // handle any type of exception
{
   $error_message = $e->getMessage();
   echo "<p>Error message: $error_message </p>";
}


/* retrieve song by title */
try{
      $song_retrieved_by_title = retrieveSongByTitle($_POST['title']);
    }
    catch (Exception $e){
      echo $e->getMessage();
    }


-- Password Hashing
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


-- Prepare Statements in multiple functions - below are a couple of examples
function retrieveSongByArtist($artistName){
  global $db;
  $query = "select * 
            from Song 
            inner join SongTitle_ArtistID 
            on Song.title = SongTitle_ArtistID.title and Song.artist_id = SongTitle_ArtistID.artist_id
            inner join Album
            on SongTitle_ArtistID.album_id = Album.album_id
            natural join Song_Language
            natural join Song_Genre
            inner join Artist
            on Artist.artist_id = Song.artist_id
            where Artist.name=:artistName
            ";
  $statement = $db->prepare($query);
  $statement->bindValue(':artistName', $artistName);
  $statement->execute();
  $result = $statement->fetchAll();
  //close cursor
  $statement->closeCursor();    
  return $result;
}


function addTrack_AlbumName_ArtistID($artist_id, $album_name, $album_id){
  global $db;
  $query = "insert into AlbumName_ArtistID(artist_id,album_name,album_id) values (:artist_id,:album_name,:album_id)";


  $statement = $db->prepare($query);
  $statement->bindValue(':artist_id', $artist_id);
  $statement->bindValue(':album_name', $album_name);
  $statement->bindValue(':album_id', $album_id);
  $statement->execute();
  $statement->closeCursor();
}