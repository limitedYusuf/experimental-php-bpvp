<?php
session_start();

function generateCsrfToken()
{
   $token = bin2hex(random_bytes(32));
   $_SESSION['csrf_token'] = $token;
   return $token;
}

function verifyCsrfToken($token)
{
   return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   if (!verifyCsrfToken($_POST['csrf_token'])) {
      die("Token CSRF tidak valid");
   } else {
      echo "checked";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
      <input type="text" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
      <button type="submit" name="upload">Upload</button>
   </form>
</body>

</html>