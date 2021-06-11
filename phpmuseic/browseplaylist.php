<?php include 'ext.php'?>
<?php include 'header.php'?>

<?php $_SESSION['historySearch']=""; ?>
<?php 

$playlistID = explode('=', $_SERVER['REQUEST_URI']);
$playlistID = end($playlistID);

if(isset($_SESSION['userID']) && !empty($_SESSION['userID'])){
$userID = $_SESSION['userID'];


$isownerofplaylistquery = "SELECT * FROM UserPlaylist WHERE UserPlaylist.userID = $userID AND UserPlaylist.playlistID = $playlistID";
$isownerofplaylistresult = mysqli_query($db, $isownerofplaylistquery);
$isownerofplaylist = mysqli_num_rows($isownerofplaylistresult) >= 1;
echo $isownerofplaylist;
} else {
  $isownerofplaylist = "";
}


$getPlaylistQuery = "SELECT * FROM PlaylistSong JOIN Songs ON Songs.SongID = PlaylistSong.SongID 
JOIN Playlists ON Playlists.PlaylistID = PlaylistSong.PlaylistID WHERE Playlists.PlaylistID = $playlistID";
$getPlaylist = mysqli_query($db, $getPlaylistQuery);


?>

<!DOCTYPE html>
<body class ="backgroundBlue"> 

<?php 

echo "<div class='tableBrowsePlaylist'>";
echo "<div class='table'>";
echo "<table id='fjomp'>";
echo "<tr class ='createTableRow'><th class ='createTableTitles'>Title</th><th class ='createTableTitles'>Artist</th><th class ='createTableTitles'>Duration</th>";
 if($isownerofplaylist){ echo "<th class ='createTableTitles'>Delete</th>";}
echo "<div class='tableBrowsePlaylistoverlay'>";

error_reporting(E_ALL);
ini_set('display_errors', 'on');



  while($rows = mysqli_fetch_assoc($getPlaylist)){
    $artist = $rows['Artist'];
    $playlistname = $rows['PlaylistName'];
    $title = $rows['Title'];
    $duration = $rows['Duration'];
    $usertestID = $rows['userID'];
    $songID = $rows['SongID'];
      
        echo "<tr>";
        echo "<td> $title </td>";
        echo "<td> $artist </td>";
        echo "<td> $duration </td>";
        if($isownerofplaylist){ echo "<td><form action='' method='POST'><button class='removeSongButton' type=submit name='$songID'>Delete</button></form></td>";}
        echo "</tr>";
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST[$songID])){
          $deletesongquery = "DELETE FROM PlaylistSong WHERE PlaylistSong.songID = $songID AND PlaylistSong.playlistID = $playlistID";
          mysqli_query($db, $deletesongquery);
          header("Refresh:0");
        }
  }

echo "</table>";
echo "</div>";
echo "</div>";


$getuseridquery = "SELECT * FROM UserPlaylist JOIN Users ON Users.userID = UserPlaylist.userID WHERE UserPlaylist.userID = $usertestID AND UserPlaylist.playlistID = $playlistID ";
$getUsername = mysqli_query($db, $getuseridquery);
$info = mysqli_fetch_assoc($getUsername);
$username = $info['Username'];

?>

<h2 class='specificPlaylistTitle'><?php echo $playlistname; ?></h2>
<h3 class='specificPlaylistUsername'>by <?php echo $username; ?></h3>
<div class="breadcrumb-box">
    <ul class="breadcrumbs">
        <li class="breadcrumb-item">
            <a href="startpage.php" class="crumb">home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#" class="playlists.php">playlists</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#" class="crumb"><?php echo $playlistname ?></a>
        </li>
    </ul>
  </div>




<?php include 'footer.php' ?>
</body>
</html>