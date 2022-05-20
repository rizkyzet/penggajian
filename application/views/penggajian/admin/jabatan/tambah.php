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
                    <div class="card card-primary">
                        <div class="card-body">
                            <form action="<?= base_url('admin/jabatan/tambah') ?>" method="POST">
                                <div class="form-group">
                                    <label>Nama Jabatan</label>
                                    <input type="text" class="form-control" name="nama_jabatan" value="<?= set_value('nama_jabatan') ?>">
                                    <?= form_error('nama_jabatan', '<div class="text-danger text-small">', '</div>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Gaji Pokok</label>
                                    <input type="text" class="form-control currency" name="gaji_pokok" value="<?= set_value('gaji_pokok') ?>">
                                    <?= form_error('gaji_pokok', '<div class="text-danger text-small">', '</div>') ?>
                                </div>

                                <button type="submit" class="btn btn-primary float-right mx-3">Save</button>
                                <a href="<?= base_url('profile') ?>" class="btn btn-primary mb-5 float-right">&laquo; Back to Profile</a>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
</div>