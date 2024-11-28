#!/usr/bin/env bash

mysql --user=root --password="$MYSQL_ROOT_PASSWORD" <<-EOSQL
    CREATE DATABASE IF NOT EXISTS kanye_quotes;

    GRANT ALL PRIVILEGES ON *.* TO '$MYSQL_USER'@'%';
EOSQL
