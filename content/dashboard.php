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
                    <img src="file/png/005-fan.png" alt="Ikon pendingin">
                </div>
                <div class="actuator_name">
                    <span class="name_text">Kipas Angin</span>
                </div>
                <div class="actuator_status">
                    <span class="status_name" id="fan-off">Mati</span>
                    <span class="status_name" id="fan-on">Nyala</span>
                </div>
            </div>
            <div class="actuator" id="heater">
                <div class="image">
                    <img src="file/png/002-heater.png" alt="Ikon pemanas">
                </div>
                <div class="actuator_name">
                    <span class="name_text">Pemanas</span>
                </div>
                <div class="actuator_status">
                    <span class="status_name" id="heater-off">Mati</span>
                    <span class="status_name" id="heater-on">Nyala</span>
                </div>
            </div>
            <div class="actuator" id="mist">
                <div class="image">
                    <img src="file/png/004-humidifier.png" alt="Ikon pelembap">
                </div>
                <div class="actuator_name">
                    <span class="name_text">Pelembap udara</span>
                </div>
                <div class="actuator_status">
                    <span class="status_name" id="humidifier-off">Mati</span>
                    <span class="status_name" id="humidifier-on">Nyala</span>
                </div>
            </div>
            <div class="actuator" id="lamp">
                <div class="image">
                    <img src="file/png/003-idea.png" alt="Ikon lampu">
                </div>
                <div class="actuator_name">
                    <span class="name_text">Lampu</span>
                </div>
                <div class="actuator_status">
                    <span class="status_name" id="lamp-off">Mati</span>
                    <span class="status_name" id="lamp-on">Nyala</span>
                </div>
            </div>
        </div>
        <div class="sensors">
            <div class="sensor">
                <div class="status_sensor">
                    <div class="status_colour_normal"></div>
                </div>
                <div class="sensor_value">
                    <div class="value_text"><?= mysqli_fetch_array(mysqli_query($con, "SELECT intensity FROM sensor WHERE id_data='1'"))['intensity']?> lx</div>
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
                    <div class="value_text"><span id="temp"></span><?= mysqli_fetch_array(mysqli_query($con, "SELECT temperature FROM sensor WHERE id_data='1'"))['temperature']?>&deg;C</div>
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
                    <div class="value_text"><?= mysqli_fetch_array(mysqli_query($con, "SELECT humidity FROM sensor WHERE id_data='1'"))['humidity']?>%</div>
                </div>
                <div class="sensor_name">
                    <div class="name_text">Kelembapan</div>
                </div>
            </div>
        </div>
    </div>
</div>