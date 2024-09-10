#!/bin/bash

db_username=$1
db_passwd=$2

new_user=$3
new_db=$4
new_user_ip=$5
new_user_pass=$6


if [ "$#" -ne 6 ];
then
  echo "Usage: $0 ${db_username} ${db_passwd} ${new_user} ${new_db} ${new_user_ip} ${new_user_pass}"
  exit 1
fi

 mysql -u "${db_username}" -p"${db_passwd}" -e "CREATE DATABASE ${new_db}; CREATE USER '${new_user}'@'${new_user_ip}' IDENTIFIED BY '${new_user_pass}'; GRANT ALL PRIVILEGES ON ${new_db}.* TO '${new_user}'@'${new_user_ip}'; FLUSH PRIVILEGES; "
