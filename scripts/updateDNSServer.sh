#!/bin/bash


if [ "$#" -ne 7 ];
then
 echo "Usage: $0 <dns_ipa> <db_ipa> <ws_ipa> <fqdn1> <fqdn2> <ssh_user> <ssh_password>"
 exit 1
fi


dns_ipa=$1
db_ipa=$2
ws_ipa=$3
fqdn1=$4
fqdn2=$5

ssh_user=$6
ssh_password=$7

remote_script_path="/mnt/c/Users/Acer/vagrant_projects_for_wsl/laravel2/project-name/scripts/editDNS.sh" #potencijalni problem

sshpass -p "${ssh_password}" scp "${remote_script_path}" "${ssh_user}"@"${dns_ipa}":"/home/${ssh_user}"
sshpass -p "${ssh_password}" ssh "${ssh_user}"@"${dns_ipa}" "sudo bash editDNS.sh ${dns_ipa} ${db_ipa} ${ws_ipa} ${fqdn1} ${fqdn2}"
sshpass -p "${ssh_password}" ssh "${ssh_user}"@"${dns_ipa}" "rm /home/${ssh_user}/editDNS.sh"
