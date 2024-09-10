#!/bin/bash
grep 'ip:' /mnt/c/Users/Acer/vagrant_projects_for_wsl/laravel2/project-name/configuration/cluster/Vagrantfile | awk '{print $4}' | tr -d '",' | awk 'NR == 1 {print}'
