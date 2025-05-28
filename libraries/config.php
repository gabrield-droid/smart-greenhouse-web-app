<?php
    require __DIR__."/db_config.php";
    
    $host = "localhost";
    $user = MYSQL_USER;
    $pass = MYSQL_PASS;
    $db = DB_NAME;

    $con = mysqli_connect($host, $user, $pass, $db);
    if (mysqli_connect_errno()) {
        echo "Koneksi gagal: " . mysqli_connect_errno();
    }
?>