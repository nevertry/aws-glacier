<?php

require_once __DIR__ .'/vendor/autoload.php';

use App\Playground\Sample\Greet;

$greet = new Greet();

$greet->hello();

echo rootdir();
