<?php

$dir = "/portal-catatudo";

define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT',  $_SERVER['DOCUMENT_ROOT']);
define('SITE_PATH', SITE_ROOT . $dir);
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . $dir);
define('CATATUDO_API', 'https://catatudo-api.herokuapp.com/api/v1');
// define('CATATUDO_API', 'http://localhost:3001/api/v1');
