<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="<?php echo base_url('dashboard'); ?>"><?= SEKOLAH ?></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?php echo base_url('dashboard'); ?>">
        <img src="<?php echo base_url(); ?>assets/img/logo-white.png" alt="logo" class=" rounded-circle img-thumbnail">
      </a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Admin</li>
      <li class="<?php echo $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('dashboard'); ?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
      <li class="<?php echo $this->uri->segment(1) == 'profile' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('profile'); ?>"><i class="far fa-user"></i> <span>Profile</span></a></li>

      <li class="menu-header">Master Data</li>
      <li class="<?php echo $this->uri->segment(2) == 'users' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('admin/users'); ?>"><i class="fas fa-users"></i> <span>Users</span></a></li>
      <li class="<?php echo $this->uri->segment(2) == 'jabatan' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('admin/jabatan'); ?>"><i class="fas fa-tag"></i> <span>Jabatan</span></a></li>
      <li class="<?php echo $this->uri->segment(2) == 'guru' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('admin/guru'); ?>"><i class="fas fa-graduation-cap"></i> <span>Guru</span></a></li>

      <li class="menu-header">Transaksi</li>
      <li class="<?php echo $this->uri->segment(1) == 'gaji' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('gaji'); ?>"><i class="fas fa-credit-card"></i> <span>Gaji</span></a></li>
      <li class="<?php echo $this->uri->segment(1) == 'absen' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('absen'); ?>"><i class="far fa-sticky-note"></i> <span>Absen</span></a></li>


      <li class="menu-header">Laporan</li>
      <li class="<?php echo $this->uri->segment(1) == 'laporan' && $this->uri->segment(2) == 'users' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('laporan/users'); ?>"><i class="fas fa-chart-area"></i> <span>Laporan Daftar Pengguna</span></a></li>
      <li class="<?php echo $this->uri->segment(1) == 'laporan' && $this->uri->segment(2) == 'guru' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('laporan/guru'); ?>"><i class="fas fa-chart-area"></i> <span>Laporan Daftar Guru</span></a></li>
      <li class="<?php echo $this->uri->segment(1) == 'laporan' && $this->uri->segment(2) == 'gaji' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('laporan/gaji'); ?>"><i class="fas fa-chart-area"></i> <span>Laporan Daftar Gaji</span></a></li>
      <li class="<?php echo $this->uri->segment(1) == 'laporan' && $this->uri->segment(2) == 'absen' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('laporan/absen'); ?>"><i class="fas fa-chart-area"></i> <span>Laporan Daftar Absen</span></a></li>

    </ul>

  </aside>
</div>