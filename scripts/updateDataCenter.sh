#! /bin/bash
#Write a shell script to automate the process of updating a list of servers with the latest security patches. 


if [ "$#" -lt 1 ]
then
  echo "Usage: $0 <ip_address1> ... <ip_addressN>"
  exit 1
fi

servers=("$@") #prima ceo niz IP adresa koje user unese

i=0
for server in "${servers[@]}"
do
 echo "Updating $server..."
 sshpass -p "vagrant" ssh vagrant@$server "sudo apt-get update && sudo apt-get upgrade -y" #every machine's username - vagrant
 echo "$server updated successfully!"
 (( i=i+1 ))
done
