#!/bin/bash

handle_sigint() {
    printf "\n"
    exit 1
}

trap handle_sigint SIGINT

echo -n "Provide Username: "
read username
echo -n "Provide Password: "
read -s password
printf "\n"
echo -n "Provide Password: (again) "
read -s verification_password
printf "\n"

if [[ -z "$username" || -z "$password" || -z "$verification_password" ]]; then
    echo "Values cannot be empty!"
    exit 1
fi

if [[ "$password" != "$verification_password" ]]; then
    echo "Passwords do not match!"
    exit 1
fi

FILE_PATH="/etc/nginx/.htpasswd"

touch "$FILE_PATH"

htpasswd -b "$FILE_PATH" "$username" "$password"