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
                        <a href="<?= base_url('admin/jabatan/tambah') ?>" class="btn btn-primary">Tambah Data</a>
                    </div>
                    <table class="table table-striped" id="table-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Jabatan</th>
                                <th>Gaji Pokok</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($jabatan as $j) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $j['nama_jabatan'] ?></td>
                                    <td><?= formatRupiah($j['gaji_pokok']) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/jabatan/edit/' . $j['id']) ?>" class="btn btn-primary">Edit</a>
                                        <a  onclick="return confirm('yakin ingin hapus?')" href="<?= base_url('admin/jabatan/delete/' . $j['id']) ?>" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
</div>