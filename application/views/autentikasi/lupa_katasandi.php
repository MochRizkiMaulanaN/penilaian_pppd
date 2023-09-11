<!-- Login Content -->
<!-- <div class="container-login">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-form">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Anda Lupa Katasandi ?</h1>
                                </div>
                                <?= $this->session->flashdata('pesan'); ?>
                                <form method="POST" action="<?= base_url('Autentikasi/lupa_katasandi') ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" placeholder="masukkan email anda....">
                                        <small class="form-text text-danger"> <?= form_error('email'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block">Reset Katasandi</button>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <a class="font-weight-bold small" href="<?= base_url('Autentikasi'); ?>">Login</a>
                                </div>
                                <div class="text-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Login Content -->

<div class="login-box" style="margin-bottom: 150px;">
    <div class="login-logo">
        <img src="<?= base_url('assets') ?>/dist/img/logo_pppd.png" width="200">
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Lupa Password</p>
            <?php if ($this->session->flashdata('pesan')) {
                echo $this->session->flashdata('pesan');
            } ?>
            <form method="POST" action="<?= base_url('Autentikasi/lupa_katasandi') ?>">
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="masukkan email anda....">
                    <small class="form-text text-danger"> <?= form_error('email'); ?></small>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block">Kirim</button>
                </div>
            </form>

            <p>
                <a href="<?= base_url('Autentikasi') ?>">Kembali</a>
            </p>
            <hr>
            <!-- <p class="mb-0 text-center">
                <a href="<?php //base_url('Autentikasi/registrasi') 
                            ?>">Registrasi</a>
            </p> -->
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->