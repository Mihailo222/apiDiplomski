#!/bin/bash


if [ "$#" -ne 5 ]; then
    echo "Usage: $0 <dns_ip_address> <ssh_password> <ssh_user> <ws_ipa>  <remote_script_path>"
    exit 1
fi


dns_ipa="$1"
ssh_password="$2"
ssh_user="$3"
ws_ipa="$4"
remote_script_path="$5"


sshpass -p "${ssh_password}" scp "${remote_script_path}" "${ssh_user}"@"${ws_ipa}":"/home/${ssh_user}"
sshpass -p "${ssh_password}" ssh "${ssh_user}"@"${ws_ipa}" "sudo bash updatenameserver.sh ${dns_ipa}"
sshpass -p "${ssh_password}" ssh "${ssh_user}"@"${ws_ipa}" "rm /home/${ssh_user}/updatenameserver.sh"
