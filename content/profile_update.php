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
        WHERE user_id ='1'");
    } else {
        if ($tipefile != "image/jpeg" and $tipefile != "image/jpg" and $tipefile != "image/png") {
            $error = "Tipe file tidak didukung!";
        } elseif ($ukuranfile >= 10000000) {
            $error = "Ukuran file terlalu besar (lebih dari 1MB)!";
        }
        else {
            $query = mysqli_query($con, "SELECT * FROM users WHERE user_id='1'");
            $data = mysqli_fetch_array($query);

            if (file_exists("file/photo/$data[photo]")) {
                unlink("file/photo/$data[photo]");
            }
            move_uploaded_file($lokasi, "file/photo/".$foto);
            
            $query = mysqli_query($con, "UPDATE users SET
                photo = '$foto',
                username = '$_POST[username]',
                nickname = '$_POST[nickname]'
            WHERE user_id ='1'");
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
    