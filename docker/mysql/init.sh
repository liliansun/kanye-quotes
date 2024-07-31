#!/usr/bin/env bash

mysql --user=root --password="$MYSQL_ROOT_PASSWORD" <<-EOSQL
    CREATE DATABASE IF NOT EXISTS avrillo_test;

    GRANT ALL PRIVILEGES ON *.* TO '$MYSQL_USER'@'%';
EOSQL
