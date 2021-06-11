<!DOCTYPE html>
<?php include 'ext.php' ?>
<?php include 'config.php' ?>
<?php include 'connect.php' ?>
<div class="topMenu">
<h1 class="title"> muse:ic</h1>


<div id="mainMenu">
<nav>
    <p class="menuTitle">
        <a class="<?php echo ($current_page == 'startpage.php' || $current_page == '') ? 'active' : 'menuButton' ?>" 
        href="startpage.php">home</a>
        <a class="<?php echo ($current_page == 'feed.php' || $current_page == '') ? 'active' : 'menuButton' ?>" 
        href="feed.php">feed</a>
        <a class="<?php echo ($current_page == 'playlists.php' || $current_page == 'browseplaylist.php' || $current_page == '') ? 'active' : 'menuButton' ?> 
        <?php //echo ($_SESSION['username'] != '') ? 'showBooks' : 'hideBooks' ?>" 
        href="playlists.php">playlists</a>
        <?php if(isset($_SESSION['Username'])){ ?>
                   <a class="<?php echo ($current_page == 'profile.php' ||  $current_page == '' ) ? 'active' : 'menuButton' ?>" href="profile.php"><?php echo $_SESSION['Username']; ?></a>
                <?php } else{ ?>
                        <a class="<?php echo ($current_page == 'login.php' ||  $current_page == '') ? 'active' : 'menuButton' ?>" href="login.php">login</a>
                <?php } ?>

</nav>
</div>
</div>
</html>