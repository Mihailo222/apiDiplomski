#!/bin/bash

#skripta prima 2 prametra: IP ADDR, HOSTNAME i automatizuje proces kreiranja virtuelne masine za admina npr, postoji problem sa Vagrantom i Windowsom i WSL, gde ne moze da se vidi VB iz WSL-a i zato vagrant ne radi kroz api...


ip_address=$1
hostname=$2


mkdir "/mnt/c/Users/Acer/vagrant_projects_for_wsl/testing/VMs/VM$ip_address"
file_path="/mnt/c/Users/Acer/vagrant_projects_for_wsl/testing/VMs/VM$ip_address/Vagrantfile" #kako da dize vise razlicitih VM-ova
touch $file_path

#images are not always the best - opensource software
echo "
VAGRANTFILE_API_VERSION = \"2\"
Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|


   config.vm.define \"block\" do |block|
        block.vm.box = \"geerlingguy/ubuntu2004\"
        block.ssh.insert_key = false
        block.vm.hostname = HOST_NAME
        block.vm.network \"private_network\", ip: IP_ADDRESS, netmask: \"255.255.255.0\"

    end

end">"$file_path"

 sed -i "s/HOST_NAME/\"${hostname}\"/g" $file_path
 sed -i "s/IP_ADDRESS/\"${ip_address}\"/g" $file_path


cd "/mnt/c/Users/Acer/vagrant_projects_for_wsl/testing/VMs/VM$ip_address"
vagrant up





#cat $file_path

#echo $ip_address
#echo $hostname
