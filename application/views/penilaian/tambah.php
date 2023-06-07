<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Penilaian</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Data Penilaian</li>
                        <li class="breadcrumb-item active"><?= $pegawai['nama_pegawai'] ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h7><?= $pegawai['nip_pegawai'] ?> - <?= $pegawai['nama_pegawai'] ?> (<?= $pegawai['nama_staff'] ?>) </h7>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <input type="hidden" id="penilaian_id" value="<?= $pegawai['id_penilaian'] ?>">
                                    <input type="hidden" id="pegawai_id" value="<?= $pegawai['pegawai_id'] ?>">
                                    <?php foreach ($kriteria as $key => $value) { ?>
                                        <tr>
                                            <th class="text-white" bgcolor="#8496a9" colspan="2"><?= $value['nama_kriteria']; ?></th>
                                            <?php foreach ($subkriteria as $key => $subvalue) {
                                                if ($subvalue['id_kriteria'] == $value['id_kriteria']) { ?>

                                        <tr>
                                            <td><?= $subvalue['nama_subkriteria'] ?></td>
                                            <td>
                                                <input type="hidden" id="<?= $subvalue['id_subkriteria'] ?>[]" value="<?= $subvalue['id_subkriteria'] ?>">
                                                <select name="" id="<?= $subvalue['id_subkriteria'] ?>[]" class="form-control">
                                                    <option value="5">Sangat Baik</option>
                                                    <option value="4">Baik</option>
                                                    <option value="3">Cukup</option>
                                                    <option value="2">Kurang</option>
                                                    <option value="1">Kurang Sekali</option>
                                                </select>
                                            </td>
                                        </tr>
                                        </tr>
                                <?php }
                                            } ?>
                                </tr>
                            <?php } ?>

                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="mt-3">
                                <a href="<?= base_url('Penilaian') ?>" class="btn btn-primary">Submit</a>
                                <a href="<?= base_url('Penilaian') ?>" class="btn btn-warning text-white">Kembali</a>
                            </div>

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