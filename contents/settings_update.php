<?php
    if (!defined('INDEX')) {
        die("");
    }

    $con->updateSettings($_POST["max_temperature"], $_POST["min_temperature"], $_POST["humidity"], $_POST["intensity"]);

    if ($con) {
        $settings_update_result = "Pengaturan berhasil diperbarui!";
    }
    else {
        $settings_update_result = "Gagal memperbarui pengaturan!<br>" . mysqli_error();
    }
?>