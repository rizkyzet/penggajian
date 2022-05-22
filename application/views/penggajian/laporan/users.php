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
                            <form action="<?= base_url('laporan/cetak_users') ?>" method="POST" target="_blank">
                                <div class="form-group">
                                    <select class="form-control" name="role" id="role">
                                        <option value="">Pilih Role</option>
                                        <?php foreach ($role as $r) : ?>
                                            <option value="<?= $r['id'] ?>"><?= ucfirst($r['nama_role']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="jk" id="jk">
                                        <option value="">Pili Jenis Kelamin</option>
                                        <option value="L">Laki laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary float-right" >Cetak</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>