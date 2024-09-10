#!/bin/bash

ssh_user=$1
ssh_passwd=$2
remote_script_path="/mnt/c/Users/Acer/vagrant_projects_for_wsl/laravel2/project-name/scripts/show_databases.sh"
db_user=$3
db_passwd=$4
db_ipa=$5

if [ "$#" -ne 5 ];
then
  exit 1
fi

sshpass -p "${ssh_passwd}" scp "${remote_script_path}" "${ssh_user}"@"${db_ipa}":"/home/${ssh_user}"
sshpass -p "${ssh_passwd}" ssh "${ssh_user}"@"${db_ipa}" "sudo bash show_databases.sh ${db_user} ${db_passwd}"
sshpass -p "${ssh_passwd}" ssh "${ssh_user}"@"${db_ipa}" "rm /home/${ssh_user}/show_databases.sh"






