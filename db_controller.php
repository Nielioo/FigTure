<?php

function connect(){
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "figture";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die ("Error Connecting to Database");

    return $conn;
}

function close($connection){
    mysqli_close($connection);
}

?>
