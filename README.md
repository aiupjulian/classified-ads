
# Classified ads
Classified ads web application.
## Made with:
- PHP
- MySQL
## Folder structure:
- **docs**

	Documentation related to this project
- **public**

	Public folder of the web application
- **resources**

	Templates referenced from the public views, layout, helper functions and config.
## Configuration:
*After the following configuration, you will be able to access the web application with the following URL: classified-ads.test*
### /etc/apache2/apache2.conf
Add the following lines to this file:
```
<Directory YOUR_PROJECT_FOLDER_LOCATION>
	Options Indexes FollowSymLinks
	AllowOverride All
	Require all granted
</Directory>
```
### /etc/apache2/sites-enabled
In this folder create a file (for example with the name entornos.conf) and add the following lines:

*Change YOUR_PROJECT_PUBLIC_FOLDER_LOCATION with the public folder of your project (for example for me this is `/home/julian/dev/classified-ads/public`)*
```
<VirtualHost *:80>
	ServerName classified-ads.test

	ServerAdmin webmaster@localhost
	DocumentRoot YOUR_PROJECT_PUBLIC_FOLDER_LOCATION

	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
### /etc/hosts
Add right after localhost the domain
```
127.0.0.1	localhost	classified-ads.test
```
### php.ini config
Create .php_tmp in root user folder
Edit the file:
```
sudo gedit /etc/php/7.0/apache2/php.ini
```
And change these lines:
```
session.auto_start = 1
upload_tmp_dir = /home/YOUR_USERNAME/.php_tmp
```
And run the following commands
```
usermod -a -G www-data YOUR_USERNAME
sudo chgrp www-data /home/YOUR_USERNAME/.php_tmp/
sudo chgrp www-data YOUR_PROJECT_PUBLIC_FOLDER_LOCATION/images/uploaded
```
### Database
Use the database.sql file in root folder.

To dump the database, use the following command: `mysqldump -u root -p --databases classified_ads > database.sql`
