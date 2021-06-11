<?php include 'ext.php'?>
<?php include 'header.php'?>
<?php $_SESSION['historySearch']=""; ?>

<div class="breadcrumb-box">
        <ul class="breadcrumbs">
            <li class="breadcrumb-item">
                <a href="startpage.php" class="crumb">home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="login.php" class="crumb">login</a>
            </li>
        </ul>
    </div>

<body class ="backgroundBlue"> 
        <div class="page-title-box">
            <h2 class="page-title-text">Already a user?</h2>
        </div>
        <div id="login-container">
        <form action="login.php" method="POST">
            <div id="login-box">
                <label for="username"></label>
                <input type="text" placeholder="Username..." name="Username">

                <label for="password"></label>
                <input type="password" placeholder="Password..." name="Password">
            </div>
            <div id="login-box-button">
                <button class="button-style-black" type="submit">Login</button>
            </div>
        </form>
        <div id="sign-up-box">
            <h3 id="sign-up-text">Not a user?</h3>
            <button class="button-style-black">Sign up!</button>
        </div>
    </div>

    <?php

    if(isset($_POST['endsession'])){
        session_destroy();
        header('refresh:0');
    }

    if(isset($_POST['Username']) && isset($_POST['Password'])){
        $username = $_POST['Username'];
        $password = $_POST['Password'];
      
        //echo password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT * FROM Users WHERE Username = ?";

        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->bind_result($userID, $usrname, $pw, $email, $firstname, $lastname);
        $stmt->execute();

        if($stmt->fetch()){
            $_SESSION['Username'] = $usrname;
            $_SESSION['Password'] = $pw;
            $_SESSION['userID'] = $userID;
        }

        $hashpassword = password_verify($password, $pw);

        if($hashpassword){
          $_SESSION['userID'] = $userID; 
            //echo $userID;
            header('Location:http://localhost/phpmuseic/profile.php');
    
        }
        else{
           
           echo "<h5 id='wrongUser'>Your username or password seem to wrong, try again</h5>";
         
        }
    

        $stmt->close();
    }
    ?>

    <?php include 'footer.php' ?>
</body>
