<div class="login-box" style="margin-bottom: 150px;">
    <div class="login-logo">
        <img src="<?= base_url('assets') ?>/dist/img/logo_pppd.png" width="200">
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Ubah Katasandi Anda Untuk Email</p>
            <p class="login-box-msg"><?= $this->session->userdata('reset_email') ?></p>
            <?php if ($this->session->flashdata('pesan')) {
                echo $this->session->flashdata('pesan');
            } ?>
            <form method="POST" action="<?= base_url('Autentikasi/ubah_katasandi') ?>">
                <div class="form-group">
                    <input type="password" class="form-control" name="password1" placeholder="masukkan katasandi baru....">
                    <small class="form-text text-danger"> <?= form_error('password1'); ?></small>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password2" placeholder="ketikan ulang katasandi....">
                    <small class="form-text text-danger"> <?= form_error('password2'); ?></small>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Ubah Katasandi</button>
                </div>
            </form>

        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->