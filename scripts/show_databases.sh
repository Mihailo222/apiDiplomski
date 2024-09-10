#!/bin/bash

db_username=$1
db_passwd=$2


if [ "$#" -ne 2 ];
then
  echo "Usage: $0 $1 $2"
  exit 1
fi

echo $( mysql -u "${db_username}" -p"${db_passwd}" -e "SHOW DATABASES;" )
