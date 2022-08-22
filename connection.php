<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbase = "nativePHP";

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbase);

    // check connection
    if(!$conn) {
        die("Connection failed!: " . $conn->connect_error);
    }

    echo "Connected Successfully!";

?>