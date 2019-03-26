<?php

require_once __DIR__ .'/vendor/autoload.php';

// load: phpdotenv
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

// load: Greet
$greet = new App\Playground\Sample\Greet();
$greet->hello();

// run
echo rootdir();
echo getenv('AWS_REGION');