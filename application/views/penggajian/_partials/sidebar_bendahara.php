<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo base_url('bendahara/dashboard'); ?>">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url('bendahara/dashboard'); ?>">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Bendahara</li>
            <li class="dropdown">
                <a href="<?= base_url('guru/dashboard') ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="<?php echo $this->uri->segment(2) == 'blank' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('profile'); ?>"><i class="far fa-user"></i> <span>Profile</span></a></li>

            <li class="menu-header">Master Data</li>
        </ul>
    </aside>
</div>