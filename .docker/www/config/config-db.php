<?php
##
## database access settings in php format
## automatically generated from /etc/dbconfig-common/phpmyadmin.conf
## by /usr/sbin/dbconfig-generate-include
##
## by default this file is managed via ucf, so you shouldn't have to
## worry about manual changes being silently discarded.  *however*,
## you'll probably also want to edit the configuration file mentioned
## above too.
##
$dbuser=getenv('DB_USER');
$dbpass=getenv('DB_PASSWORD');
$basepath='';
$dbname='phpmyadmin';
$dbserver=getenv('APP_NAME').'db';
$dbport='3306';
$dbtype='mysql';
