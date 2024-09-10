#!/bin/bash

#napravi fajl u koji se upisuje rezultat iz output2.txt tj. napisi da skripta ispisuje sadrzaj output2.txt, ali stavi npr. output<IP>.txt
#promeni rutu da bude post da user sam ubacuje podatke

hostname=$1
ip_address=$2
password=$3

remote_script_path="/mnt/c/Users/Acer/vagrant_projects_for_wsl/laravel2/project-name/scripts/grabFailedLogins.sh" #potencijalni problem
#remote_script_path="/scripts/subScriptInfo.sh"

#result="/mnt/c/Users/Acer/vagrant_projects_for_wsl/laravel2/project-name/scripts/resultsFor${ip_address}"

if [ "$#" -ne 3 ]; then
    echo "Usage: $0 <hostname> <ip_address> <password>"
    exit 1
fi


sshpass -p "${password}" scp "${remote_script_path}" "${hostname}"@"${ip_address}":"/home/${hostname}"
