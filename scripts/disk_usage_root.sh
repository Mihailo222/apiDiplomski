#!/bin/bash

hostname=$1
ip_address=$2
password=$3

if [ "$#" -ne 3 ]; then
    echo "Usage: $0 <hostname> <ip_address> <password>"
    exit 1
fi

output=$( sshpass -p "${password}" ssh "${hostname}"@"${ip_address}" "df -hT -x tmpfs -x devtmpfs -x vfat -x vboxsf | awk 'NR==2'" )
echo $output
