<?php
$logFilePath = __DIR__ . '/error.log';
$errorLogContents = file_get_contents($logFilePath);
$errorLogEntries = explode(PHP_EOL, $errorLogContents);

rsort($errorLogEntries);

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Error Log Viewer</title>
   <style>
      table {
         border-collapse: collapse;
         width: 100%;
      }

      th,
      td {
         border: 1px solid #ccc;
         padding: 8px;
         text-align: left;
      }
   </style>
</head>

<body>
   <h1>Error Log Viewer</h1>
   <table>
      <thead>
         <tr>
            <th>Timestamp</th>
            <th>Error Code</th>
            <th>Error Message</th>
            <th>File</th>
            <th>Line</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($errorLogEntries as $entry) : ?>
            <?php if (!empty($entry)) : ?>
               <?php
               $pattern = '/^\[(.*?)\] \[(\d+)\] (.*) in (.*) on line (\d+)$/';
               if (preg_match($pattern, $entry, $matches)) {
                  list(, $timestamp, $errorCode, $errorMessage, $file, $line) = $matches;
               } else {
                  continue;
               }
               ?>
               <tr>
                  <td><?= $timestamp ?></td>
                  <td><?= $errorCode ?></td>
                  <td><?= $errorMessage ?></td>
                  <td><?= $file ?></td>
                  <td><?= $line ?></td>
               </tr>
            <?php endif; ?>
         <?php endforeach; ?>
      </tbody>
   </table>
</body>

</html>