<?php
    session_start();
    include "library/config.php";

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($con, "SELECT user_id, username, password FROM users WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_array($query);
    $jml = mysqli_num_rows($query);

    if($jml > 0){
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['password'] = $data['password'];

        header('location: index.php');
    }
    else {
?>
        <!DOCTYPE html>
        <html>
            <head>
                <style type='text/css'>
                    body {
                        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                        margin: 0;
                        background-image: url('file/greentexture.jpg');
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