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
                <div class="col-8">
                    <div class="card card-primary">
                        <div class="card-body">
                            <form id="form-gaji" action="<?= base_url('gaji/buat') ?>" method="POST" class="needs-validation" novalidate="">
                                <input type="hidden" id="id_gaji" name="id_gaji" value="<?= $gajiHeader['id'] ?>">
                                <input type="hidden" id="number_form" name="number_form" value="<?= getNumberFormGajiDetail($gajiDetail) ?>">
                                <div class="form-group">
                                    <label>Guru</label>
                                    <select name="id_guru" id="id_guru" class="form-control select2" required >
                                        <option value="">Pilih Guru</option>
                                        <?php foreach ($guru as $gur) : ?>
                                            <option <?= $gajiHeader['id_guru'] == $gur['idnya_guru'] ? 'selected'  : '' ?> value="<?= $gur['idnya_guru'] ?>"><?= $gur['nip'] ?> - <?= $gur['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('nama_jabatan', '<div class="text-danger text-small">', '</div>') ?>
                                </div>

                                <div class="form-row mb-2 tambahan-gaji">
                                    <div class="form-group col">
                                        <label>Bulan </label>
                                        <input type="month" class="form-control" value="<?= getTahunDanBulan($gajiHeader['tahun'], $gajiHeader['bulan']) ?>" name="bulan" required>
                                    </div>

                                    <div class="form-group col">
                                        <label for="gaji_pokok">Gaji Pokok</label>
                                        <input type="text" id="gaji_pokok" class="form-control currency" name="gaji_pokok" value="<?= $gajiDetail[0]['nominal'] ?>" required>
                                        <?= form_error('gaji_pokok', '<div class="text-danger text-small">', '</div>') ?>
                                    </div>
                                </div>

                                <div class="container-tambahan-gaji">
                                    <div class="form-row mb-2 tambahan-gaji">
                                        <div class="form-group col">
                                            <label for="deskripsi_jam_tambahan">Deskripsi</label>
                                            <input type="text" class="form-control" value="Tambahan jam mengajar" name="deskripsi_jam_tambahan" id="deskripsi_jam_tambahan" required>
                                        </div>
                                        <div class="form-group col-2">
                                            <label for="jam" for="tahun">Jam mengajar</label>
                                            <input id="jam" type="number" class="form-control" name="jam" value="<?= getJamMengajar($gajiDetail[1]['deskripsi']) ?>" required>
                                        </div>
                                        <div class="form-group col">
                                            <label for="nominal_jam_tambahan">Nominal</label>
                                            <input type="text" class="form-control currency gaji-mengajar" id="nominal_jam_tambahan" name="nominal_jam_tambahan" value="<?= $gajiDetail[1]['nominal'] ?>" required>
                                        </div>
                                    </div>

                                    <?php $number =  getNumberFormGajiDetail($gajiDetail);
                                    foreach ($gajiDetail as $index => $gDetail) : ?>
                                        <?php if ($index != 0 && $index != 1) : ?>
                                            <div class="form-row mb-2 tambahan-gaji row_<?= $number; ?>" id="form_<?= $number ?>">
                                                <div class="form-group col">
                                                    <input type="text" class="form-control" placeholder="Deskripsi" name="deskripsi[]" value="<?= $gDetail['deskripsi'] ?>" required>
                                                </div>
                                                <div class="form-group col">
                                                    <input type="text" class="form-control currency gaji-mengajar" placeholder="Nominal" name="nominal[]" value="<?= $gDetail['nominal'] ?>" required>
                                                </div>
                                                <div class="form-group col-1">
                                                    <button id=<?= $number ?> type="button" class="btn btn-primary btn-hapus-gaji">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <?php $number++ ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                </div>



                                <div class="text-center mb-5">
                                    <button type="button" class="btn btn-primary btn-tambah-gaji">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>

                                <button type="submit" class="btn btn-primary float-right mx-3" id="button-update">Update</button>
                                <a href="<?= base_url('gaji') ?>" class="btn btn-primary mb-5 float-right">&laquo; Back to Gaji</a>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
</div>