<?php
    if (!defined('INDEX')) {
        die("");
    }
?>

<div class="judul">
    <h2>Pengaturan</h2>
</div>
<div class="content setting">
    <form action="?hal=setting_update" method="post" class="setting">

        <div class="threshold temperature">
            <h3 style="margin:5px">Batas normal suhu</h3>
                <div class="form-group">
                    <div>
                        <label for ="min-temperature">Batas atas (&degC)</label>
                        <div class="input-box">
                            <input type="text" id="max_temperature" name="max_temperature" placeholder="<?= mysqli_fetch_array(mysqli_query($con, "SELECT hi_temp FROM settings WHERE user_id='1'"))['hi_temp']?>" value="<?= mysqli_fetch_array(mysqli_query($con, "SELECT hi_temp FROM settings WHERE user_id='1'"))['hi_temp']?>">
                        </div>
                    </div>
                    <div>
                        <label for ="min-temperature">Batas bawah (&degC)</label>
                        <div class="input-box">
                            <input type="text" id="max_temperature" name="min_temperature" placeholder="<?= mysqli_fetch_array(mysqli_query($con, "SELECT lo_temp FROM settings WHERE user_id='1'"))['lo_temp']?>" value="<?= mysqli_fetch_array(mysqli_query($con, "SELECT lo_temp FROM settings WHERE user_id='1'"))['lo_temp']?>">
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
                                <input type="text" id="humidity" name="humidity" placeholder="<?= mysqli_fetch_array(mysqli_query($con, "SELECT lo_hum FROM settings WHERE user_id='1'"))['lo_hum']?>" value="<?= mysqli_fetch_array(mysqli_query($con, "SELECT lo_hum FROM settings WHERE user_id='1'"))['lo_hum']?>">
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
                                <input type="text" id="intensitas" name="intensitas" placeholder="<?= mysqli_fetch_array(mysqli_query($con, "SELECT lo_light FROM settings WHERE user_id='1'"))['lo_light']?>" value="<?= mysqli_fetch_array(mysqli_query($con, "SELECT lo_light FROM settings WHERE user_id='1'"))['lo_light']?>">
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