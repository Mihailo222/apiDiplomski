#!/bin/bash
# Fetch total RAM from a remote machine

if [ "$#" -ne 3 ]; then
    echo "Usage: $0 <hostname> <ip_address> <password>"
    exit 1
fi

hostname=$1
ip_address=$2
password=$3


output=$(sshpass -p "${password}" ssh "${hostname}"@"${ip_address}" "free -h | awk 'NR==2 {print \$7}'")


echo "Available RAM: $output"
