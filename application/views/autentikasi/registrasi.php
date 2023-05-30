<div class="register-box" style="margin-bottom: 100px;">
    <div class="login-logo">
        <img src="<?= base_url('assets') ?>/dist/img/logo_pppd.png" width="200">
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg" style="font-size: 18px; font-weight: bold;">Registrasi</p>

            <form action="../../index.html" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="konf_password" id="konf_password" placeholder="Konfirmasi password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
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