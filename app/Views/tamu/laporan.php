<!DOCTYPE html>
<html lang="en">
<style>
    th {
        text-align: center;
        padding: 5px;
        vertical-align: middle;
    }

    td {
        vertical-align: middle;
        padding: 5px;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
</head>

<body>
    <table style="width: 100%;">
        <tr>
            <td style="width: 20%;">
                <img src="<?= $_SERVER['DOCUMENT_ROOT'] ?>/img/iconcamat.png" style="width: 100; height:100;">
            </td>
            <td style="width: 70%; text-align:center;">
                <h1>KANTOR KECAMATAN MENGWI</h1>
            </td>
        </tr>
    </table>
    <hr style="border-top:1px">
    <div style="text-align: center;">
        <h3>Laporan Buku Tamu</h3>
    </div>

    <h5 style="text-align: end;">Tanggal: <?= $tgl_laporan; ?></h5>
    <div>
        <table border="1" style="width: 100%; border-collapse:collapse">
            <thead>
                <tr>
                    <th style="width:5%">No.</th>
                    <th style="width:23%">Nama</th>
                    <th style="width:22%">Alamat</th>
                    <th style="width:17%">Instansi</th>
                    <th style="width:21%">Keperluan</th>
                    <th style="width:12%;">Tanggal Kunjungan</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($laporan as $lp) : ?>
                    <tr>
                        <td style="width:5%; text-align:center;"><?= $i; ?>.</td>
                        <td style="width:23%"><?= $lp["nama_lengkap"]; ?></td>
                        <td style="width:22%"><?= $lp["alamat"]; ?></td>
                        <td style="width:17%"><?= $lp["instansi"]; ?></td>
                        <td style="width:21%"><?= $lp["keperluan"]; ?></td>
                        <td style="width:12%"><?= $lp["tanggal_kunjungan"]; ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>