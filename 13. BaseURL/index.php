<?php
function base_url()
{
   $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
   $host = $_SERVER['HTTP_HOST'];
   $projectRoot = dirname($_SERVER['SCRIPT_NAME']);
   $baseUrl = $protocol . '://' . $host . $projectRoot;

   return $baseUrl . '/';
}

echo base_url();
