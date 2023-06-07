<div class="register-box" style="margin-bottom: 100px;">
    <div class="login-logo">
        <img src="<?= base_url('assets') ?>/dist/img/logo_pppd.png" width="200">
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg" style="font-size: 18px; font-weight: bold;">Registrasi</p>

            <form action="<?= base_url('Autentikasi/registrasi') ?>" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger" style="font-size: 13px;"><?= form_error('nama_lengkap') ?></span>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="nip_pengguna" id="nip_pengguna" placeholder="NIP">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger" style="font-size: 13px;"><?= form_error('nip_pengguna') ?></span>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger" style="font-size: 13px;"><?= form_error('email') ?></span>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger" style="font-size: 13px;"><?= form_error('password') ?></span>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="konf_password" id="konf_password" placeholder="Konfirmasi password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger" style="font-size: 13px;"><?= form_error('konf_password') ?></span>
                <div class="row">
                    <!-- /.col -->
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <hr>
            <p class="mb-0 text-center">
                <a href="<?= base_url('Autentikasi') ?>">Kembali</a>
            </p>

        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->