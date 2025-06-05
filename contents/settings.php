<?php
    if (!defined('INDEX')) {
        die("");
    }
?>

<div class="content-title">
    <h2>Pengaturan</h2>
</div>
<div class="content settings">
    <form action="?hal=settings_update" method="post" class="settings">

        <div class="threshold temperature">
            <h3 style="margin:5px">Batas normal suhu</h3>
                <div class="form-group">
                    <div>
                        <label for ="min-temperature">Batas atas (&degC)</label>
                        <div class="input-box">
                            <input type="text" id="max_temperature" name="max_temperature" placeholder="<?= $con->getSettingsValue('hi_temp') ?>" value="<?= $con->getSettingsValue('hi_temp') ?>">
                        </div>
                    </div>
                    <div>
                        <label for ="min-temperature">Batas bawah (&degC)</label>
                        <div class="input-box">
                            <input type="text" id="min_temperature" name="min_temperature" placeholder="<?= $con->getSettingsValue('lo_temp') ?>" value="<?= $con->getSettingsValue('lo_temp') ?>">
                        </div>
                    </div>
                </div>
        </div>
        <div class="wider-screen">
            <div class="threshold humidity">   
                <h3 style="margin:5px">Batas normal kelembapan</h3>
                    <div class="form-group">
                        <div>
                            <label for="humidity">Batas bawah (%):</label>
                            <div class="input-box">
                                <input type="text" id="humidity" name="humidity" placeholder="<?= $con->getSettingsValue('lo_hum') ?>" value="<?= $con->getSettingsValue('lo_hum') ?>">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="threshold intensity">   
                <h3 style="margin:5px">Batas normal cahaya</h3>
                    <div class="form-group">
                        <div>
                            <label for="humidity">Batas bawah (lx):</label>
                            <div class="input-box">
                                <input type="text" id="intensity" name="intensity" placeholder="<?= $con->getSettingsValue('lo_light') ?>" value="<?= $con->getSettingsValue('lo_light') ?>">
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="submit">
            <input type="submit" value="Simpan" class="tombol-simpan">
        </div>
        
    </form>
</div>