#!/bin/bash

#folder, user, pass, ip

if [ "$#" -ne 4 ];
then
  echo "usage: $0 <remote_ip> <ssh_user> <ssh_passwd> <folder>"
  exit 1
fi

remote_ip=$1
ssh_user=$2
ssh_passwd=$3
folder=$4

remote_script_path="/mnt/c/Users/Acer/vagrant_projects_for_wsl/laravel2/project-name/scripts/folder_mem_usage.sh"

sshpass -p "${ssh_passwd}" scp "${remote_script_path}" "${ssh_user}"@"${remote_ip}":"/home/${ssh_user}"

sshpass -p "${ssh_passwd}" ssh "${ssh_user}"@"${remote_ip}" "sudo bash folder_mem_usage.sh ${folder}"

sshpass -p "${ssh_passwd}" ssh "${ssh_user}"@"${remote_ip}" "rm /home/${ssh_user}/folder_mem_usage.sh"
