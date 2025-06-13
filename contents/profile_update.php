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
        $con->updateProfile($_POST["username"], $_POST["nickname"]);
    } else {
        if ($tipefile != "image/jpeg" and $tipefile != "image/jpg" and $tipefile != "image/png") {
            $error = "Tipe file tidak didukung!";
        } elseif ($ukuranfile >= 10000000) {
            $error = "Ukuran file terlalu besar (lebih dari 1MB)!";
        }
        else {
            $photo = $con->getProfilePhoto();

            if (file_exists("files/photos/$photo")) {
                unlink("files/photos/$photo");
            }
            move_uploaded_file($lokasi, "files/photos/".$foto);
            
            $con->updateProfile($_POST["username"], $_POST["nickname"], $foto);
        }
    }

    if ($error != "") {
        $profile_update_result = $error;
    }elseif ($con) {
        $profile_update_result = "Profil berhasil diperbarui!";
    }
    else {
        $profile_update_result = "Gagal memperbarui profil!<br>" . mysqli_error();
    }
?>
    