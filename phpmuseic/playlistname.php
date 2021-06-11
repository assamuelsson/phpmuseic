<?php include 'ext.php'?>
<?php include 'header.php'?>
<!DOCTYPE html>

<?php $_SESSION['historySearch']=""; ?>

<h2>Give your playlist a name</h2>

<div class="breadcrumb-box">
        <ul class="breadcrumbs">
            <li class="breadcrumb-item">
                <a href="startpage.php" class="crumb">home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="profile.php" class="crumb">profile</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#" class="crumb">create</a>
            </li>
        </ul>
</div>

<div class="startplaylistName">
    <form action="" method="POST" enctype="multipart/form-data">
        <input class="searchBar2" type="text" name="playlistTitle"></input><br>
        <label class="label-fileUpload" for="coverUpload">Upload cover</label><br>
        <input class="fileUpload" type="file" name="coverUpload"><br>
        <button class="buttonSubmit" type="submit" name="submit">NEXT</button>
    </form>
</div>

    <?php
    if(isset($_POST['submit'])){
        $size = filesize($_FILES['coverUpload']['tmp_name']);
        if($size < 1048576){
        $test = ($_POST['playlistTitle']);
        if( $test != "" && !empty($_FILES["coverUpload"]["tmp_name"])){
            $name = $_POST['playlistTitle'];
            $image = $_FILES['coverUpload']['tmp_name'];
            $image = str_replace(' ','+',$image);
            $image = base64_encode(file_get_contents(addslashes($image)));

            $userID = $_SESSION['userID'];

            $insertCoverInDb = "INSERT INTO Playlists (userID, PlaylistName, Cover, Genre) VALUES ('$userID', '$name', '$image', '')";
            $result = mysqli_query($db, $insertCoverInDb);


                if($result){
                    $getplaylistID = "SELECT * FROM Playlists WHERE Playlists.PlaylistName = '$name' AND Playlists.userID = '$userID'";
                    $info = mysqli_query($db, $getplaylistID);
                    $rows = mysqli_fetch_assoc($info);

                    $playlistID = $rows['PlaylistID'];
                    $userID = $_SESSION['userID'];

                    $insertInUserPlaylist = "INSERT INTO UserPlaylist (userID, PlaylistID) VALUES ('$userID', '$playlistID')";
                    $send = mysqli_query($db, $insertInUserPlaylist);

                    header('Location:http://localhost/phpmuseic/createplaylist.php?'. $playlistID);

                } else{
                    echo "There is a problem..";
                }

            }else{
                echo "<div class='wrongmessagebox'>
                        <p class='wrongmessage'>Dude?! Enter a name AND upload a nice pic!</p>
                    </div>";
             } 
        } else{
            echo "<div class='wrongmessagebox'>
                <p class='wrongmessage'>Almost! Please upload a file under 1mb buddy!</p>
            </div>";
        }  
    }
    ?>




<?php include 'footer.php' ?>

</html>