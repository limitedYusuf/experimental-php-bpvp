<?php

function mbToBytes($mb)
{
   return $mb * 1024000;
}

function uploadGambar($file, $targetDir, $convertTo = null)
{
   $namaFile = uniqid() . "_" . basename($file["name"]);
   $targetFile = $targetDir . $namaFile;

   $jenisFile = mime_content_type($file["tmp_name"]);
   $allowedTypes = array("image/jpeg", "image/jpg", "image/png", "image/gif");

   if (!in_array($jenisFile, $allowedTypes)) {
      return "Hanya gambar JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
   }

   if ($file["size"] > mbToBytes(4)) {
      return "Ukuran gambar terlalu besar. Maksimum 2 MB.";
   }

   if (file_exists($targetFile)) {
      return "Maaf, file dengan nama tersebut sudah ada.";
   }

   if (move_uploaded_file($file["tmp_name"], $targetFile)) {
      if ($convertTo !== null) {
         if ($convertTo === "png") {
            $outputFile = $targetDir . uniqid() . ".png";
            if (!convertToPNG($targetFile, $outputFile)) {
               return "Gagal mengonversi gambar ke PNG.";
            }
         } elseif ($convertTo === "webp") {
            $outputFile = $targetDir . uniqid() . ".webp";
            if (!convertToWebP($targetFile, $outputFile)) {
               return "Gagal mengonversi gambar ke WebP.";
            }
         }

         unlink($targetFile);
         return "Gambar berhasil diunggah dan dikonversi.";
      } else {
         return "Gambar berhasil diunggah.";
      }
   } else {
      return "Terjadi kesalahan saat mengunggah gambar.";
   }
}

function convertToPNG($inputFile, $outputFile)
{
   $image = imagecreatefromstring(file_get_contents($inputFile));
   if ($image === false) {
      return false;
   }
   return imagepng($image, $outputFile);
}

function convertToWebP($inputFile, $outputFile)
{
   $image = imagecreatefromstring(file_get_contents($inputFile));
   if ($image === false) {
      return false;
   }
   return imagewebp($image, $outputFile);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["gambar"])) {
   $result = uploadGambar($_FILES["gambar"], "uploads/", $_POST["convertTo"]);
   echo $result;
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
   <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
      <label for="gambar">Pilih Gambar:</label>
      <input type="file" name="gambar" id="gambar" accept="image/*" required>
      <br>
      <label for="convertTo">Konversi ke:</label>
      <select name="convertTo" id="convertTo">
         <option value="">Tidak ada konversi</option>
         <option value="png">PNG</option>
         <option value="webp">WebP</option>
      </select>
      <br>
      <button type="submit" name="upload">Upload</button>
   </form>
</body>

</html>