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

function now() {
    $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
    $time = $now->format('Y-m-d H:i:s');

    return $time;
}

function nowFileFormat() {
    $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
    $time = $now->format('Ymd_His');

    return $time;
}

?>