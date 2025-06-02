<?php
    require __DIR__."/db_config.php";
    
    $host = "localhost";
    $user = MYSQL_USER;
    $pass = MYSQL_PASS;
    $db = DB_NAME;

    class DataBase extends mysqli {

        protected $stmt;

        public function checkUser($username, $password) {
            $this->stmt = $this->prepare("SELECT user_id, username, password FROM users WHERE username = ? AND password = ?");
            $this->stmt->bind_param("ss", $username, $password);
            $this->stmt->execute();

            return $this->stmt;
        }

        public function getNickname() {
            $this->stmt = $this->prepare("SELECT nickname FROM users WHERE username = ? AND password = ?");
            $this->stmt->bind_param("ss", $_SESSION["username"], $_SESSION["password"]); $this->stmt->execute();
            $this->stmt->bind_result($u_nickname); $this->stmt->fetch(); $this->stmt->close();

            return $u_nickname;
        }

        public function getProfilePhoto() {
            $this->stmt = $this->prepare("SELECT photo FROM users WHERE username = ? AND password = ?");
            $this->stmt->bind_param("ss", $_SESSION["username"], $_SESSION["password"]); $this->stmt->execute();
            $this->stmt->bind_result($u_photo); $this->stmt->fetch(); $this->stmt->close();

            return $u_photo;
        }

        public function getSensorValue($item) {
            if ($item == 'intensity' || $item == 'humidity' || $item == 'temperature') {
                $this->stmt = $this->prepare("SELECT $item FROM sensors_actuators WHERE user_id = ?");
                $this->stmt->bind_param("i", $_SESSION["user_id"]); $this->stmt->execute();
                $this->stmt->bind_result($u_item); $this->stmt->fetch(); $this->stmt->close();

                return $u_item;
            }
        }

        public function getSettingsValue($item) {
            if ($item == 'hi_temp' || $item == 'lo_temp' || $item == 'lo_hum' || $item == 'lo_light') {
                $this->stmt = $this->prepare("SELECT $item FROM settings WHERE user_id = ?");
                $this->stmt->bind_param("i", $_SESSION["user_id"]); $this->stmt->execute();
                $this->stmt->bind_result($u_item); $this->stmt->fetch(); $this->stmt->close();

                return $u_item;
            }
        }

        public function getUserDatum($item) {
            if ($item == 'photo' || $item == 'username' || $item == 'nickname') {
                $this->stmt = $this->prepare("SELECT $item FROM users WHERE user_id = ?");
                $this->stmt->bind_param("i", $_SESSION["user_id"]); $this->stmt->execute();
                $this->stmt->bind_result($u_item); $this->stmt->fetch(); $this->stmt->close();

                return $u_item;
            }
        }

        public function updateProfile($username, $nickname, $photo = "") {
            if ($photo == "") {
                $this->stmt = $this->prepare("UPDATE users SET
                    username = ?,
                    nickname = ?
                WHERE user_id = ?");
                $this->stmt->bind_param("ssi", $username, $nickname, $_SESSION["user_id"]);
            } else {
                $this->stmt = $this->prepare("UPDATE users SET
                    photo = ?,
                    username = ?,
                    nickname = ?
                WHERE user_id = ?");
                $this->stmt->bind_param("sssi", $photo, $username, $nickname, $_SESSION["user_id"]);
            }
            $this->stmt->execute();
            $this->stmt->close();
        }

        public function updateSettings($max_temp, $min_temp, $hum, $light) {
            $this->stmt = $this->prepare("UPDATE settings SET hi_temp = ?, lo_temp = ?, lo_hum = ?, lo_light = ? WHERE user_id = ?");
            $this->stmt->bind_param("ddddi", $max_temp, $min_temp, $hum, $light, $_SESSION["user_id"]);
            $this->stmt->execute();
            $this->stmt->close();
        }

        public function __destruct(){
            $this->close();
        }
    }

    $con = new DataBase("localhost", MYSQL_USER, MYSQL_PASS, DB_NAME);
    if ($con->connect_errno) {
        echo "Koneksi gagal: " . mysqli_connect_errno();
    }
?>