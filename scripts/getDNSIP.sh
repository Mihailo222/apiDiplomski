#!/bin/bash

echo $( grep 'ip:' /mnt/c/Users/Acer/vagrant_projects_for_wsl/laravel2/project-name/configuration/dns_server/config/Vagrantfile | awk '{print $4}' | tr -d '",' )
