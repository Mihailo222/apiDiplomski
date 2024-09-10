#!/bin/bash

hostname=$1
ip_address=$2
password=$3

if [ "$#" -ne 3 ]; then
    echo "Usage: $0 <hostname> <ip_address> <password>"
    exit 1
fi

output=$( sshpass -p "${password}" ssh "${hostname}"@"${ip_address}" 'who' )
echo $output
