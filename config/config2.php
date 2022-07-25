<?php
	define('SITE_ROOT', '/');

	define('SITE_NAME', 'Travelling-Camper');

	//Meta
	define('META_VIEWPORT', 'width=device-width, initial-scale=1.0');
	define('META_AUTHOR', 'Tom Collins | Constance Hathaway');
	define('META_DESC', 'Sold her house, bought a camper... Now two travellers travelling across Europe in a camper.');

	//Contact
	define('QUOTE_EMAIL', 'contact@travelling-camper.co.uk');
	define('CONTACT_EMAIL', 'contact@travelling-camper.co.uk');
	define('EMAIL_ADMIN', 'admin@travelling-camper.co.uk');

	define('CONTACT_TEL', '07879823478');


	/*// Database
	define('DB_HOST', '127.0.0.1');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'travellingcamper');
	*/
	// Database
	define('DB_HOST', '92.205.10.32');
	define('DB_USER', 'tc_4537db_use');
	define('DB_PASS', 'pfh3TC653)(2');
	define('DB_NAME', 'travelling_camper');


	// Character set
	define('DB_CHARSET', 'utf8mb4');

	// Removes the last 2 directory names
	define('APP_ROOT', dirname(dirname(__FILE__)));

	// used for links
	define('URL_ROOT', 'http://travelling-camper.co.uk/travelling-camper/v1/');
	define('CMS_ROOT', 'http://travelling-camper.co.uk/travelling-camper/v1/acc/');

	// Set production server to 1
	ini_set('display_errors', 1);
	ini_set('log_errors', 1);

	// Recipes
	define('RECIPE_IMAGE', 'images/recipes/');
