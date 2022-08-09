<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: calibri;
        }
    </style>
</head>

<body onload="window.print()">
    <h2 align="center">Laporan Pembayaran Petugas</h2>
    <table border="1" style="border-collapse: collapse;" width="100%" cellpadding="5" cellspacing="5">
        <tr>
            <th>No.</th>
            <th>Nama Lengkap</th>
            <th>Tanggal</th>
            <th>Nominal</th>
        </tr>
        <?php
        $no = 1;
        $total = 0;
        foreach ($rows as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row->nama_lengkap; ?></td>
                <td><?= $row->tanggal; ?></td>
                <td>Rp.<?= number_format($row->nominal, 0, ',', '.'); ?></td>
            </tr>
        <?php
            $total += $row->nominal;
        endforeach; ?>
        <tr>
            <th colspan="3" align="left">Total Pembayaran</th>
            <th align="left">Rp.<?= number_format($total, 0, ',', '.'); ?></th>
        </tr>
    </table>

</body>

</html>