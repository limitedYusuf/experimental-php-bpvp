<?php
error_reporting(E_ERROR | E_PARSE);

ini_set('display_errors', 1);
ini_set('log_errors', 1);
$logFilePath = __DIR__ . '/error.log';
ini_set('error_log', $logFilePath);

function customErrorHandler($errno, $errstr, $errfile, $errline)
{
   $timestamp = date('Y-m-d H:i:s');
   $errorMessage = "[$timestamp] [$errno] $errstr in $errfile on line $errline" . PHP_EOL;
   error_log($errorMessage, 3, $GLOBALS['logFilePath']);

   if (ini_get('display_errors')) {
      echo "Terjadi kesalahan.";
   }
}

set_error_handler("customErrorHandler");

// contoh
$undefinedVariable = $undefinedVariable + 1;
