# Classified ads
Classified ads web application.

### Made with:
- PHP
- MySQL

### To access the page locally with the domain classified-ads.test:
- /etc/apache2/apache2.conf

Add the following lines to this file:
```
<Directory /home/julian/dev/classified-ads/>
        Options Indexes FollowSymLinks
        AllowOverride None
        Require all granted
</Directory>
```
- /etc/apache2/sites-enabled

In this folder create a file (for example with the name entornos.conf) and add the following lines
Change YOUR_PROJECT_LOCATION with the folder of your project (for example for me this is `/home/julian/dev/classified-ads`)
```
<VirtualHost *:80>
	ServerName classified-ads.test

	ServerAdmin webmaster@localhost
	DocumentRoot YOUR_PROJECT_LOCATION

	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
- /etc/hosts
Add right after localhost the domain
```
127.0.0.1	localhost	classified-ads.test
```
