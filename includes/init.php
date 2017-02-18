<?php

define('MESSAGE_SUCCESS', 'success');
define('MESSAGE_ERROR', 'warning');
define('MESSAGE_WARNING', 'warning');

define ('PATH_BASE', __DIR__.'/..');
define ('PATH_INCLUDES', PATH_BASE.'/includes');
define ('PATH_CONFIG', PATH_INCLUDES.'/config');
define ('PATH_HELPERS', PATH_INCLUDES.'/helpers');
define ('PATH_MODELS', PATH_INCLUDES.'/models');
define ('PATH_CLASS', PATH_INCLUDES.'/classes');

require_once PATH_CONFIG.'/config.php';

if (session_status() == PHP_SESSION_NONE) {
	@session_start();
}

if (DEBUG) {
	error_reporting(E_ALL | E_STRICT);
	ini_set('display_errors', 1);
	ini_set('log_errors', 1);
} else {
	error_reporting(0);
}

// Include classes
require_once PATH_CLASS.'/DB.php';
require_once PATH_CLASS.'/Auth.php';

// Include functions helpers
require_once PATH_HELPERS.'/database.php';
require_once PATH_HELPERS.'/form.php';
require_once PATH_HELPERS.'/helpers.php';
require_once PATH_HELPERS.'/input.php';
require_once PATH_HELPERS.'/session.php';
require_once PATH_INCLUDES.'/functions.php';

// Include Models
require_once PATH_MODELS.'/Base.php';
require_once PATH_MODELS.'/User.php';


// Initialize database
Classes\DB::connect([
	'host' => DB_HOST,
	'user' => DB_USER,
	'pass' => DB_PASS,
	'port' => DB_PORT,
	'db_name' => DB_NAME,
]);

