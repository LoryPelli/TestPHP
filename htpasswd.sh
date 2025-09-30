#!/bin/bash

FILE_PATH="/etc/nginx/.htpasswd"

read -p "Provide Username: " username
read -p "Provide Password: " password

touch "$FILE_PATH"

htpasswd -b "$FILE_PATH" $username $password