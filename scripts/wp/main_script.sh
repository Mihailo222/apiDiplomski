#!/bin/bash


#variables
wordpress_folder_name=$1
db_name=$2
db_user=$3
db_password=$4
db_host=$5
hostname=$6
password=$7
ip_a=$8
domain=$9

if [ "$#" -ne 9 ]; then
  echo "USAGE: $0 <wp-folder-name> <db-name> <db-user> <db-password> <db-host> <ssh-user> <ssh-pass> <ip_address> <domain>"
  exit 1
fi
# copy wp-config file to remote server

$( sshpass -p "${password}" scp "/mnt/c/Users/Acer/vagrant_projects_for_wsl/laravel2/project-name/scripts/wp/wp-config.php" "${hostname}"@"${ip_a}:/home/${hostname}" )

#copy wordpress site editing script and execute it on remote web server VM

script="/mnt/c/Users/Acer/vagrant_projects_for_wsl/laravel2/project-name/scripts/wp/wordpressCOnfig.sh"
$( sshpass -p "${password}" scp "${script}" "${hostname}"@"${ip_a}:/home/${hostname}" )

#execute a script on a remote web server and edit wp-config.php file
$( sshpass -p "${password}" ssh "${hostname}"@"${ip_a}"  "sudo bash /home/${hostname}/wordpressCOnfig.sh ${wordpress_folder_name} ${db_name} ${db_user} ${db_password} ${db_host} wordpressCOnfig.sh ${hostname} ${ip_a} ${domain}" )
