<?php

$db = mysqli_connect($host, $user, $password, $database);

if ($db->connect_errno){
    echo "failed to connect";
    exit();
}

?>