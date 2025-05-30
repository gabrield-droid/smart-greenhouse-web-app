<?php
    if (!defined('INDEX')) {
        die("");
    }

    $foto = $_FILES['photo']['name'];
    $lokasi = $_FILES['photo']['tmp_name'];
    $tipefile = $_FILES['photo']['type'];
    $ukuranfile = $_FILES['photo']['size'];

    $error = "";
    if ($foto == "") {
        $query = mysqli_query($con, "UPDATE users SET
            username = '$_POST[username]',
            nickname = '$_POST[nickname]'
        WHERE user_id='{$_SESSION["user_id"]}'");
    } else {
        if ($tipefile != "image/jpeg" and $tipefile != "image/jpg" and $tipefile != "image/png") {
            $error = "Tipe file tidak didukung!";
        } elseif ($ukuranfile >= 10000000) {
            $error = "Ukuran file terlalu besar (lebih dari 1MB)!";
        }
        else {
            $query = mysqli_query($con, "SELECT * FROM users WHERE user_id='{$_SESSION["user_id"]}'");
            $data = mysqli_fetch_array($query);

            if (file_exists("files/photos/$data[photo]")) {
                unlink("files/photos/$data[photo]");
            }
            move_uploaded_file($lokasi, "files/photos/".$foto);
            
            $query = mysqli_query($con, "UPDATE users SET
                photo = '$foto',
                username = '$_POST[username]',
                nickname = '$_POST[nickname]'
            WHERE user_id='{$_SESSION["user_id"]}'");
        }
    }
    
    if ($error != "") {
?>

    <div class="judul">
        <h2>Profil</h2>
    </div>
    <div class="content profile">
        <p align='center' style='color: red'><?= $error ?></p>
    </div>
    <meta http-equiv='refresh' content='2; url=?hal=profile'>

<?php
    }elseif ($query) {
?>
    <div class="judul">
        <h2>Profil</h2>
    </div>
    <div class="content profile">
        <p align='center' style='color: white'>Data berhasil disimpan!</p>
    </div>
    <meta http-equiv='refresh' content='2; url=?hal=profile'>
<?php
    }
    else {
?>
    <div class="judul">
        <h2>Profil</h2>
    </div>
    <div class="content profile">
        <p align='center' style='color: white'>Tidak dapat menyimpan data!<br><?= mysqli_error() ?></p>
    </div>
    <meta http-equiv='refresh' content='2; url=?hal=profile'>
<?php
    }
?>
    