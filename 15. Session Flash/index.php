<?php
session_start();

function addFlashMessage($type, $message)
{
   if (!isset($_SESSION['flash_messages'])) {
      $_SESSION['flash_messages'] = [];
   }

   $_SESSION['flash_messages'][] = [
      'type' => $type,
      'message' => $message
   ];
}

function getFlashMessages()
{
   if (isset($_SESSION['flash_messages'])) {
      $messages = $_SESSION['flash_messages'];
      unset($_SESSION['flash_messages']);
      return $messages;
   }
   return [];
}

addFlashMessage('success', 'Operasi berhasil!');
addFlashMessage('error', 'Terjadi kesalahan.');
addFlashMessage('warning', 'Peringatan: Data akan dihapus.');

$flashMessages = getFlashMessages();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Demo</title>
</head>

<body>
   <div>
      <?php foreach ($flashMessages as $message) : ?>
         <div class="flash-message <?= $message['type'] ?>">
            <?= $message['message'] ?>
         </div>
      <?php endforeach; ?>
   </div>
</body>

</html>