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
            <div class="actuator" id="fan">
                <div class="image">
                    <img src="files/icons/fan.png" alt="Ikon pendingin">
                </div>
                <div class="actuator_name">
                    <span class="name_text">Kipas Angin</span>
                </div>
                <div class="image actuator_status">
                    <img class="status_icon" id="fan-on"src="files/icons/on-button.png" alt="Kipas menyala">
                    <img class="status_icon" id="fan-off"src="files/icons/off-button.png" alt="Kipas mati">
                </div>
            </div>
            <div class="actuator" id="heater">
                <div class="image">
                    <img src="files/icons/heater.png" alt="Ikon pemanas">
                </div>
                <div class="actuator_name">
                    <span class="name_text">Pemanas</span>
                </div>
                <div class="image actuator_status">
                    <img class="status_icon" id="heater-on" src="files/icons/on-button.png" alt="Pemanas menyala">
                    <img class="status_icon" id="heater-off" src="files/icons/off-button.png" alt="Pemanas mati">
                </div>
            </div>
            <div class="actuator" id="mist">
                <div class="image">
                    <img src="files/icons/humidifier.png" alt="Ikon pelembap">
                </div>
                <div class="actuator_name">
                    <span class="name_text">Pelembap udara</span>
                </div>
                <div class="image actuator_status">
                    <img class="status_icon" id="humidifier-on" src="files/icons/on-button.png" alt="Pelembap menyala">
                    <img class="status_icon" id="humidifier-off" src="files/icons/off-button.png" alt="Pelembap mati">
                </div>
            </div>
            <div class="actuator" id="lamp">
                <div class="image">
                    <img src="files/icons/lamp.png" alt="Ikon lampu">
                </div>
                <div class="actuator_name">
                    <span class="name_text">Lampu</span>
                </div>
                <div class="image actuator_status">
                    <img class="status_icon" id="lamp-on" src="files/icons/on-button.png" alt="Lampu menyala">
                    <img class="status_icon" id="lamp-off" src="files/icons/off-button.png" alt="Lampu mati">
                </div>
            </div>
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