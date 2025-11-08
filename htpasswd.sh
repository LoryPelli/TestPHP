#!/usr/bin/env bash

handle_sigint() {
    printf "\n"
    exit 1
}

trap handle_sigint SIGINT

FILE_PATH="/etc/nginx/.htpasswd"

if [ -s "$FILE_PATH" ]; then
    echo -e "\033[1;33m[WARN]\033[0m Please remove the .htpasswd file before running this script!"
    exit 1
fi

echo -n "Provide Username: "
read username
echo -n "Provide Password: "
read -s password
printf "\n"
echo -n "Provide Password: (again) "
read -s verification_password
printf "\n"

if [[ -z "$username" || -z "$password" || -z "$verification_password" ]]; then
    echo -e "\x1b[1;31m[ERROR]\x1b[0m Values cannot be empty!"
    exit 1
fi

if [[ "$password" != "$verification_password" ]]; then
    echo -e "\x1b[1;31m[ERROR]\x1b[0m Passwords do not match!"
    exit 1
fi

touch "$FILE_PATH"

htpasswd -b "$FILE_PATH" "$username" "$password" &> /dev/null

echo -e "\x1b[1;32m[SUCCESS]\x1b[0m Added password for user $username!"