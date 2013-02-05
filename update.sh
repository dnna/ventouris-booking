#!/bin/bash
git reset --hard
git pull origin master
php composer.phar update
php -d memory_limit=256M app/console cache:clear --env=prod --no-debug
#php -d memory_limit=256M app/console assets:install web --symlink
php -d memory_limit=256M app/console assetic:dump --env=prod --no-debug
php -d memory_limit=256M app/console doctrine:schema:update --force
rm -fR app/cache/*

# Tests
php -d memory_limit=256M app/console cache:clear --env=test --no-debug
php app/console doctrine:schema:update --force --env=test
php app/console doctrine:fixtures:load --env=test --no-interaction
phpunit -c app