<?php
    if (!defined('INDEX')) {
        die("");
    }
?>

<div class="judul">
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
            <div class="sensor">
                <div class="status_sensor">
                    <div class="status_colour_normal"></div>
                </div>
                <div class="sensor_value">
                    <div class="value_text"><?= $con->getSensorValue("intensity"); ?> lx</div>
                </div>
                <div class="sensor_name">
                    <div class="name_text">Intensitas Cahaya</div>
                </div>
            </div>
            <div class="sensor">
                <div class="status_sensor">
                    <div class="status_colour_notnormal"></div>
                </div>
                <div class="sensor_value">
                    <div class="value_text"><span id="temp"></span><?= $con->getSensorValue('temperature');?>&deg;C</div>
                </div>
                <div class="sensor_name">
                    <div class="name_text">Suhu</div>
                </div>
            </div>
            <div class="sensor">
                <div class="status_sensor">
                    <div class="status_colour_normal"></div>
                </div>
                <div class="sensor_value">
                    <div class="value_text"><?= $con->getSensorValue('humidity');?>%</div>
                </div>
                <div class="sensor_name">
                    <div class="name_text">Kelembapan</div>
                </div>
            </div>
        </div>
    </div>
</div>