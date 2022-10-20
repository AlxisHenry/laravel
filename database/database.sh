#!/bin/bash

# - Be sure you are in the root folder of the application
# - You will need to configure your .env file before running this script 
# - Please make sure your database already exist
# - Run this script with the following command : bash /database/migrate.sh

database_setup () {

	# Check that you are running the script in the right folder
	if [ ! -d "database" ]; then
		echo '';
		echo -e "\e[41m                                                                        \e[0m";
		echo -e "\e[41m   You need to run the script from the root folder of the application   \e[0m";
		echo -e "\e[41m                                                                        \e[0m";
		echo '';
		exit;
	fi;

	# Drop all tables and re-run all migrations
	php artisan migrate:fresh;

	# Seed the database with records
	php artisan db:seed;

}

database_setup;