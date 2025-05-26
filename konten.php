<?php
    if (!defined('INDEX')) {
        die("");
    }

    $halaman = array("dashboard", "setting", "setting_update", "profile", "profile_update", "about");

    if (isset($_GET['hal'])) {
        $hal = $_GET['hal'];
    }
    else {
        $hal = "dashboard";
    }

    foreach($halaman as $h) {
        if ($hal == $h) {
            include "content/$h.php";
            break;
        }
    }
?>