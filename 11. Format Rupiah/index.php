<?php
function formatUang($angka)
{
   return number_format($angka, 0, ',', '.');
}

$angka = 20000;
$uangRupiah = formatUang($angka);
echo $uangRupiah;

echo "<hr>";

function terbilangUang($rp)
{
   $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];

   if ($rp < 12) {
      return " " . $angka[$rp];
   } elseif ($rp < 20) {
      return terbilangUang($rp - 10) . " belas";
   } elseif ($rp < 100) {
      $puluh = (int)($rp / 10);
      $sisa = $rp % 10;
      return $angka[$puluh] . " puluh " . terbilangUang($sisa);
   } elseif ($rp < 200) {
      return "seratus " . terbilangUang($rp - 100);
   } elseif ($rp < 1000) {
      $ratus = (int)($rp / 100);
      $sisa = $rp % 100;
      return $angka[$ratus] . " ratus " . terbilangUang($sisa);
   } elseif ($rp < 2000) {
      return "seribu " . terbilangUang($rp - 1000);
   } elseif ($rp < 1000000) {
      $ribu = (int)($rp / 1000);
      $sisa = $rp % 1000;
      return terbilangUang($ribu) . " ribu " . terbilangUang($sisa);
   } elseif ($rp < 1000000000) {
      $juta = (int)($rp / 1000000);
      $sisa = $rp % 1000000;
      return terbilangUang($juta) . " juta " . terbilangUang($sisa);
   }
}

$angka = 654000;
$terbilang = strtoupper(trim(terbilangUang($angka))) . " RUPIAH";
echo $terbilang;

?>