<?php
    if (!defined('INDEX')) {
        die("");
    }
?>

<div class="judul">
    <h2>Profil</h2>
</div>
<div class="content profile">
    <form action="?hal=profile_update" method="post" class="profile" enctype="multipart/form-data">
        <div class="wider-screen">
            <div class="photo">
                <?php
                $photopath = "file/photo/".mysqli_fetch_array(mysqli_query($con, "SELECT photo FROM users WHERE user_id='1'"))['photo'];
                if (file_exists($photopath)) {
                ?>
                    <img src="<?=$photopath?>" alt="Foto profil" class="profil-picture">
                <?php
                }
                else {
                ?>
                    <img src="file/png/user.png" alt="Ikon pengguna" class="profil-picture">
                <?php
                }
                ?>        
            </div>
            <div class="form-groups">
                <div class="form-group">
                    <label for="photo">Foto:</label>
                    <input type="file" name="photo" id="photo">
                </div>
                <div class="form-group">
                    <label for="username">Nama pengguna:</label>
                    <input type="text" name="username" id="username" placeholder="<?= mysqli_fetch_array(mysqli_query($con, "SELECT username FROM users WHERE user_id='1'"))['username'] ?>" value="<?= mysqli_fetch_array(mysqli_query($con, "SELECT username FROM users WHERE user_id='1'"))['username'] ?>">
                </div>
                <div class="form-group">
                    <label for="nickname">Nama panggilan:</label>
                    <input type="text" name="nickname" id="nickname" placeholder="<?= mysqli_fetch_array(mysqli_query($con, "SELECT nickname FROM users WHERE user_id='1'"))['nickname'] ?>" value="<?= mysqli_fetch_array(mysqli_query($con, "SELECT nickname FROM users WHERE user_id='1'"))['nickname'] ?>">
                </div>
            </div>
        </div>
        <div class="submit">
            <input type="submit" value="Simpan">
        </div>
    </form>
</div>