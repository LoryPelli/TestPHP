#!/bin/bash

FILE_PATH="/etc/nginx/.htpasswd"

read -p "Provide Username: " username
read -p "Provide Password: " password

if [ ! -f "$FILE_PATH" ]; then
    touch "$FILE_PATH"
fi

htpasswd -b "$FILE_PATH" $username $password