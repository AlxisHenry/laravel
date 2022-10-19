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

dependencies() {
	if [ "$1" == "--production" ]; then
        rm -rf vendor/ node_modules/;
        composer install --no-dev --optimize-autoloader && npm install --omit=dev;
    elif [ "$1" == "--development" ]; then
        #- All dependencies are needed for build process
        composer install && npm install;
    fi
}

build() {
	npm run build;
}

configuration() {
	cp .env.example .env;
	php artisan key:generate > /dev/null 2>&1;
	php artisan storage:link > /dev/null 2>&1;
}

env_application() {
	if [ "$1" == "--production" ]; then
		APP_ENV="production";
		APP_DEBUG="false";
		APP_URL="https:\/\/domain.com";
    elif [ "$1" == "--development" ]; then
    	APP_ENV="local";
		APP_DEBUG="true";
		APP_URL="http:\/\/localhost";
	fi
}

env_database() {
	echo -e "  Database name [\e[0;33mnull\e[0m]"; printf '> '; read DB_NAME;
	echo -e "\n  Username [\e[0;33mnull\e[0m]"; printf '> '; read DB_USERNAME;
	echo -e "\n  Password [\e[0;33mnull\e[0m]"; printf '> '; read DB_PASSWORD;
}

env_emails() {
	echo -e "\n  Enter your api token [\e[0;33mnull\e[0m]"; printf '> '; read TOKEN;
	RESPONSE=$(curl -s https://api.alexishenry.eu/$TOKEN/smtp)
	RESPONSE_CODE=$(echo $RESPONSE | awk -F 'code' '{print $2}' | sed 's/"://' | awk -F ',' '{print $1}')
	if [ $RESPONSE_CODE -eq 200 ]
	then 
		MAIL_USERNAME=$(echo $RESPONSE | awk -F 'smtp'  '{print $2}' | awk -F 'email' '{print $2}' | cut -d ',' -f 1| sed 's/":"//' | sed 's/"//')
		MAIL_PASSWORD=$(echo $RESPONSE | awk -F 'smtp'  '{print $2}' | awk -F 'password' '{print $2}' | cut -d ',' -f 1| sed 's/":"//' | sed 's/"//' | sed 's/}}}//')
		echo -e "\nThe email server has been correctly configured. Response code : [\e[0;33m$RESPONSE_CODE\e[0m]\n"
	else
		MAIL_USERNAME="";
		MAIL_PASSWORD="";	
		echo -e "\nThe provided token isn't correct. Response code : [\e[0;33m$RESPONSE_CODE\e[0m]\n"
	fi	
}

env() {
	env_application --development;
	env_database;
	env_emails;
	ENV="APP_ENV APP_DEBUG APP_URL DB_DATABASE DB_USERNAME DB_PASSWORD MAIL_USERNAME MAIL_PASSWORD"
	for ENV_VAR in ${ENV}; do
		sed "s/$ENV_VAR=/&${!ENV_VAR}/" -i .env
	done
}

start() {
	clear;
	echo -e "\nPlease wait, we are setting up the application...\n";	
	dependencies --development > /dev/null 2>&1;
	build > /dev/null 2>&1;
	configuration > /dev/null 2>&1;
	env;
}

start;