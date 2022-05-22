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

          <form action="<?= base_url('laporan/cetak_semua_gaji') ?>" method="POST" target="_blank">
            <div class="form-row mb-4">
              <div class="form-group col-2">
                <label for="bulan">Bulan</label>
                <select name="bulan" id="bulan" class="form-control">
                  <option value="">Pilih Bulan</option>
                  <?php for ($bulan = 1; $bulan <= 12; $bulan++) : ?>
                    <option value="<?= $bulan ?>"><?= $bulan ?></option>
                  <?php endfor ?>
                </select>
              </div>
              <div class="form-group col-2">
                <label for="tahun">Tahun</label>
                <select name="tahun" id="tahun" class="form-control">
                  <option value="">Pilih Tahun</option>
                  <?php for ($tahun = 2015; $tahun <= date('Y'); $tahun++) : ?>
                    <option value="<?= $tahun ?>"><?= $tahun ?></option>
                  <?php endfor ?>
                </select>
              </div>
              <div class="form-group col-2 pt-4">
                <button class="btn btn-primary mt-2">Cetak</button>
              </div>
              <div class="form-group col-2 pt-2 ml-auto">
                <a class="btn btn-primary mt-4" href="<?= base_url('gaji/buat/') ?>" target="__blank">Buat Gaji</a>
              </div>
            </div>
          </form>


          <div class="container-table">
            <table class="table table-striped" id="table-gaji">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Bulan</th>
                  <th>Tahun</th>
                  <th>Total Gaji</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($gajiGuru as $g) : ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $g['nip'] ?></td>
                    <td><?= $g['nama'] ?></td>
                    <td><?= $g['bulan'] ?></td>
                    <td><?= $g['tahun'] ?></td>
                    <td><?= rupiah($g['total_gaji']) ?></td>
                    <td>
                      <a class="btn btn-info" href="<?= base_url('/gaji/detail/' . $g['idnya_gaji']) ?>">Detail</a>
                      <a class="btn btn-primary" href="<?= base_url('/gaji/edit/' . $g['idnya_gaji']) ?>">Edit</a>
                      <a class="btn btn-danger" href="<?= base_url('/gaji/delete/' . $g['idnya_gaji']) ?>" onclick="return confirm('yakin ingin hapus?')">Delete</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>


        </div>
      </div>
    </div>

    <!-- <div class="modal fade" tabindex="-1" role="dialog" id="modal-1" >
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Modal body text goes here.</p>
              </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div> -->
  </section>

</div>