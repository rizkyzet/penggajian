<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Users</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/css-reset.css') ?>">

    <style>
        table {
            /* page-break-inside: avoid; */
            /* page-break-before: always; */
            page-break-inside: avoid;
        }

        .users-table th {
            text-align: left;
        }

       .users-table table,
       .users-table tr,
       .users-table th,
       .users-table td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .users-table td {
            padding: 10px;
        }
        .users-table th {
            padding: 5px;
        }
    </style>
</head>

<body>

    <?php $this->load->view('penggajian/laporan/_partials/kop') ?>
    <h1 style="text-align: center ;margin-bottom:20px;">Laporan Daftar Guru</h1>
    <table class="users-table" style="width: 100% ;">
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Jabatan</th>
            <th>No. HP</th>
            <th>Jenis Kelamin</th>
        </tr>
        <?php $i = 1;
        foreach ($guru as $g) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $g['nip'] ?></td>
                <td><?= $g['nama'] ?></td>
                <td><?= $g['alamat'] ?></td>
                <td><?= $g['nama_jabatan'] ?></td>
                <td><?= $g['no_hp'] ?></td>
                <td><?= jenisKelamin($g['jk']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>