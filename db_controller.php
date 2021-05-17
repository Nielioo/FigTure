<?php

function connect(){
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "figture";

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die ("Error Connecting to Database");

    return $connection;
}

function close($connection){
    mysqli_close($connection);
}

?>