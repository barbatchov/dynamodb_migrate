<?php
/* @var $loader \Composer\Autoload\ClassLoader */
$loader = require __DIR__ . '/vendor/autoload.php';
$loader->add('Dynamo', __DIR__ . '/tests/');
$loader->add('Dynamo', __DIR__ . '/src/');