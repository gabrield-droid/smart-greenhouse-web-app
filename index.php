<?php
    session_start();
    ob_start();

    include "libraries/config.php";

    if (empty($_SESSION['username']) or empty($_SESSION['password'])) {
?>
<!DOCTYPE html>
<html>
<head>
    <style type='text/css'>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            margin: 0;
            background-image: url('../files/greentexture.jpg');
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
        <link rel="stylesheet" href="css/about.css">
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
                            <div><img src="files/icons/home.png" alt="Ikon beranda"></div>
                            <span>Beranda</span>
                        </a>
                    </div>
                    <div>
                        <a href="?hal=setting">
                            <div><img src="files/icons/settings.png" alt="Ikon pengaturan"></div>
                            <span>Pengaturan</span>
                        </a>
                    </div>
                    <div>
                        <a href="?hal=profile">
                            <div><img src="files/icons/user-profile.png" alt="Ikon profil"></div>
                            <span>Profil</span>
                        </a>
                    </div>
                </nav>
                <nav class="lower-navs">
                    <a href="?hal=about">
                        <div><img src="files/icons/about.png" alt="Ikon tentang"></div>
                        <span>Tentang</span>
                    </a>
                    <a href="logout.php">
                        <div><img src="files/icons/logout.png" alt="Ikon keluar"></div>
                        <span>Keluar</span>
                    </a>
                </nav>
            </aside>
            <section class="main">
                <header>
                    <span class="icon sidebar-toggle">
                        <img src="files/icons/bars.png" alt="Ikon menu">
                    </span>
                    <span>Hello, <?= $con->getNickname() ?>!</span>
                    <span class="icon">
                    <?php
                        $photoname = $con->getProfilePhoto();
                        if (($photoname != NULL) AND file_exists("files/photos/".$photoname)) {
                    ?>
                        <img src="<?="files/photos/".$photoname?>" alt="Foto profil">
                    <?php
                        }
                        else {
                    ?>
                        <img src="files/icons/user.png" alt="Ikon pengguna">
                    <?php
                        }
                    ?>
                    </span>
                </header>
                <?php include "contents.php"; ?>
            </section>
        </div>
    </body>
</html>
<?php
    }
?>