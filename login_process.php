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
?>
        <!DOCTYPE html>
        <html>
            <head>
                <style type='text/css'>
                    body {
                        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                        margin: 0;
                        background-image: url('files/greentexture.jpg');
                    }
                </style>
                <meta http-equiv='refresh' content='2; url=login.php'>
            </head>
            <body>
                <p align='center' style="color: red">Login Gagal!</p>
            </body>
        </html>
<?php
    }
?>