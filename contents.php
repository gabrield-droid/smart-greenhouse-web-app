<?php
    if (!defined('INDEX')) {
        die("");
    }

    $halaman = array("dashboard", "settings", "profile", "about");

    if (isset($_GET['hal'])) {
        $hal = $_GET['hal'];
    }
    else {
        $hal = "dashboard";
    }

    foreach($halaman as $h) {
        if ($hal == $h) {
            include "contents/$h.php";
            break;
        }
    }
?>