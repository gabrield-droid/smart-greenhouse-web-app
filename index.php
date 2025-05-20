<?php
    session_start();
    ob_start();

    include "library/config.php";

    if (empty($_SESSION['username']) or empty($_SESSION['password'])) {
?>
<!DOCTYPE html>
<html>
<head>
    <style type='text/css'>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            margin: 0;
            background-image: url('../file/greenwallpaper.jpeg');
        }
    </style>
    <meta http-equiv='refresh' content='2; url=login.php'>
</head>
<body>
    <p align='center' style="color: orange"> Anda harus login terlebih dahulu! </p>
</body>
</html>
<?php
    }
    else {
        define('INDEX', true);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/template-dashboard.css">
        <link rel="stylesheet" href="css/home.css">
        <link rel="stylesheet" href="css/settings.css">
        <link rel="stylesheet" href="css/profile.css">
    </head>
    <body>
        <div class="index">
            <aside>
                <div class="brand">
                    <span>
                        <h2>SMART PLANT</h2>
                    </span>
                </div>
                <nav>
                    <div>
                        <a href="?hal=dashboard">
                            <div><img src="file/png/008-home.png" alt="Ikon beranda"></div>
                            <span>Beranda</span>
                        </a>
                    </div>
                    <div>
                        <a href="?hal=setting">
                            <div><img src="file/png/009-settings.png" alt="Ikon pengaturan"></div>
                            <span>Pengaturan</span>
                        </a>
                    </div>
                    <div>
                        <a href="?hal=profile">
                            <div><img src="file/png/010-user-1.png" alt="Ikon profil"></div>
                            <span>Profil</span>
                        </a>
                    </div>
                </nav>
                <div class="logout">
                    <a href="logout.php">
                        <div><img src="file/png/013-logout.png" alt=""></div>
                        <span>Keluar</span>
                    </a>
                </div>
            </aside>
            <section class="main">
                <header>
                    <span class="icon sidebar-toggle">
                        <img src="file/png/012-bars.png" alt="Ikon menu">
                    </span>
                    <span>Hello, <?= mysqli_fetch_array(mysqli_query($con, "SELECT nickname FROM user WHERE username='{$_SESSION["username"]}' AND password='{$_SESSION["password"]}'"))['nickname'] ?>!</span>
                    <span class="icon">
                    <?php
                        $photopath = "file/photo/".mysqli_fetch_array(mysqli_query($con, "SELECT photo FROM user WHERE id_user='1'"))['photo'];
                        if (file_exists($photopath)) {
                    ?>
                        <img src="<?=$photopath?>" alt="Ikon pengguna">
                    <?php
                        }
                        else {
                    ?>
                        <img src="file/png/001-user.png" alt="Ikon pengguna">
                    <?php
                        }
                    ?>
                    </span>
                </header>
                <?php include "konten.php"; ?>
            </section>
        </div>
    </body>
</html>
<?php
    }
?>