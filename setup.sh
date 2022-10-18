#!/bin/bash

# =================
# Application Setup
# =================

# - Be sure you are in the root folder of the application
# - Run this script with the following command : bash setup.sh
# - To configure emails username/password, you need to enter a token for the api request
# - After running the script follow the next steps :
# 		- Configure .env file (check database configuration & configure email server)
# 		- Setup the database with : npm run db:setup

function dependencies() {
	if [ "$1" == "--production" ]; then
        rm -rf vendor/ node_modules/;
        composer install --no-dev --optimize-autoloader && npm install --omit=dev;
    elif [ "$1" == "--development" ]; then
        #- All dependencies are needed for build process
        composer install && npm install;
    fi
}

function build() {
	npm run build;
}

function configuration() {
	cp .env.example .env;
	php artisan key:generate > /dev/null 2>&1;
	php artisan storage:link > /dev/null 2>&1;
}

function env() {
	# Create .env variables
	APP_ENV=$([ "$1" = "dev" ] && echo "local" || echo "production");
	APP_DEBUG=$([ "$1" = "dev" ] && echo "true" || echo "false");
	APP_URL=$([ "$1" = "dev" ] && echo "http:\/\/localhost" || echo "https:\/\/domain.com");
	echo -e "  Database name [\e[0;33mnull\e[0m]"; printf '> '; read DB_NAME;
	echo -e "\n  Username [\e[0;33mnull\e[0m]"; printf '> '; read DB_USERNAME;
	echo -e "\n  Password [\e[0;33mnull\e[0m]"; printf '> '; read DB_PASSWORD;
	MAIL_USERNAME="";
	MAIL_PASSWORD="";
	# Api request
	echo -e "\n  Enter your api token [\e[0;33mnull\e[0m]"; printf '> '; read TOKEN;
	RESPONSE=$(curl -s https://api.alexishenry.eu/$TOKEN/smtp)
	RESPONSE_CODE=$(echo $RESPONSE | awk -F 'code' '{print $2}' | sed 's/"://' | awk -F ',' '{print $1}')
	if [ $RESPONSE_CODE -eq 200 ]
	then 
		MAIL_USERNAME=$(echo $RESPONSE | awk -F 'smtp'  '{print $2}' | awk -F 'email' '{print $2}' | cut -d ',' -f 1| sed 's/":"//' | sed 's/"//')
		MAIL_PASSWORD=$(echo $RESPONSE | awk -F 'smtp'  '{print $2}' | awk -F 'password' '{print $2}' | cut -d ',' -f 1| sed 's/":"//' | sed 's/"//' | sed 's/}}}//')
		echo -e "\n  The email server has been correctly configured. Response code : [\e[0;33m$RESPONSE_CODE\e[0m]"
	else
		echo -e "\n  The provided token isn't correct. Response code : [\e[0;33m$RESPONSE_CODE\e[0m]"
	fi
	# Sed .env file
	ENV="APP_ENV APP_DEBUG APP_URL DB_DATABASE DB_USERNAME DB_PASSWORD MAIL_USERNAME MAIL_PASSWORD"
	for ENV_VAR in ${ENV}; do
		sed "s/$ENV_VAR=/&${!ENV_VAR}/" -i .env
	done
}

dependencies --development;
build;
configuration;
env;