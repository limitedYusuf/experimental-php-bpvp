<?php
function generateUUID()
{
   $data = openssl_random_pseudo_bytes(16);
   $data[6] = chr(ord($data[6]) & 0x0F | 0x40);
   $data[8] = chr(ord($data[8]) & 0x3F | 0x80);

   $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));

   return $uuid;
}

$uuid = generateUUID();
echo $uuid;

?>