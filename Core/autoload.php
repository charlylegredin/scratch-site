<?php

$autoload = __DIR__ . '/../vendor/autoload.php';
if (!is_file($autoload)) {
    throw new \Exception('Please install vendors.');
}

require_once $autoload;

spl_autoload_register('simPowAutoload');

function simPowAutoload($className)
{
    if (0 !== strpos($className, 'SimPow\\')) {
        return;
    }

    $filename = sprintf("%s/../%s.php", __DIR__, str_replace("\\", "/", substr($className, strlen('SimPow\\'))));

    if (is_file($filename)) {
        require_once($filename);
    }
}