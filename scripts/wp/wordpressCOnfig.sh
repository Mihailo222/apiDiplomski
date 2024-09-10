#!/bin/bash

if [ "$#" -ne 9 ]; then
  echo "Usage: $0 <FOLDER_NAME_FOR_APACHE> <DB_NAME> <DB_USER> <DB_PASSWORD> <DB_HOST> <SCRIPT_NAME> <HOSTNAME> <WEB_SERVER_IPADDR> <DOMAIN_NAME>"
  exit 1
fi


folderName=$1
#--------------------------------------------------------------------install wordpress software
cd /srv/www
wget https://wordpress.org/latest.zip
unzip latest.zip
rm latest.zip
mkdir "${folderName}"
mv wordpress/* "${folderName}"
rm -rf wordpress

#--------------------------------------------------------------------update wp-config file

DB_NAME=$2
DB_USER=$3
DB_PASSWORD=$4
DB_HOST=$5
SCRIPT_NAME=$6
HOST_NAME=$7
WEB_SERVER_IPADDR=$8
DOMAIN_NAME=$9

WP_CONFIG_FILE="/home/${HOST_NAME}/wp-config.php"
sed -i "s/define( 'DB_NAME', '.*' );/define( 'DB_NAME','${DB_NAME}' );/" $WP_CONFIG_FILE
sed -i "s/define( 'DB_USER', '.*' );/define( 'DB_USER','${DB_USER}' );/" $WP_CONFIG_FILE
sed -i "s/define( 'DB_PASSWORD', '.*' );/define( 'DB_PASSWORD','${DB_PASSWORD}' );/" $WP_CONFIG_FILE
sed -i "s/define( 'DB_HOST', '.*' );/define( 'DB_HOST','${DB_HOST}' );/" $WP_CONFIG_FILE

#---------------------------------------------------------------------copy wordpress config file to /srv/www/
mv "/home/${HOST_NAME}/wp-config.php" "/srv/www/${folderName}"

touch "/etc/apache2/sites-available/${folderName}.conf"

echo "<VirtualHost ${WEB_SERVER_IPADDR}:80>
 ServerName ${DOMAIN_NAME}
 DocumentRoot /srv/www/${folderName}
 <Directory /srv/www/${folderName}>
  Options FollowSymLinks
  AllowOverride All
  DirectoryIndex index.php
  Require all granted
 </Directory>
 <Directory /srv/www/${folderName}/wp-content>
  Options FollowSymLinks
  Require all granted
 </Directory>
</VirtualHost>" > "/etc/apache2/sites-available/${folderName}.conf"

 sudo ln -s "/etc/apache2/sites-available/${folderName}.conf" "/etc/apache2/sites-enabled/${folderName}.conf"
 sudo service apache2 restart
 rm "/home/${HOST_NAME}/wordpressCOnfig.sh"
