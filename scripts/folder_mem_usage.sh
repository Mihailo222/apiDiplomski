#!/bin/bash

folder=$1

if [ "$#" -ne 1 ]; then
  echo "Usage: $0 </path/of/folder/for/searching>"
  exit 1
fi

du -h $1 | tail -n 1 | awk '{print $1}'
