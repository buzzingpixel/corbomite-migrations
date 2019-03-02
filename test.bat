@echo off

docker exec -it --user root --workdir /app php-corbomite-migrations bash -c "php /app/vendor/bin/phpunit"
