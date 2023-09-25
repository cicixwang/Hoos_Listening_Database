<?php

function retrieveSongByTitle($title){
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
            where Song.title=:title
            ";
  $statement = $db->prepare($query);
  $statement->bindValue(':title', $title);
  $statement->execute();
  $result = $statement->fetchAll();
  //close cursor
  $statement->closeCursor();    
  return $result;
}

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

function retrieveSongByID($song_id){
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
            where Song.song_id=:song_id
            ";
  $statement = $db->prepare($query);
  $statement->bindValue(':song_id', $song_id);
  $statement->execute();
  $result = $statement->fetchAll();
  //close cursor
  $statement->closeCursor();    
  return $result;

}

//---------------------------add---------------------------------
//---------------------------------------------------------------

function addTrack_Song($song_id, $title, $duration, $artist_id){
  global $db;
  $query = "insert into Song(song_id, title, duration, artist_id) values (:song_id, :title, :duration, :artist_id)";

  $statement = $db->prepare($query);
  $statement->bindValue(':song_id', $song_id);
  $statement->bindValue(':title', $title);
  $statement->bindValue(':duration', $duration);
  $statement->bindValue(':artist_id', $artist_id);
  $statement->execute();
  $statement->closeCursor();
}

function addTrack_Album($album_id, $album_name, $album_type, $num_of_tracks, $release_year, $artist_id){
  global $db;
  $query = "insert into Album(album_id,album_name,album_type,num_of_tracks,release_year, artist_id) values (:album_id,:album_name,:album_type,:num_of_tracks,:release_year,:artist_id)";

  $statement = $db->prepare($query);
  $statement->bindValue(':album_id', $album_id);
  $statement->bindValue(':album_name', $album_name);
  $statement->bindValue(':album_type', $album_type);
  $statement->bindValue(':num_of_tracks', $num_of_tracks);
  $statement->bindValue(':release_year', $release_year);
  $statement->bindValue(':artist_id', $artist_id);
  $statement->execute();
  $statement->closeCursor();
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

function addTrack_Artist($artist_id, $name, $country){
  global $db;
  $query = "insert into Artist(artist_id,name,country) values (:artist_id,:name,:country)";

  $statement = $db->prepare($query);
  $statement->bindValue(':artist_id', $artist_id);
  $statement->bindValue(':name', $name);
  $statement->bindValue(':country', $country);
  $statement->execute();
  $statement->closeCursor();
}

function addTrack_SongTitle_AlbumID($title,$album_id,$song_id){
  global $db;
  $query = "insert into SongTitle_AlbumID(title,album_id,song_id) values (:title,:album_id,:song_id)";

  $statement = $db->prepare($query);
  $statement->bindValue(':title', $title);
  $statement->bindValue(':album_id', $album_id);
  $statement->bindValue(':song_id', $song_id);
  $statement->execute();
  $statement->closeCursor();
} 

function addTrack_SongTitle_ArtistID($title,$artist_id,$album_id){
  global $db;
  $query = "insert into SongTitle_ArtistID(title,artist_id,album_id) values (:title,:artist_id,:album_id)";

  $statement = $db->prepare($query);
  $statement->bindValue(':title', $title);
  $statement->bindValue(':artist_id', $artist_id);
  $statement->bindValue(':album_id', $album_id);
  $statement->execute();
  $statement->closeCursor();
} 

function addTrack_Song_Genre($song_id, $genre){
  global $db;
  $query = "insert into Song_Genre(song_id, genre) values (:song_id,:genre)";

  $statement = $db->prepare($query);
  $statement->bindValue(':song_id', $song_id);
  $statement->bindValue(':genre', $genre);
  $statement->execute();
  $statement->closeCursor();
}

function addTrack_Song_Language($song_id, $language){
  global $db;
  $query = "insert into Song_Language(song_id, language) values (:song_id,:language)";

  $statement = $db->prepare($query);
  $statement->bindValue(':song_id', $song_id);
  $statement->bindValue(':language', $language);
  $statement->execute();
  $statement->closeCursor();
}

//--------------------------delete-------------------------------
//---------------------------------------------------------------
function deleteTrack_Song($song_id){
  global $db;
  $query = "delete from Song where song_id = :song_id";
  $statement = $db->prepare($query);
  $statement->bindValue(':song_id', $song_id);
  $statement->execute();
  $statement->closeCursor();
}

function deleteTrack_SongTitle_ArtistID($title,$artist_id){
  global $db;
  $query = "delete from SongTitle_ArtistID where title = :title and artist_id = :artist_id";
  $statement = $db->prepare($query);
  $statement->bindValue(':title', $title);
  $statement->bindValue(':artist_id', $artist_id);
  $statement->execute();
  $statement->closeCursor();
}

function deleteTrack_SongTitle_AlbumID($song_id){
  global $db;
  $query = "delete from SongTitle_AlbumID where song_id = :song_id";
  $statement = $db->prepare($query);
  $statement->bindValue(':song_id', $song_id);
  $statement->execute();
  $statement->closeCursor();
}

function deleteTrack_Song_Language($song_id){
  global $db;
  $query = "delete from Song_Language where song_id = :song_id";
  $statement = $db->prepare($query);
  $statement->bindValue(':song_id', $song_id);
  $statement->execute();
  $statement->closeCursor();
}

function deleteTrack_Song_Genre($song_id){
  global $db;
  $query = "delete from Song_Genre where song_id = :song_id";
  $statement = $db->prepare($query);
  $statement->bindValue(':song_id', $song_id);
  $statement->execute();
  $statement->closeCursor();
}

function deleteTrack_Contain ($song_id){
  global $db;
  $query = "delete from Contain where song_id = :song_id";
  $statement = $db->prepare($query);
  $statement->bindValue(':song_id', $song_id);
  $statement->execute();
  $statement->closeCursor();
}

function deleteTrack_User_Like ($song_id){
  global $db;
  $query = "delete from User_Like where song_id = :song_id";
  $statement = $db->prepare($query);
  $statement->bindValue(':song_id', $song_id);
  $statement->execute();
  $statement->closeCursor();
}

//--------------------------update-------------------------------
//---------------------------------------------------------------
function updateTrack_Song($song_id, $duration){
  global $db;
  $query = "update Song 
            set duration = :duration
            where song_id = :song_id";
  $statement = $db->prepare($query);
  $statement->bindValue(':song_id', $song_id);
  $statement->bindValue(':duration', $duration);
  $statement->execute();
  $statement->closeCursor();
}

function updateTrack_Album($album_id, $album_type, $num_of_tracks, $release_year){
  global $db;
  $query = "update Album 
            set release_year = :release_year, album_type = :album_type, num_of_tracks = :num_of_tracks
            where album_id = :album_id";
  $statement = $db->prepare($query);
  $statement->bindValue(':album_id', $album_id);
  $statement->bindValue(':release_year', $release_year);
  $statement->bindValue(':album_type', $album_type);
  $statement->bindValue(':num_of_tracks', $num_of_tracks);
  $statement->execute();
  $statement->closeCursor();
}

function updateTrack_Artist($artist_id, $name, $country){
  global $db;
  $query = "update Artist 
            set name = :name, country = :country
            where artist_id = :artist_id";
  $statement = $db->prepare($query);
  $statement->bindValue(':artist_id', $artist_id);
  $statement->bindValue(':name', $name);
  $statement->bindValue(':country', $country);
  $statement->execute();
  $statement->closeCursor();
}

//--------------------------filter-------------------------------
//---------------------------------------------------------------
function filterTrackByGenre($genre){
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
            where Song_Genre.genre=:genre
            ";
  $statement = $db->prepare($query);
  $statement->bindValue(':genre', $genre);
  $statement->execute();
  $result = $statement->fetchAll();
  $statement->closeCursor();
  return $result;
}

function filterTrackByRegion($region){
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
            where Artist.country=:region
            ";
  $statement = $db->prepare($query);
  $statement->bindValue(':region', $region);
  $statement->execute();
  $result = $statement->fetchAll();
  $statement->closeCursor();
  return $result;
}


function filterTrackByYear($year){
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
            where Album.release_year=:year
            ";
  $statement = $db->prepare($query);
  $statement->bindValue(':year', $year);
  $statement->execute();
  $result = $statement->fetchAll();
  $statement->closeCursor();
  return $result;
}

//--------------------------like---------------------------------
//---------------------------------------------------------------
function add_User_Like($user_id, $song_id)
{
 global $db;
 $query = "insert into User_Like(user_id, song_id) values (:user_id, :song_id)";
 $statement = $db->prepare($query);
 $statement->bindValue(':user_id', $user_id);
 $statement->bindValue(':song_id', $song_id);
 $statement->execute();
 $statement->closeCursor();
}

function retrieveSongidByUserid($user_id){
  global $db;
  $query = "select song_id 
            from User_Like
            where user_id=:user_id
            ";
  $statement = $db->prepare($query);
  $statement->bindValue(':user_id', $user_id);
  $statement->execute();
  $result = $statement->fetchAll();
  //close cursor
  $statement->closeCursor();    
  return $result;
}
?>