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
          <a class="btn btn-primary mb-4" href="<?= base_url('absen/buat') ?>">Buat Absen</a>

          <table class="table table-striped" id="table-gaji">
            <thead>
              <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Hadir</th>
                <th>Izin</th>
                <th>Sakit</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($absen as $a) : ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $a['nip'] ?></td>
                  <td><?= $a['nama'] ?></td>
                  <td><?= bulan($a['bulan']) ?></td>
                  <td><?= $a['tahun'] ?></td>
                  <td><?= $a['hadir'] ?></td>
                  <td><?= $a['izin'] ?></td>
                  <td><?= $a['sakit'] ?></td>
                  <td>
                    <a class="btn btn-primary" href="<?= base_url('absen/edit/'.$a['idnya_absen']) ?>">Edit</a>
                    <a onclick="return confirm('yakin ingin hapus?')" class="btn btn-danger" href="<?= base_url('absen/delete/'.$a['idnya_absen']) ?>">Delete</a>
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