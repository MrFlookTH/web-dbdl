<?php
    $conn_server = "localhost";
    $conn_user = "root";
    $conn_pwd = "";
    $conn_db = "dbdl_db";

    $conn = mysqli_connect($conn_server, $conn_user, $conn_pwd, $conn_db);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_query($conn, "SET NAMES UTF8");

?>