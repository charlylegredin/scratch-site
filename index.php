<?php

use SimPow\Core\SimPow;

require_once __DIR__ . '/Core/autoload.php';

$simPow = new SimPow();

try {
    $simPow->run();
} catch (\Exception $exception) {
    throw $exception;
}