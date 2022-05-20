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
                            <form action="<?= base_url('admin/users/tambah') ?>" method="POST">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" value="<?= set_value('username') ?>">
                                    <?= form_error('username', '<div class="text-danger text-small">', '</div>') ?>
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
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" value="<?= set_value('password') ?>">
                                    <?= form_error('password', '<div class="text-danger text-small">', '</div>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="password2" value="">
                                    <?= form_error('password2', '<div class="text-danger text-small">', '</div>') ?>
                                </div>

                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" class="form-control" name="no_hp" value="<?= set_value('no_hp') ?>">
                                    <?= form_error('no_hp', '<div class="text-danger text-small">', '</div>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role_id" id="role_id" class="form-control col-4">
                                        <option value="">Pilih Role</option>
                                        <?php foreach ($allRole as $ar) : ?>
                                            <option <?= set_value('role_id') == $ar['id'] ? 'selected' : '' ?> value="<?= $ar['id'] ?>"> <?= $ar['nama_role'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('role_id', '<div class="text-danger text-small">', '</div>') ?>
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
                                <a href="<?= base_url('admin/users') ?>" class="btn btn-primary mb-5 float-right">&laquo; Back to Users</a>
                            </form>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </section>
</div>