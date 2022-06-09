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
                            <form action="<?= base_url('absen/buat') ?>" method="POST">
                                <div class="form-group">
                                    <label>Guru</label>
                                    <select name="id_guru" id="id_guru" class="form-control select2">
                                        <option value="">Pilih Guru</option>
                                        <?php foreach ($guru as $gur) : ?>
                                            <option <?= set_value('id_guru') == $gur['idnya_guru'] ? 'selected' : '' ?> value="<?= $gur['idnya_guru'] ?>"><?= $gur['nip'] ?> - <?= $gur['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('id_guru', '<div class="text-danger text-small">', '</div>') ?>
                                </div>

                                <div class="form-row mb-2 tambahan-gaji">
                                    <div class="form-group col">
                                        <label>Bulan</label>
                                        <input type="month" class="form-control" value="<?= set_value('bulan', date('Y-m')) ?>" name="bulan">
                                        <?= form_error('bulan', '<div class="text-danger text-small">', '</div>') ?>
                                    </div>
                                </div>

                                <div class="container-tambahan-gaji">
                                    <div class="form-row mb-2 tambahan-gaji">
                                        <div class="form-group col">
                                            <label for="hadir">Hadir</label>
                                            <input min="0" type="number" class="form-control" name="hadir" id="hadir" value="<?= set_value('hadir') ?>">
                                            <?= form_error('hadir', '<div class="text-danger text-small">', '</div>') ?>
                                        </div>
                                        <div class="form-group col">
                                            <label for="izin">Izin</label>
                                            <input min="0" type="number" class="form-control" name="izin" id="izin" value="<?= set_value('izin') ?>">
                                            <?= form_error('izin', '<div class="text-danger text-small">', '</div>') ?>
                                        </div>
                                        <div class="form-group col">
                                            <label for="sakit">Sakit</label>
                                            <input min="0" type="number" class="form-control" name="sakit" id="sakit" value="<?= set_value('sakit') ?>">
                                            <?= form_error('sakit', '<div class="text-danger text-small">', '</div>') ?>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary float-right mx-3">Create</button>
                                <a href="<?= base_url('absen') ?>" class="btn btn-primary mb-5 float-right">&laquo; Back to Absen</a>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
</div>