<footer class="main-footer">
  <div class="footer-left">
    Copyright &copy; 2022 <div class="bullet"></div> <?= SEKOLAH ?>
  </div>
  <div class="footer-right">

  </div>
</footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="<?= base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>

<!-- JS Libraies -->
<script src="<?= base_url(); ?>assets/modules/cleave-js/dist/cleave.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
<script src="<?= base_url(); ?>assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url(); ?>assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/select2/dist/js/select2.full.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script>

<script src="<?= base_url(); ?>assets/modules/jquery.sparkline.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/chart.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
<script src="<?= base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>


<!-- Page Specific JS File -->
<script src="<?= base_url(); ?>assets/js/page/modules-datatables.js"></script>
<script src="<?= base_url(); ?>assets/js/page/bootstrap-modal.js"></script>


<script src="<?= base_url(); ?>assets/js/chartDashboard.js"></script>


<script>
  $('.currency').toArray().forEach(function(field) {
    new Cleave(field, {
      numeral: true,
      numeralThousandsGroupStyle: 'thousand'
    });
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('.img-preview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
    readURL(this);
  })

  $('.image').on('change', function() {
    console.log('ok');
    readURL(this);
  })
</script>

<!-- Template JS File -->
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

<!-- MY JS -->
<script src="<?= base_url('assets/js/myscript.js') ?>"></script>
<?php if ($this->uri->segment(1) == 'gaji' && $this->uri->segment(2) == 'buat') : ?>
  <script src="<?= base_url('assets/js/buatGaji.js') ?>"></script>
<?php endif ?>
<?php if ($this->uri->segment(1) == 'gaji' && $this->uri->segment(2) == 'edit') : ?>
  <script src="<?= base_url('assets/js/editGaji.js') ?>"></script>
<?php endif ?>

</body>




</html>