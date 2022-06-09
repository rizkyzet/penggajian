<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $title ?? 'Default Title'; ?> &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap-social/bootstrap-social.css">
  <!-- CSS Libraries -->


  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->

  <style>
    body {
      background-image: url('assets/img/pattern.png');
    }
  </style>
</head>


<!-- batas header -->

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-1 px-5">
        <div class="row mt-5">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

            <?= $this->session->flashdata('pesan') ?>

            <div class="card card-primary">
            <div class="login-brand m-0 mt-3">
              <img src="<?php echo base_url(); ?>assets/img/logo-white.png" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>
              <div class="mt-3 text-center">
                <h5 class="text-center">Silahkan Login</h5>
              </div>

              <div class="card-body">
                <form method="POST" action=<?= base_url('auth') ?>>
                  <div class="form-group">
                    <label for="id">Username</label>
                    <input id="id" type="text" class="form-control" name="id" value="<?= set_value('id', $this->input->post('id')) ?>">
                    <?= form_error('id', '<div class="text-danger text-small">', '</div>') ?>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>

                    </div>
                    <input id="password" type="password" class="form-control" name="password" value="<?= set_value('password', $this->input->post('password')) ?>">
                    <?= form_error('password', '<div class="text-danger text-small">', '</div>') ?>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Login
                    </button>
                  </div>
                </form>

              </div>
            </div>
            <!-- <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="<?php echo base_url(); ?>dist/auth_register">Create One</a>
            </div> -->

          </div>
        </div>
        <div class="simple-footer">
          Copyright &copy; <?= SEKOLAH ?>
        </div>
      </div>
    </section>
  </div>




  <!-- General JS Scripts -->
  <script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>
<!-- 
  <script>
    fetch(`http://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=36`).then(response => response.json()).then(
      (response) => {
        $.ajax({
          url: 'http://localhost/penggajian/auth/ajaks',
          method: 'POST',
          data: {
            kabupaten: response
          },
          succes: function(data) {
            console.log(data);
          }
        })
      }
    )
  </script> -->