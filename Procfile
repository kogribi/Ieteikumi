release: mysql -h $MYSQLHOST -P $MYSQLPORT -u $MYSQLUSER -p$MYSQLPASSWORD $MYSQLDATABASE < migrations.sql
web: php -S 0.0.0.0:${PORT:-8080}