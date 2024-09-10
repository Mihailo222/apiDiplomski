#!/bin/bash
#vraca prva 3 procesa koja koriste najvise cpu i memorije
hostname=$1
ip_address=$2
password=$3

if [ "$#" -ne 3 ]; then
    echo "Usage: $0 <hostname> <ip_address> <password>"
    exit 1
fi

output=$( sshpass -p "${password}" ssh "${hostname}"@"${ip_address}" "top -b -n1 | awk 'NR>7 && NR<11 {print \$9,\$10,\$12}'" )
echo $output
