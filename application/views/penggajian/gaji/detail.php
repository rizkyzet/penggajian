<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>
                <?= urlToTitle(); ?>
            </h1>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-sm-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <a class="btn btn-primary float-right btn-sm" href="">Cetak Slip Gaji</a>
                            <table class="table table-sm col-lg-6 col-md-7 col-sm-12">
                                <tr>
                                    <th>NIP</th>
                                    <th>:</th>
                                    <th><?= $guru['nip'] ?></th>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <th>:</th>
                                    <th><?= $guru['nama'] ?></th>
                                </tr>
                                <tr>
                                    <th>Jabatan</th>
                                    <th>:</th>
                                    <th><?= $guru['nama_jabatan'] ?></th>
                                </tr>
                                <tr>
                                    <th>Periode</th>
                                    <th>:</th>
                                    <th><?= $gajiHeader['bulan'] . '-' . $gajiHeader['tahun'] ?></th>
                                </tr>
                            </table>
                            <hr>
                            <table class="table table-striped table-sm table-bordered">
                                <tr class="text-white bg-primary">
                                    <th>Deskripsi</th>
                                    <th>Nominal</th>
                                </tr>
                                <?php foreach ($gajiDetail as $index => $gDetail) : ?>
                                    <tr>
                                        <td><?= $index == 1 ? $gDetail['deskripsi'] . ' jam' : $gDetail['deskripsi'] ?></td>
                                        <td><?= rupiah($gDetail['nominal']) ?></td>
                                    </tr>
                                <?php endforeach; ?>

                                <tr class="bg-primary text-white">
                                    <th class="text-left">Total Gaji : </th>
                                    <th class="text-left"><?= rupiah($gajiHeader['total_gaji']) ?></th>
                                </tr>
                            </table>
                            <hr>
                         
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
</div>