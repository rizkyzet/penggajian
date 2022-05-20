<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>
            <?= urlToTitle(); ?>
            </h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <?= $this->session->flashdata('pesan') ?>

                    <div class="mb-4">
                        <a href="<?= base_url('admin/users/tambah') ?>" class="btn btn-primary">Tambah Data</a>
                    </div>
                    <table class="table table-striped align-middle" id="table-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-center">Foto</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No. HP</th>
                                <th>Jenis Kelamin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($users as $u) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td class="text-center">
                                        <img class="img-thumbnail" src="<?= base_url('assets/upload/profile_picture/' . $u['foto']) ?>" alt="" width="50" height="40">
                                    </td>
                                    <td><?= $u['username'] ?></td>
                                    <td><?= $u['nama'] ?></td>
                                    <td><?= $u['alamat'] ?></td>
                                    <td><?= $u['no_hp'] ?></td>
                                    <td><?= jenisKelamin($u['jk']) ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="<?= base_url('admin/users/edit/' . $u['username']) ?>">Edit</a>
                                        <a class="btn btn-danger" href="<?= base_url('admin/users/delete/' . $u['username']) ?>" onclick="return confirm('yakin')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
</div>