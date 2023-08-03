<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">My Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('Dasboard') ?>"></a>Dashboard</li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if ($this->session->flashdata('pesan')) {
                                echo $this->session->flashdata('pesan');
                            } ?>
                            <form method="POST">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="email">Email</label><br>
                                            <input readonly class="form-control" value="<?= $pengguna['email'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama Pengguna</label><br>
                                            <input readonly class="form-control" value="<?= $pengguna['nama_pengguna'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="jabatan">Jabatan</label><br>
                                            <input readonly class="form-control" value="<?= $pengguna['nama_role'] ?>">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <form method="post">
                                            <input type="hidden" name="nip" value="<?= $pengguna['nip_pengguna'] ?>">
                                            <div class="form-group">
                                                <label for="jabatan">Password Sekarang</label>
                                                <input type="password" class="form-control" name="password_now">
                                                <span class="text-danger"><?= form_error('password_now') ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="jabatan">Password Baru</label>
                                                <input type="password" class="form-control" name="password_new">
                                                <span class="text-danger"><?= form_error('password_new') ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="jabatan">Konfirmasi Password</label>
                                                <input type="password" class="form-control" name="password_konf">
                                                <span class="text-danger"><?= form_error('password_konf') ?></span>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                        </form>
                                    </div>
                                </div>



                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->