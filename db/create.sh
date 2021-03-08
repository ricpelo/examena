#!/bin/sh

if [ "$1" = "travis" ]; then
    psql -U postgres -c "CREATE DATABASE examena_test;"
    psql -U postgres -c "CREATE USER examena PASSWORD 'examena' SUPERUSER;"
else
    [ "$1" = "test" ] || sudo -u postgres dropdb --if-exists examena
    sudo -u postgres dropdb --if-exists examena_test
    [ "$1" = "test" ] || sudo -u postgres dropuser --if-exists examena
    [ "$1" = "test" ] || sudo -u postgres psql -c "CREATE USER examena PASSWORD 'examena' SUPERUSER;"
    [ "$1" = "test" ] || sudo -u postgres createdb -O examena examena
    [ "$1" = "test" ] || sudo -u postgres psql -d examena -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    sudo -u postgres createdb -O examena examena_test
    sudo -u postgres psql -d examena_test -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    [ "$1" = "test" ] && exit
    LINE="localhost:5432:*:examena:examena"
    FILE=~/.pgpass
    if [ ! -f $FILE ]; then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE; then
        echo "$LINE" >> $FILE
    fi
fi
