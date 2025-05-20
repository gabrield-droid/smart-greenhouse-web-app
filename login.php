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
                <h2>Masuk</h2>
                <form action="ceklogin.php" method="post">
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