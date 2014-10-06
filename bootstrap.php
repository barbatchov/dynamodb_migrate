<?php

defined('ROOT_DIR') || define('ROOT_DIR', __DIR__);

/* @var $loader \Composer\Autoload\ClassLoader */
$loader = require ROOT_DIR . '/vendor/autoload.php';
$loader->add('Dynamo', ROOT_DIR . '/tests/');
$loader->add('Dynamo', ROOT_DIR . '/src/');