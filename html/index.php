<?php

use Core\Application;

include('../vendor/autoload.php');
include('../src/config.php');

$application = new Application();
$application->run();