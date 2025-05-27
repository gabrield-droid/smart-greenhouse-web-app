<?php
    if (!defined('INDEX')) {
        die("");
    }
    
    $query = mysqli_query($con, "UPDATE settings SET 
        hi_temp = '$_POST[max_temperature]',
        lo_temp = '$_POST[min_temperature]',
        lo_hum = '$_POST[humidity]',
        lo_light = '$_POST[intensitas]'
    WHERE user_id='1'");

    if ($query) {
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