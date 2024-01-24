<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nilai Raport</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
        /* * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        } */

        table {
            width: 100%;
        }

        /* th,
        td {
            text-align: left;
        } */

        tr td,
        tr th {
            padding: 3px 10px !important;
            margin: 0 !important;
        }
    </style>
</head>

<body>
    <div style="text-align: center;">
        <h4>
            RAPOR AKHIR SEMESTER<br>
            SMK IN PEKALONGAN
        </h4>
    </div>

    <br>

    <table class="table table-borderless">
        <tr>
            <th>Nama Siswa</th>
            <td>: <?= $data[0]->nama ?></td>
            <td></td>
            <th>Kelas</th>
            <td>: <?= $data[0]->kelas ?></td>
        </tr>
        <tr>
            <th>Nomor Induk Siswa</th>
            <td>: <?= getNisByNama($data[0]->nama) !== null ? getNisByNama($data[0]->nama)[0]->nis : "undefined" ?></td>
            <td></td>
            <th>Semester</th>
            <td>: <?= $data[0]->semester ?> <?= $data[0]->semester == 1 ? '(Satu)' : '(Dua)' ?></td>
        </tr>
    </table>

    <br>

    <?php
        $nilai = json_decode($data[0]->nilai);
        // $kategori_nilai = array_keys($nilai);
    ?>

    <?php $i = 1 ?>
    <?php foreach ($nilai as $cat => $cat_val) : ?>
        <strong><?= $cat ?></strong><br>
        <table class="table table-bordered">
            <tr>
                <th>No.</th>
                <th>Mata Pelajaran</th>
                <th>KKM</th>
                <th>Nilai</th>
                <th>Grade</th>
            </tr>
            <tbody>
                <?php foreach ($cat_val as $k => $v) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $v->mapel ?></td>
                        <td><?= getKkmSetting($v->mapel)->has_kkm == 1 ? getKkmByMapel($v->mapel)->kkm : '-' ?></td>
                        <td><?= $v->nilai ?></td>
                        <td><?= getKkmSetting($v->mapel)->has_kkm == 1 ? generateGrade($v->nilai, $v->mapel) : "" ?></td>
                    </tr>
                <?php endforeach ?>
                <?php $i = 1; ?>
            </tbody>
        </table>
    <?php endforeach ?>

    <div style="text-align: right; font-weight: 700;">Pekalongan, <?= date('d F Y') ?></div>
    <table class="table table-borderless" style="padding:3px;">
        <tbody>
            <tr>
                <td style="padding:5px; text-align:center;">
                    Mengetahui<br>
                    Orang Tua atau wali
                    <br><br><br><br>
                    (..............................)
                </td>
                <td style="padding:5px; text-align:center;">
                    Wali Kelas
                    <br><br><br><br><br>
                    (..............................)
                </td>
                <td style="padding:5px; text-align:center;">
                    Kepala Sekolah
                    <br><br><br><br><br>
                    (..............................)
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>