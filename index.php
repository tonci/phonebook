<?php
require 'vendor/autoload.php';
require 'lib/App.php';
$config = require('config/main.php');

$app = new lib\App($config);
$app->run();