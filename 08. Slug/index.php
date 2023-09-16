<?php
function generateSlug($text)
{
   $text = preg_replace('/[^a-zA-Z0-9]+/', ' ', $text);
   $text = trim($text);
   $text = str_replace(' ', '-', $text);
   $text = strtolower($text);

   return $text;
}

$text = "TimeLapse Octopus";
$slug = generateSlug($text);
echo $slug;

?>