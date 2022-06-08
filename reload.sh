#/bin/bash

docker-compose down

rm -rf composer.lock vendor
composer install 

docker-compose build
docker-compose up -d