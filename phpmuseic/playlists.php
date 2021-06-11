<?php include 'ext.php'?>
<?php include 'header.php'?>
<?php 
    $_SESSION['historySearch']=""; 
    $host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>
<div class="breadcrumb-box">
        <ul class="breadcrumbs">
            <li class="breadcrumb-item">
                <a href="startpage.php" class="crumb">home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="playlists.php" class="crumb">playlists</a>
            </li>
        </ul>
</div>
<body class="backgroundBlue">
        <div class="page-title-box">
            <h2 class="page-title-text">Playlists</h2>
        </div>
        <div id="playlist-search-box">
            <form action="playlists.php" method="POST">
                <input class="playlist-search-input" type="text" placeholder="Specific playlist?" name="searchlist" value="<?php 
                if (isset($_POST['searchlist'])){ 
                    echo $_POST['searchlist'];
                    }else{
                        echo "";
                    }
                    ?>">
                <button type="submit" class="button-style-black">SEARCH</button>
            </form>
        </div>
<div class="playlists-result">
<?php
            
           error_reporting(E_ALL);
           ini_set('display_errors', 'on');

           if(empty($_POST['searchlist'])){
           $playlistquery = "SELECT * FROM UserPlaylist JOIN Users ON Users.userID = UserPlaylist.userID JOIN Playlists ON Playlists.PlaylistID = UserPlaylist.PlaylistID";
           $result = mysqli_query($db, $playlistquery);
           }

           else {
            $arg = mysqli_real_escape_string($db, $_POST['searchlist']);
            $playlistquery = "SELECT * FROM UserPlaylist JOIN Users ON Users.userID = UserPlaylist.userID JOIN Playlists ON Playlists.PlaylistID = UserPlaylist.PlaylistID WHERE Playlists.PlaylistName = '$arg' OR Users.Username = '$arg'";
            $result = mysqli_query($db, $playlistquery);

           }

        ?>

        <?php
            while($rows = mysqli_fetch_assoc($result)){
    
        ?>

            <div class="playlist">
            <?php  
                $playlistID = $rows['PlaylistID'];
                if($host == 'localhost/phpmuseic/playlists.php'){

                 echo '<a href="browseplaylist.php?PlaylistID=' . $playlistID . '">'?>
                <div class="playlist-img"><?php echo '<img src="data:image/jpeg;base64,'.( $rows['Cover'] ).'"/>'; ?></div>
                <div class="playlist-info">
                    <h5 class="playlist-name"><?php echo $rows['PlaylistName']; ?></h5>
                    <p class="playlist-username"><?php echo $rows['Username']; ?></p></a>
                </div>

                <?php }?>
            </div>
            

        <?php extract($rows); } ?>
       
</div>
    <?php include 'footer.php';?>
</body>