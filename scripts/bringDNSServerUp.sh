#!/bin/bash

if [ "$#" -ne 6 ];
then
 echo "Usage: $0 <dns_ipa> <ws_ipa> <fqdn1> <fqdn2> <ssh_user> <ssh_password>"
 exit 1
fi

dns_ipa=$1
ws_ipa=$2
fqdn1=$3
fqdn2=$4

ssh_user=$5
ssh_password=$6

remote_script_path="/mnt/c/Users/Acer/vagrant_projects_for_wsl/laravel2/project-name/scripts/DNSUp.sh"

sshpass -p "${ssh_password}" scp "${remote_script_path}" "${ssh_user}"@"${dns_ipa}":"/home/${ssh_user}"
sshpass -p "${ssh_password}" ssh "${ssh_user}"@"${dns_ipa}" "sudo bash DNSUp.sh ${dns_ipa} ${ws_ipa} ${fqdn1} ${fqdn2}"
sshpass -p "${ssh_password}" ssh "${ssh_user}"@"${dns_ipa}" "rm /home/${ssh_user}/DNSUp.sh"


