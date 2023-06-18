<div class="login-box" style="margin-bottom: 150px;">
    <div class="login-logo">
        <img src="<?= base_url('assets') ?>/dist/img/logo_pppd.png" width="200">
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Silahkan masukkan NIP dan Password</p>
            <?php if ($this->session->flashdata('pesan')) {
                echo $this->session->flashdata('pesan');
            } ?>
            <form action="<?= base_url('Autentikasi') ?>" method="post">
                <div class="input-group mb-3">
                    <input type="number" name="nip_pengguna" class="form-control" placeholder="NIP">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger" style="font-size: 13px;"><?= form_error('nip_pengguna') ?></span>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger" style="font-size: 13px;"><?= form_error('password') ?></span>
                <div class="row mb-1">
                    <!-- /.col -->
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p>
                <a href="forgot-password.html">Lupa password ?</a>
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