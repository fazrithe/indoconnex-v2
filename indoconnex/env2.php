<?php

$config_database = array(
	'host'     => 'localhost',
	'username' => 'u1269282_indoconnex',
	'password' => 'Indo@123',
	'database' => 'u1269282_indoconnex'
);

$config_database_old = array(
	'host'     => '',
	'username' => '',
	'password' => '',
	'database' => ''
);

$config_email = array(
	'host'        => '',
	'port'        => '',
	'user'        => '',
	'pass'        => '',
	'user_name'   => '',
	'admin_email' => '',
);

defined('INDOCONNEX_EMAILCONFIG_HOST') or define('INDOCONNEX_EMAILCONFIG_HOST', $config_email['host']);
defined('INDOCONNEX_EMAILCONFIG_PORT') or define('INDOCONNEX_EMAILCONFIG_PORT', $config_email['port']);
defined('INDOCONNEX_EMAILCONFIG_USER') or define('INDOCONNEX_EMAILCONFIG_USER', $config_email['user']);
defined('INDOCONNEX_EMAILCONFIG_PASS') or define('INDOCONNEX_EMAILCONFIG_PASS', $config_email['pass']);
defined('INDOCONNEX_EMAILCONFIG_USER_NAME') or define('INDOCONNEX_EMAILCONFIG_USER_NAME', $config_email['user_name']);
defined('INDOCONNEX_EMAILCONFIG_ADMIN_EMAIL') or define('INDOCONNEX_EMAILCONFIG_ADMIN_EMAIL', $config_email['admin_email']);

defined('INDOCONNEX_DBCONFIG_HOST') or define('INDOCONNEX_DBCONFIG_HOST', $config_database['host']);
defined('INDOCONNEX_DBCONFIG_USERNAME') or define('INDOCONNEX_DBCONFIG_USERNAME', $config_database['username']);
defined('INDOCONNEX_DBCONFIG_PASSWORD') or define('INDOCONNEX_DBCONFIG_PASSWORD', $config_database['password']);
defined('INDOCONNEX_DBCONFIG_DATABASE') or define('INDOCONNEX_DBCONFIG_DATABASE', $config_database['database']);

defined('INDOCONNEX_DBCONFIG_HOST_OLD') or define('INDOCONNEX_DBCONFIG_HOST_OLD', $config_database_old['host']);
defined('INDOCONNEX_DBCONFIG_USERNAME_OLD') or define('INDOCONNEX_DBCONFIG_USERNAME_OLD', $config_database_old['username']);
defined('INDOCONNEX_DBCONFIG_PASSWORD_OLD') or define('INDOCONNEX_DBCONFIG_PASSWORD_OLD', $config_database_old['password']);
defined('INDOCONNEX_DBCONFIG_DATABASE_OLD') or define('INDOCONNEX_DBCONFIG_DATABASE_OLD', $config_database_old['database']);