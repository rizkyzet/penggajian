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
                <div class="col-6">
                    <div class="card card-primary">
                        <div class="card-body">
                            <form action="<?= base_url('admin/guru/tambah') ?>" method="POST">
                                <div class="form-group">
                                    <label>NIP</label>
                                    <input type="text" class="form-control" name="nip" value="<?= set_value('nip') ?>">
                                    <?= form_error('nip', '<div class="text-danger text-small">', '</div>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" value="<?= set_value('nama') ?>">
                                    <?= form_error('nama', '<div class="text-danger text-small">', '</div>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat" id="alamat" cols="40" rows="40"><?= set_value('alamat') ?></textarea>
                                    <?= form_error('alamat', '<div class="text-danger text-small">', '</div>') ?>
                                </div>

                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" class="form-control" name="no_hp" value="<?= set_value('no_hp') ?>">
                                    <?= form_error('no_hp', '<div class="text-danger text-small">', '</div>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <select name="jabatan" id="jabatan" class="form-control col-4">
                                        <option value="">Pilih Jabatan</option>
                                        <?php foreach ($jabatan as $j) : ?>
                                            <option <?= set_value('jabatan') == $j['id'] ? 'selected' : '' ?> value="<?= $j['id'] ?>"> <?= $j['nama_jabatan'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('jabatan', '<div class="text-danger text-small">', '</div>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jk" id="jk" class="form-control col-6">
                                        <option value="">Pilih jenis kelamin</option>
                                        <option <?= set_value('jk') == 'L' ? 'selected' : '' ?> value="L">Laki-laki</option>
                                        <option <?= set_value('jk') == 'P' ? 'selected' : '' ?> value="P">Perempuan</option>
                                    </select>
                                    <?= form_error('jk', '<div class="text-danger text-small">', '</div>') ?>
                                </div>

                                <button type="submit" class="btn btn-primary float-right mx-3">Save</button>
                                <a href="<?= base_url('admin/guru') ?>" class="btn btn-primary mb-5 float-right">&laquo; Back to Guru</a>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
</div>