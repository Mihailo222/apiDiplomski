#!/bin/bash


if [ "$#" -ne 5 ]; then
    echo "Usage: $0 <ws_ipa> <ssh_password> <ssh_user> <fqdn1> <fqdn2> "
    exit 1
fi

ws_ipa="$1"
ssh_password="$2"
ssh_user="$3"
fqdn1="$4"
fqdn2="$5"
remote_script_path="/mnt/c/Users/Acer/vagrant_projects_for_wsl/laravel2/project-name/scripts/editWS.sh"


sshpass -p "${ssh_password}" scp "${remote_script_path}" "${ssh_user}"@"${ws_ipa}":"/home/${ssh_user}"
sshpass -p "${ssh_password}" ssh "${ssh_user}"@"${ws_ipa}" "sudo bash editWS.sh ${ws_ipa} ${fqdn1} ${fqdn2}"
sshpass -p "${ssh_password}" ssh "${ssh_user}"@"${ws_ipa}" "rm /home/${ssh_user}/editWS.sh"
