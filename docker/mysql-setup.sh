#!/bin/sh
echo "mysql service start"
service mysql start
echo "mysql init start"
mysql < ./privileges.sql
mysql < ./schema.sql
echo "mysql init OK"
