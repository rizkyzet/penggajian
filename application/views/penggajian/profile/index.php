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
            <h2 class="section-title">Hi, <?= $user['nama'] ?>!</h2>
            <p class="section-lead">
                Change information about yourself on this page.
            </p>
            <div class="row mt-sm-4">
                <div class="col-lg-8">
                    <?= $this->session->flashdata('pesan') ?>
                    <?= $this->session->flashdata('pesan_upload') ?>
                    <div class="card card-large-icons">
                        <div class="card-icon bg-primary text-white">

                            <img style="object-fit: cover;" alt="image" src="<?php echo base_url('assets/upload/profile_picture/' . $user['foto']); ?>" width="130">

                        </div>
                        <div class="card-body p-3">
                            <div class="profile-widget-description col-lg-9 col-sm-12">
                                <div class="profile-widget-name">
                                    <div class="row">
                                        <div class="col">
                                            <b>Nama : </b>
                                        </div>
                                        <div class="col">
                                            <?= $user['nama'] ?>
                                            <div class="text-muted d-inline font-weight-normal">
                                                <div class="slash"></div> <?= ucfirst(getRoleName($user['role_id'])) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <b>Username : </b>
                                    </div>
                                    <div class="col">
                                        <?= $user['username'] ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <b>Alamat : </b>
                                    </div>
                                    <div class="col">
                                        <?= $user['alamat'] ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <b>No. HP : </b>
                                    </div>
                                    <div class="col">
                                        <?= $user['no_hp'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <b>Jenis Kelamin : </b>
                                    </div>
                                    <div class="col">
                                        <?= jenisKelamin($user['jk']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer p-3 mt-3">
                            
                                <a href="<?= base_url('profile/edit_profile') ?>" class="btn btn-primary mr-1">
                                    Edit Profile
                                </a>
                                <a href="<?= base_url('profile/change_password') ?>" class="btn btn-primary mr-1">
                                    Change Password
                                </a>

                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </section>
</div>