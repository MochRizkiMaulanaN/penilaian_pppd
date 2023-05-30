<div class="login-box" style="margin-bottom: 150px;">
    <div class="login-logo">
        <img src="<?= base_url('assets') ?>/dist/img/logo_pppd.png" width="200">
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Silahkan masukkan email dan password</p>

            <form action="../../index3.html" method="post">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
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
            <p class="mb-0 text-center">
                <a href="<?= base_url('Autentikasi/registrasi') ?>">Registrasi</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->