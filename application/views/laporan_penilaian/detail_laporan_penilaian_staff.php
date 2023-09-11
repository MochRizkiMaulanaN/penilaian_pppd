<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detal Hasil Penilaian</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Detail Hasil Penilaian</li>
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
                            <a href="<?= base_url('Laporan_penilaian/tampil_penilaian_staff/' . $staff_id) ?>" class="btn btn-warning text-white">Kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <strong>Jabatan : <?= rawurldecode($jabatan); ?></strong>
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIP</th>
                                        <th>Nama Pegawai</th>
                                        <!-- <th>Nilai Akhir</th> -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($detail_penilaian_staff as $key => $value) {
                                        $periode_tahun = date('Y', strtotime($value['tgl_periode']));
                                        $pegawai_id = $value['pegawai_id'];
                                        $jabatan = $value['nama_jabatan'];
                                        $nama_pegawai = $value['nama_pegawai'];
                                        $jabatan_id = $value['jabatan_id'];
                                        $staff_id = $value['staff_id'];
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['nip_pegawai'] ?></td>
                                            <td><?= $value['nama_pegawai'] ?></td>
                                            <!-- <td><?php //$value['nilai_akhir'] ?></td> -->
                                            <td>
                                            <a href="<?= base_url('Laporan_penilaian/tampil_nilai_staff_perPegawai/' . $periode_tahun . '/' . $pegawai_id . '/' . $jabatan . '/' . $nama_pegawai . '/' . $jabatan_id.'/'.$staff_id) ?>" class="btn btn-primary btn-sm"><i class="fas fa-solid fa-eye"></i></a>
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