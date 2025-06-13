<?php
    if (isset($_POST["login_attempt"])) {
        include "./login_process.php";
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Masuk</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="container">
            <section class="login-box">
                <div class="login-title">
                    <div><img src="files/icons/login.png" alt="Ikon masuk"></div>
                    <h2>Masuk</h2>
                </div>
                <?php if (isset($failed_login)) { ?>
                <p align='center' style="color: red">Usaha Masuk Gagal!</p>
                <?php } ?>
                <form action="" method="post">
                    <input type="hidden" name="login_attempt" value="">
                    <input type="text" name="username" placeholder="Nama pengguna">
                    <input type="password" name="password" placeholder="Kata sandi">
                    <input type="submit" value="Masuk">
                </form>
                <div class="belum-daftar">
                    <p>Lupa kata sandi? <a href="">Kirim saya kata sandi baru</a></p>
                </div>
            </section>
        </div>
    </body>
</html>