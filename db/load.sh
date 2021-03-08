#!/bin/sh

BASE_DIR=$(dirname "$(readlink -f "$0")")
if [ "$1" != "test" ]; then
    psql -h localhost -U examena -d examena < $BASE_DIR/examena.sql
    if [ -f "$BASE_DIR/examena_test.sql" ]; then
        psql -h localhost -U examena -d examena < $BASE_DIR/examena_test.sql
    fi
    echo "DROP TABLE IF EXISTS migration CASCADE;" | psql -h localhost -U examena -d examena
fi
psql -h localhost -U examena -d examena_test < $BASE_DIR/examena.sql
echo "DROP TABLE IF EXISTS migration CASCADE;" | psql -h localhost -U examena -d examena_test
