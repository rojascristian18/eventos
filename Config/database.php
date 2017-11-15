<?php
class DATABASE_CONFIG
{
	public $default = array(
		'datasource'	=> 'Database/Mysql',
		'persistent'	=> false,
		'host'			=> '69.164.205.133',
		'login'			=> 'nodriza',
		'password'		=> 'IgP_8111980_IgP',
		'database'		=> 'eventos_dev',
		'prefix'		=> 'evento_',
		'encoding'		=> 'utf8'
	);

	# Toolmania DB config
	public $toolmania = array(
		'datasource'	=> 'Database/Mysql',
		'persistent'	=> false,
		'host'			=> '69.164.205.133',
		'login'			=> 'nodriza',
		'password'		=> 'IgP_8111980_IgP',
		'database'		=> 'toolmania2',
		'prefix'		=> 'tm_',
		'encoding'		=> 'utf8'
	);

	# Walko DB config
	public $walko = array(
		'datasource'	=> 'Database/Mysql',
		'persistent'	=> false,
		'host'			=> '69.164.205.133',
		'login'			=> 'nodriza',
		'password'		=> 'IgP_8111980_IgP',
		'database'		=> 'walko',
		'prefix'		=> 'ac_',
		'encoding'		=> 'utf8'
	);
}
