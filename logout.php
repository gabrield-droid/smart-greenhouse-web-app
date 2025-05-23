<?php
    session_start();
    session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            margin: 0;
            background-image: url('file/greentexture.jpg');
        }
    </style>
    <meta http-equiv='refresh' content='2; url=login.php'>
</head>
<body>
    <p align="center" style="color: white">Anda telah logout!</p>
</body>
</html>