<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/css-reset.css') ?>">

    <style>
        .biodata-table th {
            text-align: left;
            padding-right: 30px;
            padding-bottom: 5px;
        }

        .deskripsi-gaji {
            width: 100%;

        }


        .deskripsi-gaji td {
            vertical-align: bottom;
            padding: 8px 0px;
        }

        table {
            /* page-break-inside: avoid; */
            /* page-break-before: always; */
            page-break-inside: avoid;
        }
    </style>
</head>

<body>



    <?php if ($tipeCetak == 'satu') : ?>
        <?php $this->load->view('penggajian/laporan/_partials/kop') ?>
        <table class="biodata-table" style="margin-bottom:30px ;">
            <tr>
                <th>NIP</th>
                <td>: <?= $guru['nip'] ?></td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>: <?= $guru['nama'] ?></td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td>: <?= $guru['nama_jabatan']; ?></td>
            </tr>
            <tr>
                <th>Periode</th>
                <td>: <?= bulan($gajiHeader['bulan']) ?>, <?= $gajiHeader['tahun'] ?></td>
            </tr>
        </table>

        <!-- <h1 style="font-size:16px ; margin-bottom:10px;">Deskripsi</h1> -->
        <table class="deskripsi-gaji">
            <tr style="border-top:1px solid black;border-bottom:1px solid black;">
                <th style="text-align:left ;padding:10px 0px;width:80%;">Deskripsi</th>
                <th style="text-align:right;padding:10px 0px;">Jumlah</th>
            </tr>

            <?php foreach ($gajiDetail as $index => $gDetail) : ?>
                <?php if ($index == 1 && getJamMengajar($gDetail['deskripsi']) == 0) : ?>

                <?php else : ?>
                    <tr>
                        <td><?= $index == 1 ? str_replace('-', ' ', $gDetail['deskripsi']) . ' jam ' : $gDetail['deskripsi'] ?></td>
                        <td style="text-align: right;"><?= rupiah($gDetail['nominal']) ?></td>
                    </tr>

                <?php endif; ?>
            <?php endforeach; ?>

            <tr style="border-top:1px solid black;border-bottom:1px solid black;">
                <th style="text-align:left ;padding:10px 0px;">Total Gaji </th>
                <td style="text-align: right;padding:10px 0px;"><?= rupiah($gajiHeader['total_gaji']) ?></td>
            </tr>
        </table>

        <table style="margin-top:50px;text-align: center;margin-left:auto;">
            <tr>
                <td>Penerima</td>
            </tr>
            <tr>
                <td>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <td style="padding-bottom:3px"><?= $guru['nama'] ?></td>
            </tr>
            <tr>
                <td style="padding-top:3px;">NIP: <?= $guru['nip'] ?></td>
            </tr>
        </table>
    <?php else : ?>
        <?php foreach ($gajiHeader as $gHeader) : ?>
            <?php $this->load->view('penggajian/laporan/_partials/kop') ?>
            <?php $guru = $this->Guru_model->getOneGuruWhere(['guru.id' => $gHeader['id_guru']]) ?>
            <table class="biodata-table" style="margin-bottom:30px ;">
                <tr>
                    <th>NIP</th>
                    <td>: <?= $guru['nip'] ?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>: <?= $guru['nama'] ?></td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td>: <?= $guru['nama_jabatan']; ?></td>
                </tr>
                <tr>
                    <th>Periode</th>
                    <td>: <?= bulan( $gHeader['bulan']) ?>, <?= $gHeader['tahun'] ?></td>
                </tr>
            </table>


            <table class="deskripsi-gaji">
                <tr style="border-top:1px solid black;border-bottom:1px solid black;">
                    <th style="text-align:left ;padding:10px 0px;width:80%;">Deskripsi</th>
                    <th style="text-align:right;padding:10px 0px;">Jumlah</th>
                </tr>

                <?php $gajiDetail = $this->Gaji_model->getAllGajiDetail($gHeader['id']); ?>
                <?php foreach ($gajiDetail as $index => $gDetail) : ?>
                    <?php if ($index == 1 && getJamMengajar($gDetail['deskripsi']) == 0) : ?>

                    <?php else : ?>
                        <tr>
                            <td><?= $index == 1 ? str_replace('-', ' ', $gDetail['deskripsi']) . ' jam ' : $gDetail['deskripsi'] ?></td>
                            <td style="text-align: right;"><?= rupiah($gDetail['nominal']) ?></td>
                        </tr>

                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="border-top:1px solid black;border-bottom:1px solid black;">
                    <th style="text-align:left ;padding:10px 0px;">Total Gaji </th>
                    <td style="text-align: right;padding:10px 0px;"><?= rupiah($gHeader['total_gaji']) ?></td>
                </tr>
            </table>

            <table style="margin-top:50px;text-align: center;margin-left:auto;">
                <tr>
                    <td>Penerima</td>
                </tr>
                <tr>
                    <td>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <td style="padding-bottom:3px"><?= $guru['nama'] ?></td>
                </tr>
                <tr>
                    <td style="padding-top:3px;">NIP: <?= $guru['nip'] ?></td>
                </tr>
            </table>
            <pagebreak />
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>