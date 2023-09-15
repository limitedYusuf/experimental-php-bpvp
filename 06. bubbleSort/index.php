<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bpvp";

$conn = new mysqli($servername, $username, $password, $dbname);

// CARA 1
function bubbleSort($conn, $order = 'ASC') {
    $sql = "SELECT * FROM nilai_siswa";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_all(MYSQLI_ASSOC);

        $n = count($data);
        for ($i = 0; $i < $n-1; $i++) {
            for ($j = 0; $j < $n-$i-1; $j++) {
                if ($order === 'ASC' ? $data[$j]['nilai'] > $data[$j+1]['nilai'] : $data[$j]['nilai'] < $data[$j+1]['nilai']) {
                    $temp = $data[$j];
                    $data[$j] = $data[$j+1];
                    $data[$j+1] = $temp;
                }
            }
        }

        return $data;
    } else {
        return [];
    }
}

$sortedData = bubbleSort($conn, 'ASC');

foreach ($sortedData as $row) {
    echo "Nama: " . $row['nama'] . ", Nilai: " . $row['nilai'] . "<br>";
}

$conn->close();

// CARA 2
function bubbleSort2($array, $ascending = true)
{
   $n = count($array);

   for ($i = 0; $i < $n - 1; $i++) {
      for ($j = 0; $j < $n - $i - 1; $j++) {
         if (($ascending && $array[$j] > $array[$j + 1]) || (!$ascending && $array[$j] < $array[$j + 1])) {
            $temp = $array[$j];
            $array[$j] = $array[$j + 1];
            $array[$j + 1] = $temp;
         }
      }
   }

   return $array;
}

// Contoh penggunaan
$nilaiSiswa = [75, 90, 60, 85, 95];
$nilaiTerurut = bubbleSort2($nilaiSiswa);
print_r($nilaiTerurut);

$nilaiTerurutTerbalik = bubbleSort2($nilaiSiswa, false);
print_r($nilaiTerurutTerbalik);