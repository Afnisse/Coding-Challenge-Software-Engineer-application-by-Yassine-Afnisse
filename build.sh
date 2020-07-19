#!/bin/bash

container_name="yassine-afnisse-tech-challenge"


# Run docker-compose to build image and create needed containers.

docker-compose up -d
# Run all feature testing using in memory sqlite database

docker exec $container_name bash -c "php artisan test" 



# Migrate tables to the database

docker exec $container_name bash -c "php artisan migrate"



