<?php
    session_start();
    include "libraries/config.php";

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $users = $con->checkUser($username, $password);
    $users->bind_result($u_id, $u_name, $u_pass);

    if($users->fetch()){
        $users->close();

        $_SESSION['user_id'] = $u_id;
        $_SESSION['username'] = $u_name;
        $_SESSION['password'] = $u_pass;

        header('location: index.php');
    }
    else {
        $users->close();

        $failed_login = TRUE;
    }
?>