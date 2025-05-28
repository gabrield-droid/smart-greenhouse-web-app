#!/bin/bash

echo -e "\nWELCOME TO THE SMART GREENHOUSE WEB APP INSTALLATION WIZARD"

mkdir files/photos
chown www-data files/photos

touch libraries/db_config.php

echo -e "\nDATABASE PREPARATION"

echo -e "\nEnter your MySQL credentials"
echo "These credentials are only for the installation process — they won't be used by the app."
echo -n "MySQL user         : "; read MYSQL_USER
read -sp "MySQL password     : " MYSQL_PASS; echo

echo -e "\nEnter your MySQL configuration for the application"

echo -e "\nDatabase name"
echo -n "Enter database name = "; read DB_NAME

sudo mysql -u $MYSQL_USER --password=$MYSQL_PASS -e "CREATE DATABASE IF NOT EXISTS \`$DB_NAME\`"

sudo mysql -u $MYSQL_USER --password=$MYSQL_PASS $DB_NAME -e "CREATE TABLE IF NOT EXISTS \`users\` (
    \`user_id\` INT(5) PRIMARY KEY AUTO_INCREMENT,
    \`username\` VARCHAR(20) NOT NULL,
    \`nickname\` VARCHAR(20) NOT NULL,
    \`password\` VARCHAR(50) NOT NULL,
    \`photo\` VARCHAR(50) DEFAULT NULL
)"
sudo mysql -u $MYSQL_USER --password=$MYSQL_PASS $DB_NAME -e "CREATE TABLE IF NOT EXISTS \`settings\` (
    \`setting_id\` INT(5) PRIMARY KEY AUTO_INCREMENT,
    \`hi_temp\` FLOAT DEFAULT NULL,
    \`lo_temp\` FLOAT DEFAULT NULL,
    \`lo_hum\` FLOAT DEFAULT NULL,
    \`lo_light\` FLOAT DEFAULT NULL,
    \`user_id\` INT(5) NOT NULL,
    FOREIGN KEY (\`user_id\`) REFERENCES \`users\`(\`user_id\`) ON DELETE CASCADE
)"
sudo mysql -u $MYSQL_USER --password=$MYSQL_PASS $DB_NAME -e "CREATE TABLE IF NOT EXISTS \`sensors_actuators\` (
    \`record_id\` INT(5) PRIMARY KEY AUTO_INCREMENT,
    \`intensity\` FLOAT DEFAULT NULL,
    \`temperature\` FLOAT DEFAULT NULL,
    \`humidity\` FLOAT DEFAULT NULL,
    \`fan\` TINYINT(1) DEFAULT NULL,
    \`heater\` TINYINT(1) DEFAULT NULL,
    \`humidifier\` TINYINT(1) DEFAULT NULL,
    \`lamp\` TINYINT(1) DEFAULT NULL,
    \`user_id\` INT(5) NOT NULL,
    FOREIGN KEY (\`user_id\`) REFERENCES \`users\`(\`user_id\`) ON DELETE CASCADE
)"

echo -e "\nDatabase user credentials"
echo -n "Enter a MySQL username for this app  = "; read DB_USER
echo -n "Enter a MySQL password for this app  = "; read -s DB_PASS; echo
sudo mysql -u $MYSQL_USER --password=$MYSQL_PASS -e "CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}'"
sudo mysql -u $MYSQL_USER --password=$MYSQL_PASS -e "GRANT SELECT, INSERT, UPDATE, DELETE ON \`$DB_NAME\`.* TO \`$DB_USER\`@\`localhost\`"

echo -e "\nPreparing database configuration ..."
echo "<?php" > libraries/db_config.php
echo "    define(\"DB_NAME\", \"$DB_NAME\");" >> libraries/db_config.php
echo "    define(\"MYSQL_USER\", \"$DB_USER\");" >> libraries/db_config.php
echo "    define(\"MYSQL_PASS\", \"$DB_PASS\");" >> libraries/db_config.php
echo "?>" >> libraries/db_config.php

echo " Done"

echo -e "\nINITIAL USER CREATION"
echo "This will be your initial user account. You can add more user accounts later manually."
echo -n "Username     : "; read ACCOUNT_USER
echo -n "Nickname     : "; read ACCOUNT_NICK
read -sp "Password     : " ACCOUNT_PASS; echo
echo -e "\nCreating the user account ..."
sudo mysql -u $MYSQL_USER --password=$MYSQL_PASS $DB_NAME -e "PREPARE create_account FROM 'INSERT INTO users SET \`username\`=?, \`nickname\`=?, \`password\`=?';
    SET @username = '$ACCOUNT_USER'; SET @nickname = '$ACCOUNT_NICK'; SET @password = md5('$ACCOUNT_PASS');
    EXECUTE create_account USING @username, @nickname, @password;
    DEALLOCATE PREPARE create_account;"
ACCOUNT_ID=`sudo mysql -u $MYSQL_USER --password=$MYSQL_PASS $DB_NAME -ss -e "SELECT user_id FROM users WHERE username='${ACCOUNT_USER}' AND password=md5('${ACCOUNT_PASS}')"`
sudo mysql -u $MYSQL_USER --password=$MYSQL_PASS $DB_NAME -e "INSERT INTO \`settings\` (\`user_id\`) VALUES ('${ACCOUNT_ID}')"
sudo mysql -u $MYSQL_USER --password=$MYSQL_PASS $DB_NAME -e "INSERT INTO \`sensors_actuators\` (\`user_id\`) VALUES ('${ACCOUNT_ID}')"
echo " Done"

echo -e "\nVIRTUAL HOST CONFIGURATION FILE"
echo -n "Enter the VirtualHost Configuration file name (Default: smart-greenhouse-web-app.conf): "
read VH_NAME
if [[ -z "$VH_NAME" ]]; then
    VH_NAME="smart-greenhouse-web-app.conf"
else
    VH_NAME="$VH_NAME"
fi
echo -e "\nCreating VirtualHost configuration file ..."
sudo tee /etc/apache2/sites-available/$VH_NAME > /dev/null <<EOF
<VirtualHost *:80>
    #ServerName smart-greenhouse-web-app.local

    ServerAdmin webmaster@localhost
    DocumentRoot `pwd`

    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF
echo " Done"

echo -e "\nEnabling VirtualHost configuration file ..."
sudo a2ensite $VH_NAME
echo " Done"

echo -e "\nReloading Apache2 HTTP Server ..."
sudo systemctl reload apache2
echo " Done"

unset MYSQL_USER
unset MYSQL_PASS
unset DB_NAME
unset DB_USER
unset DB_PASS
unset ACCOUNT_ID
unset ACCOUNT_USER
unset ACCOUNT_NICK
unset ACCOUNT_PASS
unset VH_NAME

echo -e "\nINSTALLATION FINISHED"