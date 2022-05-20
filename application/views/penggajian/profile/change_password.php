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
        <div class="col-5">
       
          <form action="<?= base_url('profile/change_password') ?>" method="POST">

            <div class="form-group">
              <label>Password Anda</label>
              <input type="password" class="form-control" name="my_password" value="<?= set_value('my_password') ?>"> 
              <?= form_error('my_password', '<div class="text-danger text-small">', '</div>') ?>
            </div>
          
            <div class="form-group">
              <label>Password Baru</label>
              <input type="password" class="form-control" name="password" value="<?= set_value('password') ?>">
              <?= form_error('password', '<div class="text-danger text-small">', '</div>') ?>
            </div>

            <div class="form-group">
              <label>Konfirmasi Password</label>
              <input type="password" class="form-control" name="password2">
              <?= form_error('password2', '<div class="text-danger text-small">', '</div>') ?>
            </div>
            <button type="submit" class="btn btn-primary float-right mx-3">Save</button>
            <a href="<?= base_url('profile') ?>" class="btn btn-primary mb-5 float-right">&laquo; Back to Profile</a>
          </form>

        </div>
      </div>
    </div>
  </section>
</div>