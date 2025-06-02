<?php
    if (!defined('INDEX')) {
        die("");
    }
    
    $con->updateSettings($_POST["max_temperature"], $_POST["min_temperature"], $_POST["humidity"], $_POST["intensitas"]);

    if ($con) {
?>
    <div class="judul">
        <h2>Pengaturan</h2>
    </div>
    <div class="content setting">
        <p align='center' style='color: white'>Data berhasil disimpan!</p>
    </div>
    <meta http-equiv='refresh' content='1; url=?hal=setting'>
<?php
    }
    else {
?>
    <div class="judul">
        <h2>Pengaturan</h2>
    </div>
    <div class="content setting">
        <p align='center' style='color: white'>Tidak dapat menyimpan data!<br><?=mysqli_error()?></p>
    </div>
<?php
    }
?>