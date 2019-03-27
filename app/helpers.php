<?php

function base_path($path='')
{
    $base_dir = dirname(__FILE__, 2);

    return $path ? $base_dir . DIRECTORY_SEPARATOR . $path : $base_dir;
}

function lf()
{
    return "\r\n";
}