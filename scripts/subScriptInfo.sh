#!/bin/bash

echo "USER:"
user=$( whoami )
echo $user
#ip a
#echo "FILESYSTEMS:"
filesystems=$( df -h | awk '{ print $1}')
echo $filesystems
echo "UNAME:"

echo "Kernel name: $( uname -s )"
echo "Hostanme: $( uname -n )"
echo "Kernel release: $( uname -r )"
echo "Kernel version: $( uname -v )"
echo "Machine hardware name: $( uname -m )"
echo "DISK"
df -h
#echo "************************************"
echo "IP:"
ip a
#echo "************************************"
echo "USERS"
users=$( sudo cat /etc/passwd | awk -F: '{print $1}' )
echo $users
echo "GROUPS"
groups=$( cat /etc/group | awk -F: '{print $1}' )
echo $groups
echo "SHELLS:"
 cat /etc/passwd | awk -F: '{print "User  " $1 "  uses  "  $7 "  shell and stores files in  " $6 "  directory.  " }'
 #------------------------------------------------------------------------------------------------------------------
