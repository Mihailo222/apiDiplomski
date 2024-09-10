#!/bin/bash

db_username=$1
db_passwd=$2
db_name=$3

if [ "$#" -ne 3 ];
then
  echo "Usage: $0 $1 $2 $3"
  exit 1
fi

echo $( mysql -u "${db_username}" -p"${db_passwd}" -e "CREATE DATABASE $3;" )
