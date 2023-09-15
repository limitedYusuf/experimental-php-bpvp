<?php
date_default_timezone_set('Asia/Singapore');

function konversiTanggal($tanggal)
{
   $bulanIndonesia = array(
      1 => 'Januari',
      2 => 'Februari',
      3 => 'Maret',
      4 => 'April',
      5 => 'Mei',
      6 => 'Juni',
      7 => 'Juli',
      8 => 'Agustus',
      9 => 'September',
      10 => 'Oktober',
      11 => 'November',
      12 => 'Desember'
   );

   $hariIndonesia = array(
      'Sunday' => 'Minggu',
      'Monday' => 'Senin',
      'Tuesday' => 'Selasa',
      'Wednesday' => 'Rabu',
      'Thursday' => 'Kamis',
      'Friday' => 'Jumat',
      'Saturday' => 'Sabtu'
   );

   $tanggalUnix = strtotime($tanggal);
   $hari = date('l', $tanggalUnix);
   $hariIndo = $hariIndonesia[$hari];
   $tanggal = date('d', $tanggalUnix);
   $bulan = date('n', $tanggalUnix);
   $tahun = date('Y', $tanggalUnix);

   $bulanIndo = $bulanIndonesia[$bulan];

   return "$hariIndo, $tanggal $bulanIndo $tahun";
}

$tanggalAwal = date('Y-m-d');
$tanggalHasil = konversiTanggal($tanggalAwal);
echo $tanggalHasil;

echo "<hr>";

function selisihWaktu($tanggal)
{
   $tanggalUnix = strtotime($tanggal);
   $selisihDetik = time() - $tanggalUnix;

   if ($selisihDetik < 60) {
      return $selisihDetik . " detik yang lalu";
   } elseif ($selisihDetik < 3600) {
      $menit = floor($selisihDetik / 60);
      return $menit . " menit yang lalu";
   } elseif ($selisihDetik < 86400) {
      $jam = floor($selisihDetik / 3600);
      return $jam . " jam yang lalu";
   } elseif ($selisihDetik < 604800) {
      $hari = floor($selisihDetik / 86400);
      if ($hari == 1) {
         return "Kemarin";
      } else {
         return $hari . " hari yang lalu";
      }
   } elseif ($selisihDetik < 2419200) {
      $minggu = floor($selisihDetik / 604800);
      return $minggu . " minggu yang lalu";
   } else {
      $tahun = date("Y") - date("Y", $tanggalUnix);
      return $tahun . " tahun yang lalu";
   }
}

$tanggalAwal = date('Y-m-d H:i');
$hasilSelisih = selisihWaktu($tanggalAwal);
echo $hasilSelisih;

?>