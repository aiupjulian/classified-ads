# Classified ads
Classified ads web application.

### Made with:
- PHP
- MySQL

#### After the following configuration, you will be able to access the web application with the following URL: classified-ads.test

### Please modify the next files:
- /etc/apache2/apache2.conf

Add the following lines to this file:
```
<Directory /home/julian/dev/classified-ads/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>
```

- /etc/apache2/sites-enabled

In this folder create a file (for example with the name entornos.conf) and add the following lines

Change YOUR_PROJECT_PUBLIC_FOLDER_LOCATION with the public folder of your project (for example for me this is `/home/julian/dev/classified-ads/public`)
```
<VirtualHost *:80>
	ServerName classified-ads.test

	ServerAdmin webmaster@localhost
	DocumentRoot YOUR_PROJECT_PUBLIC_FOLDER_LOCATION

	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

- /etc/hosts
Add right after localhost the domain
```
127.0.0.1	localhost	classified-ads.test
```

- Run the following commands in terminal:
```
$ sudo a2enmod rewrite
$ sudo service apache2 restart
```
