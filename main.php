<?php

require_once __DIR__ .'/vendor/autoload.php';

// load: phpdotenv
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

// load: Greet
// $greet = new App\Playground\Sample\Greet();
// $greet->hello();

// run
// echo getenv('AWS_REGION');
// echo base_path('config/aws.php');

// Backup
$backup = new App\Playground\Files\Backup;
$backup->describeVault();