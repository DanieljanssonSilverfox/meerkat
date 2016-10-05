<?php

// Set default timezone
date_default_timezone_set('Europe/Stockholm');

require('includes/_includes.php');

session_start();

$app = new App();

require('app/src/dependencies.php');
require('app/src/routes.php');

$app->run();