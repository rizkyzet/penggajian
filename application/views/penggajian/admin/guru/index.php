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
                        <a href="<?= base_url('admin/guru/tambah') ?>" class="btn btn-primary">Tambah Data</a>
                    </div>
                    <table class="table table-striped align-middle" id="table-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Jabatan</th>
                                <th>No. HP</th>
                                <th>Jenis Kelamin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($guru as $g) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $g['nip'] ?></td>
                                    <td><?= $g['nama'] ?></td>
                                    <td><?= $g['alamat'] ?></td>
                                    <td><?= $g['nama_jabatan'] ?></td>
                                    <td><?= $g['no_hp'] ?></td>
                                    <td><?= jenisKelamin($g['jk']) ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="<?= base_url('admin/guru/edit/' . $g['nip']) ?>">Edit</a>
                                        <a class="btn btn-danger" href="<?= base_url('admin/guru/delete/' . $g['nip']) ?>" onclick="return confirm('yakin')">Hapus</a>
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