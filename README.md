# smart-greenhouse-web-app

A web interface of a smart greenhouse project.

## Features:
- Interface language: :indonesia: Indonesian.
- User can see the sensor measurements and the statuses of actuators.
- User can configure the behaviour of the sensors and actuators:

## Limitation:
- Users account can only be created manually on the web server by inserting them using MySQL/MariaDB commands.

## Requirements:
1. PHP with a minimum version 8.1.2.
   You can install it using this command on the terminal:
   ```bash
   sudo apt install php-common php-cli libapache2-mod-php php-mysql
   ```
   Installing libapache2-mod-php also installs the `Apache2 HTTP Server`.

2. Apache2 HTTP Server
   
   If you have installed `PHP` using the command in step 1 above, Apache2 HTTP Server should already be installed. Otherwise, you can install it or check whether it is installed with this command:
   ```bash
   sudo apt install apache2
   ```
3. MariaDB Server with a minimum version 10.6
   
   This is the database server where the persistent data are stored. You can install it or check whether it is installed with this command:
   ```bash
   sudo apt install mariadb-server
   ```
   After that, run this security script to restrict access to the server:
   ```bash
   sudo mysql_secure_installation
   ```

4. Apache2 HTTP Server modules `mod_headers` and `mod_rewrite`.
   You can activate these modules using the following commands:
   ```bash
   sudo a2enmod headers
   sudo a2enmod rewrite
   ``` 

5. Git (for cloning this github repository). You can skip this if you would like to download the repository manually.


## Get the Repository
   Before installing, you have to clone this repository using one of the following commands in the terminal:
   ```bash
   git clone https://github.com/gabrield-droid/smart-greenhouse-web-app.git
   ```
   ```bash
   git clone git@github.com:gabrield-droid/smart-greenhouse-web-app.git
   ```
   ```bash
   gh repo clone gabrield-droid/smart-greenhouse-web-app
   ```
   Alternatively, you can download the ZIP file of the repository and extract it manually.

   Place the repository folder into this directory `/var/www/`.


## Installation

### Guided Installation (Debian-based distros only)

#### This script helps set up:
- MySQL/MariaDB configuration
- Initial user account creation
- Apache2 VirtualHost configuration

This guided setup does not configure a local domain (e. g. `smart-greenhouse-web-app.local`) or HTTPS.
It's recommended to run this guided setup first. You may later customise configurations manually as needed.

#### This method assumes:
- You are using a Debian-based distro (e.g., Debian, Ubuntu, Linux Mint).
- The above requirements are already installed.
- Your MySQL/MariaDB server is running in the `localhost`.

#### Steps:
1. Open your terminal and navigate to the project directory.
2. Execute the installation script as the root user:
    ```bash
    sudo ./INSTALL_Debian.sh
    ```
    or
    ```bash
    sudo bash ./INSTALL_Debian.sh
    ```
3. Follow the on-screen instruction.

### Manual Installation

1. Create a folder to store the profile photos of the user accounts
   
   Open terminal and navigate to the project's root directory.
   Then, run the following command to create the folder:
   ```bash
   sudo mkdir files/photos
   ```
   Then, change the ownership of the folder to allow Apache2 HTTP Server to write to and delete from the folder:
   ```bash
   sudo chown www-data files/photos
   ```

2. Configure the MySQL/MariaDB database and user credentials
   
   Open MariaDB/MySQL by running this command on the terminal:
   ```bash
   sudo mysql
   ```
   Inside the MySQL/MariaDB run these command:
   ```sql
   -- Substitute database_name, database_user, and database_password with the values you want.

   -- Create the database
   CREATE DATABASE IF NOT EXISTS `database_name`;

   -- Select the database
   USE `database_name`;
   
   -- Create the tables
   CREATE TABLE IF NOT EXISTS `users` (
   `user_id` INT(5) PRIMARY KEY AUTO_INCREMENT,
   `username` VARCHAR(20) NOT NULL,
   `nickname` VARCHAR(20) NOT NULL,
   `password` VARCHAR(50) NOT NULL,
   `photo` VARCHAR(50) DEFAULT NULL
   );

   CREATE TABLE IF NOT EXISTS `settings` (
   `setting_id` INT(5) PRIMARY KEY AUTO_INCREMENT,
   `hi_temp` FLOAT DEFAULT NULL,
   `lo_temp` FLOAT DEFAULT NULL,
   `lo_hum` FLOAT DEFAULT NULL,
   `lo_light` FLOAT DEFAULT NULL,
   `user_id` INT(5) NOT NULL,
   FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
   );

   CREATE TABLE IF NOT EXISTS `sensors_actuators` (
   `record_id` INT(5) PRIMARY KEY AUTO_INCREMENT,
   `intensity` FLOAT DEFAULT NULL,
   `temperature` FLOAT DEFAULT NULL,
   `humidity` FLOAT DEFAULT NULL,
   `fan` TINYINT(1) DEFAULT NULL,
   `heater` TINYINT(1) DEFAULT NULL,
   `humidifier` TINYINT(1) DEFAULT NULL,
   `lamp` TINYINT(1) DEFAULT NULL,
   `user_id` INT(5) NOT NULL,
   FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
   );

   -- Create the MySQL/MariaDB user credentials
   CREATE USER IF NOT EXISTS 'database_user'@'localhost' IDENTIFIED BY 'database_password';

   -- Grant specific privileges to the user
   GRANT SELECT, INSERT, UPDATE, DELETE ON `database_name`.* TO 'database_user'@'localhost';
   ```

3. Create the initial user account

   Inside the MySQL/MariaDB run these command:
   ```sql
   -- Substitute database_name with the value you have set on the previous step!
   -- Substitute account_user, account_nick and account_password with the values you want.

   -- Select the database
   USE `database_name`;

   -- Insert the user credential into the database
   INSERT INTO `users` (`username`, `nickname`, `password`) VALUES ('account_user', 'account_nick', MD5('account_password'));

   -- Obtain the user_id of the newly-created initial user
   SELECT `user_id` FROM `users` WHERE `username`='account_user' AND password=md5('account_password');

   -- Initialise the tables settings and sensors_actuators with record linked to the initial account.
   -- Substitute account_id with the value you got when run the previous command

   INSERT INTO `settings` (`user_id`) VALUES ('account_id');
   INSERT INTO `sensors_actuators` (`user_id`) VALUES ('account_id');
   ```

4. Create `db_config.php` file

   Inside the project directory, create `db_config.php` file inside `libraries` folder:
   ```bash
   sudo touch libraries/db_config.php
   ```
   To edit the file, run this command:
   ```bash
   sudo nano libraries/db_config.php
   ```
   In the nano editor, paste the following lines:
   ```php
   <?php
      define("DB_NAME", "database_name");
      define("MYSQL_USER", "database_user");
      define("MYSQL_PASS", "database_password");
      
   ?>
   ```
   Substitute `database_user`, `database_password`, and `database_name` with the values you defined earlier in the previous step.

   To save, press `Ctrl+X`, then `Y`, and then `enter`.

5. Create the site configuration

   Make a configuration file in the directory `/etc/apache2/sites-available/`. You could name it whatever you like but in this tutorial we name it as the name of the repository: `smart-greenhouse-web-app.conf`. To edit the file, open the terminal, go to `/etc/apache2/sites-available`, and run this command on the terminal:
   ```bash
   sudo nano smart-greenhouse-web-app.conf
   ```
   Replace `smart-greenhouse-web-app.conf` with your chosen filename if you named it differently.

   In the Nano editor, paste the following lines:
   ```apache
   <VirtualHost *:80>
	   #ServerName smart-greenhouse-web-app.local

	   ServerAdmin webmaster@localhost
	   DocumentRoot /var/www/smart-greenhouse-web-app

	   ErrorLog ${APACHE_LOG_DIR}/error.log
	   CustomLog ${APACHE_LOG_DIR}/access.log combined
   </VirtualHost>

   # vim: syntax=apache ts=4 sw=4 sts=4 sr noet
   ```
   To save, press `Ctrl+X`, then `Y`, and then `enter`.
   
6. Enable the site configuration file.

   Run the following command to enable the site
   ```bash
   sudo a2ensite smart-greenhouse-web-app.conf
   ```

7. Reload the Apache2 HTTP Server.

   To activate the newly enabled configuration file, you need to reload the Apache2 HTTP Server. Run the following command to reload Apache2 HTTP Server:
   ```bash
   sudo service apache2 reload
   ```