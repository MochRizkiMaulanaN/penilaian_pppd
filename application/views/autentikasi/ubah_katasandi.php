<!-- Login Content -->
<div class="container-login">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-form">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Ubah Katasandi Anda Untuk Email</h1>
                                    <h5 class="mb-4"><?= $this->session->userdata('reset_email') ?></h5>
                                </div>
                                <?= $this->session->flashdata('pesan'); ?>
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
                                        <button class="btn btn-primary btn-block">Ubah Katasandi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Content -->