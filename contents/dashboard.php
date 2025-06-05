<?php
    if (!defined('INDEX')) {
        die("");
    }
?>

<div class="content-title">
    <h2>Beranda</h2>
</div>
<div class="content home">
    <div class="narrower-screen">
        <div class="actuators">
            <?php
                $actuators = array(
                    array("id" => "fan", "iconDesc" => "Ikon pendingin", "name" => "Kipas Angin", "onStatus" => "Kipas menyala", "offStatus" => "Kipas mati"),
                    array("id" => "heater", "iconDesc" => "Ikon pemanas", "name" => "Pemanas", "onStatus" => "Pemanas menyala", "offStatus" => "Pemanas mati"),
                    array("id" => "humidifier", "iconDesc" => "Ikon pelembap", "name" => "Pelembap udara", "onStatus" => "Pelembap menyala", "offStatus" => "Pelembap mati"),
                    array("id" => "lamp", "iconDesc" => "Ikon lampu", "name" => "Lampu", "onStatus" => "Lampu menyala", "offStatus" => "Lampu mati")
                );
                
                foreach ($actuators as $actuator) {
            ?>

            <div class="actuator" id="<?= $actuator['id'] ?>">
                <div class="image">
                    <img src="files/icons/<?= $actuator['id'] ?>.png" alt="<?= $actuator['iconDesc'] ?>">
                </div>
                <div class="actuator_name">
                    <span class="name_text"><?= $actuator['name'] ?></span>
                </div>
                <div class="image actuator_status">
            <?php
                if ($con->getActuatorValue($actuator['id']) == TRUE) {
            ?>
                    <img class="status_icon" id="<?= $actuator['id'] ?>-on"src="files/icons/on-button.png" alt="<?= $actuator['onStatus'] ?>">
            <?php
                } else {
            ?>
                    <img class="status_icon" id="<?= $actuator['id'] ?>-off"src="files/icons/off-button.png" alt="<?= $actuator['offStatus'] ?>">
            <?php
                }
            ?>
                </div>
            </div>

            <?php
                }
            ?>

        </div>
        <div class="sensors">
            <?php
                $sensors = array(
                    array("id" => "intensity", "lower" => "lo_light", "upper" => "", "name" => "Intensitas Cahaya", "unit" => " lx"),
                    array("id" => "temperature", "lower" => "lo_temp", "upper" => "hi_temp", "name" => "Suhu", "unit" => "&deg;C"),
                    array("id" => "humidity", "lower" => "lo_hum", "upper" => "", "name" => "Kelembapan", "unit" => "%")
                );
                
                foreach ($sensors as $sensor) {
            ?>

            <div class="sensor" id="<?= $sensor['id'] ?>">
                <div class="status_sensor">
            <?php
                $sensorStatus;
                if ($sensor['lower'] == "" AND $sensor['upper'] == "") {
                    $sensorStatus = "status_colour_normal";
                }
                elseif ($sensor['lower'] != "" AND $sensor['upper'] == "") {
                    if ($con->getSensorValue($sensor['id']) >= $con->getSettingsValue($sensor['lower'])) {
                        $sensorStatus = "status_colour_normal";
                    } else {
                        $sensorStatus = "status_colour_notnormal";
                    }
                }
                elseif ($sensor['lower'] == "" AND $sensor['upper'] != "") {
                    if ($con->getSensorValue($sensor['id']) <= $con->getSettingsValue($sensor['upper'])) {
                        $sensorStatus = "status_colour_normal";
                    } else {
                        $sensorStatus = "status_colour_notnormal";
                    }
                }
                else {
                    if (($con->getSensorValue($sensor['id']) >= $con->getSettingsValue($sensor['lower'])) AND ($con->getSensorValue($sensor['id']) <= $con->getSettingsValue($sensor['upper']))) {
                        $sensorStatus = "status_colour_normal";
                    } else {
                        $sensorStatus = "status_colour_notnormal";
                    }
                }
            ?>
                    <div class="<?= $sensorStatus ?>"></div>
                </div>
                <div class="sensor_value">
                    <div class="value_text"><?= $con->getSensorValue($sensor['id']) ?><?= $sensor['unit'] ?></div>
                </div>
                <div class="sensor_name">
                    <div class="name_text"><?= $sensor['name'] ?></div>
                </div>
            </div>
            <?php
                }
            ?>

        </div>
    </div>
</div>