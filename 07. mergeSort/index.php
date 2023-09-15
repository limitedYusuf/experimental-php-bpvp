<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bpvp";

$conn = new mysqli($servername, $username, $password, $dbname);

// CARA 1
function mergeSort($conn, $order = 'ASC')
{
   $sql = "SELECT * FROM nilai_siswa";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
      $data = $result->fetch_all(MYSQLI_ASSOC);

      mergeSortHelper($data, 0, count($data) - 1, $order);

      return $data;
   } else {
      return [];
   }
}

function merge($data, $left, $mid, $right, $order)
{
   $n1 = $mid - $left + 1;
   $n2 = $right - $mid;

   $leftArray = [];
   $rightArray = [];

   for ($i = 0; $i < $n1; $i++) {
      $leftArray[$i] = $data[$left + $i];
   }
   for ($i = 0; $i < $n2; $i++) {
      $rightArray[$i] = $data[$mid + 1 + $i];
   }

   $i = 0;
   $j = 0;
   $k = $left;

   while ($i < $n1 && $j < $n2) {
      if (($order === 'ASC' && $leftArray[$i]['nilai'] <= $rightArray[$j]['nilai']) || ($order === 'DESC' && $leftArray[$i]['nilai'] >= $rightArray[$j]['nilai'])) {
         $data[$k] = $leftArray[$i];
         $i++;
      } else {
         $data[$k] = $rightArray[$j];
         $j++;
      }
      $k++;
   }

   while ($i < $n1) {
      $data[$k] = $leftArray[$i];
      $i++;
      $k++;
   }

   while ($j < $n2) {
      $data[$k] = $rightArray[$j];
      $j++;
      $k++;
   }
}

function mergeSortHelper(&$data, $left, $right, $order)
{
   if ($left < $right) {
      $mid = floor(($left + $right) / 2);

      mergeSortHelper($data, $left, $mid, $order);
      mergeSortHelper($data, $mid + 1, $right, $order);

      merge($data, $left, $mid, $right, $order);
   }
}

$sortedData = mergeSort($conn, 'ASC');

foreach ($sortedData as $row) {
   echo "Nama: " . $row['nama'] . ", Nilai: " . $row['nilai'] . "<br>";
}

$conn->close();

// CARA 2
function mergeSort2($array, $ascending = true)
{
   $n = count($array);

   if ($n <= 1) {
      return $array;
   }

   $mid = floor($n / 2);
   $left = array_slice($array, 0, $mid);
   $right = array_slice($array, $mid);

   $left = mergeSort2($left, $ascending);
   $right = mergeSort2($right, $ascending);

   return merge2($left, $right, $ascending);
}

function merge2($left, $right, $ascending)
{
   $result = [];
   $i = 0;
   $j = 0;

   while ($i < count($left) && $j < count($right)) {
      if (($ascending && $left[$i] <= $right[$j]) || (!$ascending && $left[$i] >= $right[$j])) {
         $result[] = $left[$i];
         $i++;
      } else {
         $result[] = $right[$j];
         $j++;
      }
   }

   while ($i < count($left)) {
      $result[] = $left[$i];
      $i++;
   }

   while ($j < count($right)) {
      $result[] = $right[$j];
      $j++;
   }

   return $result;
}

$nilaiSiswa = [75, 90, 60, 85, 95];
$nilaiTerurut = mergeSort2($nilaiSiswa);
print_r($nilaiTerurut);

$nilaiTerurutTerbalik = mergeSort2($nilaiSiswa, false);
print_r($nilaiTerurutTerbalik);

?>