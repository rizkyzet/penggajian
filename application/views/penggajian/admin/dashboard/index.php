<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= ucfirst($this->uri->segment(1)) ?>
        <?php if ($this->uri->segment(2)) : ?>
          &mdash; <?= ucfirst($this->uri->segment(2)) ?>
        <?php endif; ?>
      </h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Admin</h4>
              </div>
              <div class="card-body">
                <?= $totalAdmin ?>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-graduation-cap"></i> 
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Guru</h4>
              </div>
              <div class="card-body">
                <?= $totalGuru ?>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-user-secret"></i> 
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Bendahara</h4>
              </div>
              <div class="card-body">
                <?= $totalBendahara ?>
              </div>
            </div>
          </div>
        </div>
      
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-user-tie"></i> 
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Kepsek</h4>
              </div>
              <div class="card-body">
                <?= $totalKepsek ?>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>
</div>