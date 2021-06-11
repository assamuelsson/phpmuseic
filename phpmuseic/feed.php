<?php include 'ext.php'?>
<?php include 'header.php'?>
<!DOCTYPE html>
<body class ="backgroundBlue"> 
<?php $_SESSION['historySearch']=""; 
$host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>

<div class="breadcrumb-box">
        <ul class="breadcrumbs">
            <li class="breadcrumb-item">
                <a href="startpage.php" class="crumb">home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="feed.php" class="crumb">feed</a>
            </li>
        </ul>
    </div>

<h2>Feed</h2>

<div class="playlists-result">
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 'on');

            $playlistquery = "SELECT * FROM UserPlaylist JOIN Users ON Users.userID = UserPlaylist.userID JOIN Playlists ON Playlists.PlaylistID = UserPlaylist.PlaylistID";
            $result = mysqli_query($db, $playlistquery);

        ?>

        <?php
            while($rows = mysqli_fetch_assoc($result)){
        ?>
        

            <div class="playlist">
            <?php  
                $playlistID = $rows['PlaylistID'];
                if($host == 'localhost/phpmuseic/feed.php'){

                 echo '<a href="browseplaylist.php?PlaylistID=' . $playlistID . '">'?>
                <div class="playlist-img"><?php echo '<img src="data:image/jpeg;base64,'.( $rows['Cover'] ).'"/>'; ?></div>
                <div class="playlist-info">
                    <h5 class="playlist-name"><?php echo $rows['PlaylistName']; ?></h5>
                    <p class="playlist-username"><?php echo $rows['Username']; ?></p></a>
                </div>
                <?php } ?>
            </div>

            <?php extract($rows); } ?>
        </div>



<?php include 'footer.php' ?>
</body>
</html>