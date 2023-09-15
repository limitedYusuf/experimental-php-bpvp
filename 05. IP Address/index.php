<?php

function getBrowser() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $browser = "Unknown";

    if (preg_match('/MSIE/i', $userAgent) && !preg_match('/Opera/i', $userAgent)) {
        $browser = 'Internet Explorer';
    } elseif (preg_match('/Firefox/i', $userAgent)) {
        $browser = 'Mozilla Firefox';
    } elseif (preg_match('/Chrome/i', $userAgent)) {
        $browser = 'Google Chrome';
    } elseif (preg_match('/Safari/i', $userAgent)) {
        $browser = 'Apple Safari';
    } elseif (preg_match('/Opera/i', $userAgent)) {
        $browser = 'Opera';
    } elseif (preg_match('/Netscape/i', $userAgent)) {
        $browser = 'Netscape';
    }

    return $browser;
}

function getIPAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

function getDeviceType() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    if (preg_match('/mobile/i', $userAgent)) {
        return 'Mobile';
    } else {
        return 'Desktop';
    }
}

function getOS()
{
   $userAgent = $_SERVER['HTTP_USER_AGENT'];
   $os = "Unknown";

   if (preg_match('/windows|win32/i', $userAgent)) {
      $os = 'Windows';
   } elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
      $os = 'Mac OS';
   } elseif (preg_match('/android/i', $userAgent)) {
      $os = 'Android';
   } elseif (preg_match('/iphone|ipod|ipad/i', $userAgent)) {
      $os = 'iOS';
   } elseif (preg_match('/linux/i', $userAgent)) {
      $os = 'Linux';
   }

   return $os;
}

$browser = getBrowser();
$ipAddress = getIPAddress();
$deviceType = getDeviceType();
$os = getOS();

echo "Browser: " . $browser . "<br>";
echo "IP Address: " . $ipAddress . "<br>";
echo "Device Type: " . $deviceType . "<br>";
echo "OS: " . $os;

?>