<?php
/**
 * The production database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'connection'  => array(
			'dsn'        => 'mysql:host=localhost;dbname=fuel_prod',
			'username'   => 'fuel_app',
			'password'   => 'super_secret_password',
		),
		'connection'  => array(
			'dsn'        => 'mysql:host=bb9f1d2cd164df;dbname=heroku_fd72c924660308f',
			'username'   => 'bb9f1d2cd164df',
			'password'   => '9a8948e6',
		),

	),
);
