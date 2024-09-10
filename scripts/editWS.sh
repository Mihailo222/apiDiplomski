#!/bin/bash


if [ "$#" -ne 3 ]; then
  echo "Usage: $0 <ws_ipa> <fqdn1> <fqdn2>"
  exit 1
fi


ws_ipa="$1"
fqdn1="$2"
fqdn2="$3"

#obavezno brisanje fajlova koji su symlinkovani u sites-enabled za odredjene fajlove iz sites-enabled jer to moze samo jedanput
siteOneConf="/etc/apache2/sites-available/siteOne.conf"
siteTwoConf="/etc/apache2/sites-available/siteTwo.conf"

sudo rm /etc/apache2/sites-enabled/siteOne.conf
sudo rm /etc/apache2/sites-enabled/siteTwo.conf


# Create siteOne configuration
cat <<EOL | sudo tee "$siteOneConf" > /dev/null
<VirtualHost ${ws_ipa}:80>
  ServerName ${fqdn1}
  DocumentRoot /srv/www/wordpressOne
  <Directory /srv/www/wordpressOne>
    Options FollowSymLinks
    AllowOverride Limit Options FileInfo
    DirectoryIndex index.php
    Require all granted
  </Directory>
  <Directory /srv/www/wordpressOne/wp-content>
    Options FollowSymLinks
    Require all granted
  </Directory>
</VirtualHost>
EOL

# Create siteTwo configuration
cat <<EOL | sudo tee "$siteTwoConf" > /dev/null
<VirtualHost ${ws_ipa}:80>
  ServerName ${fqdn2}
  DocumentRoot /srv/www/wordpressTwo
  <Directory /srv/www/wordpressTwo>
    Options FollowSymLinks
    AllowOverride Limit Options FileInfo
    DirectoryIndex index.php
    Require all granted
  </Directory>
  <Directory /srv/www/wordpressTwo/wp-content>
    Options FollowSymLinks
    Require all granted
  </Directory>
</VirtualHost>
EOL


sudo a2ensite siteOne.conf
sudo a2ensite siteTwo.conf


sudo service apache2 stop
sudo service apache2 start
