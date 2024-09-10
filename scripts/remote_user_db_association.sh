#!/bin/bash

ssh_user=$1
ssh_passwd=$2
remote_script_path="/mnt/c/Users/Acer/vagrant_projects_for_wsl/laravel2/project-name/scripts/user_db_association.sh"
db_user=$3
db_passwd=$4
db_ipa=$5
new_user=$6
new_db=$7
new_user_ip=$8
new_user_pass=$9

if [ "$#" -ne 9 ];
then
  exit 1
fi

sshpass -p "${ssh_passwd}" scp "${remote_script_path}" "${ssh_user}"@"${db_ipa}":"/home/${ssh_user}"
sshpass -p "${ssh_passwd}" ssh "${ssh_user}"@"${db_ipa}" "sudo bash user_db_association.sh ${db_user} ${db_passwd} ${new_user} ${new_db} ${new_user_ip} ${new_user_pass}"
sshpass -p "${ssh_passwd}" ssh "${ssh_user}"@"${db_ipa}" "rm /home/${ssh_user}/user_db_association.sh"
