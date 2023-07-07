<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Rekomendasi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Rekomendasi</li>
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
                            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah"><i class="fa fa-plus"></i> Kuota Pegawai Perpanjangan</button> -->
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah"><i class="fa fa-plus"></i> Tambah</button>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if ($this->session->flashdata('pesan')) {
                                echo $this->session->flashdata('pesan');
                            } ?>
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIP</th>
                                        <th>Nama Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Periode Tahun</th>
                                        <th>Nilai Akhir</th>
                                        <th>Rekomendasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($rekomendasi as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['nip_pegawai'] ?></td>
                                            <td><?= $value['nama_pegawai'] ?></td>
                                            <td><?= $value['nama_jabatan'] ?></td>
                                            <td><?= $value['periode_tahun'] ?></td>
                                            <td><?= $value['nilai_akhir'] ?></td>
                                            <td><?= $value['keterangan'] ?></td>
                                            <td>
                                                <a href="<?= base_url('Rekomedasi/detail/') . $value['pegawai_id'] ?>" class="btn btn-primary btn-sm btn_lihat"><i class="fas fa-solid fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
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

<!-- Modal tambah -->
<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="form" method="post">
                    <div class="form-group">
                        <label for="kuota">Kuota Pegawai Perpanjangan</label>
                        <input type="number" class="form-control" name="kuota">
                        <small class="form-text text-danger" id="kuota_error"></small>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select class="select2-single-placeholder form-control" name="jabatan">
                            <option value="">Pilih Jabatan</option>
                            <?php foreach ($jabatan as $key => $value) { ?>
                                <option value="<?= $value['id_jabatan']; ?>"><?= $value['nama_jabatan']; ?></option>
                            <?php } ?>
                        </select>
                        <small class="form-text text-danger" id="jabatan_error"></small>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Tambahkan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal tambah rekomendasi -->
<div class="modal fade" id="modal_tambah_rekomendasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="form" method="post" action="<?= base_url('Rekomendasi/tambah_rekomendasi') ?>">
                    <div class="form-group">
                        <label for="tahun">Periode Tahun</label>
                        <select class="select2-single-placeholder form-control" name="tahun">
                            <option value="">Pilih Tahun</option>
                            <option value="2025">2025</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                        </select>
                        <small class="form-text text-danger" id="jabatan_error"><?= form_error('tahun') ?></small>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Tambahkan</button>
            </div>
            </form>
        </div>
    </div>
</div>