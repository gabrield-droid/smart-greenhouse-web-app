<?php
    $host = "localhost";
    $user = "admin";
    $pass = "admin";
    $db = "smart_greenhouse";

    $con = mysqli_connect($host, $user, $pass, $db);
    if (mysqli_connect_errno()) {
        echo "Koneksi gagal: " . mysqli_connect_errno();
    }
?>