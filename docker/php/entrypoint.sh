#!/bin/sh

 php bin/console doctrine:migrations:migrate -n
 php bin/console dbal:run-sql "$(cat tests/insert.sql)"

exec "$@"