<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= ucfirst($this->uri->segment(1)) ?>
        <?php if ($this->uri->segment(2)) : ?>
          &mdash; <?= ucfirst(str_replace('_', ' ', $this->uri->segment(2))) ?>
        <?php endif; ?>
      </h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-5">

          <form action="<?= base_url('profile/edit_profile') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control" name="username" value="<?= $user['username'] ?>" disabled>
              <?= form_error('username', '<div class="text-danger text-small">', '</div>') ?>
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama" value="<?= $user['nama'] ?>">
              <?= form_error('nama', '<div class="text-danger text-small">', '</div>') ?>
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" class="form-control" name="alamat" value="<?= $user['alamat'] ?>">
              <?= form_error('alamat', '<div class="text-danger text-small">', '</div>') ?>
            </div>
            <div class="form-group">
              <label>No HP</label>
              <input type="text" class="form-control" name="no_hp" value="<?= $user['no_hp'] ?>">
              <?= form_error('no_hp', '<div class="text-danger text-small">', '</div>') ?>
            </div>
            <div class="form-group">
              <label>Role</label>
              <select name="role_id" id="role_id" class="form-control col-4" disabled>
                <option value="">Pilih Role</option>
                <?php foreach ($allRole as $ar) : ?>
                  <option <?= $ar['id'] == $user['role_id'] ? 'selected' : '' ?> value="<?= $ar['id'] ?>"> <?= $ar['nama_role'] ?></option>
                <?php endforeach; ?>
              </select>
              <?= form_error('role_id', '<div class="text-danger text-small">', '</div>') ?>
            </div>
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select name="jk" id="jk" class="form-control col-6">
                <option value="">Pilih jenis kelamin</option>
                <option <?= $user['jk'] == 'L' ? 'selected' : '' ?> value="L">Laki-laki</option>
                <option <?= $user['jk'] == 'P' ? 'selected' : '' ?> value="P">Perempuan</option>
              </select>
              <?= form_error('jk', '<div class="text-danger text-small">', '</div>') ?>
            </div>
            
            <div class="form-group">
              <label>Photo</label>
              <div class="row">
                <div class="col-5">
                  <img class="img-preview img-thumbnail" src="<?= base_url('assets/upload/profile_picture/'.$user['foto']) ?>">
                </div>
              </div>

              <div class="row">
                <div class="col-5">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image">Choose file</label>
                  </div>
                </div>

              </div>
            </div>



            <div class="mt-4">
              <button type="submit" class="btn btn-primary float-right mx-3">Save</button>
              <a href="<?= base_url('profile') ?>" class="btn btn-primary mb-5 float-right">&laquo; Back to Profile</a>
            </div>

          </form>

        </div>
      </div>
    </div>
  </section>
</div>