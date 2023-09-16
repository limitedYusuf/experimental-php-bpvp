<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Tahun</title>
    <style>
        * {
            box-sizing: border-box;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
            table-layout: auto;
            white-space: nowrap;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 8px;
            white-space: nowrap;
        }

        h2 {
            text-align: center;
        }

        .table-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .table-wrapper {
            width: auto;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php
    $selectedYear = date('Y');

    $bulan = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    echo '<div class="table-container">';
    for ($i = 0; $i < 12; $i++) {
        $currentMonth = $i + 1;
        $currentMonthName = $bulan[$i];
    ?>
        <div class="table-wrapper">
            <h2><?= $currentMonthName . ' ' . $selectedYear ?></h2>
            <table class="table">
                <tr>
                    <th>Minggu</th>
                    <th>Senin</th>
                    <th>Selasa</th>
                    <th>Rabu</th>
                    <th>Kamis</th>
                    <th>Jumat</th>
                    <th>Sabtu</th>
                </tr>
                <?php
                $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $selectedYear);
                $tanggalPertama = strtotime("$selectedYear-$currentMonth-01");
                $hariPertama = date('w', $tanggalPertama);
                $jumlahSelSebelum = $hariPertama;

                for ($j = 1; $j <= ceil(($jumlahHari + $jumlahSelSebelum) / 7); $j++) {
                    echo "<tr>";
                    for ($k = 0; $k < 7; $k++) {
                        $tanggal = ($j - 1) * 7 + ($k + 1) - $jumlahSelSebelum;
                        if ($tanggal >= 1 && $tanggal <= $jumlahHari) {
                            echo "<td>$tanggal</td>";
                        } else {
                            echo "<td></td>";
                        }
                    }
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    <?php
    }
    echo '</div>';
    ?>
</body>

</html>