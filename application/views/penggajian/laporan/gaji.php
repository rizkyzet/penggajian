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
                <div class="col-4">
                    <div class="card card-primary shadow">
                        <div class="card-body">
                            <?= $this->session->flashdata('pesan') ?>
                            <form action="<?= base_url('laporan/cetak_gaji') ?>" method="POST" target="_blank">
                                <div class="form-group">
                                    <select class="form-control" name="jabatan" id="jabatan">
                                        <option value="">Pilih Jabatan</option>
                                        <?php foreach ($jabatan as $j) : ?>
                                            <option value="<?= $j['id'] ?>"><?= ucfirst($j['nama_jabatan']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="bulan" id="bulan" class="form-control">
                                        <option value="">Pilih Bulan</option>
                                        <?php for ($bulan = 1; $bulan <= 12; $bulan++) : ?>
                                            <option value="<?= $bulan ?>"><?= bulan($bulan) ?></option>
                                        <?php endfor ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="tahun" id="tahun" class="form-control">
                                        <option value="">Pilih Tahun</option>
                                        <?php for ($tahun = 2015; $tahun <= date('Y'); $tahun++) : ?>
                                            <option value="<?= $tahun ?>"><?= $tahun ?></option>
                                        <?php endfor ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Cetak</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>