<?php
    if (!defined('INDEX')) {
        die("");
    }
    
    $con->updateSettings($_POST["max_temperature"], $_POST["min_temperature"], $_POST["humidity"], $_POST["intensity"]);

    if ($con) {
?>
    <div class="content-title">
        <h2>Pengaturan</h2>
    </div>
    <div class="content settings">
        <p align='center' style='color: white'>Pengaturan berhasil diperbarui!</p>
    </div>
    <meta http-equiv='refresh' content='1; url=?hal=settings'>
<?php
    }
    else {
?>
    <div class="content-title">
        <h2>Pengaturan</h2>
    </div>
    <div class="content settings">
        <p align='center' style='color: white'>Gagal memperbarui pengaturan!<br><?=mysqli_error()?></p>
    </div>
<?php
    }
?>